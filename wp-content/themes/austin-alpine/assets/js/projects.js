/**
 * Projects archive filter.
 *
 * The filter pills are real links to the Residential / Commercial archives, so
 * the section works with JavaScript switched off. This upgrades them to filter
 * the sections already on the page — no reload, no lost scroll position — and
 * keeps the address bar in sync so a filtered view stays shareable and the back
 * button behaves.
 */
(function () {
  'use strict';

  var filter = document.querySelector('[data-project-filter]');

  if (!filter) {
    return;
  }

  var pills = Array.prototype.slice.call(filter.querySelectorAll('[data-project-filter-value]'));
  var sections = Array.prototype.slice.call(document.querySelectorAll('[data-project-section]'));

  // Nothing to filter between — leave the pills as plain links.
  if (pills.length < 2 || sections.length < 2) {
    return;
  }

  function apply(value) {
    sections.forEach(function (section) {
      var matches = value === 'all' || section.getAttribute('data-project-section') === value;
      section.hidden = !matches;
    });

    pills.forEach(function (pill) {
      var active = pill.getAttribute('data-project-filter-value') === value;
      pill.classList.toggle('is-active', active);

      if (active) {
        pill.setAttribute('aria-current', 'page');
      } else {
        pill.removeAttribute('aria-current');
      }
    });
  }

  function valueFromLocation() {
    var match = window.location.hash.match(/^#(residential|commercial)$/);
    return match ? match[1] : 'all';
  }

  pills.forEach(function (pill) {
    pill.addEventListener('click', function (event) {
      // Let modified clicks open in a new tab as the plain link would.
      if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button !== 0) {
        return;
      }

      var value = pill.getAttribute('data-project-filter-value');
      event.preventDefault();
      apply(value);

      var hash = value === 'all' ? window.location.pathname + window.location.search : '#' + value;
      window.history.replaceState(null, '', hash);
    });
  });

  window.addEventListener('hashchange', function () {
    apply(valueFromLocation());
  });

  apply(valueFromLocation());
})();
