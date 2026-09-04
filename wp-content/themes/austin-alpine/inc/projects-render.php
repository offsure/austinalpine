<?php
/**
 * Projects presentation layer: archive copy, cards, single-project sections,
 * structured data, and the SEO entries the AIOSEO filters read.
 *
 * Data and registration live in inc/projects.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_stylesheet_directory() . '/inc/projects.php';
require_once get_stylesheet_directory() . '/inc/service-area-links-section.php';

/* -------------------------------------------------------------------------
 * Editable archive copy (Site Settings page — the theme's free-ACF stand-in
 * for an Options Page; see inc/acf-fields.php).
 * ---------------------------------------------------------------------- */

/**
 * Default archive copy. Doubles as the ACF default and the runtime fallback, so
 * the page reads correctly even before anyone opens Site Settings.
 */
function alpine_projects_default( $key ) {
	$defaults = array(
		'chip'        => 'Completed Work',
		'title'       => 'HVAC Projects & Case Studies',
		'intro'       => 'A look at recent heating and air conditioning work across Central Texas — homes in Cedar Park, offices and storefronts in Austin, and the rooftop equipment that keeps them running. Each project below covers what the customer reported and what our technicians did about it.',
		'cta_heading' => 'Have a project like one of these?',
		'cta_text'    => 'Need commercial or residential HVAC service in Austin or Cedar Park? Contact Alpine to schedule professional HVAC service.',
	);

	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

/**
 * Read archive copy from Site Settings, falling back to the defaults above.
 */
function alpine_projects_copy( $key ) {
	$map = array(
		'chip'        => 'projects_archive_chip',
		'title'       => 'projects_archive_title',
		'intro'       => 'projects_archive_intro',
		'cta_heading' => 'projects_cta_heading',
		'cta_text'    => 'projects_cta_text',
	);

	if ( ! isset( $map[ $key ] ) || ! function_exists( 'alpine_get_setting' ) ) {
		return alpine_projects_default( $key );
	}

	return alpine_get_setting( $map[ $key ], alpine_projects_default( $key ) );
}

add_action( 'acf/init', 'alpine_register_projects_settings_fields', 21 );
function alpine_register_projects_settings_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) || ! function_exists( 'alpine_acf_field' ) ) {
		return;
	}

	$settings_page_id = function_exists( 'alpine_get_settings_page_id' ) ? alpine_get_settings_page_id() : 0;

	if ( ! $settings_page_id ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'        => 'group_alpine_projects_settings',
			'title'      => 'Projects Page',
			'fields'     => array(
				alpine_acf_field( 'projects_archive_chip', 'projects_archive_chip', 'Hero Chip', 'text', alpine_projects_default( 'chip' ) ),
				alpine_acf_field( 'projects_archive_title', 'projects_archive_title', 'Page Title (H1)', 'text', alpine_projects_default( 'title' ) ),
				alpine_acf_field( 'projects_archive_intro', 'projects_archive_intro', 'Intro Copy', 'textarea', alpine_projects_default( 'intro' ), array( 'rows' => 4 ) ),
				alpine_acf_field( 'projects_cta_heading', 'projects_cta_heading', 'Closing CTA Heading', 'text', alpine_projects_default( 'cta_heading' ) ),
				alpine_acf_field( 'projects_cta_text', 'projects_cta_text', 'Closing CTA Copy', 'textarea', alpine_projects_default( 'cta_text' ), array( 'rows' => 3 ) ),
			),
			'location'   => array(
				array(
					array(
						'param'    => 'page',
						'operator' => '==',
						'value'    => (string) $settings_page_id,
					),
				),
			),
			'menu_order' => 5,
		)
	);
}

/* -------------------------------------------------------------------------
 * Shared pieces
 * ---------------------------------------------------------------------- */

/**
 * Featured-image markup for a project.
 *
 * Projects without a verified image intentionally return no markup. This keeps
 * placeholders and unrelated stock photos out of the project portfolio.
 */
function alpine_project_media( $post_id, $size = 'large' ) {
	$post_id  = (int) $post_id;
	$image_id = (int) get_post_thumbnail_id( $post_id );

	if ( $image_id > 0 ) {
		return wp_get_attachment_image(
			$image_id,
			$size,
			false,
			array(
				'alt'      => alpine_project_image_alt( $image_id, $post_id, 1 ),
				'loading'  => 'lazy',
				'decoding' => 'async',
			)
		);
	}

	return '';
}

/**
 * Published projects, optionally limited to one type.
 */
