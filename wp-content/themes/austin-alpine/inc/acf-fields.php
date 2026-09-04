<?php
/**
 * ACF field registration + safe getter helpers.
 *
 * Fields are registered in code (acf_add_local_field_group) so they are
 * version-controlled with the theme. Every template reads them through the
 * helper getters below, which fall back to the original hard-coded copy when a
 * field is empty — so the site renders identically out of the box and degrades
 * gracefully if ACF is ever deactivated.
 *
 * NOTE: This site runs ACF free (6.8.2). Options Pages are supported, but
 * Repeater/Flexible Content are not, so multi-row content (hero slides, service
 * cards, why-us cards) is modelled as a fixed set of numbered fields.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * Getter helpers
 * ---------------------------------------------------------------------- */

/**
 * Resolve the ID of the private "Site Settings" page that stores global fields.
 *
 * This site runs ACF free, which has no Options Pages, so global business info
 * is stored on a dedicated private page instead.
 */
function alpine_get_settings_page_id() {
	static $cached = null;

	if ( null !== $cached ) {
		return $cached;
	}

	$page_id = (int) get_option( 'alpine_site_settings_page_id' );

	if ( $page_id && 'page' === get_post_type( $page_id ) ) {
		$cached = $page_id;
		return $cached;
	}

	$page = get_page_by_path( 'site-settings', OBJECT, 'page' );

	if ( $page instanceof WP_Post ) {
		update_option( 'alpine_site_settings_page_id', (int) $page->ID );
		$cached = (int) $page->ID;
		return $cached;
	}

	$cached = 0;
	return $cached;
}

/**
 * Read a Site Settings value (stored on the Site Settings page) with a fallback.
 */
function alpine_get_setting( $name, $default = '' ) {
	if ( function_exists( 'get_field' ) ) {
		$page_id = alpine_get_settings_page_id();

		if ( $page_id ) {
			$value = get_field( $name, $page_id );

			if ( null !== $value && '' !== $value && false !== $value ) {
				return $value;
			}
		}
	}

	return $default;
}

/**
 * Read a field stored on the front page with a fallback default.
 */
function alpine_get_home_field( $name, $default = '' ) {
	if ( function_exists( 'get_field' ) ) {
		$page_id = is_front_page() ? get_queried_object_id() : 0;

		if ( ! $page_id ) {
			$page_id = (int) get_option( 'page_on_front' );
		}

		if ( $page_id ) {
			$value = get_field( $name, $page_id );

			if ( null !== $value && '' !== $value && false !== $value ) {
				return $value;
			}
		}
	}

	return $default;
}

/**
 * Build a tel: href from a human-readable phone number.
 */
function alpine_tel_href( $display ) {
	$digits = preg_replace( '/\D+/', '', (string) $display );

	if ( 10 === strlen( $digits ) ) {
		$digits = '1' . $digits;
	}

	return 'tel:+' . $digits;
}

/* -------------------------------------------------------------------------
 * Small field-array builders to keep registration DRY
 * ---------------------------------------------------------------------- */

function alpine_acf_field( $key, $name, $label, $type = 'text', $default = '', $extra = array() ) {
	$field = array(
		'key'   => 'field_alpine_' . $key,
		'label' => $label,
		'name'  => $name,
		'type'  => $type,
	);

	if ( 'image' === $type ) {
		$field['return_format'] = 'url';
		$field['preview_size']  = 'medium';
		$field['library']       = 'all';
	} elseif ( 'textarea' === $type ) {
		$field['default_value'] = $default;
		$field['rows']          = 3;
		$field['new_lines']     = '';
	} else {
		$field['default_value'] = $default;
	}

	return array_merge( $field, $extra );
}

function alpine_acf_tab( $key, $label ) {
	return array(
		'key'       => 'field_alpine_tab_' . $key,
		'label'     => $label,
		'name'      => '',
		'type'      => 'tab',
		'placement' => 'top',
	);
}

/* -------------------------------------------------------------------------
 * Site Settings page (free-ACF stand-in for an Options Page)
 * ---------------------------------------------------------------------- */

/**
 * Ensure a private "Site Settings" page exists to host the global field group.
 * Runs before acf/init (priority 5) so the field group can bind to its ID.
 */
