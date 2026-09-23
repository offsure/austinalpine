<?php
/**
 * Alpine Heating & Air Conditioning Theme functions and definitions
 */

define('CHILD_THEME_AUSTIN_ALPINE_VERSION', '1.0.2');

/**
 * Enqueue Styles & Scripts (Optimized Order)
 */
function alpine_enqueue_assets() {

    /**
     * 1. Bootstrap CSS (Load FIRST) — self-hosted; no third-party DNS/TLS on the critical path.
     */
    wp_enqueue_style(
        'bootstrap-css',
        get_stylesheet_directory_uri() . '/assets/vendor/bootstrap/bootstrap.min.css',
        array(),
        '5.3.2'
    );

    // Self-hosted Font Awesome subset: only the icons the theme actually uses
    // (~1.7KB CSS + ~3KB fonts vs ~100KB CSS + ~300KB fonts from the CDN).
    // Regenerate the subset if new fa-* icons are added to templates.
    wp_enqueue_style(
        'font-awesome',
        get_stylesheet_directory_uri() . '/assets/vendor/fontawesome/css/fa-subset.css',
        array('bootstrap-css'),
        '6.5.2-subset'
    );

    /**
     * 2. Astra Parent Theme CSS
     */
    wp_enqueue_style(
        'astra-theme-css',
        get_template_directory_uri() . '/style.css',
        array('font-awesome'),
        null
    );

    /**
     * 3. Child Theme CSS — serve the minified copy when it is current,
     * fall back to the source file so a stale minify can never ship.
     */
    $alpine_child_css_src = get_stylesheet_directory() . '/style.css';
    $alpine_child_css_min = get_stylesheet_directory() . '/style.min.css';
    $alpine_use_min = file_exists($alpine_child_css_min)
        && file_exists($alpine_child_css_src)
        && filemtime($alpine_child_css_min) >= filemtime($alpine_child_css_src);

    wp_enqueue_style(
        'austin-alpine-theme-css',
        get_stylesheet_directory_uri() . ($alpine_use_min ? '/style.min.css' : '/style.css'),
        array('astra-theme-css'),
        $alpine_use_min ? (string) filemtime($alpine_child_css_min) : CHILD_THEME_AUSTIN_ALPINE_VERSION
    );

    /**
     * 4. Google reCAPTCHA v2
     */
    if ( alpine_has_recaptcha_v2_keys() ) {
        wp_enqueue_script(
            'recaptcha-v2',
            'https://www.google.com/recaptcha/api.js',
            array(),
            null,
            true
        );
    }

    /**
     * 5. Bootstrap JS (with dependency)
     */
    // Bootstrap 5 has no jQuery dependency — declaring one would force
    // WordPress to load jQuery on every page for nothing.
    wp_enqueue_script(
        'bootstrap-js',
        get_stylesheet_directory_uri() . '/assets/vendor/bootstrap/bootstrap.bundle.min.js',
        array(),
        '5.3.2',
        true
    );
}

add_action('wp_enqueue_scripts', 'alpine_enqueue_assets', 20);

/**
 * Projects styles and archive filter.
 *
 * Kept out of the sitewide stylesheet and loaded only where the section renders,
 * so pages that have nothing to do with projects carry none of this weight.
 */
function alpine_enqueue_project_assets() {
    if (!function_exists('alpine_register_project_post_type')) {
        return;
    }

    $is_project_view = is_singular(ALPINE_PROJECT_POST_TYPE)
        || is_post_type_archive(ALPINE_PROJECT_POST_TYPE)
        || is_tax(ALPINE_PROJECT_TAXONOMY);

    if (!$is_project_view) {
        return;
    }

    $projects_css = get_stylesheet_directory() . '/assets/css/projects.css';

    wp_enqueue_style(
        'alpine-projects-css',
        get_stylesheet_directory_uri() . '/assets/css/projects.css',
        array('austin-alpine-theme-css'),
        file_exists($projects_css) ? (string) filemtime($projects_css) : CHILD_THEME_AUSTIN_ALPINE_VERSION
    );

    // The filter only exists on the combined archive; single projects and the
    // per-type archives have nothing to filter.
    if (is_post_type_archive(ALPINE_PROJECT_POST_TYPE)) {
        $projects_js = get_stylesheet_directory() . '/assets/js/projects.js';

        wp_enqueue_script(
            'alpine-projects-js',
            get_stylesheet_directory_uri() . '/assets/js/projects.js',
            array(),
            file_exists($projects_js) ? (string) filemtime($projects_js) : CHILD_THEME_AUSTIN_ALPINE_VERSION,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'alpine_enqueue_project_assets', 25);

/**
 * Preselect CF7 assistance dropdowns from the "service" query parameter anywhere forms appear.
 */
function alpine_enqueue_contact_form_prefill_script() {
    $script = <<<'JS'
document.addEventListener('DOMContentLoaded', function () {
  function normalizeValue(value) {
    return String(value || '')
      .replace(/[\s_-]+/g, ' ')
      .trim()
      .toLowerCase();
  }

  function applyAssistancePrefill() {
    var params = new URLSearchParams(window.location.search);
    var requestedService = normalizeValue(params.get('service'));

    if (!requestedService) {
      return;
    }

    var serviceMap = {
      'commercial-services': 'Commercial HVAC',
      'repair': 'Schedule Repair',
      'maintenance': 'Schedule Maintenance',
      'installation': 'New System Quote'
    };

    var targetLabel = serviceMap[requestedService] || serviceMap[requestedService.replace(/\s+/g, '-')];

    if (!targetLabel) {
      return;
    }

    var normalizedTargetLabel = normalizeValue(targetLabel);
    var selects = document.querySelectorAll('select[name="assistance"]');

    selects.forEach(function (select) {
      for (var i = 0; i < select.options.length; i += 1) {
        var option = select.options[i];

        if (normalizeValue(option.text) !== normalizedTargetLabel) {
          continue;
        }

        select.selectedIndex = i;
        select.dispatchEvent(new Event('change', { bubbles: true }));
        break;
      }
    });
  }

  applyAssistancePrefill();
});
JS;

    wp_add_inline_script('bootstrap-js', $script);
}
add_action('wp_enqueue_scripts', 'alpine_enqueue_contact_form_prefill_script', 30);


/**
 * Returns true when reCAPTCHA v2 keys are available for the custom CF7 integration.
 */
function alpine_has_recaptcha_v2_keys() {
    return defined( 'WPCF7_RECAPTCHA_SITEKEY' )
        && WPCF7_RECAPTCHA_SITEKEY
        && defined( 'WPCF7_RECAPTCHA_SECRET' )
        && WPCF7_RECAPTCHA_SECRET;
}


/**
 * Disable Contact Form 7's built-in reCAPTCHA v3 hooks when this theme uses v2 widgets.
 */
function alpine_disable_cf7_recaptcha_v3_hooks() {
    if ( ! alpine_has_recaptcha_v2_keys() ) {
        return;
    }

    remove_action( 'wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts', 20 );
    remove_filter( 'wpcf7_form_hidden_fields', 'wpcf7_recaptcha_add_hidden_fields', 100 );
    remove_filter( 'wpcf7_spam', 'wpcf7_recaptcha_verify_response', 9 );
    remove_action( 'wpcf7_init', 'wpcf7_recaptcha_add_form_tag_recaptcha', 10 );

    remove_action( 'wp_enqueue_scripts', 'wpcf7_turnstile_enqueue_scripts', 10 );
    remove_filter( 'wpcf7_form_elements', 'wpcf7_turnstile_prepend_widget', 10 );
    remove_filter( 'wpcf7_spam', 'wpcf7_turnstile_verify_response', 9 );
    remove_action( 'wpcf7_init', 'wpcf7_add_form_tag_turnstile', 10 );
}
add_action( 'plugins_loaded', 'alpine_disable_cf7_recaptcha_v3_hooks', 30 );
add_action( 'init', 'alpine_disable_cf7_recaptcha_v3_hooks', 5 );


/**
 * Register a CF7 form-tag so [recaptcha_v2] renders inside form templates.
 */
function alpine_register_recaptcha_v2_form_tag() {
    if ( ! alpine_has_recaptcha_v2_keys() || ! function_exists( 'wpcf7_add_form_tag' ) ) {
        return;
    }

    wpcf7_add_form_tag( array( 'recaptcha_v2', 'recaptcha-v2' ), 'alpine_render_recaptcha_v2_form_tag', array(
        'display-block' => true,
    ) );
}
add_action( 'wpcf7_init', 'alpine_register_recaptcha_v2_form_tag', 20 );


/**
 * Render the reCAPTCHA widget in a CF7-compatible wrapper so validation messages can attach.
 */
function alpine_render_recaptcha_v2_form_tag( $tag ) {
    if ( ! alpine_has_recaptcha_v2_keys() ) {
        return '';
    }

    $tag = new WPCF7_FormTag( $tag );
    $id = $tag->get_id_option();
    $class = $tag->get_class_option( 'alpine-recaptcha-v2-wrap' );

    if ( ! $id ) {
        $id = 'alpine-recaptcha-v2';
    }

    $atts = array(
        'class' => trim( 'g-recaptcha ' . ( $class ? $class : '' ) ),
        'data-sitekey' => WPCF7_RECAPTCHA_SITEKEY,
        'data-theme' => 'light',
    );

    $html = sprintf(
        '<span class="wpcf7-form-control-wrap" data-name="g-recaptcha-response"><span id="%1$s" %2$s></span></span>',
        esc_attr( $id ),
        wpcf7_format_atts( $atts )
    );

    return $html;
}


/**
 * Verify the posted reCAPTCHA v2 token with Google.
 */
function alpine_verify_recaptcha_v2_token( $token ) {
    if ( ! alpine_has_recaptcha_v2_keys() ) {
        return new WP_Error( 'missing_keys', 'reCAPTCHA keys are not configured.' );
    }

    if ( '' === $token ) {
        return new WP_Error( 'missing_token', 'Please complete the reCAPTCHA verification.' );
    }

    $response = wp_remote_post(
        'https://www.google.com/recaptcha/api/siteverify',
        array(
            'timeout' => 10,
            'body' => array(
                'secret' => WPCF7_RECAPTCHA_SECRET,
                'response' => $token,
                'remoteip' => isset( $_SERVER['REMOTE_ADDR'] ) ? wp_unslash( $_SERVER['REMOTE_ADDR'] ) : '',
            ),
        )
    );

    if ( is_wp_error( $response ) ) {
        return new WP_Error( 'request_failed', 'Unable to verify reCAPTCHA right now. Please try again.' );
    }

    $body = json_decode( wp_remote_retrieve_body( $response ), true );

    if ( empty( $body['success'] ) ) {
        return new WP_Error( 'invalid_token', 'Please complete the reCAPTCHA verification.' );
    }

    return true;
}


/**
 * Validate reCAPTCHA v2 for CF7 forms that include the [recaptcha_v2] tag.
 */
function alpine_validate_recaptcha_v2( $result, $tags ) {
    if ( ! alpine_has_recaptcha_v2_keys() ) {
        return $result;
    }

    $has_recaptcha_v2 = false;

    foreach ( (array) $tags as $tag ) {
        $tag = new WPCF7_FormTag( $tag );

        if ( 'recaptcha_v2' === $tag->basetype ) {
            $has_recaptcha_v2 = true;
            break;
        }
    }

    if ( ! $has_recaptcha_v2 ) {
        return $result;
    }

    $verification = alpine_verify_recaptcha_v2_token(
        isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ) : ''
    );

    if ( is_wp_error( $verification ) ) {
        $result->invalidate(
            array(
                'type' => 'recaptcha_v2',
                'name' => 'g-recaptcha-response',
                'options' => array( 'id:alpine-recaptcha-v2' ),
            ),
            $verification->get_error_message()
        );
    }

    return $result;
}
add_filter( 'wpcf7_validate', 'alpine_validate_recaptcha_v2', 20, 2 );


/**
 * Replace any leftover custom reCAPTCHA tokens if CF7 leaves them untouched.
 */
function alpine_replace_recaptcha_v2_form_tokens( $form ) {
    if ( ! alpine_has_recaptcha_v2_keys() ) {
        return $form;
    }

    if ( false === strpos( $form, '[recaptcha_v2' ) && false === strpos( $form, '[recaptcha-v2' ) ) {
        return $form;
    }

    $replacement = alpine_render_recaptcha_v2_form_tag(
        array(
            'type' => 'recaptcha_v2',
            'basetype' => 'recaptcha_v2',
            'name' => '',
            'options' => array( 'id:alpine-recaptcha-v2' ),
            'raw_values' => array(),
            'values' => array(),
        )
    );

    if ( ! $replacement ) {
        return $form;
    }

    return preg_replace( '/\[recaptcha(?:_|-)v2[^\]]*\]/', $replacement, $form );
}
add_filter( 'wpcf7_form_elements', 'alpine_replace_recaptcha_v2_form_tokens', 30 );


/**
 * Theme Setup
 */
function alpine_theme_setup() {

    // Title tag support
    add_theme_support('title-tag');

    // Featured images
    add_theme_support('post-thumbnails');

    // Custom logo
    add_theme_support('custom-logo');

    // Register menu
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'austin-alpine')
    ));
}

