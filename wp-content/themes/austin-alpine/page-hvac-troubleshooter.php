<?php
/*
Template Name: HVAC Troubleshooter
*/

get_header();

$request_service_url = function_exists('alpine_get_site_page_url') ? alpine_get_site_page_url('contact') : home_url('/contact-us/');
$estimate_url = function_exists('alpine_get_site_page_url') ? alpine_get_site_page_url('estimate') : home_url('/request-an-estimate/');
?>

<div class="service-page installation-page troubleshooter-page">
  <main>
    <section class="page-hero">
      <div class="container hero-content">
        <div>
          <span class="hero-chip">Diagnostic Guide</span>
          <h1>HVAC Troubleshooter</h1>
          <?php alpine_breadcrumb_nav(array(
            array('label' => 'Home', 'url' => home_url('/')),
            array('label' => 'HVAC Troubleshooter'),
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
          <div class="service-split troubleshooter-intro-grid">
            <div class="troubleshooter-intro-copy">
              <span class="section-pill">Start Here</span>
              <h2 class="section-title">Walk through common HVAC <span class="highlight">warning signs</span></h2>
              <p class="service-intro">Use this page to sort through common heating and cooling problems before booking service. It is built for straightforward homeowner checks that can help rule out a setting issue, airflow restriction, or power interruption.</p>
              <p class="service-intro">You can work through thermostat settings, dirty filters, breaker resets, airflow questions, ice on the outdoor unit, and odor-related clues. If a path points to safety concerns or mechanical trouble, shut the system down and reach out for professional service.</p>

              <div class="troubleshooter-highlight-list">
                <div class="troubleshooter-highlight-item">
                  <strong>Best for simple checks</strong>
                  <span>Thermostat settings, filters, breakers, airflow changes, outdoor unit activity, and common smell clues.</span>
                </div>
                <div class="troubleshooter-highlight-item">
                  <strong>Know when to call</strong>
                  <span>Gas odors, repeated breaker trips, loud noises, and frozen equipment should be handled by a trained technician.</span>
                </div>
              </div>
            </div>

            <div class="troubleshooter-intro-visual">
              <article class="service-photo-card">
                <img loading="lazy" decoding="async" src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/heating-repair.jpg' ); ?>" alt="HVAC technician helping homeowner troubleshoot a system issue">
              </article>
              <div class="troubleshooter-visual-note">
                <span class="troubleshooter-note-kicker">Quick Tip</span>
                <h3>Start with the easiest fix before assuming the worst</h3>
                <p>Many comfort issues begin with something small, but persistent performance or safety concerns still deserve expert attention.</p>
              </div>
            </div>
          </div>

          <div class="troubleshooter-layout mt-5">
            <section class="troubleshooter-card" id="hvacTroubleshooterApp">
              <div class="troubleshooter-card-head">
                <div>
                  <span class="section-pill">Interactive Guide</span>
                  <h3 id="troubleshooterTitle">What type of problem are you having?</h3>
                </div>
                <span class="troubleshooter-step" id="troubleshooterStep">Step 1</span>
              </div>

              <div class="troubleshooter-progress" aria-hidden="true">
                <span id="troubleshooterProgressBar"></span>
              </div>

              <div class="troubleshooter-card-body">
                <p class="troubleshooter-description" id="troubleshooterDescription">Choose the system you want to troubleshoot first.</p>
                <ul class="troubleshooter-bullets" id="troubleshooterBullets" hidden></ul>
                <p class="troubleshooter-note" id="troubleshooterNote" hidden></p>
              </div>

              <div class="troubleshooter-choices" id="troubleshooterChoices"></div>

              <div class="troubleshooter-actions">
                <button type="button" class="btn service-ghost-btn" id="troubleshooterBackBtn" disabled>Back</button>
                <button type="button" class="btn service-ghost-btn" id="troubleshooterResetBtn">Start Over</button>
              </div>
            </section>

            <aside class="troubleshooter-sidebar">
              <article class="service-info-panel">
                <span class="section-pill">Need Service?</span>
                <h3>Get help from the Alpine team</h3>
                <p>If the issue does not clear up with the troubleshooting steps, request service and let a technician inspect the system properly.</p>
                <a href="<?php echo esc_url($request_service_url); ?>" class="btn service-cta-btn">Request Service</a>
              </article>

              <article class="service-info-panel service-info-panel-alt">
                <span class="section-pill">Urgent HVAC Signs</span>
                <h3>Call for service if you notice any of these</h3>
                <ul class="troubleshooter-sidebar-list">
                  <li>Burning or electrical smells from the system</li>
                  <li>Gas-like odors near the furnace or heater</li>
                  <li>Ice on the outdoor unit or refrigerant lines</li>
                  <li>No heating or cooling during extreme temperatures</li>
                </ul>
                <a href="tel:+15127594247" class="btn service-cta-btn">Call for HVAC Service</a>
              </article>
            </aside>
          </div>

          <div class="service-feature-grid mt-5">
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Cooling Problems</h3>
                <p>Review common AC issues such as no cooling, weak airflow, frozen equipment, or a unit that will not turn on.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Heating Trouble</h3>
                <p>Follow separate troubleshooting paths for furnaces and heat pumps, including airflow, temperature, and outdoor unit checks.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Noise &amp; Odor Clues</h3>
                <p>Use sound and smell symptoms as a guide to decide whether the issue looks routine, maintenance-related, or urgent.</p>
              </div>
            </article>
            <article class="service-feature">
              <span class="service-feature-icon">✓</span>
              <div>
                <h3>Practical Next Steps</h3>
                <p>Each result is designed to point you toward a safe next move, whether that is a quick homeowner fix or a service call.</p>
              </div>
            </article>
          </div>

          <div class="service-panel-grid mt-5">
            <article class="service-info-panel">
              <span class="section-pill">Repair Support</span>
              <h3>Still dealing with the same issue?</h3>
              <p>If the problem remains after the checks above, schedule service so the system can be diagnosed in person.</p>
              <a href="<?php echo esc_url($request_service_url); ?>" class="btn service-cta-btn">Request Service</a>
            </article>
            <article class="service-info-panel service-info-panel-alt">
              <span class="section-pill">Project Planning</span>
              <h3>Need pricing for a larger solution?</h3>
              <p>If the issue points to repair versus replacement decisions, use the estimate page to ask about next-step options.</p>
              <a href="<?php echo esc_url($estimate_url); ?>" class="btn service-cta-btn">Request Estimate</a>
            </article>
          </div>
        </div>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
  var app = document.getElementById('hvacTroubleshooterApp');

  if (!app) {
    return;
  }

  var titleEl = document.getElementById('troubleshooterTitle');
  var stepEl = document.getElementById('troubleshooterStep');
  var progressEl = document.getElementById('troubleshooterProgressBar');
  var descriptionEl = document.getElementById('troubleshooterDescription');
  var bulletsEl = document.getElementById('troubleshooterBullets');
  var noteEl = document.getElementById('troubleshooterNote');
  var choicesEl = document.getElementById('troubleshooterChoices');
  var backBtn = document.getElementById('troubleshooterBackBtn');
  var resetBtn = document.getElementById('troubleshooterResetBtn');

  var requestServiceUrl = <?php echo wp_json_encode(esc_url($request_service_url)); ?>;
  var estimateUrl = <?php echo wp_json_encode(esc_url($estimate_url)); ?>;
  var callUrl = 'tel:+15127594247';

  var nodes = {
    start: {
      title: 'What type of problem are you having?',
      description: 'Pick the equipment you want to check first so the guide can point you in the right direction.',
      choices: [
        { label: 'Air Conditioning', next: 'ac_problem' },
        { label: 'Heating', next: 'heat_problem' }
      ]
    },
    ac_problem: {
      title: 'What type of air conditioner problem are you having?',
      description: 'Choose the option that best matches the cooling issue you are noticing.',
      choices: [
        { label: 'My AC is not working', next: 'ac_thermostat' },
        { label: 'My AC is making a strange noise', next: 'ac_noise' }
      ]
    },
    ac_thermostat: {
      title: 'Check your thermostat first',
      description: 'A thermostat setting issue is one of the quickest things to rule out when the AC is not cooling.',
      bullets: [
        'Make sure the thermostat is turned on.',
        'Set the thermostat a few degrees below the room temperature.',
        'Confirm it is set to Cool, not Fan or Heat.',
        'If the screen is blank, replace the battery if your thermostat uses one.'
      ],
      note: 'Did that solve your problem?',
      choices: [
        { label: 'Yes', next: 'resolved' },
        { label: 'No', next: 'ac_filter' }
      ]
    },
    ac_filter: {
      title: 'Your air filter may be dirty',
      description: 'A clogged filter can choke airflow and make the system struggle to cool the home.',
      bullets: [
        'Check the filter and replace it if it looks visibly dirty.',
        'Make sure the replacement filter is the correct size and airflow rating.'
      ],
      note: 'Did that solve your problem?',
      choices: [
        { label: 'Yes', next: 'resolved' },
        { label: 'No', next: 'ac_outdoor_running' }
      ]
    },
    ac_outdoor_running: {
      title: 'Is your outdoor unit running?',
      description: 'Check outside to see whether the condenser is turning on and running normally.',
      choices: [
        { label: 'Yes', next: 'ac_vents_air' },
        { label: 'No', next: 'ac_breaker' }
      ]
    },
    ac_breaker: {
      title: 'Your AC circuit breaker may have tripped',
      description: 'If the outdoor unit has no power, a tripped breaker may be the cause.',
      bullets: [
        'Find your breaker box and locate the circuit labeled air conditioner or condenser.',
        'Flip the breaker fully to Off and then back to On.',
        'Wait a couple of minutes to see whether the system restarts.'
      ],
      note: 'Did that solve your problem?',
      choices: [
        { label: 'Yes', next: 'resolved' },
        { label: 'No', next: 'expert_care' }
      ]
    },
    ac_vents_air: {
      title: 'Is there air coming out of your vents?',
      description: 'This helps narrow the problem to either airflow or cooling performance.',
      choices: [
        { label: 'Yes', next: 'ac_ice' },
        { label: 'No', next: 'expert_care' }
      ]
    },
    ac_ice: {
      title: 'Is there ice on your outdoor unit?',
      description: 'Ice buildup usually means the system is dealing with an airflow or operating problem.',
      choices: [
        { label: 'Yes', next: 'frozen_system' },
        { label: 'No', next: 'expert_care' }
      ]
    },
    ac_noise: {
      title: 'Strange AC noises usually need service',
      description: 'Buzzing, banging, rattling, screeching, or grinding noises usually point to a part that needs inspection.',
      bullets: [
        'Turn the system off if the noise is loud or sudden.',
        'Avoid continuing to run the unit until it is inspected.'
      ],
      choices: [
        { label: 'Request Service', url: requestServiceUrl, style: 'primary' },
        { label: 'Call Now', url: callUrl, style: 'secondary' }
      ],
      outcome: 'warning'
    },
    heat_problem: {
      title: 'What type of heating problem are you having?',
      description: 'Select the heating symptom that most closely matches what your system is doing.',
      choices: [
        { label: "My heater isn't working", next: 'heat_type' },
        { label: 'My heater is making a strange noise', next: 'heat_noise_location' },
        { label: 'There is a strange smell when my heater runs', next: 'heat_smell' }
      ]
    },
    heat_type: {
      title: 'What type of heater do you have?',
      description: 'Choose your heating system so the guide can show the most relevant next steps.',
      choices: [
        { label: 'Gas Furnace', next: 'gas_heat_problem' },
        { label: 'Heat Pump', next: 'heat_pump_thermostat' }
      ]
    },
    gas_heat_problem: {
      title: 'What best describes your heating problem?',
      description: 'Pick the answer that best matches the way your furnace is acting.',
      choices: [
        { label: 'No air is coming out of the vents', next: 'furnace_power' },
        { label: 'Air is coming out, but it is not warm', next: 'expert_care' }
      ]
    },
    furnace_power: {
      title: 'Make sure power is getting to the furnace',
      description: 'If the furnace is not blowing air, confirm it is still getting electrical power.',
      bullets: [
        'Check your electrical panel and reset the furnace breaker if needed.',
        'Look for a nearby switch that looks like a light switch and confirm it is set to On.'
      ],
      note: 'Did that solve your problem?',
      choices: [
        { label: 'Yes', next: 'resolved' },
        { label: 'No', next: 'expert_care' }
      ]
    },
    heat_pump_thermostat: {
      title: 'Check your thermostat settings',
      description: 'Heat pump issues can sometimes come down to mode, setpoint, or thermostat power.',
      bullets: [
        'Make sure the thermostat is turned on.',
        'Set the temperature a few degrees above room temperature.',
        'Confirm it is set to Heat, not Cool or Fan.',
        'Replace the battery if the screen is blank and the thermostat uses batteries.'
      ],
      note: 'Did that solve your problem?',
      choices: [
        { label: 'Yes', next: 'resolved' },
        { label: 'No', next: 'heat_pump_problem' }
      ]
    },
    heat_pump_problem: {
      title: 'What best describes your heat pump issue?',
      description: 'Choose the answer that best fits the way the heat pump is behaving.',
      choices: [
        { label: 'No air is coming out of the vents', next: 'heat_pump_outdoor_running' },
        { label: 'Air is coming out, but it is not warm', next: 'heat_pump_ice' }
      ]
    },
    heat_pump_outdoor_running: {
      title: 'Is your outdoor unit running?',
      description: 'If the outdoor section is not running, the problem may be tied to power or controls.',
      choices: [
        { label: 'Yes', next: 'heat_pump_ice' },
        { label: 'No', next: 'heat_pump_breaker' }
      ]
    },
    heat_pump_breaker: {
      title: 'Your heat pump circuit breaker may have tripped',
      description: 'If power was interrupted, resetting the breaker may restore operation.',
      bullets: [
        'Find the breaker labeled heat pump or air conditioner.',
        'Flip it fully Off and then back On.',
        'Give the unit a couple of minutes to restart.'
      ],
      note: 'Did that solve your problem?',
      choices: [
        { label: 'Yes', next: 'resolved' },
        { label: 'No', next: 'expert_care' }
      ]
    },
    heat_pump_ice: {
      title: 'Is there ice on your outdoor unit?',
      description: 'Ice on the unit is a strong sign the system needs attention beyond a simple setting adjustment.',
      choices: [
        { label: 'Yes', next: 'frozen_system' },
        { label: 'No', next: 'expert_care' }
      ]
    },
    heat_noise_location: {
      title: 'Is the noise coming from the inside or outside unit?',
      description: 'The location of the noise can help separate normal operation from a service issue.',
      choices: [
        { label: 'Inside Unit', next: 'expert_care' },
        { label: 'Outside Unit', next: 'heat_noise_steam' }
      ]
    },
    heat_noise_steam: {
      title: 'Is there steam coming from the unit as well?',
      description: 'Some heat pump behavior can look dramatic from outside even when it is operating normally.',
      choices: [
        { label: 'Yes', next: 'normal_defrost' },
        { label: 'No', next: 'expert_care' }
      ]
    },
    heat_smell: {
      title: 'What type of smell are you noticing?',
      description: 'Pick the odor that best matches what you notice when the heater runs.',
      choices: [
        { label: 'Burning smell', next: 'burning_first_use' },
        { label: 'Gas or rotten egg smell', next: 'gas_warning' },
        { label: 'Moldy smell', next: 'maintenance_needed' },
        { label: 'Other smell', next: 'expert_care' }
      ]
    },
    burning_first_use: {
      title: 'Did you just turn your heater on for the first time this winter?',
      description: 'A dusty or lightly burning smell can happen on first startup after a long break.',
      choices: [
        { label: 'Yes', next: 'normal_first_heat' },
        { label: 'No', next: 'expert_care' }
      ]
    },
    resolved: {
      title: 'That is a good sign.',
      description: 'It looks like the issue may have been resolved. If the problem returns, Alpine Heating & Air Conditioning is here to help.',
      choices: [
        { label: 'Troubleshoot Another Issue', next: 'start', style: 'primary' },
        { label: 'Request Service', url: requestServiceUrl, style: 'secondary' }
      ],
      outcome: 'success'
    },
    expert_care: {
      title: 'This issue should be checked by a technician.',
      description: 'Turn the system off and arrange service. Continued operation could make the problem worse or create a safety concern.',
      choices: [
        { label: 'Request Service', url: requestServiceUrl, style: 'primary' },
        { label: 'Call (512) 759-4247', url: callUrl, style: 'secondary' }
      ],
      outcome: 'warning'
    },
    frozen_system: {
      title: 'Turn the system off and schedule service.',
      description: 'Ice on the unit usually means something in the system is not operating correctly and should be inspected.',
      choices: [
        { label: 'Request Service', url: requestServiceUrl, style: 'primary' },
        { label: 'Back to Start', next: 'start', style: 'secondary' }
      ],
      outcome: 'warning'
    },
    normal_defrost: {
      title: 'This may be normal defrost operation.',
      description: 'Steam from the outdoor unit in heating mode can be normal while the heat pump clears frost.',
      bullets: [
        'This usually lasts only a short time.',
        'If the behavior seems constant or performance is poor, request service.'
      ],
      choices: [
        { label: 'Troubleshoot Another Issue', next: 'start', style: 'primary' },
        { label: 'Request Service', url: requestServiceUrl, style: 'secondary' }
      ],
      outcome: 'info'
    },
    normal_first_heat: {
      title: 'This may be a normal first-use smell.',
      description: 'A dusty or slightly burning smell is common when the heater runs for the first time after sitting unused. It should fade after a short time.',
      choices: [
        { label: 'Troubleshoot Another Issue', next: 'start', style: 'primary' },
        { label: 'Request Service If It Persists', url: requestServiceUrl, style: 'secondary' }
      ],
      outcome: 'info'
    },
    gas_warning: {
      title: 'Turn off your furnace now.',
      description: 'A rotten egg or gas smell may signal a dangerous leak. Shut the system down and contact a qualified professional right away.',
      choices: [
        { label: 'Call Now', url: callUrl, style: 'primary' },
        { label: 'Request Service', url: requestServiceUrl, style: 'secondary' }
      ],
      outcome: 'danger'
    },
    maintenance_needed: {
      title: 'This may point to a maintenance issue.',
      description: 'A moldy or dirty-sock smell is often linked to buildup in the system and a need for cleaning or maintenance.',
      choices: [
        { label: 'Request Service', url: requestServiceUrl, style: 'primary' },
        { label: 'Request Estimate', url: estimateUrl, style: 'secondary' }
      ],
      outcome: 'info'
    }
  };

  var history = [];
  var currentNodeId = 'start';

  function renderChoice(choice) {
    var element;

    if (choice.url) {
      element = document.createElement('a');
      element.href = choice.url;
    } else {
      element = document.createElement('button');
      element.type = 'button';
      element.addEventListener('click', function () {
        history.push(currentNodeId);
        currentNodeId = choice.next;
        render();
      });
    }

    element.className = 'troubleshooter-choice troubleshooter-choice-' + (choice.style || 'default');
    element.textContent = choice.label;
    return element;
  }

  function render() {
    var node = nodes[currentNodeId];
    var progressWidth = Math.min(((history.length + 1) / 7) * 100, 100);

    titleEl.textContent = node.title;
    stepEl.textContent = 'Step ' + (history.length + 1);
    progressEl.style.width = progressWidth + '%';
    descriptionEl.textContent = node.description || '';

    bulletsEl.innerHTML = '';
    if (node.bullets && node.bullets.length) {
      bulletsEl.hidden = false;
      node.bullets.forEach(function (bullet) {
        var li = document.createElement('li');
        li.textContent = bullet;
        bulletsEl.appendChild(li);
      });
    } else {
      bulletsEl.hidden = true;
    }

    if (node.note) {
      noteEl.hidden = false;
      noteEl.textContent = node.note;
    } else {
      noteEl.hidden = true;
      noteEl.textContent = '';
    }

    choicesEl.innerHTML = '';
    if (node.outcome) {
      app.setAttribute('data-outcome', node.outcome);
    } else {
      app.setAttribute('data-outcome', 'default');
    }

    node.choices.forEach(function (choice) {
      choicesEl.appendChild(renderChoice(choice));
    });

    backBtn.disabled = history.length === 0;
  }

  backBtn.addEventListener('click', function () {
    if (!history.length) {
      return;
    }

    currentNodeId = history.pop();
    render();
  });

  resetBtn.addEventListener('click', function () {
    history = [];
    currentNodeId = 'start';
    render();
  });

  render();
});
</script>

<?php get_footer(); ?>
