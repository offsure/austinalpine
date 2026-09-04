<?php
/*
Template Name: HVAC Services Page
*/

get_header();
require_once get_stylesheet_directory() . '/inc/service-area-links-section.php';

$uploads_base = trailingslashit(home_url('/wp-content/uploads/2026'));

$cooling_services = array(
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
);
?>
<div class="service-page installation-page ac-services-page">
  <section class="page-hero">
    <div class="container hero-content">
      <div class="hero-copy">
        <span class="hero-chip">Our Service</span>
        <h1>Air Conditioning Services in Austin, TX</h1>
        <p class="hero-subtext">From preseason tune-ups to fast AC repair and full system replacement, Alpine Heating &amp; Air Conditioning helps Austin-area homeowners stay cool through long Central Texas summers with practical recommendations and dependable workmanship.</p>
        <div class="hero-cta-group">
          <a href="<?php echo esc_url(alpine_get_site_page_url('estimate')); ?>" class="btn service-cta-btn">Request Estimate</a>
          <a href="<?php echo esc_url(alpine_get_site_page_url('repair')); ?>" class="btn btn-outline-light">Explore AC Repair</a>
        </div>
      </div>
      <aside class="hero-sidecard">
        <strong>Cooling help for repairs, maintenance, installation, and replacement.</strong>
        <p class="hero-sidecard-copy">Serving Austin and nearby communities with air conditioning service built around comfort, efficiency, and honest guidance.</p>
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
            <span class="section-pill">Local Cooling Specialists</span>
            <h2 class="section-title">Reliable <span class="highlight">air conditioning</span> service for Austin homes</h2>
            <p class="service-intro">Austin homeowners put serious demand on their cooling systems for much of the year. Between early spring heat, long triple-digit stretches, and high indoor comfort expectations, your AC system has to do more than simply turn on. It has to cool evenly, control humidity, and keep up without driving utility costs through the roof.</p>
            <p class="service-intro">That is why our air conditioning service page brings the full cooling lifecycle into one place. Whether you need <a href="<?php echo esc_url(alpine_get_page_url('ac-repair', array(), '/ac-repair/')); ?>">AC repair in Austin</a>, a <a href="<?php echo esc_url(alpine_get_page_url('ac-maintenance', array(), '/ac-maintenance/')); ?>">seasonal AC tune-up</a> before summer, a <a href="<?php echo esc_url(alpine_get_page_url('ac-replacement', array(), '/ac-replacement/')); ?>">replacement quote for an aging system</a>, or guidance on a brand-new installation, Alpine Heating &amp; Air Conditioning is here to help you make the right next move.</p>
            <div class="ac-intro-tags">
              <span>AC repair</span>
              <span>Seasonal maintenance</span>
              <span>New system installation</span>
              <span>Full replacement</span>
              <span>Energy-efficiency upgrades</span>
              <span>Comfort troubleshooting</span>
            </div>
          </div>

          <div class="service-visual-grid ac-intro-visuals">
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/repair-service.webp')); ?>" alt="HVAC technician inspecting an air conditioning system in Austin">
            </article>
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/ac-maintenance.jpg')); ?>" alt="Air conditioning maintenance and performance check">
            </article>
          </div>
        </div>

        <div class="ac-service-highlight-grid">
          <article class="ac-service-highlight-card ac-service-highlight-card-accent">
            <small>What We Handle</small>
            <h3>Cooling service built for Central Texas demand</h3>
            <p>We help with airflow issues, inconsistent cooling, older equipment, rising energy bills, noisy operation, frozen coils, thermostat concerns, and systems that simply cannot keep up anymore.</p>
          </article>
          <article class="ac-service-highlight-card">
            <small>Maintenance</small>
            <strong>Keep summer breakdowns from catching you off guard.</strong>
          </article>
          <article class="ac-service-highlight-card">
            <small>Repair</small>
            <strong>Get answers when your AC starts blowing warm air or short cycling.</strong>
          </article>
          <article class="ac-service-highlight-card">
            <small>Replacement</small>
            <strong>Compare repair costs against long-term system value before you commit.</strong>
          </article>
        </div>

        <div class="service-feature-grid">
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>AC Repair</h3>
              <p>Fast diagnostics for warm air, weak airflow, frozen coils, electrical issues, thermostat problems, and systems that stop cooling when you need them most.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>AC Installation</h3>
              <p>Thoughtful installation planning for new homes, remodels, and homeowners replacing outdated equipment with something more efficient and dependable.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>AC Replacement</h3>
              <p>Clear replacement guidance when frequent repairs, age, or poor efficiency make it harder for your current system to justify keeping it.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Preventive Maintenance</h3>
              <p>Seasonal tune-ups and routine service designed to improve efficiency, reduce wear, and give your equipment a better chance of surviving peak heat.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Honest Repair-or-Replace Advice</h3>
              <p>We help you understand whether the smarter move is another repair, a planned upgrade, or a full replacement based on your system and your goals.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Maintenance Plans &amp; Financing</h3>
              <p>Long-term service support and flexible financing options make it easier to stay ahead of emergency breakdowns or move forward with larger projects.</p>
            </div>
          </article>
        </div>

        <section class="ac-symptoms-section mt-5">
          <div class="ac-section-heading">
            <span class="section-pill">Common Problems</span>
            <h2 class="section-title">Signs your <span class="highlight">air conditioner</span> may need service</h2>
            <p class="service-intro">Most homeowners do not need a technical explanation. They need to know whether the symptoms they are seeing point to maintenance, repair, or replacement. These are some of the most common reasons people in Austin call for AC service.</p>
          </div>
          <div class="ac-symptom-grid">
            <article class="ac-symptom-card">
              <h3>Warm air or weak airflow</h3>
              <p>If rooms are not cooling down evenly, airflow is poor, or the system never seems to catch up, there may be a refrigerant, blower, thermostat, or duct-related issue.</p>
            </article>
            <article class="ac-symptom-card">
              <h3>Short cycling or nonstop runtime</h3>
              <p>An AC that starts and stops too often or runs constantly can point to sizing problems, airflow restrictions, dirty components, or an underlying performance issue.</p>
            </article>
            <article class="ac-symptom-card">
              <h3>Higher energy bills</h3>
              <p>When energy use climbs without a clear reason, your cooling system may be losing efficiency due to age, wear, neglected maintenance, or failing parts.</p>
            </article>
            <article class="ac-symptom-card">
              <h3>Frequent repairs on an older unit</h3>
              <p>If repair calls are becoming a pattern and the system is already near the end of its expected lifespan, replacement may provide better value and more stable comfort.</p>
            </article>
          </div>
        </section>

        <section class="mt-5">
          <div class="ac-section-heading">
            <span class="section-pill">Cooling Services</span>
            <h2 class="section-title">Cooling Services</h2>
          </div>
          <div class="service-overview-grid">
            <?php foreach ($cooling_services as $service) : ?>
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
            <h2 class="section-title">Straightforward AC service with <span class="highlight">real guidance</span></h2>
            <p class="service-intro">A good service visit should leave you with clarity, not pressure. Our approach is built around diagnosing the actual issue, explaining what is happening in plain language, and helping you decide whether a repair, tune-up, or upgrade makes the most sense for your home.</p>
            <p class="service-intro">That matters even more in Austin, where cooling systems work hard for a large part of the year. Better sizing, better airflow, and better maintenance habits often make as much difference as the equipment itself.</p>
          </div>
          <div class="ac-process-steps">
            <article class="ac-process-step">
              <span>01</span>
              <h3>Inspect the system</h3>
              <p>We look at the symptoms, equipment condition, airflow, and system behavior before making recommendations.</p>
            </article>
            <article class="ac-process-step">
              <span>02</span>
              <h3>Explain the options</h3>
              <p>You get a clear picture of whether maintenance, repair, or replacement is the better path.</p>
            </article>
            <article class="ac-process-step">
              <span>03</span>
              <h3>Complete the work</h3>
              <p>From tune-ups to larger cooling projects, the goal is dependable performance and fewer surprises later.</p>
            </article>
          </div>
        </section>

        <div class="service-panel-grid">
          <article class="service-info-panel">
            <span class="section-pill">Maintenance Plans</span>
            <h3>Stay ahead of heavy summer demand</h3>
            <p>Preventive service helps reduce breakdown risk, improve efficiency, and protect long-term equipment performance before extreme heat pushes your system too hard.</p>
            <a href="<?php echo esc_url(alpine_get_site_page_url('maintenance')); ?>" class="btn service-cta-btn">Explore Maintenance</a>
          </article>
          <article class="service-info-panel service-info-panel-alt">
            <span class="section-pill">Financing Options</span>
            <h3>Move forward when replacement cannot wait</h3>
            <p>When repair costs keep adding up or your current unit is no longer dependable, financing spreads the cost of a new AC installation or replacement more manageable.</p>
            <a href="<?php echo esc_url(alpine_get_site_page_url('financing')); ?>" class="btn service-cta-btn">View Financing</a>
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