function alpine_get_projects( $type_slug = '', $limit = -1 ) {
	$args = array(
		'post_type'      => ALPINE_PROJECT_POST_TYPE,
		'post_status'    => 'publish',
		'posts_per_page' => $limit,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		),
		'no_found_rows'  => true,
	);

	if ( $type_slug ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => ALPINE_PROJECT_TAXONOMY,
				'field'    => 'slug',
				'terms'    => $type_slug,
			),
		);
	}

	return get_posts( $args );
}

/**
 * One project card for the archive grids.
 */
function alpine_render_project_card( $post_id ) {
	$post_id  = (int) $post_id;
	$term     = alpine_project_type_term( $post_id );
	$location = alpine_project_field( 'project_location', $post_id );
	$summary  = alpine_project_summary( $post_id );
	$title    = get_the_title( $post_id );
	$url      = get_permalink( $post_id );
	$media    = alpine_project_media( $post_id, 'medium_large' );
	?>
	<article class="project-card" data-project-type="<?php echo esc_attr( $term ? $term->slug : 'all' ); ?>">
	  <?php if ( $media ) : ?>
		<a class="project-card-media" href="<?php echo esc_url( $url ); ?>" tabindex="-1" aria-hidden="true">
		  <?php echo $media; ?>
		  <?php if ( $term ) : ?>
			<span class="project-card-badge"><?php echo esc_html( $term->name ); ?></span>
		  <?php endif; ?>
		</a>
	  <?php endif; ?>
	  <div class="project-card-body">
		<?php if ( $location ) : ?>
		  <p class="project-card-location"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> <?php echo esc_html( $location ); ?></p>
		<?php endif; ?>
		<h3 class="project-card-title"><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a></h3>
		<?php if ( $summary ) : ?>
		  <p class="project-card-summary"><?php echo esc_html( wp_trim_words( $summary, 28, '…' ) ); ?></p>
		<?php endif; ?>
		<a class="project-card-link" href="<?php echo esc_url( $url ); ?>">
		  <span aria-hidden="true">View Project</span>
		  <span class="screen-reader-text"><?php echo esc_html( 'View project: ' . $title ); ?></span>
		  <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
		</a>
	  </div>
	</article>
	<?php
}

/**
 * Filter pills. Real links to the type archives, upgraded by projects.js into
 * in-place filtering when JavaScript is available.
 */
function alpine_render_project_filter( $active = 'all' ) {
	$options = array(
		array(
			'slug'  => 'all',
			'label' => 'All Projects',
			'url'   => alpine_projects_archive_url(),
		),
	);

	foreach ( array( 'residential', 'commercial' ) as $slug ) {
		$term = get_term_by( 'slug', $slug, ALPINE_PROJECT_TAXONOMY );

		if ( $term instanceof WP_Term && $term->count > 0 ) {
			$options[] = array(
				'slug'  => $slug,
				'label' => $term->name,
				'url'   => alpine_project_type_url( $slug ),
			);
		}
	}

	if ( count( $options ) < 3 ) {
		return;
	}
	?>
	<div class="project-filter" data-project-filter role="group" aria-label="Filter projects by type">
	  <?php foreach ( $options as $option ) : ?>
		<a class="project-filter-pill<?php echo $active === $option['slug'] ? ' is-active' : ''; ?>"
		   href="<?php echo esc_url( $option['url'] ); ?>"
		   data-project-filter-value="<?php echo esc_attr( $option['slug'] ); ?>"<?php echo $active === $option['slug'] ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $option['label'] ); ?></a>
	  <?php endforeach; ?>
	</div>
	<?php
}

/**
 * The closing CTA shared by the archive and every project page.
 */
function alpine_render_projects_cta( $heading = '', $body = '' ) {
	$heading = $heading ? $heading : alpine_projects_copy( 'cta_heading' );
	$body    = $body ? $body : alpine_projects_copy( 'cta_text' );
	$phone   = function_exists( 'alpine_get_setting' ) ? alpine_get_setting( 'phone_number', '(512) 759-4247' ) : '(512) 759-4247';
	?>
	<div class="project-cta-panel">
	  <div class="project-cta-copy">
		<span class="section-pill">Talk To Alpine</span>
		<h2><?php echo esc_html( $heading ); ?></h2>
		<p><?php echo esc_html( $body ); ?></p>
	  </div>
	  <div class="project-cta-actions">
		<a class="btn service-cta-btn" href="<?php echo esc_url( alpine_get_site_page_url( 'contact' ) ); ?>">Contact Alpine</a>
		<a class="btn project-cta-phone" href="<?php echo esc_attr( alpine_tel_href( $phone ) ); ?>">
		  <i class="fa-solid fa-phone-volume" aria-hidden="true"></i> <?php echo esc_html( $phone ); ?>
		</a>
	  </div>
	</div>
	<?php
}

