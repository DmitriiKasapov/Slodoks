/**
 * Homepage hero slider.
 *
 * Only the modules actually used are imported: pulling in the whole Swiper
 * bundle would cost several times more for the same result.
 */

import Swiper from 'swiper';
import { A11y, Autoplay, EffectFade, Keyboard, Navigation, Pagination } from 'swiper/modules';

// Swiper's stylesheets are pulled in from src/css/main.css instead of here,
// so they can be put into a cascade layer. Imported from JS they would sit
// outside every layer and beat our own component styles by default.

/** Length of the crossfade, ms. */
const SPEED = 1400;

/** Pause between changes, counted from the end of the previous one, ms. */
const DELAY = 4500;

export const initHeroSlider = () => {
	const container = document.querySelector('[data-hero-slider]');

	if (!container) {
		return;
	}

	/*
	 * How long a slide keeps the active class: Swiper adds it when the change
	 * starts and the pause only begins once the change is over. The zoom
	 * animation is timed against this, so the value is handed to CSS from here
	 * instead of being written down twice.
	 */
	container.style.setProperty('--hero-cycle', `${SPEED + DELAY}ms`);

	const slides = container.querySelectorAll('.swiper-slide');

	// A single slide needs no slider, no autoplay and no controls.
	if (slides.length < 2) {
		container.closest('.hero')?.classList.add('hero--static');

		return;
	}

	new Swiper(container, {
		modules: [A11y, Autoplay, EffectFade, Keyboard, Navigation, Pagination],
		effect: 'fade',
		fadeEffect: { crossFade: true },
		// Long crossfade: the slides overlap for most of the change instead of
		// swapping over in a blink.
		speed: SPEED,
		loop: true,
		autoplay: {
			// Counted from the end of the previous change, so a slower fade
			// needs a longer pause to keep the same time on screen.
			delay: DELAY,
			disableOnInteraction: false,
			pauseOnMouseEnter: true,
		},
		keyboard: { enabled: true },
		navigation: {
			prevEl: '.hero__nav--prev',
			nextEl: '.hero__nav--next',
		},
		pagination: {
			el: '.hero__pagination',
			clickable: true,
		},
		a11y: {
			prevSlideMessage: 'Предыдущий слайд',
			nextSlideMessage: 'Следующий слайд',
			paginationBulletMessage: 'Перейти к слайду {{index}}',
		},
	});
};
