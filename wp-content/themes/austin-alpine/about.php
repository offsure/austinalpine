  <?php
/*
Template Name: About Page
*/

get_header();
?>
<main class="about-page">
	
<section class="page-hero" id="about">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Our Service</span>
          <h1>About Us</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'About Us'),
          )); ?>
        </div>
        <strong>Air Conditioning and Heating Specialists</strong>
      </div>
      <div class="hero-badge">
        <span>◉</span>
      </div>
    </section>
 <section class="about">
 <div class="container">
	 <div class="about_cnt py-5">
		<h2 class="section-title">
		 Heating &amp; Cooling Services <br/>
	
			Proudly serving the Greater Austin, TX area </h2>
<p>
Ever since we opened our doors to the Austin community in 2006, we have been met with nothing but rave reviews. From our service to our general demeanor, people are impressed and we know you will be too.</p>


<p>
	
		When you want to keep your home comfortable throughout the seasons, turn to us for help.  </p>

<p>
	
		You can depend on us for all of your heating and cooling needs, including repairs, new installations, and regular maintenance plans.  </p>

<h2 class="section-title">
	OUR CORE VALUES   </h2>
<h3>
		 Experienced Owner </h3>
<p>
	
		Cliff started Alpine Heating and Air Conditioning in 2006. After many years in the HVAC industry,
he decided it was time to start a company that would conform with his high ethical standards. Alpine strives to provide honest, accurate information and to always put the customer’s best interest first. When not solving HVAC problems, Cliff loves to spend time with his two beautiful daughters.  </p>

<h3>

		Respectful and Affordable AC Repair  </h3>
<p>
	
		 We make it one of our main goals to deliver to you nothing short of excellence. From respectful interactions to honest and affordable solutions, you can’t go wrong when you trust us. No other company in Austin, TX will deliver high-quality AC repair like ours. Contact us today to get your HVAC questions answered or to schedule a free no-obligation consultation with one of our team members. Call us at <?php echo esc_html( alpine_get_setting( 'phone_number', '(512) 759-4247' ) ); ?>. </p>

<h3>

		Talented Technicians  </h3>
<p>
	
		 We are comprised of a talented group of technicians ready and willing to provide you with HVAC services as well as the answers you require. We take great pride in being able to correctly diagnose and identify reasonable solutions to all problems, especially challenging ones. We are honored to be your first choice in HVAC services, and we take great pride in earning and keeping your trust. </p>
	 </div>
	 </div>	
</section>
    <section class="section-space intro-section">
      <div class="container">
        <div class="row align-items-center g-5">
          <div class="col-lg-6">
            <span class="section-pill">Welcome</span>
            <h2 class="section-title">History of Our Company</h2>
            <p class="section-copy">Welcome to Alpine Heating & Air Conditioning, your trusted partner for heating, cooling, and indoor air quality needs across the Greater Austin area. With years of field experience and a commitment to dependable workmanship, we focus on practical HVAC solutions that match each home and project.</p>
            <p class="section-copy">From installation and repair to maintenance and upgrades, our skilled technicians are dedicated to delivering reliable solutions that ensure your comfort and satisfaction. We focus on practical service, long-term performance, and responsive support.</p>
            <p class="section-copy">Alpine is a licensed Texas HVAC contractor — <?php echo esc_html( alpine_get_setting( 'license_residential', 'TACLB 21462E' ) ); ?> for residential work and <?php echo esc_html( alpine_get_setting( 'license_commercial', 'TACLA146295E' ) ); ?> for commercial — and every job is handled by our own trained technicians, not subcontractors.</p>
          </div>
          <div class="col-lg-6">
            <div class="history-grid">
              <article class="history-photo history-photo-large">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/alpine-team.webp')); ?>" alt="Alpine Heating and Air Conditioning team">
              </article>
              <article class="history-stat">
                <strong>100<span>%</span></strong>
                <span>Customer Satisfaction</span>
              </article>
              <article class="history-stat history-stat-highlight">
                <strong>850<span>+</span></strong>
                <span>Projects Completed</span>
              </article>
              <article class="history-photo history-photo-tall">
                <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/repair-service.webp')); ?>" alt="HVAC technician performing service">
              </article>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-space why-section" id="services">
      <div class="container">
        <div class="text-center mb-5">
          <span class="section-tag why-tag">Top 6 Reasons</span>
          <h2 class="section-title">Why Choose Us</h2>
          <p class="mx-auto section-max why-intro">Homeowners across the Greater Austin area choose Alpine Heating &amp; Air Conditioning for dependable work, honest communication, and long-term comfort solutions.</p>
        </div>

          <div class="row g-3 g-lg-4 why-grid">
            <div class="col-md-6 col-lg-4">
              <article class="why-card">
                <div class="why-copy">
                  <div class="why-card-head">
                    <span class="why-icon" aria-hidden="true"><span class="why-icon-mark"></span></span>
                    <h3 class="h6">Experienced Leadership</h3>
                  </div>
                  <p><b>Alpine Heating &amp; Air Conditioning was built on honest service and practical HVAC solutions.</b> Since 2006, the company has focused on doing what is best for the customer, not pushing work that is not needed. That approach shapes how we diagnose problems, explain options, and deliver service every day.</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4">
              <article class="why-card">
                <div class="why-copy">
                  <div class="why-card-head">
                    <span class="why-icon" aria-hidden="true"><span class="why-icon-mark"></span></span>
                    <h3 class="h6">Honest Recommendations</h3>
                  </div>
                  <p><b>We take the time to explain whether repair, maintenance, or replacement makes the most sense.</b> Customers deserve clear answers, fair pricing, and recommendations based on the condition of the system, the home, and the long-term value of the work.</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4">
              <article class="why-card">
                <div class="why-copy">
                  <div class="why-card-head">
                    <span class="why-icon" aria-hidden="true"><span class="why-icon-mark"></span></span>
                    <h3 class="h6">Skilled Technicians</h3>
                  </div>
                  <p><b>Our technicians are trained to diagnose issues accurately and solve problems the right way.</b> From simple repairs to more complex heating and cooling concerns, we focus on workmanship that protects comfort, safety, and system performance.</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4">
              <article class="why-card">
                <div class="why-copy">
                  <div class="why-card-head">
                    <span class="why-icon" aria-hidden="true"><span class="why-icon-mark"></span></span>
                    <h3 class="h6">Affordable Service</h3>
                  </div>
                  <p><b>Respectful service and fair pricing are a core part of how we work.</b> We know HVAC problems can be stressful, so we aim to make the process easier with dependable communication, practical options, and solutions that fit the situation.</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4">
              <article class="why-card">
                <div class="why-copy">
                  <div class="why-card-head">
                    <span class="why-icon" aria-hidden="true"><span class="why-icon-mark"></span></span>
                    <h3 class="h6">Full-Service Support</h3>
                  </div>
                  <p><b>We help with repairs, installations, replacements, and maintenance plans across the Austin area.</b> That means you can turn to one trusted team whether you need urgent help today or long-term system care through the seasons.</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4">
              <article class="why-card">
                <div class="why-copy">
                  <div class="why-card-head">
                    <span class="why-icon" aria-hidden="true"><span class="why-icon-mark"></span></span>
                    <h3 class="h6">Customer-First Mindset</h3>
                  </div>
                  <p><b>We work hard to earn trust and keep it with every visit.</b> From the first phone call to the final walkthrough, our goal is to provide the kind of HVAC experience homeowners feel confident recommending to friends, family, and neighbors.</p>
                </div>
              </article>
            </div>
          </div>
      </div>
    </section>
  </main>
<?php get_footer(); ?>
