<?php
/**
 * Front page layout.
 *
 * Assembled from blocks, top to bottom. Included from front-page.php.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;
?>

<main id="primary" class="site-main">

	<?php slodoks_block( 'hero-slider' ); ?>
	<?php slodoks_block( 'about' ); ?>

</main><!-- #main -->
