<?php

/**
 * Adds a link to the Loginpetze setting screen to the plugins menu.
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists( 'loginpetze_plugin_action_links' ) ) {

	/**
	 * @param $links array WordPress standard action links
	 *
	 * @return array containing link to be added to the action link list
	 */
	function loginpetze_plugin_action_links( $links ) {

		$loginpetze_links = array(
			/* translators: action link (displayed in the Plugins list table) */
			'<a href="options-general.php?page=loginpetze-options">'. __( 'Settings', 'loginpetze' ) . '</a>'
		);

		return array_merge( $links, $loginpetze_links );

	}

}