add_action( 'init', 'alpine_ensure_site_settings_page', 1 );
function alpine_ensure_site_settings_page() {
	$existing = get_page_by_path( 'site-settings', OBJECT, 'page' );

	if ( $existing instanceof WP_Post ) {
		if ( (int) get_option( 'alpine_site_settings_page_id' ) !== (int) $existing->ID ) {
			update_option( 'alpine_site_settings_page_id', (int) $existing->ID );
		}
		return;
	}

	$page_id = wp_insert_post(
		array(
			'post_title'   => 'Site Settings',
			'post_name'    => 'site-settings',
			'post_status'  => 'private',
			'post_type'    => 'page',
			'post_content' => 'Global business info used across the site (phone, email, address, hours, social links). Edit the fields below.',
		)
	);

	if ( $page_id && ! is_wp_error( $page_id ) ) {
		update_option( 'alpine_site_settings_page_id', (int) $page_id );
	}
}

/* -------------------------------------------------------------------------
 * Field groups
 * ---------------------------------------------------------------------- */

add_action( 'acf/init', 'alpine_register_acf_field_groups' );
function alpine_register_acf_field_groups() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	alpine_register_site_settings_fields();
	alpine_register_homepage_fields();
	alpine_register_landing_page_fields();
}

/**
 * Global business info shown sitewide (header, footer, contact blocks).
 */
function alpine_register_site_settings_fields() {
	$fields = array(
		alpine_acf_tab( 'contact', 'Contact' ),
		alpine_acf_field( 'phone_number', 'phone_number', 'Phone Number (display)', 'text', '(512) 759-4247' ),
		alpine_acf_field( 'email_general', 'email_general', 'General Email', 'email', 'info@austinalpine.com' ),
		alpine_acf_field( 'email_commercial', 'email_commercial', 'Commercial Email', 'email', 'commercial@austinalpine.com' ),
		alpine_acf_field( 'address', 'address', 'Street Address', 'text', '1205 Sheldon Cove Bldg. 2, Ste. J., Austin, TX 78753' ),
		alpine_acf_field( 'license_residential', 'license_residential', 'Residential License #', 'text', 'TACLB 21462E' ),
		alpine_acf_field( 'license_commercial', 'license_commercial', 'Commercial License #', 'text', 'TACLA146295E' ),
		alpine_acf_field( 'hours_weekday', 'hours_weekday', 'Weekday Hours', 'text', 'Mon - Fri: 7:00 AM - 7:00 PM' ),
		alpine_acf_field( 'hours_weekend', 'hours_weekend', 'Weekend Hours', 'text', 'Saturday-Sunday: Emergency services available' ),
		alpine_acf_field( 'header_cta_label', 'header_cta_label', 'Header "Request Estimate" Label', 'text', 'Request Estimate' ),

		alpine_acf_tab( 'social', 'Social Links' ),
		alpine_acf_field( 'facebook_url', 'facebook_url', 'Facebook URL', 'url', 'https://www.facebook.com/austinalpine/' ),
		alpine_acf_field( 'yelp_url', 'yelp_url', 'Yelp URL', 'url', 'https://www.yelp.com/biz/alpine-heating-and-air-conditioning-austin' ),
		alpine_acf_field( 'twitter_url', 'twitter_url', 'X / Twitter URL', 'url', 'https://twitter.com/austinalpineair' ),
	);

	$settings_page_id = alpine_get_settings_page_id();

	acf_add_local_field_group(
		array(
			'key'      => 'group_alpine_site_settings',
			'title'    => 'Site Settings',
			'fields'   => $fields,
			'location' => array(
				array(
					array(
						'param'    => 'page',
						'operator' => '==',
						'value'    => (string) $settings_page_id,
					),
				),
			),
			'menu_order'            => 0,
			'hide_on_screen'        => array( 'the_content', 'featured_image', 'discussion', 'comments', 'author', 'format', 'page_attributes', 'revisions', 'slug' ),
		)
	);
}

/**
 * Homepage (front page) content fields.
 */
