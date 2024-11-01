<?php
/**
 * 
 * @link              https://shopitpress.com
 * @since             1.0.0
 * @package           Sip_Advanced_Email_Notification_For_Woocommerce_Free
 *
 * @wordpress-plugin
 * Plugin Name:       SIP Advanced Email Notifications for WC Free
 * Plugin URI:        https://shopitpress.com/plugins/sip-advanced-email-notifications-for-woocommerce/
 * Description:       WooCommerce add-on: For creating follow up emails for customers based on any criteria.
 * Version:           1.0.4
 * Author:            ShopitPress
 * Author URI:        https://shopitpress.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Copyright:		  © 2015 ShopitPress(email: hello@shopitpress.com)
 * Text Domain:       sip-advanced-email-notifications-for-wc-free
 * Domain Path:       /languages
 * WC requires at least: 2.6.0
 * WC tested up to: 6.5.1
 * Tested up to: 6.0
 * Last updated on: 16 Mar, 2021
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SIP_AENWCF_NAME', 'SIP Advanced Email Notifications for WC Free' );
define( 'SIP_AENWCF_ITEM_ID', '4398' );
define( 'SIP_AENWCF_VERSION', '1.0.4' );
define( 'SIP_AENWCF_PLUGIN_SLUG', 'sip-advanced-email-notifications-for-wc-free' );
define( 'SIP_AENWCF_BASENAME', plugin_basename( __FILE__ ) );
define( 'SIP_AENWCF_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'SIP_AENWCF_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

define( 'SIP_AENWCF_STORE_URL', 'https://shopitpress.com' );
define( 'SIP_AENWCF_PLUGIN_PURCHASE_URL', 'https://shopitpress.com/plugins/sip-advanced-email-notifications-for-woocommerce/' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sip-advanced-email-notification-for-woocommerce-activator.php
 */
function sip_aenwc_activate() {
	$apl = get_option('active_plugins');
	
	if(in_array("sip-advanced-email-notifications-pro-woocommerce/sip-advanced-email-notification-woocommerce.php", $apl)){
		$plugin = "sip-advanced-email-notifications-pro-woocommerce/sip-advanced-email-notification-woocommerce.php";
		deactivate_plugins( $plugin );
		add_action( 'admin_notices', 'sip_aenwc_deactivated_pro_plugin_notice' );
	}
	
	require_once SIP_AENWCF_DIR . 'includes/class-sip-advanced-email-notification-for-woocommerce-free-activator.php';
	Sip_Advanced_Email_Notification_For_Woocommerce_Activator_Free::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sip-advanced-email-notification-for-woocommerce-deactivator.php
 */
function sip_aenwc_deactivate() {
	require_once SIP_AENWCF_DIR . 'includes/class-sip-advanced-email-notification-for-woocommerce-deactivator.php';
	Sip_Advanced_Email_Notification_For_Woocommerce_Deactivator_Free::deactivate();
}

register_activation_hook( __FILE__, 'sip_aenwc_activate' );
register_deactivation_hook( __FILE__, 'sip_aenwc_deactivate' );

function sip_aenwc_register_settings_free() {
	register_setting( 'sip-advanced-eEmail-notification-settings-group', 'do_not_log_emails_sent' );
	
}
add_action( 'init', 'sip_aenwc_register_settings_free' );

function sip_aenwc_updated_init_check_free() {
// Check the transient to see if we've just updated the plugin
	if( get_transient( 'sip_aenwc_updated' ) ) {

		delete_transient( 'sip_aenwc_updated' );
	}
}
add_action( 'admin_init', 'sip_aenwc_updated_init_check_free' );

function sip_aenwc_deactivated_pro_plugin_notice(){
	$class = 'notice notice-error';
	$message = esc_html__( 'You can\'t run both plugins at the same time.', 'sip-advanced-email-notification-for-woocommerce-free' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
}


function sip_aenwc_upgrade_completed_free( $upgrader_object, $options ) {
	// The path to our plugin's main file
	$our_plugin = plugin_basename( __FILE__ );
	// If an update has taken place and the updated type is plugins and the plugins element exists
	if( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {
		// Iterate through the plugins being updated and check if ours is there
		foreach( $options['plugins'] as $plugin ) {
			if( $plugin == $our_plugin ) {
				// Set a transient to record that our plugin has just been updated
				set_transient( 'sip_aenwc_updated', 1 );
			}
		}
	}
}
add_action( 'upgrader_process_complete', 'sip_aenwc_upgrade_completed_free', 10, 2 );



/**
 * To chek the woocommerce is active or not
 *
 * @since    1.0.0
 */
function sip_aenwc_woocommerce_active_free () {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin = plugin_basename( __FILE__ );

	if( !class_exists( 'WooCommerce' ) ) {
		deactivate_plugins( $plugin );
		add_action( 'admin_notices', 'sip_aenwc_admin_notice_error_free' );
	}
}
add_action( 'plugins_loaded', 'sip_aenwc_woocommerce_active_free' , 2000);

/**
 * To display error notification
 *
 * @since    1.0.0
 */
function sip_aenwc_admin_notice_error_free() {
	$class = 'notice notice-error';
	$message = esc_html__( SIP_AENWCF_NAME . ' requires <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce</a> plugin to be active!', 'sip-advanced-email-notification-for-woocommerce-free' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require SIP_AENWCF_DIR . 'includes/class-sip-advanced-email-notification-for-woocommerce-free.php';

if ( !class_exists( 'WP_List_Table' ) ) {
	require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

global $sip_advanced_email_notification_for_woocommerce_free;
 
function sip_aenwc_run() {

	$plugin = new Sip_Advanced_Email_Notification_For_Woocommerce_Free();
	$plugin->run();

	return $plugin;
}
$sip_advanced_email_notification_for_woocommerce_free = sip_aenwc_run();


// Add Shortcode
function sip_aenwc_sip_custom_field( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'field_name' => '',
			'order_id' => '',
		),
		$atts
	);
	return get_post_meta( $atts['order_id'], $atts['field_name'], true );

}
add_shortcode( 'sip_custom_field', 'sip_aenwc_sip_custom_field' );