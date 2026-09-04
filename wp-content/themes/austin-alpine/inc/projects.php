<?php
/**
 * Projects / case studies.
 *
 * A completed-work portfolio split into Residential and Commercial. Everything
 * here is additive: a public `alpine_project` post type, an `alpine_project_type`
 * taxonomy, and an ACF field group so office staff can add a job, drop in photos,
 * and publish without touching a template.
 *
 * Field notes:
 *  - This site runs ACF free (see inc/acf-fields.php), so there is no Repeater
 *    and no Gallery field. Multi-row content is modelled the same way the rest of
 *    the theme models it: a fixed set of numbered fields.
 *  - Every getter falls back to raw post meta, so projects still render if ACF is
 *    ever deactivated.
 *  - Street addresses and job numbers are stored as admin-only reference fields
 *    and are never printed on the front end.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const ALPINE_PROJECT_POST_TYPE = 'alpine_project';
const ALPINE_PROJECT_TAXONOMY  = 'alpine_project_type';

/* -------------------------------------------------------------------------
 * Registration
 *
 * The taxonomy registers first on purpose. Its rewrite base sits underneath the
 * post type base (/projects/type/...), and WordPress matches rewrite rules in
 * registration order — so registering it second would let the post type's
 * /projects/([^/]+)/ single rule swallow /projects/type/residential/.
 * ---------------------------------------------------------------------- */

if ( ! function_exists( 'alpine_register_project_taxonomy' ) ) {
	function alpine_register_project_taxonomy() {
		register_taxonomy(
			ALPINE_PROJECT_TAXONOMY,
			array( ALPINE_PROJECT_POST_TYPE ),
			array(
				'labels' => array(
					'name'          => __( 'Project Types', 'austin-alpine' ),
					'singular_name' => __( 'Project Type', 'austin-alpine' ),
					'menu_name'     => __( 'Project Types', 'austin-alpine' ),
					'all_items'     => __( 'All Project Types', 'austin-alpine' ),
					'edit_item'     => __( 'Edit Project Type', 'austin-alpine' ),
					'add_new_item'  => __( 'Add New Project Type', 'austin-alpine' ),
				),
				'public'            => true,
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'rewrite'           => array(
					'slug'         => 'projects/type',
					'with_front'   => false,
					'hierarchical' => false,
				),
			)
		);
	}
}
add_action( 'init', 'alpine_register_project_taxonomy', 8 );

if ( ! function_exists( 'alpine_register_project_post_type' ) ) {
	function alpine_register_project_post_type() {
		register_post_type(
			ALPINE_PROJECT_POST_TYPE,
			array(
				'labels' => array(
					'name'               => __( 'Projects', 'austin-alpine' ),
					'singular_name'      => __( 'Project', 'austin-alpine' ),
					'menu_name'          => __( 'Projects', 'austin-alpine' ),
					'add_new'            => __( 'Add New Project', 'austin-alpine' ),
					'add_new_item'       => __( 'Add New Project', 'austin-alpine' ),
					'edit_item'          => __( 'Edit Project', 'austin-alpine' ),
					'new_item'           => __( 'New Project', 'austin-alpine' ),
					'view_item'          => __( 'View Project', 'austin-alpine' ),
					'search_items'       => __( 'Search Projects', 'austin-alpine' ),
					'not_found'          => __( 'No projects found', 'austin-alpine' ),
					'not_found_in_trash' => __( 'No projects found in Trash', 'austin-alpine' ),
				),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_rest'       => true,
				'menu_position'      => 24,
				'menu_icon'          => 'dashicons-hammer',
				'supports'           => array( 'title', 'excerpt', 'thumbnail', 'page-attributes', 'revisions' ),
				'taxonomies'         => array( ALPINE_PROJECT_TAXONOMY ),
				'has_archive'        => 'projects',
				'hierarchical'       => false,
				'rewrite'            => array(
					'slug'       => 'projects',
					'with_front' => false,
				),
			)
		);
	}
}
add_action( 'init', 'alpine_register_project_post_type', 10 );

