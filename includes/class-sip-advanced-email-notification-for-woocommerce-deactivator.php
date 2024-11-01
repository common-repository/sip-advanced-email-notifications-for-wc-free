<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://shopitpress.com
 * @since      1.0.0
 *
 * @package    Sip_Advanced_Email_Notification_For_Woocommerce_Free
 * @subpackage Sip_Advanced_Email_Notification_For_Woocommerce_Free/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Sip_Advanced_Email_Notification_For_Woocommerce_Free
 * @subpackage Sip_Advanced_Email_Notification_For_Woocommerce_Free/includes
 * @author     ShopitPress <hello@shopitpress.com>
 */
class Sip_Advanced_Email_Notification_For_Woocommerce_Deactivator_Free {

	/**
	 * delete the sip version number on deactivation the plugin.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate( ) {

		delete_option( 'sip_version_value' );
	}
}
