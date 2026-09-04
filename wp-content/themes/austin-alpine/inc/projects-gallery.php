<?php
/**
 * Project photo gallery: an unlimited, drag-to-reorder image picker.
 *
 * ACF's Gallery field is Pro-only and this site runs ACF free, so rather than
 * fake it with a fixed set of numbered image fields, this is a small meta box
 * built on the WordPress media modal. It gives editors what a gallery field
 * would: select many images at once, reorder by dragging, remove individually,
 * and — because alt text is the piece that actually matters for SEO and
 * accessibility — edit each image's alt text inline without leaving the screen.
 *
 * Stored as a comma-separated list of attachment IDs in the `project_gallery`
 * post meta, the same shape ACF Pro's gallery field uses, so migrating to Pro
 * later would be a drop-in.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_stylesheet_directory() . '/inc/projects.php';

const ALPINE_PROJECT_GALLERY_META = 'project_gallery';

/* -------------------------------------------------------------------------
 * Meta box
 * ---------------------------------------------------------------------- */

add_action( 'add_meta_boxes', 'alpine_project_add_gallery_meta_box' );
function alpine_project_add_gallery_meta_box() {
	add_meta_box(
		'alpine-project-gallery',
		__( 'Project Photos', 'austin-alpine' ),
		'alpine_project_render_gallery_meta_box',
		ALPINE_PROJECT_POST_TYPE,
		'normal',
		'high'
	);
}

function alpine_project_render_gallery_meta_box( $post ) {
	wp_nonce_field( 'alpine_project_save_gallery', 'alpine_project_gallery_nonce' );

	$ids = alpine_project_gallery_ids( $post->ID, false );
	?>
	<div class="alpine-gallery" data-alpine-gallery>
		<p class="alpine-gallery-intro">
			<?php esc_html_e( 'Add as many photos as you like — there is no limit. Drag to reorder; the first photo leads the gallery on the project page.', 'austin-alpine' ); ?>
			<br>
			<?php
			printf(
				/* translators: %s: "Featured image" wrapped in <strong>. */
				esc_html__( 'The %s in the right-hand column is separate: it heads the project page and fronts the archive card. It is filtered out of the gallery below so it never appears twice.', 'austin-alpine' ),
				'<strong>' . esc_html__( 'Featured image', 'austin-alpine' ) . '</strong>'
			);
			?>
		</p>

		<ul class="alpine-gallery-list" data-alpine-gallery-list>
			<?php foreach ( $ids as $id ) : ?>
				<?php alpine_project_render_gallery_item( $id ); ?>
			<?php endforeach; ?>
		</ul>

		<p class="alpine-gallery-empty" data-alpine-gallery-empty <?php echo $ids ? 'hidden' : ''; ?>>
			<?php esc_html_e( 'No photos yet. No image will be shown on the project page until you add verified project photos.', 'austin-alpine' ); ?>
		</p>

		<p class="alpine-gallery-actions">
			<button type="button" class="button button-primary" data-alpine-gallery-add>
				<?php esc_html_e( 'Add photos', 'austin-alpine' ); ?>
			</button>
			<button type="button" class="button" data-alpine-gallery-clear <?php echo $ids ? '' : 'hidden'; ?>>
				<?php esc_html_e( 'Remove all', 'austin-alpine' ); ?>
			</button>
		</p>

		<input type="hidden" name="<?php echo esc_attr( ALPINE_PROJECT_GALLERY_META ); ?>"
			   value="<?php echo esc_attr( implode( ',', $ids ) ); ?>" data-alpine-gallery-input>
	</div>
	<?php
}

/**
 * One thumbnail row. Also used as the shape the JS builds for newly added
 * images, so keep the two in step.
 */
function alpine_project_render_gallery_item( $id ) {
	$id  = (int) $id;
	$src = wp_get_attachment_image_src( $id, 'thumbnail' );

	if ( ! $src ) {
		return;
	}

	$alt = (string) get_post_meta( $id, '_wp_attachment_image_alt', true );
	?>
	<li class="alpine-gallery-item" data-alpine-gallery-item data-id="<?php echo esc_attr( $id ); ?>">
		<span class="alpine-gallery-handle" title="<?php esc_attr_e( 'Drag to reorder', 'austin-alpine' ); ?>">
			<span class="dashicons dashicons-menu"></span>
		</span>

		<img class="alpine-gallery-thumb" src="<?php echo esc_url( $src[0] ); ?>" alt="" width="80" height="80">

		<span class="alpine-gallery-fields">
			<label class="alpine-gallery-label" for="<?php echo esc_attr( 'alpine-alt-' . $id ); ?>">
				<?php esc_html_e( 'Alt text', 'austin-alpine' ); ?>
				<span class="alpine-gallery-alt-warning"<?php echo '' !== trim( $alt ) ? ' hidden' : ''; ?>>
					<?php esc_html_e( '— empty, please describe this photo', 'austin-alpine' ); ?>
				</span>
			</label>
			<input type="text"
				   id="<?php echo esc_attr( 'alpine-alt-' . $id ); ?>"
				   class="widefat alpine-gallery-alt"
				   name="alpine_project_alt[<?php echo esc_attr( $id ); ?>]"
				   value="<?php echo esc_attr( $alt ); ?>"
				   placeholder="<?php esc_attr_e( 'Describe what this photo shows', 'austin-alpine' ); ?>">
		</span>

		<button type="button" class="button-link alpine-gallery-remove" data-alpine-gallery-remove>
			<span class="dashicons dashicons-no-alt"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Remove this photo', 'austin-alpine' ); ?></span>
		</button>
	</li>
	<?php
}