/**
 * Flush rewrite rules once, the first time the new routes exist.
 *
 * Cheaper and safer than flushing on every load; bumping the stamp re-runs it.
 */
add_action( 'wp_loaded', 'alpine_maybe_flush_project_rewrites', 99 );
function alpine_maybe_flush_project_rewrites() {
	$stamp = 'projects-v1';

	if ( get_option( 'alpine_projects_rewrite_version' ) === $stamp ) {
		return;
	}

	flush_rewrite_rules( false );
	update_option( 'alpine_projects_rewrite_version', $stamp );
}

/**
 * Seed the two project types the site is organised around.
 *
 * Terms stay fully editable in the admin — this only guarantees they exist.
 */
add_action( 'init', 'alpine_ensure_project_type_terms', 12 );
function alpine_ensure_project_type_terms() {
	if ( ! taxonomy_exists( ALPINE_PROJECT_TAXONOMY ) ) {
		return;
	}

	if ( get_option( 'alpine_project_terms_seeded' ) ) {
		return;
	}

	$terms = array(
		'residential' => array(
			'name'        => 'Residential',
			'description' => 'HVAC work completed at homes across Austin, Cedar Park, and the surrounding Central Texas communities.',
		),
		'commercial'  => array(
			'name'        => 'Commercial',
			'description' => 'HVAC service, maintenance, and installation work completed at commercial properties in the Austin area.',
		),
	);

	foreach ( $terms as $slug => $term ) {
		if ( ! term_exists( $slug, ALPINE_PROJECT_TAXONOMY ) ) {
			wp_insert_term(
				$term['name'],
				ALPINE_PROJECT_TAXONOMY,
				array(
					'slug'        => $slug,
					'description' => $term['description'],
				)
			);
		}
	}

	update_option( 'alpine_project_terms_seeded', 1 );
}

/* -------------------------------------------------------------------------
 * Field registration
 * ---------------------------------------------------------------------- */

