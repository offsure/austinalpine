  <?php
/*
Template Name: Resources
*/

get_header();

$seer_calculator_url = function_exists('alpine_get_page_url')
  ? alpine_get_page_url('seer-calculator', array('page-seer-calculator'), '/seer-calculator/')
  : home_url('/seer-calculator/');

$hvac_troubleshooter_url = function_exists('alpine_get_page_url')
  ? alpine_get_page_url('hvac-troubleshooter', array('page-hvac-troubleshooter'), '/hvac-troubleshooter/')
  : home_url('/hvac-troubleshooter/');
?>
<div class="service-page installation-page resources-page">
	
    <section class="page-hero">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Learning Center</span>
          <h1>HVAC Resources</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'HVAC Resources'),
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
          <div class="service-split resources-intro-section">
            <div class="resources-intro-copy">
              <span class="section-pill">Homeowner Resource Hub</span>
              <h2 class="section-title">HVAC <span class="highlight">resources</span> for Austin, TX homeowners</h2>
              <p class="service-intro">The Alpine Heating & Air Conditioning resource center is built for homeowners who want better information before making heating and cooling decisions. Whether you are trying to understand system terminology, compare efficiency options, or troubleshoot a problem before calling for service, this page brings the most useful starting points together in one place.</p>
              <div class="resources-intro-points">
                <span>Glossary and terminology help</span>
                <span>AC troubleshooting guidance</span>
                <span>Efficiency and SEER tools</span>
              </div>
            </div>

            <div class="service-visual-grid resources-intro-visuals">
              <article class="resources-intro-media-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/repair-service.webp')); ?>" alt="HVAC technician troubleshooting equipment for homeowner service guidance">
                <div class="resources-intro-media-copy">
                  <small>Inside The Resource Hub</small>
                  <div class="resources-intro-media-stats">
                    <span>Troubleshooting</span>
                    <span>Planning Tools</span>
                    <span>Offer Links</span>
                  </div>
                  <p>Designed to help homeowners research the issue first, then choose the right next step with less guesswork.</p>
                </div>
              </article>
            </div>
          </div>

          <div class="service-panel-grid">
            <article class="service-info-panel">
              <span class="section-pill">Learning Center</span>
              <h3>One place for common HVAC questions</h3>
              <p>Use the resource center to get familiar with system basics, common warning signs, efficiency language, and practical maintenance information before your next service call.</p>
              <a href="<?php echo esc_url(alpine_get_site_page_url('resources')); ?>" class="btn service-cta-btn">View Resources</a>
            </article>
            <article class="service-info-panel service-info-panel-alt">
              <span class="section-pill">Next Step</span>
              <h3>Learn first, then schedule with confidence</h3>
              <p>Once you understand the basics, it becomes easier to decide whether you need a repair, maintenance visit, equipment upgrade, or estimate for a larger project.</p>
              <a href="<?php echo esc_url(alpine_get_site_page_url('estimate')); ?>" class="btn service-cta-btn">Request Estimate</a>
            </article>
          </div>

          <h2 class="section-title mt-5">Featured HVAC <span class="highlight">resource links</span></h2>
          <p class="service-intro">These featured pages help homeowners move from research to action. Whether you are looking for current offers, payment flexibility, efficiency planning, or a starting point for troubleshooting, each link below takes you deeper into a useful next step.</p>
          <p class="service-intro">Everything is connected back to the main Alpine site structure, so visitors can explore current specials, financing options, efficiency tools, and diagnostic guidance without bouncing between unrelated resources.</p>

          <div class="service-overview-grid mt-4">
            <article class="service-overview-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/installation-service.webp')); ?>" alt="Special rebates for HVAC installation and replacement">
              <div>
                <h3>Special Rebates</h3>
                <p>Check current promotions, seasonal offers, and rebate opportunities that lower the cost of repairs, replacements, or new comfort upgrades.</p>
                <a href="<?php echo esc_url(alpine_get_site_page_url('specials')); ?>">Visit Resource</a>
              </div>
            </article>
            <article class="service-overview-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/finance_img.jpg')); ?>" alt="HVAC financing options for Austin homeowners">
              <div>
                <h3>Financing</h3>
                <p>Review financing options when a repair turns into a larger project or when a replacement needs to happen before the budget timing is ideal.</p>
                <a href="<?php echo esc_url(alpine_get_site_page_url('financing')); ?>">Visit Resource</a>
              </div>
            </article>
            <article class="service-overview-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/repair-service.webp')); ?>" alt="HVAC troubleshooter for common air conditioning issues">
              <div>
                <h3>HVAC Troubleshooter</h3>
                <p>Use the troubleshooter to review common system symptoms, narrow down likely causes, and decide when it is time to schedule professional service.</p>
                <a href="<?php echo esc_url($hvac_troubleshooter_url); ?>">Visit Resource</a>
              </div>
            </article>
            <article class="service-overview-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/ac-maintenance.jpg')); ?>" alt="SEER calculator for HVAC efficiency planning">
              <div>
                <h3>SEER Calculator</h3>
                <p>Compare efficiency levels and get a better feel for how higher-performance equipment can affect long-term cooling costs and planning decisions.</p>
                <a href="<?php echo esc_url($seer_calculator_url); ?>">Visit Resource</a>
              </div>
            </article>
          </div>

          <div class="service-testimonial">
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/ac-maintenance.jpg')); ?>" alt="Customer browsing HVAC information online">
            </article>
            <article class="service-testimonial-quote">
              <span>Resource Summary</span>
              <blockquote>Alpine Heating & Air Conditioning resources give homeowners a practical place to learn the basics, compare options, troubleshoot common issues, and get more prepared for maintenance, repairs, or replacement planning.</blockquote>
              <p>Helpful HVAC information for Austin-area homeowners</p>
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
</div>

  <?php get_footer(); ?>