add_action('after_setup_theme', 'alpine_theme_setup');


/**
 * Add Bootstrap Classes to Menu <li>
 */
function alpine_add_li_class($classes, $item, $args) {
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'alpine_add_li_class', 1, 3);


/**
 * Add Bootstrap Classes to Menu <a>
 */
function alpine_add_link_class($atts, $item, $args) {
    if (isset($args->link_class)) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'alpine_add_link_class', 1, 3);


/**
 * Optional: Add active class for current menu item
 */
function alpine_add_active_class($classes, $item) {
    if (in_array('current-menu-item', $classes, true)) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'alpine_add_active_class', 10, 2);

function add_custom_logo_class($html) {
    $html = str_replace('custom-logo', 'site-logo site-logo-nav', $html);
    return $html;
}
add_filter('get_custom_logo', 'add_custom_logo_class');

require_once get_stylesheet_directory() . '/inc/breadcrumbs.php';
require_once get_stylesheet_directory() . '/inc/service-pages.php';
require_once get_stylesheet_directory() . '/inc/service-area-template.php';
require_once get_stylesheet_directory() . '/inc/business-category-pages.php';
require_once get_stylesheet_directory() . '/inc/commercial-category-pages.php';
require_once get_stylesheet_directory() . '/inc/acf-fields.php';
require_once get_stylesheet_directory() . '/inc/google-reviews.php';
require_once get_stylesheet_directory() . '/inc/shared-faq-section.php';
require_once get_stylesheet_directory() . '/inc/seo-tags.php';
require_once get_stylesheet_directory() . '/inc/projects-render.php';
require_once get_stylesheet_directory() . '/inc/projects-seo.php';
require_once get_stylesheet_directory() . '/inc/projects-gallery.php';
require_once get_stylesheet_directory() . '/inc/sms-consent.php';
require_once get_stylesheet_directory() . '/inc/sms-consent-log.php';
require_once get_stylesheet_directory() . '/inc/privacy-policy.php';
require_once get_stylesheet_directory() . '/inc/sms-terms.php';

/**
 * Resolve a page ID from one or more possible slugs.
 */
function alpine_get_page_id_by_path($preferred_slug, $fallback_slugs = array()) {
    $slugs = array_merge(array($preferred_slug), $fallback_slugs);

    foreach ($slugs as $slug) {
        $page = get_page_by_path($slug, OBJECT, 'page');

        // get_page_by_path() also matches attachments; only real pages count here,
        // otherwise slugs shared with media files resolve to attachment URLs.
        if ($page instanceof WP_Post && 'page' === $page->post_type && 'publish' === $page->post_status) {
            return (int) $page->ID;
        }
    }

    return 0;
}

/**
 * Build a permalink from a page ID lookup so links follow the active permalink settings.
 */
function alpine_get_page_url($preferred_slug, $fallback_slugs = array(), $fallback_path = '/') {
    $page_id = alpine_get_page_id_by_path($preferred_slug, $fallback_slugs);

    if ($page_id > 0) {
        return get_permalink($page_id);
    }

    return home_url($fallback_path);
}

/**
 * 301 retired URLs to their canonical replacements.
 * service-areas-2 duplicated /service-areas/ with the same template; the page
 * is drafted and its URL permanently redirects to the canonical directory.
 */
function alpine_legacy_redirects() {
    $request_path = trim((string) parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '', PHP_URL_PATH), '/');
    $home_path = trim((string) parse_url(home_url('/'), PHP_URL_PATH), '/');
    if ($home_path !== '' && strpos($request_path, $home_path) === 0) {
        $request_path = trim(substr($request_path, strlen($home_path)), '/');
    }

    $redirects = array(
        'service-areas-2' => 'service-areas',
    );

    if (isset($redirects[$request_path])) {
        wp_safe_redirect(home_url('/' . $redirects[$request_path] . '/'), 301);
        exit;
    }
}
add_action('template_redirect', 'alpine_legacy_redirects');

/**
 * The retired generic service URLs must 404, not guess-redirect. Without this,
 * WordPress 301s /maintenance/ to the nearest slug match (/maintenance-plan/),
 * which is the wrong destination for a deliberately removed URL.
 */
function alpine_block_retired_url_guessing($do_redirect_guess) {
    $request_path = trim((string) parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '', PHP_URL_PATH), '/');
    $home_path = trim((string) parse_url(home_url('/'), PHP_URL_PATH), '/');
    if ($home_path !== '' && strpos($request_path, $home_path) === 0) {
        $request_path = trim(substr($request_path, strlen($home_path)), '/');
    }

    $retired = array('installation', 'repair', 'maintenance', 'replacement', 'uv-light-systems');

    return in_array($request_path, $retired, true) ? false : $do_redirect_guess;
}
add_filter('do_redirect_guess_404_permalink', 'alpine_block_retired_url_guessing');

if (!function_exists('alpine_get_business_category_panel_link_url')) {
    function alpine_get_business_category_panel_link_url($slug) {
        $slug = trim($slug, '/');

        if ($slug === '') {
            return home_url('/');
        }

        // Only slugs with no dedicated page belong here — dedicated pages
        // (ac-repair, heating-repair, etc.) resolve via get_page_by_path below.
        $shared_page_keys = array(
            'request-an-estimate-austin-tx' => 'estimate',
            'request-an-estimate' => 'estimate',
            'air-conditioning-services-austin-tx' => 'air_conditioning',
            'air-conditioning-services' => 'air_conditioning',
            'repair' => 'repair',
            'maintenance' => 'maintenance',
            'replacement' => 'replacement',
            'indoor-air-quality-services' => 'indoor_air_quality',
        );

        if (isset($shared_page_keys[$slug]) && function_exists('alpine_get_site_page_url')) {
            return alpine_get_site_page_url($shared_page_keys[$slug]);
        }

        $page = get_page_by_path($slug, OBJECT, 'page');

        if ($page instanceof WP_Post) {
            return get_permalink($page);
        }

        return home_url('/' . $slug . '/');
    }
}

/**
 * Build page link data so labels and URLs can both follow live WordPress pages.
 */
function alpine_get_page_link_data($preferred_slug, $fallback_slugs = array(), $fallback_path = '/', $fallback_label = '') {
    $page_id = alpine_get_page_id_by_path($preferred_slug, $fallback_slugs);

    if ($page_id > 0) {
        return array(
            'url' => get_permalink($page_id),
            'label' => get_the_title($page_id),
        );
    }

    return array(
        'url' => home_url($fallback_path),
        'label' => $fallback_label,
    );
}

/**
 * Resolve commonly used internal theme links by page key.
 */
