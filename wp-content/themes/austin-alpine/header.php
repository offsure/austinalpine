<!doctype html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/vendor/fontawesome/webfonts/fa-solid-900.subset.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
<?php if ( is_front_page() ) : ?>
<link rel="preload" href="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/hero-slider-1.webp' ); ?>" as="image" fetchpriority="high">
<?php endif; ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<header>

<!-- Navigation -->

<nav class="navbar navbar-expand-lg navbar-dark main-nav">

<div class="container">

<!-- Logo -->

<?php
if ( has_custom_logo() ) {
    the_custom_logo();
} else {
?>
    <img src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/logo.webp' ); ?>" alt="<?php bloginfo('name'); ?>" class="site-logo-nav" width="243" height="111">
<?php } ?>


<!-- Toggler -->
<button class="navbar-toggler border-0"
type="button"
data-bs-toggle="collapse"
data-bs-target="#mainMenu"
aria-controls="mainMenu"
aria-expanded="false"
aria-label="Toggle navigation">

<span class="navbar-toggler-icon"></span>

</button>

<!-- Menu -->
<div class="collapse navbar-collapse" id="mainMenu">

<?php alpine_render_primary_menu(); ?>

<?php
$alpine_header_phone = alpine_get_setting( 'phone_number', '(512) 759-4247' );
$alpine_header_cta   = alpine_get_setting( 'header_cta_label', 'Request Estimate' );
?>
<div class="header-actions">
<a href="<?php echo esc_attr( alpine_tel_href( $alpine_header_phone ) ); ?>"
class="btn btn-warning rounded-pill px-4 fw-semibold header-phone-cta">

<i class="fa-solid fa-phone-volume" aria-hidden="true"></i>
<span><?php echo esc_html( $alpine_header_phone ); ?></span>

</a>

<!-- Button -->
<a href="<?php echo esc_url(alpine_get_site_page_url('estimate')); ?>"
class="btn btn-light rounded-pill px-4 fw-semibold header-cta">

<i class="fa-regular fa-file-lines" aria-hidden="true"></i>
<span><?php echo esc_html( $alpine_header_cta ); ?></span>

</a>
</div>

</div>

</div>

</nav>

</header>
