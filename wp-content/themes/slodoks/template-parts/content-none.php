<?php
/**
 * Template part shown when no posts are found.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="no-results not-found">

	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing found', 'slodoks' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, nothing matched your search terms. Please try again with different keywords.', 'slodoks' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'slodoks' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>

</section>
