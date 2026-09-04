  <?php
/*
Template Name: Commercial HVAC
*/

get_header();
require_once get_stylesheet_directory() . '/inc/service-area-links-section.php';

$upload_base_url = trailingslashit( wp_get_upload_dir()['baseurl'] );
$commercial_hero_background_url = $upload_base_url . '2026/04/commercial-bg-img.jpg';
$commercial_hero_form_id = function_exists( 'alpine_get_cf7_form_id_by_title' )
    ? alpine_get_cf7_form_id_by_title( 'Homepage Hero Form' )
    : 0;
$commercial_hero_form = $commercial_hero_form_id
    ? do_shortcode( '[contact-form-7 id="' . $commercial_hero_form_id . '" title="Homepage Hero Form"]' )
    : do_shortcode( '[contact-form-7 id="bf38474" title="Contact form 1"]' );
?>

<div class="service-page installation-page commercial-page">
	
    <section
      class="page-hero"
      style="background: linear-gradient(108deg, rgba(20, 59, 114, 0.72), rgba(92, 126, 176, 0.58)), url('<?php echo esc_url( $commercial_hero_background_url ); ?>') center/cover no-repeat;"
    >
      <div class="container hero-content">
        <div class="hero-copy commercial-hero-copy">
          <!-- <span class="hero-chip">Business Service</span> -->
           <img loading="lazy" decoding="async" class="commercial-hero-logo" src="<?php echo esc_url( $upload_base_url . '2026/04/Commercial-Services-lg.png' ); ?>" alt="Commercial HVAC services in Austin, TX">
           
        
          <h1>Commercial HVAC Services in Austin, TX</h1>
          <p class="hero-subtext d-block">Don't let HVAC failure affect your bottom line. </p>