function alpine_get_site_page_url($key) {
    $routes = array(
        'about' => array('slug' => 'about', 'fallback_slugs' => array(), 'fallback_path' => '/about/'),
        'privacy' => array('slug' => 'privacy-policy', 'fallback_slugs' => array(), 'fallback_path' => '/privacy-policy/'),
        'contact' => array('slug' => 'contact-us', 'fallback_slugs' => array(), 'fallback_path' => '/contact-us/'),
        'services' => array('slug' => 'air-conditioning-services', 'fallback_slugs' => array('our-services'), 'fallback_path' => '/air-conditioning-services/'),
        'specials' => array('slug' => 'special-rebates', 'fallback_slugs' => array('special-rebate', 'special-rebate-austin-tx'), 'fallback_path' => '/special-rebates/'),
        'resources' => array('slug' => 'resources', 'fallback_slugs' => array('hvac-resources', 'hvac-resources-austin-tx'), 'fallback_path' => '/resources/'),
        'estimate' => array('slug' => 'request-an-estimate-austin-tx', 'fallback_slugs' => array('request-an-estimate'), 'fallback_path' => '/request-an-estimate-austin-tx/'),
        'service_areas' => array('slug' => 'service-areas', 'fallback_slugs' => array(), 'fallback_path' => '/service-areas/'),
        'financing' => array('slug' => 'financing', 'fallback_slugs' => array('hvac-financing', 'hvac-financing-austin-tx'), 'fallback_path' => '/financing/'),
        'maintenance_plan' => array('slug' => 'hvac-maintenance-plan', 'fallback_slugs' => array('hvac-maintenance-plan-austin-tx', 'maintenance-plan'), 'fallback_path' => '/hvac-maintenance-plan/'),
        'air_conditioning' => array('slug' => 'air-conditioning-services', 'fallback_slugs' => array('air-conditioning-services-austin-tx'), 'fallback_path' => '/air-conditioning-services/'),
        'ductless' => array('slug' => 'ductless-services', 'fallback_slugs' => array('ductless-services-austin-tx'), 'fallback_path' => '/ductless-services/'),
        'installation' => array('slug' => 'ac-installation', 'fallback_slugs' => array('heating-installation'), 'fallback_path' => '/ac-installation/'),
        'repair' => array('slug' => 'ac-repair', 'fallback_slugs' => array('heating-repair'), 'fallback_path' => '/ac-repair/'),
        'maintenance' => array('slug' => 'ac-maintenance', 'fallback_slugs' => array('heating-maintenance'), 'fallback_path' => '/ac-maintenance/'),
        'replacement' => array('slug' => 'ac-replacement', 'fallback_slugs' => array('heating-replacement'), 'fallback_path' => '/ac-replacement/'),
        'indoor_air_quality' => array('slug' => 'indoor-air-quality', 'fallback_slugs' => array('indoor-air-quality-services'), 'fallback_path' => '/indoor-air-quality/'),
        'commercial_hvac' => array('slug' => 'commercial-hvac-austin-tx', 'fallback_slugs' => array('commercial-hvac'), 'fallback_path' => '/commercial-hvac-austin-tx/'),
    );

    if (!isset($routes[$key])) {
        return home_url('/');
    }

    $route = $routes[$key];

    return alpine_get_page_url($route['slug'], $route['fallback_slugs'], $route['fallback_path']);
}

/**
 * Resolve common internal pages with both permalink and page title.
 */
function alpine_get_site_page_link_data($key, $fallback_label = '') {
    $routes = array(
        'about' => array('slug' => 'about', 'fallback_slugs' => array(), 'fallback_path' => '/about/'),
        'contact' => array('slug' => 'contact-us', 'fallback_slugs' => array(), 'fallback_path' => '/contact-us/'),
        'services' => array('slug' => 'air-conditioning-services', 'fallback_slugs' => array('our-services'), 'fallback_path' => '/air-conditioning-services/'),
        'specials' => array('slug' => 'special-rebates', 'fallback_slugs' => array('special-rebate', 'special-rebate-austin-tx'), 'fallback_path' => '/special-rebates/'),
        'resources' => array('slug' => 'resources', 'fallback_slugs' => array('hvac-resources', 'hvac-resources-austin-tx'), 'fallback_path' => '/resources/'),
        'estimate' => array('slug' => 'request-an-estimate-austin-tx', 'fallback_slugs' => array('request-an-estimate'), 'fallback_path' => '/request-an-estimate-austin-tx/'),
        'service_areas' => array('slug' => 'service-areas', 'fallback_slugs' => array(), 'fallback_path' => '/service-areas/'),
        'financing' => array('slug' => 'financing', 'fallback_slugs' => array('hvac-financing', 'hvac-financing-austin-tx'), 'fallback_path' => '/financing/'),
        'maintenance_plan' => array('slug' => 'hvac-maintenance-plan', 'fallback_slugs' => array('hvac-maintenance-plan-austin-tx', 'maintenance-plan'), 'fallback_path' => '/hvac-maintenance-plan/'),
        'air_conditioning' => array('slug' => 'air-conditioning-services', 'fallback_slugs' => array('air-conditioning-services-austin-tx'), 'fallback_path' => '/air-conditioning-services/'),
        'ductless' => array('slug' => 'ductless-services', 'fallback_slugs' => array('ductless-services-austin-tx'), 'fallback_path' => '/ductless-services/'),
        'installation' => array('slug' => 'ac-installation', 'fallback_slugs' => array('heating-installation'), 'fallback_path' => '/ac-installation/'),
        'repair' => array('slug' => 'ac-repair', 'fallback_slugs' => array('heating-repair'), 'fallback_path' => '/ac-repair/'),
        'maintenance' => array('slug' => 'ac-maintenance', 'fallback_slugs' => array('heating-maintenance'), 'fallback_path' => '/ac-maintenance/'),
        'replacement' => array('slug' => 'ac-replacement', 'fallback_slugs' => array('heating-replacement'), 'fallback_path' => '/ac-replacement/'),
        'indoor_air_quality' => array('slug' => 'indoor-air-quality', 'fallback_slugs' => array('indoor-air-quality-services'), 'fallback_path' => '/indoor-air-quality/'),
        'commercial_hvac' => array('slug' => 'commercial-hvac-austin-tx', 'fallback_slugs' => array('commercial-hvac'), 'fallback_path' => '/commercial-hvac-austin-tx/'),
    );

    if (!isset($routes[$key])) {
        return array(
            'url' => home_url('/'),
            'label' => $fallback_label,
        );
    }

    $route = $routes[$key];

    return alpine_get_page_link_data($route['slug'], $route['fallback_slugs'], $route['fallback_path'], $fallback_label);
}

/**
 * Infer the current HVAC service family so shared sidebar links point to the right service pages.
 */
function alpine_get_service_sidebar_context($slug = '') {
    if (!$slug && is_page()) {
        $post_id = get_queried_object_id();
        $slug = $post_id ? get_post_field('post_name', $post_id) : '';
    }

    if (!$slug) {
        return 'general';
    }

    if (strpos($slug, 'heating-') === 0) {
        return 'heating';
    }

    if (strpos($slug, 'ac-') === 0 || in_array($slug, array('air-conditioning-services'), true)) {
        return 'cooling';
    }

    if (strpos($slug, 'ductless') === 0) {
        return 'ductless';
    }

    return 'general';
}

/**
 * Build the shared service sidebar items with family-aware links.
 */
function alpine_get_service_sidebar_items($active_key = '', $slug = '') {
    $context = alpine_get_service_sidebar_context($slug);
    $service_page_link = static function ($preferred_slug, $fallback_slugs = array(), $fallback_path = '', $fallback_label = '') {
        $path = $fallback_path ? $fallback_path : '/' . trim($preferred_slug, '/') . '/';
        return alpine_get_page_link_data($preferred_slug, $fallback_slugs, $path, $fallback_label);
    };

    $ductless_link = alpine_get_site_page_link_data('ductless', 'Ductless');
    $installation_link = $service_page_link('ac-installation', array(), '/ac-installation/', 'Installation');
    $replacement_link = $service_page_link('ac-replacement', array(), '/ac-replacement/', 'Replacement');
    $maintenance_link = $service_page_link('ac-maintenance', array(), '/ac-maintenance/', 'Maintenance');
    $repair_link = $service_page_link('ac-repair', array(), '/ac-repair/', 'Repair');

    if ('heating' === $context) {
        $installation_link = $service_page_link('heating-installation', array(), '/heating-installation/', 'Installation');
        $replacement_link = $service_page_link('heating-replacement', array(), '/heating-replacement/', 'Replacement');
        $maintenance_link = $service_page_link('heating-maintenance', array(), '/heating-maintenance/', 'Maintenance');
        $repair_link = $service_page_link('heating-repair', array(), '/heating-repair/', 'Repair');
    } elseif ('cooling' === $context || 'ductless' === $context) {
        $installation_link = $service_page_link('ac-installation', array(), '/ac-installation/', 'Installation');
        $replacement_link = $service_page_link('ac-replacement', array(), '/ac-replacement/', 'Replacement');
        $maintenance_link = $service_page_link('ac-maintenance', array(), '/ac-maintenance/', 'Maintenance');
        $repair_link = $service_page_link('ac-repair', array(), '/ac-repair/', 'Repair');
    }

    return array(
        array(
            'key' => 'installation',
            'label' => $installation_link['label'],
            'url' => $installation_link['url'],
        ),
        array(
            'key' => 'replacement',
            'label' => $replacement_link['label'],
            'url' => $replacement_link['url'],
        ),
        array(
            'key' => 'repair',
            'label' => $repair_link['label'],
            'url' => $repair_link['url'],
        ),
        array(
            'key' => 'maintenance',
            'label' => $maintenance_link['label'],
            'url' => $maintenance_link['url'],
        ),
        array(
            'key' => 'ductless',
            'label' => $ductless_link['label'],
            'url' => $ductless_link['url'],
        ),
    );
}

/**
 * Render the shared left sidebar used on service landing pages.
 */