/* -------------------------------------------------------------------------
 * Save
 * ---------------------------------------------------------------------- */

add_action( 'save_post_' . ALPINE_PROJECT_POST_TYPE, 'alpine_project_save_gallery', 10, 2 );
function alpine_project_save_gallery( $post_id, $post ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( wp_is_post_revision( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$nonce = isset( $_POST['alpine_project_gallery_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['alpine_project_gallery_nonce'] ) ) : '';

	if ( ! $nonce || ! wp_verify_nonce( $nonce, 'alpine_project_save_gallery' ) ) {
		return;
	}

	/* --- Gallery order --- */
	$raw = isset( $_POST[ ALPINE_PROJECT_GALLERY_META ] ) ? sanitize_text_field( wp_unslash( $_POST[ ALPINE_PROJECT_GALLERY_META ] ) ) : '';
	$ids = array();

	foreach ( array_filter( explode( ',', $raw ) ) as $id ) {
		$id = (int) trim( $id );

		// Only real image attachments, and never the same one twice.
		if ( $id > 0 && ! in_array( $id, $ids, true ) && wp_attachment_is_image( $id ) ) {
			$ids[] = $id;
		}
	}

	if ( $ids ) {
		update_post_meta( $post_id, ALPINE_PROJECT_GALLERY_META, implode( ',', $ids ) );
	} else {
		delete_post_meta( $post_id, ALPINE_PROJECT_GALLERY_META );
	}

	/* --- Alt text, written back onto each attachment --- */
	if ( isset( $_POST['alpine_project_alt'] ) && is_array( $_POST['alpine_project_alt'] ) ) {
		foreach ( wp_unslash( $_POST['alpine_project_alt'] ) as $attachment_id => $alt ) {
			$attachment_id = (int) $attachment_id;

			if ( $attachment_id < 1 || ! wp_attachment_is_image( $attachment_id ) ) {
				continue;
			}

			update_post_meta( $attachment_id, '_wp_attachment_image_alt', sanitize_text_field( $alt ) );
		}
	}
}

/* -------------------------------------------------------------------------
 * Admin assets
 * ---------------------------------------------------------------------- */

add_action( 'admin_enqueue_scripts', 'alpine_project_enqueue_gallery_assets' );
function alpine_project_enqueue_gallery_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}

	if ( ALPINE_PROJECT_POST_TYPE !== get_post_type() ) {
		return;
	}

	wp_enqueue_media();

	$css = get_stylesheet_directory() . '/assets/css/projects-admin.css';
	$js  = get_stylesheet_directory() . '/assets/js/projects-admin.js';

	wp_enqueue_style(
		'alpine-projects-admin',
		get_stylesheet_directory_uri() . '/assets/css/projects-admin.css',
		array(),
		file_exists( $css ) ? (string) filemtime( $css ) : false
	);

	wp_enqueue_script(
		'alpine-projects-admin',
		get_stylesheet_directory_uri() . '/assets/js/projects-admin.js',
		array( 'jquery', 'jquery-ui-sortable' ),
		file_exists( $js ) ? (string) filemtime( $js ) : false,
		true
	);

	wp_localize_script(
		'alpine-projects-admin',
		'alpineProjectGallery',
		array(
			'title'      => __( 'Select project photos', 'austin-alpine' ),
			'button'     => __( 'Add to gallery', 'austin-alpine' ),
			'altLabel'   => __( 'Alt text', 'austin-alpine' ),
			'altWarning' => __( '— empty, please describe this photo', 'austin-alpine' ),
			'altPlace'   => __( 'Describe what this photo shows', 'austin-alpine' ),
			'remove'     => __( 'Remove this photo', 'austin-alpine' ),
			'reorder'    => __( 'Drag to reorder', 'austin-alpine' ),
			'confirm'    => __( 'Remove all photos from this project gallery?', 'austin-alpine' ),
		)
	);
}
