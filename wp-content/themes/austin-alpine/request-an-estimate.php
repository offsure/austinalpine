  <?php
/*
Template Name: Request Estimate
*/

get_header();

$estimate_form_shortcode = '[contact-form-7 id="bf38474" title="Contact form 1"]';
?>
  <main class="service-page installation-page estimate-page"> 
    <section class="page-hero">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Project Planning</span>
          <h1>Request an Estimate</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Request an Estimate'),
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
              <h2 class="section-title">Request an <span class="highlight">estimate</span> in Austin, TX</h2>
              <p class="service-intro">Alpine Heating & Air Conditioning makes it easy to request pricing and project guidance for heating, cooling, and indoor air quality work. Whether you are planning a new system, dealing with a repair, or comparing maintenance options, this page is designed to help you take the next step with clear expectations.</p>
              <p class="service-intro">A good estimate starts with the right information. By sharing basic contact details and the kind of service you need, homeowners can get more accurate follow-up, better scheduling support, and a faster path to the right solution for the home.</p>
            </div>

            <div class="service-visual-grid">
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/hvac_commercial-scaled.jpg')); ?>" alt="Homeowner requesting an HVAC estimate">
              </article>
              
            </div>
          </div>

          <div class="service-feature-grid">
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>New System Quotes</h3>
                <p>Estimate requests help homeowners compare installation and replacement options before moving forward with a larger HVAC investment.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Repair Requests</h3>
                <p>When equipment problems show up unexpectedly, an estimate request can be the first step toward fast diagnostics and repair planning.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Maintenance Scheduling</h3>
                <p>Routine service requests are just as important as major jobs, especially for homeowners trying to prevent future breakdowns.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Indoor Air Quality</h3>
                <p>Estimate requests can also cover air quality improvements such as filtration, purification, and other comfort-focused upgrades.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Project Notes</h3>
                <p>Sharing a few extra details helps the team understand the job more quickly and respond with better direction.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Local Contact Info</h3>
                <p>Clear office information and direct phone access make it simple to move from online research to real scheduling support.</p>
              </div>
            </article>
          </div>

          <div class="service-panel-grid">
            <article class="service-info-panel">
              <span class="section-pill">Get Started</span>
              <h3>Start your estimate request today</h3>
              <p>Use the estimate request page to begin a conversation about installation, repair, maintenance, or indoor air quality work. It is a straightforward way to move from interest to action.</p>
              <a href="#estimateForm" class="btn service-cta-btn">Open Estimate Form</a>
            </article>
            <article class="service-info-panel service-info-panel-alt">
              <span class="section-pill">Contact</span>
              <h3>Talk with the Alpine Heating & Air Conditioning team</h3>
              <p>If you would rather speak with someone before filling out a form, call the team directly for help with scheduling, pricing questions, and next steps.</p>
              <a href="tel:+15127594247" class="btn service-cta-btn">Call (512) 759-4247</a>
            </article>
          </div>

          <div class="service-testimonial">
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/replacement-service.jpg')); ?>" alt="Customer discussing an HVAC estimate">
            </article>
            <article class="service-testimonial-quote">
              <span>Estimate Overview</span>
              <blockquote>Alpine Heating & Air Conditioning estimate requests are built around real homeowner needs: new system planning, fast repair follow-up, routine maintenance, and indoor air quality improvements.</blockquote>
              <p>Simple next steps for Austin-area heating and cooling projects</p>
            </article>
          </div>

          <section class="contact-page-grid mt-5" id="estimateForm">
            <article class="contact-map-card">
              <span class="section-pill">Estimate Form</span>
              <h2>Request an HVAC Estimate</h2>
              <p>Use the form below to request an estimate for installation, repair, maintenance, replacement, or indoor air quality work in Austin and nearby service areas.</p>
              <p>If you would rather talk with the team first, call Alpine Heating & Air Conditioning and we can help you choose the right next step.</p>
              <a href="tel:+15127594247" class="btn service-cta-btn">Call (512) 759-4247</a>
            </article>
            <?php echo do_shortcode($estimate_form_shortcode); ?>
          </section>

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
