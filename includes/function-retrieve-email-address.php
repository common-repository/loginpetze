<?php

/**
 * This file retrieves the email address for a given user id.
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists('loginpetze_retrieve_email_address' ) ) {

    /**
     * This function will retrieve the correct email address for a given user id
     *
     * @param integer $recipient_id contains the id of the user whose email address we need
     *
     * @return string returns the desired email address
     */

    function loginpetze_retrieve_email_address( $recipient_id ) {

        /*
         * User id 0 represents (in this plugin) the Blog Admin
         */

        if ( 0 == $recipient_id ) {
            if ( $address = get_option( 'admin_email' ) ) {
                return $address;
            }
            else {
                die( 'Error retrieving Blog Admin&#39;s email address. Please check your settings for WordPress and Loginpetze.' );
            }
        }

        /*
         * Any other user id will have an email address within the database
         */
        else {
            /*
             * get the user from database by ID
             * @var object $user contains the User object
             */
            if ( $user = get_user_by('id' , $recipient_id ) ) {
                // we found a user for the given id, now return their email address
                return $user->user_email;
            }
            else {
                // we did NOT find a user for the given id
	            die( 'Error: user not found. Please check your settings for WordPress and Loginpetze.' ); // todo: better error handling
            }

        }

    }

}
