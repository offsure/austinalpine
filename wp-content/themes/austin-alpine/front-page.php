<?php
/*
Template Name: Home Page
*/

if (!function_exists('alpine_front_page_service_url')) {
    function alpine_front_page_service_url($preferred_slug, $fallback_slugs = array()) {
        return alpine_get_page_url($preferred_slug, $fallback_slugs, '/air-conditioning-services/');
    }
}

if (!function_exists('alpine_front_page_contact_url')) {
    function alpine_front_page_contact_url() {
        return alpine_get_site_page_url('contact');
    }
}

$home_hero_form_id = function_exists('alpine_get_cf7_form_id_by_title')
    ? alpine_get_cf7_form_id_by_title('Homepage Hero Form')
    : 0;

$home_hero_form = $home_hero_form_id
    ? do_shortcode('[contact-form-7 id="' . $home_hero_form_id . '" title="Homepage Hero Form"]')
    : '';

get_header();

// Hero slides
$hero_slides = array(
    array(
        'eyebrow'  => alpine_get_home_field( 'hero_slide_1_eyebrow', 'Keeping You Cool in Austin' ),
        'title'    => alpine_get_home_field( 'hero_slide_1_title', 'Trusted HVAC Experts Serving Austin and Surrounding Areas' ),
        'subtitle' => alpine_get_home_field( 'hero_slide_1_subtitle', 'Straightforward heating and air conditioning service for homes and businesses across Central Texas. We respond quickly, diagnose issues accurately, and give you clear next steps so you’re never left guessing.' ),
        'class'    => 'hero-slide-1',
    ),
    array(
        'eyebrow'  => alpine_get_home_field( 'hero_slide_2_eyebrow', 'Heating And Cooling Help' ),
        'title'    => alpine_get_home_field( 'hero_slide_2_title', 'Cooling and Heating Experts You Can Trust' ),
        'subtitle' => alpine_get_home_field( 'hero_slide_2_subtitle', 'Trusted HVAC repair, installation, and maintenance for Austin homes and businesses. Our licensed team delivers fast service, honest recommendations, and dependable heating and cooling solutions to keep your property comfortable year round.' ),
        'class'    => 'hero-slide-2',
    ),
);

