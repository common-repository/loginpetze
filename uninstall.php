<?php

/**
 * This file is automatically called by Wordpress if the plugin is deleted via the Dashboard link.
 * It deletes the Loginpetze options from the WordPress database.
 * WordPress itself will delete the plugin files.
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

/*
 * Directly calling this file is forbidden, so exit
 */
if ( ! defined( 'ABSPATH' ) || ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();  // silence is golden
}


require_once ('includes/function-delete-options.php');

loginpetze_delete_options();

// I hope you enjoyed my plugin.