<?php
/**
 * Template helpers used across theme templates.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Include the body of a page from pages/.
 *
 * Templates in the theme root stay thin: they call get_header(), hand over to
 * the matching file in pages/ and call get_footer(). The layout itself lives
 * in that file.
 *
 *   slodoks_page( 'home' );
 *
 * @param string $name File name without extension.
 * @param array  $args Data passed to the file as $args.
 */
function slodoks_page( string $name, array $args = [] ): void {
	get_template_part( 'pages/' . $name, null, $args );
}

/**
 * Include a page section from components/blocks.
 *
 *   slodoks_block( 'hero-slider' );
 *   slodoks_block( 'services', [ 'title' => 'Услуги' ] );
 *
 * @param string $name File name without extension.
 * @param array  $args Data passed to the file as $args.
 */
function slodoks_block( string $name, array $args = [] ): void {
	get_template_part( 'components/blocks/' . $name, null, $args );
}

/**
 * Include a composite unit from components/modules.
 *
 * @param string $name File name without extension.
 * @param array  $args Data passed to the file as $args.
 */
function slodoks_module( string $name, array $args = [] ): void {
	get_template_part( 'components/modules/' . $name, null, $args );
}

/**
 * Include a small reusable piece from components/elements.
 *
 * @param string $name File name without extension.
 * @param array  $args Data passed to the file as $args.
 */
function slodoks_element( string $name, array $args = [] ): void {
	get_template_part( 'components/elements/' . $name, null, $args );
}

/**
 * Print a responsive <picture> for an attachment.
 *
 * Generated sizes are WebP (see the mu-plugin), while the uploaded original
 * keeps its format. So the WebP copies go into <source> and the original
 * stays in <img> as the fallback for browsers that cannot read WebP — no
 * second set of files needed.
 *
 * @param int    $attachment_id Attachment ID.
 * @param string $sizes         Value for the sizes attribute.
 * @param array  $attr          Extra attributes for the img tag.
 */
function slodoks_picture( int $attachment_id, string $sizes = '100vw', array $attr = [] ): void {
	$original = wp_get_attachment_image_url( $attachment_id, 'full' );

	if ( ! $original ) {
		return;
	}

	$meta     = (array) wp_get_attachment_metadata( $attachment_id );
	$base_url = trailingslashit( dirname( wp_get_attachment_url( $attachment_id ) ) );
	$webp     = [];

	foreach ( (array) ( $meta['sizes'] ?? [] ) as $size ) {
		// Only WebP candidates may sit inside a WebP <source>.
		if ( 'image/webp' !== ( $size['mime-type'] ?? '' ) ) {
			continue;
		}

		$webp[] = $base_url . $size['file'] . ' ' . (int) $size['width'] . 'w';
	}

	$attributes = wp_parse_args(
		$attr,
		[
			'alt'      => (string) get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ),
			'width'    => (int) ( $meta['width'] ?? 0 ),
			'height'   => (int) ( $meta['height'] ?? 0 ),
			'loading'  => 'lazy',
			'decoding' => 'async',
		]
	);

	$rendered = '';

	foreach ( array_filter( $attributes, static fn( $value ): bool => '' !== $value && 0 !== $value ) as $name => $value ) {
		$rendered .= sprintf( ' %s="%s"', esc_attr( $name ), esc_attr( (string) $value ) );
	}

	echo '<picture>';

	if ( $webp ) {
		printf(
			'<source type="image/webp" srcset="%s" sizes="%s">',
			esc_attr( implode( ', ', $webp ) ),
			esc_attr( $sizes )
		);
	}

	printf( '<img src="%s"%s>', esc_url( $original ), $rendered ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	echo '</picture>';
}

/**
 * Read a button from an ACF group field.
 *
 * Subfields sit inside a group, so ACF stores them prefixed with the group
 * name. Both the short and the doubled key are checked, which keeps the
 * template working whichever way the fields end up being named.
 *
 * @param int    $post_id Post ID.
 * @param string $group   Group field name, e.g. button_one.
 * @return array{text: string, url: string}
 */
function slodoks_get_button( int $post_id, string $group ): array {
	$read = static function ( string $suffix ) use ( $post_id, $group ): string {
		$value = get_post_meta( $post_id, $group . '_' . $suffix, true );

		if ( '' === $value || null === $value ) {
			$value = get_post_meta( $post_id, $group . '_' . $group . '_' . $suffix, true );
		}

		return trim( (string) $value );
	};

	return [
		'text' => $read( 'text' ),
		'url'  => $read( 'url' ),
	];
}