add_action( 'acf/init', 'alpine_register_project_fields', 20 );
function alpine_register_project_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) || ! function_exists( 'alpine_acf_field' ) ) {
		return;
	}

	$gallery_note = 'Photos are managed in the <strong>Project Photos</strong> box further down this screen — add as many as you like, drag them into order, and write each one&rsquo;s alt text inline.<br>'
		. 'The <strong>Featured image</strong> in the right-hand column is separate: it heads the project page and fronts the archive card.';

	$fields = array(
		alpine_acf_tab( 'project_details', 'Project Details' ),
		alpine_acf_field(
			'project_location',
			'project_location',
			'Location (shown on the site)',
			'text',
			'',
			array( 'instructions' => 'City, state, and ZIP — for example "Cedar Park, TX 78613". Keep street numbers out of this field; use the Internal Reference tab for those.' )
		),
		alpine_acf_field( 'project_city', 'project_city', 'City', 'text', '', array( 'instructions' => 'Used for local SEO and structured data. Example: Cedar Park' ) ),
		alpine_acf_field( 'project_service', 'project_service', 'Service Provided', 'text', '', array( 'instructions' => 'Example: Commercial AC Maintenance' ) ),
		alpine_acf_field( 'project_summary', 'project_summary', 'Short Description (project cards)', 'textarea', '', array( 'instructions' => 'One or two sentences shown on the Projects archive cards. Falls back to the excerpt when empty.', 'rows' => 3 ) ),

		alpine_acf_tab( 'project_story', 'Project Story' ),
		alpine_project_editor_field(
			'project_overview',
			'Project Overview',
			'Write the story of the job. Use the toolbar to bold or italicise text and to add headings &mdash; Heading&nbsp;2 and Heading&nbsp;3 are the safe picks, because the project title on the page is already the H1.'
		),
		alpine_project_editor_field(
			'project_issue',
			'Issue / Customer Need',
			'What the customer reported before the visit.'
		),
		alpine_project_editor_field(
			'project_work',
			'Work Performed',
			'Use the bulleted-list button for what was done on site. Plain paragraphs work too.'
		),
		alpine_acf_field( 'project_equipment', 'project_equipment', 'Equipment Information', 'textarea', '', array( 'instructions' => 'One "Label: Value" pair per line — for example "Brand: Lennox". Leave empty to hide the equipment table.', 'rows' => 6 ) ),
		array(
			'key'           => 'field_alpine_project_related_links',
			'label'         => 'Related Service Pages',
			'name'          => 'project_related_links',
			'type'          => 'relationship',
			'instructions'  => 'Search for the pages this project should link to, then drag to set their order. Leave empty to use the defaults for this project type. Only live pages can be picked, so these links can never break.',
			'post_type'     => array( 'page' ),
			'filters'       => array( 'search' ),
			'return_format' => 'id',
			'max'           => 8,
		),

		alpine_acf_tab( 'project_gallery', 'Photos' ),
		array(
			'key'     => 'field_alpine_project_gallery_note',
			'label'   => '',
			'name'    => '',
			'type'    => 'message',
			'message' => $gallery_note,
		),
	);

	$fields[] = alpine_acf_tab( 'project_seo', 'SEO' );
	$fields[] = alpine_acf_field( 'project_seo_title', 'project_seo_title', 'SEO Title override', 'text', '', array( 'instructions' => 'Optional. Leave empty to use the generated title.' ) );
	$fields[] = alpine_acf_field( 'project_seo_description', 'project_seo_description', 'Meta Description override', 'textarea', '', array( 'instructions' => 'Optional, roughly 150 characters. Leave empty to use the generated description.', 'rows' => 3 ) );
	$fields[] = alpine_acf_field( 'project_seo_keywords', 'project_seo_keywords', 'Focus Keywords', 'text', '', array( 'instructions' => 'Optional, comma separated. Lead with the one primary keyword for this project.' ) );

	$fields[] = alpine_acf_tab( 'project_internal', 'Internal Reference' );
	$fields[] = array(
		'key'     => 'field_alpine_project_internal_note',
		'label'   => '',
		'name'    => '',
		'type'    => 'message',
		'message' => '<strong>Never shown on the website.</strong> These fields exist so office staff can tie a published project back to the original job.',
	);
	$fields[] = alpine_acf_field( 'project_job_reference', 'project_job_reference', 'Job # (internal)', 'text' );
	$fields[] = alpine_acf_field( 'project_address_internal', 'project_address_internal', 'Full Site Address (internal)', 'text' );

	acf_add_local_field_group(
		array(
			'key'            => 'group_alpine_project',
			'title'          => 'Project Details',
			'fields'         => $fields,
			'location'       => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => ALPINE_PROJECT_POST_TYPE,
					),
				),
			),
			'menu_order'     => 0,
			'position'       => 'normal',
			'hide_on_screen' => array( 'discussion', 'comments', 'author', 'format', 'trackbacks' ),
		)
	);
}

/**
 * A Project Story field: the WordPress editor, trimmed to the formatting the
 * project template can actually style.
 *
 * The key deliberately matches the one the old textarea used, so every project
 * written before the editor existed keeps its content.
 */
function alpine_project_editor_field( $name, $label, $instructions = '' ) {
	return array(
		'key'          => 'field_alpine_' . $name,
		'label'        => $label,
		'name'         => $name,
		'type'         => 'wysiwyg',
		'instructions' => $instructions,
		'tabs'         => 'all',
		'toolbar'      => 'alpine_project',
		'media_upload' => 0,
		'delay'        => 0,
	);
}

/**
 * Toolbar for the story editors. Everything here has a matching style in
 * assets/css/projects.css; anything that does not is left out on purpose.
 */
