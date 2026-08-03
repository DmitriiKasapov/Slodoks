/**
 * Header behaviour: mobile panel and the scrolled state.
 */

const OPEN_CLASS = 'is-open';
const STUCK_CLASS = 'is-stuck';

/** Opens or closes the mobile panel, keeping aria-expanded in sync. */
const setOpen = (header, toggle, open) => {
	header.classList.toggle(OPEN_CLASS, open);
	toggle.setAttribute('aria-expanded', String(open));
};

export const initHeader = () => {
	const header = document.querySelector('[data-header]');

	if (!header) {
		return;
	}

	const toggle = header.querySelector('[data-nav-toggle]');

	if (toggle) {
		toggle.addEventListener('click', () => {
			setOpen(header, toggle, !header.classList.contains(OPEN_CLASS));
		});

		// Escape closes the panel and returns focus to the button.
		document.addEventListener('keydown', (event) => {
			if (event.key === 'Escape' && header.classList.contains(OPEN_CLASS)) {
				setOpen(header, toggle, false);
				toggle.focus();
			}
		});

		// A click anywhere outside the header closes it too.
		document.addEventListener('click', (event) => {
			if (header.classList.contains(OPEN_CLASS) && !header.contains(event.target)) {
				setOpen(header, toggle, false);
			}
		});

		// Leaving the mobile layout must not leave the panel state behind.
		const wide = window.matchMedia('(min-width: 58rem)');

		wide.addEventListener('change', (event) => {
			if (event.matches) {
				setOpen(header, toggle, false);
			}
		});
	}

	// Shadow under the header once the page is scrolled.
	const updateStuck = () => {
		header.classList.toggle(STUCK_CLASS, window.scrollY > 8);
	};

	updateStuck();
	window.addEventListener('scroll', updateStuck, { passive: true });
};