<p class="d-block">Reliable temperature control is crucial for maintaining productivity and customer satisfaction in your commercial space. Whether you need an office HVAC repair or industrial heating solutions, Alpine Commercial Services is the top choice for commercial HVAC services in Austin, Westlake, Lakeway, Bee Cave, and surrounding areas. We deliver consistent, high-quality heating and air conditioning services designed to keep your operations running smoothly.</p>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Commercial HVAC'),
          )); ?>
        </div>
        <div class="hero-form-card commercial-hero-form-card">
          <div class="hero-form-wrap">
            <?php echo $commercial_hero_form; ?>
          </div>
        </div>
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
          <div class="service-split commercial-intro-section">
            <div class="commercial-intro-copy">
              <h2 class="section-title">Commercial HVAC Services</h2>
              <p class="service-intro">Alpine Heating & Air Conditioning supports commercial properties with repair, maintenance, installation, and emergency HVAC service designed around occupied buildings, equipment uptime, and day-to-day business operations.</p>
              <p class="service-intro">We work with offices, retail spaces, industrial facilities, and other commercial environments that need practical scheduling, experienced technicians, and clear next-step recommendations when heating or cooling issues affect the property.</p>
            </div>

            <div class="service-visual-grid commercial-intro-visuals">
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url( $upload_base_url . '2026/04/hvac_commercial-scaled.jpg' ); ?>" alt="Commercial office HVAC support">
              </article>
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url( $upload_base_url . '2026/04/hvac_commercial_service-scaled.jpg' ); ?>" alt="Commercial HVAC technician inspection">
              </article>
            </div>
          </div>

          <div class="service-feature-grid">
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Commercial Repairs</h3>
                <p>Fast diagnostics and repairs help businesses respond quickly when equipment problems affect comfort or operations.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>System Installations</h3>
                <p>Installation services support tenant improvements, new build-outs, and replacement projects for commercial spaces.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Preventive Maintenance</h3>
                <p>Planned maintenance helps reduce downtime, extend equipment life, and keep systems operating more efficiently.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Replacement Planning</h3>
                <p>When aging systems become costly to maintain, replacement planning helps businesses compare long-term options.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Energy Efficiency</h3>
                <p>Efficiency improvements can help reduce operating costs while maintaining more consistent comfort across the property.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Business-Focused Support</h3>
                <p>Commercial HVAC work requires scheduling, communication, and service planning that fit the needs of active properties.</p>
              </div>
            </article>
          </div>

          <div class="service-panel-grid">
            <article class="service-info-panel">
              <span class="section-pill">Operational Support</span>
              <h3>Keep your building comfortable and running</h3>
              <p>Commercial heating and cooling problems can affect customers, employees, and daily business flow. Prompt service helps reduce disruption and restore usable space faster.</p>
              <a href="<?php echo esc_url(alpine_get_site_page_url('estimate')); ?>" class="btn service-cta-btn">Request Estimate</a>
            </article>
            <article class="service-info-panel service-info-panel-alt">
              <span class="section-pill">Long-Term Value</span>
              <h3>Plan repairs, maintenance, and upgrades strategically</h3>
              <p>Commercial properties benefit from a service approach that considers lifecycle costs, efficiency, tenant comfort, and reliable scheduling over time.</p>
              <a href="<?php echo esc_url(alpine_get_site_page_url('maintenance_plan')); ?>" class="btn service-cta-btn">View Maintenance</a>
            </article>
          </div>

          <section class="commercial-detail-section mt-5">
            <div class="commercial-team-panel">
              <div class="commercial-team-copy">
                <span class="section-pill">Our Team</span>
                <h2 class="section-title">Experienced technicians for active <span class="highlight">commercial properties</span></h2>
                <p class="service-intro">Our commercial HVAC team includes 4 service technicians, and each technician brings a minimum of 10 years of service experience. That depth matters when systems are tied to tenant comfort, operating schedules, and business continuity.</p>
                <p class="service-intro">From troubleshooting and repairs to installation planning, the focus stays on dependable communication, practical solutions, and service that respects the day-to-day needs of the property.</p>
              </div>

              <div class="commercial-team-stats">
                <article class="commercial-stat-card">
                  <small>Service technicians</small>
                  <strong>4</strong>
                </article>
                <article class="commercial-stat-card">
                  <small>Minimum experience each</small>
                  <strong>10+ years</strong>
                </article>
              </div>
            </div>
          </section>

          <section class="commercial-detail-section mt-5">
            <div class="commercial-detail-copy">
              <span class="section-pill">Equipment Coverage</span>
              <h2 class="section-title">Commercial systems we <span class="highlight">service and install</span></h2>
              <p class="service-intro">Different buildings use different equipment strategies, so commercial support needs to span more than standard split systems. Alpine works across a wide mix of comfort and process-related HVAC equipment used in commercial settings.</p>
            </div>

            <div class="commercial-equipment-grid">
              <article class="commercial-equipment-card"><span>Mini-Split Systems</span></article>
              <article class="commercial-equipment-card"><span>Package Units</span></article>
              <article class="commercial-equipment-card"><span>Air Cooled Chillers</span></article>
              <article class="commercial-equipment-card"><span>Pumps</span></article>
              <article class="commercial-equipment-card"><span>VRF Systems</span></article>
              <article class="commercial-equipment-card"><span>Dehumidifiers</span></article>
              <article class="commercial-equipment-card"><span>Self-Contained Units</span></article>
              <article class="commercial-equipment-card"><span>Split Systems</span></article>
              <article class="commercial-equipment-card"><span>Boilers</span></article>
            </div>
          </section>

          <section class="commercial-detail-section mt-5">
            <div class="commercial-detail-copy">
              <span class="section-pill">Contact Information</span>
              <h2 class="section-title">Reach our <span class="highlight">commercial HVAC team</span></h2>
              <p class="service-intro">Use the office details below for general commercial HVAC questions, or contact the team member that best matches your service, estimating, dispatch, or billing needs.</p>
            </div>

            <div class="commercial-contact-grid">
              <article class="commercial-contact-card commercial-contact-card-featured">
                <small>Office</small>
                <h3>Austin Alpine Office</h3>
                <p><strong>Address:</strong> 1205 Sheldon Cove Bldg. 2 Ste. J, Austin, TX 78757</p>
                <p><strong>Phone:</strong> <a href="tel:+15127594247">512-759-4247</a></p>
                <p><strong>Website:</strong> <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( preg_replace( '#^https?://#', '', untrailingslashit( get_permalink() ) ) . '/' ); ?></a></p>
              </article>

              <article class="commercial-contact-card">
                <small>Service Sales</small>
                <h3>Travis Crane</h3>
                <p>Project Estimator / Project Manager</p>
                <p><strong>Phone:</strong> <a href="tel:+17373822225">737-382-2225</a></p>
              </article>

              <article class="commercial-contact-card">
                <small>Service Manager</small>
                <h3>Shannon Faulkner</h3>
                <p>Commercial service coordination and support</p>
                <p><strong>Phone:</strong> <a href="tel:+17374659585">737-465-9585</a></p>
              </article>

              <article class="commercial-contact-card">
                <small>Dispatcher</small>
                <h3>Brianna Moran</h3>
                <p>Office scheduling and dispatch support</p>
                <p><strong>Phone:</strong> <a href="tel:+15127594247">512-759-4247</a></p>
              </article>

              <article class="commercial-contact-card">
                <small>Accounts Receivable</small>
                <h3>Vanessa Nyberg</h3>
                <p>Receivables and account support</p>
                <p><strong>Phone:</strong> <a href="tel:+15127594247">512-759-4247</a></p>
              </article>

              <article class="commercial-contact-card">
                <small>Accounts Payable</small>
                <h3>Ana Hernandez</h3>
                <p>Billing and payable inquiries</p>
                <p><strong>Phone:</strong> <a href="tel:+15127594247">512-759-4247</a></p>
              </article>
            </div>
          </section>

          <section class="commercial-detail-section mt-5">
            <div class="commercial-detail-copy">
              <span class="section-pill">Property Types</span>
              <h2 class="section-title">Explore commercial HVAC by <span class="highlight">facility type</span></h2>
              <p class="service-intro">Different commercial environments have different HVAC priorities. These pages break out the kinds of systems, operational pressures, and climate-control concerns that show up across specific property categories.</p>
            </div>

            <div class="commercial-property-grid">
              <article class="commercial-property-card">
                <h3>Office Buildings</h3>
                <p>Large office properties often rely on RTUs, chillers, and AHUs to support multi-zone comfort across active tenant spaces.</p>
                <a href="<?php echo esc_url(alpine_get_commercial_category_page_url('office-buildings')); ?>">Read More<span class="visually-hidden"> about office building HVAC</span></a>
              </article>
              <article class="commercial-property-card">
                <h3>Medical &amp; Healthcare Facilities</h3>
                <p>Hospitals, clinics, and labs require precise climate control, stronger filtration, and dependable ventilation support.</p>
                <a href="<?php echo esc_url(alpine_get_commercial_category_page_url('medical-healthcare-facilities')); ?>">Read More<span class="visually-hidden"> about medical and healthcare facility HVAC</span></a>
              </article>
              <article class="commercial-property-card">
                <h3>Manufacturing Plants</h3>
                <p>Plant environments often need process cooling, worker comfort control, and specialized support for heavier heat loads.</p>
                <a href="<?php echo esc_url(alpine_get_commercial_category_page_url('manufacturing-plants')); ?>">Read More<span class="visually-hidden"> about manufacturing plant HVAC</span></a>
              </article>
              <article class="commercial-property-card">
                <h3>Warehouse &amp; Industrial Facilities</h3>
                <p>Large open spaces, ventilation demands, and loading activity call for practical industrial HVAC planning.</p>
                <a href="<?php echo esc_url(alpine_get_commercial_category_page_url('warehouse-industrial-facilities')); ?>">Read More<span class="visually-hidden"> about warehouse and industrial HVAC</span></a>
              </article>
              <article class="commercial-property-card">
                <h3>Apartment &amp; Condominiums</h3>
                <p>Multi-family properties need HVAC service that supports resident comfort, unit turnover, and common-area reliability.</p>
                <a href="<?php echo esc_url(alpine_get_commercial_category_page_url('apartments-condominiums')); ?>">Read More<span class="visually-hidden"> about apartment and condominium HVAC</span></a>
              </article>
              <article class="commercial-property-card">
                <h3>High-Rise Residential Properties</h3>
                <p>High-rise buildings require planning around vertical systems, common spaces, and occupied-unit coordination.</p>
                <a href="<?php echo esc_url(alpine_get_commercial_category_page_url('high-rise-residential-properties')); ?>">Read More<span class="visually-hidden"> about high-rise residential HVAC</span></a>
              </article>
              <article class="commercial-property-card">
                <h3>IT Data Centers</h3>
                <p>Data environments need specialized cooling and high-precision heat management to protect critical equipment.</p>
                <a href="<?php echo esc_url(alpine_get_commercial_category_page_url('it-data-centers')); ?>">Read More<span class="visually-hidden"> about data center cooling</span></a>
              </article>
              <article class="commercial-property-card">
                <h3>Retail &amp; Food Service</h3>
                <p>Stores, restaurants, and supermarkets depend on efficient comfort cooling and responsive rooftop-unit support.</p>
                <a href="<?php echo esc_url(alpine_get_commercial_category_page_url('retail-food-service')); ?>">Read More<span class="visually-hidden"> about retail and food service HVAC</span></a>
              </article>
              <article class="commercial-property-card">
                <h3>School &amp; Education Facilities</h3>
                <p>Schools and universities need reliable, large-scale ventilation and heating systems that fit occupancy-driven schedules.</p>
                <a href="<?php echo esc_url(alpine_get_commercial_category_page_url('school-education-facilities')); ?>">Read More<span class="visually-hidden"> about school and education facility HVAC</span></a>
              </article>
            </div>
          </section>

          

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
