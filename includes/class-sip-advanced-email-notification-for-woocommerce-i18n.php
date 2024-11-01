<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://shopitpress.com
 * @since      1.0.0
 *
 * @package    Sip_Advanced_Email_Notification_For_Woocommerce_Free
 * @subpackage Sip_Advanced_Email_Notification_For_Woocommerce_Free/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sip_Advanced_Email_Notification_For_Woocommerce_Free
 * @subpackage Sip_Advanced_Email_Notification_For_Woocommerce_Free/includes
 * @author     ShopitPress <hello@shopitpress.com>
 */
class Sip_Advanced_Email_Notification_For_Woocommerce_i18n_Free {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sip-advanced-email-notification-for-woocommerce-free',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
