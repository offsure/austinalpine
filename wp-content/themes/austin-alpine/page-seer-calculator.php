<?php
/*
Template Name: SEER Calculator
*/

get_header();
?>
<main class="service-page installation-page seer-calculator-page">
  <section class="page-hero">
    <div class="container hero-content">
      <div>
        <span class="hero-chip">Energy Efficiency</span>
        <h1>SEER Calculator</h1>
        <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'Resources', 'url' => alpine_get_site_page_url('resources')),
            array('label' => 'SEER Calculator'),
          )); ?>
      </div>
      <strong>Estimate cooling efficiency and potential savings</strong>
    </div>
    <div class="hero-badge">
      <span>o</span>
    </div>
  </section>
</header>

  <section class="section-space">
    <div class="container">
      <div class="service-copy-wrap">
        <div class="service-split">
          <div>
            <h2 class="section-title">Estimate how much your AC may <span class="highlight">cost to run</span> in the summer</h2>
            <p class="service-intro">SEER stands for Seasonal Energy Efficiency Ratio. In simple terms, the higher the SEER rating, the more efficiently your air conditioner or heat pump can deliver cooling over the season.</p>
            <p class="service-intro">Use this calculator to estimate summer electricity usage and operating cost based on your system size, SEER rating, and local power rate.</p>
          </div>

          <div class="service-visual-grid">
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/home-slider-2.webp')); ?>" alt="High-efficiency air conditioning system">
            </article>
            <article class="service-photo-card">
              <img loading="lazy" decoding="async" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/installation-service.webp')); ?>" alt="HVAC technician discussing system efficiency">
            </article>
          </div>
        </div>

        <div class="seer-calc-layout mt-5">
          <section class="seer-calc-card">
            <div class="seer-calc-card-glow" aria-hidden="true"></div>
            <div class="seer-calc-card-head">
              <span class="section-pill">Calculator</span>
              <h3>Estimate your AC cost to run during the summer</h3>
              <p>Enter your system size, current SEER rating, and electricity rate. This calculator uses an estimated 1,200 summer cooling hours to project total seasonal operating cost.</p>
            </div>

            <form class="seer-calc-form" id="seerCalculatorForm">
              <div class="seer-calc-grid">
                <label class="seer-field">
                  <span>What is the size of your system? (in tons)</span>
                  <input type="number" id="systemSize" min="1" step="0.5" value="3" inputmode="decimal">
                  <small>Most homes fall between 2 and 5 tons.</small>
                </label>

                <label class="seer-field">
                  <span>What is the SEER rating of your system?</span>
                  <input type="number" id="seerRating" min="8" step="1" value="14" inputmode="decimal">
                  <small>Higher SEER usually means lower seasonal energy use.</small>
                </label>

                <label class="seer-field">
                  <span>kWh rate (default .25, but you can change it)</span>
                  <input type="number" id="electricRate" min="0.01" step="0.01" value="0.25" inputmode="decimal">
                  <small>Use your utility bill rate for a closer estimate.</small>
                </label>
              </div>

              <div class="seer-calc-actions">
                <button type="submit" class="btn service-cta-btn">Calculate Summer Cost</button>
                <button type="button" class="btn service-ghost-btn" id="seerResetBtn">Reset</button>
              </div>
            </form>
          </section>

          <aside class="seer-results-card" id="seerResults" aria-live="polite">
            <div class="seer-results-card-glow" aria-hidden="true"></div>
            <span class="section-pill">Results</span>
            <h3>Your estimated summer AC operating cost</h3>
            <p class="seer-results-intro">This estimate uses a 1,200-hour summer cooling season and your electricity rate to show roughly what it may cost to run your AC.</p>

            <article class="seer-result-hero">
              <div>
                <small>Cost to Run AC Per Summer</small>
                <strong id="summerCost">$772</strong>
              </div>
              <span class="seer-result-hero-badge">1,200 cooling hours</span>
            </article>

            <div class="seer-results-grid">
              <article class="seer-result-box">
                <small>Estimated Energy Use</small>
                <strong id="summerKwh">3,086 kWh</strong>
              </article>
              <article class="seer-result-box">
                <small>Average Cost Per Hour</small>
                <strong id="hourlyCost">$0.64</strong>
              </article>
            </div>

            <div class="seer-results-summary">
              <div class="seer-summary-row">
                <span>System size</span>
                <strong id="summarySystemSize">3 tons</strong>
              </div>
              <div class="seer-summary-row">
                <span>SEER rating</span>
                <strong id="summarySeerRating">14</strong>
              </div>
              <div class="seer-summary-row">
                <span>Electricity rate</span>
                <strong id="summaryElectricRate">$0.25/kWh</strong>
              </div>
            </div>

          </aside>
        </div>

        <div class="service-feature-grid mt-5">
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Useful for replacements</h3>
              <p>Compare older equipment against a newer high-efficiency system before deciding whether replacement is worth the investment.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Built for real-world estimates</h3>
              <p>This tool estimates summer energy use based on system size, SEER rating, electricity cost, and a built-in seasonal cooling-hours assumption.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Helpful before requesting quotes</h3>
              <p>Use these results as a starting point when you are comparing AC installation, AC replacement, or heat pump upgrade options.</p>
            </div>
          </article>
          <article class="service-feature">
            <span class="service-feature-icon">✓</span>
            <div>
              <h3>Not a substitute for load calculations</h3>
              <p>Actual efficiency and operating costs vary by insulation, thermostat settings, duct performance, climate, and equipment condition.</p>
            </div>
          </article>
        </div>

        <div class="service-panel-grid mt-5">
          <article class="service-info-panel">
            <span class="section-pill">Need Advice?</span>
            <h3>Talk through your efficiency upgrade options</h3>
            <p>If you are comparing repair versus replacement, or trying to understand whether a higher-efficiency system makes sense for your home, Alpine Heating & Air Conditioning can help.</p>
            <a href="<?php echo esc_url(alpine_get_site_page_url('estimate')); ?>" class="btn service-cta-btn">Request Estimate</a>
          </article>
          <article class="service-info-panel service-info-panel-alt">
            <span class="section-pill">Related Services</span>
            <h3>Explore installations, replacements, and financing</h3>
            <p>Higher SEER equipment is often part of a larger comfort upgrade. You can also review AC installation, AC replacement, and financing options before making a decision.</p>
            <a href="<?php echo esc_url(alpine_get_site_page_url('air_conditioning')); ?>" class="btn service-cta-btn">View AC Services</a>
          </article>
        </div>

      </div>
    </div>
  </section>

  <section class="service-strip">
    <div class="container">
      <strong>Make your next HVAC upgrade with clearer efficiency numbers</strong>
      <a href="<?php echo esc_url(alpine_get_site_page_url('contact')); ?>" class="btn service-cta-btn">Schedule Appointment</a>
    </div>
  </section>
