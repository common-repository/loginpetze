<?php

/**
 * This file builds a list of all users who can potentially be selected to receive the notification mails
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists( 'build_recipient_list' ) ) {

	/**
	 * Builds a list of all users who can potentially be selected to receive the notification mails
	 * @return array|mixed|object containing all users who are potentially allowed to be recipient for the notifications
	 */
	function build_recipient_list() {

		/*
		 * Step 1 in building the list: retrieve all blog users with Admin role
		 * (can be changed to Admin and Editor, e.g.), see dev manual
		 * @link https://developer.wordpress.org/reference/classes/wp_user_query/
		 */

		// prepare the arguments for the query
		$user_query_args = array(

			/*
			 * Example to extend the user roles who can receive notifications
			 *
			 * 'role__in'       => array( 'Administrator', 'Editor'),
			 */
			'role__in' => array( 'Administrator' ),
			'order'    => 'ASC',
			'fields'   => array( 'ID', 'user_login', 'user_email' ),
		);

		// Create the WP_User_Query object
		$user_query_results = new WP_User_Query( $user_query_args );

		// Get the results (still an object)
		$potential_recipients = $user_query_results->get_results();

		/*
		 * Step 2
		 * recursively turn object into an array (to be able to easily add another item)
		 * @link https://stackoverflow.com/questions/4345554/convert-php-object-to-associative-array
		 */

		$potential_recipients_list_complete = json_decode( json_encode( $potential_recipients ), true );

		/*
		 * Step 3
		 * The Blog Admin isn't a default user, but we want them to also appear in this list, so we have to
		 * - assign a name
		 * - retrieve the default blog email address from WP options
		 * - assign the user ID '0'
		 */

		/*
		 * prepare another array element
		 * */

		// translators: identifier/name for the WordPress Standard Account (Blog Admin)
		$push_element_loginname = __( 'Blog Admin', 'loginpetze' );
		$push_element_email     = get_option( 'admin_email' );
		$push_element_id        = '0';

		/*
		 * Step 4
		 * Now we need to add the entry for blog admin to the array of potential recipients
		 * @link http://de2.php.net/manual/de/function.array-push.php
		 */
		array_push( $potential_recipients_list_complete, array(
					'ID'         => $push_element_id,
					'user_login' => $push_element_loginname,
					'user_email' => $push_element_email,
		) );

		/*
		 * Step 5
		 * Sort the array so that the default entry (Blog Admin) is the first one
		 * @link http://de2.php.net/manual/de/function.asort.php
		 */
		asort( $potential_recipients_list_complete, 0 );

		/*
		 * Step 6
		 * Return the list
		 * */

		return $potential_recipients_list_complete;

	}

}