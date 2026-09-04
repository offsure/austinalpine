<?php
/*
Template Name: Heating Services Page
*/

get_header();
require_once get_stylesheet_directory() . '/inc/service-area-links-section.php';

$uploads_base = trailingslashit(home_url('/wp-content/uploads/2026'));

$heating_services = array(
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
        'image' => $uploads_base . '04/heating-maintenance-commons.jpg',
    ),
    array(
        'title' => 'Heating Installation',
        'description' => 'A properly planned heating installation means even heat, stronger performance, and a clean startup on the first cold morning you need it.',
        'url' => alpine_get_page_url('heating-installation', array(), '/heating-installation/'),
        'image' => $uploads_base . '03/heating-installation.jpg',
    ),
    array(
        'title' => 'Heating Replacement',
        'description' => 'When repair bills keep adding up, replacement ends the patch-and-pray cycle and gives you heat you can stop thinking about.',
        'url' => alpine_get_page_url('heating-replacement', array(), '/heating-replacement/'),
        'image' => $uploads_base . '04/replacement-service.jpg',
    ),
    array(
        'title' => 'Furnace Repair',
        'description' => 'Furnace repair focuses on no-heat calls, ignition issues, weak airflow, and the warning signs that often show up before full failure.',
        'url' => alpine_get_page_url('furnace-repair', array('furnace-repair-service', 'heating-repair'), '/furnace-repair/'),
        'image' => $uploads_base . '04/furnace-repair-commons.jpg',
    ),
    array(
        'title' => 'Heater Repair',
        'description' => 'If the heater is running without warming the home, making noise, or struggling to maintain temperature, a repair visit gets to the cause and restores steady warmth.',
        'url' => alpine_get_page_url('heater-repair', array('heating-repair'), '/heater-repair/'),
        'image' => $uploads_base . '04/heater-repair-commons.jpg',
    ),
    array(
        'title' => 'Heater Replacement',
        'description' => 'Heater replacement is often the smarter long-term move when the current unit is worn out, unreliable, or too expensive to keep repairing.',
        'url' => alpine_get_page_url('heater-replacement', array('heating-replacement'), '/heater-replacement/'),
        'image' => $uploads_base . '04/heating-installation-commons.jpg',
    ),
);
?>
<div class="service-page installation-page ac-services-page">
  <section class="page-hero">
    <div class="container hero-content">
      <div class="hero-copy">
        <span class="hero-chip">Our Service</span>
        <h1>Heating Services in Austin, TX</h1>
        <p class="hero-subtext">From preseason tune-ups to fast heating repair and full system replacement, Alpine Heating &amp; Air Conditioning keeps Austin-area homes comfortable through winter cold snaps with practical recommendations and dependable workmanship.</p>
        <div class="hero-cta-group">
          <a href="<?php echo esc_url(alpine_get_site_page_url('estimate')); ?>" class="btn service-cta-btn">Request Estimate</a>
          <a href="<?php echo esc_url(alpine_get_page_url('heating-repair', array(), '/heating-repair/')); ?>" class="btn btn-outline-light">Explore Heating Repair</a>
        </div>
      </div>
      <aside class="hero-sidecard">
        <strong>Heating help for repairs, maintenance, installation, and replacement.</strong>
        <p class="hero-sidecard-copy">Serving Austin and nearby communities with heating service built around reliability, efficiency, and honest guidance.</p>
        <div class="ac-hero-points">
          <span>Since 2006</span>
          <span>All makes and models</span>
          <span>Local Austin team</span>
        </div>
      </aside>
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
        <div class="service-split ac-intro-section">
          <div class="ac-intro-copy">
            <span class="section-pill">Local Heating Specialists</span>
            <h2 class="section-title">Reliable <span class="highlight">heating</span> service for Austin homes</h2>
            <p class="service-intro">Austin may be known for long summers, but homeowners still need heating systems they can trust when temperatures drop. A furnace or heater that struggles to start, runs without warming the home, or breaks down during a cold snap creates immediate comfort and safety concerns.</p>
            <p class="service-intro">That is why our heating service page brings the full heating lifecycle into one place. Whether you need <a href="<?php echo esc_url(alpine_get_page_url('heating-repair', array(), '/heating-repair/')); ?>">heating repair in Austin</a>, <a href="<?php echo esc_url(alpine_get_page_url('heating-maintenance', array(), '/heating-maintenance/')); ?>">routine maintenance before winter</a>, a <a href="<?php echo esc_url(alpine_get_page_url('heating-replacement', array(), '/heating-replacement/')); ?>">replacement quote for an aging system</a>, or guidance on a brand-new installation, Alpine Heating &amp; Air Conditioning is here to help you make the right next move.</p>
            <div class="ac-intro-tags">
              <span>Heating repair</span>
              <span>Seasonal maintenance</span>
              <span>New system installation</span>
              <span>Full replacement</span>
              <span>Furnace repair</span>
              <span>Heater troubleshooting</span>
            </div>
          </div>

          <div class="service-visual-grid ac-intro-visuals">
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url($uploads_base . '03/heating-repair.jpg'); ?>" alt="Heating technician inspecting a furnace in Austin">
            </article>
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url($uploads_base . '04/maintenance_img.jpg'); ?>" alt="Heating system maintenance and seasonal inspection">
            </article>
          </div>
        </div>

        <div class="ac-service-highlight-grid">
          <article class="ac-service-highlight-card ac-service-highlight-card-accent">
            <small>What We Handle</small>
            <h3>Heating service that holds up in a Texas cold snap</h3>
            <p>We help with no-heat calls, uneven warmth, aging equipment, strange odors, noisy startup, thermostat concerns, and systems that simply cannot keep the home comfortable anymore.</p>
          </article>
          <article class="ac-service-highlight-card">
            <small>Maintenance</small>
            <strong>Prepare your heater before winter demand puts extra strain on the system.</strong>
          </article>
          <article class="ac-service-highlight-card">
            <small>Repair</small>
            <strong>Get answers when your heating system stops keeping up or fails to start.</strong>
          </article>
          <article class="ac-service-highlight-card">
            <small>Replacement</small>
            <strong>Compare one more repair bill against what a new system actually costs to own.</strong>
          </article>
        </div>

        <div class="service-feature-grid">
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Heating Repair</h3>
              <p>Fast diagnostics for no-heat calls, weak airflow, thermostat issues, strange noises, and systems that are not warming your home evenly.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Heating Installation</h3>
              <p>Thoughtful installation planning for system upgrades, older homes, and homeowners replacing outdated equipment with something that will not quit mid-January.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Heating Replacement</h3>
              <p>Clear replacement guidance when frequent repairs, equipment age, or poor performance make it harder for your current system to justify keeping it.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Preventive Maintenance</h3>
              <p>Seasonal tune-ups and routine service designed to improve reliability, reduce wear, and give your heating equipment a better chance of handling colder weather.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Furnace and Heater Support</h3>
              <p>We help homeowners who search specifically for furnace repair, heater repair, and heater replacement without forcing them into a generic HVAC page.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Maintenance Plans &amp; Financing</h3>
              <p>Long-term service support and financing options make it easier to stay ahead of surprise winter breakdowns or move forward with larger projects.</p>
            </div>
          </article>
        </div>

        <section class="ac-symptoms-section mt-5">
          <div class="ac-section-heading">
            <span class="section-pill">Common Problems</span>
            <h2 class="section-title">Signs your <span class="highlight">heating system</span> may need service</h2>
            <p class="service-intro">A cold house does not care what the technical cause is — you just want to know whether this is a quick fix, a tune-up, or the beginning of a replacement conversation. Here are the heating problems that most often prompt Austin homeowners to call.</p>
          </div>
          <div class="ac-symptom-grid">
            <article class="ac-symptom-card">
              <h3>No heat or weak airflow</h3>
              <p>If rooms are not warming evenly, airflow is weak, or the system never seems to catch up, there may be an ignition, blower, thermostat, or airflow issue.</p>
            </article>
            <article class="ac-symptom-card">
              <h3>Short cycling or constant runtime</h3>
              <p>A heating system that starts and stops too often or runs constantly can point to sizing problems, restricted airflow, dirty components, or a deeper performance issue.</p>
            </article>
            <article class="ac-symptom-card">
              <h3>Strange odors or noises</h3>
              <p>Burning smells, banging, rattling, or unusual startup sounds are often signs the system needs service before the problem grows.</p>
            </article>
            <article class="ac-symptom-card">
              <h3>Frequent repairs on an older unit</h3>
              <p>If repair calls are becoming routine and the system is already older, replacement usually wins on both cost and comfort.</p>
            </article>
          </div>
        </section>

        <section class="mt-5">
          <div class="ac-section-heading">
            <span class="section-pill">Heating Services</span>
            <h2 class="section-title">Heating Services</h2>
          </div>
          <div class="service-overview-grid">
            <?php foreach ($heating_services as $service) : ?>
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
        </section>

        <section class="ac-process-panel mt-5">
          <div class="ac-process-copy">
            <span class="section-pill">Why Homeowners Call Us</span>
            <h2 class="section-title">Straightforward heating service with <span class="highlight">real guidance</span></h2>
            <p class="service-intro">Nobody should feel upsold while their house is cold. We diagnose the actual heating fault, explain it in plain language, and lay out your options — repair, tune-up, or upgrade — so the decision stays yours.</p>
            <p class="service-intro">That matters during Austin cold snaps, when the heat has to come on the first time you ask. Better sizing, better airflow, and better maintenance habits often make as much difference as the equipment itself.</p>
          </div>
          <div class="ac-process-steps">
            <article class="ac-process-step">
              <span>01</span>
              <h3>Inspect the system</h3>
              <p>Ignition, heat exchanger, airflow, controls — we test how the system actually behaves before recommending anything.</p>
            </article>
            <article class="ac-process-step">
              <span>02</span>
              <h3>Explain the options</h3>
              <p>You leave the visit knowing exactly where your heating system stands and what it will take to fix it.</p>
            </article>
            <article class="ac-process-step">
              <span>03</span>
              <h3>Complete the work</h3>
              <p>From tune-ups to larger heating projects, the aim is steady performance now and fewer surprises later.</p>
            </article>
          </div>
        </section>

        <div class="service-panel-grid">
          <article class="service-info-panel">
            <span class="section-pill">Maintenance Plans</span>
            <h3>Stay ahead of winter demand</h3>
            <p>A furnace that sat idle all summer deserves a checkup before the first freeze asks it to run all night. Preseason service catches ignition and airflow problems while the weather is still mild.</p>
            <a href="<?php echo esc_url(alpine_get_page_url('heating-maintenance', array(), '/heating-maintenance/')); ?>" class="btn service-cta-btn">Explore Heating Maintenance</a>
          </article>
          <article class="service-info-panel service-info-panel-alt">
            <span class="section-pill">Cooling Services</span>
            <h3>Need help with AC too?</h3>
            <p>Many homeowners plan heating and cooling upgrades together, especially when comfort problems affect the home year-round.</p>
            <a href="<?php echo esc_url(alpine_get_page_url('air-conditioning-services', array('our-services'), '/air-conditioning-services/')); ?>" class="btn service-cta-btn">View AC Services</a>
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