</main>

<script>
  (function () {
    const form = document.getElementById('seerCalculatorForm');
    const resetBtn = document.getElementById('seerResetBtn');

    if (!form || !resetBtn) {
      return;
    }

    const fields = {
      systemSize: document.getElementById('systemSize'),
      seerRating: document.getElementById('seerRating'),
      electricRate: document.getElementById('electricRate')
    };

    const outputs = {
      summerCost: document.getElementById('summerCost'),
      summerKwh: document.getElementById('summerKwh'),
      hourlyCost: document.getElementById('hourlyCost'),
      summarySystemSize: document.getElementById('summarySystemSize'),
      summarySeerRating: document.getElementById('summarySeerRating'),
      summaryElectricRate: document.getElementById('summaryElectricRate')
    };

    const SUMMER_COOLING_HOURS = 1200;

    function toNumber(input) {
      return Number.parseFloat(input.value || '0');
    }

    function formatCurrency(value) {
      return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        maximumFractionDigits: 0
      }).format(value);
    }

    function formatKwh(value) {
      return new Intl.NumberFormat('en-US', {
        maximumFractionDigits: 0
      }).format(value) + ' kWh';
    }

    function formatHourlyCurrency(value) {
      return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }).format(value);
    }

    function calculate(event) {
      if (event) {
        event.preventDefault();
      }

      const systemSize = Math.max(toNumber(fields.systemSize), 0);
      const seerRating = Math.max(toNumber(fields.seerRating), 1);
      const electricRate = Math.max(toNumber(fields.electricRate), 0);

      const btuPerHour = systemSize * 12000;
      const hourlyKwh = btuPerHour / (seerRating * 1000);
      const summerKwh = hourlyKwh * SUMMER_COOLING_HOURS;
      const summerCost = summerKwh * electricRate;

      outputs.summerCost.textContent = formatCurrency(summerCost);
      outputs.summerKwh.textContent = formatKwh(summerKwh);
      outputs.hourlyCost.textContent = formatHourlyCurrency(hourlyKwh * electricRate);
      outputs.summarySystemSize.textContent = `${systemSize} tons`;
      outputs.summarySeerRating.textContent = `${seerRating}`;
      outputs.summaryElectricRate.textContent = `${formatHourlyCurrency(electricRate)}/kWh`;
    }

    form.addEventListener('submit', calculate);
    Object.values(fields).forEach((field) => {
      field.addEventListener('input', calculate);
    });

    resetBtn.addEventListener('click', () => {
      fields.systemSize.value = '3';
      fields.seerRating.value = '14';
      fields.electricRate.value = '0.25';
      calculate();
    });

    calculate();
  }());
</script>

<?php get_footer(); ?>
