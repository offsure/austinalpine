<?php
/**
 * 404 template.
 */

get_header();
?>
</header>

<main class="container py-5">
  <h1 class="section-title">Page not found</h1>
  <p>The page you were looking for may have moved, or the address may have a typo in it. Here are a few places worth trying next:</p>
  <ul>
    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Homepage</a></li>
    <li><a href="<?php echo esc_url( alpine_get_site_page_url( 'services' ) ); ?>">Air Conditioning Services</a></li>
    <li><a href="<?php echo esc_url( alpine_get_page_url( 'heating-services', array(), '/heating-services/' ) ); ?>">Heating Services</a></li>
    <li><a href="<?php echo esc_url( alpine_get_site_page_url( 'service_areas' ) ); ?>">Service Areas</a></li>
    <li><a href="<?php echo esc_url( alpine_get_site_page_url( 'estimate' ) ); ?>">Request an Estimate</a></li>
    <li><a href="<?php echo esc_url( alpine_get_site_page_url( 'contact' ) ); ?>">Contact Us</a></li>
  </ul>
  <p>Prefer to talk it through? Call <a href="tel:+15127594247">(512) 759-4247</a> and we&rsquo;ll get you to the right place.</p>
</main>

<?php get_footer(); ?>
