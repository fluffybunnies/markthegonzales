<?php

/**
 * @class       Paypal_Donation_For_WordPress_General_Setting
 * @version	1.0.0
 * @package	paypal-donation-for-wordpress
 * @category	Class
 * @author      johnny manziel <phpwebcreators@gmail.com>
 */
class Paypal_Donation_For_WordPress_General_Setting {

    /**
     * Hook in methods
     * @since    1.0.0
     * @access   static
     */
    public static function init() {

        add_action('paypal_donation_for_wordpress_general_setting', array(__CLASS__, 'paypal_donation_for_wordpress_general_setting_function'));
        add_action('paypal_donation_for_wordpress_email_setting', array(__CLASS__, 'paypal_donation_for_wordpress_email_setting_function'));
        add_action('paypal_donation_for_wordpress_help_setting', array(__CLASS__, 'paypal_donation_for_wordpress_help_setting'));
        add_action('paypal_donation_for_wordpress_general_setting_save_field', array(__CLASS__, 'paypal_donation_for_wordpress_general_setting_save_field'));
        add_action('paypal_donation_for_wordpress_email_setting_save_field', array(__CLASS__, 'paypal_donation_for_wordpress_email_setting_save_field'));
    }

    public static function paypal_donation_for_wordpress_email_setting_field() {
        $email_body = "Hello %first_name% %last_name%,

Thank you for your donation!

Your PayPal transaction ID is: %txn_id%
PayPal donation receiver email address: %receiver_email%
PayPal donation date: %payment_date%
PayPal donor first: %first_name%
PayPal donor last name: %last_name%
PayPal donation currency: %mc_currency%
PayPal donation amount: %mc_gross%

Thanks you very much,
Store Admin";


        update_option('paypal_donation_buttons_email_body_text_pre', $email_body);
        $settings = apply_filters('paypal_donation_buttons_email_settings', array(
            array('type' => 'sectionend', 'id' => 'email_recipient_options'),
            array('title' => __('Email settings', 'paypal-donation-buttons'), 'type' => 'title', 'desc' => __('Set your own sender name and email address. Default WordPress values will be used if empty.', 'paypal-donation-buttons'), 'id' => 'email_options'),
            array(
                'title' => __('Enable/Disable', 'paypal-donation-buttons'),
                'type' => 'checkbox',
                'desc' => __('Enable this email notification for donor', 'paypal-donation-buttons'),
                'default' => 'yes',
                'id' => 'paypal_donation_buttons_donor_notification'
            ),
            array(
                'title' => __('Enable/Disable', 'paypal-donation-buttons'),
                'type' => 'checkbox',
                'desc' => __('Enable this email notification for website admin', 'paypal-donation-buttons'),
                'default' => 'yes',
                'id' => 'paypal_donation_buttons_admin_notification'
            ),
            array(
                'title' => __('"From" Name', 'paypal-donation-buttons'),
                'desc' => '',
                'id' => 'paypal_donation_buttons_email_from_name',
                'type' => 'text',
                'css' => 'min-width:300px;',
                'default' => esc_attr(get_bloginfo('title')),
                'autoload' => false
            ),
            array(
                'title' => __('"From" Email Address', 'paypal-donation-buttons'),
                'desc' => '',
                'id' => 'paypal_donation_buttons_email_from_address',
                'type' => 'email',
                'custom_attributes' => array(
                    'multiple' => 'multiple'
                ),
                'css' => 'min-width:300px;',
                'default' => get_option('admin_email'),
                'autoload' => false
            ),
            array(
                'title' => __('Email subject', 'paypal-donation-buttons'),
                'desc' => '',
                'id' => 'paypal_donation_buttons_email_subject',
                'type' => 'text',
                'css' => 'min-width:300px;',
                'default' => 'Thank you for your donation',
                'autoload' => false
            ),
            array('type' => 'sectionend', 'id' => 'email_options'),
            array(
                'title' => __('Email body', 'paypal-donation-buttons'),
                'desc' => __('The text to appear in the Donation Email. Please read more Help section(tab) for more dynamic tag', 'paypal-donation-buttons'),
                'id' => 'paypal_donation_buttons_email_body_text',
                'css' => 'width:100%; height: 500px;',
                'type' => 'textarea',
                'editor' => 'false',
                'default' => $email_body,
                'autoload' => false
            ),
            array('type' => 'sectionend', 'id' => 'email_template_options'),
        ));

        return $settings;
    }

