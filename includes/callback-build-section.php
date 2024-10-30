<?php

/**
 * Within the settings page, this file sets up the required 'section'
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.1
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists( 'loginpetze_build_section_callback' ) ) {

	/**
	 * @param $args object coming from add_settings_section in the main init section
	 */
	function loginpetze_build_section_callback( $args ) {

		/*
		 * We need to retrieve some data from the database to be able to print out some examples:
		 * - Blogname
		 * - Date/Time in the correct format
		 * - Name of the current backend user
		 */

		// blog title is found in the standard options table
		$blogname       = get_option( 'blogname' );

		// date and time is found in the standard options table
		$date           = date_i18n( get_option( 'date_format' ) );
		$time           = date_i18n( get_option( 'time_format' ) );

		// current user name and details can also be found
		$current_user   = wp_get_current_user();
		$username       = esc_html( $current_user->user_login );
		$useremail      = esc_html( $current_user->user_email );
		$firstname      = esc_html( $current_user->user_firstname );
		if (empty( $firstname ) ) { $firstname = '--'; }
		$lastname       = esc_html( $current_user->user_lastname );
		if (empty( $lastname ) ) { $lastname = '--'; }
		$displayname    = esc_html( $current_user->display_name );
		if (empty( $displayname ) ) { $displayname = '--'; }

		?>

        <p class="description">

			<?php

			/*
			 * Output: short instructions what a user can do in this screen
			 */

			/* translators: help text/instructions */
			esc_html_e( 'Please select who should receive the notification mails.', 'loginpetze' );
			echo '<br />';
			/* translators: help text/instructions */
			esc_html_e( 'If you wish to change the default texts for subject or body, you can do so.', 'loginpetze' );
			echo '<br />';
			/* translators: help text/instructions */
			esc_html_e( 'There are some placeholders available. Use them as often as you want:', 'loginpetze' );
			?>

        </p>

        <p>

			<?php

			/*
			 * Output: available placeholders and examples what they are filled with
			 */

			echo '<code class="shortcodelabel">[username]</code> – ';

			printf(
			/* translators: help text explaining the placeholder [username]; %s: example for a username */
				__( 'will be replaced by the login name of the user; e.g. <code>%s</code>', 'loginpetze' ),
				$username
			);

			echo '<br />';
			echo '<code class="shortcodelabel">[useremail]</code> – ';

			printf(
			/* translators: help text explaining the placeholder [useremail]; %s: example for a mail address */
				__( 'will be replaced by the mail address of the user; e.g. <code>%s</code>', 'loginpetze' ),
				$useremail
			);

			echo '<br />';
			echo '<code class="shortcodelabel">[firstname]</code> – ';

			printf(
			/* translators: help text explaining the placeholder [firstname]; %s: example for a name */
				__( 'will be replaced by the first name of the user; e.g. <code>%s</code>', 'loginpetze' ),
				$firstname
			);

			echo '<br />';
			echo '<code class="shortcodelabel">[lastname]</code> – ';

			printf(
			/* translators: help text explaining the placeholder [lastname]; %s: example for a name */
				__( 'will be replaced by the last name of the user; e.g. <code>%s</code>', 'loginpetze' ),
				$lastname
			);

			echo '<br />';
			echo '<code class="shortcodelabel">[displayname]</code> – ';

			printf(
			/* translators: help text explaining the placeholder [displayname]; %s: example for a name */
				__( 'will be replaced by the display name of the user; e.g. <code>%s</code>', 'loginpetze' ),
				$displayname
			);
			
			echo '<br />';
			echo '<code class="shortcodelabel">[blogname]</code> – ';

			printf(
			/* translators: help text explaining the placeholder [blogname]; %s: the name of your website */
				__( 'will be replaced by your website&#x27;s name: <code>%s</code>', 'loginpetze' ),
				$blogname
			);

			echo '<br />';
			echo '<code class="shortcodelabel">[date]</code> – ';

			printf(
			/* translators: help text explaining the placeholder [datetime]; %s: example for date and time */
				__( 'will be replaced by the date corresponding to your blog settings: <code>%s</code>', 'loginpetze' ),
				$date
			);

			echo '<br />';
			echo '<code class="shortcodelabel">[time]</code> – ';

			printf(
			/* translators: help text explaining the placeholder [datetime]; %s: example for date and time */
				__( 'will be replaced by the time corresponding to your blog settings: <code>%s</code>', 'loginpetze' ),
				$time
			);
			?>

        </p>

		<?php

	}

}