add_filter( 'acf/fields/wysiwyg/toolbars', 'alpine_project_wysiwyg_toolbar' );
function alpine_project_wysiwyg_toolbar( $toolbars ) {
	$toolbars['alpine_project'] = array(
		1 => array(
			'formatselect',
			'bold',
			'italic',
			'underline',
			'bullist',
			'numlist',
			'link',
			'unlink',
			'blockquote',
			'removeformat',
			'undo',
			'redo',
		),
	);

	return $toolbars;
}

/**
 * Limit the format dropdown on project screens to headings the template styles.
 */
add_filter( 'tiny_mce_before_init', 'alpine_project_tinymce_blocks' );
function alpine_project_tinymce_blocks( $init ) {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return $init;
	}

	$screen = get_current_screen();

	if ( ! $screen || ALPINE_PROJECT_POST_TYPE !== $screen->post_type ) {
		return $init;
	}

	$init['block_formats'] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4';

	return $init;
}

/* -------------------------------------------------------------------------
 * Getters
 * ---------------------------------------------------------------------- */

/**
 * Read a project field, preferring ACF but falling back to raw post meta so
 * projects keep rendering if ACF is deactivated.
 */
function alpine_project_field( $name, $post_id = 0, $default = '' ) {
	$post_id = $post_id ? (int) $post_id : (int) get_the_ID();

	if ( ! $post_id ) {
		return $default;
	}

	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $name, $post_id );

		if ( null !== $value && '' !== $value && false !== $value ) {
			return $value;
		}
	}

	$value = get_post_meta( $post_id, $name, true );

	return ( '' === $value || null === $value ) ? $default : $value;
}

/**
 * Split a textarea into trimmed lines, dropping blanks.
 */
function alpine_project_lines( $text ) {
	$lines = preg_split( '/\R/', (string) $text );

	return array_values( array_filter( array_map( 'trim', (array) $lines ), 'strlen' ) );
}

/**
 * Split a textarea into paragraphs on blank lines.
 */
function alpine_project_paragraphs( $text ) {
	$chunks = preg_split( '/\R{2,}/', trim( (string) $text ) );
	$chunks = array_map(
		static function ( $chunk ) {
			return trim( preg_replace( '/\s+/', ' ', $chunk ) );
		},
		(array) $chunks
	);

	return array_values( array_filter( $chunks, 'strlen' ) );
}

/**
 * Read a story field exactly as it was stored.
 *
 * ACF would hand back a wpautop'd copy, which hides whether the value is real
 * editor HTML or plain text typed into the textarea this field used to be. The
 * formatting helpers below need to tell those apart, so they read the meta.
 */
function alpine_project_rich_field( $name, $post_id = 0 ) {
	$post_id = $post_id ? (int) $post_id : (int) get_the_ID();

	if ( ! $post_id ) {
		return '';
	}

	$value = get_post_meta( $post_id, $name, true );

	return is_string( $value ) ? $value : '';
}

/**
 * Turn a story field into safe HTML for the template.
 *
 * Editor content is passed through as written. Values saved before the editor
 * existed are plain text, so they still get their blank lines turned into
 * paragraphs and their markdown-style **bold** turned into real bold — which is
 * what those asterisks were always meant to be.
 */
function alpine_project_rich_text( $value ) {
	$value = (string) $value;

	if ( '' === trim( $value ) ) {
		return '';
	}

	$value = alpine_project_is_html( $value )
		? alpine_project_bold_markers( $value )
		: alpine_project_legacy_markup( $value );

	if ( false === strpos( $value, '<p>' ) ) {
		$value = wpautop( $value );
	}

	return wp_kses_post( $value );
}

/**
 * Work Performed as HTML.
 *
 * Same as any other story field once the editor has touched it. Before that it
 * is one item per line, and it has to keep rendering as the list it was.
 */
function alpine_project_work_html( $post_id = 0 ) {
	$value = alpine_project_rich_field( 'project_work', $post_id );

	if ( '' === trim( $value ) ) {
		return '';
	}

	if ( alpine_project_is_html( $value ) ) {
		return alpine_project_rich_text( $value );
	}

	$items = alpine_project_lines( $value );

	if ( ! $items ) {
		return '';
	}

	$html = '';

	foreach ( $items as $item ) {
		$html .= '<li>' . alpine_project_legacy_markup( $item ) . '</li>';
	}

	return wp_kses_post( '<ul>' . $html . '</ul>' );
}