/**
 * Cross-links back into the projects section, so every project page offers a
 * route to the archive, both type archives, and Contact.
 */
function alpine_render_project_nav_links() {
	$links = array(
		array(
			'url'   => alpine_projects_archive_url(),
			'label' => 'All Projects',
		),
	);

	foreach ( array( 'residential', 'commercial' ) as $slug ) {
		$term = get_term_by( 'slug', $slug, ALPINE_PROJECT_TAXONOMY );

		if ( $term instanceof WP_Term && $term->count > 0 ) {
			$links[] = array(
				'url'   => alpine_project_type_url( $slug ),
				'label' => $term->name . ' Projects',
			);
		}
	}

	$links[] = array(
		'url'   => alpine_get_site_page_url( 'contact' ),
		'label' => 'Contact Alpine',
	);
	?>
	<nav class="project-jump-links" aria-label="Projects navigation">
	  <?php foreach ( $links as $link ) : ?>
		<a class="project-jump-link" href="<?php echo esc_url( $link['url'] ); ?>">
		  <?php echo esc_html( $link['label'] ); ?>
		  <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
		</a>
	  <?php endforeach; ?>
	</nav>
	<?php
}

/* -------------------------------------------------------------------------
 * Archive
 * ---------------------------------------------------------------------- */

/**
 * Render the Projects archive, or a single-type view of it.
 *
 * @param string $type_slug '' for the full archive, or 'residential'/'commercial'.
 */
function alpine_render_projects_archive( $type_slug = '' ) {
	$term = $type_slug ? get_term_by( 'slug', $type_slug, ALPINE_PROJECT_TAXONOMY ) : null;
	$term = $term instanceof WP_Term ? $term : null;

	if ( $term ) {
		$chip     = 'Completed Work';
		$title    = $term->name . ' Projects';
		$intro    = $term->description ? $term->description : alpine_projects_copy( 'intro' );
		$sections = array(
			array(
				'slug'    => $term->slug,
				'heading' => $term->name . ' Projects',
				'blurb'   => '',
			),
		);
		$crumbs   = array(
			array( 'label' => 'Home', 'url' => home_url( '/' ) ),
			array( 'label' => 'Projects', 'url' => alpine_projects_archive_url() ),
			array( 'label' => $term->name ),
		);
	} else {
		$chip  = alpine_projects_copy( 'chip' );
		$title = alpine_projects_copy( 'title' );
		$intro = alpine_projects_copy( 'intro' );

		// Section headings and blurbs come from the terms themselves, so they
		// are editable under Projects > Project Types rather than baked in here.
		// Renaming a term renames its section; new terms show up automatically.
		$sections = array();

		foreach ( get_terms(
			array(
				'taxonomy'   => ALPINE_PROJECT_TAXONOMY,
				'hide_empty' => true,
				'orderby'    => 'name',
			)
		) as $section_term ) {
			if ( $section_term instanceof WP_Term ) {
				$sections[] = array(
					'slug'    => $section_term->slug,
					'heading' => $section_term->name . ' Projects',
					'blurb'   => $section_term->description,
				);
			}
		}

		$crumbs = array(
			array( 'label' => 'Home', 'url' => home_url( '/' ) ),
			array( 'label' => 'Projects' ),
		);
	}

	get_header();
	?>
<div class="service-page installation-page projects-page projects-archive-page">
  <section class="page-hero">
	<div class="container hero-content">
	  <div>
		<span class="hero-chip"><?php echo esc_html( $chip ); ?></span>
		<h1><?php echo esc_html( $title ); ?></h1>
		<?php alpine_breadcrumb_nav( $crumbs ); ?>
	  </div>
	  <strong>Air Conditioning and Heating Specialists</strong>
	</div>
	<div class="hero-badge">
	  <span>o</span>
	</div>
  </section>

  <main>
	<section class="section-space">
	  <div class="container">
		<div class="service-copy-wrap">
		  <?php if ( $intro ) : ?>
			<p class="service-intro projects-intro"><?php echo esc_html( $intro ); ?></p>
		  <?php endif; ?>

		  <?php alpine_render_project_filter( $term ? $term->slug : 'all' ); ?>

		  <?php
		  $rendered_any = false;

		  foreach ( $sections as $section ) :
			  $projects = alpine_get_projects( $section['slug'] );

			  if ( empty( $projects ) ) {
				  continue;
			  }

			  $rendered_any = true;
			  ?>
			<section class="project-section" id="<?php echo esc_attr( $section['slug'] . '-projects' ); ?>" data-project-section="<?php echo esc_attr( $section['slug'] ); ?>">
			  <h2 class="section-title"><?php echo esc_html( $section['heading'] ); ?></h2>
			  <?php if ( $section['blurb'] ) : ?>
				<p class="service-intro"><?php echo esc_html( $section['blurb'] ); ?></p>
			  <?php endif; ?>

			  <div class="project-grid">
				<?php foreach ( $projects as $project ) : ?>
				  <?php alpine_render_project_card( $project->ID ); ?>
				<?php endforeach; ?>
			  </div>
			</section>
		  <?php endforeach; ?>

		  <?php if ( ! $rendered_any ) : ?>
			<p class="service-intro">Project write-ups are on the way. In the meantime, <a href="<?php echo esc_url( alpine_get_site_page_url( 'contact' ) ); ?>">contact Alpine</a> to talk through the work you need.</p>
		  <?php endif; ?>

		  <?php alpine_render_projects_cta(); ?>

		  <?php alpine_render_service_area_links_section(); ?>
		</div>
	  </div>
	</section>

	<section class="service-strip">
	  <div class="container">
		<strong>Quality heating &amp; air conditioning solutions</strong>
		<a href="<?php echo esc_url( alpine_get_site_page_url( 'contact' ) ); ?>" class="btn service-cta-btn">Schedule Appointment</a>
	  </div>
	</section>
  </main>
</div>
	<?php
	get_footer();
}