function alpine_register_homepage_fields() {
	$fields = array();

	/* --- Hero --- */
	$fields[] = alpine_acf_tab( 'hero', 'Hero' );
	$fields[] = alpine_acf_field( 'hero_slide_1_eyebrow', 'hero_slide_1_eyebrow', 'Slide 1 — Eyebrow', 'text', 'Keeping You Cool in Austin' );
	$fields[] = alpine_acf_field( 'hero_slide_1_title', 'hero_slide_1_title', 'Slide 1 — Title', 'text', 'Trusted HVAC Experts Serving Austin and Surrounding Areas' );
	$fields[] = alpine_acf_field( 'hero_slide_1_subtitle', 'hero_slide_1_subtitle', 'Slide 1 — Subtitle', 'textarea', 'Consistently reliable heating and air conditioner services for homes and businesses across Central Texas. We respond quickly, diagnose issues accurately, and give you clear next steps so you’re never left guessing.' );
	$fields[] = alpine_acf_field( 'hero_slide_2_eyebrow', 'hero_slide_2_eyebrow', 'Slide 2 — Eyebrow', 'text', 'Heating And Cooling Help' );
	$fields[] = alpine_acf_field( 'hero_slide_2_title', 'hero_slide_2_title', 'Slide 2 — Title', 'text', 'Cooling and Heating Experts You Can Trust' );
	$fields[] = alpine_acf_field( 'hero_slide_2_subtitle', 'hero_slide_2_subtitle', 'Slide 2 — Subtitle', 'textarea', 'Trusted HVAC repair, installation, and maintenance for Austin homes and businesses. Our licensed team delivers fast service, honest recommendations, and dependable heating and cooling solutions to keep your property comfortable year round.' );

	$hero_features = array(
		array( 'Expert Technicians', 'Trust us to deliver reliable solutions and exceptional service.' ),
		array( '24/7 Emergency', 'Immediate support for urgent HVAC issues.' ),
		array( 'Transparent Pricing', 'No hidden costs, clear and honest quotes.' ),
	);
	foreach ( $hero_features as $i => $feature ) {
		$n        = $i + 1;
		$fields[] = alpine_acf_field( "hero_feature_{$n}_title", "hero_feature_{$n}_title", "Feature {$n} — Title", 'text', $feature[0] );
		$fields[] = alpine_acf_field( "hero_feature_{$n}_text", "hero_feature_{$n}_text", "Feature {$n} — Text", 'text', $feature[1] );
	}

	/* --- About --- */
	$fields[] = alpine_acf_tab( 'about', 'About' );
	$fields[] = alpine_acf_field( 'about_tag', 'about_tag', 'Section Tag', 'text', 'About Us' );
	$fields[] = alpine_acf_field( 'about_title', 'about_title', 'Title', 'text', 'Air Conditioning and Heating Specialists' );
	$fields[] = alpine_acf_field( 'about_para_1', 'about_para_1', 'Paragraph 1', 'textarea', 'We combine modern tools with years of hands-on experience to provide dependable heating, ventilation and air conditioning services for homes and businesses.' );
	$fields[] = alpine_acf_field( 'about_para_2', 'about_para_2', 'Paragraph 2', 'textarea', 'From installation and regular maintenance to urgent repairs, our goal is simple: comfort, safety and efficiency you can trust.' );
	$fields[] = alpine_acf_field( 'about_button_label', 'about_button_label', 'Button Label', 'text', 'About Company' );
	$fields[] = alpine_acf_field( 'about_image', 'about_image', 'Image', 'image' );

	/* --- Services --- */
	$fields[] = alpine_acf_tab( 'services', 'Services' );
	$fields[] = alpine_acf_field( 'services_tag', 'services_tag', 'Section Tag', 'text', 'Complete Solutions' );
	$fields[] = alpine_acf_field( 'services_title', 'services_title', 'Title', 'text', 'Our Services' );
	$fields[] = alpine_acf_field( 'services_intro', 'services_intro', 'Intro', 'textarea', 'Comprehensive solutions for residential and commercial HVAC systems.' );

	$service_cards = array(
		array( 'AC Installation', 'Install high-efficiency cooling equipment sized for your home and built for Austin heat.' ),
		array( 'Heating Maintenance', 'Keep your furnace or heater efficient, safe, and ready for colder weather with seasonal service.' ),
		array( 'AC Repair', 'Restore cooling fast with expert diagnostics and reliable repairs for all major AC systems.' ),
		array( 'AC Maintenance', 'Reduce breakdown risk and improve efficiency with regular tune-ups and preventive cooling care.' ),
		array( 'Heating Installation', 'Upgrade home comfort with professionally installed heating systems tailored to your space.' ),
		array( 'Indoor Air Quality', 'Improve filtration, purification, and whole-home comfort with cleaner indoor air solutions.' ),
		array( 'Heating Repair', 'Fix no-heat issues, uneven performance, and worn components before comfort drops further.' ),
		array( 'Ductless Mini-Splits', 'Install, repair, and maintain ductless systems for efficient zoned heating and cooling.' ),
	);
	foreach ( $service_cards as $i => $card ) {
		$n        = $i + 1;
		$fields[] = alpine_acf_field( "service_{$n}_title", "service_{$n}_title", "Card {$n} — Title", 'text', $card[0] );
		$fields[] = alpine_acf_field( "service_{$n}_text", "service_{$n}_text", "Card {$n} — Text", 'textarea', $card[1] );
		$fields[] = alpine_acf_field( "service_{$n}_image", "service_{$n}_image", "Card {$n} — Image (optional)", 'image' );
	}

	/* --- Why Choose Us --- */
	$fields[] = alpine_acf_tab( 'why', 'Why Choose Us' );
	$fields[] = alpine_acf_field( 'why_tag', 'why_tag', 'Section Tag', 'text', 'Top 6 Reasons' );
	$fields[] = alpine_acf_field( 'why_title', 'why_title', 'Title', 'text', 'Why Choose Us' );
	$fields[] = alpine_acf_field( 'why_intro', 'why_intro', 'Intro', 'textarea', 'Homeowners across the Greater Austin area choose Alpine Heating & Air Conditioning for reliable service, honest communication, and solutions designed for long-term comfort.' );

	$why_cards = array(
		array( 'Expert Technicians', '<b>Our certified HVAC technicians bring years of hands-on experience servicing homes throughout Austin, including areas like Tarrytown, Westlake, and Circle C Ranch.</b> We diagnose issues quickly and accurately, whether it’s a struggling AC unit in peak summer heat or a heating system that isn’t performing when temperatures dip. Every technician is trained on modern, energy-efficient systems and proven repair methods to ensure the job is done right the first time. When you work with us, you’re getting professionals who understand local homes, climate demands, and how to keep your system running efficiently year-round.' ),
		array( 'Flexible Scheduling', '<b>HVAC problems don’t always happen on a schedule, and we don’t expect you to rearrange your life to fix them. We offer flexible appointment times for homeowners across Bee Cave, Lakeway, and Steiner Ranch, making it easy to get service when it works for you.</b> Whether you need a same-day visit, a scheduled repair, or routine maintenance, we provide reliable time windows and responsive service. Our goal is simple—make the process easy, convenient, and stress-free from start to finish.' ),
		array( 'Transparent Pricing', 'We believe homeowners deserve clear, honest pricing without confusion or surprises. Before any work begins, you’ll receive a detailed breakdown of costs so you know exactly what to expect. <b>From AC repairs in Round Rock to full system replacements in Cedar Park, our pricing remains consistent, fair, and easy to understand.</b> No hidden fees, no unnecessary upsells—just straightforward service that builds trust and long-term relationships.' ),
		array( 'Quality Parts', 'We use high-quality, manufacturer-approved parts designed to handle the demands of Central Texas weather. <b>Whether we’re servicing a system in South Austin or installing new equipment in Pflugerville, every component we use is selected for durability and performance.</b> From compressors to thermostats, we focus on long-term reliability to reduce breakdowns and extend the life of your system. Better parts mean fewer issues and more consistent comfort in your home.' ),
		array( 'Emergency Services', '<b>When your HVAC system fails, timing matters. We provide fast, responsive emergency services for homeowners in areas like Mueller, Hyde Park, and East Austin.</b> Whether your AC goes out during extreme heat or your heater stops working on a cold night, we’re ready to respond quickly and restore comfort. Our team arrives prepared to diagnose and resolve urgent issues so you’re not left dealing with unsafe or uncomfortable conditions.' ),
		array( 'Satisfaction Guarantee', 'We stand behind every service we provide, from small repairs to full system installations. <b>Homeowners in West Lake Hills, Rollingwood, and Barton Creek trust us because we focus on doing the job right, not just getting it done.</b> If something doesn’t meet expectations, we address it promptly and professionally. Our commitment is simple—deliver quality work, clear communication, and results you can rely on long after the service is complete.' ),
	);
	foreach ( $why_cards as $i => $card ) {
		$n        = $i + 1;
		$fields[] = alpine_acf_field( "why_card_{$n}_title", "why_card_{$n}_title", "Reason {$n} — Title", 'text', $card[0] );
		$fields[] = alpine_acf_field( "why_card_{$n}_text", "why_card_{$n}_text", "Reason {$n} — Text (allows <b>)", 'textarea', $card[1] );
	}

	$fields[] = alpine_acf_field( 'promo_heading', 'promo_heading', 'Promo Box — Heading', 'textarea', 'Alpine Heating & Air Conditioning specializes in dependable heating, cooling, and indoor air quality solutions tailored to homes and businesses across the Greater Austin area.' );
	$fields[] = alpine_acf_field( 'promo_button_label', 'promo_button_label', 'Promo Box — Button Label', 'text', 'Schedule Now' );

	/* --- Equipment --- */
	$fields[] = alpine_acf_tab( 'equipment', 'Equipment' );
	$fields[] = alpine_acf_field( 'equipment_tag', 'equipment_tag', 'Section Tag', 'text', 'Trusted Systems' );
	$fields[] = alpine_acf_field( 'equipment_title', 'equipment_title', 'Title', 'text', 'Our Parts and Equipment' );
	$fields[] = alpine_acf_field( 'equipment_intro', 'equipment_intro', 'Intro', 'textarea', 'We install and service dependable HVAC equipment, including Carrier parts, built for long-term comfort, efficiency, and reliable performance.' );
	$fields[] = alpine_acf_field( 'equipment_card_title', 'equipment_card_title', 'Card Kicker', 'text', 'Featured Carrier Parts' );
	$fields[] = alpine_acf_field( 'equipment_card_text', 'equipment_card_text', 'Card Text', 'textarea', 'We feature Carrier parts and equipment from a trusted brand known for dependable heating and cooling performance.' );

	/* --- Reviews + CTA --- */
	$fields[] = alpine_acf_tab( 'reviews_cta', 'Reviews & CTA' );
	$fields[] = alpine_acf_field( 'reviews_tag', 'reviews_tag', 'Reviews — Section Tag', 'text', 'Google Reviews' );
	$fields[] = alpine_acf_field( 'reviews_title', 'reviews_title', 'Reviews — Title', 'text', 'Real Reviews From Austin Homeowners' );
	$fields[] = alpine_acf_field( 'reviews_intro', 'reviews_intro', 'Reviews — Intro', 'textarea', 'Trusted feedback from customers who count on Alpine Heating & Air Conditioning for dependable service, clear communication, and lasting comfort.' );
	$fields[] = alpine_acf_field( 'cta_heading', 'cta_heading', 'CTA Banner — Heading', 'text', 'Need emergency repair service?' );

	acf_add_local_field_group(
		array(
			'key'      => 'group_alpine_homepage',
			'title'    => 'Homepage Content',
			'fields'   => $fields,
			'location' => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order' => 0,
		)
	);
}

