(function () {
 'use strict';
 // Existing Google Ads event measures a page visit, not a CHECK24 sale.
 if (!/^\/(strom|gas)\/?$/.test(window.location.pathname) || window.tcEnergyVisitReported) return;
 window.dataLayer = window.dataLayer || [];
 window.gtag = window.gtag || function () { window.dataLayer.push(arguments); };
 window.gtag('event', 'conversion', {
  send_to: 'AW-18459825983/GDSqCI6R764dEL-uquJE',
  value: 1.0,
  currency: 'USD'
 });
 window.tcEnergyVisitReported = true;
})();
