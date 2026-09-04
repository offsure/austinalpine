  <?php
/*
Template Name: HVAC Financing
*/

get_header();
?>
<div class="service-page installation-page financing-page">
	
    <section class="page-hero">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Payment Support</span>
          <h1>HVAC Financing</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'HVAC Financing'),
          )); ?>
        </div>
        <strong>Air Conditioning and Heating Specialists</strong>
      </div>
      <div class="hero-badge">
        <span>o</span>
      </div>
    </section>
  </header>

  <main>
    <section class="section-space">
      <div class="container">
        <div class="service-copy-wrap">
          <div class="service-split financing-intro-section">
            <div class="financing-intro-copy">
              <span class="section-pill">Flexible Payment Options</span>
              <h2 class="section-title">HVAC <span class="highlight">financing</span> in Austin, TX and surrounding areas</h2>
              <p class="service-intro">Alpine Heating & Air Conditioning offers HVAC financing for customers in Austin, Cedar Park, Pflugerville, and nearby communities who need a practical path forward on major comfort projects.</p>
              <p class="service-intro">Homeowners can move forward with more confidence knowing trained and certified technicians are available to handle the work while the team helps explain financing options for installations and related HVAC needs.</p>
              <div class="financing-intro-points">
                <span>New system quotes</span>
                <span>Repair support</span>
                <span>Maintenance and IAQ projects</span>
              </div>
            </div>

            <div class="service-visual-grid financing-intro-visuals">
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/04/finance_img.jpg' ); ?>" alt="HVAC financing support">
              </article>
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/04/alpine-finance.avif' ); ?>" alt="Homeowner reviewing HVAC payment options">
              </article>
            </div>
          </div>

          <div class="service-panel-grid">
            <article class="service-info-panel">
              <span class="section-pill">Start Here</span>
              <h3>Talk to the local experts about financing</h3>
              <p>Not sure what your project will cost or which financing option fits? Start with a conversation. We'll walk through the numbers with you before anything gets signed.</p>
              <a href="#financingForm" class="btn service-cta-btn">Request Estimate</a>
            </article>
            <article class="service-info-panel service-info-panel-alt">
              <span class="section-pill">What To Expect</span>
              <h3>Share the project details that matter</h3>
              <p>Tell us whether you need a quote, a repair, maintenance, or air quality help, plus a little about your home. The more detail you share, the more accurate our first answer can be.</p>
              <a href="#financingForm" class="btn service-cta-btn">Open Form</a>
            </article>
          </div>

          <div class="contact-page-grid mt-5" id="financingForm">
            <article class="contact-map-card">
              <span class="section-pill">Financing Form</span>
              <h3>Request financing information</h3>
              <p>Use the form below to ask about financing for a new system quote, repair, maintenance, indoor air quality upgrade, or another HVAC project.</p>
              <p>You can also call Alpine Heating & Air Conditioning directly if you want to discuss timing, service needs, or next steps before submitting the form.</p>
              <a href="tel:+15127594247" class="btn service-cta-btn">Call (512) 759-4247</a>
            </article>
            <?php echo do_shortcode('[contact-form-7 id="bf38474" title="Contact form 1"]'); ?>
          </div>

        </div>
      </div>
    </section>

    <section class="service-strip">
      <div class="container">
        <strong>Quality heating &amp; air conditioning solutions</strong>
        <a href="<?php echo esc_url(alpine_get_site_page_url('contact')); ?>" class="btn service-cta-btn">Schedule Appointment</a>
      </div>
    </section>
  </main>
</div>

  <?php get_footer(); ?>
