  <?php
/*
Template Name: Contact Us Page
*/

get_header();

$service_area_locations = array(
    'Austin',
    'Bee Cave',
    'Cedar Park',
    'Cedar Valley',
    'Hutto',
    'Lakeway',
    'Leander',
    'Lost Creek',
    'Manor',
    'Pflugerville',
    'Rollingwood',
    'Round Rock',
    'Sunset Valley',
    'The Hills',
    'Volente',
    'West Lake Hills',
);
?>

<div class="service-page installation-page contact-page">
	
    <section class="page-hero">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Get In Touch</span>
          <h1>Contact Us</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Contact Us'),
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
          <div>
            <h2 class="section-title">Contact Alpine Heating & Air Conditioning <span class="highlight">today</span></h2>
            <p class="service-intro">Use the form below to request service, ask a question, or tell us what you need. If you want immediate help, call <a href="tel:+15127594247">(512) 759-4247</a>.</p>
          </div>

          <div class="contact-page-grid" id="contactForm">
            <article class="contact-form-card">
              <span class="section-pill">Send a Message</span>
              <h3>Tell us how we can help</h3>
              <p>Fill out the form and our team will follow up as soon as possible.</p>
              <?php echo do_shortcode('[contact-form-7 id="bf38474" title="Contact form 1"]'); ?>
            </article>

            <article class="contact-map-card">
              <span class="section-pill">Contact Details</span>
              <h3>Reach us directly</h3>
              <p><strong>Phone:</strong> <a href="tel:+15127594247">(512) 759-4247</a></p>
              <p><strong>Office:</strong> 1205 Sheldon Cove Bldg. 2, Ste. J.<br>Austin, TX 78753</p>
              <p><strong>Hours:</strong> Mon - Fri: 7:00 AM - 7:00 PM<br>Sat-Sun: Emergency services available</p>
              <iframe class="contact-map-embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=Alpine+Heating+%26+Air+Conditioning,+1205+Sheldon+Cove+Bldg.+2,+Ste.+J.,+Austin,+TX+78753&output=embed" title="Alpine Heating & Air Conditioning Google Business map"></iframe>
            </article>
          </div>

          <div class="contact-details-grid">
            <article class="contact-card">
              <h3>Call Now</h3>
              <p><a href="tel:+15127594247">(512) 759-4247</a></p>
            </article>
            <article class="contact-card">
              <h3>Office Hours</h3>
              <p>Mon - Fri: 7:00 AM - 7:00 PM<br>Sat-Sun: Emergency services available</p>
            </article>
            <article class="contact-card">
              <h3>Office Address</h3>
              <p>1205 Sheldon Cove Bldg. 2, Ste. J.<br>Austin, TX 78753</p>
            </article>
            <article class="contact-card">
              <h3>Services</h3>
              <p>Repair, maintenance, indoor air quality, financing questions, and new system estimates.</p>
            </article>
          </div>

          <section class="employment-service-areas contact-service-areas">
            <div class="employment-service-areas-media">
              <img loading="lazy" decoding="async" src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/service_areas_img.jpg' ); ?>" alt="Alpine Heating and Air Conditioning service area map">
            </div>
            <div class="employment-service-areas-card">
              <span class="section-pill">Coverage Map</span>
              <h2>Austin Service Areas</h2>
              <p class="contact-service-areas-intro">We serve homes and businesses throughout the Austin area.</p>
              <div class="employment-service-areas-list">
                <?php foreach ( $service_area_locations as $location ) : ?>
                  <span><?php echo esc_html( $location ); ?></span>
                <?php endforeach; ?>
              </div>
            </div>
          </section>

        </div>
      </div>
    </section>

    <section class="service-strip">
      <div class="container">
        <strong>Quality heating &amp; air conditioning solutions</strong>
        <a href="#contactForm" class="btn service-cta-btn">Send Message</a>
      </div>
    </section>
  </main>
</div>

 <?php get_footer(); ?>
