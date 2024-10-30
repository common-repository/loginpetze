<?php

/**
 * This file will generate an admin notice if someone is about to delete users and one of these users is the recipient for the Loginpetze notification mails.
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */



if ( ! function_exists( 'loginpetze_warning_before_deleting_user' ) ) {

    /**
     * This function will warn the admin if they are about to delete a user who is set as an email recipient for Loginpetze
     *
     * @param array $userids Array of IDs for users being deleted, inserted by hook (and callback) delete_user_form
     * @link https://developer.wordpress.org/reference/hooks/delete_user_form/
     *
     */

    function loginpetze_warning_before_deleting_user( $userids ) {

        /*
         * retrieve settings for Loginpetze from database
         * @var $loginpetze_options array containing all plugin settings
         */
        $loginpetze_options = get_option( 'loginpetze_options' );

        /*
         * extract the stored ID of the user who is supposed to receive the mail
         * @var $recipient_id string|int contains the ID of this user
         */

        $recipient_id = $loginpetze_options[ 'custom_recipient' ];

        /*
         * get user_login from database using the given ID
         * @param1 string $field The field to retrieve the user with. id | ID | slug | email | login.
         * @param2 int|string A value for $field. A user ID, slug, email address, or login name.
         * return value: WP_User object on success, false on failure.
         */

        $user_login = get_user_by('id', $recipient_id );

        /*
         * extract string from object
         */

	    $user_login = $user_login->user_login;

	    /*
	     * Now we need to iterate through the given array of IDs for users being deleted
	     */

        foreach ( $userids as $key => $delete_candidate ) {

            /*
             * In case any given id equals to the recipient's id in the database, we want an admin notice to appear
             * */

            if ( $delete_candidate == $recipient_id ) {

                ?>

                <div class="notice notice-warning is-dismissible">
                    <p>

	                    <?php

                        printf(
                                /* translators: 1: user id (number), 2: user login name */
                                __( 'User %1$s (%2$s) is set to receive the login notifications by Loginpetze.', 'loginpetze' ),
                                $delete_candidate,
                                $user_login);

                        echo ' ';

                        if ( current_user_can( 'manage_options')) {

                            printf(
                            /* translators: 1: link to the Loginpetze settings page */
                                __( 'You might want to check the <a href="%s">settings</a> before you proceed.', 'loginpetze' ),
                                'options-general.php?page=loginpetze-options'
                            );

                        }

                        ?>

                    </p>
                </div>

                <?php
            }

        }

    }

}