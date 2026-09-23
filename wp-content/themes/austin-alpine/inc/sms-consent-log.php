<?php
/**
 * Audit log of SMS consent given through Contact Form 7 (see inc/sms-consent.php).
 *
 * 10DLC/TCPA compliance means being able to show, per phone number, that consent
 * was given, when, from which page, and to exactly what wording. CF7's own entry
 * storage is not enough for that, so every submission that displayed the consent
 * block writes one row here — including submissions that declined both boxes,
 * which is the proof that a number was never opted in.
 *
 * Tools -> SMS Consent Log browses it; the CSV export is what you hand a carrier
 * or aggregator during a campaign review.
 */

define('ALPINE_SMS_CONSENT_LOG_DB_VERSION', '1.0.0');

function alpine_sms_consent_log_table() {
    global $wpdb;

    return $wpdb->prefix . 'alpine_sms_consent_log';
}

/**
 * dbDelta is picky: one column per line, two spaces before the PRIMARY KEY
 * parenthesis, and lowercase types, or it will rebuild the table every load.
 */
function alpine_maybe_create_sms_consent_log_table() {
    if (get_option('alpine_sms_consent_log_db_version') === ALPINE_SMS_CONSENT_LOG_DB_VERSION) {
        return;
    }

    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $table = alpine_sms_consent_log_table();

    dbDelta(
        "CREATE TABLE {$table} (
  id bigint(20) unsigned NOT NULL auto_increment,
  created_at datetime NOT NULL default '0000-00-00 00:00:00',
  form_id bigint(20) unsigned NOT NULL default 0,
  form_title varchar(191) NOT NULL default '',
  source_url varchar(255) NOT NULL default '',
  full_name varchar(191) NOT NULL default '',
  email varchar(191) NOT NULL default '',
  phone varchar(64) NOT NULL default '',
  consent_service tinyint(1) NOT NULL default 0,
  consent_promotional tinyint(1) NOT NULL default 0,
  consent_version varchar(32) NOT NULL default '',
  consent_text longtext NOT NULL,
  remote_ip varchar(45) NOT NULL default '',
  user_agent varchar(255) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY phone (phone),
  KEY email (email),
  KEY created_at (created_at)
) " . $wpdb->get_charset_collate() . ';'
    );

    update_option('alpine_sms_consent_log_db_version', ALPINE_SMS_CONSENT_LOG_DB_VERSION);
}
add_action('init', 'alpine_maybe_create_sms_consent_log_table', 5);

/**
 * Pull the customer's name / email / phone out of posted data without assuming
 * field names: match on CF7 field type first, then fall back to the name.
 */
function alpine_extract_sms_consent_contact($contact_form, $posted) {
    $found = array(
        'full_name' => '',
        'email'     => '',
        'phone'     => '',
    );

    // Forms split the name (first_name + last_name), so collect every name-ish
    // field in form order rather than stopping at the first one.
    $name_parts = array();

    $flatten = function ($value) {
        if (is_array($value)) {
            $value = implode(', ', array_filter($value, 'is_scalar'));
        }

        return trim((string) $value);
    };

    if ($contact_form instanceof WPCF7_ContactForm) {
        foreach ($contact_form->scan_form_tags() as $tag) {
            if ('' === $tag->name || !isset($posted[$tag->name])) {
                continue;
            }

            $value = $flatten($posted[$tag->name]);

            if ('' === $value) {
                continue;
            }

            if ('' === $found['phone'] && ('tel' === $tag->basetype || preg_match('/phone|mobile|cell/i', $tag->name))) {
                $found['phone'] = $value;
                continue;
            }

            if ('' === $found['email'] && ('email' === $tag->basetype || false !== stripos($tag->name, 'email'))) {
                $found['email'] = $value;
                continue;
            }

            if (preg_match('/(^|[-_])(your[-_])?(first|last|full)?[-_]?name([-_]|$)/i', $tag->name)
                && !preg_match('/company|business|employer|school|file|user[-_]?name|nick/i', $tag->name)) {
                $name_parts[] = $value;
            }
        }
    }

    $found['full_name'] = trim(implode(' ', array_unique($name_parts)));

    // A form built with raw HTML inputs has no CF7 tags to scan.
    foreach ($posted as $key => $value) {
        if (!is_string($key) || 0 === strpos($key, '_wpcf7') || 0 === strpos($key, 'sms-consent')) {
            continue;
        }

        $value = $flatten($value);

        if ('' === $value) {
            continue;
        }

        if ('' === $found['phone'] && preg_match('/phone|mobile|cell|^tel/i', $key)) {
            $found['phone'] = $value;
        } elseif ('' === $found['email'] && false !== stripos($key, 'email')) {
            $found['email'] = $value;
        } elseif ('' === $found['full_name'] && false !== stripos($key, 'name')) {
            $found['full_name'] = $value;
        }
    }

    return $found;
}

