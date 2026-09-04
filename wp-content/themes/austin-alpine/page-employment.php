<?php
/*
Template Name: Employment Page
*/

get_header();

$employment_form_id = function_exists('alpine_get_cf7_form_id_by_title')
    ? alpine_get_cf7_form_id_by_title('Employment Application')
    : 0;
?>

<div class="service-page installation-page employment-page">
  <main>
    <section class="page-hero">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Join Our Team</span>
          <h1>Employment</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Employment'),
          )); ?>
        </div>
        <strong>Air Conditioning and Heating Specialists</strong>
      </div>
      <div class="hero-badge">
        <span>o</span>
      </div>
    </section>

    <section class="section-space">
      <div class="container">
        <div class="service-copy-wrap">
          <div class="service-split employment-intro-grid">
            <div class="employment-intro-copy">
              <span class="section-pill employment-intro-pill">Career Opportunities</span>
              <h2 class="section-title">Employment <span class="highlight">application</span></h2>
              <p class="service-intro">Apply to join Alpine Heating &amp; Air Conditioning using the employment form below. It is designed to collect the key information the team needs to review applicants clearly and respond with next steps.</p>
              <p class="service-intro">Before starting, it helps to have your work history, references, availability, and basic contact details ready. The application also includes education, emergency contact, certification, signature, and reCAPTCHA sections.</p>

              <div class="employment-intro-points">
                <article class="employment-intro-point">
                  <strong>What to prepare</strong>
                  <p>Recent employers, dates worked, references, and the position you want to apply for.</p>
                </article>
                <article class="employment-intro-point">
                  <strong>What is included</strong>
                  <p>Education details, personal information, work history, emergency contact, signature, and certification.</p>
                </article>
              </div>
            </div>

            <div class="employment-intro-visual">
              <article class="service-photo-card employment-photo-primary">
                <img loading="lazy" decoding="async" src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/04/employment-application.avif' ); ?>" alt="HVAC employment application and interview handshake">
              </article>
              <div class="employment-visual-lower">
                <article class="service-photo-card employment-photo-secondary">
                  <img loading="lazy" decoding="async" src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/04/emp-process.avif' ); ?>" alt="Job application review and hiring paperwork">
                </article>
                <aside class="employment-visual-note">
                  <span class="employment-note-kicker">Quick Note</span>
                  <h3>Complete the form in one sitting if possible</h3>
                  <p>Having your job history and references ready will make the application faster and more accurate.</p>
                </aside>
              </div>
            </div>
          </div>

          <div class="service-panel-grid">
            <article class="service-info-panel">
              <span class="section-pill">Apply Today</span>
              <h3>Complete the employment form</h3>
              <p>The application below is organized to capture all of the fields displayed on the live employment page, including repeated education, employment, and reference sections.</p>
              <a href="#employmentForm" class="btn service-cta-btn">Start Application</a>
            </article>
            <article class="service-info-panel service-info-panel-alt">
              <span class="section-pill">Need Help?</span>
              <h3>Questions about the application?</h3>
              <p>If an applicant needs help before submitting, they can call Alpine Heating & Air Conditioning directly for assistance.</p>
              <a href="tel:+15127594247" class="btn service-cta-btn">Call (512) 759-4247</a>
            </article>
          </div>

          <article class="contact-form-card employment-form-card mt-5" id="employmentForm">
            <span class="section-pill">Employment Form</span>
            <h3>Application for employment</h3>
            <p>The application below is now managed through Contact Form 7 so submissions can be handled through the site&apos;s form workflow.</p>
            <?php
            if ($employment_form_id) {
                echo do_shortcode('[contact-form-7 id="' . $employment_form_id . '" title="Employment Application"]');
            } else {
                echo '<p class="captcha-note">Employment form is being prepared. Please check back in a moment.</p>';
            }
            ?>
          </article>

        </div>
      </div>
    </section>

    <section class="service-strip">
      <div class="container">
        <strong>Quality heating &amp; air conditioning solutions</strong>
        <a href="#employmentForm" class="btn service-cta-btn">Apply Now</a>
      </div>
    </section>
  </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var pads = document.querySelectorAll('.employment-signature-pad');

  pads.forEach(function (canvas) {
    var hiddenInput = document.getElementById(canvas.id.replace('_pad', ''));
    var clearButton = document.querySelector('[data-signature-clear="' + canvas.id + '"]');
    var context = canvas.getContext('2d');
    var drawing = false;
    var lastX = 0;
    var lastY = 0;

    function resizeCanvas() {
      var ratio = Math.max(window.devicePixelRatio || 1, 1);
      var rect = canvas.getBoundingClientRect();
      var snapshot = canvas.toDataURL();

      canvas.width = Math.max(rect.width * ratio, 1);
      canvas.height = Math.max(rect.height * ratio, 1);
      context.setTransform(1, 0, 0, 1, 0, 0);
      context.scale(ratio, ratio);
      context.lineCap = 'round';
      context.lineJoin = 'round';
      context.lineWidth = 2.2;
      context.strokeStyle = '#12315f';

      if (snapshot && snapshot !== 'data:,') {
        var image = new Image();
        image.onload = function () {
          context.drawImage(image, 0, 0, rect.width, rect.height);
        };
        image.src = snapshot;
      }
    }

    function getPoint(event) {
      var rect = canvas.getBoundingClientRect();
      return {
        x: event.clientX - rect.left,
        y: event.clientY - rect.top
      };
    }

    function startDrawing(event) {
      drawing = true;
      var point = getPoint(event);
      lastX = point.x;
      lastY = point.y;
    }

    function draw(event) {
      if (!drawing) {
        return;
      }

      event.preventDefault();
      var point = getPoint(event);
      context.beginPath();
      context.moveTo(lastX, lastY);
      context.lineTo(point.x, point.y);
      context.stroke();
      lastX = point.x;
      lastY = point.y;

      if (hiddenInput) {
        hiddenInput.value = canvas.toDataURL('image/png');
      }
    }

    function stopDrawing() {
      if (!drawing) {
        return;
      }

      drawing = false;

      if (hiddenInput) {
        hiddenInput.value = canvas.toDataURL('image/png');
      }
    }

    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);
    canvas.addEventListener('pointerdown', startDrawing);
    canvas.addEventListener('pointermove', draw);
    canvas.addEventListener('pointerup', stopDrawing);
    canvas.addEventListener('pointerleave', stopDrawing);

    if (clearButton) {
      clearButton.addEventListener('click', function () {
        var rect = canvas.getBoundingClientRect();
        context.clearRect(0, 0, rect.width, rect.height);
        if (hiddenInput) {
          hiddenInput.value = '';
        }
      });
    }
  });
});
</script>

<?php get_footer(); ?>
