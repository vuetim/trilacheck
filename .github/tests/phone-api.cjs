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
    document: { querySelectorAll: () => [], addEventListener: () => {} },
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

const events = [];
const listeners = {};
const context = {
  URL, URLSearchParams,
  window: { location: { href: 'https://trilacheck.de/mobilfunk/', pathname: '/mobilfunk/', search: '' }, gtag: (...args) => events.push(args) },
  document: { querySelectorAll: () => [], addEventListener: (name, handler) => { listeners[name] = handler; } },
};
vm.runInNewContext(source, context);
const link = { href: original, closest: () => null };
const click = { isTrusted: true, type: 'click', button: 0, target: { closest: () => link }, preventDefault: () => assert.fail('Navigation must stay untouched') };
listeners.click(click);
assert.equal(events.length, 1);
assert.equal(events[0][1], 'affiliate_click');
assert.equal(events[0][2].send_to, 'G-N896D2N41P');
assert.equal(events[0][2].offer_id, '123');
assert.equal(events[0][2].affiliate_subid, 'trilacheck-handy');
assert.equal(link.href, original);
listeners.click({ ...click, isTrusted: false });
listeners.auxclick({ ...click, type: 'auxclick', button: 2 });
assert.equal(events.length, 1);
listeners.auxclick({ ...click, type: 'auxclick', button: 1 });
assert.equal(events.length, 2);
link.href = 'https://www.tariffuxx.de/handytarife/angebot/123?r=999';
listeners.click(click);
assert.equal(events.length, 2);
context.window.gtag = () => { throw new Error('Tag unavailable'); };
link.href = original;
assert.doesNotThrow(() => listeners.click(click));
console.log('PASS: genuine affiliate clicks are measured without changing links or blocking navigation; synthetic and invalid partner clicks are ignored.');