/**
 * Record one row per validated submission that showed the consent block.
 *
 * Runs on wpcf7_submit rather than wpcf7_mail_sent so that forms configured to
 * skip mail (the DB-only ones) are logged too.
 */
function alpine_log_sms_consent($contact_form, $result) {
    $status = isset($result['status']) ? $result['status'] : '';

    // Everything else (validation_failed, spam, aborted) never reached a customer.
    if (!in_array($status, array('mail_sent', 'mail_failed'), true)) {
        return;
    }

    if (!class_exists('WPCF7_Submission')) {
        return;
    }

    $submission = WPCF7_Submission::get_instance();

    if (!$submission) {
        return;
    }

    $posted = $submission->get_posted_data();

    if (!is_array($posted) || empty($posted['sms-consent-shown'])) {
        return;
    }

    $checked = array();
    $texts = array();

    foreach (alpine_get_sms_consent_options() as $option) {
        $is_checked = !empty($posted[$option['name']]);
        $checked[$option['name']] = $is_checked ? 1 : 0;

        if ($is_checked) {
            $texts[] = $option['title'] . ' — ' . $option['text'];
        }
    }

    $contact = alpine_extract_sms_consent_contact($contact_form, $posted);

    global $wpdb;

    $wpdb->insert(
        alpine_sms_consent_log_table(),
        array(
            'created_at'          => current_time('mysql', true),
            'form_id'             => $contact_form instanceof WPCF7_ContactForm ? (int) $contact_form->id() : 0,
            'form_title'          => $contact_form instanceof WPCF7_ContactForm ? (string) $contact_form->title() : '',
            'source_url'          => (string) $submission->get_meta('url'),
            'full_name'           => $contact['full_name'],
            'email'               => $contact['email'],
            'phone'               => $contact['phone'],
            'consent_service'     => $checked['sms-consent-service'],
            'consent_promotional' => $checked['sms-consent-promotional'],
            'consent_version'     => (string) $posted['sms-consent-shown'],
            'consent_text'        => implode("\n\n", $texts),
            'remote_ip'           => (string) $submission->get_meta('remote_ip'),
            'user_agent'          => substr((string) $submission->get_meta('user_agent'), 0, 255),
        ),
        array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s', '%s', '%s')
    );
}
add_action('wpcf7_submit', 'alpine_log_sms_consent', 10, 2);

/**
 * Short label for reporting, without the "(Optional)" suffix the form needs.
 */
function alpine_get_sms_consent_short_label($option) {
    return trim(preg_replace('/\s*\(Optional\)\s*$/i', '', $option['title']));
}

/**
 * Put the opt-in state into the staff notification email.
 *
 * Whoever reads the lead needs to know whether they may text this person, so
 * they never have to remember the consent log exists. Only the admin
 * notification gets it — the customer's autoresponder copy is left alone.
 */
