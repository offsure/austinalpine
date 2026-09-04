<?php
/**
 * SEO metadata and structured data for the Projects section.
 *
 * Titles and descriptions are fed into the same AIOSEO filters the rest of the
 * site uses (see inc/seo-tags.php) via alpine_seo_entry_for_projects(), which
 * alpine_seo_get_entry() calls before its slug lookups.
 *
 * Structured data is a Service node per project. The sitewide HVACBusiness node
 * already ships on every page from inc/seo-tags.php, so projects reference it by
 * @id as the provider rather than emitting a second LocalBusiness.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_stylesheet_directory() . '/inc/projects.php';

/**
 * SEO entry for whichever Projects view is being requested, or null.
 */
function alpine_seo_entry_for_projects() {
	if ( is_singular( ALPINE_PROJECT_POST_TYPE ) ) {
		return alpine_seo_entry_from_project( get_queried_object_id() );
	}

	if ( is_tax( ALPINE_PROJECT_TAXONOMY ) ) {
		return alpine_seo_entry_from_project_type( get_queried_object() );
	}

	if ( is_post_type_archive( ALPINE_PROJECT_POST_TYPE ) ) {
		return array(
			'title'       => 'HVAC Projects in Austin & Cedar Park | ' . alpine_seo_brand_short(),
			'description' => 'Browse completed residential and commercial HVAC projects from Alpine Heating & Air Conditioning across Austin, Cedar Park, and Central Texas.',
			'keywords'    => array(
				'hvac projects austin',
				'hvac case studies austin tx',
				'commercial hvac projects austin',
				'residential hvac projects cedar park',
				'alpine heating and air conditioning',
			),
		);
	}

	return null;
}

/**
 * Per-project title and description. Editors can override both from the SEO tab
 * on the project; otherwise they are generated from the project's own fields, so
 * no two projects share copy.
 */
function alpine_seo_entry_from_project( $post_id ) {
	$post_id = (int) $post_id;

	if ( ! $post_id || ALPINE_PROJECT_POST_TYPE !== get_post_type( $post_id ) ) {
		return null;
	}

	$title = alpine_project_field( 'project_seo_title', $post_id );

	if ( '' === $title ) {
		$title = alpine_seo_clean_text( get_the_title( $post_id ) ) . ' | ' . alpine_seo_brand_short();
	}

	$description = alpine_project_field( 'project_seo_description', $post_id );

	if ( '' === $description ) {
		$description = alpine_seo_trim_text( alpine_project_summary( $post_id ), 155 );
	}

	$keywords = alpine_project_field( 'project_seo_keywords', $post_id );
	$keywords = $keywords
		? array_filter( array_map( 'trim', explode( ',', (string) $keywords ) ) )
		: array();

	if ( ! $keywords ) {
		$service = strtolower( alpine_seo_clean_text( alpine_project_field( 'project_service', $post_id ) ) );
		$city    = alpine_seo_clean_text( alpine_project_field( 'project_city', $post_id ) );

		if ( $service && $city ) {
			$keywords = array(
				$service . ' ' . strtolower( $city ),
				$service . ' ' . strtolower( $city ) . ' tx',
				'hvac service ' . strtolower( $city ),
			);
		}
	}

	return array(
		'title'       => alpine_seo_clean_text( $title ),
		'description' => alpine_seo_trim_text( $description, 158 ),
		'keywords'    => $keywords,
	);
}

/**
 * Residential / Commercial archive metadata.
 */
function alpine_seo_entry_from_project_type( $term ) {
	if ( ! $term instanceof WP_Term ) {
		return null;
	}

	$entries = array(
		'residential' => array(
			'title'       => 'Residential HVAC Projects in Cedar Park & Austin | ' . alpine_seo_brand_short(),
			'description' => 'Completed residential HVAC service and repair projects from Alpine, including AC service and mini split work at homes in Cedar Park and the Austin area.',
			'keywords'    => array( 'residential hvac projects cedar park', 'residential hvac service cedar park', 'ac service cedar park', 'home hvac repair austin tx' ),
		),
		'commercial'  => array(
			'title'       => 'Commercial HVAC Projects in Austin & Cedar Park | ' . alpine_seo_brand_short(),
			'description' => 'Commercial HVAC maintenance, service, inspection, and installation projects completed by Alpine at Austin and Cedar Park business properties.',
			'keywords'    => array( 'commercial hvac projects austin', 'commercial hvac maintenance austin', 'commercial ac service austin', 'commercial hvac contractor cedar park' ),
		),
	);

	if ( isset( $entries[ $term->slug ] ) ) {
		return $entries[ $term->slug ];
	}

	return array(
		'title'       => $term->name . ' Projects | ' . alpine_seo_brand_short(),
		'description' => alpine_seo_trim_text( $term->description ? $term->description : $term->name . ' HVAC projects completed by Alpine Heating & Air Conditioning.', 155 ),
		'keywords'    => array(),
	);
}

/* -------------------------------------------------------------------------
 * Structured data
 * ---------------------------------------------------------------------- */

/**
 * Emit a Service node for the project being viewed.
 *
 * BreadcrumbList already comes from alpine_breadcrumb_nav(), and the sitewide
 * HVACBusiness node is emitted at wp_head priority 5 — this only adds what is
 * specific to the project.
 */
add_action( 'wp_head', 'alpine_project_output_schema', 6 );
function alpine_project_output_schema() {
	if ( is_admin() || is_feed() || ! is_singular( ALPINE_PROJECT_POST_TYPE ) ) {
		return;
	}

	$post_id = get_queried_object_id();
	$service = alpine_seo_clean_text( alpine_project_field( 'project_service', $post_id ) );
	$city    = alpine_seo_clean_text( alpine_project_field( 'project_city', $post_id ) );

	if ( ! $service ) {
		return;
	}

	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Service',
		'@id'         => get_permalink( $post_id ) . '#service',
		'name'        => alpine_seo_clean_text( get_the_title( $post_id ) ),
		'serviceType' => $service,
		'url'         => get_permalink( $post_id ),
		'description' => alpine_seo_trim_text( alpine_project_summary( $post_id ), 300 ),
		'provider'    => array(
			'@type' => 'HVACBusiness',
			'@id'   => home_url( '/#localbusiness' ),
			'name'  => 'Alpine Heating & Air Conditioning',
		),
	);

	if ( $city ) {
		$schema['areaServed'] = array(
			'@type' => 'City',
			'name'  => $city . ', TX',
		);
	}

	$image_id = (int) get_post_thumbnail_id( $post_id );

	if ( $image_id > 0 ) {
		$src = wp_get_attachment_image_src( $image_id, 'large' );

		if ( ! empty( $src[0] ) ) {
			$schema['image'] = $src[0];
		}
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
