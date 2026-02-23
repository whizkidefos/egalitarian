/**
 * Main JavaScript — The Egalitarian Association
 * File: wp-content/themes/egalitarian-association/assets/js/main.js
 *
 * Vanilla JS, ES6, no dependencies.
 */

'use strict';

/* ============================================================
   UTILITY
   ============================================================ */
const $ = (sel, ctx = document) => ctx.querySelector(sel);
const $$ = (sel, ctx = document) => [...ctx.querySelectorAll(sel)];

/* ============================================================
   STICKY HEADER — add 'scrolled' class once page scrolls
   ============================================================ */
function initStickyHeader() {
  const header = $('#site-header');
  if (!header) return;

  const onScroll = () => {
    header.classList.toggle('scrolled', window.scrollY > 20);
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll(); // initial call
}

/* ============================================================
   MOBILE NAV TOGGLE
   ============================================================ */
function initMobileNav() {
  const toggle  = $('#ea-mobile-toggle');
  const menu    = $('#ea-mobile-menu');
  if (!toggle || !menu) return;

  const iconMenu  = toggle.querySelector('.icon-menu');
  const iconClose = toggle.querySelector('.icon-close');

  toggle.addEventListener('click', () => {
    const isOpen = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!isOpen));
    menu.classList.toggle('hidden', isOpen);
    // Use style.display for reliable icon toggling
    iconMenu.style.display = isOpen ? '' : 'none';
    iconClose.style.display = isOpen ? 'none' : '';
    document.body.style.overflow = isOpen ? '' : 'hidden'; // prevent background scroll
  });

  // Close on escape key
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
      toggle.click();
    }
  });

  // Close on outside click
  document.addEventListener('click', e => {
    if (
      toggle.getAttribute('aria-expanded') === 'true' &&
      !menu.contains(e.target) &&
      !toggle.contains(e.target)
    ) {
      toggle.click();
    }
  });

  // Close on nav link click (mobile)
  $$('a', menu).forEach(link => {
    link.addEventListener('click', () => {
      if (toggle.getAttribute('aria-expanded') === 'true') {
        toggle.click();
      }
    });
  });
}

/* ============================================================
   SCROLL REVEAL — IntersectionObserver-powered fade-up
   ============================================================ */
function initScrollReveal() {
  const elements = $$('.ea-reveal');
  if (!elements.length) return;

  // Use requestAnimationFrame for already-visible items (no FOUC)
  if (!('IntersectionObserver' in window)) {
    elements.forEach(el => el.classList.add('is-visible'));
    return;
  }

  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1, rootMargin: '0px 0px -40px 0px' }
  );

  elements.forEach(el => observer.observe(el));
}

/* ============================================================
   SMOOTH SCROLL — for hash links (respects prefers-reduced-motion)
   ============================================================ */
function initSmoothScroll() {
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReduced) return;

  document.addEventListener('click', e => {
    const link = e.target.closest('a[href^="#"]');
    if (!link) return;

    const id = link.getAttribute('href').slice(1);
    if (!id) return;

    const target = document.getElementById(id);
    if (!target) return;

    e.preventDefault();
    const header   = $('#site-header');
    const offset   = header ? header.offsetHeight + 16 : 80;
    const top      = target.getBoundingClientRect().top + window.scrollY - offset;

    window.scrollTo({ top, behavior: 'smooth' });

    // Update URL without jump
    history.pushState(null, '', '#' + id);
  });
}

/* ============================================================
   COUNTER ANIMATION — for impact numbers
   Triggers when the stat enters the viewport.
   ============================================================ */
function initCounters() {
  const counters = $$('.ea-counter-value');
  if (!counters.length) return;

  const easeOut = t => 1 - Math.pow(1 - t, 3);

  const animateCounter = (el) => {
    const rawTarget = el.dataset.target || el.textContent;
    const prefix    = rawTarget.replace(/[\d,]+.*/g, '');
    const suffix    = rawTarget.replace(/^[^0-9]*/g, '').replace(/\d[\d,]*/g, '');
    const target    = parseInt(rawTarget.replace(/\D/g, ''), 10);
    const duration  = 1600; // ms
    const start     = performance.now();

    const step = (now) => {
      const elapsed  = now - start;
      const progress = Math.min(elapsed / duration, 1);
      const value    = Math.round(easeOut(progress) * target);
      el.textContent = prefix + value.toLocaleString() + suffix;
      if (progress < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
  };

  if (!('IntersectionObserver' in window)) {
    counters.forEach(animateCounter);
    return;
  }

  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.5 }
  );

  counters.forEach(el => observer.observe(el));
}

/* ============================================================
   DROPDOWN ACCESSIBILITY — keyboard navigation for desktop nav
   ============================================================ */
