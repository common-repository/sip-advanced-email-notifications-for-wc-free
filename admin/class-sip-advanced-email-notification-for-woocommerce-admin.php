<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://shopitpress.com
 * @since      1.0.0
 *
 * @package    Sip_Advanced_Email_Notification_For_Woocommerce_Free
 * @subpackage Sip_Advanced_Email_Notification_For_Woocommerce_Free/admin
 */

define( 'SIP_AENWCF_UTM_CAMPAIGN', 'advanced-email-notification' );
define( 'SIP_AENWCF_ADMIN_VERSION' , '1.0.0' );

if ( ! defined( 'SIP_SPWCF_PLUGIN' ) )
	define( 'SIP_SPWCF_PLUGIN',  'SIP Social Proof for WooCommerce' );

if ( ! defined( 'SIP_FEBWC_PLUGIN' ) )
	define( 'SIP_FEBWC_PLUGIN', 'SIP Front End Bundler for WooCommerce' );

if ( ! defined( 'SIP_RSWC_PLUGIN' ) )
	define( 'SIP_RSWC_PLUGIN',  'SIP Reviews Shortcode for WooCommerce' );

if ( ! defined( 'SIP_AENWC_PLUGIN' ) )
	define( 'SIP_AENWC_PLUGIN',  'Sip Advanced Email Notification For Woocommerce' );

if ( ! defined( 'SIP_WPGUMBY_THEME' ) )
	define( 'SIP_WPGUMBY_THEME','WPGumby' );

if ( ! defined( 'SIP_SPWC_PLUGIN_URL' ) )
	define( 'SIP_SPWC_PLUGIN_URL',  'https://shopitpress.com/plugins/sip-social-proof-woocommerce/' );

if ( ! defined( 'SIP_FEBWC_PLUGIN_URL' ) )
	define( 'SIP_FEBWC_PLUGIN_URL', 'https://shopitpress.com/plugins/sip-front-end-bundler-woocommerce/' );

if ( ! defined( 'SIP_RSWC_PLUGIN_URL' ) )
	define( 'SIP_RSWC_PLUGIN_URL',  'https://shopitpress.com/plugins/sip-reviews-shortcode-woocommerce/' );

if ( ! defined( 'SIP_AENWC_PLUGIN_URL' ) )
	define( 'SIP_AENWC_PLUGIN_URL',  'https://shopitpress.com/plugins/sip-advanced-email-notifications-for-woocommerce/' );

if ( ! defined( 'SIP_WPGUMBY_THEME_URL' ) )
	define( 'SIP_WPGUMBY_THEME_URL','https://shopitpress.com/themes/wpgumby/' );

if ( ! defined( 'SIP_CCWC_PLUGIN' ) )
	define( 'SIP_CCWC_PLUGIN',  'SIP Cookie Check for WooCommerce' );

if ( ! defined( 'SIP_CCWC_PLUGIN_URL' ) )
	define( 'SIP_CCWC_PLUGIN_URL',  'https://shopitpress.com/plugins/sip-cookie-check-woocommerce/' );

function sip_aenwc_admin_version_check_free() {
	$get_optio_version = get_option( 'sip_version_value' );
	if( $get_optio_version == "" ) {
		add_option( 'sip_version_value', SIP_AENWCF_ADMIN_VERSION );
	}

	if ( version_compare( SIP_AENWCF_ADMIN_VERSION , $get_optio_version , ">=" ) ) {
		update_option( 'sip_version_value', SIP_AENWCF_ADMIN_VERSION );
	}
}
add_action( 'admin_init', 'sip_aenwc_admin_version_check_free' );

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sip_Advanced_Email_Notification_For_Woocommerce_Free
 * @subpackage Sip_Advanced_Email_Notification_For_Woocommerce_Free/admin
 * @author     ShopitPress <hello@shopitpress.com>
 */
