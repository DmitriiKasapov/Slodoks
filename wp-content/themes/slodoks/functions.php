<?php
/**
 * SloDoks theme bootstrap.
 *
 * This file only defines constants and loads modules from /inc.
 * Put new code into a dedicated file there, not here.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme version, used for cache busting of styles and scripts.
 */
define( 'SLODOKS_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Theme modules, loaded in order.
 */
$slodoks_modules = [
	'setup',         // Theme supports, menus, widget areas.
	'enqueue',       // Front-end styles and scripts.
	'template-tags', // Helpers used inside templates.
];

foreach ( $slodoks_modules as $slodoks_module ) {
	require_once get_template_directory() . '/inc/' . $slodoks_module . '.php';
}

unset( $slodoks_modules, $slodoks_module );

/**
 * Redux theme options.
 *
 * Loaded on `init` because the config uses translation functions,
 * which must not run before translations are available.
 */
function slodoks_load_options_panel(): void {
	require_once get_template_directory() . '/inc/options-panel.php';
}
add_action( 'init', 'slodoks_load_options_panel', 0 );
