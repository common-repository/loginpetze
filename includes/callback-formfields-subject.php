<?php

/**
 * On the settings screen, this file generates the input field for the subject line of the notification mails.
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */

if ( ! function_exists('loginpetze_formfields_subject_callback' ) ) {

	/**
	 * @param $args object coming from add_settings_fields in the main init section
	 */
	function loginpetze_formfields_subject_callback( $args ) {

		/*
		 * retrieve settings for Loginpetze from database
		 * @var $loginpetze_options array containing all plugin settings
		 */

		$loginpetze_options = get_option( 'loginpetze_options' );

		/*
		 * Define a help text to be displayed below the input field (textarea)
		 */

		/* translators: help text below the input field (textarea) */
		$help_text = esc_html__( 'Enter the desired subject line for the notification email.', 'loginpetze' );

		?>

        <p>
            <input title="<? echo $help_text; ?>" type="text" id="subject" data-custom="<?php echo esc_attr( $args[ 'loginpetze_custom_subject' ] ); ?>"
                   name="loginpetze_options[<?php echo esc_attr( $args[ 'loginpetze_custom_subject' ] ); ?>]"
                   value="<?php echo esc_attr( $loginpetze_options[ $args[ 'loginpetze_custom_subject' ] ] ); ?>" size="50">
        </p>

        <p class="description">
	        <? echo $help_text; ?>
        </p>

		<?php

	}

}