/* -------------------------------------------------------------------------
 * Data-driven landing pages (service / business / commercial / service-area)
 *
 * Each of these page families renders from a slug-keyed PHP data array through
 * a shared renderer. Rather than rewrite dozens of templates, we register one
 * ACF field group per family and OVERLAY any saved ACF values on top of the
 * coded defaults at render time. Leave a field blank to keep the coded text.
 * ---------------------------------------------------------------------- */

/**
 * True when an ACF value is meaningfully set (not null/empty/false/empty-array).
 */
function alpine_acf_nonempty( $value ) {
	if ( null === $value || false === $value || '' === $value ) {
		return false;
	}

	if ( is_array( $value ) && 0 === count( $value ) ) {
		return false;
	}

	return true;
}

/**
 * Schema describing a landing-page family's editable content.
 *
 * kinds: text | textarea | paras (one paragraph per line) | list (one item per
 * line) | rows (repeating block, fixed max) | group (single sub-field block).
 */
function alpine_landing_schema( $family ) {
	$panel_sub = array(
		array( 'key' => 'label', 'label' => 'Label', 'kind' => 'text' ),
		array( 'key' => 'title', 'label' => 'Title', 'kind' => 'text' ),
		array( 'key' => 'body', 'label' => 'Body', 'kind' => 'textarea' ),
		array( 'key' => 'link_text', 'label' => 'Button Text', 'kind' => 'text' ),
	);
	$feature_sub = array(
		array( 'key' => 'title', 'label' => 'Title', 'kind' => 'text' ),
		array( 'key' => 'body', 'label' => 'Body', 'kind' => 'textarea' ),
	);

	switch ( $family ) {
		case 'service':
			return array(
				array( 'key' => 'hero_chip', 'label' => 'Hero Chip', 'kind' => 'text' ),
				array( 'key' => 'hero_title', 'label' => 'Hero Title', 'kind' => 'text' ),
				array( 'key' => 'hero_breadcrumb', 'label' => 'Hero Breadcrumb', 'kind' => 'text' ),
				array( 'key' => 'intro_title', 'label' => 'Intro Title (HTML allowed)', 'kind' => 'textarea' ),
				array( 'key' => 'intro', 'label' => 'Intro Paragraphs', 'kind' => 'paras' ),
				array( 'key' => 'features', 'label' => 'Feature', 'kind' => 'rows', 'max' => 6, 'sub' => $feature_sub ),
				array( 'key' => 'panel_one', 'label' => 'Panel One', 'kind' => 'group', 'sub' => $panel_sub ),
				array( 'key' => 'panel_two', 'label' => 'Panel Two', 'kind' => 'group', 'sub' => $panel_sub ),
			);

		case 'business':
			return array(
				array( 'key' => 'menu_title', 'label' => 'Menu / Short Title', 'kind' => 'text' ),
				array( 'key' => 'hero_chip', 'label' => 'Hero Chip', 'kind' => 'text' ),
				array( 'key' => 'hero_title', 'label' => 'Hero Title', 'kind' => 'text' ),
				array( 'key' => 'hero_breadcrumb', 'label' => 'Hero Breadcrumb', 'kind' => 'text' ),
				array( 'key' => 'intro_title', 'label' => 'Intro Title (HTML allowed)', 'kind' => 'textarea' ),
				array( 'key' => 'intro', 'label' => 'Intro Paragraphs', 'kind' => 'paras' ),
				array( 'key' => 'features', 'label' => 'Feature', 'kind' => 'rows', 'max' => 6, 'sub' => $feature_sub ),
				array( 'key' => 'area_title', 'label' => 'Areas Heading', 'kind' => 'text' ),
				array( 'key' => 'areas', 'label' => 'Areas Served', 'kind' => 'list' ),
				array( 'key' => 'panel_one', 'label' => 'Panel One', 'kind' => 'group', 'sub' => $panel_sub ),
				array( 'key' => 'panel_two', 'label' => 'Panel Two', 'kind' => 'group', 'sub' => $panel_sub ),
			);

		case 'commercial':
			return array(
				array( 'key' => 'menu_title', 'label' => 'Menu / Short Title', 'kind' => 'text' ),
				array( 'key' => 'hero_title', 'label' => 'Hero Title', 'kind' => 'text' ),
				array( 'key' => 'intro_title', 'label' => 'Intro Title (HTML allowed)', 'kind' => 'textarea' ),
				array( 'key' => 'intro', 'label' => 'Intro Paragraphs', 'kind' => 'paras' ),
				array( 'key' => 'features_title', 'label' => 'Features Heading', 'kind' => 'text' ),
				array( 'key' => 'features', 'label' => 'Feature', 'kind' => 'rows', 'max' => 6, 'sub' => $feature_sub ),
				array( 'key' => 'focus_title', 'label' => 'Focus Heading', 'kind' => 'text' ),
				array( 'key' => 'focus_intro', 'label' => 'Focus Intro', 'kind' => 'textarea' ),
				array( 'key' => 'focus_points', 'label' => 'Focus Points', 'kind' => 'list' ),
				array( 'key' => 'panel_one', 'label' => 'Panel One', 'kind' => 'group', 'sub' => $panel_sub ),
				array( 'key' => 'panel_two', 'label' => 'Panel Two', 'kind' => 'group', 'sub' => $panel_sub ),
				array( 'key' => 'quote', 'label' => 'Quote', 'kind' => 'textarea' ),
				array( 'key' => 'quote_caption', 'label' => 'Quote Caption', 'kind' => 'text' ),
			);

		case 'service_area':
			return array(
				array( 'key' => 'h1', 'label' => 'Page Heading (H1)', 'kind' => 'text' ),
				array( 'key' => 'intro', 'label' => 'Intro', 'kind' => 'textarea' ),
				array(
					'key'   => 'services',
					'label' => 'Service',
					'kind'  => 'rows',
					'max'   => 4,
					'sub'   => array(
						array( 'key' => 'title', 'label' => 'Title', 'kind' => 'text' ),
						array( 'key' => 'description', 'label' => 'Description', 'kind' => 'textarea' ),
					),
				),
				array( 'key' => 'seasonal_content', 'label' => 'Seasonal Content', 'kind' => 'textarea' ),
				array( 'key' => 'about_area', 'label' => 'About the Area', 'kind' => 'textarea' ),
				array( 'key' => 'nearby', 'label' => 'Nearby Areas', 'kind' => 'list' ),
				array( 'key' => 'cta_title', 'label' => 'CTA Title', 'kind' => 'text' ),
				array( 'key' => 'cta_body', 'label' => 'CTA Body', 'kind' => 'textarea' ),
				array( 'key' => 'cta_label', 'label' => 'CTA Button Label', 'kind' => 'text' ),
				array( 'key' => 'meta_description', 'label' => 'Meta Description', 'kind' => 'textarea' ),
			);
	}

	return array();
}

