<?php
/**
 * Single project / case study — /projects/{slug}/
 */

require_once get_stylesheet_directory() . '/inc/projects-render.php';

if ( have_posts() ) {
	the_post();
}

alpine_render_single_project();