/**
 * Does this value carry markup, or is it plain text from the old textareas?
 */
function alpine_project_is_html( $value ) {
	return (bool) preg_match( '/<[a-z][^>]*>/i', (string) $value );
}

/**
 * Escape plain text and promote **bold** to real bold.
 */
function alpine_project_legacy_markup( $text ) {
	return alpine_project_bold_markers( esc_html( (string) $text ) );
}

/**
 * Promote markdown-style **bold** to real bold.
 *
 * Project copy was pasted in with asterisks long before this field had a Bold
 * button, and those asterisks were rendering literally on the page. The pattern
 * stops at a tag, so it only ever rewrites runs of plain text.
 */
function alpine_project_bold_markers( $html ) {
	return preg_replace( '/\*\*([^<>*]+?)\*\*/', '<strong>$1</strong>', (string) $html );
}

/**
 * Flatten story HTML back to plain text for meta descriptions and schema,
 * keeping block boundaries as line breaks so words never run together.
 */
function alpine_project_rich_to_text( $value ) {
	$value = preg_replace( '#</(p|div|li|h[1-6]|blockquote|tr)>#i', "\n\n", (string) $value );
	$value = preg_replace( '#<br\s*/?>#i', "\n", $value );
	$value = str_replace( '**', '', wp_strip_all_tags( $value ) );

	return trim( html_entity_decode( $value, ENT_QUOTES, get_bloginfo( 'charset' ) ) );
}

/**
 * Parse the "Label: Value" equipment textarea into rows.
 */
function alpine_project_equipment_rows( $post_id = 0 ) {
	$rows = array();

	foreach ( alpine_project_lines( alpine_project_field( 'project_equipment', $post_id ) ) as $line ) {
		$parts = explode( ':', $line, 2 );

		if ( 2 === count( $parts ) && '' !== trim( $parts[1] ) ) {
			$rows[] = array(
				'label' => trim( $parts[0] ),
				'value' => trim( $parts[1] ),
			);
		} else {
			$rows[] = array(
				'label' => '',
				'value' => trim( $line ),
			);
		}
	}

	return $rows;
}

/**
 * Gallery attachment IDs for a project, in the order the editor arranged them.
 *
 * Backed by the Project Photos meta box (inc/projects-gallery.php), which stores
 * a comma-separated ID list — unlimited photos, drag-ordered. There is no cap
 * and no hidden second source: what the meta box shows is what renders.
 *
 * @param int  $post_id        Project ID; defaults to the current post.
 * @param bool $skip_featured  Filter out the featured image, which already
 *                             heads the page. The meta box passes false so an
 *                             editor still sees every photo they picked.
 */
function alpine_project_gallery_ids( $post_id = 0, $skip_featured = true ) {
	$post_id = $post_id ? (int) $post_id : (int) get_the_ID();

	if ( ! $post_id ) {
		return array();
	}

	$stored = get_post_meta( $post_id, 'project_gallery', true );
	$ids    = array();

	foreach ( array_filter( explode( ',', (string) $stored ) ) as $id ) {
		$id = (int) trim( $id );

		if ( $id > 0 && ! in_array( $id, $ids, true ) ) {
			$ids[] = $id;
		}
	}

	if ( $skip_featured ) {
		$featured = (int) get_post_thumbnail_id( $post_id );

		$ids = array_filter(
			$ids,
			static function ( $id ) use ( $featured ) {
				return $id !== $featured;
			}
		);
	}

	return array_values( $ids );
}

/**
 * The project's type term (Residential / Commercial).
 */
function alpine_project_type_term( $post_id = 0 ) {
	$post_id = $post_id ? (int) $post_id : (int) get_the_ID();
	$terms   = get_the_terms( $post_id, ALPINE_PROJECT_TAXONOMY );

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return null;
	}

	return $terms[0];
}