/**
 * Convert a landing schema into a flat ACF fields array.
 */
function alpine_build_landing_fields( $prefix, $schema ) {
	$fields = array();

	foreach ( $schema as $item ) {
		$kind = $item['kind'];

		if ( in_array( $kind, array( 'text', 'textarea', 'paras', 'list' ), true ) ) {
			if ( 'paras' === $kind ) {
				$instructions = 'One paragraph per line. Leave blank to keep the current text.';
			} elseif ( 'list' === $kind ) {
				$instructions = 'One item per line. Leave blank to keep the current list.';
			} else {
				$instructions = 'Leave blank to keep the current text.';
			}

			$fields[] = array(
				'key'          => 'field_' . $prefix . '_' . $item['key'],
				'label'        => $item['label'],
				'name'         => $item['key'],
				'type'         => ( 'text' === $kind ) ? 'text' : 'textarea',
				'instructions' => $instructions,
				'rows'         => ( 'text' === $kind ) ? 2 : 4,
			);
			continue;
		}

		if ( 'group' === $kind ) {
			$fields[] = array(
				'key'   => 'field_' . $prefix . '_tab_' . $item['key'],
				'label' => $item['label'],
				'name'  => '',
				'type'  => 'tab',
			);
			foreach ( $item['sub'] as $sub ) {
				$fields[] = array(
					'key'          => 'field_' . $prefix . '_' . $item['key'] . '_' . $sub['key'],
					'label'        => $item['label'] . ' — ' . $sub['label'],
					'name'         => $item['key'] . '_' . $sub['key'],
					'type'         => ( 'text' === $sub['kind'] ) ? 'text' : 'textarea',
					'instructions' => 'Leave blank to keep the current text.',
				);
			}
			continue;
		}

		if ( 'rows' === $kind ) {
			$fields[] = array(
				'key'   => 'field_' . $prefix . '_tab_' . $item['key'],
				'label' => $item['label'] . 's',
				'name'  => '',
				'type'  => 'tab',
			);
			$first_sub_key = $item['sub'][0]['key'];
			for ( $i = 1; $i <= $item['max']; $i++ ) {
				foreach ( $item['sub'] as $sub ) {
					$fields[] = array(
						'key'          => 'field_' . $prefix . '_' . $item['key'] . '_' . $i . '_' . $sub['key'],
						'label'        => $item['label'] . ' ' . $i . ' — ' . $sub['label'],
						'name'         => $item['key'] . '_' . $i . '_' . $sub['key'],
						'type'         => ( 'text' === $sub['kind'] ) ? 'text' : 'textarea',
						'instructions' => ( 1 === $i && $sub['key'] === $first_sub_key ) ? 'Leave a row blank to keep its current content.' : '',
					);
				}
			}
			continue;
		}
	}

	return $fields;
}

