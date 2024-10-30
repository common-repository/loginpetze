<?php

/**
 * This file loads all files contained in the folder
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.1
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

require_once ( 'function-settings-init.php' );

require_once ( 'callback-build-section.php' );

require_once ( 'callback-formfields-body.php' );
require_once ( 'callback-formfields-recipient.php' );
require_once ( 'callback-formfields-subject.php' );

require_once ( 'function-build-default-mailbody.php' );
require_once ( 'function-build-default-subject.php' );
require_once ( 'function-build-recipient-list.php' );

require_once ( 'function-check-blockers.php' );
require_once ( 'function-delete-options.php' );
require_once ( 'function-fill-placeholders.php' );
require_once ( 'function-generate-email.php' );
require_once ( 'function-options-page.php' );
require_once ( 'function-options-page-html.php' );
require_once ( 'function-plugin-action-links.php' );
require_once ( 'function-register-stylesheet.php' );
require_once ( 'function-retrieve-email-address.php' );
require_once ( 'function-set-default-values.php' );
require_once ( 'function-warning-before-deleting-user.php' );