    public static function help() {


        echo '<p>' . __('Some dynamic tags can be included in your email template :', 'wp-better-emails') . '</p>
					<ul>
						<li>' . __('<strong>%blog_url%</strong> : will be replaced with your blog URL.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%home_url%</strong> : will be replaced with your home URL.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%blog_name%</strong> : will be replaced with your blog name.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%blog_description%</strong> : will be replaced with your blog description.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%admin_email%</strong> : will be replaced with admin email.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%date%</strong> : will be replaced with current date, as formatted in <a href="options-general.php">general options</a>.', 'wp-better-emails') . '</li>
						<li>' . __('<strong>%time%</strong> : will be replaced with current time, as formatted in <a href="options-general.php">general options</a>.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%txn_id%</strong> : will be replaced with PayPal donation transaction ID.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%receiver_email%</strong> : will be replaced with PayPal donation receiver email address%.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%payment_date%</strong> : will be replaced with PayPal donation date%.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%first_name%</strong> : will be replaced with PayPal donation first name%.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%last_name%</strong> : will be replaced with PayPal donation last name%.', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%mc_currency%</strong> : will be replaced with PayPal donation currency like USD', 'wp-better-emails') . '</li>
                                                <li>' . __('<strong>%mc_gross%</strong> : will be replaced with PayPal donation amount', 'wp-better-emails') . '</li>
                                          </ul>';
    }

    public static function paypal_donation_for_wordpress_email_setting_function() {


        $paypal_donation_for_wordpress_setting_fields = self::paypal_donation_for_wordpress_email_setting_field();
        $Html_output = new Paypal_Donation_For_WordPress_Html_output();
        ?>

        <form id="mailChimp_integration_form" enctype="multipart/form-data" action="" method="post">
            <?php $Html_output->init($paypal_donation_for_wordpress_setting_fields); ?>
            <p class="submit">
                <input type="submit" name="mailChimp_integration" class="button-primary" value="<?php esc_attr_e('Save changes', 'Option'); ?>" />
            </p>
        </form>
        <?php
    }

    public static function paypal_donation_for_wordpress_setting_fields() {

        $currency_code_options = self::get_paypal_donation_for_wordpress_currencies();

        foreach ($currency_code_options as $code => $name) {
            $currency_code_options[$code] = $name . ' (' . self::get_paypal_donation_for_wordpress_symbol($code) . ')';
        }

        $fields[] = array('title' => __('PayPal Account Setup', 'paypal-donation-for-wordpress'), 'type' => 'title', 'desc' => '', 'id' => 'general_options');

        $fields[] = array(
            'title' => __('Enable PayPal sandbox', 'paypal-donation-for-wordpress'),
            'type' => 'checkbox',
            'id' => 'paypal_donation_for_wordpress_PayPal_sandbox',
            'label' => __('Enable PayPal sandbox', 'paypal-donation-for-wordpress'),
            'default' => 'no',
            'css' => 'min-width:300px;',
            'desc' => sprintf(__('PayPal sandbox can be used to test payments. Sign up for a developer account <a href="%s">here</a>.', 'paypal-donation-for-wordpress'), 'https://developer.paypal.com/'),
        );



        $fields[] = array(
            'title' => __('PayPal Email address to receive payments', 'paypal-donation-for-wordpress'),
            'type' => 'email',
            'id' => 'paypal_donation_for_wordpress_bussiness_email',
            'desc' => __('This is the Paypal Email address where the payments will go.', 'paypal-donation-for-wordpress'),
            'default' => '',
            'placeholder' => 'you@youremail.com',
            'css' => 'min-width:300px;',
            'class' => 'input-text regular-input'
        );


        $fields[] = array(
            'title' => __('Currency', 'paypal-donation-for-wordpress'),
            'desc' => __('This is the currency for your visitors to make Payments or Donations in.', 'paypal-donation-for-wordpress'),
            'id' => 'paypal_donation_for_wordpress_currency',
            'css' => 'min-width:250px;',
            'default' => 'GBP',
            'type' => 'select',
            'class' => 'chosen_select',
            'options' => $currency_code_options
        );

        $fields[] = array('type' => 'sectionend', 'id' => 'general_options');

        $fields[] = array('title' => __('Optional Settings', 'paypal-donation-for-wordpress'), 'type' => 'title', 'desc' => '', 'id' => 'general_options');

        $fields[] = array(
            'title' => __('Button Label', 'paypal-donation-for-wordpress'),
            'type' => 'text',
            'id' => 'paypal_donation_for_wordpress_button_label',
            'desc' => __('PayPal donation button label  (Optional).', 'paypal-donation-for-wordpress'),
            'default' => '',
            'css' => 'min-width:300px;',
            'class' => 'input-text regular-input'
        );

        $fields[] = array(
            'title' => __('Return Page', 'paypal-donation-for-wordpress'),
            'id' => 'paypal_donation_for_wordpress_return_page',
            'desc' => __('URL to which the donator comes to after completing the donation; for example, a URL on your site that displays a "Thank you for your donation".', 'paypal-donation-for-wordpress'),
            'type' => 'single_select_page',
            'default' => '',
            'class' => 'chosen_select_nostd',
            'css' => 'min-width:300px;',
        );


        $fields[] = array(
            'title' => __('Amount', 'paypal-donation-for-wordpress'),
            'type' => 'text',
            'id' => 'paypal_donation_for_wordpress_amount',
            'desc' => __('The default amount for a donation (Optional).', 'paypal-donation-for-wordpress'),
            'default' => ''
        );

        $fields[] = array(
            'title' => __('Purpose', 'paypal-donation-for-wordpress'),
            'type' => 'text',
            'id' => 'paypal_donation_for_wordpress_purpose',
            'desc' => __('The default purpose of a donation (Optional).', 'paypal-donation-for-wordpress'),
            'default' => '',
            'css' => 'min-width:300px;',
            'class' => 'input-text regular-input'
        );

        $fields[] = array(
            'title' => __('Reference', 'paypal-donation-for-wordpress'),
            'type' => 'text',
            'id' => 'paypal_donation_for_wordpress_reference',
            'desc' => __('Default reference for the donation (Optional).', 'paypal-donation-for-wordpress'),
            'default' => '',
            'css' => 'min-width:300px;',
            'class' => 'input-text regular-input'
        );

        $fields[] = array('type' => 'sectionend', 'id' => 'general_options');

        $fields[] = array('title' => __('Donation Button', 'paypal-donation-for-wordpress'), 'type' => 'title', 'desc' => '', 'id' => 'general_options');

        $fields[] = array(
            'title' => __('Select Donation Button', 'paypal-donation-for-wordpress'),
            'id' => 'paypal_donation_for_wordpress_button_image',
            'default' => 'no',
            'type' => 'radio',
            'desc' => __('Select Button.', 'paypal-donation-for-wordpress'),
            'options' => array(
                'button1' => __('<img style="vertical-align: middle;" alt="small" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif">', 'paypal-donation-for-wordpress'),
                'button2' => __('<img style="vertical-align: middle;" alt="large" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif">', 'paypal-donation-for-wordpress'),
                'button3' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif">', 'paypal-donation-for-wordpress'),
                'button4' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png">', 'paypal-donation-for-wordpress'),
                'button5' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png">', 'paypal-donation-for-wordpress'),
                'button6' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png">', 'paypal-donation-for-wordpress'),
                'button7' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png">', 'paypal-donation-for-wordpress'),
                'button8' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/en_AU/i/btn/x-click-but11.gif">', 'paypal-donation-for-wordpress'),
                'button9' => __('<img style="vertical-align: middle;" alt="cards" src="https://www.paypalobjects.com/en_AU/i/btn/x-click-but21.gif">', 'paypal-donation-for-wordpress'),
                'button10' => __('Custom Button ( If you select this option then pleae enter url in Custom Button textbox, Otherwise donation button will not display. )', 'paypal-donation-for-wordpress')
            ),
        );

        $fields[] = array(
            'title' => __('Custom Button', 'paypal-donation-for-wordpress'),
            'type' => 'text',
            'id' => 'paypal_donation_for_wordpress_custom_button',
            'desc' => __('Enter a URL to a custom donation button.', 'paypal-donation-for-wordpress'),
            'default' => '',
            'css' => 'min-width:300px;',
            'class' => 'input-text regular-input'
        );



        $fields[] = array('type' => 'sectionend', 'id' => 'general_options');
        return $fields;
    }

    public static function paypal_donation_for_wordpress_general_setting_save_field() {

        $paypal_donation_for_wordpress_setting_fields = self::paypal_donation_for_wordpress_setting_fields();
        $Html_output = new Paypal_Donation_For_WordPress_Html_output();
        $Html_output->save_fields($paypal_donation_for_wordpress_setting_fields);
    }

    public static function paypal_donation_for_wordpress_email_setting_save_field() {
        $paypal_donation_for_wordpress_email_setting_field = self::paypal_donation_for_wordpress_email_setting_field();
        $Html_output = new Paypal_Donation_For_WordPress_Html_output();
        $Html_output->save_fields($paypal_donation_for_wordpress_email_setting_field);
    }

    public static function paypal_donation_for_wordpress_help_setting() {
        ?>
        <div class="postbox">
            <h2><label for="title">&nbsp;&nbsp;Plugin Usage</label></h2>
            <div class="inside">      
                <p>There are a few ways you can use this plugin:</p>
                <ol>
                    <li>Configure the options below and then add the shortcode <strong>[paypal_donation_button]</strong> to a post or page (where you want the payment button)</li>
                    <li>Call the function from a template file: <strong>&lt;?php echo do_shortcode( '[paypal_donation_button]' ); ?&gt;</strong></li>
                    <li>Use the <strong>PayPal Donation</strong> Widget from the Widgets menu</li>
                </ol>
                <p><h3>Archive of PayPal Buttons and Images</h3><br>
                The following reference pages list the localized PayPal buttons and images and their URLs.
                </p>
                <p><h4>English</h4></p>
                <ul>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/AU/">Australia</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/US-UK/">United Kingdom</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/US-UK/">United States</a></li>
                </ul>
                <p><h4>Asia-Pacific</h4></p>
                <ul>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/JP/">Japan</a></li>
                </ul>
                <p><h4>EU Non-English</h4></p>
                <ul>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/DE/">Germany</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/ES/">Spain</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/FR/">France</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/IT/">Italy</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/NL/">Netherlands</a></li>
                    <li><a target="_blank" href="https://developer.paypal.com/docs/classic/archive/buttons/PL/">Poland</a></li>
                </ul>
                <br>
                <h2> <label>Email dynamic tag list</label></h2>
                <?php self::help(); ?>
            </div></div>
        <?php
    }

    public static function paypal_donation_for_wordpress_general_setting_function() {
        $paypal_donation_for_wordpress_setting_fields = self::paypal_donation_for_wordpress_setting_fields();
        $Html_output = new Paypal_Donation_For_WordPress_Html_output();
        ?>

        <form id="mailChimp_integration_form" enctype="multipart/form-data" action="" method="post">
            <?php $Html_output->init($paypal_donation_for_wordpress_setting_fields); ?>
            <p class="submit">
                <input type="submit" name="mailChimp_integration" class="button-primary" value="<?php esc_attr_e('Save changes', 'Option'); ?>" />
            </p>
        </form>
        <?php
    }

    /**
     * Get full list of currency codes.
     * @return array
     */
    public static function get_paypal_donation_for_wordpress_currencies() {
        return array_unique(
                apply_filters('paypal_donation_for_wordpress_currencies', array(
            'AED' => __('United Arab Emirates Dirham', 'paypal-donation-for-wordpress'),
            'AUD' => __('Australian Dollars', 'paypal-donation-for-wordpress'),
            'BDT' => __('Bangladeshi Taka', 'paypal-donation-for-wordpress'),
            'BRL' => __('Brazilian Real', 'paypal-donation-for-wordpress'),
            'BGN' => __('Bulgarian Lev', 'paypal-donation-for-wordpress'),
            'CAD' => __('Canadian Dollars', 'paypal-donation-for-wordpress'),
            'CLP' => __('Chilean Peso', 'paypal-donation-for-wordpress'),
            'CNY' => __('Chinese Yuan', 'paypal-donation-for-wordpress'),
            'COP' => __('Colombian Peso', 'paypal-donation-for-wordpress'),
            'CZK' => __('Czech Koruna', 'paypal-donation-for-wordpress'),
            'DKK' => __('Danish Krone', 'paypal-donation-for-wordpress'),
            'DOP' => __('Dominican Peso', 'paypal-donation-for-wordpress'),
            'EUR' => __('Euros', 'paypal-donation-for-wordpress'),
            'HKD' => __('Hong Kong Dollar', 'paypal-donation-for-wordpress'),
            'HRK' => __('Croatia kuna', 'paypal-donation-for-wordpress'),
            'HUF' => __('Hungarian Forint', 'paypal-donation-for-wordpress'),
            'ISK' => __('Icelandic krona', 'paypal-donation-for-wordpress'),
            'IDR' => __('Indonesia Rupiah', 'paypal-donation-for-wordpress'),
            'INR' => __('Indian Rupee', 'paypal-donation-for-wordpress'),
            'NPR' => __('Nepali Rupee', 'paypal-donation-for-wordpress'),
            'ILS' => __('Israeli Shekel', 'paypal-donation-for-wordpress'),
            'JPY' => __('Japanese Yen', 'paypal-donation-for-wordpress'),
            'KIP' => __('Lao Kip', 'paypal-donation-for-wordpress'),
            'KRW' => __('South Korean Won', 'paypal-donation-for-wordpress'),
            'MYR' => __('Malaysian Ringgits', 'paypal-donation-for-wordpress'),
            'MXN' => __('Mexican Peso', 'paypal-donation-for-wordpress'),
            'NGN' => __('Nigerian Naira', 'paypal-donation-for-wordpress'),
            'NOK' => __('Norwegian Krone', 'paypal-donation-for-wordpress'),
            'NZD' => __('New Zealand Dollar', 'paypal-donation-for-wordpress'),
            'PYG' => __('Paraguayan Guaraní', 'paypal-donation-for-wordpress'),
            'PHP' => __('Philippine Pesos', 'paypal-donation-for-wordpress'),
            'PLN' => __('Polish Zloty', 'paypal-donation-for-wordpress'),
            'GBP' => __('Pounds Sterling', 'paypal-donation-for-wordpress'),
            'RON' => __('Romanian Leu', 'paypal-donation-for-wordpress'),
            'RUB' => __('Russian Ruble', 'paypal-donation-for-wordpress'),
            'SGD' => __('Singapore Dollar', 'paypal-donation-for-wordpress'),
            'ZAR' => __('South African rand', 'paypal-donation-for-wordpress'),
            'SEK' => __('Swedish Krona', 'paypal-donation-for-wordpress'),
            'CHF' => __('Swiss Franc', 'paypal-donation-for-wordpress'),
            'TWD' => __('Taiwan New Dollars', 'paypal-donation-for-wordpress'),
            'THB' => __('Thai Baht', 'paypal-donation-for-wordpress'),
            'TRY' => __('Turkish Lira', 'paypal-donation-for-wordpress'),
            'USD' => __('US Dollars', 'paypal-donation-for-wordpress'),
            'VND' => __('Vietnamese Dong', 'paypal-donation-for-wordpress'),
            'EGP' => __('Egyptian Pound', 'paypal-donation-for-wordpress'),
                        )
                )
        );
    }

    /**
     * Get Currency symbol.
     * @param string $currency (default: '')
     * @return string
     */
    public static function get_paypal_donation_for_wordpress_symbol($currency = '') {
        if (!$currency) {
            $currency = get_paypal_donation_for_wordpress_currencies();
        }

        switch ($currency) {
            case 'AED' :
                $currency_symbol = 'د.إ';
                break;
            case 'BDT':
                $currency_symbol = '&#2547;&nbsp;';
                break;
            case 'BRL' :
                $currency_symbol = '&#82;&#36;';
                break;
            case 'BGN' :
                $currency_symbol = '&#1083;&#1074;.';
                break;
            case 'AUD' :
            case 'CAD' :
            case 'CLP' :
            case 'COP' :
            case 'MXN' :
            case 'NZD' :
            case 'HKD' :
            case 'SGD' :
            case 'USD' :
                $currency_symbol = '&#36;';
                break;
            case 'EUR' :
                $currency_symbol = '&euro;';
                break;
            case 'CNY' :
            case 'RMB' :
            case 'JPY' :
                $currency_symbol = '&yen;';
                break;
            case 'RUB' :
                $currency_symbol = '&#1088;&#1091;&#1073;.';
                break;
            case 'KRW' : $currency_symbol = '&#8361;';
                break;
            case 'PYG' : $currency_symbol = '&#8370;';
                break;
            case 'TRY' : $currency_symbol = '&#8378;';
                break;
            case 'NOK' : $currency_symbol = '&#107;&#114;';
                break;
            case 'ZAR' : $currency_symbol = '&#82;';
                break;
            case 'CZK' : $currency_symbol = '&#75;&#269;';
                break;
            case 'MYR' : $currency_symbol = '&#82;&#77;';
                break;
            case 'DKK' : $currency_symbol = 'kr.';
                break;
            case 'HUF' : $currency_symbol = '&#70;&#116;';
                break;
            case 'IDR' : $currency_symbol = 'Rp';
                break;
            case 'INR' : $currency_symbol = 'Rs.';
                break;
            case 'NPR' : $currency_symbol = 'Rs.';
                break;
            case 'ISK' : $currency_symbol = 'Kr.';
                break;
            case 'ILS' : $currency_symbol = '&#8362;';
                break;
            case 'PHP' : $currency_symbol = '&#8369;';
                break;
            case 'PLN' : $currency_symbol = '&#122;&#322;';
                break;
            case 'SEK' : $currency_symbol = '&#107;&#114;';
                break;
            case 'CHF' : $currency_symbol = '&#67;&#72;&#70;';
                break;
            case 'TWD' : $currency_symbol = '&#78;&#84;&#36;';
                break;
            case 'THB' : $currency_symbol = '&#3647;';
                break;
            case 'GBP' : $currency_symbol = '&pound;';
                break;
            case 'RON' : $currency_symbol = 'lei';
                break;
            case 'VND' : $currency_symbol = '&#8363;';
                break;
            case 'NGN' : $currency_symbol = '&#8358;';
                break;
            case 'HRK' : $currency_symbol = 'Kn';
                break;
            case 'EGP' : $currency_symbol = 'EGP';
                break;
            case 'DOP' : $currency_symbol = 'RD&#36;';
                break;
            case 'KIP' : $currency_symbol = '&#8365;';
                break;
            default : $currency_symbol = '';
                break;
        }

        return apply_filters('paypal_donation_for_wordpress_currency_symbol', $currency_symbol, $currency);
    }

}

Paypal_Donation_For_WordPress_General_Setting::init();
