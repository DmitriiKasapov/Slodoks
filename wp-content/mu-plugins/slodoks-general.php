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
 * Save generated image sizes as WebP.
 *
 * WordPress does not convert uploads on its own: the idea was tried in 6.1
 * and rolled back because keeping both formats doubled the disk usage. This
 * filter converts the generated sizes only — the uploaded original stays as
 * it is and serves as the fallback inside <picture> for the handful of
 * browsers that cannot read WebP.
 *
 * The filter carries a map of source mime => target mime, not a single
 * format, and core already fills it with the HEIC rules, so the array is
 * extended rather than replaced.
 *
 * PNG is left alone: it is used for logos and transparent graphics where the
 * lossless original is usually smaller than a WebP copy.
 *
 * @param array $formats Mime type mapping.
 * @return array
 */
add_filter(
	'image_editor_output_format',
	static function ( array $formats ): array {
		$formats['image/jpeg'] = 'image/webp';
		$formats['image/jpg']  = 'image/webp';

		return $formats;
	}
);

/**
 * Quality for generated WebP files.
 *
 * 82 matches the WordPress default for JPEG and is visually indistinguishable
 * from the original at a fraction of the weight.
 *
 * @param int    $quality Current quality.
 * @param string $mime    Mime type being written.
 * @return int
 */
add_filter(
	'wp_editor_set_quality',
	static function ( int $quality, string $mime ): int {
		return 'image/webp' === $mime ? 82 : $quality;
	},
	10,
	2
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
