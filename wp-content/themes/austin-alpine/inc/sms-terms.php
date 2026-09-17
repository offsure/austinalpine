<?php
/**
 * SMS Terms & Conditions at /sms-terms/.
 * Saved once per version so subsequent WordPress editor changes are preserved.
 */
define('ALPINE_SMS_TERMS_VERSION', '2026-09-16');

function alpine_get_sms_terms_content() {
    return <<<'HTML'
<!-- wp:group {"className":"alpine-legal-content"} -->
<div class="wp-block-group alpine-legal-content">
<!-- wp:paragraph -->
<p><strong>Alpine Heating and Air Conditioning, LLC</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>SMS Messaging Program</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>By opting in to receive SMS messages from Alpine Heating and Air Conditioning, LLC (“Alpine Heating and Air Conditioning,” “Alpine,” “we,” “us,” or “our”), you agree to receive text messages related to our heating, ventilation, and air conditioning services.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>Depending on your communication preferences and consent, messages may include:</p>
<!-- /wp:paragraph -->
<!-- wp:list -->
<ul>
<li>Appointment confirmations and reminders</li>
<li>Technician arrival and “on the way” notifications</li>
<li>Service status and completion updates</li>
<li>Scheduling and rescheduling information</li>
<li>Responses to customer questions and two-way customer service communications</li>
<li>Service recommendations</li>
<li>Promotional offers, seasonal specials, and other marketing communications where you have separately consented to receive marketing messages</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Message Frequency</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Message frequency varies depending on your interactions with Alpine Heating and Air Conditioning, scheduled services, and communication preferences.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Message and Data Rates</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Message and data rates may apply. Your mobile carrier's standard messaging and data rates may apply to messages sent or received.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Opting Out</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>You may opt out of SMS communications at any time by replying <strong>STOP</strong> to any message.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>After you send <strong>STOP</strong>, you may receive a confirmation message indicating that you have been unsubscribed. You will no longer receive SMS messages from that messaging program unless you opt in again.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Help</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>For assistance, reply <strong>HELP</strong> to any SMS message or contact Alpine Heating and Air Conditioning at:</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><strong>Phone:</strong> <a href="tel:+15127594247">512.759.4247</a><br><strong>Email:</strong> <a href="mailto:info@austinalpine.com">info@austinalpine.com</a><br><strong>Website:</strong> <a href="https://austinalpine.com">https://austinalpine.com</a></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Marketing Messages</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Promotional or marketing SMS messages are sent only to customers who have provided consent to receive such messages.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>Consent to receive marketing text messages is not required as a condition of purchasing products or services from Alpine Heating and Air Conditioning.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>Customers who provide a phone number for appointment scheduling, service notifications, or customer service communications are not automatically enrolled in promotional SMS messaging unless they separately consent to receive marketing messages.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Supported Carriers</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>SMS delivery is subject to your wireless carrier's network availability. Wireless carriers are not liable for delayed or undelivered messages.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Privacy</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Your privacy is important to us. Information collected through our SMS program is handled in accordance with our Privacy Policy.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><strong>Privacy Policy:</strong> <a href="https://austinalpine.com/privacy-policy">Privacy Policy | Alpine Heating &amp; Air Conditioning</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>Mobile information, SMS opt-in data, and messaging consent will not be sold or shared with third parties or affiliates for their marketing or promotional purposes.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>We may share information with service providers that assist us in delivering SMS communications, such as messaging platforms and telecommunications providers, solely as necessary to provide the messaging service.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Changes to These Terms</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Alpine Heating and Air Conditioning may update these SMS Terms &amp; Conditions from time to time. Updates will be posted on this page with the revised effective date.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><strong>Effective Date:</strong> September 16, 2026</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML;
}

function alpine_ensure_sms_terms_page() {
    if (get_option('alpine_sms_terms_content_version') === ALPINE_SMS_TERMS_VERSION) {
        return;
    }

    $page = get_page_by_path('sms-terms', OBJECT, 'page');
    $postarr = array(
        'post_title'   => 'SMS Terms & Conditions',
        'post_content' => alpine_get_sms_terms_content(),
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_name'    => 'sms-terms',
    );

    if ($page) {
        $postarr['ID'] = $page->ID;
        $page_id = wp_update_post(wp_slash($postarr), true);
    } else {
        $page_id = wp_insert_post(wp_slash($postarr), true);
    }

    if (is_wp_error($page_id) || !$page_id) {
        return;
    }

    update_option('alpine_sms_terms_content_version', ALPINE_SMS_TERMS_VERSION);
}
add_action('init', 'alpine_ensure_sms_terms_page', 32);
