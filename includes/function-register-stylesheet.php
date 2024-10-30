<?php

/**
 * Register a stylesheet for Loginpetze
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.3
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists( 'loginpetze_register_stylesheet' ) ) {

	/**
	 * This function registers the stylesheet file for Loginpetze
	 */

	function loginpetze_register_stylesheet() {

			wp_register_style('stylesheet', LOGINPETZE_PLUGIN_URL . 'stylesheet.css' );
			wp_enqueue_style('stylesheet');

	}

}