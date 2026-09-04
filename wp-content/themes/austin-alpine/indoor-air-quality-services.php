  <?php
/*
Template Name: Indoor air quality
*/

get_header();
require_once get_stylesheet_directory() . '/inc/service-area-links-section.php';
?>
	<div class="service-page installation-page iaq-page">
		
    <section class="page-hero">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Our Service</span>
          <h1>Indoor Air Quality Service</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Indoor Air Quality Service'),
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
              <h2 class="section-title">Indoor air <span class="highlight">quality</span> services in Austin, TX and surrounding areas</h2>
              <p class="service-intro">Alpine Heating & Air Conditioning builds cleaner, healthier indoor environments for Austin homes and businesses with indoor air quality services designed around real comfort and wellness concerns. Good HVAC performance is not only about temperature. It is also about the air people breathe every day inside the home.</p>
              <p class="service-intro">Indoor air quality problems can come from dust, mold, odors, pet dander, bacteria, and other pollutants that collect inside tightly sealed spaces. With the right mix of filtration, purification, and maintenance, it becomes easier to improve comfort while supporting healthier air throughout the property.</p>
            </div>

            <div class="service-visual-grid">
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/indoor-air.jpg')); ?>" alt="Technician improving indoor air quality equipment">
              </article>
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/indoor-air-quality-service-scaled.webp')); ?>" alt="Indoor air quality service inspection">
              </article>
            </div>
          </div>

          <div class="service-feature-grid">
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Air Filters</h3>
                <p>High-quality filtration helps capture dust, debris, and airborne particles before they continue circulating through the home.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Air Purification</h3>
                <p>Air purification systems can add another layer of protection by helping reduce contaminants that standard filters may not fully address.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Indoor Pollution Review</h3>
                <p>Identifying the sources of indoor pollution is the first step toward choosing the right air quality improvements for the space.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Financing Available</h3>
                <p>Financing options can make it easier to move forward with air quality upgrades when healthier indoor air cannot wait.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Certified Technicians</h3>
                <p>Experienced technicians can evaluate indoor conditions and recommend the combination of solutions that best fits the home.</p>
              </div>
            </article>
          </div>

          <div class="service-panel-grid">
            <article class="service-info-panel">
              <span class="section-pill">Healthy Air</span>
              <h3>Cleaner air starts with the right plan</h3>
              <p>Indoor air quality improvements are most effective when the problem is identified clearly and the equipment is matched to the space, the symptoms, and the system design.</p>
              <a href="<?php echo esc_url(alpine_get_site_page_url('estimate')); ?>" class="btn service-cta-btn">Request Estimate</a>
            </article>
            <article class="service-info-panel service-info-panel-alt">
              <span class="section-pill">Financing</span>
              <h3>Flexible support for IAQ upgrades</h3>
              <p>Financing lets you move ahead with filtration, purification, and related comfort upgrades without waiting on the budget.</p>
              <a href="<?php echo esc_url(alpine_get_site_page_url('financing')); ?>" class="btn service-cta-btn">Learn More<span class="visually-hidden"> about HVAC financing</span></a>
            </article>
          </div>

          <h2 class="section-title mt-5">Indoor air quality <span class="highlight">improvement</span> services</h2>
          <p class="service-intro">Improving indoor air quality usually takes more than one change. In many homes, the best results come from combining better filtration, purification, and regular HVAC maintenance to reduce pollutants and improve overall system cleanliness.</p>
          <p class="service-intro">For families dealing with allergies, odors, dust buildup, or recurring comfort concerns, a professional indoor air quality review can help clarify what is happening and what steps will make the biggest difference.</p>

          <div class="service-overview-grid mt-4">
            <article class="service-overview-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/repair-service.webp')); ?>" alt="Air filtration service">
              <div>
                <h3>Air Filtration</h3>
                <p>Filtration upgrades are one of the most direct ways to improve the quality of the air moving through the HVAC system.</p>
              </div>
            </article>
            <article class="service-overview-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/indoor-air-quality.jpg')); ?>" alt="Air purification service">
              <div>
                <h3>Air Purification</h3>
                <p>Purification systems trap or neutralize the contaminants that slip past standard filters.</p>
              </div>
            </article>
            <article class="service-overview-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/maintenance-srvc.webp')); ?>" alt="HVAC maintenance for indoor air quality">
              <div>
                <h3>System Maintenance</h3>
                <p>System maintenance supports better air quality by helping heating and cooling equipment stay cleaner and perform more effectively.</p>
                <a href="<?php echo esc_url(alpine_get_site_page_url('maintenance')); ?>">Read More<span class="visually-hidden"> about HVAC system maintenance</span></a>
              </div>
            </article>
          </div>

          <div class="service-testimonial">
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/alpine-team.webp')); ?>" alt="Customer talking with indoor air quality specialist">
            </article>
            <article class="service-testimonial-quote">
              <span>Indoor Air Quality</span>
              <blockquote>Indoor air quality service is about more than comfort. It is about reducing contaminants, improving breathing air, and making the home feel cleaner, healthier, and easier to live in every day.</blockquote>
              <p>Air quality solutions for healthier indoor living in the Austin area</p>
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
