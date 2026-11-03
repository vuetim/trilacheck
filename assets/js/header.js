(() => {
  'use strict';

  const siteHeader = document.querySelector('[data-tc-header]');
  const searchToggle = siteHeader?.querySelector('.tc-search-toggle');
  const searchForm = siteHeader?.querySelector('#tc-header-search');
  const searchInput = searchForm?.querySelector('input[type="search"]');
  if (searchToggle && searchForm && searchInput) {
    let searchOpen = Boolean(searchInput.value.trim());
    const syncSearch = () => {
      searchToggle.hidden = false;
      searchForm.hidden = !searchOpen;
      searchToggle.setAttribute('aria-expanded', String(searchOpen));
      siteHeader.classList.add('tc-search-ready');
    };
    searchToggle.addEventListener('click', () => {
      searchOpen = !searchOpen;
      syncSearch();
      if (searchOpen) searchInput.focus();
    });
    searchForm.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        event.preventDefault();
        searchOpen = false;
        syncSearch();
        searchToggle.focus();
      }
    });
    syncSearch();
  }

  const header = document.querySelector('.tc-site-header--home');
  if (header) {
    const updateHeaderHeight = () => {
      document.documentElement.style.setProperty('--tc-home-header-height', `${header.getBoundingClientRect().height}px`);
    };
    updateHeaderHeight();
    if ('ResizeObserver' in window) {
      new ResizeObserver(updateHeaderHeight).observe(header);
    } else {
      window.addEventListener('resize', updateHeaderHeight);
    }
  }

  const toggle = document.querySelector('.tc-menu-toggle');
  const drawer = document.querySelector('#tc-mobile-menu');

  if (!toggle || !drawer) return;

  const closeButtons = drawer.querySelectorAll('[data-tc-menu-close]');
  const panel = drawer.querySelector('.tc-drawer__panel');
  let previousFocus = null;

  const openMenu = () => {
    previousFocus = document.activeElement;
    drawer.hidden = false;
    toggle.setAttribute('aria-expanded', 'true');
    document.body.classList.add('tc-menu-open');
    window.requestAnimationFrame(() => drawer.querySelector('.tc-drawer__close')?.focus());
  };

  const closeMenu = () => {
    drawer.hidden = true;
    toggle.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('tc-menu-open');
    previousFocus?.focus();
  };

  toggle.addEventListener('click', () => drawer.hidden ? openMenu() : closeMenu());
  closeButtons.forEach((button) => button.addEventListener('click', closeMenu));

  drawer.querySelectorAll('.menu-item-has-children').forEach((item) => {
    const link = item.querySelector(':scope > a');
    const submenu = item.querySelector(':scope > .sub-menu');
    if (!link || !submenu) return;
    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'tc-submenu-toggle';
    button.setAttribute('aria-expanded', 'false');
    button.setAttribute('aria-label', link.textContent.trim() + ' Untermenü öffnen');
    button.innerHTML = '<span aria-hidden="true">+</span>';
    link.insertAdjacentElement('afterend', button);
    button.addEventListener('click', () => {
      const isOpen = item.classList.toggle('is-submenu-open');
      button.setAttribute('aria-expanded', String(isOpen));
      button.querySelector('span').textContent = isOpen ? '−' : '+';
    });
  });

  document.addEventListener('keydown', (event) => {
    if (drawer.hidden) return;

    if (event.key === 'Escape') {
      closeMenu();
      return;
    }

    if (event.key !== 'Tab') return;

    const focusable = panel.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), [tabindex]:not([tabindex="-1"])');
    if (!focusable.length) return;

    const first = focusable[0];
    const last = focusable[focusable.length - 1];

    if (event.shiftKey && document.activeElement === first) {
      event.preventDefault();
      last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
      event.preventDefault();
      first.focus();
    }
  });
})();
