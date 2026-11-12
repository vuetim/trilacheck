const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const vm = require('node:vm');

// Exercise the actual client URL decorator without running or following links.
const source = fs.readFileSync(path.join(__dirname, '../../assets/js/phone-api.js'), 'utf8');
function decorator(query) {
  const context = {
    URL, URLSearchParams,
    window: { location: { href: `https://trilacheck.de/handy-mit-vertrag/${query}`, search: query } },
    document: { querySelectorAll: () => [] },
  };
  vm.runInNewContext(source.replace(/\}\)\(\);\s*$/, 'globalThis.decorate = trackedUrl;\n})();'), context);
  return context.decorate;
}
const decorate = decorator('?gclid=example-click&utm_source=google&r=attacker&subid=attacker');
const original = 'https://www.tariffuxx.de/handytarife/angebot/123?phi%5B%5D=1188&r=1111811&v2=1&subid=trilacheck-handy';
const result = new URL(decorate(original));
assert.equal(result.searchParams.get('r'), '1111811');
assert.equal(result.searchParams.get('subid'), 'trilacheck-handy');
assert.equal(result.searchParams.get('phi[]'), '1188');
assert.equal(result.searchParams.get('v2'), '1');
assert.equal(result.searchParams.get('gclid'), 'example-click');
assert.equal(result.searchParams.get('utm_source'), 'google');
assert.equal(new URL(decorate(original + '&gclid=upstream-click')).searchParams.get('gclid'), 'upstream-click');
assert.equal(decorate('https://www.tariffuxx.de/angebot?r=9999999'), null);
assert.equal(decorate('https://www.tariffuxx.de/angebot?r=1111811&r=9999999'), null);
assert.equal(decorate('https://evil.example/angebot?r=1111811'), null);
assert.equal(decorate('http://www.tariffuxx.de/angebot?r=1111811'), null);
assert.equal(decorator('')(original), original);
console.log('PASS: client affiliate links preserve partner, device, SubID and upstream parameters; campaign context cannot overwrite attribution.');
