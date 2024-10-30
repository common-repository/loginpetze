<?php

/**
 *
 * This file …
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */


/**
 * custom option and settings
 */
if ( ! function_exists('loginpetze_settings_init' ) ) {

	function loginpetze_settings_init() {

		load_plugin_textdomain( 'loginpetze', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );


		// register a new setting for "loginpetze" page
		register_setting( 'loginpetze', 'loginpetze_options' );

		// register a new section in the "loginpetze" page
		add_settings_section(
			'loginpetze_section',
			/* translators: heading on the settings screen */
			__( 'Customize your notification mails', 'loginpetze' ),
			'loginpetze_build_section_callback',
			'loginpetze'
		);

		// register a new field in the "loginpetze_section" section, inside the "loginpetze" page
		add_settings_field(
			'loginpetze_field_recipient', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			/* translators: Label for the select with possible e-mail recipients */
			__( 'Recipient', 'loginpetze' ),
			'loginpetze_formfields_recipient_callback',
			'loginpetze',
			'loginpetze_section',
			[
				'label_for'                   => 'custom_recipient',
				'class'                       => 'loginpetze_row',
				'loginpetze_custom_recipient' => 'custom_recipient',
			]
		);

		// register a new field in the "loginpetze_section" section, inside the "loginpetze" page
		add_settings_field(
			'loginpetze_field_subject', // as of WP 4.6 this value is used only internally
			/* translators: Label for the input field containing the mail subject */
			__( 'Subject', 'loginpetze' ),
			'loginpetze_formfields_subject_callback',
			'loginpetze',
			'loginpetze_section',
			[
				'label_for'                 => 'loginpetze_field_subject',
				'class'                     => 'loginpetze_row',
				'loginpetze_custom_subject' => 'custom_subject'
			]
		);

		// register a new field in the "loginpetze_section" section, inside the "loginpetze" page
		add_settings_field(
			'loginpetze_field_body', // as of WP 4.6 this value is used only internally
			/* translators: Label for the text area containing the mail body */
			__( 'Mail body', 'loginpetze' ),
			'loginpetze_formfields_body_callback',
			'loginpetze',
			'loginpetze_section',
			[
				'label_for'              => 'loginpetze_field_body',
				'class'                  => 'loginpetze_row',
				'loginpetze_custom_body' => 'custom_body',
			]
		);

	}

}