function alpine_append_sms_consent_to_mail($components, $contact_form, $mail_object) {
    if (!class_exists('WPCF7_Submission') || empty($components['body'])) {
        return $components;
    }

    $mail_name = is_object($mail_object) && method_exists($mail_object, 'name') ? $mail_object->name() : 'mail';

    if ('mail' !== $mail_name) {
        return $components;
    }

    $submission = WPCF7_Submission::get_instance();

    if (!$submission) {
        return $components;
    }

    $posted = $submission->get_posted_data();

    if (!is_array($posted) || empty($posted['sms-consent-shown'])) {
        return $components;
    }

    $lines = array();

    foreach (alpine_get_sms_consent_options() as $option) {
        $lines[] = sprintf(
            '%s: %s',
            alpine_get_sms_consent_short_label($option),
            empty($posted[$option['name']]) ? 'NOT opted in' : 'OPTED IN'
        );
    }

    $use_html = false;
    $props = $contact_form instanceof WPCF7_ContactForm ? $contact_form->prop($mail_name) : array();

    if (is_array($props) && !empty($props['use_html'])) {
        $use_html = true;
    }

    if (!$use_html) {
        $components['body'] .= "\n\n-- SMS consent --\n" . implode("\n", $lines) . "\n";

        return $components;
    }

    $block = '<hr /><p><strong>SMS consent</strong><br />'
        . implode('<br />', array_map('esc_html', $lines))
        . '</p>';

    // HTML templates are full documents, so appending would leave the block
    // outside </html> where clients are free to drop it.
    foreach (array('</body>', '</html>') as $tag) {
        $at = strripos($components['body'], $tag);

        if (false !== $at) {
            $components['body'] = substr_replace($components['body'], $block, $at, 0);

            return $components;
        }
    }

    $components['body'] .= $block;

    return $components;
}
add_filter('wpcf7_mail_components', 'alpine_append_sms_consent_to_mail', 20, 3);

/**
 * Opt-in counts for a rolling window, shared by the dashboard widget and the
 * notice on the CF7 entries screen.
 */
function alpine_get_sms_consent_stats($days = 30) {
    global $wpdb;

    $table = alpine_sms_consent_log_table();
    $since = gmdate('Y-m-d H:i:s', time() - ($days * DAY_IN_SECONDS));

    $row = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT COUNT(*) AS total,
                SUM(consent_service = 1) AS service,
                SUM(consent_promotional = 1) AS promotional,
                SUM(consent_service = 0 AND consent_promotional = 0) AS declined
            FROM {$table} WHERE created_at >= %s",
            $since
        ),
        ARRAY_A
    );

    return array(
        'days'        => (int) $days,
        'total'       => isset($row['total']) ? (int) $row['total'] : 0,
        'service'     => isset($row['service']) ? (int) $row['service'] : 0,
        'promotional' => isset($row['promotional']) ? (int) $row['promotional'] : 0,
        'declined'    => isset($row['declined']) ? (int) $row['declined'] : 0,
    );
}

function alpine_get_sms_consent_log_url($args = array()) {
    return add_query_arg(
        array_merge(array('page' => 'alpine-sms-consent-log'), $args),
        admin_url('tools.php')
    );
}

/**
 * Dashboard widget: the at-a-glance view, since the consent log is a screen
 * nobody thinks to open on their own.
 */
function alpine_register_sms_consent_dashboard_widget() {
    // wp_dashboard_setup can be fired outside a real dashboard request.
    if (!function_exists('wp_add_dashboard_widget') || !current_user_can('manage_options')) {
        return;
    }

    wp_add_dashboard_widget(
        'alpine_sms_consent_widget',
        'SMS Opt-ins (last 30 days)',
        'alpine_render_sms_consent_dashboard_widget'
    );
}
add_action('wp_dashboard_setup', 'alpine_register_sms_consent_dashboard_widget');

