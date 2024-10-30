<?php

/**
 * This file builds a default subject line for the notification email
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */


if ( ! function_exists( 'loginpetze_build_default_subject' ) ) {

	/**
	 * Builds a default subject line for the notification email
	 * @return array containing the default subject line
	 */
	function loginpetze_build_default_subject() {

		/* translators: default text for mail subject; don't translate the placeholders [username] and [blogname] */
		$default_subject = __( 'User [username] logged in to [blogname]', 'loginpetze' );

		$result = array(
			'custom_subject' => $default_subject,
		);

		return $result;

	}

}