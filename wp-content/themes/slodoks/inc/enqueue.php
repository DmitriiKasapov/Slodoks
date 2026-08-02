<?php
/**
 * Front-end styles and scripts, built with Vite.
 *
 * While `npm run dev` is running, Vite writes .vite-hot and assets are served
 * from the dev server with HMR. Otherwise the built files from dist/ are used,
 * resolved through Vite's manifest.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Entry point, relative to the theme root.
 */
const SLODOKS_VITE_ENTRY = 'src/js/main.js';

/**
 * Dev server URL if it is running, empty string otherwise.
 *
 * The marker is ignored outside local and development environments: a stale
 * .vite-hot must never be able to point a live site at a dev server.
 */
function slodoks_vite_dev_server(): string {
	static $url = null;

	if ( null === $url ) {
		if ( ! in_array( wp_get_environment_type(), [ 'local', 'development' ], true ) ) {
			return $url = '';
		}

		$hot = get_template_directory() . '/.vite-hot';
		$url = is_readable( $hot ) ? trim( (string) file_get_contents( $hot ) ) : '';
	}

	return $url;
}

/**
 * Decoded Vite manifest, or an empty array when the theme is not built.
 */
function slodoks_vite_manifest(): array {
	static $manifest = null;

	if ( null === $manifest ) {
		$path     = get_template_directory() . '/dist/.vite/manifest.json';
		$manifest = is_readable( $path )
			? (array) json_decode( (string) file_get_contents( $path ), true )
			: [];
	}

	return $manifest;
}

/**
 * Enqueue theme assets.
 */
function slodoks_enqueue_assets(): void {
	$dev = slodoks_vite_dev_server();

	if ( $dev ) {
		// Dev server: the client must load first, both as ES modules.
		wp_enqueue_script( 'slodoks-vite-client', $dev . '/@vite/client', [], null, false );
		wp_enqueue_script( 'slodoks-main', $dev . '/' . SLODOKS_VITE_ENTRY, [], null, false );
	} else {
		$manifest = slodoks_vite_manifest();
		$entry    = $manifest[ SLODOKS_VITE_ENTRY ] ?? null;

		if ( $entry ) {
			$uri = get_template_directory_uri() . '/dist/';

			// Hashed filenames make the version query string unnecessary.
			foreach ( $entry['css'] ?? [] as $index => $css ) {
				wp_enqueue_style( 'slodoks-main-' . $index, $uri . $css, [], null );
			}

			// No 'defer' strategy: type="module" scripts are deferred by default.
			wp_enqueue_script( 'slodoks-main', $uri . $entry['file'], [], null, [ 'in_footer' => true ] );
		}
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'slodoks_enqueue_assets' );

/**
 * Vite serves ES modules, so the entry scripts need type="module".
 *
 * @param string $tag    Script tag HTML.
 * @param string $handle Script handle.
 * @return string
 */
function slodoks_module_script_tag( string $tag, string $handle ): string {
	if ( ! in_array( $handle, [ 'slodoks-vite-client', 'slodoks-main' ], true ) ) {
		return $tag;
	}

	return str_replace( '<script ', '<script type="module" ', $tag );
}
add_filter( 'script_loader_tag', 'slodoks_module_script_tag', 10, 2 );