/**
 * Card / archive summary text.
 */
function alpine_project_summary( $post_id = 0 ) {
	$post_id = $post_id ? (int) $post_id : (int) get_the_ID();
	$summary = alpine_project_field( 'project_summary', $post_id );

	if ( '' === $summary ) {
		$summary = get_the_excerpt( $post_id );
	}

	if ( '' === $summary ) {
		$paragraphs = alpine_project_paragraphs( alpine_project_rich_to_text( alpine_project_rich_field( 'project_overview', $post_id ) ) );
		$summary    = $paragraphs ? $paragraphs[0] : '';
	}

	return wp_strip_all_tags( (string) $summary );
}

/**
 * Alt text for a project image: the Media Library value when the editor set one,
 * otherwise a description built from the project itself. Never a generic string
 * repeated across every image.
 */
function alpine_project_image_alt( $attachment_id, $post_id = 0, $position = 0 ) {
	$alt = trim( (string) get_post_meta( (int) $attachment_id, '_wp_attachment_image_alt', true ) );

	if ( '' !== $alt ) {
		return $alt;
	}

	$alt = trim( (string) get_the_title( (int) $attachment_id ) );

	if ( '' !== $alt && ! preg_match( '/^(IMG|DSC|PXL|image|photo)[\s_-]*\d+$/i', $alt ) ) {
		return $alt;
	}

	$post_id  = $post_id ? (int) $post_id : (int) get_the_ID();
	$service  = alpine_project_field( 'project_service', $post_id );
	$city     = alpine_project_field( 'project_city', $post_id );
	$place    = $city ? $city : alpine_project_field( 'project_location', $post_id );
	$stem     = $service ? $service : 'HVAC work';

	$alt = $place
		? sprintf( '%s by Alpine in %s', $stem, $place )
		: sprintf( '%s by Alpine', $stem );

	return $position > 1 ? $alt . ' — photo ' . $position : $alt;
}

/* -------------------------------------------------------------------------
 * URLs and internal links
 * ---------------------------------------------------------------------- */

function alpine_projects_archive_url() {
	$url = get_post_type_archive_link( ALPINE_PROJECT_POST_TYPE );

	return $url ? $url : home_url( '/projects/' );
}

function alpine_project_type_url( $slug ) {
	$term = get_term_by( 'slug', $slug, ALPINE_PROJECT_TAXONOMY );

	if ( $term instanceof WP_Term ) {
		$link = get_term_link( $term );

		if ( ! is_wp_error( $link ) ) {
			return $link;
		}
	}

	return alpine_projects_archive_url();
}

/* -------------------------------------------------------------------------
 * Admin list table
 *
 * The job number is the one thing office staff need to match a published
 * project back to the original work order, so it earns a column — in the admin
 * only. It is never rendered on the front end.
 * ---------------------------------------------------------------------- */

add_filter( 'manage_' . ALPINE_PROJECT_POST_TYPE . '_posts_columns', 'alpine_project_admin_columns' );
function alpine_project_admin_columns( $columns ) {
	$reordered = array();

	foreach ( $columns as $key => $label ) {
		$reordered[ $key ] = $label;

		if ( 'title' === $key ) {
			$reordered['alpine_project_location'] = __( 'Location', 'austin-alpine' );
			$reordered['alpine_project_job']      = __( 'Job # (internal)', 'austin-alpine' );
			$reordered['alpine_project_photos']   = __( 'Photos', 'austin-alpine' );
		}
	}

	return $reordered;
}