function alpine_render_service_sidebar($active_key = '', $slug = '') {
    $items = alpine_get_service_sidebar_items($active_key, $slug);

    if (empty($items)) {
        return;
    }
    ?>
    <aside class="service-sidebar">
        <?php foreach ($items as $item) : ?>
            <a class="service-nav-link<?php echo $item['key'] === $active_key ? ' active' : ''; ?>" href="<?php echo esc_url($item['url']); ?>">
                <span><?php echo esc_html($item['label']); ?></span>
                <?php if ($item['key'] === $active_key) : ?>
                    <span>-&gt;</span>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </aside>
    <?php
}

/**
 * Build the primary navigation with dropdown support.
 */
function alpine_nav_short_label($title) {
    $title = trim((string) $title);

    if (stripos($title, 'Air Conditioning Services') === 0) {
        return 'Air Conditioning';
    }

    if (stripos($title, 'Heating Services') === 0) {
        return 'Heating';
    }

    return $title;
}

function alpine_services_dropdown_item_path($item) {
    return untrailingslashit((string) wp_parse_url($item->url, PHP_URL_PATH));
}

function alpine_services_dropdown_is_heating_group($item) {
    $title = trim((string) $item->title);
    $path = alpine_services_dropdown_item_path($item);
    $normalized_title = strtolower($title);

    if ('/heating-services' === $path) {
        return true;
    }

    if (in_array($normalized_title, array('heating services', 'heating service', 'heating'), true)) {
        return true;
    }

    if (0 === strpos($normalized_title, 'heating ') && false === strpos($normalized_title, 'repair') && false === strpos($normalized_title, 'maintenance') && false === strpos($normalized_title, 'installation') && false === strpos($normalized_title, 'replacement')) {
        return true;
    }

    return false;
}

function alpine_services_dropdown_is_heating_detail($item) {
    $path = alpine_services_dropdown_item_path($item);

    return in_array($path, array(
        '/heating-repair',
        '/heating-maintenance',
        '/heating-installation',
        '/heating-replacement',
        '/furnace-repair',
        '/heater-repair',
        '/heater-replacement',
    ), true);
}

function alpine_services_dropdown_merge_unique_items($items) {
    $merged = array();
    $seen_paths = array();

    foreach ($items as $item) {
        $path = alpine_services_dropdown_item_path($item);

        if ($path && isset($seen_paths[$path])) {
            continue;
        }

        if ($path) {
            $seen_paths[$path] = true;
        }

        $merged[] = $item;
    }

    return $merged;
}

function alpine_render_services_dropdown($items, $children_map, $current_path) {
    if (empty($items)) {
        return;
    }

    $has_heating_group = false;

    foreach ($items as $item) {
        if (alpine_services_dropdown_is_heating_group($item)) {
            $has_heating_group = true;
            break;
        }
    }

    echo '<ul class="dropdown-menu services-dropdown-menu">';
    echo '<li class="services-dropdown-shell">';
    echo '<ul class="services-dropdown-primary">';

    $visible_index = 0;

    foreach ($items as $index => $item) {
        if ($has_heating_group && alpine_services_dropdown_is_heating_detail($item)) {
            continue;
        }

        $item_classes = is_array($item->classes) ? $item->classes : array();
        $child_items = isset($children_map[$item->ID]) ? $children_map[$item->ID] : array();
        $item_path = alpine_services_dropdown_item_path($item);

        if (alpine_services_dropdown_is_heating_group($item)) {
            $heating_detail_items = array();

            foreach ($items as $sibling_item) {
                if (alpine_services_dropdown_is_heating_detail($sibling_item)) {
                    $heating_detail_items[] = $sibling_item;
                }
            }

            $child_items = alpine_services_dropdown_merge_unique_items(array_merge($child_items, $heating_detail_items));
        }

        $is_current = $item_path && $current_path === $item_path;
        $is_active = array_intersect(
            $item_classes,
            array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor', 'current_page_parent', 'current-page-ancestor')
        );

        echo '<li class="services-dropdown-item' . (0 === $visible_index ? ' is-default' : '') . '">';
        echo '<a class="services-dropdown-link' . (!empty($is_active) || $is_current ? ' active' : '') . '" href="' . esc_url($item->url) . '">';
        echo esc_html(alpine_nav_short_label($item->title));
        echo '</a>';

        if (!empty($child_items)) {
            echo '<ul class="services-dropdown-submenu">';

            foreach ($child_items as $child) {
                $child_classes = is_array($child->classes) ? $child->classes : array();
                $child_path = untrailingslashit((string) wp_parse_url($child->url, PHP_URL_PATH));
                $child_is_current = $child_path && $current_path === $child_path;
                $child_is_active = array_intersect(
                    $child_classes,
                    array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor', 'current_page_parent', 'current-page-ancestor')
                );

                echo '<li>';
                echo '<a class="services-dropdown-sublink' . (!empty($child_is_active) || $child_is_current ? ' active' : '') . '" href="' . esc_url($child->url) . '">';
                echo esc_html($child->title);
                echo '</a>';
                echo '</li>';
            }

            echo '</ul>';
        }

        echo '</li>';
        $visible_index++;
    }

    echo '</ul>';
    echo '</li>';
    echo '</ul>';
}

function alpine_render_primary_submenu_items($items, $children_map, $current_path, $depth = 1) {
    if (empty($items)) {
        return;
    }

    $menu_class = 1 === $depth
        ? 'dropdown-menu submenu-level submenu-level-1'
        : 'dropdown-menu submenu-menu submenu-level submenu-level-2';

    echo '<ul class="' . esc_attr($menu_class) . '">';

    foreach ($items as $item) {
        $item_classes = is_array($item->classes) ? $item->classes : array();
        $child_items = isset($children_map[$item->ID]) ? $children_map[$item->ID] : array();
        $item_path = untrailingslashit((string) wp_parse_url($item->url, PHP_URL_PATH));
        $is_current = $item_path && $current_path === $item_path;
        $is_active = array_intersect(
            $item_classes,
            array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor', 'current_page_parent', 'current-page-ancestor')
        );
        $has_children = !empty($child_items);

        $item_class = $has_children ? 'dropdown-submenu submenu-item-has-children' : 'submenu-item';
        echo '<li class="' . esc_attr($item_class) . '">';
        echo '<a class="dropdown-item' . (!empty($is_active) || $is_current ? ' active' : '') . ($has_children ? ' dropdown-item-toggle' : '') . '" href="' . esc_url($item->url) . '">';
        echo esc_html($item->title);

        if ($has_children) {
            echo '<i class="fa-solid fa-chevron-right submenu-caret" aria-hidden="true"></i>';
        }

        echo '</a>';

        if ($has_children) {
            alpine_render_primary_submenu_items($child_items, $children_map, $current_path, $depth + 1);
        }

        echo '</li>';
    }

    echo '</ul>';
}

function alpine_render_primary_menu() {
    $menu_items = wp_get_nav_menu_items('Primary Menu');

    if (empty($menu_items)) {
        return;
    }

    if (function_exists('alpine_projects_archive_url')) {
        $projects_url  = alpine_projects_archive_url();
        $projects_path = untrailingslashit((string) wp_parse_url($projects_url, PHP_URL_PATH));
        $contact_path  = untrailingslashit((string) wp_parse_url(home_url('/contact-us/'), PHP_URL_PATH));

        $has_projects_item = false;
        $contact_index     = null;

        foreach ($menu_items as $index => $item) {
            $item_path = untrailingslashit((string) wp_parse_url($item->url, PHP_URL_PATH));

            if ($projects_path && $projects_path === $item_path) {
                $has_projects_item = true;
                break;
            }

            if (null === $contact_index && 0 === (int) $item->menu_item_parent && $contact_path === $item_path) {
                $contact_index = $index;
            }
        }

        if (!$has_projects_item) {
            $projects_item = (object) array(
                'ID'               => -100,
                'menu_item_parent' => 0,
                'url'              => $projects_url,
                'title'            => __('Projects', 'austin-alpine'),
                'classes'          => array(),
            );

            // Contact Us stays the last item in the bar, so slot Projects in ahead of it.
            if (null !== $contact_index) {
                array_splice($menu_items, $contact_index, 0, array($projects_item));
            } else {
                $menu_items[] = $projects_item;
            }
        }
    }

    $children_map = array();

    foreach ($menu_items as $item) {
        $children_map[$item->ID] = array();
    }

    foreach ($menu_items as $item) {
        $parent_id = (int) $item->menu_item_parent;

        if ($parent_id && isset($children_map[$parent_id])) {
            $children_map[$parent_id][] = $item;
        }
    }

    echo '<ul class="navbar-nav mb-2 mb-lg-0">';

    $current_path = untrailingslashit((string) wp_parse_url(home_url(add_query_arg(array(), $GLOBALS['wp']->request ?? '')), PHP_URL_PATH));

    foreach ($menu_items as $item) {
        if ((int) $item->menu_item_parent !== 0) {
            continue;
        }

        $classes = is_array($item->classes) ? $item->classes : array();
        $children = isset($children_map[$item->ID]) ? $children_map[$item->ID] : array();
        $item_path = untrailingslashit((string) wp_parse_url($item->url, PHP_URL_PATH));
        $is_services_item = '/our-services' === $item_path || '/air-conditioning-services' === $item_path || 'Our Services' === $item->title || 'Air Conditioning Services' === $item->title;
        $is_commercial_item = '/commercial-hvac-austin-tx' === $item_path || '/commercial-hvac' === $item_path || 'Commercial HVAC' === $item->title;
        $is_active = array_intersect(
            $classes,
            array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor', 'current_page_parent', 'current-page-ancestor')
        );

        if ($is_commercial_item && function_exists('alpine_commercial_category_menu_items')) {
            $existing_child_urls = array();

            foreach ($children as $child) {
                $existing_child_urls[] = untrailingslashit((string) wp_parse_url($child->url, PHP_URL_PATH));
            }

            foreach (alpine_commercial_category_menu_items() as $commercial_item) {
                $commercial_path = untrailingslashit((string) wp_parse_url($commercial_item['url'], PHP_URL_PATH));

                if (in_array($commercial_path, $existing_child_urls, true)) {
                    continue;
                }

                $children[] = (object) array(
                    'url' => $commercial_item['url'],
                    'title' => $commercial_item['title'],
                    'classes' => array(),
                );
            }
        }

        if (!empty($children)) {
            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle' . (!empty($is_active) ? ' active' : '') . '" href="' . esc_url($item->url) . '" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
            echo esc_html($item->title);
            echo '<i class="fa-solid fa-chevron-down nav-caret" aria-hidden="true"></i>';
            echo '</a>';
            if ($is_services_item) {
                alpine_render_services_dropdown($children, $children_map, $current_path);
            } else {
                alpine_render_primary_submenu_items($children, $children_map, $current_path);
            }
            echo '</li>';
        } else {
            echo '<li class="nav-item">';
            echo '<a class="nav-link' . (!empty($is_active) ? ' active' : '') . '" href="' . esc_url($item->url) . '">';
            echo esc_html($item->title);
            echo '</a>';
            echo '</li>';
        }
    }

    echo '</ul>';
}