/**
 * Overlay saved ACF values from $post_id onto a coded $page data array.
 */
function alpine_overlay_landing_page( $page, $post_id, $family ) {
	if ( ! $post_id || ! function_exists( 'get_field' ) ) {
		return $page;
	}

	$schema = alpine_landing_schema( $family );

	foreach ( $schema as $item ) {
		$key  = $item['key'];
		$kind = $item['kind'];

		if ( 'text' === $kind || 'textarea' === $kind ) {
			$value = get_field( $key, $post_id );
			if ( alpine_acf_nonempty( $value ) ) {
				$page[ $key ] = $value;
			}
		} elseif ( 'paras' === $kind || 'list' === $kind ) {
			$value = get_field( $key, $post_id );
			if ( alpine_acf_nonempty( $value ) ) {
				$lines = array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $value ) ), 'strlen' ) );
				if ( ! empty( $lines ) ) {
					$page[ $key ] = $lines;
				}
			}
		} elseif ( 'group' === $kind ) {
			$base = ( isset( $page[ $key ] ) && is_array( $page[ $key ] ) ) ? $page[ $key ] : array();
			foreach ( $item['sub'] as $sub ) {
				$value = get_field( $key . '_' . $sub['key'], $post_id );
				if ( alpine_acf_nonempty( $value ) ) {
					$base[ $sub['key'] ] = $value;
				}
			}
			$page[ $key ] = $base;
		} elseif ( 'rows' === $kind ) {
			$defaults = ( isset( $page[ $key ] ) && is_array( $page[ $key ] ) ) ? array_values( $page[ $key ] ) : array();
			$rows     = array();

			for ( $i = 1; $i <= $item['max']; $i++ ) {
				$default_row = ( isset( $defaults[ $i - 1 ] ) && is_array( $defaults[ $i - 1 ] ) ) ? $defaults[ $i - 1 ] : array();
				$row         = $default_row;
				$has_acf     = false;

				foreach ( $item['sub'] as $sub ) {
					$value = get_field( $key . '_' . $i . '_' . $sub['key'], $post_id );
					if ( alpine_acf_nonempty( $value ) ) {
						$row[ $sub['key'] ] = $value;
						$has_acf            = true;
					} elseif ( ! isset( $row[ $sub['key'] ] ) ) {
						$row[ $sub['key'] ] = '';
					}
				}

				if ( ! empty( $default_row ) || $has_acf ) {
					$rows[] = $row;
				}
			}

			if ( ! empty( $rows ) ) {
				$page[ $key ] = $rows;
			}
		}
	}

	return $page;
}

