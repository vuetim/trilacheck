(() => {
  'use strict';

  const hero = document.querySelector('[data-tc-hero]');
  if (!hero) return;

  const slides = [...hero.querySelectorAll('[data-tc-slide]')];
  const dots = [...hero.querySelectorAll('[data-tc-dot]')];
  const previous = hero.querySelector('[data-tc-prev]');
  const next = hero.querySelector('[data-tc-next]');
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  let active = 0;
  let timer = null;
  let touchStart = 0;

  const show = (index) => {
    active = (index + slides.length) % slides.length;
    slides.forEach((slide, current) => {
      const selected = current === active;
      slide.classList.toggle('is-active', selected);
      slide.setAttribute('aria-hidden', selected ? 'false' : 'true');
    });
    dots.forEach((dot, current) => {
      const selected = current === active;
      dot.classList.toggle('is-active', selected);
      dot.setAttribute('aria-current', selected ? 'true' : 'false');
    });

	const color = slides[active].dataset.color || '#0b5052';
	hero.style.setProperty('--tc-hero-color', color);
	document.documentElement.style.setProperty('--tc-active-hero', color);
  };

  const stop = () => {
    if (timer) window.clearInterval(timer);
    timer = null;
  };

  const start = () => {
    if (reducedMotion || timer) return;
    timer = window.setInterval(() => show(active + 1), 6500);
  };

  previous?.addEventListener('click', () => { stop(); show(active - 1); });
  next?.addEventListener('click', () => { stop(); show(active + 1); });
  dots.forEach((dot, index) => dot.addEventListener('click', () => { stop(); show(index); }));
  hero.addEventListener('mouseenter', stop);
  hero.addEventListener('mouseleave', start);
  hero.addEventListener('focusin', stop);
  hero.addEventListener('touchstart', (event) => { touchStart = event.changedTouches[0].clientX; stop(); }, { passive: true });
  hero.addEventListener('touchend', (event) => {
    const distance = event.changedTouches[0].clientX - touchStart;
    if (Math.abs(distance) > 45) show(active + (distance < 0 ? 1 : -1));
  }, { passive: true });

  show(0);
  start();
})();
