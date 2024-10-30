<?php

/**
 * Deletes all entries in the WP options table which are related to Loginpetze.
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists( 'loginpetze_delete_options' ) ) {

	/**
	 * This function deletes all entries in the WP options table which are related to Loginpetze
	 */
	function loginpetze_delete_options() {

		delete_option( 'loginpetze_options' );
		delete_option( 'loginpetze_db_version' );

	}

}