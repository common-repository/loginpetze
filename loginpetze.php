<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordpress.org/plugins/loginpetze/
 * @since             1.0
 * @package           Loginpetze
 *
 * @wordpress-plugin
 * Plugin Name:       Loginpetze
 * Plugin URI:        https://wordpress.org/plugins/loginpetze/
 * Description:       Notifies the admin by email as soon as a user has successfully logged in.
 * Version:           1.4
 * Author:            Christian Sabo
 * Author URI:        https://profiles.wordpress.org/pixelverbieger
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       loginpetze
 * Domain Path:       /languages
 *
 * Loginpetze is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Loginpetze is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Loginpetze. If not, see http://www.gnu.org/licenses/gpl-2.0.txt.
 */

/*
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
	die( 'Direct access is not allowed.' );
}


/*
 * For future reference, we define a version number for the options
 */
define( 'LOGINPETZE_DB_VERSION', '1.0' );

define( 'LOGINPETZE_REQUIRED_PHP_VERSION', '5.5' );

define( 'LOGINPETZE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'LOGINPETZE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'LOGINPETZE_PLUGIN_BASE_NAME', plugin_basename( __FILE__ ) );
define( 'LOGINPETZE_PLUGIN_FILE', basename( __FILE__ ) );
define( 'LOGINPETZE_PLUGIN_FULL_PATH', __FILE__ );


/*
 * Before we begin, let's load some functions.
 */
require_once ('includes/function-check-php.php');

loginpetze_check_php();

require_once( 'includes/_loader.php' );

/*
 * When activating the plugin, we need to set some default values
 */

if ( ! is_multisite() ) {
    register_activation_hook( __FILE__, 'set_default_values' );
}

if ( is_multisite() ) {
    /* translators: Notice */
    $message = esc_html_e( 'Loginpetze 1.x does not work on Multisite, I regret.', 'loginpetze');
    die($message);
}

/*
 * When deactivating the plugin, nothing has to be done.
 */

/*
 * When deleting the plugin, the file 'uninstall.php' will be called automatically.
 */


/*
 * Main purpose:
 * If a user successfully logged in, check the ignorelist
 * and see if we have to send a notification email
 */

add_action( 'wp_login', 'loginpetze_check_blockers', 10, 2 );


/*
 * Actions when entering the backend
 */

if ( is_admin() ) {


	/**
	 * register a stylesheet
	 */

	add_action( 'admin_enqueue_scripts', 'loginpetze_register_stylesheet' );


	/**
	 * register our loginpetze_settings_init to the admin_init action hook
	 */

	add_action( 'admin_init', 'loginpetze_settings_init' );


	/**
	 * register our loginpetze_options_page to the admin_menu action hook
	 */

	add_action( 'admin_menu', 'loginpetze_options_page' );


	/*
	 * When deleting a user, it might be necessary to display a warning
	 */

	add_action( 'delete_user_form', function ( $whatever, array $userids ) {

		loginpetze_warning_before_deleting_user( $userids );

	}, 10, 2 );


	/*
	 * When displaying the plugin list, add an action link to Loginpetze -> Settings
	 */

	add_filter( 'plugin_action_links_' . LOGINPETZE_PLUGIN_BASE_NAME, 'loginpetze_plugin_action_links' );

}
