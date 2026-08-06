<?php
/**
 * Template Name: Главная
 *
 * Assign this to the page picked as the front page in Settings → Reading.
 * The layout lives in pages/home.php; this file only wires it up.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

get_header();

slodoks_page( 'home' );

get_footer();
