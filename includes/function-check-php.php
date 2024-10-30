<?php

/**
 * Checks if the server PHP version meets the required minimum.
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.1
 * @since           1.1
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists( 'loginpetze_check_php' ) ) {

	/**
	 * This function deletes all entries in the WP options table which are related to Loginpetze
	 */
	function loginpetze_check_php() {

		if ( version_compare(PHP_VERSION, LOGINPETZE_REQUIRED_PHP_VERSION, '<') ) {

			$message =  printf(
			/* translators: 1: required PHP version 2: active PHP version */
				__( 'Loginpetze can not be activated. It requires PHP %1$s or higher. Your PHP Version is %2$s.', 'loginpetze' ),
				LOGINPETZE_REQUIRED_PHP_VERSION,
				PHP_VERSION
			);

			wp_die($message);
		};

	}

}