function alpine_render_sms_consent_dashboard_widget() {
    global $wpdb;

    $stats = alpine_get_sms_consent_stats(30);
    $table = alpine_sms_consent_log_table();
    $recent = $wpdb->get_results(
        "SELECT created_at, full_name, phone, consent_service, consent_promotional
        FROM {$table}
        WHERE consent_service = 1 OR consent_promotional = 1
        ORDER BY created_at DESC LIMIT 5"
    );
    ?>
    <p style="display:flex;gap:1.25rem;flex-wrap:wrap;margin-top:0">
        <span><strong style="font-size:1.4em"><?php echo esc_html(number_format_i18n($stats['service'])); ?></strong><br />service updates</span>
        <span><strong style="font-size:1.4em"><?php echo esc_html(number_format_i18n($stats['promotional'])); ?></strong><br />promotional</span>
        <span><strong style="font-size:1.4em"><?php echo esc_html(number_format_i18n($stats['declined'])); ?></strong><br />declined both</span>
        <span><strong style="font-size:1.4em"><?php echo esc_html(number_format_i18n($stats['total'])); ?></strong><br />submissions</span>
    </p>
    <?php if ($recent) : ?>
        <table class="widefat striped" style="margin-bottom:.75rem">
            <tbody>
                <?php foreach ($recent as $row) : ?>
                    <tr>
                        <td><?php echo esc_html(mysql2date('M j', $row->created_at)); ?></td>
                        <td><?php echo esc_html($row->full_name ? $row->full_name : '—'); ?></td>
                        <td><?php echo esc_html($row->phone); ?></td>
                        <td><?php
                            $kinds = array();

                            if ($row->consent_service) {
                                $kinds[] = 'Service';
                            }

                            if ($row->consent_promotional) {
                                $kinds[] = 'Promo';
                            }

                            echo esc_html(implode(' + ', $kinds));
                        ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No opt-ins recorded yet.</p>
    <?php endif; ?>
    <p>
        <a class="button button-secondary" href="<?php echo esc_url(alpine_get_sms_consent_log_url(array('consent' => 'any'))); ?>">View opt-ins</a>
        <a class="button" href="<?php echo esc_url(alpine_get_sms_consent_log_url()); ?>">Full consent log</a>
    </p>
    <?php
}

/**
 * Banner on Contact -> Entries (Beta).
 *
 * cf7-views' list table hardcodes its columns and previews only the first three
 * fields of an entry, so consent can never show up per row there and the plugin
 * offers no column filter to add one. A banner pointing at the log is the
 * honest fix; it also cannot break when the plugin updates.
 */
function alpine_sms_consent_entries_notice() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (!isset($_GET['page']) || 'cf7-views-entries' !== $_GET['page']) {
        return;
    }

    $stats = alpine_get_sms_consent_stats(30);
    ?>
    <div class="notice notice-info">
        <p>
            <strong>SMS consent is tracked separately.</strong>
            Last 30 days: <?php echo esc_html(number_format_i18n($stats['service'])); ?> opted in to service updates,
            <?php echo esc_html(number_format_i18n($stats['promotional'])); ?> to promotional,
            <?php echo esc_html(number_format_i18n($stats['declined'])); ?> declined both.
            <a href="<?php echo esc_url(alpine_get_sms_consent_log_url()); ?>">Open the SMS Consent Log</a>
            to check a specific number before texting it.
        </p>
    </div>
    <?php
}
add_action('admin_notices', 'alpine_sms_consent_entries_notice');

/**
 * Shared WHERE builder so the screen and its CSV export can never disagree.
 */
