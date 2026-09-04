<?php
/*
Template Name: Service Areas
*/

require_once get_stylesheet_directory() . '/inc/service-area-template.php';

$service_areas = function_exists( 'alpine_service_area_locations' ) ? alpine_service_area_locations() : array();
$contact_url   = function_exists( 'alpine_get_site_page_url' ) ? alpine_get_site_page_url( 'contact' ) : home_url( '/contact-us/' );
$estimate_url  = function_exists( 'alpine_get_site_page_url' ) ? alpine_get_site_page_url( 'estimate' ) : home_url( '/request-an-estimate/' );

get_header();
?>
<main class="service-page installation-page service-areas-page">
  <section class="page-hero">
    <div class="container hero-content">
      <div>
        <span class="hero-chip">Coverage Area</span>
        <h1><?php echo esc_html( get_the_title() ?: 'Service Areas' ); ?></h1>
        <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => get_the_title() ?: 'Service Areas'),
          )); ?>
      </div>
      <strong>Air Conditioning and Heating Specialists</strong>
    </div>
    <div class="hero-badge">
      <span>o</span>
    </div>
  </section>
</header>

  <section class="section-space">
    <div class="container">
      <div class="service-copy-wrap service-area-directory">
        <section class="service-area-directory-hero">
          <div class="service-area-directory-copy">
            <span class="section-pill">Greater Austin Coverage</span>
            <h2 class="section-title">HVAC <span class="highlight">service areas</span> in and around Austin, TX</h2>
            <p class="service-intro">Alpine Heating &amp; Air Conditioning provides air conditioning and heating service across Austin and the surrounding communities. Every city we serve is listed below, each with its own local page covering common repairs, coverage details, and scheduling.</p>
            <p class="service-intro">Our current service areas include Austin, Bee Cave, Cedar Park, Cedar Valley, Hutto, Lakeway, Leander, Lost Creek, Manor, Pflugerville, Rollingwood, Round Rock, Sunset Valley, The Hills, Volente, and West Lake Hills.</p>

            <div class="service-area-directory-notes">
              <span>Austin-area HVAC coverage</span>
              <span>Heating and cooling service</span>
              <span>Residential comfort support</span>
            </div>
          </div>

          <div class="service-area-directory-visual">
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/ductless-service.jpg')); ?>" alt="HVAC technician working inside a Central Texas home">
            </article>
            <div class="service-area-directory-summary">
              <div>
                <strong>Service area coverage</strong>
                <span>Austin and nearby communities supported by Alpine Heating &amp; Air Conditioning.</span>
              </div>
              <div>
                <strong>Scheduling made simple</strong>
                <span>Reach out for repair, maintenance, installation, or replacement service in your area.</span>
              </div>
            </div>
          </div>
        </section>

        <section class="service-area-directory-benefits">
          <div class="service-feature-grid">
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Austin Area Coverage</h3>
                <p>Austin, Cedar Park, Pflugerville, Round Rock, Lakeway, and nearby communities are all inside our regular service area.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Cooling and Heating Service</h3>
                <p>Coverage includes AC repair, HVAC maintenance, system installation, replacement planning, and general comfort support.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Fast Local Reach</h3>
                <p>Our service area is built around nearby communities where homeowners need clear, reliable help without long delays.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Trained Technicians</h3>
                <p>Every service call is backed by experienced HVAC professionals focused on safe, dependable work and clear next steps.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>City-Specific Pages</h3>
                <p>Every community below links to its own local service page, so you can go from coverage confirmation to the right next step faster.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Easy Next Step</h3>
                <p>If your location is nearby and you need help now, you can request service or an estimate directly from this page.</p>
              </div>
            </article>
          </div>
        </section>

        <section class="service-panel-grid service-area-directory-panels">
          <article class="service-info-panel">
            <span class="section-pill">Where We Work</span>
            <h3>Serving major Austin-area communities</h3>
            <p>Browse the full service-area directory below to find every community we currently serve. If your community is listed, you are covered — and each one links to its own local page.</p>
            <a href="<?php echo esc_url( $contact_url ); ?>" class="btn service-cta-btn">Request Service</a>
          </article>
          <article class="service-info-panel service-info-panel-alt">
            <span class="section-pill">Need an Estimate?</span>
            <h3>Move from coverage to your next step</h3>
            <p>If your home needs AC repair, seasonal maintenance, a new installation, or full replacement planning, you can go straight from this page into an estimate request.</p>
            <a href="<?php echo esc_url( $estimate_url ); ?>" class="btn service-cta-btn">Request Estimate</a>
          </article>
        </section>

        <?php if ( ! empty( $service_areas ) ) : ?>
          <section class="service-area-directory-extended">
            <div class="service-area-directory-head">
              <h2 class="section-title">Communities we <span class="highlight">serve</span></h2>
              <p class="service-intro">Each community below has its own local service page with coverage details, common repair issues, and scheduling options.</p>
            </div>

            <div class="service-feature-grid mt-4">
              <?php foreach ( $service_areas as $slug => $area ) : ?>
                <article class="service-feature">
                  <span class="service-feature-icon">•</span>
                  <div>
                    <h3><a href="<?php echo esc_url( alpine_service_area_page_url( 'service-areas/' . $slug ) ); ?>"><?php echo esc_html( $area['city'] . ', ' . $area['state'] ); ?></a></h3>
                    <p><?php echo esc_html( wp_trim_words( $area['intro'], 24 ) ); ?></p>
                  </div>
                </article>
              <?php endforeach; ?>
            </div>
          </section>
        <?php endif; ?>

        <div class="service-testimonial service-area-directory-quote">
          <article class="service-photo-card">
            <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/hvac_commercial-scaled.jpg')); ?>" alt="Homeowner speaking with a local HVAC company">
          </article>
          <article class="service-testimonial-quote">
            <span>Service Coverage</span>
            <blockquote>Alpine Heating &amp; Air Conditioning serves homeowners across Austin-area communities with trained technicians ready to help with AC repair, heating service, maintenance, installation, and replacement.</blockquote>
          </article>
        </div>

      </div>
    </div>
  </section>

  <section class="service-strip">
    <div class="container">
      <strong>Quality heating &amp; air conditioning solutions</strong>
      <a href="<?php echo esc_url( $contact_url ); ?>" class="btn service-cta-btn">Schedule Appointment</a>
    </div>
  </section>
</main>

<?php get_footer(); ?>
