<?php
/**
 * The footer for our theme.
 *
 * Closes the markup opened in header.php.
 *
 * Four columns: brand, menu, services, call to action. The SEO text, the
 * social links and the services list are added later.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;
?>

	<footer id="colophon" class="site-footer">

		<div class="container-grid">
			<div class="content site-footer__top">

				<div class="site-footer__col site-footer__col--brand">
					<?php slodoks_element( 'site-logo' ); ?>

					<?php // SEO text goes here. ?>

					<?php // Social links go here. ?>
				</div>

				<div class="site-footer__col">
					<h2 class="site-footer__heading"><?php esc_html_e( 'Меню', 'slodoks' ); ?></h2>

					<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
						<nav aria-label="<?php esc_attr_e( 'Footer menu', 'slodoks' ); ?>">
							<?php
							// Same menu as the header. depth => 1 keeps submenus
							// out of the footer while the header can show them.
							wp_nav_menu(
								[
									'theme_location' => 'header-menu',
									'menu_id'        => 'footer-menu',
									'menu_class'     => 'site-footer__list',
									'container'      => '',
									'depth'          => 1,
								]
							);
							?>
						</nav>
					<?php endif; ?>
				</div>

				<div class="site-footer__col">
					<h2 class="site-footer__heading"><?php esc_html_e( 'Услуги', 'slodoks' ); ?></h2>

					<?php // Services list goes here. ?>
				</div>

				<div class="site-footer__col">
					<h2 class="site-footer__heading"><?php esc_html_e( 'Запишись на консультацию', 'slodoks' ); ?></h2>

					<a class="btn btn-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
						<?php esc_html_e( 'Записаться', 'slodoks' ); ?>
					</a>
				</div>

			</div>
		</div>

		<div class="container-grid site-footer__bottom">
			<div class="content site-footer__bottom-inner">
				<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>

				<p>
					<a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">
						<?php esc_html_e( 'Политика конфиденциальности', 'slodoks' ); ?>
					</a>
				</p>
			</div>
		</div>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
