/**
 * Cursor-following hover wave.
 *
 * Records where the pointer crossed the button edge, so the fill in
 * components/buttons.css grows from that exact point. Moving from one button
 * to another restarts the wave at the new edge.
 *
 * Delegated from the document: buttons rendered later need no wiring.
 */

const SELECTOR = '.hv-cursor';

/** Writes the pointer position, relative to the button, into CSS variables. */
const setOrigin = (button, event) => {
	const box = button.getBoundingClientRect();

	button.style.setProperty('--btn-x', `${event.clientX - box.left}px`);
	button.style.setProperty('--btn-y', `${event.clientY - box.top}px`);
};

export const initButtonWave = () => {
	// pointerover bubbles, pointerenter does not.
	document.addEventListener('pointerover', (event) => {
		const button = event.target.closest?.(SELECTOR);

		// Ignore moves that stay inside the same button.
		if (button && !button.contains(event.relatedTarget)) {
			setOrigin(button, event);
		}
	});

	// Let the wave retreat towards the edge the pointer left through.
	document.addEventListener('pointerout', (event) => {
		const button = event.target.closest?.(SELECTOR);

		if (button && !button.contains(event.relatedTarget)) {
			setOrigin(button, event);
		}
	});
};
