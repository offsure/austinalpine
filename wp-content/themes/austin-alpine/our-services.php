  <?php
/*
Template Name: Our Services
*/

get_header();
require_once get_stylesheet_directory() . '/inc/service-area-links-section.php';

$uploads_base = trailingslashit(home_url('/wp-content/uploads/2026'));

$service_sections = array(
    'Cooling Services' => array(
        array(
            'title' => 'AC Repair',
            'description' => 'When your system is blowing warm air, making unusual noises, leaking, or struggling to cool your home, repair service helps restore comfort quickly.',
            'url' => alpine_get_page_url('ac-repair', array(), '/ac-repair/'),
            'image' => $uploads_base . '03/repair-service.webp',
        ),
        array(
            'title' => 'AC Maintenance',
            'description' => 'Routine maintenance helps your system run more efficiently, supports better airflow, and reduces the chance of costly failures during Austin heat waves.',
            'url' => alpine_get_page_url('ac-maintenance', array(), '/ac-maintenance/'),
            'image' => $uploads_base . '03/ac-maintenance.jpg',
        ),
        array(
            'title' => 'AC Installation',
            'description' => 'We install cooling systems with attention to sizing, airflow, efficiency goals, and the real comfort needs of the home instead of a one-size-fits-all approach.',
            'url' => alpine_get_page_url('ac-installation', array(), '/ac-installation/'),
            'image' => $uploads_base . '03/installation-service.webp',
        ),
        array(
            'title' => 'AC Replacement',
            'description' => 'If your current equipment is aging, inefficient, or no longer reliable, replacement can improve comfort, lower stress, and make cooling costs easier to manage.',
            'url' => alpine_get_page_url('ac-replacement', array(), '/ac-replacement/'),
            'image' => $uploads_base . '04/replacement-service.jpg',
        ),
    ),
    'Heating Services' => array(
        array(
            'title' => 'Heating Repair',
            'description' => 'Heating repair helps restore warmth when your system stops keeping up, leaves cold spots, or starts short cycling during colder weather.',
            'url' => alpine_get_page_url('heating-repair', array(), '/heating-repair/'),
            'image' => $uploads_base . '03/heating-repair.jpg',
        ),
        array(
            'title' => 'Heating Maintenance',
            'description' => 'Seasonal tune-ups help improve reliability, protect efficiency, and reduce the risk of a no-heat call when temperatures drop.',
            'url' => alpine_get_page_url('heating-maintenance', array(), '/heating-maintenance/'),
            'image' => $uploads_base . '04/maintenance_img.jpg',
        ),
        array(
            'title' => 'Heating Installation',
            'description' => 'A properly planned heating installation gives your home dependable comfort, stronger performance, and cleaner startup when winter arrives.',
            'url' => alpine_get_page_url('heating-installation', array(), '/heating-installation/'),
            'image' => $uploads_base . '03/heating-installation.jpg',
        ),
        array(
            'title' => 'Heating Replacement',
            'description' => 'When repair bills keep adding up, replacement gives homeowners a clearer path to dependable heat and long-term performance.',
            'url' => alpine_get_page_url('heating-replacement', array(), '/heating-replacement/'),
            'image' => $uploads_base . '04/replacement-service.jpg',
        ),
        array(
            'title' => 'Furnace Repair',
            'description' => 'Furnace repair focuses on no-heat calls, ignition issues, weak airflow, and the warning signs that often show up before full failure.',
            'url' => alpine_get_page_url('furnace-repair', array('furnace-repair-service', 'heating-repair'), '/furnace-repair/'),
            'image' => $uploads_base . '03/heating-repair.jpg',
        ),
        array(
            'title' => 'Heater Repair',
            'description' => 'If the heater is running without warming the home, making noise, or struggling to maintain temperature, a repair visit gets to the cause and restores steady warmth.',
            'url' => alpine_get_page_url('heater-repair', array('heating-repair'), '/heater-repair/'),
            'image' => $uploads_base . '03/heating-repair.jpg',
        ),
        array(
            'title' => 'Heater Replacement',
            'description' => 'Heater replacement is often the smarter long-term move when the current unit is worn out, unreliable, or too expensive to keep repairing.',
            'url' => alpine_get_page_url('heater-replacement', array('heating-replacement'), '/heater-replacement/'),
            'image' => $uploads_base . '04/replacement-service.jpg',
        ),
    ),
    'Additional Services' => array(
        array(
            'title' => 'Indoor Air Quality',
            'description' => 'Cleaner indoor air starts with better filtration, air treatment, and airflow strategies that support healthier everyday comfort.',
            'url' => alpine_get_site_page_url('indoor_air_quality'),
            'image' => $uploads_base . '04/indoor-air-quality-service.webp',
        ),
        array(
            'title' => 'Ductless Mini-Splits',
            'description' => 'Ductless systems provide efficient zoned heating and cooling for additions, converted spaces, and rooms with ongoing comfort problems.',
            'url' => alpine_get_site_page_url('ductless'),
            'image' => $uploads_base . '03/installation-service.webp',
        ),
        array(
            'title' => 'Emergency HVAC Repair',
            'description' => 'When heating or cooling equipment fails unexpectedly, emergency repair puts a technician on the problem fast.',
            'url' => alpine_get_page_url('emergency-hvac-repair', array(), '/emergency-hvac-repair/'),
            'image' => $uploads_base . '03/repair-service.webp',
        ),
        array(
            'title' => 'Thermostat Services',
            'description' => 'Thermostat service helps improve temperature control, scheduling, and day-to-day system performance.',
            'url' => alpine_get_page_url('thermostat-services', array(), '/thermostat-services/'),
            'image' => $uploads_base . '03/installation-service.webp',
        ),
        array(
            'title' => 'Programmable Thermostats',
            'description' => 'Programmable thermostat installation improves scheduling, comfort consistency, and energy efficiency.',
            'url' => alpine_get_page_url('programmable-thermostats-installation', array('thermostat-services'), '/programmable-thermostats-installation/'),
            'image' => $uploads_base . '03/installation-service.webp',
        ),
    ),
);
?>
<div class="service-page installation-page services-hub-page">
	
    <section class="page-hero">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Our Service</span>
          <h1>Our Services</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Our Services'),
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
              <h2 class="section-title">HVAC contractor <span class="highlight">services</span> in Austin, TX</h2>
              <p class="service-intro">Alpine Heating &amp; Air Conditioning provides a full range of residential HVAC services in Austin, TX, including cooling, heating, indoor air quality, ductless systems, and the supporting repairs and upgrades that keep equipment working efficiently.</p>
              <p class="service-intro">This services hub brings all of those options together in one place so homeowners can move directly to the page that matches their need, whether that means AC repair, furnace repair, heater replacement, thermostat service, ductwork help, or preventive maintenance.</p>
            </div>

            <div class="service-visual-grid">
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/heating-repair.jpg')); ?>" alt="HVAC contractor servicing outdoor equipment">
              </article>
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/replacement-service.jpg')); ?>" alt="HVAC services inspection and planning">
              </article>
            </div>
          </div>

          <div class="service-feature-grid">
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Cooling Services</h3>
                <p>Air conditioning support includes installation, repair, maintenance, and full replacement guidance for aging systems.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Heating Services</h3>
                <p>Heating support includes heating installation, heating repair, heating maintenance, heating replacement, furnace repair, heater repair, and heater replacement.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Indoor Air Quality</h3>
                <p>Indoor air quality is positioned as a major service area for healthier indoor environments and better HVAC system performance.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Ductless Systems</h3>
                <p>Ductless mini-split service is included as a dedicated comfort solution for customers who need efficient heating and cooling without major ductwork.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Airflow &amp; Controls</h3>
                <p>Supporting services include thermostat service, ductwork improvements, and humidity control for better comfort and efficiency.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Emergency &amp; Ongoing Care</h3>
                <p>Emergency repair, maintenance plans, and service for all makes and models help support year-round performance.</p>
              </div>
            </article>
          </div>

          <?php foreach ($service_sections as $section_title => $services) : ?>
            <div class="mt-5">
              <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
              <div class="service-overview-grid">
                <?php foreach ($services as $service) : ?>
                  <article class="service-overview-card">
                    <img loading="lazy" decoding="async" src="<?php echo esc_url($service['image']); ?>" alt="<?php echo esc_attr($service['title']); ?>">
                    <div>
                      <h3><?php echo esc_html($service['title']); ?></h3>
                      <p><?php echo esc_html($service['description']); ?></p>
                      <a href="<?php echo esc_url($service['url']); ?>">Read More<span class="visually-hidden"> about <?php echo esc_html($service['title']); ?></span></a>
                    </div>
                  </article>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>

          <div class="service-panel-grid">
            <article class="service-info-panel">
              <span class="section-pill">Get Started</span>
              <h3>Start your air conditioner or heater project</h3>
              <p>Getting started is simple: call the team or fill out the online form to discuss an air conditioner or heater project with a specialist.</p>
              <a href="<?php echo esc_url(alpine_get_site_page_url('estimate')); ?>" class="btn service-cta-btn">Read More<span class="visually-hidden"> about requesting an estimate</span></a>
            </article>
            <article class="service-info-panel service-info-panel-alt">
              <span class="section-pill">Additional Support</span>
              <h3>Financing and maintenance plan options</h3>
              <p>The services page also highlights financing and maintenance plans, giving homeowners long-term support beyond one-time repairs or installations.</p>
              <a href="<?php echo esc_url(alpine_get_site_page_url('financing')); ?>" class="btn service-cta-btn">Read More<span class="visually-hidden"> about HVAC financing</span></a>
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
