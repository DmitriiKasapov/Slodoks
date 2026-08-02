import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import { writeFileSync, rmSync } from 'node:fs';
import { basename, resolve } from 'node:path';

// Kept outside dist/ on purpose: `vite build` empties that folder and would
// silently drop the marker while the dev server is still running.
const HOT_FILE = resolve(import.meta.dirname, '.vite-hot');

// Derived from the folder name so renaming the theme needs no config edit.
const THEME_SLUG = basename(import.meta.dirname);

/**
 * Writes .vite-hot while the dev server runs, so inc/enqueue.php knows to load
 * assets from Vite instead of dist/. Removed when the server stops.
 */
const hotFile = () => ({
	name: 'theme-hot-file',
	apply: 'serve',
	configureServer(server) {
		server.httpServer?.once('listening', () => {
			const { port } = server.httpServer.address();
			writeFileSync(HOT_FILE, `http://localhost:${port}`);
		});

		const clean = () => rmSync(HOT_FILE, { force: true });
		process.on('exit', clean);
		process.on('SIGINT', () => process.exit());
		process.on('SIGTERM', () => process.exit());
	},
});

export default defineConfig(({ command }) => ({
	plugins: [tailwindcss(), hotFile()],
	resolve: {
		alias: {
			'@': resolve(import.meta.dirname, 'src'),
		},
	},
	// On build, asset URLs inside CSS must resolve from the site root.
	// The dev server serves from its own root, so no prefix there.
	base: command === 'build' ? `/wp-content/themes/${THEME_SLUG}/dist/` : '/',
	build: {
		outDir: 'dist',
		emptyOutDir: true,
		manifest: true,
		rollupOptions: {
			input: 'src/js/main.js',
		},
	},
	server: {
		port: 5173,
		// Fall back to the next free port instead of failing: several projects
		// may run at once, and .vite-hot always records the real port.
		strictPort: false,
		// The site is served by Docker on another port, so the dev server is
		// cross-origin for the browser.
		cors: true,
	},
}));
