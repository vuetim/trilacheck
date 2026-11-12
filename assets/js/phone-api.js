(() => {
  const campaignNames = ['gclid', 'gbraid', 'wbraid', 'msclkid', 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'];
  const campaign = new URLSearchParams(window.location.search);
  // Only add campaign context. Never replace r, subid, phi or any API-issued parameter.
  const trackedUrl = (value) => {
    let url;
    try { url = new URL(value, window.location.href); } catch { return null; }
    if (url.protocol !== 'https:' || url.username || url.password || !['www.tariffuxx.de', 'tariffuxx.de'].includes(url.hostname) || url.searchParams.getAll('r').length !== 1 || url.searchParams.get('r') !== '1111811') return null;
    campaignNames.forEach((name) => {
      const field = campaign.get(name);
      if (field && field.length <= 250 && !url.searchParams.has(name)) url.searchParams.set(name, field);
    });
    return url.href;
  };
  document.querySelectorAll('.tc-phone-api[data-api-state="ready"]').forEach((root) => {
    const form = root.querySelector('.tc-phone-api__filters');
    const filterToggle = root.querySelector('.tc-phone-api__filter-toggle');
    const sortToggle = root.querySelector('.tc-phone-api__sort-toggle');
    const sort = root.querySelector('#tc-phone-sort');
    if (!form || !filterToggle) return;
    const mobile = window.matchMedia('(max-width: 767px)');
    const setFiltersOpen = (open) => {
      filterToggle.setAttribute('aria-expanded', String(open));
      form.hidden = !open;
    };
    root.classList.add('tc-phone-api--interactive');
    setFiltersOpen(!mobile.matches);
    filterToggle.addEventListener('click', () => setFiltersOpen(form.hidden));
    mobile.addEventListener('change', () => setFiltersOpen(!mobile.matches));
    sortToggle?.addEventListener('click', () => {
      sort?.scrollIntoView({ block: 'center', behavior: 'smooth' });
      sort?.focus({ preventScroll: true });
    });
    sort?.addEventListener('change', () => form.requestSubmit());
    const manufacturer = form.querySelector('[name="hersteller"]');
    const phone = form.querySelector('[name="telefon"]');
    if (manufacturer && phone) {
      const options = Array.from(phone.options, (option) => option.cloneNode(true));
      const filterModels = () => {
        const current = phone.value;
        const available = options.filter((option) => !option.value || !manufacturer.value || option.dataset.brand === manufacturer.value);
        phone.replaceChildren(...available.map((option) => option.cloneNode(true)));
        phone.value = available.some((option) => option.value === current) ? current : '';
      };
      manufacturer.addEventListener('change', filterModels);
      filterModels();
    }
    campaignNames.forEach((name) => {
      const value = campaign.get(name);
      if (value && value.length <= 250) {
        const input = document.createElement('input');
        input.type = 'hidden'; input.name = name; input.value = value;
        form.append(input);
      }
    });
    root.querySelectorAll('.tc-phone-api__offer').forEach((link) => {
      const href = trackedUrl(link.href);
      if (href) link.href = href;
    });
    root.querySelectorAll('.tc-phone-api__detail-link').forEach((link) => {
      link.addEventListener('click', () => {
        const details = root.querySelector(link.hash);
        if (details) details.open = true;
      });
    });
    root.querySelectorAll('.tc-phone-api__visual img').forEach((image) => {
      image.addEventListener('error', () => {
        image.hidden = true;
        const placeholder = document.createElement('span');
        placeholder.className = 'tc-phone-api__phone-placeholder';
        placeholder.setAttribute('aria-hidden', 'true');
        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('viewBox', '0 0 24 24'); svg.setAttribute('class', 'tc-tariff-icon');
        svg.setAttribute('fill', 'none'); svg.setAttribute('stroke', 'currentColor'); svg.setAttribute('stroke-width', '1.8');
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('d', 'M7 3h7l5 5v13H5V3h2M8 10h8v7H8zM12 10v7M8 13h8');
        svg.append(path); placeholder.append(svg);
        image.parentElement.append(placeholder);
      }, { once: true });
    });
    const submit = form.querySelector('button[type="submit"]');
    const submitContents = submit ? Array.from(submit.childNodes, (node) => node.cloneNode(true)) : [];
    form.addEventListener('submit', () => {
      if (submit) submit.textContent = 'Angebote werden geladen …';
      root.setAttribute('aria-busy', 'true');
    });
    window.addEventListener('pageshow', () => {
      if (submit) submit.replaceChildren(...submitContents.map((node) => node.cloneNode(true)));
      root.removeAttribute('aria-busy');
    });
    // Comparison is user-initiated. It reuses the same validated affiliate links.
    if (typeof HTMLDialogElement === 'undefined' || typeof HTMLDialogElement.prototype.showModal !== 'function') return;
    const checks = Array.from(root.querySelectorAll('.tc-phone-api__compare'));
    const selection = root.querySelector('.tc-phone-api__selection');
    const selectionText = root.querySelector('.tc-phone-api__selection-count');
    const compareButton = root.querySelector('.tc-phone-api__compare-open');
    const clearButton = root.querySelector('.tc-phone-api__compare-clear');
    const chosen = () => checks.filter((input) => input.checked);
    const refreshSelection = () => {
      const count = chosen().length;
      selection.hidden = count === 0;
      selectionText.textContent = `${count} von maximal 3 Angeboten ausgewählt`;
      compareButton.disabled = count < 2;
      checks.forEach((input) => { input.disabled = !input.checked && count >= 3; });
    };
    checks.forEach((input) => input.addEventListener('change', refreshSelection));
    clearButton.addEventListener('click', () => { checks.forEach((input) => { input.checked = false; }); refreshSelection(); });
    compareButton.addEventListener('click', () => {
      const offers = chosen().map((input) => JSON.parse(input.dataset.offer));
      if (offers.length < 2 || offers.length > 3) return;
      const dialog = document.createElement('dialog');
      dialog.className = 'tc-phone-comparison';
      dialog.setAttribute('aria-labelledby', 'tc-phone-comparison-title');
      const close = document.createElement('button');
      close.type = 'button'; close.textContent = 'Schließen ×';
      close.addEventListener('click', () => dialog.close());
      const title = document.createElement('h2');
      title.id = 'tc-phone-comparison-title'; title.textContent = 'Deine Angebote im Vergleich';
      const scroll = document.createElement('div'); scroll.className = 'tc-phone-comparison__scroll';
      scroll.tabIndex = 0; scroll.setAttribute('role', 'region'); scroll.setAttribute('aria-label', 'Vergleichstabelle horizontal scrollbar');
      const table = document.createElement('table');
      const head = document.createElement('thead'); const heading = document.createElement('tr');
      ['Merkmal', ...offers.map((offer) => offer.phone)].forEach((label) => {
        const th = document.createElement('th'); th.scope = 'col'; th.textContent = label; heading.append(th);
      });
      head.append(heading); table.append(head);
      const body = document.createElement('tbody');
      const rows = [['provider', 'Anbieter'], ['tariff', 'Tarif'], ['network', 'Netz'], ['data', 'Datenvolumen'], ['term', 'Laufzeit'], ['monthly', 'Tarif-Grundgebühr*'], ['billing', 'Abrechnungsperiode'], ['device_price', 'Gerätepreis einmalig'], ['extra_price', 'Weitere Einmalkosten'], ['average', 'Ø pro Monat über 24 Monate'], ['total', 'Gesamtkosten über 24 Monate']];
      rows.filter(([key]) => key !== 'device_price' || offers.some((offer) => offer.kind !== 'sim')).forEach(([key, label]) => {
        const row = document.createElement('tr'); const name = document.createElement('th'); name.scope = 'row'; name.textContent = label; row.append(name);
        offers.forEach((offer) => { const cell = document.createElement('td'); cell.textContent = offer[key] || 'Siehe Tarifdetails'; row.append(cell); });
        body.append(row);
      });
      const actionRow = document.createElement('tr'); actionRow.append(document.createElement('td'));
      offers.forEach((offer) => {
        const cell = document.createElement('td'); const href = trackedUrl(offer.link);
        if (href) { const link = document.createElement('a'); link.href = href; link.target = '_blank'; link.rel = 'sponsored noopener'; link.textContent = 'Zum Angebot →'; cell.append(link); }
        actionRow.append(cell);
      });
      body.append(actionRow); table.append(body); scroll.append(table);
      const note = document.createElement('p'); note.textContent = '* Preisphasen, Geräte- und Optionsraten sowie Bedingungen für Boni und Cashback in den Tarifdetails beachten. Der Durchschnitt wird über 24 Monate berechnet.';
      dialog.append(close, title, scroll, note); document.body.append(dialog);
      dialog.addEventListener('close', () => { dialog.remove(); compareButton.focus(); }, { once: true });
      dialog.showModal();
    });
    refreshSelection();
  });
})();
