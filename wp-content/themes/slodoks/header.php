<?php
/**
 * The header for our theme.
 *
 * Displays the <head> section and everything up to the main content.
 * Minimal default markup — the Consal layout is integrated later.
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
	<?php esc_html_e( 'Skip to content', 'slodoks' ); ?>
</a>

<div id="page" class="site">

	<header id="masthead" class="site-header">

		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} elseif ( is_front_page() && is_home() ) {
				?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<?php
			} else {
				?>
				<p class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</p>
				<?php
			}

			$slodoks_description = get_bloginfo( 'description', 'display' );

			if ( $slodoks_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $slodoks_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Main menu', 'slodoks' ); ?>">
				<?php
				wp_nav_menu(
					[
						'theme_location' => 'header-menu',
						'menu_id'        => 'primary-menu',
						'container'      => '',
					]
				);
				?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>

	</header><!-- #masthead -->