/* -------------------------------------------------------------------------
 * Single project
 * ---------------------------------------------------------------------- */

function alpine_render_single_project() {
	$post_id  = get_the_ID();
	$term     = alpine_project_type_term( $post_id );
	$location = alpine_project_field( 'project_location', $post_id );
	$service  = alpine_project_field( 'project_service', $post_id );
	$overview = alpine_project_rich_text( alpine_project_rich_field( 'project_overview', $post_id ) );
	// The template already supplies the section heading. Remove a duplicated
	// leading heading from generated/editor content while preserving all of the
	// project's real subheadings.
	$overview = preg_replace( '/^\s*<h2[^>]*>\s*Project Overview\s*<\/h2>\s*/i', '', $overview, 1 );
	$overview_parts   = preg_split( '/(?=<h2\b)/i', $overview, 2 );
	$overview_intro   = isset( $overview_parts[0] ) ? $overview_parts[0] : '';
	$overview_details = isset( $overview_parts[1] ) ? $overview_parts[1] : '';
	$issue    = alpine_project_rich_text( alpine_project_rich_field( 'project_issue', $post_id ) );
	$work     = alpine_project_work_html( $post_id );
	$equip    = alpine_project_equipment_rows( $post_id );
	$gallery  = alpine_project_gallery_ids( $post_id );

	$crumbs = array( array( 'label' => 'Home', 'url' => home_url( '/' ) ) );
	$crumbs[] = array( 'label' => 'Projects', 'url' => alpine_projects_archive_url() );

	if ( $term ) {
		$crumbs[] = array( 'label' => $term->name, 'url' => alpine_project_type_url( $term->slug ) );
	}

	$crumbs[] = array( 'label' => get_the_title( $post_id ) );

	$facts = array();

	// Icon variants match the theme's Font Awesome subset — folder and file-lines
	// are only bundled in the regular face, so fa-solid would render nothing.
	if ( $location ) {
		$facts[] = array( 'icon' => 'fa-solid fa-location-dot', 'label' => 'Location', 'value' => $location );
	}
	if ( $term ) {
		$facts[] = array( 'icon' => 'fa-regular fa-folder', 'label' => 'Project Type', 'value' => $term->name );
	}
	if ( $service ) {
		$facts[] = array( 'icon' => 'fa-regular fa-file-lines', 'label' => 'Service Provided', 'value' => $service );
	}

	get_header();
	?>
<div class="service-page installation-page projects-page project-single-page">
  <section class="page-hero project-hero">
	<div class="container hero-content">
	  <div>
		<span class="hero-chip"><?php echo esc_html( $term ? $term->name . ' Project' : 'Completed Project' ); ?></span>
		<h1><?php the_title(); ?></h1>
		<?php alpine_breadcrumb_nav( $crumbs ); ?>
	  </div>
	  <strong>Air Conditioning and Heating Specialists</strong>
	</div>
	<div class="hero-badge">
	  <span>o</span>
	</div>
  </section>

  <main>
	<section class="section-space">
	  <div class="container">
		<div class="service-copy-wrap">

		  <?php if ( $facts ) : ?>
			<dl class="project-facts">
			  <?php foreach ( $facts as $fact ) : ?>
				<div class="project-fact">
				  <dt><i class="<?php echo esc_attr( $fact['icon'] ); ?>" aria-hidden="true"></i> <?php echo esc_html( $fact['label'] ); ?></dt>
				  <dd><?php echo esc_html( $fact['value'] ); ?></dd>
				</div>
			  <?php endforeach; ?>
			</dl>
		  <?php endif; ?>

		  <section class="project-overview-section">
			<h2 class="section-title">Project <span class="highlight">overview</span></h2>
			<?php $featured_media = alpine_project_media( $post_id, 'large' ); ?>
			<div class="project-overview-lead<?php echo $featured_media ? '' : ' project-overview-lead-no-image'; ?>">
			  <?php // Editor HTML, already run through wp_kses_post by alpine_project_rich_text(). ?>
			  <div class="project-rich-text project-overview-copy"><?php echo $overview_intro; ?></div>
			  <?php if ( $featured_media ) : ?>
				<figure class="service-photo-card project-featured-photo">
				  <?php echo $featured_media; ?>
				</figure>
			  <?php endif; ?>
			</div>
			<?php if ( $overview_details ) : ?>
			  <div class="project-rich-text project-overview-copy project-overview-details"><?php echo $overview_details; ?></div>
			<?php endif; ?>
		  </section>

		  <?php if ( $issue || $work ) : ?>
			<?php // Some jobs give us only a reported issue, or only a work list. A lone half-width panel reads as a layout bug, so it spans instead. ?>
			<div class="service-panel-grid project-detail-panels<?php echo ( $issue && $work ) ? '' : ' project-detail-panels-single'; ?>">
			  <?php if ( $issue ) : ?>
				<article class="service-info-panel">
				  <span class="section-pill">Issue</span>
				  <h2>What the customer reported</h2>
				  <div class="project-rich-text"><?php echo $issue; ?></div>
				</article>
			  <?php endif; ?>

			  <?php if ( $work ) : ?>
				<article class="service-info-panel service-info-panel-alt">
				  <span class="section-pill">On Site</span>
				  <h2>Work performed</h2>
				  <div class="project-rich-text project-work-list"><?php echo $work; ?></div>
				</article>
			  <?php endif; ?>
			</div>
		  <?php endif; ?>

		  <?php if ( $equip ) : ?>
			<section class="project-equipment">
			  <h2 class="section-title">Equipment <span class="highlight">details</span></h2>
			  <div class="project-equipment-table-wrap">
				<table class="project-equipment-table">
				  <tbody>
					<?php foreach ( $equip as $row ) : ?>
					  <tr>
						<?php if ( '' !== $row['label'] ) : ?>
						  <th scope="row"><?php echo esc_html( $row['label'] ); ?></th>
						  <td><?php echo esc_html( $row['value'] ); ?></td>
						<?php else : ?>
						  <td colspan="2"><?php echo esc_html( $row['value'] ); ?></td>
						<?php endif; ?>
					  </tr>
					<?php endforeach; ?>
				  </tbody>
				</table>
			  </div>
			</section>
		  <?php endif; ?>

		  <?php if ( $gallery ) : ?>
			<section class="project-gallery">
			  <h2 class="section-title">Project <span class="highlight">photos</span></h2>
			  <div class="project-gallery-grid">
				<?php foreach ( $gallery as $index => $image_id ) : ?>
				  <figure class="project-gallery-item">
					<?php
					echo wp_get_attachment_image(
						$image_id,
						'large',
						false,
						array(
							'alt'      => alpine_project_image_alt( $image_id, $post_id, $index + 2 ),
							'loading'  => 'lazy',
							'decoding' => 'async',
						)
					);
					?>
				  </figure>
				<?php endforeach; ?>
			  </div>
			</section>
		  <?php endif; ?>

		  <?php alpine_render_projects_cta(); ?>

		  <?php alpine_render_project_nav_links(); ?>
		</div>
	  </div>
	</section>

	<section class="service-strip">
	  <div class="container">
		<strong>Quality heating &amp; air conditioning solutions</strong>
		<a href="<?php echo esc_url( alpine_get_site_page_url( 'contact' ) ); ?>" class="btn service-cta-btn">Schedule Appointment</a>
	  </div>
	</section>
  </main>
</div>
	<?php
	get_footer();
}
