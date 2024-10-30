<?php

/**
 * This file adds a second level menu page to the WordPress main menu
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */


if  ( ! function_exists('loginpetze_options_page' ) ) {

        /**
         * Adds adds second level menu page to the WordPress main menu
         */
        function loginpetze_options_page() {

            // add second level menu page
            add_submenu_page(
                'options-general.php', // parent page for the submenu
                /* translators: title for the settings page */
                __( 'Loginpetze Settings', 'loginpetze' ), // page title
                /* translators: title for the submenu entry; default: the untranslated name of the plugin */
                __( 'Loginpetze', 'loginpetze' ), // menu title
                'manage_options', // capability
                'loginpetze-options', // menu slug
                'loginpetze_options_page_html'
            );

        }

    }