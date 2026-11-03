document.querySelectorAll('.tc-insurance-calculator').forEach(function (panel) {
  panel.addEventListener('toggle', function () {
    if (panel.open) {
      document.querySelectorAll('.tc-insurance-calculator').forEach(function (other) {
        if (other !== panel) other.open = false;
      });
      window.setTimeout(function () { window.dispatchEvent(new Event('resize')); }, 80);

      var scriptUrl = panel.getAttribute('data-widget-script');
      if (scriptUrl && !panel.getAttribute('data-widget-loaded')) {
        panel.setAttribute('data-widget-loaded', 'true');
        var loading = panel.querySelector('.tc-widget-loading');
        if (loading) loading.hidden = false;
        var script = document.createElement('script');
        script.src = scriptUrl;
        script.async = true;
        script.onload = function () {
          if (loading) loading.hidden = true;
          window.setTimeout(function () { window.dispatchEvent(new Event('resize')); }, 120);
        };
        script.onerror = function () {
          if (loading) loading.textContent = 'Der Vergleich konnte nicht geladen werden. Bitte versuche es erneut.';
        };
        document.body.appendChild(script);
      }
    }
  });
});

function openInsuranceCalculatorFromHash() {
  if (!window.location.hash) return;
  var panel = document.querySelector(window.location.hash);
  if (!panel || !panel.classList.contains('tc-insurance-calculator')) return;
  panel.open = true;
  window.setTimeout(function () {
    panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }, 120);
}

openInsuranceCalculatorFromHash();
window.addEventListener('hashchange', openInsuranceCalculatorFromHash);
