<?php

/**
 * Add an entry to the Simple History log (if Simple History is installed)
 * @link https://wordpress.org/plugins/simple-history/
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.1
 * @since           1.1
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( function_exists("SimpleLogger") ) {

	$loginpetze_logmessage =
		sprintf(
		/* translators: Log entry for Simple History; %s is the recipient's email address */
			__( 'Login notification sent to "%s".', 'loginpetze' ),
			$recipient_email
		);

	/* translators: the name of the plugin */
	$loginpetze_pluginname = __( 'Loginpetze', 'loginpetze' );

	SimpleLogger()->info(
		$loginpetze_logmessage ,
		array(
			'_initiator' => $loginpetze_pluginname
		)

	);

}