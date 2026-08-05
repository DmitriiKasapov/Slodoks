<?php
/**
 * Homepage.
 *
 * Assembled from blocks in template-parts/blocks, top to bottom.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main">

	<?php slodoks_block( 'hero-slider' ); ?>

</main><!-- #main -->

<?php
get_footer();