/**
 * Resolve unique page IDs for a list of page paths.
 */
function alpine_collect_landing_page_ids( $paths ) {
	$ids = array();

	foreach ( $paths as $path ) {
		$found = get_page_by_path( $path, OBJECT, 'page' );
		if ( $found instanceof WP_Post ) {
			$ids[ (int) $found->ID ] = true;
		}
	}

	return array_keys( $ids );
}

/**
 * Build an ACF "OR" location array matching any of the given page IDs.
 */
function alpine_location_for_page_ids( $ids ) {
	if ( empty( $ids ) ) {
		return array( array( array( 'param' => 'page', 'operator' => '==', 'value' => '0' ) ) );
	}

	$location = array();
	foreach ( $ids as $id ) {
		$location[] = array( array( 'param' => 'page', 'operator' => '==', 'value' => (string) $id ) );
	}

	return $location;
}

/**
 * Build an ACF "OR" location array matching any of the given page templates.
 */
function alpine_location_for_templates( $templates ) {
	if ( empty( $templates ) ) {
		return array( array( array( 'param' => 'page', 'operator' => '==', 'value' => '0' ) ) );
	}

	$location = array();
	foreach ( $templates as $template ) {
		$location[] = array( array( 'param' => 'page_template', 'operator' => '==', 'value' => $template ) );
	}

	return $location;
}

