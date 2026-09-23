<?php
/**
 * SMS consent opt-ins for Contact Form 7 forms.
 *
 * Two separate, optional checkboxes: transactional service updates and
 * promotional messages. Keeping them apart is the point — consent to one is
 * never consent to the other, and neither is required to submit the form.
 *
 * Every CF7 form that collects a phone number gets them automatically,
 * inserted directly before the reCAPTCHA widget (or before the submit button
 * when a form has no CAPTCHA). New forms inherit them with no extra work.
 *
 * A form that needs them somewhere else can place the [sms_consent] form-tag in
 * its template; the auto-insert sees the rendered block and skips that form, so
 * it never appears twice.
 */

/**
 * Wording version recorded against every logged consent. Bump it whenever the
 * disclosure text below changes, so old log rows keep pointing at the wording
 * that was actually on screen when the customer agreed.
 */
if (!defined('ALPINE_SMS_CONSENT_TEXT_VERSION')) {
    define('ALPINE_SMS_CONSENT_TEXT_VERSION', '2026-09-23');
}

function alpine_get_sms_consent_privacy_url() {
    $url = function_exists('get_privacy_policy_url') ? get_privacy_policy_url() : '';

    return $url ? $url : home_url('/privacy-policy/');
}

/**
 * The two opt-ins, kept separate so a customer can accept service messages
 * without accepting marketing. Both are optional: neither is enforced on
 * submit, and unchecking both must not block the form.
 */
function alpine_get_sms_consent_options() {
    return array(
        array(
            'name'  => 'sms-consent-service',
            'title' => 'Service Updates (Optional)',
            'text'  => 'I agree to receive SMS messages from Alpine Heating and Air Conditioning regarding appointments, technician arrivals, service updates and customer support. Message frequency varies. Message and data rates may apply. Reply STOP to opt out or HELP for help.',
        ),
        array(
            'name'  => 'sms-consent-promotional',
            'title' => 'Promotional Messages (Optional)',
            'text'  => 'I agree to receive promotional SMS messages from Alpine Heating and Air Conditioning, including special offers, discounts and seasonal maintenance promotions. Message frequency varies. Message and data rates may apply. Reply STOP to opt out or HELP for help. Consent is not a condition of purchase.',
        ),
    );
}

function alpine_get_sms_consent_markup() {
    $rows = '';

    foreach (alpine_get_sms_consent_options() as $option) {
        $rows .= sprintf(
            '<span class="wpcf7-form-control-wrap" data-name="%1$s"><label class="alpine-sms-consent-label"><input type="checkbox" name="%1$s" value="1" class="alpine-sms-consent-checkbox wpcf7-form-control"> <span class="alpine-sms-consent-text"><strong class="alpine-sms-consent-title">%2$s</strong> %3$s</span></label></span>',
            esc_attr($option['name']),
            esc_html($option['title']),
            esc_html($option['text'])
        );
    }

    // Unchecked checkboxes post nothing, so without this marker a submission
    // that declined both boxes is indistinguishable from a form that never
    // showed them. The consent log needs to tell those two apart.
    $marker = sprintf(
        '<input type="hidden" name="sms-consent-shown" value="%s">',
        esc_attr(ALPINE_SMS_CONSENT_TEXT_VERSION)
    );

    // A span, not a div: CF7 wraps rendered tags in <p>, and a block-level
    // element there makes the browser close the paragraph early.
    return sprintf(
        '<span class="alpine-sms-consent">%s%s<span class="alpine-sms-consent-privacy">See our <a href="%s">Privacy Policy</a> for details on SMS alerts.</span></span>',
        $rows,
        $marker,
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

/**
 * Both opt-ins are optional, so there is deliberately no wpcf7_validate filter
 * here: a submission with neither box checked is valid. The checked values ride
 * along in the posted data under sms-consent-service / sms-consent-promotional.
 */
