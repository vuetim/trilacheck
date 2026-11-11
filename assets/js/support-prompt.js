(function () {
  'use strict';
  var prompt = document.querySelector('[data-support-prompt]');
  if (!prompt) return;
  var key = 'tc-support-prompt-shown';
  try {
    if (window.sessionStorage.getItem(key)) return;
  } catch (error) { /* Still works when browser storage is unavailable. */ }

  function closePrompt() {
    var hadFocus = prompt.contains(document.activeElement);
    prompt.hidden = true;
    if (hadFocus) document.activeElement.blur();
  }
  prompt.querySelector('[data-support-prompt-close]').addEventListener('click', closePrompt);
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && !prompt.hidden) closePrompt();
  });

  function showPrompt() {
    // Let the visitor finish using an open consent banner or dialog first.
    var blockers = document.querySelectorAll('.cmplz-cookiebanner:not(.cmplz-hidden), [role="dialog"][aria-modal="true"], dialog[open]');
    var blocked = Array.prototype.some.call(blockers, function (element) {
      return element.getClientRects().length > 0;
    });
    if (blocked || document.hidden) {
      window.setTimeout(showPrompt, 3000);
      return;
    }
    prompt.hidden = false;
    try { window.sessionStorage.setItem(key, '1'); } catch (error) { /* Optional storage. */ }
  }
  window.setTimeout(showPrompt, 15000);
})();