/**
 * Register the four data-driven landing-page field groups.
 */
function alpine_register_landing_page_fields() {
	// Service / business pages are plain pages whose slug == the data slug, so
	// target them by page ID. Service-area pages live under /service-areas/.
	$service_ids = function_exists( 'alpine_service_page_data' )
		? alpine_collect_landing_page_ids( array_keys( alpine_service_page_data() ) )
		: array();

	$business_ids = function_exists( 'alpine_business_category_page_data' )
		? alpine_collect_landing_page_ids( array_keys( alpine_business_category_page_data() ) )
		: array();

	$service_area_ids = function_exists( 'alpine_service_area_locations' )
		? alpine_collect_landing_page_ids(
			array_merge(
				array_map(
					static function ( $slug ) {
						return 'service-areas/' . $slug;
					},
					array_keys( alpine_service_area_locations() )
				),
				array_keys( alpine_service_area_locations() )
			)
		)
		: array();

	// Commercial category pages use unique named templates (page-{slug}.php) and
	// live under a parent page, so target them by page template instead.
	$commercial_templates = function_exists( 'alpine_commercial_category_page_data' )
		? array_map(
			static function ( $slug ) {
				return 'page-' . $slug . '.php';
			},
			array_keys( alpine_commercial_category_page_data() )
		)
		: array();

	$families = array(
		'service' => array(
			'title'    => 'Service Page Content',
			'prefix'   => 'svc',
			'location' => alpine_location_for_page_ids( $service_ids ),
		),
		'business' => array(
			'title'    => 'Business Category Page Content',
			'prefix'   => 'biz',
			'location' => alpine_location_for_page_ids( $business_ids ),
		),
		'commercial' => array(
			'title'    => 'Commercial HVAC Page Content',
			'prefix'   => 'com',
			'location' => alpine_location_for_templates( $commercial_templates ),
		),
		'service_area' => array(
			'title'    => 'Service Area Page Content',
			'prefix'   => 'area',
			'location' => alpine_location_for_page_ids( $service_area_ids ),
		),
	);

	foreach ( $families as $family => $config ) {
		$fields = alpine_build_landing_fields( $config['prefix'], alpine_landing_schema( $family ) );

		acf_add_local_field_group(
			array(
				'key'            => 'group_alpine_landing_' . $family,
				'title'          => $config['title'],
				'fields'         => $fields,
				'location'       => $config['location'],
				'menu_order'     => 0,
				'hide_on_screen' => array( 'the_content' ),
			)
		);
	}
}
