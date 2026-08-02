<?php
/**
 * Template helpers used across theme templates.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add the Bootstrap `nav-link` class to menu links.
 *
 * Applied via `nav_menu_link_attributes` around the header menu only, so the
 * footer menu keeps its own markup.
 *
 * @param array $atts Link attributes.
 * @return array
 */
function slodoks_nav_link_atts( array $atts ): array {
	$atts['class'] = 'nav-link';

	return $atts;
}