function alpine_manual_service_area_templates() {
    return array(
        'air-conditioning-services.php',
        'heating-services.php',
        'indoor-air-quality-services.php',
        'ductless-services.php',
        'commercial-hvac-austin-tx.php',
        'hvac-financing.php',
        'hvac-maintenance-plan.php',
        'installation.php',
        'repair.php',
        'maintenance.php',
        'replacement.php',
        'our-services.php',
    );
}

function create_business_category_pages() {
    if (get_option('business_category_pages_created')) {
        return;
    }

    foreach (alpine_business_category_page_data() as $slug => $page) {
        $existing_page = get_page_by_path($slug, OBJECT, 'page');

        if ($existing_page) {
            continue;
        }

        wp_insert_post(array(
            'post_title'   => $page['hero_title'],
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => $slug,
        ));
    }

    update_option('business_category_pages_created', true);
}
add_action('init', 'create_business_category_pages');

function alpine_create_commercial_category_pages() {
    if (get_option('commercial_category_pages_created')) {
        return;
    }

    $parent_page = get_page_by_path('commercial-hvac-austin-tx', OBJECT, 'page');
    $parent_id = $parent_page instanceof WP_Post ? (int) $parent_page->ID : 0;

    foreach (alpine_commercial_category_page_data() as $slug => $page) {
        $existing_page = get_page_by_path('commercial-hvac-austin-tx/' . $slug, OBJECT, 'page');

        if ($existing_page instanceof WP_Post) {
            continue;
        }

        $fallback_existing_page = get_page_by_path($slug, OBJECT, 'page');

        if ($fallback_existing_page instanceof WP_Post) {
            continue;
        }

        wp_insert_post(array(
            'post_title'   => $page['hero_title'],
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => $slug,
            'post_parent'  => $parent_id,
        ));
    }

    update_option('commercial_category_pages_created', true);
}
add_action('init', 'alpine_create_commercial_category_pages');

function create_service_area_pages() {

    if (get_option('service_area_pages_created')) {
        return; // prevent running again
    }

    $locations = [
        "Austin, TX",
        "Bee Cave, TX",
        "CedarPark, TX",
        "CedarValley, TX",
        "Hutto, TX",
        "Lakeway, TX",
        "Leander, TX",
        "LostCreek, TX",
        "Manor, TX",
        "Pflugerville, TX",
        "Rollingwood, TX",
        "RoundRock, TX",
        "SunsetValley, TX",
        "TheHills, TX",
        "Volente, TX",
        "WestLakeHills, TX"
    ];

    foreach ($locations as $location) {

        // Clean slug
        $slug = strtolower(str_replace([',', ' '], ['', '-'], $location));

        // Check if page already exists
        $existing_page = get_page_by_path('service-areas/' . $slug);

        if (!$existing_page) {

            $page_id = wp_insert_post([
                'post_title'   => "AC Repair in $location",
                'post_content' => "We provide professional HVAC services in $location including AC repair, installation, and maintenance.",
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_name'    => $slug,
                'post_parent'  => get_page_by_path('service-areas') ? get_page_by_path('service-areas')->ID : 0
            ]);

            if ($page_id) {
                update_post_meta($page_id, '_wp_page_template', 'service-area.php');
            }
        }
    }

    // Run only once
    update_option('service_area_pages_created', true);
}

add_action('init', 'create_service_area_pages');

function alpine_migrate_bee_cave_service_area_slug() {
    if (get_option('alpine_bee_cave_slug_migrated')) {
        return;
    }

    $legacy_page = get_page_by_path('service-areas/bee-caves-tx', OBJECT, 'page');
    $current_page = get_page_by_path('service-areas/bee-cave-tx', OBJECT, 'page');

    if ($legacy_page instanceof WP_Post && !$current_page instanceof WP_Post) {
        wp_update_post(array(
            'ID' => $legacy_page->ID,
            'post_name' => 'bee-cave-tx',
        ));
    }

    update_option('alpine_bee_cave_slug_migrated', true);
}
add_action('init', 'alpine_migrate_bee_cave_service_area_slug', 20);