function alpine_sms_consent_log_where($search, $filter) {
    global $wpdb;

    $where = array('1=1');

    if ('' !== $search) {
        $like = '%' . $wpdb->esc_like($search) . '%';
        $where[] = $wpdb->prepare(
            '(phone LIKE %s OR email LIKE %s OR full_name LIKE %s)',
            $like,
            $like,
            $like
        );
    }

    if ('service' === $filter) {
        $where[] = 'consent_service = 1';
    } elseif ('promotional' === $filter) {
        $where[] = 'consent_promotional = 1';
    } elseif ('any' === $filter) {
        $where[] = '(consent_service = 1 OR consent_promotional = 1)';
    } elseif ('declined' === $filter) {
        $where[] = '(consent_service = 0 AND consent_promotional = 0)';
    }

    return implode(' AND ', $where);
}

function alpine_get_sms_consent_log_filters() {
    return array(
        ''            => 'All submissions',
        'any'         => 'Opted in (either)',
        'service'     => 'Service updates',
        'promotional' => 'Promotional',
        'declined'    => 'Declined both',
    );
}

function alpine_register_sms_consent_log_page() {
    add_submenu_page(
        'tools.php',
        'SMS Consent Log',
        'SMS Consent Log',
        'manage_options',
        'alpine-sms-consent-log',
        'alpine_render_sms_consent_log_page'
    );
}
add_action('admin_menu', 'alpine_register_sms_consent_log_page');

function alpine_render_sms_consent_log_page() {
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized request.');
    }

    global $wpdb;

    $table = alpine_sms_consent_log_table();
    $search = isset($_GET['s']) ? sanitize_text_field(wp_unslash($_GET['s'])) : '';
    $filter = isset($_GET['consent']) ? sanitize_key($_GET['consent']) : '';
    $filters = alpine_get_sms_consent_log_filters();

    if (!isset($filters[$filter])) {
        $filter = '';
    }

    $per_page = 25;
    $paged = isset($_GET['paged']) ? max(1, (int) $_GET['paged']) : 1;
    $where = alpine_sms_consent_log_where($search, $filter);

    // $where is built only from prepared fragments and fixed strings.
    $total = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table} WHERE {$where}");
    $rows = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM {$table} WHERE {$where} ORDER BY created_at DESC, id DESC LIMIT %d OFFSET %d",
            $per_page,
            ($paged - 1) * $per_page
        )
    );

    $opted_in = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table} WHERE consent_service = 1 OR consent_promotional = 1");
    $service = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table} WHERE consent_service = 1");
    $promotional = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table} WHERE consent_promotional = 1");
    $all_time = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$table}");
    ?>
    <div class="wrap">
        <h1>SMS Consent Log</h1>
        <p>
            Every form submission that displayed the SMS opt-in boxes, including the ones that
            declined. Use this to prove consent for a given number, and the CSV export for
            carrier or aggregator campaign reviews.
        </p>
        <p>
            <strong><?php echo esc_html(number_format_i18n($all_time)); ?></strong> submissions logged ·
            <strong><?php echo esc_html(number_format_i18n($opted_in)); ?></strong> opted in to at least one ·
            <?php echo esc_html(number_format_i18n($service)); ?> service updates ·
            <?php echo esc_html(number_format_i18n($promotional)); ?> promotional
        </p>

        <form method="get">
            <input type="hidden" name="page" value="alpine-sms-consent-log" />
            <p class="search-box">
                <label class="screen-reader-text" for="alpine-consent-search">Search consent log</label>
                <input type="search" id="alpine-consent-search" name="s" value="<?php echo esc_attr($search); ?>" placeholder="Phone, email or name" />
                <select name="consent">
                    <?php foreach ($filters as $value => $label) : ?>
                        <option value="<?php echo esc_attr($value); ?>" <?php selected($filter, $value); ?>><?php echo esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>
                <?php submit_button('Filter', 'secondary', '', false); ?>
                <a class="button" href="<?php echo esc_url(
                    wp_nonce_url(
                        add_query_arg(
                            array(
                                'action'  => 'alpine_export_sms_consent',
                                's'       => $search,
                                'consent' => $filter,
                            ),
                            admin_url('admin-post.php')
                        ),
                        'alpine_export_sms_consent'
                    )
                ); ?>">Export CSV</a>
            </p>
        </form>

        <table class="widefat striped">
            <thead>
                <tr>
                    <th scope="col">Date (UTC)</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Service</th>
                    <th scope="col">Promotional</th>
                    <th scope="col">Source</th>
                    <th scope="col">IP</th>
                    <th scope="col">Wording</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rows)) : ?>
                    <tr><td colspan="9">No consent records yet.</td></tr>
                <?php else : ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?php echo esc_html(mysql2date('Y-m-d H:i', $row->created_at)); ?></td>
                            <td><?php echo esc_html($row->full_name); ?></td>
                            <td><?php echo esc_html($row->phone); ?></td>
                            <td><?php echo esc_html($row->email); ?></td>
                            <td><?php echo $row->consent_service ? '<strong style="color:#12805c">Yes</strong>' : 'No'; ?></td>
                            <td><?php echo $row->consent_promotional ? '<strong style="color:#12805c">Yes</strong>' : 'No'; ?></td>
                            <td>
                                <?php if ($row->source_url) : ?>
                                    <a href="<?php echo esc_url($row->source_url); ?>"><?php echo esc_html($row->form_title ? $row->form_title : 'Form ' . $row->form_id); ?></a>
                                <?php else : ?>
                                    <?php echo esc_html($row->form_title); ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo esc_html($row->remote_ip); ?></td>
                            <td><abbr title="<?php echo esc_attr($row->consent_text); ?>"><?php echo esc_html($row->consent_version); ?></abbr></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <?php
        $pages = (int) ceil($total / $per_page);

        if ($pages > 1) :
            ?>
            <div class="tablenav"><div class="tablenav-pages"><?php
                echo paginate_links(
                    array(
                        'base'    => add_query_arg('paged', '%#%'),
                        'format'  => '',
                        'current' => $paged,
                        'total'   => $pages,
                    )
                );
            ?></div></div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * CSV of the current filter — the artifact a carrier actually asks for.
 */
