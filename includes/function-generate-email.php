<?php

/**
 * This file generates and sends the notification mail.
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.1
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists('loginpetze_generate_email') ) {

    /**
     * This is the plugin's core function.
     * It generates and sends the notification email.
     * It performs three steps:
     * - retrieve the plugin's settings from the database
     * - replace all placeholders with the correct values
     * - send the mail
     *
     * @param string $user_login contains the username of the user who successfully logged in, inserted by hook wp_login
     * @param object $userobject contains the WP user data of the user who successfully logged in, inserted by hook wp_login
     * @link https://developer.wordpress.org/reference/hooks/wp_login/
     */

    function loginpetze_generate_email( $user_login, $userobject ) {
		
        /*
         * retrieve all settings for Loginpetze from database
         * @var object contains all plugin settings
         */
        $loginpetze_options = get_option( 'loginpetze_options' );

        /*
         * extract the ID of the user who is supposed to receive the mail
         * @var string|int contains the ID of this user
         * */
        $recipient_id = $loginpetze_options[ 'custom_recipient' ];

        /*
         * if the returning value can be turned into integer,
         * then check if it is lower than 0;
         * if value is lower than 0, we don't have a reasonable user ID and send an error mail to the blog admin
         */

        if ( settype( $recipient_id, 'integer' ) ) {
            if ( $recipient_id < 0 ) {
                die( 'An error occured: negative value for ID. Please check settings for Loginpetze and choose an existing user as recipient.' );
            }
        }

        /*
         * retrieve the email address based on the user ID
         * @param integer $recipient_id
         * @var string $recipient_email contains the email address needed for the notifications
         */

        $recipient_email = loginpetze_retrieve_email_address( $recipient_id );

        /*
         * check if the email address is valid
         */

        if ( ! is_email( $recipient_email ) ) {
            die( 'An error occured: invalid email address found. Please check your WordPress user settings.' );
        }

        /**
         * prepare the subject for the email …
         */

        /*
         * extract the subject template from options
         */

        $subjectline = $loginpetze_options[ 'custom_subject' ];
	    sanitize_text_field( $subjectline );

        /*
         * we need to replace all placeholders with correct values
         * passing the user_login value to the replace function
         */

        $subjectline = loginpetze_fill_placeholders( $userobject, $subjectline );

        /**
         * prepare the mail body …
         */

        /*
         * extract the mail body template from options
         */

        $messagebody = $loginpetze_options[ 'custom_body' ];
	    sanitize_textarea_field( $messagebody );

        /*
         * we need to replace all placeholders with correct values
         * passing the user_login value to the replace function
         */

        $messagebody = loginpetze_fill_placeholders( $userobject, $messagebody );

        /**
         * finally, do what Loginpetze is made for:
         * send the notification email.
         * If successful, add a log entry to Simple History.
         */

        if ( wp_mail( $recipient_email, $subjectline, $messagebody ) ) {
		    require_once ( 'function-simple-history-logger.php' );
	    }

    }

}