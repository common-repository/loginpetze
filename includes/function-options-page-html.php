<?php

/**
 * This file is the mainframe for the Loginpetze setting (options) page
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists('loginpetze_options_page_html' ) ) {

	/**
	 * This Function generates the mainframe for the Loginpetze setting (options) page
	 */
	function loginpetze_options_page_html() {

		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// show error/update messages
		settings_errors( 'loginpetze_messages' );

		?>


        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">

				<?php

				// output security fields for the registered setting "loginpetze"
				settings_fields( 'loginpetze' );

				// output setting sections and their fields
				// (sections are registered for "loginpetze")
				do_settings_sections( 'loginpetze' );

				// output save settings button
				submit_button();

				?>

            </form>

        </div>

		<?php

	}

}