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
 * Vendor libraries come from the Consal template and are loaded as-is.
 * Anything we write ourselves goes into assets/css/style.css and
 * assets/js/main.js, which are always enqueued last.
 */
function slodoks_enqueue_assets(): void {
	$uri = get_template_directory_uri();

	wp_enqueue_style( 'slodoks-style', get_stylesheet_uri(), [], SLODOKS_VERSION );
	wp_style_add_data( 'slodoks-style', 'rtl', 'replace' );

	$styles = [
		'slodoks-icomoon'             => '/assets/fonts/icomoon/style.css',
		'slodoks-flaticon'            => '/assets/fonts/flaticon/font/flaticon.css',
		'slodoks-bootstrap'           => '/assets/css/bootstrap.min.css',
		'slodoks-magnific-popup'      => '/assets/css/magnific-popup.css',
		'slodoks-jquery-ui'           => '/assets/css/jquery-ui.css',
		'slodoks-owl-carousel'        => '/assets/css/owl.carousel.min.css',
		'slodoks-owl-theme'           => '/assets/css/owl.theme.default.min.css',
		'slodoks-bootstrap-datepicker' => '/assets/css/bootstrap-datepicker.css',
		'slodoks-aos'                 => '/assets/css/aos.css',
		'slodoks-main'                => '/assets/css/style.css',
	];

	foreach ( $styles as $handle => $path ) {
		wp_enqueue_style( $handle, $uri . $path, [], SLODOKS_VERSION );
	}

	// The theme ships its own jQuery build. Re-register it under the core
	// 'jquery' handle so plugins depending on it keep working.
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', $uri . '/assets/js/jquery-3.3.1.min.js', [], '3.3.1', true );

	$scripts = [
		'slodoks-jquery-ui'      => '/assets/js/jquery-ui.js',
		'slodoks-popper'         => '/assets/js/popper.min.js',
		'slodoks-bootstrap'      => '/assets/js/bootstrap.min.js',
		'slodoks-owl-carousel'   => '/assets/js/owl.carousel.min.js',
		'slodoks-magnific-popup' => '/assets/js/jquery.magnific-popup.min.js',
		'slodoks-sticky'         => '/assets/js/jquery.sticky.js',
		'slodoks-waypoints'      => '/assets/js/jquery.waypoints.min.js',
		'slodoks-animate-number' => '/assets/js/jquery.animateNumber.min.js',
		'slodoks-aos'            => '/assets/js/aos.js',
		'slodoks-main'           => '/assets/js/main.js',
	];

	foreach ( $scripts as $handle => $path ) {
		wp_enqueue_script( $handle, $uri . $path, [ 'jquery' ], SLODOKS_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'slodoks_enqueue_assets' );
