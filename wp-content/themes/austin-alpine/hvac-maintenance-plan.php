  <?php
/*
Template Name: Maintenance Plan
*/

get_header();
require_once get_stylesheet_directory() . '/inc/service-area-links-section.php';
?>
<div class="service-page installation-page maintenance-plan-page">
	
    <section class="page-hero">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Ongoing Care</span>
          <h1>Maintenance Plan</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Maintenance Plan'),
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
          <div class="service-split">
            <div>
              <h2 class="section-title">HVAC <span class="highlight">maintenance plan</span> in Austin, Cedar Park, Pflugerville, TX and surrounding areas</h2>
              <p class="service-intro">Alpine Heating & Air Conditioning offers HVAC maintenance plans for homeowners in Austin, Cedar Park, Pflugerville, and nearby communities who want dependable seasonal service and fewer surprise breakdowns.</p>
              <p class="service-intro">Every visit is handled by a trained, certified technician, so you know the person checking your air conditioner or heater actually knows the equipment. Twice-a-year service catches small problems while they're still cheap to fix, and plan members get priority scheduling when the busy season hits.</p>
            </div>

            <div class="service-visual-grid">
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/maintenance_img.jpg')); ?>" alt="HVAC maintenance plan service">
              </article>
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/maintenance-srvc.webp')); ?>" alt="Technician performing HVAC maintenance">
              </article>
            </div>
          </div>

          <div class="service-feature-grid">
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Simple Enrollment</h3>
                <p>Signing up takes a few minutes. Tell us about your equipment and we'll schedule your first visit.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Air Conditioning Care</h3>
                <p>A spring tune-up gets your cooling system cleaned, tested, and ready before the first 100-degree week.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Heater Maintenance</h3>
                <p>Heater maintenance is called out alongside air conditioning support, making the plan relevant across the full HVAC system.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Certified Technicians</h3>
                <p>Trained, certified technicians handle every visit — the same crew that does our repairs and installations.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Multi-System Homes</h3>
                <p>Two units upstairs and down? The plan covers every system in the house, priced by how many you have.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Direct Follow-Up</h3>
                <p>Tell us how you prefer to be reached and we'll handle scheduling reminders, so tune-ups happen on time without you tracking them.</p>
              </div>
            </article>
          </div>

          <div class="service-panel-grid">
            <article class="service-info-panel">
              <span class="section-pill">Sign Up</span>
              <h3>Enroll in premium maintenance services</h3>
              <p>Customers who want long-term system care can contact the team to get started with a maintenance plan that fits their equipment and service needs.</p>
              <a href="#contact" class="btn service-cta-btn">Request Service</a>
            </article>
            <article class="service-info-panel service-info-panel-alt">
              <span class="section-pill">Service Coverage</span>
              <h3>Available across the Austin-area service region</h3>
              <p>Maintenance plans are available in Austin, Cedar Park, Pflugerville, and the surrounding Central Texas communities we serve every day.</p>
              <a href="<?php echo esc_url(alpine_get_site_page_url('service_areas')); ?>" class="btn service-cta-btn">View Service Areas</a>
            </article>
          </div>

          <div class="service-testimonial">
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/alpine-team.webp')); ?>" alt="Customer discussing HVAC maintenance plan">
            </article>
            <article class="service-testimonial-quote">
              <span>Maintenance Plan</span>
              <blockquote>Maintenance plans give homeowners a reliable way to stay ahead of wear, improve efficiency, and keep both air conditioners and heaters in better working shape over time.</blockquote>
            </article>
          </div>

        </div>
      </div>
    </section>

    <section class="section-space pt-0">
      <div class="container">
        <?php alpine_render_service_area_links_section(); ?>
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
