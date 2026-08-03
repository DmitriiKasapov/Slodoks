/**
 * SloDoks theme scripts.
 */

import '../css/main.css';
import { initButtonWave } from './buttons.js';
import { initHeader } from './header.js';

document.addEventListener('DOMContentLoaded', () => {
	initHeader();
	initButtonWave();
});
