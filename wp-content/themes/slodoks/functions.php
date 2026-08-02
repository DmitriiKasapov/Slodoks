<?php

defined( 'ABSPATH' ) || exit;

define( 'ELEMENTOR_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Theme setup.
 */
function elementor_theme_setup() {
	load_theme_textdomain( 'elementor', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	register_nav_menus(
		array(
			'header-menu' => esc_html__( 'Header Menu', 'elementor' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'elementor' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'elementor_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function elementor_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'elementor_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'elementor_theme_content_width', 0 );

/**
 * Register widget area.
 */
function elementor_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'elementor' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'elementor' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'elementor_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function elementor_theme_scripts() {
	$uri = get_template_directory_uri();

	wp_enqueue_style( 'elementor-theme-style', get_stylesheet_uri(), array(), ELEMENTOR_THEME_VERSION );
	wp_style_add_data( 'elementor-theme-style', 'rtl', 'replace' );

	$styles = array(
		'elementor-theme-icomoon'             => '/assets/fonts/icomoon/style.css',
		'elementor-theme-flaticon'            => '/assets/fonts/flaticon/font/flaticon.css',
		'elementor-theme-bootstrap'           => '/assets/css/bootstrap.min.css',
		'elementor-theme-magnific-popup'      => '/assets/css/magnific-popup.css',
		'elementor-theme-jquery-ui'           => '/assets/css/jquery-ui.css',
		'elementor-theme-owl-carousel'        => '/assets/css/owl.carousel.min.css',
		'elementor-theme-owl-theme'           => '/assets/css/owl.theme.default.min.css',
		'elementor-theme-bootstrap-datepicker' => '/assets/css/bootstrap-datepicker.css',
		'elementor-theme-aos'                 => '/assets/css/aos.css',
		'elementor-theme-main'                => '/assets/css/style.css',
	);

	foreach ( $styles as $handle => $path ) {
		wp_enqueue_style( $handle, $uri . $path, array(), ELEMENTOR_THEME_VERSION );
	}

	// The theme ships its own jQuery build. Re-register it under the core
	// 'jquery' handle so plugins depending on it keep working.
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', $uri . '/assets/js/jquery-3.3.1.min.js', array(), '3.3.1', true );

	$scripts = array(
		'elementor-theme-jquery-ui'       => '/assets/js/jquery-ui.js',
		'elementor-theme-popper'          => '/assets/js/popper.min.js',
		'elementor-theme-bootstrap'       => '/assets/js/bootstrap.min.js',
		'elementor-theme-owl-carousel'    => '/assets/js/owl.carousel.min.js',
		'elementor-theme-magnific-popup'  => '/assets/js/jquery.magnific-popup.min.js',
		'elementor-theme-sticky'          => '/assets/js/jquery.sticky.js',
		'elementor-theme-waypoints'       => '/assets/js/jquery.waypoints.min.js',
		'elementor-theme-animate-number'  => '/assets/js/jquery.animateNumber.min.js',
		'elementor-theme-aos'             => '/assets/js/aos.js',
		'elementor-theme-main'            => '/assets/js/main.js',
	);

	foreach ( $scripts as $handle => $path ) {
		wp_enqueue_script( $handle, $uri . $path, array( 'jquery' ), ELEMENTOR_THEME_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'elementor_theme_scripts' );


//Fix menju class
function elementor_add_link_atts($atts) {
  $atts['class'] = "nav-link";
  return $atts;
}

// Redux Theme Options Config.
// Loaded on `init` because the config uses translation functions,
// which must not run before translations are available.
function elementor_theme_options_panel() {
	require get_template_directory() . '/inc/options-panel.php';
}
add_action( 'init', 'elementor_theme_options_panel', 0 );