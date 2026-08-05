<?php
/**
 * Homepage hero slider.
 *
 * Slides come from the slodoks_slide post type, ordered by the "Order" field
 * and then by date. Markup is Swiper's; the script lives in src/js/slider.js.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

$slodoks_slides = new WP_Query(
	[
		'post_type'      => SLODOKS_SLIDE_TYPE,
		'posts_per_page' => 10,
		'orderby'        => [
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		],
		'no_found_rows'  => true,
	]
);

if ( ! $slodoks_slides->have_posts() ) {
	return;
}
?>

<section class="hero" aria-label="<?php esc_attr_e( 'Главный слайдер', 'slodoks' ); ?>">
	<div class="swiper hero__swiper" data-hero-slider>
		<div class="swiper-wrapper">
			<?php
			while ( $slodoks_slides->have_posts() ) :
				$slodoks_slides->the_post();

				$slodoks_id      = get_the_ID();
				$slodoks_first   = slodoks_get_button( $slodoks_id, 'button_one' );
				$slodoks_second  = slodoks_get_button( $slodoks_id, 'button_two' );
				$slodoks_index   = $slodoks_slides->current_post;

				/*
				 * The first slide carries the h1 of the front page. The logo in
				 * the header used to hold it, and a logo says nothing about what
				 * the page is for. The rest of the slides stay h2 — one h1 to a
				 * page.
				 */
				$slodoks_heading = 0 === $slodoks_index ? 'h1' : 'h2';
				?>
				<div class="swiper-slide hero__slide">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="hero__media">
							<?php
							// The first slide is the largest element on screen, so it
							// loads eagerly and with priority; the rest wait.
							slodoks_picture(
								(int) get_post_thumbnail_id(),
								'100vw',
								[
									'class'         => 'hero__image',
									'loading'       => 0 === $slodoks_index ? 'eager' : 'lazy',
									'fetchpriority' => 0 === $slodoks_index ? 'high' : '',
									'alt'           => '',
								]
							);
							?>
						</div>
					<?php endif; ?>

					<div class="container-grid hero__inner">
						<div class="content hero__content">
							<?php // The .h2 class keeps every slide the same size, whatever the tag. ?>
							<<?php echo esc_attr( $slodoks_heading ); ?> class="hero__title h2"><?php the_title(); ?></<?php echo esc_attr( $slodoks_heading ); ?>>

							<?php if ( get_the_content() ) : ?>
								<div class="hero__text"><?php the_content(); ?></div>
							<?php endif; ?>

							<?php if ( ( $slodoks_first['text'] && $slodoks_first['url'] ) || ( $slodoks_second['text'] && $slodoks_second['url'] ) ) : ?>
								<div class="hero__actions">
									<?php if ( $slodoks_first['text'] && $slodoks_first['url'] ) : ?>
										<a class="btn btn-cta" href="<?php echo esc_url( $slodoks_first['url'] ); ?>">
											<?php echo esc_html( $slodoks_first['text'] ); ?>
										</a>
									<?php endif; ?>

									<?php if ( $slodoks_second['text'] && $slodoks_second['url'] ) : ?>
										<a class="btn btn-outline-light" href="<?php echo esc_url( $slodoks_second['url'] ); ?>">
											<?php echo esc_html( $slodoks_second['text'] ); ?>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>

		<div class="hero__ui container-grid">
			<div class="content hero__ui-inner">
				<button type="button" class="hero__nav hero__nav--prev" aria-label="<?php esc_attr_e( 'Предыдущий слайд', 'slodoks' ); ?>"></button>
				<div class="hero__pagination"></div>
				<button type="button" class="hero__nav hero__nav--next" aria-label="<?php esc_attr_e( 'Следующий слайд', 'slodoks' ); ?>"></button>
			</div>
		</div>
	</div>
</section>

<?php
wp_reset_postdata();