class Sip_Advanced_Email_Notification_For_Woocommerce_Admin_Free {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'admin_menu', array( $this, 'sip_aenwc_config_menu' ), 20 );
		add_action( 'admin_menu', array( $this, 'sip_aenwc_admin_menu' ) );
		add_action( 'admin_menu', array( $this, 'sip_aenwc_sip_extras_admin_menu' ), 2000 );
		add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		add_action( 'admin_enqueue_scripts', array( &$this, 'sip_aenwc_admin_enqueue') );
		add_filter( 'plugin_action_links_' . SIP_AENWCF_BASENAME, array( $this, 'sip_aenwc_action_links' ) );
		add_action( 'admin_init', array( $this, 'sip_aenwc_admin_init' ) );
		
		add_action( 'admin_notices', array( $this, 'sip_aenwc_admin_notices' ) );

		$status  = get_option( 'sip_aenwc_license_status' );
		if( $status != 'valid' ) {
			
		}

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/sip-advanced-email-notification-for-woocommerce-admin-post-type.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/sip-advanced-email-notification-for-woocommerce-admin-metabox.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/sip-advanced-email-notification-for-woocommerce-admin-email.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/inc/check-conditions.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/inc/add-action.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/inc/send-mail.php';
	}

	
	/**
	 * Plugin page menus.
	 *
	 * @since 1.0.0
	 */
	public function sip_aenwc_admin_init() {

		register_setting( 'sip-aenwc-settings-license', 'sip_aenwc_license_key', 'sip_aenwc_sanitize_license' );
	}

	/**
	 * This is a means of catching errors from the activation method above and displaying it to the customer
	 */
	public function sip_aenwc_admin_notices() {
		if ( isset( $_GET['sip_aenwc_notification_activation'] ) && ! empty( $_GET['message'] ) ) {
			switch( sanitize_text_field($_GET['sip_aenwc_notification_activation']) ) {
				case 'false':
					$message = sanitize_text_field(urldecode( $_GET['message'] ));
					?>
					<div class="error">
						<p><?php echo $message; ?></p>
					</div>
					<?php
					break;
				case 'true':
				default:
					// Developers can put a custom success message here for when activation is successful if they way.
					break;
			}
		}
	}

	public function sip_aenwc_sanitize_license( $new ) {
		$old = get_option( 'sip_aenwc_license_key' );
		if( $old && $old != $new ) {
			delete_option( 'sip_aenwc_license_status' ); // new license has been entered, so must reactivate
		}
		return $new;
	}

	

	/**
	 * Plugin page menus.
	 *
	 * @since 1.0.0
	 */
	public function sip_aenwc_action_links( $links ) {
		$plugin_links = array(
			'<a href="' . admin_url( 'admin.php?page=sip-advanced-email-notification-settings' ) . '">' . esc_html__( 'Settings', 'sip-advanced-email-notifications-for-wc-free' ) . '</a>',
		);
		$plugin_links[] = '<a target="_blank" href="https://shopitpress.com/docs/sip-advanced-email-rules-woocommerce/?utm_source=wordpress.org&utm_medium=SIP-panel&utm_content=v'. SIP_AENWCF_VERSION .'&utm_campaign='.SIP_AENWCF_UTM_CAMPAIGN.'">' . esc_html__( 'Docs', 'sip-advanced-email-notifications-for-wc-free' ) . '</a>';

		return array_merge( $links, $plugin_links );
	}


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function sip_aenwc_admin_tab_style($hook_suffix) {
		
		global $pagenow, $post_type;
		
		if ($pagenow=='admin.php' && $_GET['page']=='sip-advanced-email-notification-settings') {
			wp_enqueue_style( $this->plugin_name . "-jquery-dataTables" , SIP_AENWCF_URL . 'admin/assets/css/jquery.dataTables.css', array(), SIP_AENWCF_VERSION, 'all' );

			
			wp_enqueue_style( $this->plugin_name . "-summernote-min", SIP_AENWCF_URL . 'admin/assets/css/summernote.min.css', array(), SIP_AENWCF_VERSION, 'all' );

			wp_register_style( 'sip_aenwc_custom_css', esc_url( SIP_AENWCF_URL .   'admin/partials/assets/css/custom.css' ), array(), SIP_AENWCF_VERSION );
			wp_enqueue_style( 'sip_aenwc_custom_css' );
			
		}

		wp_register_style( 'sip_aenwc_spectrum', esc_url( SIP_AENWCF_URL .   'admin/assets/css/spectrum.css' ), array(), SIP_AENWCF_VERSION );
    	wp_register_style( 'sip_aenwc_shopitpress', esc_url( SIP_AENWCF_URL .   'admin/assets/css/shopitpress.css' ), array(),SIP_AENWCF_VERSION );
   		wp_register_style( 'sip_aenwc_ionicons', esc_url( SIP_AENWCF_URL .   'admin/assets/css/ionicons.min.css' ), array(), SIP_AENWCF_VERSION );
   		
   		wp_enqueue_style( 'sip_aenwc_spectrum' );
		wp_enqueue_style( 'sip_aenwc_shopitpress' );
		wp_enqueue_style( 'sip_aenwc_ionicons' );
		
		if($post_type == "a_e_n_shop"){
			wp_register_style( 'sip-aenwc-email-conditions-style', esc_url( SIP_AENWCF_URL . "admin/assets/css/email-conditions-style.css" ), array(), SIP_AENWCF_VERSION);
			wp_enqueue_style( 'sip-aenwc-email-conditions-style' );
		}

		

		wp_register_style( 'sip-aenwc-migrate-style', esc_url( SIP_AENWCF_URL .   'admin/assets/css/migrate-style.css' ), array(), SIP_AENWCF_VERSION );
		wp_enqueue_style( 'sip-aenwc-migrate-style' );
	}

	/**
	 * Plugin admin enqueue.
	 *
	 * @since 1.0.0
	 */
	public function sip_aenwc_admin_enqueue() {
		global $pagenow, $wp_roles, $wpdb, $woocommerce;
		
		if ( $pagenow=='admin.php' && $_GET['page']=='sip-extras' ) {
			wp_enqueue_script( 'sip_aenwc_admin_script', SIP_AENWCF_URL . 'admin/assets/js/admin.js' , array('jquery'), SIP_AENWCF_VERSION, true );
			
		}
		wp_enqueue_script( 'sip_aenwc_bootstartp_script', SIP_AENWCF_URL . 'admin/assets/js/bootstrap.bundle.min.js' , array('jquery'), SIP_AENWCF_VERSION, true );
		wp_enqueue_script( 'sip_aenwc_feather_script', SIP_AENWCF_URL . 'admin/assets/js/feather.min.js' , array('jquery'), SIP_AENWCF_VERSION, true );
       	wp_enqueue_script( 'sip_aenwc_spectrum_script', SIP_AENWCF_URL . 'admin/assets/js/spectrum.js' , array('jquery'), SIP_AENWCF_VERSION, true );
     	wp_enqueue_script( 'sip_aenwc_shopitpress_script', SIP_AENWCF_URL. 'admin/assets/js/shopitpress.js' , array('jquery'), SIP_AENWCF_VERSION, true );

		wp_register_script( 'sip-aenwc-shopitpress-migrate-script', SIP_AENWCF_URL . 'admin/assets/js/migration-script.js' , array('jquery'), SIP_AENWCF_VERSION, true );
		wp_enqueue_script('sip-aenwc-shopitpress-migrate-script');

		/** get all products */
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1
		);
		$product='';
		foreach(get_posts($args) as $val){
			$post_title = str_replace("'","",$val->post_title);
			$product .= '<option value="'.$val->ID.'">'.$post_title.'</options>';
		}

		/** get all roles */
		
		$get_all_roles = $wp_roles->get_names();
		$roles ='';
		foreach($get_all_roles as $key => $val){
			$val = str_replace("'", " ", $val);
			$roles .= '<option value="'.$key.'">'.$val.'</options>';
		}
		

		/** get all countries */
		$get_all_countries = '';
		$countries_obj = new WC_Countries();
		if (is_callable(array($countries_obj, 'get_countries'))) {
			foreach( $countries_obj->get_countries() as $key => $val ) {
				$val = str_replace("'", " ", $val);
				$get_all_countries .= '<option value="'.$key.'">'.$val.'</options>';
			}

		}


		/** get all product skus  */
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1
		);
		$product_skus='';
		foreach(get_posts($args) as $val){
			$post_sku = get_post_meta($val->ID, '_sku', true);
			$post_sku = str_replace("'","",$post_sku);
			$product_skus .= '<option value="'.$post_sku.'">'.$post_sku.'</options>';
		}

		/** get all payment gateways list  */
		$get_all_payment_gateways = '';
		$payment_gateways_obj = new WC_Payment_Gateways();
		if (is_callable(array($payment_gateways_obj, 'get_available_payment_gateways'))) {
			foreach ( $payment_gateways_obj->get_available_payment_gateways() as $key => $value) {
				$value_title = str_replace("'", "\'", $value->title);
				$get_all_payment_gateways .= '<option value="'.$value_title.'">'.$value_title.'</options>';

			}
		}

		/** get all shipping classes */
		$get_shipping_classes = '';
		$shipping_obj = new WC_Shipping();
		if (is_callable(array($shipping_obj, 'get_shipping_classes'))) {
			
			foreach ( $shipping_obj->get_shipping_classes() as $key => $value) {
				$value_name = str_replace("'", " ", $value->name);
				$get_shipping_classes .= '<option value="'.$value->term_id.'">'.$value_name.'</options>';
			}
		}

		/** get shipping methods */
		$shipping_obj = new WC_Shipping();
		$get_shipping_methods = '';
		if (is_callable(array($shipping_obj, 'load_shipping_methods'))) {
			
			foreach ( $shipping_obj->load_shipping_methods() as $key => $value) {
				if( $value->id == "advanced_shipping" ) {
					$querystr = "SELECT * FROM $wpdb->posts WHERE $wpdb->posts.post_type = 'was' AND $wpdb->posts.post_status = 'publish' ORDER BY $wpdb->posts.post_date DESC";
					$pageposts = $wpdb->get_results($querystr, OBJECT);
					foreach ( $pageposts as $key => $post_value ) {
						$post_value_post_title = str_replace("'", " ", $post_value->post_title);
						$get_shipping_methods .= '<option value="'.$post_value->post_title.'">'.$post_value_post_title.'</options>';
					}
				} else {
					$get_shipping_methods .= '<option value="'.$value->method_title.'">'.$value->method_title.'</options>';
				}
			}
			
		}

		/** get shipping zones */
		$delivery_zones = WC_Shipping_Zones::get_zones();
		$get_shipping_zone = '';
		foreach ((array) $delivery_zones as $key => $the_zone ) {
			foreach ((array) $the_zone['shipping_methods'] as $key1 => $the_zone1 ) { 
				$get_shipping_zone .= '<option value="'.$the_zone1->title.'">'.$the_zone1->title.'</options>';
			}
		}
		


		$saenwc_migrate_variables = array(
			"products" => '<select name="" class="sip-value custom-select">'.$product.'</select>',
			"roles" => '<select name="" class="sip-value custom-select">'.$roles.'</select>',
			"get_all_countries" => '<select name="" class="sip-value custom-select">'.$get_all_countries.'</select>',
			"product_skus" => '<select name="" class="sip-value custom-select">'.$product_skus.'</select>',
			"get_all_payment_gateways" => '<select name="" class="sip-value custom-select">'.$get_all_payment_gateways.'</select>',
			"get_shipping_classes" => '<select name="" class="sip-value custom-select">'.$get_shipping_classes.'</select>',
			"get_shipping_zone" => '<select name="" class="sip-value custom-select">'.$get_shipping_zone.'</select>',
			"woocommerce_plugin_url" => $woocommerce->plugin_url(),
			"static_text_arr" => array(
				"in_stock" => esc_html__('In stock', 'sip-advanced-email-notifications-for-wc-free' ),
				"out_of_stock" => esc_html__('Out of Stock', 'sip-advanced-email-notifications-for-wc-free' ),
				"exactly_match" => esc_html__('Exactly Match', 'sip-advanced-email-notifications-for-wc-free' ),
				"contains" => esc_html__('Contains', 'sip-advanced-email-notifications-for-wc-free' ),
				"does_not_contain" => esc_html__('Does Not Contain', 'sip-advanced-email-notifications-for-wc-free' ),
				"is_empty" => esc_html__('is empty', 'sip-advanced-email-notifications-for-wc-free' ),
				"is_not_empty" => esc_html__('is not empty', 'sip-advanced-email-notifications-for-wc-free' ),
				"equal_to" => esc_html__('Equal to', 'sip-advanced-email-notifications-for-wc-free' ),
				"not_equal_to" => esc_html__('Not equal to', 'sip-advanced-email-notifications-for-wc-free' ),
				"greater_or_equal_to" => esc_html__('Greater or equal to', 'sip-advanced-email-notifications-for-wc-free' ),
				"less_or_equal_to" => esc_html__('Less or equal to', 'sip-advanced-email-notifications-for-wc-free' ),

			),
		);

		

		wp_localize_script("sip-aenwc-shopitpress-migrate-script", "saenwc_migrate_variables", $saenwc_migrate_variables);
	}

	/**
	 * Registers the admin menu for managing the ShopitPress options.
	 *
	 * @since 1.0.0
	 */
	public function sip_aenwc_admin_menu() {

		$this->hook = add_menu_page( 
			esc_html__( 'SIP Plugin Panel', 'sip_plugin_panel' ),
			esc_html__( 'SIP Plugins', 'sip_plugin_panel' ),
			'manage_options', 
			'sip_plugin_panel', 
			NULL,
			'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHdpZHRoPSI0MHB4IiBoZWlnaHQ9IjMycHgiIHZpZXdCb3g9IjAgNTAgNzI1IDQ3MCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzI1IDQ3MCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PGc+PHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTY0MC4zMjEsNDguNTk4YzI4LjU0LDAsNDMuNzI5LDI5Ljc5MiwzMi4xNzIsNTUuMTU4bC03Ni40MTYsMTY2Ljk1NGMtMTIuMDMyLTMyLjM0Ni01MC41NjUtNTUuNzU3LTg3LjktNjkuMTczYy00OC44NjItMTcuNjAyLTEyNy44NDMtMjEuODE5LTE5MC4wOTQtMzAuMzc5Yy0zNC4zMjEtNC42NjEtMTEwLjExOC0xMi43NS05Ny43OC01My4xMTVjMTMuMjM5LTQzLjA3NCw5Ni40ODEtNDcuNTkxLDEzMy44OC00Ny41OTFjODYuMTI5LDAsMTYwLjk1NCwxOS43NzEsMTYwLjk1NCw4My44NjZoOTkuNzQxVjQ4LjU5OEg2NDAuMzIxeiBNNTQzLjc5NiwxMDUuNTk0Yy03LjEwNS0yNy40NTgtMzIuMjc3LTQ4LjcxNy01OS4xNjktNTYuOTk3aDgyLjc3NkM1NjYuMjgxLDY2LjYxMyw1NTUuNDQ4LDk0LjE4MSw1NDMuNzk2LDEwNS41OTRMNTQzLjc5NiwxMDUuNTk0eiBNNTUwLjY0MSwzNzAuMTIzbC0xMy42MTEsMjkuNzIzYy02LjAzOCwxMy4yNzktMTkuMzI3LDIxLjYzNS0zMy45MjcsMjEuNjM1SDIyMS45NjljLTE0LjY2NiwwLTI3Ljk1NS04LjM1NS0zNC4wMDMtMjEuNjM1bC0xNS44NDQtMzQuNzIzYzEwLjkxMiwxNC43NDgsMjkuMzMxLDIzLjA4LDQ5LjA5OCwyOC4yODFDMzEzLjE1LDQxNy43MzIsNDY4LjUzNSw0MjEuNDgsNTUwLjY0MSwzNzAuMTIzTDU1MC42NDEsMzcwLjEyM3ogTTE2My43NjEsMzQ2Ljk5bC01OC4xNi0xMjcuMjQzYzE0LjY0MSwxNS42NTUsMzcuNjAxLDI3LjM2LDY2LjcyNCwzNi4yOTdjODUuNDA5LDI2LjI0MiwyMTMuODI1LDIyLjIyOSwyOTYuMjU0LDM1LjExN2M0MS45NDksNi41NjEsNDMuODU3LDQ3LjA4OCwxMy4yODksNjEuOTQ3Yy01Mi4zMzQsMjUuNTA2LTEzNS4yNDUsMjUuMzU5LTE5NC45NTcsMTEuNjk1QzIzNy4yMTksMjg1LjI1LDE1NS44MTksMzA0LjQ5LDE2My43NjEsMzQ2Ljk5TDE2My43NjEsMzQ2Ljk5eiBNODUuODY4LDE3Ni42OTJsLTMzLjM0Ni03Mi45MzdDNDAuOTQ5LDc4LjM5LDU2LjEzMSw0OC41OTgsODQuNjY5LDQ4LjU5OGgxMzYuOTY2QzE1OS43NTEsNjYuMTU0LDc3LjEwNSwxMTAuNjcsODUuODY4LDE3Ni42OTJMODUuODY4LDE3Ni42OTJ6Ii8+PHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTM2Mi41MywwLjA4NmgyNzcuNzkyYzYzLjk2NiwwLDEwMi4xODUsNjYuNzk1LDc2LjEzNSwxMjMuNzI2TDU4MS4wMzEsNDE5Ljk4NEM1NjcuMTQ3LDQ1MC4yODEsNTM2LjQzNSw0NzAsNTAzLjEwMyw0NzBIMzYyLjUzSDIyMS44OTJjLTMzLjM0NSwwLTY0LjA0My0xOS43MTktNzcuOTE3LTUwLjAxNkw4LjUzNSwxMjMuODEyQy0xNy40OTMsNjYuODgyLDIwLjY5MywwLjA4Niw4NC42NjksMC4wODZIMzYyLjUzeiBNMzYyLjUzLDIzLjk0Mkg4NC42NjljLTQ2LjIxOCwwLTczLjU2OCw0OC4yNjYtNTQuNDMsOTAuMDExbDEzNS4zNjIsMjk2LjA3OGMxMC4wNzIsMjEuOTYxLDMyLjIyNSwzNi4xMDUsNTYuMjkxLDM2LjEwNUgzNjIuNTNoMTQwLjU3M2MyNC4wNjcsMCw0Ni4yMTktMTQuMTQ1LDU2LjI3Ny0zNi4xMDVsMTM1LjM4Ni0yOTYuMDc4YzE5LjE0LTQxLjc0NS04LjIyNi05MC4wMTEtNTQuNDQ0LTkwLjAxMUgzNjIuNTN6Ii8+PC9nPjwvc3ZnPg==',
			62.25
		);

		// Load global assets if the hook is successful.
		if ( $this->hook ) {
			// Enqueue custom styles and scripts.
			add_action( 'admin_enqueue_scripts',  array( $this, 'sip_aenwc_admin_tab_style' ) );            
		}
	}

	public static function set_screen( $status, $option, $value ) {
		return $value;
	}

	/**
	 * Screen options
	 */
	public function screen_option() {

		$option = 'per_page';
		$args	= [
			'label'		=> esc_html__( 'Mail logs', 'sip-advanced-email-notifications-for-wc-free' ),
			'default'	=> 50,
			'option'	=> 'maillogs_per_page'
		];

		add_screen_option( $option, $args );
	}

	

	/**
	 * Loads assets for the settings page.
	 *
	 * @since 1.0.0
	 */
	public function sip_aenwc_admin_assets() {

		global $pagenow;
		if ( $pagenow=='admin.php' && ( ( isset($_GET['page']) && ( $_GET['page'] == 'sip-extras' || $_GET['page'] == 'sip-reviews-shortcode-settings' ) ) || ( isset($_GET['tab']) && ( $_GET['tab'] == 'license' || $_GET['tab'] == 'help' ) ) || ( isset($_GET['action']) && $_GET['action'] == 'license' ) ) ) {
			wp_register_style( 'sip_ccwc_layout', esc_url( SIP_AENWCF_URL .   'admin/partials/assets/css/layout.css', false, '1.0.0' ) );
			wp_enqueue_style( 'sip_ccwc_layout' );
		}
	}

	public function sip_aenwc_config_menu( ) {
		global $parent;
		$args = array(
			'create_menu_page' => true,
			'parent_slug'	=> '',
			'page_title'	=> esc_html__( 'Advanced Email Notification', 'sip_plugin_panel' ),
			'menu_title'	=> esc_html__( 'Advanced Email Notification', 'sip_plugin_panel' ),
			'capability'	=> 'manage_options',
			'parent'		=> '',
			'parent_page'	=> 'sip_plugin_panel',
			'page'			=> 'sip_plugin_panel',
		);

		$parent = $args['parent_page'];

		if ( ! empty( $parent ) ) {
		// $mail_log = new Sip_AENWC_Mail_Log();
			$hook = add_submenu_page( $parent , 'Advanced Email Notification', 'Advanced Email Notification', 'manage_options', 'sip-advanced-email-notification-settings', array( $this, 'sip_aenwc_settings_page' ) );
		} else {
			$hook = add_menu_page( $args['page_title'], $args['menu_title'], $args['capability'], $args['page'], array( $this, 'sip_aenwc_admin_menu_ui' ), NULL , 62.25 );      		
		}

		add_action( "load-$hook", [ $this, 'screen_option' ] );
		/* === Duplicate Items Hack === */
		$this->sip_aenwc_remove_duplicate_submenu();
	}

	/**
	 * To avoide the duplication of ShopitPress Extras menue and run the latest sip panel
	 *
	 * @since 1.0.1
	 */
	public function sip_aenwc_sip_extras_admin_menu() {
		global $parent;
		$get_optio_version = get_option( 'sip_version_value' );

		if ( version_compare( $get_optio_version , SIP_AENWCF_ADMIN_VERSION , "<=" ) ) {

			if ( ! defined( 'SIP_PANEL_EXTRAS' ) ) {
				define( 'SIP_PANEL_EXTRAS' , TRUE);
				add_submenu_page( $parent , 'ShopitPress Extras', '<span style="color:#FF8080 ">ShopitPress Extras</span>', 'manage_options', 'sip-extras', array( $this, 'sip_aenwc_admin_menu_ui' ) );
				add_action( 'admin_enqueue_scripts',  array( $this, 'sip_aenwc_admin_assets' ) );
			}
		}
	}

	/**
	 * Outputs the main UI for handling and managing addons, themes and licenses.
	 *
	 * @since 1.0.0
	 */
	public function sip_aenwc_admin_menu_ui( ) { ?>
		<div class="sip-container-wrapper-email mg-r-20 wrap">
			<div class="row">
				<div class="col-md-12 col-xl-12">
					<h2 class="mg-b-20 mg-t-20 h4"><?php _e('Shopitpress extras', 'sip-advanced-email-notifications-for-wc-free' ); ?></h2>
					<ul class="nav nav-line nav-justified" id="myTab5" role="tablist">
						<li class="nav-item"><a class="nav-link <?php if ( !isset( $_GET['tab'] ) ) echo 'active'; ?>" href="admin.php?page=sip-extras"><?php _e( 'Plugins', 'sip-advanced-email-notifications-for-wc-free' ); ?></a>


						</li>
						<li class="nav-item">
							<a class="nav-link <?php if ( isset( $_GET['tab'] ) && 'themes' == $_GET['tab'] ) echo 'active'; ?>" href="admin.php?page=sip-extras&amp;tab=themes"><?php _e( 'Themes', 'sip-advanced-email-notifications-for-wc-free' ); ?></a>

						</li>

					</ul>
					<div class="tab-content mg-t-20" id="myTabContent5">
						<?php
						if ( ! isset( $_GET['tab'] ) ) {
							include(SIP_AENWCF_DIR . "admin/partials/ui/plugin.php");
						} elseif ( 'themes' == $_GET['tab'] ) {
							include(SIP_AENWCF_DIR . "admin/partials/ui/themes.php");
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	} // END menu_ui()

	public function sip_aenwc_remove_duplicate_submenu( ) {
		/* === Duplicate Items Hack === */
		remove_submenu_page( 'sip_plugin_panel', 'sip_plugin_panel' );
	}

	/**
	 * After loding this function global page show the admin panel
	 *
	 * @since     1.0.0
	 */
	public function sip_aenwc_settings_page(  ) { ?>

		
		<div class="sip-container-wrapper-email mg-r-20 wrap">

			<div class="row">
				<div class="col-md-12 col-xl-12">
					<h2 class="mg-b-20 mg-t-0 h4"><?php _e( 'SIP Advanced Email Notification For Woocommerce', 'sip-advanced-email-notifications-for-wc-free' ); ?></h2>
					<ul class="nav nav-line nav-justified" id="myTab5" role="tablist">

						<li class="nav-item"><a class="nav-link <?php if ( !isset( $_GET['tab'] ) ) echo ' active'; ?>" href="admin.php?page=sip-advanced-email-notification-settings"><?php _e( 'Follow up email', 'sip-advanced-email-notifications-for-wc-free' ); ?></a></li>
						
						<li class="nav-item"><a class="nav-link <?php if ( isset( $_GET['tab'] ) && 'mail_log' == $_GET['tab'] ) echo 'active'; ?>" href="admin.php?page=sip-advanced-email-notification-settings&amp;tab=mail_log"><?php _e( 'Mail Log', 'sip-advanced-email-notifications-for-wc-free' ); ?></a></li>


						<li class="nav-item"><a class="nav-link <?php if ( isset( $_GET['tab'] ) && 'settings' == $_GET['tab'] ) echo 'active'; ?>" href="admin.php?page=sip-advanced-email-notification-settings&amp;tab=settings"><?php _e( 'Settings', 'sip-advanced-email-notifications-for-wc-free' ); ?></a></li>

						<li class="nav-item"><a class="nav-link <?php if ( isset( $_GET['tab'] ) && 'get_pro_version' == $_GET['tab'] ) echo 'active'; ?>" href="admin.php?page=sip-advanced-email-notification-settings&amp;tab=get_pro_version"><?php _e( 'Get Pro Version', 'sip-advanced-email-notifications-for-wc-free' ); ?></a></li>

						<li class="nav-item"><a class="nav-link <?php if ( isset( $_GET['tab'] ) && 'help' == $_GET['tab'] ) echo 'active'; ?>" href="admin.php?page=sip-advanced-email-notification-settings&amp;tab=help"><?php _e( 'Help', 'sip-advanced-email-notifications-for-wc-free' ); ?></a></li>

					</ul>
					<div class="tab-content mg-t-20" id="myTabContent5">
					
						<?php
							/** in wpengine we will get default tab = general */
							if ( !isset( $_GET['tab'] ) || 'general' == $_GET['tab'] || 'bundles' == $_GET['tab'] || 'delete' == $_GET['tab'] || 'delete' == isset( $_GET['tab2'] ) ) {
								include(SIP_AENWCF_DIR . "admin/partials/ui/bundles.php");
							} elseif ( 'mail_log' == $_GET['tab'] ) {
								include(SIP_AENWCF_DIR . "admin/partials/ui/mail-log.php");
							} elseif ( 'help' == $_GET['tab'] ) {
								include( SIP_AENWCF_DIR . "admin/partials/ui/help.php" );
							} elseif ( 'settings' == $_GET['tab'] ) {
								include( SIP_AENWCF_DIR . "admin/partials/ui/settings.php" );
							} elseif ( 'get_pro_version' == $_GET['tab'] ) {
								include( SIP_AENWCF_DIR . "admin/partials/ui/get-pro-version-features.php" );
							}
						?>
					</div><!-- #myTabContent5 -->
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( ) {
		global $pagenow, $typenow;

		if (isset( $_GET['post'] )) {
			$post_type = get_post_type( sanitize_text_field($_GET['post']) );
		} else {
			$post_type = $typenow;
		}

		if ( ( $pagenow == 'edit.php' || $pagenow == 'post-new.php' || $pagenow == 'post.php' ) && $post_type =='a_e_n_shop') {
			wp_enqueue_style( $this->plugin_name . '-admin', SIP_AENWCF_URL . 'admin/assets/css/sip-advanced-email-notification-for-woocommerce-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-editor-admin', SIP_AENWCF_URL . 'admin/assets/css/summernote-lite.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . "-codemirror", SIP_AENWCF_URL. 'admin/codemirror/lib/codemirror.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . "-monokai", SIP_AENWCF_URL . 'admin/codemirror/theme/monokai.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( ) {
		global $pagenow, $typenow;

		if (isset( $_GET['post'] )) {
			$post_type = get_post_type( sanitize_text_field($_GET['post']) );
		} else {
			$post_type = $typenow;
		}

		if ( ( $pagenow == 'edit.php' || $pagenow == 'post-new.php' || $pagenow == 'post.php' ) && $post_type == 'a_e_n_shop') {
			wp_enqueue_media();
			wp_enqueue_script( $this->plugin_name, SIP_AENWCF_URL . 'admin/assets/js/sip-advanced-email-notification-for-woocommerce-admin.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name. "-lite-editor", SIP_AENWCF_URL . 'admin/assets/js/summernote-lite.min.js', array( 'jquery' ), $this->version, true );

			/* wp_enqueue_script($this->plugin_name. "-bootstrap", SIP_AENWCF_URL . 'admin/assets/js/bootstrap.bundle.min.js' , array('jquery'), '1.0.0', true ); */
			wp_enqueue_script($this->plugin_name. "-feather", SIP_AENWCF_URL . 'admin/assets/js/feather.min.js' , array('jquery'), '1.0.0', true );
			wp_enqueue_script( $this->plugin_name. "-spectrum", SIP_AENWCF_URL . 'admin/assets/js/spectrum.js' , array('jquery'), '1.0.0', true );
			wp_enqueue_script( $this->plugin_name. "-shopitpress", SIP_AENWCF_URL . 'admin/assets/js/shopitpress.js' , array('jquery'), '1.0.0', true );
			wp_enqueue_script( $this->plugin_name. "-popper", SIP_AENWCF_URL . 'admin/assets/js/popper.min.js' , array('jquery'), '1.0.0', true );

			wp_enqueue_script( $this->plugin_name. "-codemirror", SIP_AENWCF_URL . 'admin/codemirror/lib/codemirror.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name. "-matchbrackets", SIP_AENWCF_URL . 'admin/codemirror/addon/edit/matchbrackets.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name. "-closebrackets", SIP_AENWCF_URL . 'admin/codemirror/addon/edit/closebrackets.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name. "-comment", SIP_AENWCF_URL . 'admin/codemirror/addon/comment/comment.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name. "-mod-css", SIP_AENWCF_URL . 'admin/codemirror/mode/css/css.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name. "-keymap-sublime", SIP_AENWCF_URL . 'admin/codemirror/keymap/sublime.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name. "-codemirror-customization", SIP_AENWCF_URL . 'admin/assets/js/codemirror-customization-script.js', array( 'jquery', $this->plugin_name. "-codemirror", $this->plugin_name. "-matchbrackets", $this->plugin_name. "-closebrackets", $this->plugin_name. "-comment", $this->plugin_name. "-mod-css", $this->plugin_name. "-keymap-sublime" ), $this->version, true );
			wp_localize_script( $this->plugin_name, 'sip_aenwc_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		}
		
		wp_enqueue_script( $this->plugin_name . '-sweetalert', SIP_AENWCF_URL . 'admin/assets/js/sweetalert.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name, SIP_AENWCF_URL . 'admin/assets/js/sip-advanced-email-notification-for-woocommerce-admin-mail-log.js', array( 'jquery' ), $this->version, true );
	}


	
}