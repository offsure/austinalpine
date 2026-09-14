<?php
// The sitewide FAQ band (alpine_render_sitewide_faq_section) was removed from
// the site 2026-07-29 at the owner's request. Its renderer still lives in
// inc/shared-faq-section.php — alpine_render_faq_schema() there is still used
// by the service-page FAQ accordions — so re-enabling is a one-line call here.

$footer_email   = alpine_get_setting( 'email_general', 'info@austinalpine.com' );
$footer_license = alpine_get_setting( 'license_residential', 'TACLB 21462E' );

if ( is_page_template( 'commercial-hvac-austin-tx.php' ) || is_page_template( 'page-office-buildings.php' ) || is_page_template( 'page-medical-healthcare-facilities.php' ) || is_page_template( 'page-manufacturing-plants.php' ) || is_page_template( 'page-warehouse-industrial-facilities.php' ) || is_page_template( 'page-apartments-condominiums.php' ) || is_page_template( 'page-high-rise-residential-properties.php' ) || is_page_template( 'page-it-data-centers.php' ) || is_page_template( 'page-retail-food-service.php' ) || is_page_template( 'page-school-education-facilities.php' ) ) {
    $footer_email   = alpine_get_setting( 'email_commercial', 'commercial@austinalpine.com' );
    $footer_license = alpine_get_setting( 'license_commercial', 'TACLA146295E' );
}

$footer_address      = alpine_get_setting( 'address', '1205 Sheldon Cove Bldg. 2, Ste. J., Austin, TX 78753' );
$footer_phone        = alpine_get_setting( 'phone_number', '(512) 759-4247' );
$footer_hours_week   = alpine_get_setting( 'hours_weekday', 'Mon - Fri: 7:00 AM - 7:00 PM' );
$footer_hours_wkend  = alpine_get_setting( 'hours_weekend', 'Saturday-Sunday: Emergency services available' );
$footer_facebook_url = alpine_get_setting( 'facebook_url', 'https://www.facebook.com/austinalpine/' );
$footer_yelp_url     = alpine_get_setting( 'yelp_url', 'https://www.yelp.com/biz/alpine-heating-and-air-conditioning-austin' );
$footer_twitter_url  = alpine_get_setting( 'twitter_url', 'https://twitter.com/austinalpineair' );
?>

  <footer id="contact" class="footer pt-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4">
<!--           <a class="footer-logo-link" href="index.html"><img loading="lazy" decoding="async" src="assets/images/logo.webp" alt="Alpine Heating & Air Conditioning" class="site-logo site-logo-footer"></a> -->
<!-- Logo -->