$hero_features = array(
    array(
        'title' => alpine_get_home_field( 'hero_feature_1_title', 'Expert Technicians' ),
        'text'  => alpine_get_home_field( 'hero_feature_1_text', 'Licensed technicians who fix it right the first time.' ),
    ),
    array(
        'title' => alpine_get_home_field( 'hero_feature_2_title', '24/7 Emergency' ),
        'text'  => alpine_get_home_field( 'hero_feature_2_text', 'Immediate support for urgent HVAC issues.' ),
    ),
    array(
        'title' => alpine_get_home_field( 'hero_feature_3_title', 'Transparent Pricing' ),
        'text'  => alpine_get_home_field( 'hero_feature_3_text', 'No hidden costs, clear and honest quotes.' ),
    ),
);
?>


  <section class="hero-section text-white">
      <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>

        </div>
        <div class="carousel-inner">
          <?php foreach ( $hero_slides as $slide_index => $slide ) : ?>
          <div class="carousel-item<?php echo 0 === $slide_index ? ' active' : ''; ?>">
            <div class="hero-slide <?php echo esc_attr( $slide['class'] ); ?>">
              <div class="container position-relative py-2">
                <div class="row g-4 hero-content-row">
                  <div class="col-lg-7 hero-copy text-center text-lg-start">
                    <span class="hero-eyebrow"><?php echo esc_html( $slide['eyebrow'] ); ?></span>
                    <?php // Only the first slide carries the page H1; later slides reuse the style without duplicating the heading. ?>
                    <?php if ( 0 === $slide_index ) : ?>
                    <h1 class="hero-title"><?php echo esc_html( $slide['title'] ); ?></h1>
                    <?php else : ?>
                    <p class="hero-title"><?php echo esc_html( $slide['title'] ); ?></p>
                    <?php endif; ?>
                    <p class="hero-subtitle"><?php echo esc_html( $slide['subtitle'] ); ?></p>
                    <div class="hero-feature-wrap row g-3 mt-4">
                      <?php foreach ( $hero_features as $feature ) : ?>
                      <div class="col-md-4">
                        <div class="hero-feature">
                          <h2 class="h4"><?php echo esc_html( $feature['title'] ); ?></h2>
                          <p><?php echo esc_html( $feature['text'] ); ?></p>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="hero-form-card">
                      <div class="hero-form-wrap">
                        <?php echo $home_hero_form; ?>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
  </header>

  <main>
    <section id="about" class="py-5">
      <div class="container">
        <div class="row g-4 align-items-center">
          <div class="col-lg-5">
            <img loading="lazy" decoding="async" src="<?php echo esc_url( alpine_get_home_field( 'about_image', home_url('/wp-content/uploads/2026/03/alpine-team.webp') ) ); ?>" class="img-fluid rounded-4 w-100" alt="Alpine Heating & Air Conditioning technicians ready for a service call in Austin, TX" />
          </div>
          <div class="col-lg-7">
            <span class="section-tag"><?php echo esc_html( alpine_get_home_field( 'about_tag', 'About Us' ) ); ?></span>
            <h2 class="section-title"><?php echo esc_html( alpine_get_home_field( 'about_title', 'Air Conditioning and Heating Specialists' ) ); ?></h2>
            <p><?php echo esc_html( alpine_get_home_field( 'about_para_1', 'We combine modern tools with years of hands-on experience to provide heating, ventilation and air conditioning services for homes and businesses.' ) ); ?></p>
            <p><?php echo esc_html( alpine_get_home_field( 'about_para_2', 'From installation and regular maintenance to urgent repairs, our goal is simple: comfort, safety and efficiency you can trust.' ) ); ?></p>
            <a href="<?php echo esc_url(alpine_get_site_page_url('about')); ?>" class="btn btn-bg px-4"><?php echo esc_html( alpine_get_home_field( 'about_button_label', 'About Company' ) ); ?></a>
          </div>
        </div>
      </div>
    </section>

    <?php
    // Service cards: title/text/image are ACF-editable; link + layout class stay in code.
    $home_service_cards = array(
        array( 'n' => 1, 'title' => 'AC Installation', 'text' => 'Install high-efficiency cooling equipment sized for your home and built for Austin heat.', 'image' => '/wp-content/uploads/2026/03/installation-service.webp', 'alt' => 'Technician installing a new air conditioning system', 'class' => 'instl', 'url' => alpine_front_page_service_url('ac-installation', array('air-conditioning-services', 'our-services')) ),
        array( 'n' => 2, 'title' => 'Heating Maintenance', 'text' => 'Keep your furnace or heater efficient, safe, and ready for colder weather with seasonal service.', 'image' => '/wp-content/uploads/2026/03/maintenance-srvc.webp', 'alt' => 'Seasonal furnace maintenance visit', 'class' => 'rplcmnt', 'url' => alpine_front_page_service_url('heating-maintenance', array('maintenance', 'maintenance-plan', 'air-conditioning-services', 'our-services')) ),
        array( 'n' => 3, 'title' => 'AC Repair', 'text' => 'Restore cooling fast with expert diagnostics and lasting repairs for all major AC systems.', 'image' => '/wp-content/uploads/2026/03/repair-service.webp', 'alt' => 'Technician diagnosing an AC unit during a repair call', 'class' => 'repair', 'url' => alpine_front_page_service_url('ac-repair', array('air-conditioning-services', 'our-services')) ),
        array( 'n' => 4, 'title' => 'AC Maintenance', 'text' => 'Reduce breakdown risk and improve efficiency with regular tune-ups and preventive cooling care.', 'image' => '/wp-content/uploads/2026/03/ac-maintenance.jpg', 'alt' => 'Technician performing an AC tune-up', 'class' => 'mntnc', 'url' => alpine_front_page_service_url('ac-maintenance', array('maintenance-plan', 'air-conditioning-services', 'our-services')) ),
        array( 'n' => 5, 'title' => 'Heating Installation', 'text' => 'Upgrade home comfort with professionally installed heating systems tailored to your space.', 'image' => '/wp-content/uploads/2026/03/heating-installation.jpg', 'alt' => 'New heating system being installed in a home', 'class' => 'instl', 'url' => alpine_front_page_service_url('heating-installation', array('installation', 'air-conditioning-services', 'our-services')) ),
        array( 'n' => 6, 'title' => 'Indoor Air Quality', 'text' => 'Improve filtration, purification, and whole-home comfort with cleaner indoor air solutions.', 'image' => '/wp-content/uploads/2026/03/indoor-air-quality.jpg', 'alt' => 'Indoor air quality filtration equipment', 'class' => 'repair', 'url' => alpine_front_page_service_url('indoor-air-quality', array('air-conditioning-services', 'our-services')) ),
        array( 'n' => 7, 'title' => 'Heating Repair', 'text' => 'Fix no-heat issues, uneven performance, and worn components before comfort drops further.', 'image' => '/wp-content/uploads/2026/03/heating-repair.jpg', 'alt' => 'Technician repairing a residential heating system', 'class' => 'repair', 'url' => alpine_front_page_service_url('heating-repair', array('repair', 'air-conditioning-services', 'our-services')) ),
        array( 'n' => 8, 'title' => 'Ductless Mini-Splits', 'text' => 'Install, repair, and maintain ductless systems for efficient zoned heating and cooling.', 'image' => '/wp-content/uploads/2026/03/home-slider-2.webp', 'alt' => 'Ductless mini-split services', 'class' => 'mntnc', 'url' => alpine_front_page_service_url('ductless-services', array('air-conditioning-services', 'our-services')) ),
    );
    ?>
    <section id="services" class="py-5 bg-light home-services-section">
      <div class="container">
        <div class="text-center mb-4 home-services-header">
          <span class="section-tag"><?php echo esc_html( alpine_get_home_field( 'services_tag', 'Complete Solutions' ) ); ?></span>
          <h2 class="section-title"><?php echo esc_html( alpine_get_home_field( 'services_title', 'Our Services' ) ); ?></h2>
          <p class="mx-auto section-max"><?php echo esc_html( alpine_get_home_field( 'services_intro', 'Comprehensive solutions for residential and commercial HVAC systems.' ) ); ?></p>
        </div>
        <div class="row g-4 home-services-grid">
          <?php foreach ( $home_service_cards as $card ) :
              $card_title = alpine_get_home_field( 'service_' . $card['n'] . '_title', $card['title'] );
              $card_text  = alpine_get_home_field( 'service_' . $card['n'] . '_text', $card['text'] );
              $card_image = alpine_get_home_field( 'service_' . $card['n'] . '_image', home_url( $card['image'] ) );
          ?>
          <div class="col-md-6 col-lg-3">
            <article class="service-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url( $card_image ); ?>" alt="<?php echo esc_attr( $card['alt'] ); ?>" class="img-fluid">
              <div class="service-content <?php echo esc_attr( $card['class'] ); ?>">
                <h3 class="h5"><?php echo esc_html( $card_title ); ?></h3>
                <p><?php echo esc_html( $card_text ); ?></p>
                <a class="btn-main" href="<?php echo esc_url( $card['url'] ); ?>">Read More<span class="visually-hidden"> about <?php echo esc_html( $card['title'] ); ?></span></a>
              </div>
            </article>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <?php
    $home_why_cards = array(
        array( 'n' => 1, 'title' => 'Expert Technicians', 'text' => '<b>Our certified HVAC technicians bring years of hands-on experience servicing homes throughout Austin, including areas like Tarrytown, Westlake, and Circle C Ranch.</b> We diagnose issues quickly and accurately, whether it’s a struggling AC unit in peak summer heat or a heating system that isn’t performing when temperatures dip. Every technician is trained on modern, energy-efficient systems and proven repair methods to ensure the job is done right the first time. When you work with us, you’re getting professionals who understand local homes, climate demands, and how to keep your system running efficiently year-round.' ),
        array( 'n' => 2, 'title' => 'Flexible Scheduling', 'text' => '<b>HVAC problems don’t always happen on a schedule, and we don’t expect you to rearrange your life to fix them. We offer flexible appointment times for homeowners across Bee Cave, Lakeway, and Steiner Ranch, making it easy to get service when it works for you.</b> Whether you need a same-day visit, a scheduled repair, or routine maintenance, we provide reliable time windows and responsive service. Our goal is simple—make the process easy, convenient, and stress-free from start to finish.' ),
        array( 'n' => 3, 'title' => 'Transparent Pricing', 'text' => 'We believe homeowners deserve clear, honest pricing without confusion or surprises. Before any work begins, you’ll receive a detailed breakdown of costs so you know exactly what to expect. <b>From AC repairs in Round Rock to full system replacements in Cedar Park, our pricing remains consistent, fair, and easy to understand.</b> No hidden fees, no unnecessary upsells—just straightforward service that builds trust and long-term relationships.' ),
        array( 'n' => 4, 'title' => 'Quality Parts', 'text' => 'We use high-quality, manufacturer-approved parts designed to handle the demands of Central Texas weather. <b>Whether we’re servicing a system in South Austin or installing new equipment in Pflugerville, every component we use is selected for durability and performance.</b> From compressors to thermostats, we focus on long-term reliability to reduce breakdowns and extend the life of your system. Better parts mean fewer issues and more consistent comfort in your home.' ),
        array( 'n' => 5, 'title' => 'Emergency Services', 'text' => '<b>When your HVAC system fails, timing matters. We provide fast, responsive emergency services for homeowners in areas like Mueller, Hyde Park, and East Austin.</b> Whether your AC goes out during extreme heat or your heater stops working on a cold night, we’re ready to respond quickly and restore comfort. Our team arrives prepared to diagnose and resolve urgent issues so you’re not left dealing with unsafe or uncomfortable conditions.' ),
        array( 'n' => 6, 'title' => 'Satisfaction Guarantee', 'text' => 'We stand behind every service we provide, from small repairs to full system installations. <b>Homeowners in West Lake Hills, Rollingwood, and Barton Creek trust us because we focus on doing the job right, not just getting it done.</b> If something doesn’t meet expectations, we address it promptly and professionally. Our commitment is simple—deliver quality work, clear communication, and results you can rely on long after the service is complete.' ),
    );
    ?>
    <section class="py-5 why-section">
      <div class="container">
        <div class="text-center mb-5">
          <span class="section-tag why-tag"><?php echo esc_html( alpine_get_home_field( 'why_tag', 'Top 6 Reasons' ) ); ?></span>
          <h2 class="section-title"><?php echo esc_html( alpine_get_home_field( 'why_title', 'Why Choose Us' ) ); ?></h2>
          <p class="mx-auto section-max why-intro"><?php echo esc_html( alpine_get_home_field( 'why_intro', 'Homeowners across the Greater Austin area choose Alpine Heating & Air Conditioning for reliable service, honest communication, and solutions designed for long-term comfort.' ) ); ?></p>
        </div>
        <div class="row g-3 g-lg-4 why-grid">
          <?php foreach ( $home_why_cards as $why ) : ?>
          <div class="col-md-6 col-lg-4">
            <article class="why-card">
              <div class="why-copy">
                <div class="why-card-head">
                  <span class="why-icon" aria-hidden="true"><span class="why-icon-mark"></span></span>
                  <h3 class="h6"><?php echo esc_html( alpine_get_home_field( 'why_card_' . $why['n'] . '_title', $why['title'] ) ); ?></h3>
                </div>
                <p><?php echo wp_kses_post( alpine_get_home_field( 'why_card_' . $why['n'] . '_text', $why['text'] ) ); ?></p>
              </div>
            </article>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="promo-box mt-5 p-4 p-lg-5" style="--promo-box-bg-image: url('<?php echo esc_url(home_url('/wp-content/uploads/2026/03/long-shot-happy-family-living-room-scaled.webp')); ?>');">
          <div class="row align-items-center g-4">
            <div class="col-lg-8 text-white">
              <h3><?php echo esc_html( alpine_get_home_field( 'promo_heading', 'Alpine Heating & Air Conditioning specializes in heating, cooling, and indoor air quality solutions tailored to homes and businesses across the Greater Austin area.' ) ); ?></h3>
              <a href="<?php echo esc_url(alpine_front_page_contact_url()); ?>" class="btn btn-bg mt-3"><?php echo esc_html( alpine_get_home_field( 'promo_button_label', 'Schedule Now' ) ); ?></a>
            </div>
            <div class="col-lg-4 text-center">
              <div class="promo-photo-card">
                <img loading="lazy" decoding="async" class="promo-photo" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/repair-service.webp')); ?>" alt="HVAC technician helping a family indoors" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5 home-equipment-section">
      <div class="container">
        <div class="text-center mb-5">
          <span class="section-tag"><?php echo esc_html( alpine_get_home_field( 'equipment_tag', 'Trusted Systems' ) ); ?></span>
          <h2 class="section-title"><?php echo esc_html( alpine_get_home_field( 'equipment_title', 'Our Parts and Equipment' ) ); ?></h2>
          <p class="mx-auto section-max"><?php echo esc_html( alpine_get_home_field( 'equipment_intro', 'We install and service proven HVAC equipment, including Carrier parts, built for long-term comfort, efficiency, and reliable performance.' ) ); ?></p>
        </div>
        <div class="row g-4 align-items-center equipment-showcase">
          <div class="col-lg-4">
            <article class="manufacturer-card">
              <h3 class="manufacturer-kicker">
               <?php echo esc_html( alpine_get_home_field( 'equipment_card_title', 'Featured Carrier Parts' ) ); ?>
              </h3>

              <p class="manufacturer-copy mt-1"><?php echo esc_html( alpine_get_home_field( 'equipment_card_text', 'We feature Carrier parts and equipment from a trusted brand known for dependable heating and cooling performance.' ) ); ?></p>
            </article>
          </div>
          <div class="col-lg-8">
            <article class="equipment-visual-card">
              <div class="equipment-image-grid">
                <div class="equipment-image-grid-main">
                  <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/installation-service.webp')); ?>" alt="Technician completing an HVAC system installation" class="equipment-hero-image equipment-hero-image-main">
                </div>
                <div class="equipment-image-grid-stack">
                  <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/carrier.webp')); ?>" alt="Carrier heating and cooling equipment" class="equipment-hero-image equipment-hero-image-side">
                  <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/ca.jpg')); ?>" alt="HVAC outdoor unit and technician" class="equipment-hero-image equipment-hero-image-side">
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    <?php
    $reviews_data = function_exists('alpine_get_homepage_reviews_data') ? alpine_get_homepage_reviews_data(array(), 30) : array(
      'reviews' => array(),
      'rating' => '4.9',
      'user_rating_count' => '',
      'google_url' => 'https://www.google.com/maps/place/Alpine+Heating+%26+Air+Conditioning/@30.3447804,-97.68545,638m/data=!3m1!1e3!4m8!3m7!1s0x8644cb9622becf43:0xdb75f99757ea2077!8m2!3d30.3447804!4d-97.68545!9m1!1b1!16s%2Fg%2F11bbrjc3d0?hl=en&entry=ttu&g_ep=EgoyMDI2MDMyOS4wIKXMDSoASAFQAw%3D%3D',
      'is_live' => false,
    );
    $google_reviews_url = $reviews_data['google_url'];
    $review_slides = array_chunk($reviews_data['reviews'], 3);
    ?>
    <section class="py-5 testimonial-section">
      <div class="container">
        <div class="reviews-shell">
          <div class="reviews-head">
            <div class="reviews-head-copy">
              <span class="section-tag"><?php echo esc_html( alpine_get_home_field( 'reviews_tag', 'Google Reviews' ) ); ?></span>
              <h2 class="reviews-title"><?php echo esc_html( alpine_get_home_field( 'reviews_title', 'Real Reviews From Austin Homeowners' ) ); ?></h2>
              <p class="reviews-intro"><?php echo esc_html( alpine_get_home_field( 'reviews_intro', 'Trusted feedback from customers who count on Alpine Heating & Air Conditioning for dependable service, clear communication, and lasting comfort.' ) ); ?></p>
            </div>
            <div class="reviews-head-actions">
              <a href="<?php echo esc_url($google_reviews_url); ?>" class="reviews-google-link" target="_blank" rel="noopener noreferrer">Read Google Reviews</a>
              <?php if (!empty($reviews_data['reviews'])) : ?>
                <div class="reviews-nav" aria-label="Review carousel controls">
                  <button class="reviews-nav-btn" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" aria-label="Previous reviews">&larr;</button>
                  <button class="reviews-nav-btn reviews-nav-btn-primary" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" aria-label="Next reviews">&rarr;</button>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="reviews-meta">
            <div class="badge rating-badge">★★★★★</div>
            <span><?php echo esc_html($reviews_data['rating']); ?>/5 average rating</span>
            <?php if (!empty($reviews_data['user_rating_count'])) : ?>
              <span class="reviews-meta-dot" aria-hidden="true"></span>
              <span><?php echo esc_html($reviews_data['user_rating_count']); ?> Google ratings</span>
            <?php endif; ?>
            <span class="reviews-meta-dot" aria-hidden="true"></span>
            <a href="<?php echo esc_url($google_reviews_url); ?>" target="_blank" rel="noopener noreferrer">View on Google Maps</a>
          </div>

          <?php if (!empty($reviews_data['reviews'])) : ?>
            <div id="testimonialCarousel" class="carousel slide reviews-carousel" data-bs-ride="carousel" data-bs-interval="7000">
              <div class="carousel-inner">
                <?php foreach ($review_slides as $slide_index => $review_group) : ?>
                  <div class="carousel-item<?php echo 0 === $slide_index ? ' active' : ''; ?>">
                    <div class="row g-4">
                      <?php foreach ($review_group as $review) : ?>
                        <div class="col-md-6 col-xl-4">
                          <article class="testimonial-card">
                            <div class="quote-mark" aria-hidden="true">&ldquo;</div>
                            <p<?php echo !empty($review['full_quote']) ? ' title="' . esc_attr($review['full_quote']) . '"' : ''; ?>><?php echo esc_html($review['quote']); ?></p>
                            <a href="<?php echo esc_url(!empty($review['url']) ? $review['url'] : $google_reviews_url); ?>" class="testimonial-link" target="_blank" rel="noopener noreferrer">View Review</a>
                            <div class="testimonial-card-footer">
                              <div class="testimonial-google-mark" aria-hidden="true">G</div>
                              <div>
                                <div class="testimonial-stars"><?php echo esc_html(str_repeat('★', !empty($review['rating']) ? (int) $review['rating'] : 5)); ?></div>
                                <h3 class="h6"><?php echo esc_html($review['name']); ?></h3>
                                <small><?php echo esc_html(trim($review['role'] !== '' ? $review['role'] . ' • ' . $review['location'] : $review['location'])); ?></small>
                              </div>
                            </div>
                          </article>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php else : ?>
            <div class="reviews-empty-state">
              <p>Live Google review excerpts are not available right now.</p>
              <a href="<?php echo esc_url($google_reviews_url); ?>" class="reviews-google-link" target="_blank" rel="noopener noreferrer">Browse All Google Reviews</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

   

    <section class="cta-banner">
      <div class="container">
        <div class="cta-inner d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
          <?php $home_cta_phone = alpine_get_setting( 'phone_number', '(512) 759-4247' ); ?>
          <h2 class="h4 mb-0"><?php echo esc_html( alpine_get_home_field( 'cta_heading', 'Need emergency repair service?' ) ); ?></h2>
          <a href="<?php echo esc_attr( alpine_tel_href( $home_cta_phone ) ); ?>" class="btn btn-light btn-lg rounded-pill"><?php echo esc_html( $home_cta_phone ); ?></a>
        </div>
      </div>
    </section>

    <!--
    <section class="brand-strip py-4">
      <div class="container">
        <div class="d-flex flex-wrap justify-content-center gap-4 text-uppercase fw-bold">
          <span>Carrier</span>
          <span>Amana</span>
          <span>Trane</span>
          <span>Daikin</span>
          <span>Honeywell</span>
        </div>
      </div>
    </section>
    -->
  </main>



<?php get_footer(); ?>