add_action( 'manage_' . ALPINE_PROJECT_POST_TYPE . '_posts_custom_column', 'alpine_project_admin_column_content', 10, 2 );
function alpine_project_admin_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'alpine_project_location':
			echo esc_html( alpine_project_field( 'project_location', $post_id, '—' ) );
			break;

		case 'alpine_project_job':
			$job = alpine_project_field( 'project_job_reference', $post_id );
			echo $job ? '<code>' . esc_html( $job ) . '</code>' : '—';
			break;

		case 'alpine_project_photos':
			$gallery = alpine_project_gallery_ids( $post_id );

			// Alt text is the piece that is easy to forget and costly to miss,
			// so surface the count of photos still lacking it right here.
			$missing_alt = 0;
			foreach ( $gallery as $image_id ) {
				if ( '' === trim( (string) get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ) ) {
					$missing_alt++;
				}
			}

			if ( ! get_post_thumbnail_id( $post_id ) ) {
				echo '<span style="color:#b32d2e;">' . esc_html__( 'No featured image', 'austin-alpine' ) . '</span>';

				if ( $gallery ) {
					printf( ' <span style="color:#646970;">(%d in gallery)</span>', count( $gallery ) );
				}
				break;
			}

			printf(
				/* translators: %d: number of gallery photos. */
				esc_html( _n( 'Featured + %d photo', 'Featured + %d photos', count( $gallery ), 'austin-alpine' ) ),
				count( $gallery )
			);

			if ( $missing_alt > 0 ) {
				printf(
					' <span style="color:#b32d2e;">' . esc_html(
						/* translators: %d: number of photos with no alt text. */
						_n( '(%d missing alt text)', '(%d missing alt text)', $missing_alt, 'austin-alpine' )
					) . '</span>',
					(int) $missing_alt
				);
			}
			break;
	}
}

/**
 * Resolve a page slug to its ID.
 *
 * alpine_get_page_id_by_path() matches on the full path, which misses the pages
 * that live under a parent — the commercial category pages sit beneath
 * commercial-hvac-austin-tx, and the service areas beneath service-areas. Those
 * are exactly the pages projects most want to link to, so fall back to a
 * slug-only lookup that does not care where the page sits in the tree.
 *
 * @return int Page ID, or 0 when nothing matches.
 */
function alpine_project_resolve_page_id( $slug ) {
	static $cache = array();

	$slug = sanitize_title( $slug );

	if ( '' === $slug ) {
		return 0;
	}

	if ( isset( $cache[ $slug ] ) ) {
		return $cache[ $slug ];
	}

	$page_id = function_exists( 'alpine_get_page_id_by_path' ) ? (int) alpine_get_page_id_by_path( $slug ) : 0;

	if ( $page_id < 1 ) {
		$matches = get_posts(
			array(
				'post_type'        => 'page',
				'name'             => $slug,
				'post_status'      => 'publish',
				'posts_per_page'   => 1,
				'fields'           => 'ids',
				'no_found_rows'    => true,
				'suppress_filters' => false,
			)
		);

		$page_id = $matches ? (int) $matches[0] : 0;
	}

	$cache[ $slug ] = $page_id;

	return $page_id;
}

/**
 * Internal links a project offers, filtered down to pages that actually exist.
 *
 * Keys are real page slugs. Anything that does not resolve to a live page is
 * dropped rather than rendered as a dead link.
 */
