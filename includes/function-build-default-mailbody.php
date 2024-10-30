<?php

/**
 * This file builds a default mail body text to be inserted in the textarea field within the form
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */


if ( ! function_exists( 'loginpetze_build_default_mailbody' ) ) {

	/**
	 * Builds a default mail body text to be inserted in the textarea field within the form
	 * @return array containing the default mail body text
	 */
	function loginpetze_build_default_mailbody() {

		/* translators: default text for mail body */
		$default_mailbody  = __( 'Login successful', 'loginpetze' );
		$default_mailbody .= "\n"; // double quotation marks are mandatory

		/* translators: default text for mail body; don't translate the placeholder [username] */
		$default_mailbody .= __( 'User: [username]', 'loginpetze' );
		$default_mailbody .= "\n"; // double quotation marks are mandatory

		/* translators: default text for mail body; don't translate the placeholder [blogname] */
		$default_mailbody .= __( 'Blog: [blogname]', 'loginpetze' );
		$default_mailbody .= "\n\n"; // double quotation marks are mandatory

		/* translators: default text for mail body; don't translate the placeholders [date] and [time] */
		$default_mailbody .= __( 'Time: [date] at [time]', 'loginpetze' );
		$default_mailbody .= "\n\n"; // double quotation marks are mandatory

		$default_mailbody .= '--';
		$default_mailbody .= "\n"; // double quotation marks are mandatory
		/* translators: default email signature; line 1 of 2 */
		$default_mailbody .= __( 'Greetings', 'loginpetze' );
		$default_mailbody .= "\n"; // double quotation marks are mandatory
		/* translators: the name of the plugin in the default email singature, line 2 of 2 */
		$default_mailbody .= __( 'Loginpetze', 'default email signature', 'loginpetze' );

		$result = array(
			'custom_body' => $default_mailbody,
		);

		return $result;

	}

}