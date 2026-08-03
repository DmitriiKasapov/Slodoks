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

				<?php
				// The site title carries the h1 only on the front page; inner
				// pages keep their own heading as the first level.
				$slodoks_title_tag = ( is_front_page() && is_home() ) ? 'h1' : 'p';
				?>
				<div class="site-branding">
					<<?php echo esc_attr( $slodoks_title_tag ); ?> class="site-title">
						<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php if ( has_custom_logo() ) : ?>
								<?php the_custom_logo(); ?>
							<?php else : ?>
								<span class="site-logo__mark" aria-hidden="true">SD</span>
								<span class="site-logo__text"><?php bloginfo( 'name' ); ?></span>
							<?php endif; ?>
						</a>
					</<?php echo esc_attr( $slodoks_title_tag ); ?>>
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
