<?php
/**
 * Theme setup: supports, menus, widget areas.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme features and navigation menus.
 */
function slodoks_setup(): void {
	load_theme_textdomain( 'slodoks', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	register_nav_menus(
		[
			'header-menu' => esc_html__( 'Header Menu', 'slodoks' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'slodoks' ),
		]
	);

	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		]
	);

	add_theme_support(
		'custom-logo',
		[
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		]
	);
}
add_action( 'after_setup_theme', 'slodoks_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function slodoks_content_width(): void {
	$GLOBALS['content_width'] = apply_filters( 'slodoks_content_width', 640 );
}
add_action( 'after_setup_theme', 'slodoks_content_width', 0 );

/**
 * Register widget areas.
 */
function slodoks_widgets_init(): void {
	register_sidebar(
		[
			'name'          => esc_html__( 'Sidebar', 'slodoks' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'slodoks' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		]
	);
}
add_action( 'widgets_init', 'slodoks_widgets_init' );
