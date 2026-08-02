<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elementor
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,700|Anton" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<?php wp_body_open(); ?>

<div class="site-wrap"  id="home-section">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
      
    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center position-relative">
          
            
            <div class="site-logo">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-black"><span class="text-primary"><?php bloginfo( 'name' ); ?></a>
            </div>
            
              <nav class="site-navigation text-center ml-auto" role="navigation">

			  	<?php

				
				add_filter( 'nav_menu_link_attributes', 'elementor_add_link_atts');

					wp_nav_menu(
						array(
							'theme_location' => 'header-menu',
							'menu_id'        => 'primary-menu',
							'menu_class'     =>  'site-menu main-menu js-clone-nav ml-auto d-none d-lg-block',
							'container'      =>  '',
						)
					);

					remove_filter( 'nav_menu_link_attributes', 'elementor_add_link_atts');
				?>
                
              </nav>
          
            

          <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>