function initNavAccessibility() {
  $$('.relative.group').forEach(item => {
    const trigger = item.querySelector('a');
    const submenu = item.querySelector('.ea-dropdown');
    if (!trigger || !submenu) return;

    // Expose submenu to keyboard users
    trigger.addEventListener('focus', () => {
      submenu.style.opacity = '1';
      submenu.style.visibility = 'visible';
      submenu.style.transform = 'translateY(0)';
    });

    const links = $$('a', submenu);
    if (links.length) {
      links[links.length - 1].addEventListener('blur', () => {
        submenu.style.opacity = '';
        submenu.style.visibility = '';
        submenu.style.transform = '';
      });
    }
  });
}

/* ============================================================
   ANNOUNCEMENT BAR DISMISS
   ============================================================ */
function initAnnouncementDismiss() {
  const bar   = $('.ea-announcement');
  const close = bar && bar.querySelector('[data-dismiss]');
  if (!bar || !close) return;

  close.addEventListener('click', () => {
    bar.style.maxHeight = bar.offsetHeight + 'px';
    requestAnimationFrame(() => {
      bar.style.transition = 'max-height 0.3s ease, opacity 0.3s ease';
      bar.style.maxHeight  = '0';
      bar.style.opacity    = '0';
      bar.style.overflow   = 'hidden';
    });
    // Store dismissal in sessionStorage
    sessionStorage.setItem('ea_announcement_dismissed', '1');
  });

  if (sessionStorage.getItem('ea_announcement_dismissed')) {
    bar.style.display = 'none';
  }
}

/* ============================================================
   BACK TO TOP (auto-inject)
   ============================================================ */
function initBackToTop() {
  const btn = document.createElement('button');
  btn.setAttribute('aria-label', 'Back to top');
  btn.setAttribute('id', 'ea-back-to-top');
  btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M7.41 15.41 12 10.83l4.59 4.58L18 14l-6-6-6 6z"/></svg>`;
  btn.style.cssText = `
    position: fixed;
    bottom: 1.5rem;
    right: 1.5rem;
    z-index: 100;
    width: 2.75rem;
    height: 2.75rem;
    background: #1a2b4a;
    color: white;
    border: none;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 0;
    transform: translateY(8px);
    transition: opacity 0.3s ease, transform 0.3s ease, background 0.2s ease;
    box-shadow: 0 4px 16px rgba(31,58,147,0.25);
  `;
  document.body.appendChild(btn);

  const toggle = () => {
    const visible = window.scrollY > 400;
    btn.style.opacity   = visible ? '1' : '0';
    btn.style.transform = visible ? 'translateY(0)' : 'translateY(8px)';
    btn.style.pointerEvents = visible ? 'auto' : 'none';
  };

  window.addEventListener('scroll', toggle, { passive: true });
  btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  btn.addEventListener('mouseenter', () => btn.style.background = '#2dd4bf');
  btn.addEventListener('mouseleave', () => btn.style.background = '#1a2b4a');
}

/* ============================================================
   LAZY IMAGE LOAD (native + polyfill trigger)
   ============================================================ */
function initLazyImages() {
  // Modern browsers handle loading="lazy" natively.
  // Here we just set loading="lazy" on any img missing it.
  $$('img:not([loading])').forEach(img => {
    // Only add for non-hero images
    if (!img.closest('.ea-hero')) {
      img.setAttribute('loading', 'lazy');
    }
  });
}

/* ============================================================
   NEWSLETTER FORM — inline feedback
   ============================================================ */
function initNewsletterForm() {
  const form = $('.ea-newsletter form');
  if (!form) return;

  form.addEventListener('submit', async e => {
    e.preventDefault();
    const btn    = form.querySelector('button[type="submit"]');
    const input  = form.querySelector('input[type="email"]');
    const origText = btn.textContent;

    btn.textContent = 'Subscribing…';
    btn.disabled    = true;

    try {
      const data = new FormData(form);
      const resp = await fetch(form.action, { method: 'POST', body: data });

      if (resp.ok) {
        btn.textContent  = '✓ Subscribed!';
        btn.style.background = 'var(--teal)';
        input.value = '';
        setTimeout(() => {
          btn.textContent = origText;
          btn.style.background = '';
          btn.disabled = false;
        }, 3000);
      } else {
        throw new Error('Network response was not ok');
      }
    } catch {
      btn.textContent = 'Try again';
      btn.style.background = '#EF4444';
      setTimeout(() => {
        btn.textContent = origText;
        btn.style.background = '';
        btn.disabled = false;
      }, 3000);
    }
  });
}

/* ============================================================
   INIT ALL
   ============================================================ */
function init() {
  initStickyHeader();
  initMobileNav();
  initScrollReveal();
  initSmoothScroll();
  initCounters();
  initNavAccessibility();
  initAnnouncementDismiss();
  initBackToTop();
  initLazyImages();
  initNewsletterForm();
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', init);
} else {
  init();
}
