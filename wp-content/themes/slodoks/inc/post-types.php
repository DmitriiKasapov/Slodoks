<?php
/**
 * Custom post types.
 *
 * Fields for these types are set up in ACF; only the types themselves and
 * their admin listing live here.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Post type key for homepage slides.
 */
const SLODOKS_SLIDE_TYPE = 'slodoks_slide';

/**
 * Register the slides post type.
 *
 * Deliberately not public: slides are shown inside the slider only. A public
 * type would give every slide its own URL, and those would end up in the
 * sitemap and in search results.
 *
 * show_in_rest is false on purpose as well — it keeps the classic editor for
 * this type instead of the block one.
 */
function slodoks_register_post_types(): void {
	register_post_type(
		SLODOKS_SLIDE_TYPE,
		[
			'labels'              => [
				'name'               => 'Слайды',
				'singular_name'      => 'Слайд',
				'add_new'            => 'Добавить слайд',
				'add_new_item'       => 'Новый слайд',
				'edit_item'          => 'Редактировать слайд',
				'all_items'          => 'Все слайды',
				'search_items'       => 'Искать слайды',
				'not_found'          => 'Слайдов пока нет',
				'featured_image'     => 'Картинка слайда',
				'set_featured_image' => 'Выбрать картинку',
			],
			'public'              => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => false,
			'menu_icon'           => 'dashicons-images-alt2',
			'menu_position'       => 20,
			'supports'            => [ 'title', 'editor', 'thumbnail', 'page-attributes' ],
			'has_archive'         => false,
			'rewrite'             => false,
			'can_export'          => true,
		]
	);
}
add_action( 'init', 'slodoks_register_post_types' );

/**
 * Order slides in wp-admin by the "Order" field, lowest first.
 *
 * @param WP_Query $query Current query.
 */
function slodoks_order_slides_in_admin( WP_Query $query ): void {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( SLODOKS_SLIDE_TYPE !== $query->get( 'post_type' ) ) {
		return;
	}

	$query->set( 'orderby', 'menu_order' );
	$query->set( 'order', 'ASC' );
}
add_action( 'pre_get_posts', 'slodoks_order_slides_in_admin' );

/**
 * Picture and order in the slides list, so the running order is visible
 * without opening every slide.
 *
 * @param array $columns Existing columns.
 * @return array
 */
function slodoks_slide_columns( array $columns ): array {
	$date = $columns['date'] ?? '';
	unset( $columns['date'] );

	$columns['slodoks_thumb'] = 'Картинка';
	$columns['slodoks_order'] = 'Порядок';
	$columns['date']          = $date;

	return $columns;
}
add_filter( 'manage_' . SLODOKS_SLIDE_TYPE . '_posts_columns', 'slodoks_slide_columns' );

/**
 * Fill the columns added above.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function slodoks_slide_column_content( string $column, int $post_id ): void {
	if ( 'slodoks_thumb' === $column ) {
		echo has_post_thumbnail( $post_id )
			? get_the_post_thumbnail( $post_id, [ 80, 50 ] )
			: '—';
	}

	if ( 'slodoks_order' === $column ) {
		echo (int) get_post_field( 'menu_order', $post_id );
	}
}
add_action( 'manage_' . SLODOKS_SLIDE_TYPE . '_posts_custom_column', 'slodoks_slide_column_content', 10, 2 );
