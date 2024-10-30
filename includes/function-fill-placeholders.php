<?php

/**
 * This function will replace the placeholders with the respective data for each field.
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.1
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists('loginpetze_fill_placeholders') ) {

    /**
     * This function will replace the placeholders with the respective data for each field.
     *
     * @param object $userobject contains the WP user data of the user who successfully logged in, inserted by hook wp_login
     * @link https://developer.wordpress.org/reference/hooks/wp_login/
     *
     * @param string $haystack contains the text to edit, including the placeholders
     *
     * @return string returns text (containing the correct data)
     */

    function loginpetze_fill_placeholders( $userobject, $haystack ) {

        /*
         * retrieve the name of the blog/website from database
         */
        $replace_blogname       = get_option( 'blogname' );

        /*
         * retrieve the date and time format from wp settings
         * and prepare the strings for output
         */
        $replace_date       = date_i18n( get_option( 'date_format' ) );
        $replace_time       = date_i18n( get_option( 'time_format' ) );

        /*
         * now we need to do some search and replace
         */
        $haystack = str_replace('[blogname]',       $replace_blogname,              $haystack );
	    $haystack = str_replace('[date]',           $replace_date,                  $haystack );
	    $haystack = str_replace('[time]',           $replace_time,                  $haystack );

        $haystack = str_replace('[username]',       $userobject->user_login,        $haystack );
        $haystack = str_replace('[useremail]',      $userobject->user_email,        $haystack );
        $haystack = str_replace('[firstname]',      $userobject->user_firstname,    $haystack );
        $haystack = str_replace('[lastname]',       $userobject->user_lastname,     $haystack );
        $haystack = str_replace('[displayname]',    $userobject->display_name,      $haystack );

        /*
         * return the text containing the correct data
         */
        return $haystack;

    }

}