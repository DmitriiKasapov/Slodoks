<?php
/**
 * The footer for our theme.
 *
 * Closes the markup opened in header.php.
 * Minimal default markup — the Consal layout is integrated later.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;
?>

	<footer id="colophon" class="site-footer">

		<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
			<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer menu', 'slodoks' ); ?>">
				<?php
				wp_nav_menu(
					[
						'theme_location' => 'footer-menu',
						'menu_id'        => 'footer-menu',
						'container'      => '',
					]
				);
				?>
			</nav>
		<?php endif; ?>

		<p class="site-info">
			&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</p>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
