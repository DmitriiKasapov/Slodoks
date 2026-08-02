<?php
/**
 * Front-end styles and scripts.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue theme assets.
 *
 * The root style.css only carries the theme header, so the actual styles live
 * in assets/css/style.css. Vendor libraries are added here as separate handles
 * when the Consal template is integrated.
 *
 * Version is taken from filemtime() so the browser picks up changes without
 * bumping the theme version during development.
 */
function slodoks_enqueue_assets(): void {
	$dir = get_template_directory();
	$uri = get_template_directory_uri();

	$style_path = '/assets/css/style.css';
	$script_path = '/assets/js/main.js';

	wp_enqueue_style(
		'slodoks-main',
		$uri . $style_path,
		[],
		(string) filemtime( $dir . $style_path )
	);

	wp_enqueue_script(
		'slodoks-main',
		$uri . $script_path,
		[],
		(string) filemtime( $dir . $script_path ),
		[ 'strategy' => 'defer' ]
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'slodoks_enqueue_assets' );
