<?php

/**
 * On the settings screen, this file generates the input field (select) for the recipient of the notification mails.
 *
 * @author          Christian Sabo
 * @link            https://profiles.wordpress.org/pixelverbieger
 *
 * @version         1.0
 * @since           1.0
 * @package         Loginpetze
 * @link            https://wordpress.org/plugins/loginpetze/
 */


if ( ! function_exists('loginpetze_formfields_recipient_callback' ) ) {

    /**
     * This function generates the input field (select) for the recipient of the notification mails
     * @param $args object coming from add_settings_fields in the main init section
     */
    function loginpetze_formfields_recipient_callback( $args )
    {

        /*
         * retrieve settings for Loginpetze from database
         * @var $loginpetze_options array containing all plugin settings
         */

        $loginpetze_options = get_option( 'loginpetze_options' );

        global $item_to_preselect;
        $item_to_preselect = esc_attr($loginpetze_options[$args['loginpetze_custom_recipient']]);

        /*
         * Next step: build up the <select> and its <option> items
         */

	    global $loginpetze_output;

        $loginpetze_output = '<select id="' . esc_attr($args['label_for']) . '"';
        $loginpetze_output .= 'data-custom="' . esc_attr($args['loginpetze_custom_recipient']) . '"';
        $loginpetze_output .= 'name="loginpetze_options[' . esc_attr($args['label_for']) . ']"';
        $loginpetze_output .= '>';

        /*
         * Due to the complexity of building the list of all potential email recipients we use a separate function.
         * Return value is an array
         */

        /** @var array $potential_recipients_list_complete is an array (string id, string user_login, string user_email) */
        $potential_recipients_list_complete = build_recipient_list();

        // Check for results
        if ( empty( $potential_recipients_list_complete ) ) {

            /*
             * If this array is empty, something went terribly wrong.
             * We try to save the show and set the default blog admin as recipient.
             */

            $loginpetze_output .= '<option value="0">';
            // translators: WordPress Standard Account (Blog Admin)
            $loginpetze_output .= esc_html__( 'Blog Admin', 'loginpetze' );
            $loginpetze_output .= ' (' . get_option('admin_email') . ')';
            $loginpetze_output .= '</option>';
            $loginpetze_output .= '</select>';

        }


        if ( ! empty( $potential_recipients_list_complete ) ) {

            /*
             * If the current recipient's id can not be found in the returning list of users, set blog admin as new recipient
             */

            if ( ( ! $item_to_preselect == '0' ) AND ( ! array_search( $item_to_preselect, array_column( $potential_recipients_list_complete, 'ID' ) ) ) ) {

                // save the old user id which is no more available
                $old_item_to_preselect = $item_to_preselect;

                // set the new recipient's id to '0' for 'Blog Admin'
                $loginpetze_options[ 'custom_recipient' ] = '0';

                // write changes to database
                update_option('loginpetze_options', $loginpetze_options);

                ?>

                <div class="notice notice-warning is-dismissible">
                    <p>
                        <?php

                        /*
                         * Output: admin notice saying that the recipient has been automatically reset to Blog Admin
                         */

                        echo '<h3>'. ' ';
                        printf(
                        /* translators: headline for admin notice; %s stands for Blog Admin */
	                    __('User not available – recipient switched to <em>%s</em>.', 'loginpetze'),
	                        __( 'Blog Admin', 'loginpetze' )
                        );
                        echo '</h3>'. ' ';


                        printf(
                        /* translators: text for admin notice, paragraph 1 of 2; # is number sign; %s contains user id */
                            __('The previous recipient of the notifications (user #%s) is no longer available. The user might have been deleted or has lost Admin role.', 'loginpetze'),
                            $old_item_to_preselect
                        );

                        echo '<br />';

                        printf(
                        /* translators: text for admin notice, paragraph 2 of 2; %s is the name of the Blog Admin */
	                        __('Recipient was automatically switched to <em>%s</em>. You may want to select a new recipient.', 'loginpetze'),
	                        __( 'Blog Admin', 'loginpetze' )
                        );

                        ?>

                    </p>

                </div>

                <?php

            }

            // loop through each item in the potential recipient's list

            foreach ( $potential_recipients_list_complete as $potential_recipients_list_single_entry ) {

                // get the user's data

                $lp_user_ID     = $potential_recipients_list_single_entry[ 'ID' ];
                $lp_user_login  = $potential_recipients_list_single_entry[ 'user_login' ];
                $lp_user_email  = $potential_recipients_list_single_entry[ 'user_email' ];

                $loginpetze_output .= '<option value="' . $potential_recipients_list_single_entry[ 'ID' ] . '"';

                /*
                 * If the ID in the database equals to the one printed to the select/option, mark item as selected
                 */

                if ( $item_to_preselect == $lp_user_ID ) {
                    $loginpetze_output .= ' selected="selected" ';
                }

                $loginpetze_output .= '>';
                $loginpetze_output .= $lp_user_login . " (" . $lp_user_email . ")";
                $loginpetze_output .= '</option>';

            } // end foreach



            /*
             * Close the <select>
             */

            $loginpetze_output .= '</select>';



            /*
             * Output: the HTML code for the SELECT
             */

            echo $loginpetze_output;


            ?>


            <?php

            /*
             * Output: some lines of text explaining the recipient select box
             */

            ?>

            <p class="description">
                <?php

                /* translators: help text below the select box */
                esc_html_e('Who should receive the notifications?', 'loginpetze');
                echo '<br />';

                printf(
                /* translators: help text below the select box; %s stands for Settings &rarr; General &rarr; Email Address */
	                __( 'The default email address is taken from <b>%s</b>.', 'loginpetze' ),
	                __( 'Settings &rarr; General &rarr; Email Address', 'loginpetze' )
                );
                echo '<br />';

                printf(
                /* translators: help text below the select box */
	                __( 'All other entries are <a href="%s">accounts with Administrator role</a>.', 'loginpetze' ),
	                'users.php?role=administrator'
                );

                ?>
            </p>

            <?php

        }

    }

}