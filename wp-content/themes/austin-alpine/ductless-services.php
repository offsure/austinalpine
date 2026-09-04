  <?php
/*
Template Name: Ductless Services
*/

get_header();
require_once get_stylesheet_directory() . '/inc/service-area-links-section.php';
?>

	<div class="service-page installation-page commercial-page">


    <section class="page-hero">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Our Service</span>
          <h1>Ductless Service</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Ductless Service'),
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
                <h2 class="section-title">Ductless <span class="highlight">services</span> in Austin, Cedar Park, Pflugerville, TX and surrounding areas</h2>
                <p class="service-intro">Alpine Heating & Air Conditioning provides complete ductless mini-split service for homeowners and businesses who want flexible comfort without major ductwork. From new installations to repairs, tune-ups, maintenance, and replacements, ductless systems offer a practical option for targeted heating and cooling.</p>
                <p class="service-intro">Ductless equipment is a strong fit for room additions, hard-to-condition spaces, older homes, and anyone looking for efficient comfort control in specific areas of the property. The payoff is precise room-by-room temperature control without tearing into walls to add ductwork.</p>
              </div>

              <div class="service-visual-grid">
                <article class="service-photo-card">
                  <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/ductless-service.jpg')); ?>" alt="Ductless mini split indoor unit">
                </article>
                <article class="service-photo-card">
                  <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/duct-service.avif')); ?>" alt="Technician servicing ductless equipment">
                </article>
              </div>
            </div>

            <div class="service-feature-grid">
              <article class="service-feature">
                <span class="service-feature-icon">✓</span>
                <div>
                  <h3>Installations</h3>
                  <p>Professional ductless mini-split installations are highlighted for homes and businesses that want efficient comfort without major duct construction.</p>
                </div>
              </article>
              <article class="service-feature">
                <span class="service-feature-icon">✓</span>
                <div>
                  <h3>Repairs</h3>
                  <p>Ductless repair service helps restore comfort quickly when a mini-split stops cooling, heating, or responding the way it should.</p>
                </div>
              </article>
              <article class="service-feature">
                <span class="service-feature-icon">✓</span>
                <div>
                  <h3>Tune-Ups</h3>
                  <p>Tune-ups help keep mini-split systems efficient, responsive, and ready for high-demand cooling and heating seasons.</p>
                </div>
              </article>
              <article class="service-feature">
                <span class="service-feature-icon">✓</span>
                <div>
                  <h3>Maintenance</h3>
                  <p>Routine maintenance supports long-term reliability, cleaner operation, and better day-to-day performance from ductless equipment.</p>
                </div>
              </article>
              <article class="service-feature">
                <span class="service-feature-icon">✓</span>
                <div>
                  <h3>Replacements</h3>
                  <p>Replacement is the right next step when an older ductless unit can no longer deliver the efficiency or comfort the home needs.</p>
                </div>
              </article>
              <article class="service-feature">
                <span class="service-feature-icon">✓</span>
                <div>
                  <h3>Certified Service</h3>
                  <p>Trained technicians help ensure the system is installed, serviced, and maintained with the care ductless equipment requires.</p>
                </div>
              </article>
            </div>

            <div class="service-panel-grid">
              <article class="service-info-panel">
                <span class="section-pill">Financing Available</span>
                <h3>Flexible support for ductless projects</h3>
                <p>Financing options can make it easier to move forward with a new mini-split installation or replacement when better comfort cannot wait.</p>
                <a href="<?php echo esc_url(alpine_get_site_page_url('estimate')); ?>" class="btn service-cta-btn">Request Estimate</a>
              </article>
              <article class="service-info-panel service-info-panel-alt">
                <span class="section-pill">The Ductless Advantage</span>
                <h3>Efficiency without major renovation</h3>
                <p>Mini-splits offer an efficient way to improve comfort without the major expense and disruption that often comes with adding or reworking duct systems.</p>
                <a href="<?php echo esc_url(alpine_get_site_page_url('installation')); ?>" class="btn service-cta-btn">Explore Installation</a>
              </article>
            </div>

            <h2 class="section-title mt-5">Why homeowners choose <span class="highlight">ductless</span></h2>
            <p class="service-intro">Homeowners often choose ductless systems because they offer targeted comfort, strong efficiency, and a cleaner installation path than traditional ducted expansions. That makes them especially useful for additions, garages, offices, and rooms that struggle to stay comfortable.</p>
            <p class="service-intro">They are also a smart option for customers who want more control over individual zones without committing to major construction. With the right system design, mini-splits can improve comfort while helping manage operating costs over time.</p>

            <div class="service-overview-grid mt-4">
              <article class="service-overview-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/installation-service.webp')); ?>" alt="Ductless installation service">
                <div>
                  <h3>Ductless Installation</h3>
                  <p>Installation support is ideal for customers who want efficient, room-by-room comfort without opening up walls for traditional ductwork.</p>
                  <a href="<?php echo esc_url(alpine_get_page_url('ac-installation', array('ductless-services'), '/ac-installation/')); ?>">Read More<span class="visually-hidden"> about installation services</span></a>
                </div>
              </article>
              <article class="service-overview-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/repair-service.webp')); ?>" alt="Ductless repair service">
                <div>
                  <h3>Ductless Repair</h3>
                  <p>Repair service helps restore dependable performance when a mini-split stops cooling, heating, or operating consistently.</p>
                  <a href="<?php echo esc_url(alpine_get_page_url('ac-repair', array('ductless-services'), '/ac-repair/')); ?>">Read More<span class="visually-hidden"> about repair services</span></a>
                </div>
              </article>
              <article class="service-overview-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/maintenance-srvc.webp')); ?>" alt="Ductless maintenance service">
                <div>
                  <h3>Ductless Maintenance</h3>
                  <p>Regular maintenance and tune-ups help keep mini-split performance consistent and reduce unexpected service calls.</p>
                  <a href="<?php echo esc_url(alpine_get_page_url('ac-maintenance', array('ductless-services'), '/ac-maintenance/')); ?>">Read More<span class="visually-hidden"> about maintenance services</span></a>
                </div>
              </article>
              <article class="service-overview-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/replacement-service.jpg')); ?>" alt="Ductless replacement service">
                <div>
                  <h3>Ductless Replacement</h3>
                  <p>Replacement becomes the better path when an aging mini-split no longer makes sense from an efficiency, reliability, or repair standpoint.</p>
                  <a href="<?php echo esc_url(alpine_get_page_url('ac-replacement', array('ductless-services'), '/ac-replacement/')); ?>">Read More<span class="visually-hidden"> about replacement services</span></a>
                </div>
              </article>
            </div>

            <div class="service-testimonial">
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/alpine-team.webp')); ?>" alt="Customer discussing ductless system options">
              </article>
              <article class="service-testimonial-quote">
                <span>Ductless Service</span>
                <blockquote>Ductless mini-splits give Austin-area homeowners a flexible way to heat and cool specific spaces with efficient performance, focused comfort, and less installation disruption.</blockquote>
                <p>Complete mini-split support for installations, repairs, tune-ups, and replacements</p>
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
