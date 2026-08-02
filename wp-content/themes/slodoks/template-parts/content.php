<?php
/**
 * Template part for displaying posts in loops.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a class="entry-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php the_post_thumbnail( 'large', [ 'loading' => 'lazy' ] ); ?>
		</a>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<time class="entry-date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
					<?php echo esc_html( get_the_date() ); ?>
				</time>
			</div>
		<?php endif; ?>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		<a class="entry-more" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Read more', 'slodoks' ); ?>
			<span class="screen-reader-text"><?php the_title(); ?></span>
		</a>
	</footer>

</article>