function alpine_redirect_legacy_bee_caves_service_area() {
    $request_path = trim((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

    if ('service-areas/bee-caves-tx' !== $request_path) {
        return;
    }

    wp_safe_redirect(alpine_service_area_page_url('service-areas/bee-cave-tx'), 301);
    exit;
}
add_action('template_redirect', 'alpine_redirect_legacy_bee_caves_service_area');

function alpine_create_resource_pages() {
    if (get_option('alpine_resource_pages_created')) {
        return;
    }

    $pages = array(
        'seer-calculator' => 'SEER Calculator',
    );

    foreach ($pages as $slug => $title) {
        $existing_page = get_page_by_path($slug, OBJECT, 'page');

        if ($existing_page) {
            continue;
        }

        wp_insert_post(array(
            'post_title'   => $title,
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => $slug,
        ));
    }

    update_option('alpine_resource_pages_created', true);
}

add_action('init', 'alpine_create_resource_pages');

function alpine_get_cf7_form_id_by_title($title) {
    if (!post_type_exists('wpcf7_contact_form')) {
        return 0;
    }

    $forms = get_posts(array(
        'post_type'      => 'wpcf7_contact_form',
        'post_status'    => 'publish',
        'title'          => $title,
        'posts_per_page' => 1,
        'fields'         => 'ids',
    ));

    if (empty($forms)) {
        return 0;
    }

    return (int) $forms[0];
}

function alpine_get_employment_cf7_form_template() {
    return <<<'CF7'
  <div class="contact-form employment-form">
   <section class="employment-form-section">
    <h4>Employment Desired</h4>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Position*</label>
        [text* position id:position class:form-control placeholder "Position"]
      </div>
      <div class="col-md-3">
        <label class="form-label">Date You Can Start*</label>
        [date* start_date id:start_date class:form-control]
      </div>
      <div class="col-md-3">
        <label class="form-label">Salary Desired*</label>
        [text* salary_desired id:salary_desired class:form-control placeholder "Salary desired"]
      </div>
      <div class="col-md-4">
        <label class="form-label d-block">Are You Employed Now?</label>
        [radio employed_now use_label_element default:1 "Yes" "No"]
      </div>
      <div class="col-md-4">
        <label class="form-label d-block">If So May We Inquire Of Your Present Employer?</label>
        [radio inquire_present_employer use_label_element default:1 "Yes" "No"]
      </div>
      <div class="col-md-4">
        <label class="form-label d-block">Ever Applied To This Company Before?</label>
        [radio applied_before use_label_element default:1 "Yes" "No"]
      </div>
      <div class="col-md-6">
        <label class="form-label">Where Did You Apply?</label>
        [text applied_where id:applied_where class:form-control placeholder "Where did you apply?"]
      </div>
      <div class="col-md-3">
        <label class="form-label">When Did You Apply?</label>
        [date applied_when id:applied_when class:form-control]
      </div>
      <div class="col-md-3">
        <label class="form-label">Referred By</label>
        [text referred_by id:referred_by class:form-control placeholder "Referred by"]
      </div>
    </div>
  </section>

  <section class="employment-form-section">
    <h4>Education Details</h4>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">Grammar School</div>
      <div class="row g-3">
        <div class="col-md-5">
          <label class="form-label">Name and Location of School</label>
          [text education_school_0 id:education_school_0 class:form-control placeholder "School name and location"]
        </div>
        <div class="col-md-3">
          <label class="form-label">No of Years Attended</label>
          [text education_years_0 id:education_years_0 class:form-control placeholder "Years attended"]
        </div>
        <div class="col-md-4">
          <label class="form-label d-block">Did You Graduate?</label>
          [radio education_graduate_0 use_label_element default:1 "Yes" "No"]
        </div>
        <div class="col-12">
          <label class="form-label">Subjects Studied</label>
          [textarea education_subjects_0 id:education_subjects_0 class:form-control placeholder "Subjects studied"]
        </div>
      </div>
    </div>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">High School</div>
      <div class="row g-3">
        <div class="col-md-5">
          <label class="form-label">Name and Location of School</label>
          [text education_school_1 id:education_school_1 class:form-control placeholder "School name and location"]
        </div>
        <div class="col-md-3">
          <label class="form-label">No of Years Attended</label>
          [text education_years_1 id:education_years_1 class:form-control placeholder "Years attended"]
        </div>
        <div class="col-md-4">
          <label class="form-label d-block">Did You Graduate?</label>
          [radio education_graduate_1 use_label_element default:1 "Yes" "No"]
        </div>
        <div class="col-12">
          <label class="form-label">Subjects Studied</label>
          [textarea education_subjects_1 id:education_subjects_1 class:form-control placeholder "Subjects studied"]
        </div>
      </div>
    </div>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">College</div>
      <div class="row g-3">
        <div class="col-md-5">
          <label class="form-label">Name and Location of School</label>
          [text education_school_2 id:education_school_2 class:form-control placeholder "School name and location"]
        </div>
        <div class="col-md-3">
          <label class="form-label">No of Years Attended</label>
          [text education_years_2 id:education_years_2 class:form-control placeholder "Years attended"]
        </div>
        <div class="col-md-4">
          <label class="form-label d-block">Did You Graduate?</label>
          [radio education_graduate_2 use_label_element default:1 "Yes" "No"]
        </div>
        <div class="col-12">
          <label class="form-label">Subjects Studied</label>
          [textarea education_subjects_2 id:education_subjects_2 class:form-control placeholder "Subjects studied"]
        </div>
      </div>
    </div>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">Trade, Business or Correspondence School</div>
      <div class="row g-3">
        <div class="col-md-5">
          <label class="form-label">Name and Location of School</label>
          [text education_school_3 id:education_school_3 class:form-control placeholder "School name and location"]
        </div>
        <div class="col-md-3">
          <label class="form-label">No of Years Attended</label>
          [text education_years_3 id:education_years_3 class:form-control placeholder "Years attended"]
        </div>
        <div class="col-md-4">
          <label class="form-label d-block">Did You Graduate?</label>
          [radio education_graduate_3 use_label_element default:1 "Yes" "No"]
        </div>
        <div class="col-12">
          <label class="form-label">Subjects Studied</label>
          [textarea education_subjects_3 id:education_subjects_3 class:form-control placeholder "Subjects studied"]
        </div>
      </div>
    </div>
  </section>

  <section class="employment-form-section">
    <h4>Personal Information</h4>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Name* (First)</label>
        [text* first_name id:first_name class:form-control placeholder "First name"]
      </div>
      <div class="col-md-6">
        <label class="form-label">Name* (Last)</label>
        [text* last_name id:last_name class:form-control placeholder "Last name"]
      </div>
    </div>

    <div class="employment-address-block">
      <h5>Present Address*</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Street Address</label>
          [text present_street id:present_street class:form-control placeholder "Street address"]
        </div>
        <div class="col-md-6">
          <label class="form-label">Address Line 2</label>
          [text present_address_line_2 id:present_address_line_2 class:form-control placeholder "Address line 2"]
        </div>
        <div class="col-md-4">
          <label class="form-label">City</label>
          [text present_city id:present_city class:form-control placeholder "City"]
        </div>
        <div class="col-md-4">
          <label class="form-label">State / Province / Region</label>
          [text present_state id:present_state class:form-control placeholder "State / Province / Region"]
        </div>
        <div class="col-md-2">
          <label class="form-label">ZIP / Postal Code</label>
          [text present_zip id:present_zip class:form-control placeholder "ZIP"]
        </div>
        <div class="col-md-2">
          <label class="form-label">Country</label>
          [text present_country id:present_country class:form-control placeholder "Country"]
        </div>
      </div>
    </div>

    <div class="employment-address-block">
      <h5>Permanent Address</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Street Address</label>
          [text permanent_street id:permanent_street class:form-control placeholder "Street address"]
        </div>
        <div class="col-md-6">
          <label class="form-label">Address Line 2</label>
          [text permanent_address_line_2 id:permanent_address_line_2 class:form-control placeholder "Address line 2"]
        </div>
        <div class="col-md-4">
          <label class="form-label">City</label>
          [text permanent_city id:permanent_city class:form-control placeholder "City"]
        </div>
        <div class="col-md-4">
          <label class="form-label">State / Province / Region</label>
          [text permanent_state id:permanent_state class:form-control placeholder "State / Province / Region"]
        </div>
        <div class="col-md-2">
          <label class="form-label">ZIP / Postal Code</label>
          [text permanent_zip id:permanent_zip class:form-control placeholder "ZIP"]
        </div>
        <div class="col-md-2">
          <label class="form-label">Country</label>
          [text permanent_country id:permanent_country class:form-control placeholder "Country"]
        </div>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Phone*</label>
        [tel* phone id:phone class:form-control placeholder "Phone number"]
      </div>
      <div class="col-md-4">
        <label class="form-label d-block">Are You 18 Years Or Older?*</label>
        [radio is_18_or_older use_label_element default:1 "Yes" "No"]
      </div>
      <div class="col-md-4">
        <label class="form-label d-block">Are You Prevented From Lawfully Becoming Employed In This Country Because Of Visa Or Immigration Status</label>
        [radio lawfully_employed use_label_element default:1 "Yes" "No"]
      </div>
    </div>
  </section>

  <section class="employment-form-section">
    <h4>General</h4>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Subjects of Special Study or Research Work</label>
        [textarea special_study id:special_study class:form-control placeholder "Subjects of special study or research work"]
      </div>
      <div class="col-md-6">
        <label class="form-label">Special Skills</label>
        [textarea special_skills id:special_skills class:form-control placeholder "Special skills"]
      </div>
      <div class="col-12">
        <label class="form-label">Activities: (Civic, Athletic Etc.)</label>
        [textarea activities id:activities class:form-control placeholder "Activities"]
        <small class="captcha-note">Exclude organizations, the name of which indicates the race, creed, sex, age, marital status, color or nation of origin of its members.</small>
      </div>
      <div class="col-md-4">
        <label class="form-label">U. S Military or Naval Service</label>
        [text military_service id:military_service class:form-control placeholder "Military or naval service"]
      </div>
      <div class="col-md-4">
        <label class="form-label">Rank</label>
        [text military_rank id:military_rank class:form-control placeholder "Rank"]
      </div>
      <div class="col-md-4">
        <label class="form-label">Present Membership in National Guard or Reserves</label>
        [text guard_membership id:guard_membership class:form-control placeholder "Membership details"]
      </div>
    </div>
  </section>

  <section class="employment-form-section">
    <h4>Former Employers</h4>
    <p class="employment-inline-note">(List below last three employers starting with last one first).</p>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">Employer 1</div>
      <div class="row g-3 employment-employer-row">
        <div class="col-lg-3 col-md-6">
          <label class="form-label">Date Month &amp; Year (From &amp; To)</label>
          [text employer_dates_1 id:employer_dates_1 class:form-control placeholder "From and to"]
        </div>
        <div class="col-lg-3 col-md-6">
          <label class="form-label">Name and Address of Employer</label>
          [text employer_name_1 id:employer_name_1 class:form-control placeholder "Employer name and address"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Salary</label>
          [text employer_salary_1 id:employer_salary_1 class:form-control placeholder "Salary"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Position</label>
          [text employer_position_1 id:employer_position_1 class:form-control placeholder "Position"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Reason For Leaving</label>
          [text employer_reason_1 id:employer_reason_1 class:form-control placeholder "Reason for leaving"]
        </div>
      </div>
    </div>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">Employer 2</div>
      <div class="row g-3 employment-employer-row">
        <div class="col-lg-3 col-md-6">
          <label class="form-label">Date Month &amp; Year (From &amp; To)</label>
          [text employer_dates_2 id:employer_dates_2 class:form-control placeholder "From and to"]
        </div>
        <div class="col-lg-3 col-md-6">
          <label class="form-label">Name and Address of Employer</label>
          [text employer_name_2 id:employer_name_2 class:form-control placeholder "Employer name and address"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Salary</label>
          [text employer_salary_2 id:employer_salary_2 class:form-control placeholder "Salary"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Position</label>
          [text employer_position_2 id:employer_position_2 class:form-control placeholder "Position"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Reason For Leaving</label>
          [text employer_reason_2 id:employer_reason_2 class:form-control placeholder "Reason for leaving"]
        </div>
      </div>
    </div>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">Employer 3</div>
      <div class="row g-3 employment-employer-row">
        <div class="col-lg-3 col-md-6">
          <label class="form-label">Date Month &amp; Year (From &amp; To)</label>
          [text employer_dates_3 id:employer_dates_3 class:form-control placeholder "From and to"]
        </div>
        <div class="col-lg-3 col-md-6">
          <label class="form-label">Name and Address of Employer</label>
          [text employer_name_3 id:employer_name_3 class:form-control placeholder "Employer name and address"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Salary</label>
          [text employer_salary_3 id:employer_salary_3 class:form-control placeholder "Salary"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Position</label>
          [text employer_position_3 id:employer_position_3 class:form-control placeholder "Position"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Reason For Leaving</label>
          [text employer_reason_3 id:employer_reason_3 class:form-control placeholder "Reason for leaving"]
        </div>
      </div>
    </div>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">Employer 4</div>
      <div class="row g-3 employment-employer-row">
        <div class="col-lg-3 col-md-6">
          <label class="form-label">Date Month &amp; Year (From &amp; To)</label>
          [text employer_dates_4 id:employer_dates_4 class:form-control placeholder "From and to"]
        </div>
        <div class="col-lg-3 col-md-6">
          <label class="form-label">Name and Address of Employer</label>
          [text employer_name_4 id:employer_name_4 class:form-control placeholder "Employer name and address"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Salary</label>
          [text employer_salary_4 id:employer_salary_4 class:form-control placeholder "Salary"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Position</label>
          [text employer_position_4 id:employer_position_4 class:form-control placeholder "Position"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Reason For Leaving</label>
          [text employer_reason_4 id:employer_reason_4 class:form-control placeholder "Reason for leaving"]
        </div>
      </div>
    </div>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">Employer 5</div>
      <div class="row g-3 employment-employer-row">
        <div class="col-lg-3 col-md-6">
          <label class="form-label">Date Month &amp; Year (From &amp; To)</label>
          [text employer_dates_5 id:employer_dates_5 class:form-control placeholder "From and to"]
        </div>
        <div class="col-lg-3 col-md-6">
          <label class="form-label">Name and Address of Employer</label>
          [text employer_name_5 id:employer_name_5 class:form-control placeholder "Employer name and address"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Salary</label>
          [text employer_salary_5 id:employer_salary_5 class:form-control placeholder "Salary"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Position</label>
          [text employer_position_5 id:employer_position_5 class:form-control placeholder "Position"]
        </div>
        <div class="col-lg-2 col-md-4">
          <label class="form-label">Reason For Leaving</label>
          [text employer_reason_5 id:employer_reason_5 class:form-control placeholder "Reason for leaving"]
        </div>
      </div>
    </div>

    <div class="row g-3 employment-best-job-row">
      <div class="col-md-6">
        <label class="form-label">Which Of these Jobs Did You Like Best?</label>
        [text best_job id:best_job class:form-control placeholder "Which job did you like best?"]
      </div>
      <div class="col-md-6">
        <label class="form-label">What Did You Like Most About This Job?</label>
        [text best_job_reason id:best_job_reason class:form-control placeholder "What did you like most?"]
      </div>
    </div>
  </section>

  <section class="employment-form-section">
    <h4>References</h4>
    <p class="employment-inline-note">Give the names of three persons not related to you, whom you have known at least one year.</p>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">Reference 1</div>
      <div class="row g-3">
        <div class="col-md-3">
          <label class="form-label">Name</label>
          [text reference_name_1 id:reference_name_1 class:form-control placeholder "Name"]
        </div>
        <div class="col-md-4">
          <label class="form-label">Address</label>
          [text reference_address_1 id:reference_address_1 class:form-control placeholder "Address"]
        </div>
        <div class="col-md-3">
          <label class="form-label">Business</label>
          [text reference_business_1 id:reference_business_1 class:form-control placeholder "Business"]
        </div>
        <div class="col-md-2">
          <label class="form-label">Years Acquainted</label>
          [text reference_years_1 id:reference_years_1 class:form-control placeholder "Years"]
        </div>
      </div>
    </div>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">Reference 2</div>
      <div class="row g-3">
        <div class="col-md-3">
          <label class="form-label">Name</label>
          [text reference_name_2 id:reference_name_2 class:form-control placeholder "Name"]
        </div>
        <div class="col-md-4">
          <label class="form-label">Address</label>
          [text reference_address_2 id:reference_address_2 class:form-control placeholder "Address"]
        </div>
        <div class="col-md-3">
          <label class="form-label">Business</label>
          [text reference_business_2 id:reference_business_2 class:form-control placeholder "Business"]
        </div>
        <div class="col-md-2">
          <label class="form-label">Years Acquainted</label>
          [text reference_years_2 id:reference_years_2 class:form-control placeholder "Years"]
        </div>
      </div>
    </div>

    <div class="employment-repeat-card">
      <div class="employment-repeat-heading">Reference 3</div>
      <div class="row g-3">
        <div class="col-md-3">
          <label class="form-label">Name</label>
          [text reference_name_3 id:reference_name_3 class:form-control placeholder "Name"]
        </div>
        <div class="col-md-4">
          <label class="form-label">Address</label>
          [text reference_address_3 id:reference_address_3 class:form-control placeholder "Address"]
        </div>
        <div class="col-md-3">
          <label class="form-label">Business</label>
          [text reference_business_3 id:reference_business_3 class:form-control placeholder "Business"]
        </div>
        <div class="col-md-2">
          <label class="form-label">Years Acquainted</label>
          [text reference_years_3 id:reference_years_3 class:form-control placeholder "Years"]
        </div>
      </div>
    </div>
  </section>

  <section class="employment-form-section">
    <h4>State Notice</h4>
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">The Following Statement Applies in: Maryland &amp; Massachusetts. [Fill in name of state.]</label>
        [text state_notice id:state_notice class:form-control placeholder "State name"]
      </div>
      <div class="col-md-4">
        <label class="form-label">It is Unlawful in the state of</label>
        [text lie_detector_state id:lie_detector_state class:form-control placeholder "State name"]
      </div>
      <div class="col-md-4">
        <label class="form-label">Signature</label>
        [text state_notice_signature id:state_notice_signature class:form-control placeholder "Signature"]
      </div>
      <div class="col-12">
        <div class="employment-disclaimer">
          TO REQUIRE OR ADMINISTER A LIE DETECTOR TEST AS A CONDITION OF EMPLOYMENT OR CONTINUED EMPLOYMENT AN EMPLOYER WHO VIOLATES THIS LAW SHALL BE SUBJECT TO CRIMINAL PENALTIES AND CIVIL LIABILITY.
        </div>
      </div>
    </div>
  </section>

  <section class="employment-form-section">
    <h4>In Case Of Emergency Notify</h4>
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Name</label>
        [text emergency_name id:emergency_name class:form-control placeholder "Emergency contact name"]
      </div>
      <div class="col-md-4">
        <label class="form-label">Address</label>
        [text emergency_address id:emergency_address class:form-control placeholder "Emergency contact address"]
      </div>
      <div class="col-md-4">
        <label class="form-label">Phone No</label>
        [tel emergency_phone id:emergency_phone class:form-control placeholder "Emergency contact phone"]
      </div>
    </div>
  </section>

  <section class="employment-form-section">
    <h4>Certification</h4>
    <div class="employment-disclaimer">
      <p>*I certify that all the information submitted by me on this application is true and complete, and I understand that if any false information, omissions, or misrepresentations are discovered, my application may be rejected and, if I am employed, my employment may be terminated at any time.</p>
      <p>In consideration of my employment, I agree to conform to the company&apos;s rules and regulations, and I agree that my employment and compensation can be terminated, with or without cause, and with or without notice, at any time, at either my or the company&apos;s option. I also understand and agree that the terms and conditions of my employment may be changed, with or without cause, and with or without notice, at any time by the company.</p>
      <p>I understand that no company representative, other than its president, and then only when in writing and signed by the president, has any authority to enter into any agreement for employment for any specific period of time or to make any agreement contrary to the foregoing.</p>
    </div>
    <div class="row g-4 employment-certification-row">
      <div class="col-lg-3 col-md-4">
        <label class="form-label">Date</label>
        [date certification_date id:certification_date class:form-control]
      </div>
      <div class="col-lg-5 col-md-8">
        <label class="form-label">Signature</label>
        <div class="employment-signature-field">
          <canvas id="certification_signature_pad" class="employment-signature-pad" width="560" height="150"></canvas>
          [hidden certification_signature id:certification_signature]
          <div class="employment-signature-actions">
            <small class="captcha-note">Sign using your mouse, trackpad, or finger on touch devices.</small>
            <button type="button" class="btn employment-signature-clear" data-signature-clear="certification_signature_pad">Clear Signature</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-4 employment-captcha-row">
      <div class="col-12">
        [sms_consent]
      </div>
      <div class="col-lg-4 col-md-6">
        <label class="form-label">CAPTCHA</label>
        [recaptcha_v2]
      </div>
      <div class="col-12">
        <small class="captcha-note">This form has been designed to strictly comply with State and Federal fair employment practice laws prohibiting employment discrimination. This Application for Employment Form is sold for general use throughout the United States. TOPS assumes no responsibility for the inclusion in said form of any questions which, when asked by the Employer of the Job Applicant, may violate State and/or Federal Law.</small>
      </div>
      <div class="col-12">
        [submit class:btn class:service-cta-btn "Submit Application"]
      </div>
    </div>
  </section>
</div>
CF7;
}

function alpine_get_homepage_hero_cf7_form_template() {
    return <<<'CF7'
<div class="contact-form hero-lead-form">
  <div class="hero-lead-form-head">
    <span class="hero-lead-form-kicker">Send a Message</span>
    <h2 class="h3">Contact form</h2>
    <p>Share your contact details and a short message about how we can help.</p>
  </div>

  <div class="row g-3 hero-lead-form-grid">
    <div class="col-12">
      <label class="form-label">Name</label>
      [text* first_name id:first_name class:form-control placeholder "Full name"]
    </div>
    <div class="col-md-6">
      <label class="form-label">Email</label>
      [email* your_email id:your_email class:form-control placeholder "Email address"]
    </div>
    <div class="col-md-6">
      <label class="form-label">Phone Number</label>
      [tel* your_phone id:your_phone class:form-control placeholder "Phone number"]
    </div>
    <div class="col-12">
      <label class="form-label">Service Address*</label>
      [text* your_address id:your_address class:form-control placeholder "Service address"]
    </div>
    <div class="col-12">
      <label class="form-label">Message</label>
      [textarea your_message id:your_message class:form-control placeholder "How can we help?"]
    </div>
    <div class="col-12">
      [recaptcha_v2]
    </div>
    <div class="col-12">
      [submit class:btn class:hero-form-submit "Submit Form"]
    </div>
  </div>
</div>
CF7;
}

function alpine_get_homepage_hero_cf7_mail_template() {
    return array(
        'active'             => true,
        // Source of truth for the "To" field: alpine_ensure_homepage_hero_cf7_form()
        // rewrites this form's mail settings from here on every init, so
        // editing To in the CF7 admin does not stick.
        'recipient'          => 'info@austinalpine.com',
        'sender'             => 'Alpine Heating & Air Conditioning <wordpress@austinalpine.com>',
        'subject'            => 'Homepage hero form: [first_name]',
        'body'               => "Homepage hero form submission\n\nName: [first_name]\nEmail: [your_email]\nPhone: [your_phone]\nService Address: [your_address]\nMessage: [your_message]",
        'additional_headers' => 'Reply-To: [first_name] <[your_email]>',
        'attachments'        => '',
        'use_html'           => false,
        'exclude_blank'      => false,
    );
}

function alpine_get_contact_form_1_address_field_markup() {
    return <<<'CF7'
    <div class="col-12">
      <label class="form-label">Service Address*</label>
      [text* your_address id:your_address class:form-control placeholder "Service address"]
    </div>
CF7;
}

function alpine_get_contact_form_1_default_template() {
    return <<<'CF7'
<div class="contact-form">
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Name*</label>
      [text* your-name id:your-name class:form-control placeholder "Full name"]
    </div>
    <div class="col-md-6">
      <label class="form-label">Email*</label>
      [email* your-email id:your-email class:form-control placeholder "Email address"]
    </div>
    <div class="col-md-6">
      <label class="form-label">Phone*</label>
      [tel* your-phone id:your-phone class:form-control placeholder "Phone number"]
    </div>
    <div class="col-md-6">
      <label class="form-label">Subject</label>
      [text your-subject id:your-subject class:form-control placeholder "Subject"]
    </div>
    <div class="col-12">
      <label class="form-label">Service Address*</label>
      [text* your_address id:your_address class:form-control placeholder "Service address"]
    </div>
    <div class="col-12">
      <label class="form-label">Message</label>
      [textarea your-message id:your-message class:form-control placeholder "How can we help?"]
    </div>
    <div class="col-12">
      [recaptcha_v2]
    </div>
    <div class="col-12">
      [submit class:btn class:service-cta-btn "Send Message"]
    </div>
  </div>
</div>
CF7;
}

function alpine_contact_form_1_add_address_to_form_markup($form_markup) {
    if (!is_string($form_markup) || trim($form_markup) === '') {
        return alpine_get_contact_form_1_default_template();
    }

    if (strpos($form_markup, 'your_address') !== false || strpos($form_markup, 'your-address') !== false) {
        return $form_markup;
    }

    $address_field = alpine_get_contact_form_1_address_field_markup();
    $updated_form = preg_replace(
        '/(<label[^>]*>\s*(?:Your\s+)?Message\b)/i',
        $address_field . "\n\n$1",
        $form_markup,
        1
    );

    if ($updated_form !== null && $updated_form !== $form_markup) {
        return $updated_form;
    }

    $updated_form = preg_replace('/(\[submit\b)/', $address_field . "\n\n$1", $form_markup, 1);

    if ($updated_form !== null && $updated_form !== $form_markup) {
        return $updated_form;
    }

    return rtrim($form_markup) . "\n\n" . $address_field;
}

function alpine_contact_form_1_add_address_to_mail($mail) {
    if (!is_array($mail)) {
        return $mail;
    }

    $body = isset($mail['body']) && is_string($mail['body']) ? $mail['body'] : '';

    if (strpos($body, '[your_address]') !== false || strpos($body, '[your-address]') !== false) {
        return $mail;
    }

    if ($body === '') {
        $mail['body'] = "Name: [your-name]\nEmail: [your-email]\nPhone: [your-phone]\nService Address: [your_address]\nMessage: [your-message]";
        return $mail;
    }

    if (strpos($body, '[your-phone]') !== false) {
        $mail['body'] = str_replace('[your-phone]', "[your-phone]\nService Address: [your_address]", $body);
        return $mail;
    }

    if (strpos($body, '[your_phone]') !== false) {
        $mail['body'] = str_replace('[your_phone]', "[your_phone]\nService Address: [your_address]", $body);
        return $mail;
    }

    if (strpos($body, '[phone]') !== false) {
        $mail['body'] = str_replace('[phone]', "[phone]\nService Address: [your_address]", $body);
        return $mail;
    }

    $mail['body'] = rtrim($body) . "\nService Address: [your_address]";
    return $mail;
}

function alpine_ensure_contact_form_1_address_field() {
    if (!post_type_exists('wpcf7_contact_form')) {
        return;
    }

    $form_id = alpine_get_cf7_form_id_by_title('Contact form 1');

    if (!$form_id) {
        $form_id = alpine_get_cf7_form_id_by_title('Contact Form 1');
    }

    if (!$form_id) {
        return;
    }

    $form_markup = get_post_meta($form_id, '_form', true);
    $updated_form_markup = alpine_contact_form_1_add_address_to_form_markup($form_markup);

    if ($updated_form_markup !== $form_markup) {
        update_post_meta($form_id, '_form', $updated_form_markup);
    }

    $mail = get_post_meta($form_id, '_mail', true);
    $updated_mail = alpine_contact_form_1_add_address_to_mail($mail);

    if ($updated_mail !== $mail) {
        update_post_meta($form_id, '_mail', $updated_mail);
    }
}

add_action('init', 'alpine_ensure_contact_form_1_address_field', 31);

function alpine_get_employment_cf7_mail_template() {
    return array(
        'active'             => true,
        'recipient'          => 'info@austinalpine.com',
        'sender'             => 'Alpine Heating & Air Conditioning <wordpress@austinalpine.com>',
        'subject'            => 'Employment Application: [first_name] [last_name]',
        'body'               => "Employment application received.\n\nPosition: [position]\nDate you can start: [start_date]\nSalary desired: [salary_desired]\nEmployed now: [employed_now]\nInquire current employer: [inquire_present_employer]\nApplied before: [applied_before]\nWhere applied: [applied_where]\nWhen applied: [applied_when]\nReferred by: [referred_by]\n\nApplicant: [first_name] [last_name]\nPhone: [phone]\n18 or older: [is_18_or_older]\nWork authorization issue: [lawfully_employed]\n\nPresent address: [present_street] [present_address_line_2], [present_city], [present_state], [present_zip], [present_country]\nPermanent address: [permanent_street] [permanent_address_line_2], [permanent_city], [permanent_state], [permanent_zip], [permanent_country]\n\nSpecial study: [special_study]\nSpecial skills: [special_skills]\nActivities: [activities]\nMilitary service: [military_service]\nRank: [military_rank]\nNational Guard / Reserves: [guard_membership]\n\nBest liked job: [best_job]\nWhat they liked most: [best_job_reason]\n\nEmergency contact: [emergency_name] / [emergency_address] / [emergency_phone]\nCertification date: [certification_date]\n\nEducation:\nGrammar School - [education_school_0] | [education_years_0] | [education_graduate_0] | [education_subjects_0]\nHigh School - [education_school_1] | [education_years_1] | [education_graduate_1] | [education_subjects_1]\nCollege - [education_school_2] | [education_years_2] | [education_graduate_2] | [education_subjects_2]\nTrade School - [education_school_3] | [education_years_3] | [education_graduate_3] | [education_subjects_3]\n\nEmployers:\n1. [employer_name_1] | [employer_dates_1] | [employer_salary_1] | [employer_position_1] | [employer_reason_1]\n2. [employer_name_2] | [employer_dates_2] | [employer_salary_2] | [employer_position_2] | [employer_reason_2]\n3. [employer_name_3] | [employer_dates_3] | [employer_salary_3] | [employer_position_3] | [employer_reason_3]\n4. [employer_name_4] | [employer_dates_4] | [employer_salary_4] | [employer_position_4] | [employer_reason_4]\n5. [employer_name_5] | [employer_dates_5] | [employer_salary_5] | [employer_position_5] | [employer_reason_5]\n\nReferences:\n1. [reference_name_1] | [reference_address_1] | [reference_business_1] | [reference_years_1]\n2. [reference_name_2] | [reference_address_2] | [reference_business_2] | [reference_years_2]\n3. [reference_name_3] | [reference_address_3] | [reference_business_3] | [reference_years_3]\n\nState notice: [state_notice]\nLie detector state: [lie_detector_state]\nState notice signature: [state_notice_signature]\n",
        'additional_headers' => alpine_get_employment_cf7_additional_headers(),
        'attachments'        => '',
        'use_html'           => false,
        'exclude_blank'      => false,
    );
}

function alpine_get_employment_cf7_additional_headers() {
    return 'Bcc: offsureit@gmail.com, austinalpineair@gmail.com';
}

function alpine_update_employment_cf7_mail_settings_once($form_id) {
    if (get_option('alpine_employment_cf7_mail_settings_updated')) {
        return;
    }

    $mail = get_post_meta($form_id, '_mail', true);
    if (!is_array($mail)) {
        $mail = alpine_get_employment_cf7_mail_template();
    }

    $mail['recipient'] = 'info@austinalpine.com';
    $mail['additional_headers'] = alpine_get_employment_cf7_additional_headers();
    update_post_meta($form_id, '_mail', $mail);
    update_option('alpine_employment_cf7_mail_settings_updated', true);
    update_option('alpine_employment_cf7_info_recipient_set', true);
}

function alpine_ensure_employment_cf7_form() {
    if (!post_type_exists('wpcf7_contact_form')) {
        return;
    }

    $title = 'Employment Application';

    $form_id = alpine_get_cf7_form_id_by_title($title);
    $form_created = false;

    if (!$form_id) {
        $form_id = wp_insert_post(array(
            'post_title'  => $title,
            'post_status' => 'publish',
            'post_type'   => 'wpcf7_contact_form',
        ));
        $form_created = true;
    }

    if (!$form_id || is_wp_error($form_id)) {
        return;
    }

    update_post_meta($form_id, '_form', alpine_get_employment_cf7_form_template());
    if ($form_created || !get_post_meta($form_id, '_mail', true)) {
        update_post_meta($form_id, '_mail', alpine_get_employment_cf7_mail_template());
    }
    if ($form_created || !get_post_meta($form_id, '_mail_2', true)) {
        update_post_meta($form_id, '_mail_2', array('active' => false));
    }
    alpine_update_employment_cf7_mail_settings_once($form_id);
    update_post_meta($form_id, '_messages', array());
    update_post_meta($form_id, '_additional_settings', '');
}

add_action('init', 'alpine_ensure_employment_cf7_form', 30);

function alpine_ensure_homepage_hero_cf7_form() {
    if (!post_type_exists('wpcf7_contact_form')) {
        return;
    }

    $title = 'Homepage Hero Form';

    $form_id = alpine_get_cf7_form_id_by_title($title);

    if (!$form_id) {
        $form_id = wp_insert_post(array(
            'post_title'  => $title,
            'post_status' => 'publish',
            'post_type'   => 'wpcf7_contact_form',
        ));
    }

    if (!$form_id || is_wp_error($form_id)) {
        return;
    }

    update_post_meta($form_id, '_form', alpine_get_homepage_hero_cf7_form_template());
    update_post_meta($form_id, '_mail', alpine_get_homepage_hero_cf7_mail_template());
    update_post_meta($form_id, '_mail_2', array('active' => false));
    update_post_meta($form_id, '_messages', array());
    update_post_meta($form_id, '_additional_settings', '');
}

add_action('init', 'alpine_ensure_homepage_hero_cf7_form', 30);

?>
