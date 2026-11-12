(() => {
  document.querySelectorAll('.tc-phone-api').forEach((root) => {
    const toggle = root.querySelector('.tc-phone-api__filter-toggle');
    const form = root.querySelector('.tc-phone-api__filters');
    if (!toggle || !form) return;
    const mobile = window.matchMedia('(max-width: 767px)');
    const setOpen = (open) => {
      toggle.setAttribute('aria-expanded', String(open));
      form.hidden = !open;
    };
    root.classList.add('tc-phone-api--interactive');
    setOpen(!mobile.matches);
    toggle.addEventListener('click', () => {
      setOpen(toggle.getAttribute('aria-expanded') !== 'true');
    });
    mobile.addEventListener('change', () => setOpen(!mobile.matches));
    form.addEventListener('submit', () => {
      const button = form.querySelector('button[type="submit"]');
      if (button) button.textContent = 'Angebote werden geladen …';
      root.setAttribute('aria-busy', 'true');
    });
  });
})();
