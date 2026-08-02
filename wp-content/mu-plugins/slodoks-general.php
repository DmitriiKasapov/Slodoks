<?php
/**
 * Plugin Name: Slodoks General
 * Description: Admin cleanup and general tweaks for the Slodoks site.
 * Version: 1.0.0
 * Author: Dmitrii
 * License: GPL-2.0-or-later
 *
 * Must-use plugin: loads automatically and cannot be deactivated from wp-admin.
 */

declare( strict_types = 1 );

defined( 'ABSPATH' ) || exit;

/**
 * Strip the dashboard down to a clean slate.
 *
 * remove_meta_box() is used instead of unsetting $wp_meta_boxes directly:
 * it is the documented API and keeps working if core changes its internals.
 */
add_action(
	'wp_dashboard_setup',
	static function (): void {
		$widgets = [
			// Core widgets: id => screen context.
			'dashboard_activity'         => 'normal',
			'dashboard_right_now'        => 'normal',
			'dashboard_site_health'      => 'normal',
			'dashboard_primary'          => 'side',
			'dashboard_quick_press'      => 'side',
			// Common third-party widgets.
			'rank_math_dashboard_widget' => 'normal',
			'wpseo-dashboard-overview'   => 'normal',
			'e-dashboard-overview'       => 'normal',
		];

		foreach ( $widgets as $id => $context ) {
			remove_meta_box( $id, 'dashboard', $context );
		}
	},
	// Late priority so third-party widgets are already registered.
	100
);

/**
 * Remove the "Welcome to WordPress" panel.
 */
remove_action( 'welcome_panel', 'wp_welcome_panel' );

/**
 * Allow SVG uploads for administrators only.
 *
 * SVG is XML and can carry scripts, so this is deliberately not granted to
 * editors or authors. Uploaded files are expected to come from our own design
 * assets. If untrusted users ever need it, add a sanitizer first.
 */
add_filter(
	'upload_mimes',
	static function ( array $mimes ): array {
		if ( ! current_user_can( 'manage_options' ) ) {
			return $mimes;
		}

		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';

		return $mimes;
	}
);

/**
 * Make SVG thumbnails visible in the media library.
 *
 * Without an intrinsic size WordPress renders them as zero-height boxes.
 */
add_action(
	'admin_head',
	static function (): void {
		echo '<style>.media-icon img[src$=".svg"],.attachment img[src$=".svg"]{width:100%;height:auto}</style>';
	}
);
