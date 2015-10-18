<?php

/**
 * @class       Paypal_Donation_For_WordPress_Public
 * @version	1.0.0
 * @package	paypal-donation-for-wordpress
 * @category	Class
 * @author      johnny manziel <phpwebcreators@gmail.com>
 */
class Paypal_Donation_For_WordPress_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->paypal_donation_for_wordpress_add_shortcode();
        add_filter('widget_text', 'do_shortcode');
    }

    public function paypal_donation_for_wordpress_add_shortcode() {
        add_shortcode('paypal_donation_button', array($this, 'paypal_donation_for_wordpress_button_generator'));
    }

    public function paypal_donation_for_wordpress_button_generator() {

        $paypal_donation_for_wordpress_custom_button = get_option('paypal_donation_for_wordpress_custom_button');
        $paypal_donation_for_wordpress_button_image = get_option('paypal_donation_for_wordpress_button_image');
        $paypal_donation_for_wordpress_reference = get_option('paypal_donation_for_wordpress_reference');
        $paypal_donation_for_wordpress_purpose = get_option('paypal_donation_for_wordpress_purpose');
        $paypal_donation_for_wordpress_amount = get_option('paypal_donation_for_wordpress_amount');
        $paypal_donation_for_wordpress_notify_url = site_url('?Paypal_Donation_For_WordPress&action=ipn_handler');
        $paypal_donation_for_wordpress_return_page = get_option('paypal_donation_for_wordpress_return_page');
        $paypal_donation_for_wordpress_currency = get_option('paypal_donation_for_wordpress_currency');
        $paypal_donation_for_wordpress_bussiness_email = get_option('paypal_donation_for_wordpress_bussiness_email');
        $paypal_donation_for_wordpress_PayPal_sandbox = get_option('paypal_donation_for_wordpress_PayPal_sandbox');
        $paypal_donation_for_wordpress_button_label = get_option('paypal_donation_for_wordpress_button_label');


        if (isset($paypal_donation_for_wordpress_button_image) && !empty($paypal_donation_for_wordpress_button_image)) {
            switch ($paypal_donation_for_wordpress_button_image) {
                case 'button1':
                    $button_url = 'https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif';
                    break;
                case 'button2':
                    $button_url = 'https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif';
                    break;
                case 'button3':
                    $button_url = 'https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif';
                    break;
                case 'button4':
                    $button_url = 'https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png';
                    break;
                case 'button5':
                    $button_url = 'https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png';
                    break;
                case 'button6':
                    $button_url = 'https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png';
                    break;
                case 'button7':
                    $button_url = 'https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png';
                    break;
                case 'button8':
                    $button_url = 'https://www.paypalobjects.com/en_AU/i/btn/x-click-but11.gif';
                    break;
                case 'button9':
                    $button_url = 'https://www.paypalobjects.com/en_AU/i/btn/x-click-but21.gif';
                    break;
				 case 'button10':
                    $button_url = get_option('paypal_donation_for_wordpress_custom_button');
                    break;
            }
        } elseif (isset($paypal_donation_for_wordpress_custom_button) && !empty($paypal_donation_for_wordpress_custom_button)) {
            $button_url = $paypal_donation_for_wordpress_custom_button;
        } else {
            $button_url = 'https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif';
        }

        if (isset($paypal_donation_for_wordpress_PayPal_sandbox) && $paypal_donation_for_wordpress_PayPal_sandbox == 'yes') {
            $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        } else {
            $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
        }

        ob_start();

		$output = '';
        $output = '<div class="page-sidebar widget">';

        $output .= '<form action="' . esc_url($paypal_url) . '" method="post" target="_blank">';

        if (isset($paypal_donation_for_wordpress_button_label) && !empty($paypal_donation_for_wordpress_button_label)) {
            $output .= '<p><label for=' . esc_attr($paypal_donation_for_wordpress_button_label) . '>' . esc_attr($paypal_donation_for_wordpress_button_label) . '</label></p>';
        }

        $output .= '<input type="hidden" name="business" value="' . esc_attr($paypal_donation_for_wordpress_bussiness_email) . '">';

        $output .= '<input type="hidden" name="bn" value="mbjtechnolabs_SP">';

        $output .= '<input type="hidden" name="cmd" value="_donations">';

        if (isset($paypal_donation_for_wordpress_purpose) && !empty($paypal_donation_for_wordpress_purpose)) {
            $output .= '<input type="hidden" name="item_name" value="' . esc_attr($paypal_donation_for_wordpress_purpose) . '">';
        } else {
            $output .= '<input type="hidden" name="item_name" value="cup of coffee">';
        }

        if (isset($paypal_donation_for_wordpress_reference) && !empty($paypal_donation_for_wordpress_reference)) {
            $output .= '<input type="hidden" name="item_number" value="' . esc_attr($paypal_donation_for_wordpress_reference) . '">';
        } else {
            $output .= '<input type="hidden" name="item_number" value="cup of coffee">';
        }


        if (isset($paypal_donation_for_wordpress_amount) && !empty($paypal_donation_for_wordpress_amount)) {
            $output .= '<input type="hidden" name="amount" value="' . esc_attr($paypal_donation_for_wordpress_amount) . '">';
        }

        if (isset($paypal_donation_for_wordpress_currency) && !empty($paypal_donation_for_wordpress_currency)) {
            $output .= '<input type="hidden" name="currency_code" value="' . esc_attr($paypal_donation_for_wordpress_currency) . '">';
        }

        if (isset($paypal_donation_for_wordpress_notify_url) && !empty($paypal_donation_for_wordpress_notify_url)) {
            $output .= '<input type="hidden" name="notify_url" value="' . esc_url($paypal_donation_for_wordpress_notify_url) . '">';
        }

        if (isset($paypal_donation_for_wordpress_return_page) && !empty($paypal_donation_for_wordpress_return_page)) {
            $paypal_donation_for_wordpress_return_page = get_permalink($paypal_donation_for_wordpress_return_page);
            $output .= '<input type="hidden" name="return" value="' . esc_url($paypal_donation_for_wordpress_return_page) . '">';
        }

        $output .= '<input type="image" name="submit" border="0" src="' . esc_url($button_url) . '" alt="PayPal - The safer, easier way to pay online">';
        $output .= '</form></div>';

        return $output;
        return ob_get_clean();
    }

}

