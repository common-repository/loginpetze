<?php

/**
 * This file checks if notifications for the logging in user have to be blocked.
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.4
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists('loginpetze_check_blockers') ) {

    /**
     * @param string $user_login contains the username of the user who successfully logged in, inserted by hook wp_login
     * @param object $userobject contains the WP user data of the user who successfully logged in, inserted by hook wp_login
     * @link https://developer.wordpress.org/reference/hooks/wp_login/
     */
	
	
    function loginpetze_check_blockers( $user_login, $userobject ) {
		
		
		/*
		* Gather information about the current user who logs in:
		* We need username, ID and roles.
		*/
		
		$username_to_check	= $user_login;
		$id_to_check		= $userobject->ID;
		$roles_to_check		= $userobject->roles;
		
		
		/*
		* Merge username, ID and roles into one single array
		*/
		
		$array_to_check		= $roles_to_check;
		array_push( $array_to_check, $id_to_check );
		array_push( $array_to_check, $username_to_check );


		/*
		* Setting up the ignorelist: create an empty array and
		* merge it with the array from the filter
		*/
		
		$ignorelist = array();
		$ignorelist = apply_filters( 'loginpetze_blockers', $ignorelist );
		
		
		/*
		* If there's no match between ignorelist and the current user's data,
		* we can send the notification mail
		*/

		if ( empty ( array_intersect( $ignorelist, $array_to_check ) ) ) {
			loginpetze_generate_email( $user_login, $userobject );
		}
					
	}

}