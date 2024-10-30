<?php
/**
 * Created by PhpStorm.
 * User: csabo
 * Date: 11.01.18
 * Time: 16:34
 */


if ( ! function_exists( 'set_default_values' ) ) {

	/**
	 * Writes the default values for email recipient, subject and mail body to the database
	 */
	function set_default_values() {

		// if we find no options for loginpetze, do set them

		if ( ! get_option( 'loginpetze_options' ) ) {

			/*
			 * Generate an array for the default email settings
			 * Default recipient is Blog Admin, to whom we assign the id 0
			 * */

			$defaults = array(
				'custom_recipient' => '0',
			);

			// add the default mail body text
			$default_subject = loginpetze_build_default_subject();
			$defaults        = array_merge( $defaults, $default_subject );

			// add the default mail body text
			$default_mailbody = loginpetze_build_default_mailbody();
			$defaults         = array_merge( $defaults, $default_mailbody );

			// write data to the options field in database
			wp_parse_args( add_option( 'loginpetze_options', $defaults ), $defaults );

		}

		add_option( 'loginpetze_db_version', LOGINPETZE_DB_VERSION );

	}

}