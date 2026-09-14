<?php
/**
 * SMS consent disclaimer for Contact Form 7 forms.
 *
 * Every CF7 form that collects a phone number gets the disclaimer automatically,
 * inserted directly before the reCAPTCHA widget (or before the submit button
 * when a form has no CAPTCHA). New forms inherit it with no extra work.
 *
 * A form that needs the disclaimer somewhere else can place the [sms_consent]
 * form-tag in its template; the auto-insert sees the rendered disclaimer and
 * skips that form, so it never appears twice.
 */

function alpine_get_sms_consent_privacy_url() {
    $url = function_exists('get_privacy_policy_url') ? get_privacy_policy_url() : '';

    return $url ? $url : home_url('/privacy-policy/');
}

function alpine_get_sms_consent_markup() {
    return sprintf(
        '<p class="alpine-sms-consent">By submitting this form, you agree to receive SMS informational text messages from Alpine Heating and Air Conditioning, LLC at the number provided. Consent is not a condition of purchase. Message frequency may vary. Standard message and data rates may apply. We will not share your mobile information with third parties for marketing purposes. Reply STOP to opt-out at any time. Refer to our <a href="%s">Privacy Policy</a> for details on SMS alerts.</p>',
        esc_url(alpine_get_sms_consent_privacy_url())
    );
}

function alpine_register_sms_consent_form_tag() {
    if (!function_exists('wpcf7_add_form_tag')) {
        return;
    }

    wpcf7_add_form_tag(array('sms_consent', 'sms-consent'), 'alpine_get_sms_consent_markup', array(
        'display-block' => true,
    ));
}
add_action('wpcf7_init', 'alpine_register_sms_consent_form_tag', 20);

/**
 * True when the form has a tel field, or a text field named like a phone number.
 */
function alpine_cf7_form_collects_phone($form_html) {
    if (false !== strpos($form_html, 'type="tel"')) {
        return true;
    }

    $contact_form = function_exists('wpcf7_get_current_contact_form') ? wpcf7_get_current_contact_form() : null;

    if (!$contact_form instanceof WPCF7_ContactForm) {
        return false;
    }

    foreach ($contact_form->scan_form_tags() as $tag) {
        if ('tel' === $tag->basetype) {
            return true;
        }

        if ('text' === $tag->basetype && preg_match('/phone|mobile|cell/i', $tag->name)) {
            return true;
        }
    }

    return false;
}

function alpine_insert_sms_consent_into_cf7_form($form_html) {
    if (!is_string($form_html) || '' === $form_html) {
        return $form_html;
    }

    // Already placed via [sms_consent], or pasted into the form by hand.
    if (false !== strpos($form_html, 'alpine-sms-consent') || false !== stripos($form_html, 'Consent is not a condition of purchase')) {
        return $form_html;
    }

    if (!alpine_cf7_form_collects_phone($form_html)) {
        return $form_html;
    }

    $anchors = array(
        // Rendered reCAPTCHA v2 widget (see alpine_render_recaptcha_v2_form_tag).
        '/<span class="wpcf7-form-control-wrap" data-name="g-recaptcha-response">/',
        // Unrendered token when reCAPTCHA keys are not configured.
        '/\[recaptcha(?:_|-)v2[^\]]*\]/',
        '/<input\b[^>]*\bwpcf7-submit\b[^>]*>/',
        '/<button\b[^>]*type="submit"[^>]*>/',
    );

    foreach ($anchors as $anchor) {
        if (preg_match($anchor, $form_html, $match, PREG_OFFSET_CAPTURE)) {
            return substr_replace($form_html, alpine_get_sms_consent_markup(), $match[0][1], 0);
        }
    }

    return $form_html . alpine_get_sms_consent_markup();
}
// After alpine_replace_recaptcha_v2_form_tokens (30) so the widget markup is final.
add_filter('wpcf7_form_elements', 'alpine_insert_sms_consent_into_cf7_form', 40);
