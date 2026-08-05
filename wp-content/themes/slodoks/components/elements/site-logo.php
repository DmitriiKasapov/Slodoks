<?php
/**
 * Site logo.
 *
 * Used in the header and in the footer. The custom logo from the customizer
 * wins when one is set; otherwise the mark and the site name are drawn from
 * text, so the theme has a logo out of the box.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;
?>

<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	<?php if ( has_custom_logo() ) : ?>
		<?php the_custom_logo(); ?>
	<?php else : ?>
		<span class="site-logo__mark" aria-hidden="true">SD</span>
		<span class="site-logo__text"><?php bloginfo( 'name' ); ?></span>
	<?php endif; ?>
</a>
