const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const vm = require('node:vm');
const source = fs.readFileSync(path.join(__dirname, '../../assets/js/header.js'), 'utf8');

function createPage({ mobile = true, query = '', dataMenu = false } = {}) {
  const document = { activeElement: null, listeners: {}, addEventListener(type, callback) { this.listeners[type] = callback; } };
  function element(extra = {}) {
    return {
      hidden: false, attributes: {}, listeners: {},
      setAttribute(name, value) { this.attributes[name] = value; },
      addEventListener(type, callback) { this.listeners[type] = callback; },
      focus() { document.activeElement = this; },
      ...extra,
    };
  }
  const input = element({ value: query });
  const toggle = element({ hidden: true });
  const form = element({ querySelector: () => input });
  const dataToggle = element();
  const dataPanel = element({ hidden: true });
  dataToggle.contains = target => target === dataToggle;
  dataPanel.contains = target => target === dataPanel;
  const header = element({
    classList: new Set(),
    querySelector(selector) {
      if (selector === '.tc-search-toggle') return toggle;
      if (selector === '#tc-header-search') return form;
      if (dataMenu && selector === '[data-tc-data-toggle]') return dataToggle;
      if (dataMenu && selector === '#tc-header-data-menu') return dataPanel;
      return null;
    },
  });
  const breakpoint = element({ matches: mobile });
  document.querySelector = selector => selector === '[data-tc-header]' ? header : null;
  vm.runInNewContext(source, { document, window: { matchMedia: () => breakpoint } });
  return { document, input, toggle, form, breakpoint, header, dataToggle, dataPanel };
}

const page = createPage();
assert.equal(page.toggle.hidden, false, 'Mobile search control is available');
assert.equal(page.form.hidden, true, 'Blank mobile search starts collapsed');
page.toggle.listeners.click();
assert.equal(page.form.hidden, false);
assert.equal(page.toggle.attributes['aria-expanded'], 'true');
assert.equal(page.document.activeElement, page.input, 'Opening search focuses the field');
let prevented = false;
page.form.listeners.keydown({ key: 'Escape', preventDefault() { prevented = true; } });
assert.ok(prevented);
assert.equal(page.form.hidden, true);
assert.equal(page.document.activeElement, page.toggle, 'Escape returns focus to the control');
const existingQuery = createPage({ query: 'gas' });
assert.equal(existingQuery.form.hidden, false, 'An existing query stays visible on mobile');
const desktop = createPage({ mobile: false });
assert.equal(desktop.form.hidden, true, 'Desktop search starts collapsed too');
assert.equal(desktop.toggle.hidden, false, 'Desktop search icon remains available');
desktop.toggle.listeners.click();
assert.equal(desktop.form.hidden, false, 'Desktop search opens on click');
assert.equal(desktop.document.activeElement, desktop.input);
desktop.form.listeners.keydown({key:'Escape',preventDefault(){}});
assert.equal(desktop.form.hidden, true, 'Escape closes desktop search');
assert.equal(desktop.document.activeElement, desktop.toggle);
const grouped = createPage({ dataMenu: true });
assert.equal(grouped.dataPanel.hidden, true, 'Volume links start collapsed');
assert.equal(grouped.dataToggle.attributes['aria-expanded'], 'false');
grouped.dataToggle.listeners.click({ preventDefault() {} });
assert.equal(grouped.dataPanel.hidden, false, 'Volume control reveals the grouped links');
assert.equal(grouped.dataToggle.attributes['aria-expanded'], 'true');
grouped.document.listeners.click({ target: grouped.dataPanel });
assert.equal(grouped.dataPanel.hidden, false, 'A click inside the group does not close it prematurely');
grouped.header.listeners.keydown({ key: 'Escape' });
assert.equal(grouped.dataPanel.hidden, true);
assert.equal(grouped.document.activeElement, grouped.dataToggle, 'Escape restores group control focus');
grouped.dataToggle.listeners.click({ preventDefault() {} });
grouped.document.listeners.click({ target: {} });
assert.equal(grouped.dataPanel.hidden, true, 'Outside click closes the group');
grouped.toggle.listeners.click();
assert.equal(grouped.form.hidden, false, 'Search remains independent of the volume menu');
console.log('PASS: mobile and desktop search toggles, keyboard focus, Escape and existing queries.');