function alpine_project_related_links( $keys ) {
	$catalog = array(
		'ac-repair'                   => array( 'label' => 'AC Repair', 'body' => 'Cooling that quits, short-cycles, or blows warm — diagnosed and repaired.' ),
		'ac-maintenance'              => array( 'label' => 'AC Maintenance', 'body' => 'Seasonal tune-ups that catch small faults before they turn into no-cool calls.' ),
		'ac-installation'             => array( 'label' => 'AC Installation', 'body' => 'Replacement and new-system installs sized for the building, not a catalog.' ),
		'air-conditioning-services'   => array( 'label' => 'Air Conditioning Services', 'body' => 'The full range of residential cooling work we handle in Central Texas.' ),
		'ductless-services'           => array( 'label' => 'Ductless Mini-Split Services', 'body' => 'Service, repair, and installation for ductless and mini split systems.' ),
		'emergency-hvac-repair'       => array( 'label' => 'Emergency HVAC Repair', 'body' => 'For buildings that lose cooling or heat and cannot wait for a routine slot.' ),
		'indoor-air-quality'          => array( 'label' => 'Indoor Air Quality', 'body' => 'Filtration, purification, and humidity work for healthier indoor air.' ),
		'thermostat-services'         => array( 'label' => 'Thermostat Services', 'body' => 'Thermostat replacement, wiring, and controls for homes and businesses.' ),
		'maintenance-plan'            => array( 'label' => 'HVAC Maintenance Plans', 'body' => 'Scheduled preventative maintenance with priority scheduling.' ),
		'commercial-hvac-austin-tx'   => array( 'label' => 'Commercial HVAC Services', 'body' => 'Repair, maintenance, and installation built around occupied buildings.' ),
		'office-buildings'            => array( 'label' => 'Office Building HVAC', 'body' => 'Comfort and uptime for offices, suites, and multi-tenant floors.' ),
		'school-education-facilities' => array( 'label' => 'School &amp; Education Facility HVAC', 'body' => 'Classroom comfort, rooftop units, and work scheduled around the calendar.' ),
		'retail-food-service'         => array( 'label' => 'Retail &amp; Food Service HVAC', 'body' => 'Storefronts and restaurants where comfort is part of the customer experience.' ),
		'austin-tx'                   => array( 'label' => 'HVAC Services in Austin, TX', 'body' => 'What we cover across Austin, from downtown to the north corridor.' ),
		'cedar-park-tx'               => array( 'label' => 'HVAC Services in Cedar Park, TX', 'body' => 'Local coverage for homes and businesses throughout Cedar Park.' ),
		'contact-us'                  => array( 'label' => 'Contact Alpine', 'body' => 'Reach the team to schedule service or ask about a project like this one.' ),
	);

	$links = array();

	foreach ( (array) $keys as $key ) {
		// Accepts either a page ID (what the relationship picker returns) or a
		// slug (the built-in defaults), so both paths share one renderer.
		if ( is_numeric( $key ) ) {
			$page_id = (int) $key;
			$slug    = (string) get_post_field( 'post_name', $page_id );
		} else {
			$slug    = (string) $key;
			$page_id = alpine_project_resolve_page_id( $slug );
		}

		if ( $page_id < 1 || 'publish' !== get_post_status( $page_id ) ) {
			continue;
		}

		// Curated copy where we have it; otherwise fall back to the page's own
		// title and excerpt so a hand-picked page still reads properly.
		if ( ! empty( $catalog[ $slug ] ) ) {
			$label = $catalog[ $slug ]['label'];
			$body  = $catalog[ $slug ]['body'];
		} else {
			$label = get_the_title( $page_id );
			$body  = wp_strip_all_tags( (string) get_the_excerpt( $page_id ) );
		}

		$links[] = array(
			'url'   => get_permalink( $page_id ),
			'label' => $label,
			'body'  => $body,
		);
	}

	return $links;
}

/**
 * Which service pages a given project should point at. Editable per project,
 * with a sensible default by project type when the field is empty.
 */
function alpine_project_link_keys( $post_id = 0 ) {
	$post_id = $post_id ? (int) $post_id : (int) get_the_ID();
	$stored  = alpine_project_field( 'project_related_links', $post_id );

	// The relationship picker returns page IDs. Legacy rows may still hold the
	// newline-separated slugs the field used before, so handle both.
	if ( is_array( $stored ) ) {
		$ids = array_filter( array_map( 'intval', $stored ) );

		if ( $ids ) {
			return $ids;
		}
	} elseif ( $stored ) {
		return array_map( 'sanitize_title', alpine_project_lines( $stored ) );
	}

	$term = alpine_project_type_term( $post_id );

	if ( $term && 'commercial' === $term->slug ) {
		return array( 'commercial-hvac-austin-tx', 'office-buildings', 'maintenance-plan', 'austin-tx' );
	}

	return array( 'ac-repair', 'ac-maintenance', 'air-conditioning-services', 'cedar-park-tx' );
}