function alpine_export_sms_consent_csv() {
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized request.');
    }

    check_admin_referer('alpine_export_sms_consent');

    global $wpdb;

    $search = isset($_GET['s']) ? sanitize_text_field(wp_unslash($_GET['s'])) : '';
    $filter = isset($_GET['consent']) ? sanitize_key($_GET['consent']) : '';
    $filters = alpine_get_sms_consent_log_filters();

    if (!isset($filters[$filter])) {
        $filter = '';
    }

    $table = alpine_sms_consent_log_table();
    $where = alpine_sms_consent_log_where($search, $filter);
    $rows = $wpdb->get_results("SELECT * FROM {$table} WHERE {$where} ORDER BY created_at DESC, id DESC", ARRAY_A);

    nocache_headers();
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=alpine-sms-consent-' . gmdate('Y-m-d') . '.csv');

    $out = fopen('php://output', 'w');

    fputcsv($out, array(
        'Logged at (UTC)',
        'Name',
        'Phone',
        'Email',
        'Service updates consent',
        'Promotional consent',
        'Form',
        'Form ID',
        'Source URL',
        'IP address',
        'User agent',
        'Wording version',
        'Consent text shown',
    ));

    foreach ($rows as $row) {
        fputcsv($out, array(
            $row['created_at'],
            $row['full_name'],
            $row['phone'],
            $row['email'],
            $row['consent_service'] ? 'Yes' : 'No',
            $row['consent_promotional'] ? 'Yes' : 'No',
            $row['form_title'],
            $row['form_id'],
            $row['source_url'],
            $row['remote_ip'],
            $row['user_agent'],
            $row['consent_version'],
            $row['consent_text'],
        ));
    }

    fclose($out);
    exit;
}
add_action('admin_post_alpine_export_sms_consent', 'alpine_export_sms_consent_csv');
