<?php
/**
 * The header for our theme.
 *
 * Displays the <head> section and everything up to the main content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary">
	<?php esc_html_e( 'Перейти к содержимому', 'slodoks' ); ?>
</a>

<div id="page" class="site">

	<header id="masthead" class="site-header" data-header>
		<div class="container-grid site-header__inner">
			<div class="content flex items-center justify-between gap-6 py-4">

				<div class="site-branding">
					<?php slodoks_element( 'site-logo' ); ?>
				</div><!-- .site-branding -->

				<nav
					id="site-navigation"
					class="main-nav"
					aria-label="<?php esc_attr_e( 'Основное меню', 'slodoks' ); ?>"
				>
					<?php
					if ( has_nav_menu( 'header-menu' ) ) {
						wp_nav_menu(
							[
								'theme_location' => 'header-menu',
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'main-nav__list',
								'container'      => '',
								// Flat for now: submenu styles are in menu.css
								// and switch on by raising this to 2.
								'depth'          => 1,
							]
						);
					}
					?>

					<a class="btn btn-cta btn-sm main-nav__cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
						<?php esc_html_e( 'Записаться', 'slodoks' ); ?>
					</a>
				</nav><!-- #site-navigation -->

				<button
					type="button"
					class="nav-toggle"
					aria-controls="site-navigation"
					aria-expanded="false"
					data-nav-toggle
				>
					<span class="nav-toggle__box" aria-hidden="true">
						<span class="nav-toggle__bar"></span>
					</span>
					<span class="screen-reader-text"><?php esc_html_e( 'Меню', 'slodoks' ); ?></span>
				</button>

			</div>
		</div>
	</header><!-- #masthead -->
