<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://shopitpress.com
 * @since      1.0.0
 *
 * @package    Sip_Advanced_Email_Notification_For_Woocommerce_Free
 * @subpackage Sip_Advanced_Email_Notification_For_Woocommerce_Free/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Sip_Advanced_Email_Notification_For_Woocommerce_Free
 * @subpackage Sip_Advanced_Email_Notification_For_Woocommerce_Free/includes
 * @author     ShopitPress <hello@shopitpress.com>
 */
class Sip_Advanced_Email_Notification_For_Woocommerce_Free {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Sip_Advanced_Email_Notification_For_Woocommerce_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = SIP_AENWCF_PLUGIN_SLUG;
		$this->version = SIP_AENWCF_VERSION;

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		/* add_action('plugins_loaded', array( $this, 'update_databases' )); */
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Sip_Advanced_Email_Notification_For_Woocommerce_Loader. Orchestrates the hooks of the plugin.
	 * - Sip_Advanced_Email_Notification_For_Woocommerce_i18n. Defines internationalization functionality.
	 * - Sip_Advanced_Email_Notification_For_Woocommerce_Admin. Defines all hooks for the admin area.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once SIP_AENWCF_DIR . 'includes/class-sip-advanced-email-notification-for-woocommerce-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once SIP_AENWCF_DIR . 'includes/class-sip-advanced-email-notification-for-woocommerce-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once SIP_AENWCF_DIR . 'admin/class-sip-advanced-email-notification-for-woocommerce-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the post-tab
		 * side of the site.
		 */
		require_once SIP_AENWCF_DIR . 'includes/class-sip-advanced-email-notification-for-woocommerce-post-tab.php';
		require_once SIP_AENWCF_DIR . 'includes/class-sip-advanced-email-notification-for-woocommerce-mail-log-tab.php';

		$this->loader = new Sip_Advanced_Email_Notification_For_Woocommerce_Loader_Free();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Sip_Advanced_Email_Notification_For_Woocommerce_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Sip_Advanced_Email_Notification_For_Woocommerce_i18n_Free();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Sip_Advanced_Email_Notification_For_Woocommerce_Admin_Free( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Sip_Advanced_Email_Notification_For_Woocommerce_Loader_Free    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	public function recursive_sanitize_text_field($array) {
		foreach ( $array as $key => &$value ) {
			if ( is_array( $value ) ) {
				$value = recursive_sanitize_text_field($value);
			}
			else {
				$value = sanitize_text_field( $value );
			}
		}
	
		return $array;
	}

}