<?php
if ( has_custom_logo() ) {
    the_custom_logo();
} else {
?>
    <img loading="lazy" decoding="async" src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/logo.webp' ); ?>" alt="<?php bloginfo('name'); ?>" class="site-logo-nav" width="243" height="111">
<?php } ?>
          <div class="footer-brand-details">
            <div class="footer-contact-line">
              <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
              <span><?php echo esc_html( $footer_address ); ?></span>
            </div>
            <div class="footer-contact-line">
              <i class="fa-regular fa-id-badge" aria-hidden="true"></i>
              <span>HVAC LICENSE# <?php echo esc_html( $footer_license ); ?></span>
            </div>
          </div>

          <div class="footer-payments">
            <h2 class="h6 text-white">We Accept</h2>
            <div class="footer-payment" aria-label="Accepted payment methods">
              <img loading="lazy" decoding="async" src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/ft_cards1.webp' ); ?>" alt="Accepted payment methods">
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-2">
          <h2 class="h6 text-white">Company</h2>
          <ul class="list-unstyled footer-links">
            <li><a href="<?php echo esc_url(alpine_get_site_page_url('about')); ?>">About</a></li>
            <li><a href="<?php echo esc_url(alpine_get_site_page_url('services')); ?>">Services</a></li>
            <li><a href="<?php echo esc_url(alpine_get_site_page_url('specials')); ?>">Specials</a></li>
            <li><a href="<?php echo esc_url(alpine_get_site_page_url('privacy')); ?>">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="col-6 col-lg-2">
          <h2 class="h6 text-white">Support</h2>
          <ul class="list-unstyled footer-links">
            <li><a href="<?php echo esc_url(alpine_get_site_page_url('resources')); ?>">Resources</a></li>
            <li><a href="<?php echo esc_url(alpine_get_page_url('blog', array(), '/blog/')); ?>">Blog</a></li>
            <li><a href="<?php echo esc_url(alpine_get_site_page_url('contact')); ?>">Contact</a></li>
            <li><a href="<?php echo esc_url(alpine_get_site_page_url('estimate')); ?>">Estimate</a></li>
            <?php
            // giveratings.com profile went dead (server error); send review
            // traffic to the same Google reviews destination the homepage uses.
            $alpine_rate_url = function_exists( 'alpine_get_google_reviews_option' ) ? alpine_get_google_reviews_option( 'google_url' ) : '';
            if ( '' === $alpine_rate_url ) {
                $alpine_rate_url = 'https://www.google.com/maps/place/Alpine+Heating+%26+Air+Conditioning/@30.3447804,-97.68545,638m/data=!3m1!1e3!4m8!3m7!1s0x8644cb9622becf43:0xdb75f99757ea2077!8m2!3d30.3447804!4d-97.68545!9m1!1b1!16s%2Fg%2F11bbrjc3d0?hl=en&entry=ttu';
            }
            ?>
            <li><a href="<?php echo esc_url( $alpine_rate_url ); ?>" target="_blank" rel="noopener">Rate Our Technician</a></li>
          </ul>
        </div>
        <div class="col-lg-4">
          <h2 class="h6 text-white">Contact</h2>
          <div class="footer-contact-column">
            <div class="footer-contact-line">
              <i class="fa-solid fa-phone-volume" aria-hidden="true"></i>
              <a href="<?php echo esc_attr( alpine_tel_href( $footer_phone ) ); ?>"><?php echo esc_html( $footer_phone ); ?></a>
            </div>
            <div class="footer-contact-line">
              <i class="fa-solid fa-envelope" aria-hidden="true"></i>
              <a href="mailto:<?php echo esc_attr( $footer_email ); ?>"><?php echo esc_html( $footer_email ); ?></a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-meta-inner">
        <div class="footer-meta-items">
          <span><i class="fa-regular fa-clock" aria-hidden="true"></i> <?php echo esc_html( $footer_hours_week ); ?></span>
          <span><i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i> <?php echo esc_html( $footer_hours_wkend ); ?></span>
          <span><i class="fa-regular fa-id-badge" aria-hidden="true"></i> HVAC License: <?php echo esc_html( $footer_license ); ?></span>
          <span><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Austin, TX</span>
        </div>
        <div class="footer-meta-social">
          <span class="footer-meta-label"><i class="fa-solid fa-share-nodes" aria-hidden="true"></i> Follow us:</span>
          <?php if ( $footer_facebook_url ) : ?><a href="<?php echo esc_url( $footer_facebook_url ); ?>" target="_blank" class="social-link" aria-label="Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a><?php endif; ?>

          <?php if ( $footer_yelp_url ) : ?><a href="<?php echo esc_url( $footer_yelp_url ); ?>" target="_blank" class="social-link" aria-label="Yelp"><i class="fa-brands fa-yelp" aria-hidden="true"></i></a><?php endif; ?>
          <?php if ( $footer_twitter_url ) : ?><a href="<?php echo esc_url( $footer_twitter_url ); ?>" target="_blank" class="social-link" aria-label="X"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a><?php endif; ?>
        </div>
      </div>
    <div class="copyright py-3 mt-4 border-top border-secondary text-white-50 small text-center">
    <span>
        &copy; <?php echo date('Y'); ?> Alpine Heating &amp; Air Conditioning. All rights reserved.
    </span>
</div>
    </div>
  </footer>

<?php wp_footer(); ?>

</body>
</html>
