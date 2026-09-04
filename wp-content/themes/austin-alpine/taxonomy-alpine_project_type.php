<?php
/**
 * Residential / Commercial project archives — /projects/type/{slug}/
 */

require_once get_stylesheet_directory() . '/inc/projects-render.php';

$alpine_project_term = get_queried_object();

alpine_render_projects_archive( $alpine_project_term instanceof WP_Term ? $alpine_project_term->slug : '' );
