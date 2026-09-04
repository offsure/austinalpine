  <?php
/*
Template Name: Special Rebates
*/

get_header();
?>
  <main class="service-page installation-page specials-page">

    <section class="page-hero">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Savings Center</span>
          <h1>Special Rebates</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Special Rebates'),
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
        <div class="service-copy-wrap">
          <div class="service-split">
            <div>
              <h2 class="section-title">Special <span class="highlight">rebates</span> and seasonal savings</h2>
              <p class="service-intro">Alpine Heating & Air Conditioning makes it easier to move forward with heating and cooling upgrades by pairing quality service with limited-time specials. Whether you are planning a system replacement, looking into maintenance, or scheduling a repair, this page highlights savings opportunities that can help reduce upfront costs.</p>
              <p class="service-intro">These offers are designed to support practical comfort decisions for Austin-area homeowners. From equipment add-ons to service promotions, the goal is simple: better value on the HVAC services people need most, with clear next steps for getting details and scheduling work.</p>
            </div>

            <div class="service-visual-grid">
              
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/ac-maintenance.jpg' ); ?>" alt="HVAC maintenance and rebate savings">
              </article>
            </div>
          </div>

          <div class="service-feature-grid">
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Thermostat Savings</h3>
                <p>New system projects can include valuable add-ons that improve control, convenience, and everyday efficiency.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Maintenance Plan Offers</h3>
                <p>Special pricing tied to maintenance plans helps homeowners protect their equipment and avoid preventable breakdowns.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Repair Promotions</h3>
                <p>Repair-related specials can make urgent service calls easier to manage when system problems appear unexpectedly.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Free Estimates</h3>
                <p>Estimate offers give customers a simple starting point when comparing replacement options, upgrades, or larger HVAC projects.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Easy Next Steps</h3>
                <p>Each offer is meant to move customers quickly from browsing to booking, with a direct path to estimate requests and service support.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Offer Terms Apply</h3>
                <p>Promotions may have timing limits or qualification details, so customers should confirm current availability before scheduling.</p>
              </div>
            </article>
          </div>

          <div class="service-panel-grid">
            <article class="service-info-panel">
              <span class="section-pill">Current Offers</span>
              <h3>See what savings may be available</h3>
              <p>Specials can be a strong fit for new installations, maintenance enrollment, repair work, and estimate requests. Check the current offers page to review the latest details before booking.</p>
              <a href="<?php echo esc_url(alpine_get_site_page_url('contact')); ?>" class="btn service-cta-btn">Ask About Current Offers</a>
            </article>
            <article class="service-info-panel service-info-panel-alt">
              <span class="section-pill">Plan Ahead</span>
              <h3>Match savings with the right project</h3>
              <p>If you are comparing repair versus replacement, or deciding whether to start a maintenance plan, current promotions can tip the math in your favor and make the decision easier. Alpine Heating & Air Conditioning can walk you through the options.</p>
              <a href="<?php echo esc_url(alpine_get_site_page_url('estimate')); ?>" class="btn service-cta-btn">Request Estimate</a>
            </article>
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

  <?php get_footer(); ?>
