const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const vm = require('node:vm');
const source = fs.readFileSync(path.join(__dirname, '../../assets/js/header.js'), 'utf8');

function createPage({ mobile = true, query = '' } = {}) {
  const document = { activeElement: null };
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
  const header = element({
    classList: new Set(),
    querySelector(selector) { return selector === '.tc-search-toggle' ? toggle : form; },
  });
  const breakpoint = element({ matches: mobile });
  document.querySelector = selector => selector === '[data-tc-header]' ? header : null;
  vm.runInNewContext(source, { document, window: { matchMedia: () => breakpoint } });
  return { document, input, toggle, form, breakpoint };
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
console.log('PASS: mobile and desktop search toggles, keyboard focus, Escape and existing queries.');
