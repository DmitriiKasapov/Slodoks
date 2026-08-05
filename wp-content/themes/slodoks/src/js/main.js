/**
 * SloDoks theme scripts.
 */

import '../css/main.css';
import { initButtonWave } from './buttons.js';
import { initHeader } from './header.js';
import { initHeroSlider } from './slider.js';

document.addEventListener('DOMContentLoaded', () => {
	initHeader();
	initButtonWave();
	initHeroSlider();
});
