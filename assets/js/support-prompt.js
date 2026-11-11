(function () {
  'use strict';
  var prompt = document.querySelector('[data-support-prompt]');
  if (!prompt) return;
  var key = 'tc-support-prompt-next-show';
  var timer;
  var initialDelay = 15000;
  try {
    var nextShow = Number(window.sessionStorage.getItem(key));
    if (nextShow > 0) initialDelay = Math.max(0, nextShow - Date.now());
  } catch (error) { /* Still works when browser storage is unavailable. */ }

  function closePrompt() {
    var hadFocus = prompt.contains(document.activeElement);
    prompt.hidden = true;
    if (hadFocus) document.activeElement.blur();
    try { window.sessionStorage.setItem(key, String(Date.now() + 60000)); } catch (error) { /* Optional storage. */ }
    window.clearTimeout(timer);
    timer = window.setTimeout(showPrompt, 60000);
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
      timer = window.setTimeout(showPrompt, 3000);
      return;
    }
    prompt.hidden = false;
    try { window.sessionStorage.removeItem(key); } catch (error) { /* Optional storage. */ }
  }
  timer = window.setTimeout(showPrompt, initialDelay);
})();
