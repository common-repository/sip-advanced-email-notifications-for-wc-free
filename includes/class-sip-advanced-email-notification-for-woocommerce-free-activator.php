<?php

/**
 * Fired during plugin activation
 *
 * @link       https://shopitpress.com
 * @since      1.0.0
 *
 * @package    Sip_Advanced_Email_Notification_For_Woocommerce_Free
 * @subpackage Sip_Advanced_Email_Notification_For_Woocommerce_Free/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Sip_Advanced_Email_Notification_For_Woocommerce_Free
 * @subpackage Sip_Advanced_Email_Notification_For_Woocommerce_Free/includes
 * @author     ShopitPress <hello@shopitpress.com>
 */
class Sip_Advanced_Email_Notification_For_Woocommerce_Activator_Free {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		global $wpdb;
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
		// error_log(print_r($wpdb,1));
		$prefix = $wpdb->prefix;
		$charset = $wpdb->charset;
		$collate = $wpdb->collate;
		$query = "CREATE TABLE IF NOT EXISTS `{$prefix}sip_aenwc_email_chain` (
		  `id` int(11) unsigned NOT NULL auto_increment,
		  `post_id` int(11) NOT NULL,
		  `before_or_after` tinyint(4) NOT NULL COMMENT '0 is after and 1 is before',
		  `day` int(11) NOT NULL,
		  `hour` int(11) DEFAULT NULL,
		  `mins` int(11) DEFAULT NULL,
		  `subject` text NOT NULL,
		  `bcc` varchar(150) NOT NULL,
		  `content` longtext NOT NULL,
		  `to_customer` varchar(3) NOT NULL,
		   PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET={$charset} ;";		
		dbDelta( $query );

		$query ="CREATE TABLE IF NOT EXISTS `{$prefix}sip_aenwc_queue` (
		  `id` int(11) unsigned NOT NULL auto_increment,
		  `event_name` varchar(255) DEFAULT NULL,
		  `rule_id` int(11) DEFAULT NULL,
		  `rule_name` varchar(255) DEFAULT NULL,
		  `status` varchar(55) DEFAULT NULL,
		  `store_id` text,
		  `sender_name` varchar(255) DEFAULT NULL,
		  `sender_email` varchar(255) DEFAULT NULL,
		  `recipient_first_name` varchar(255) DEFAULT NULL,
		  `recipient_last_name` varchar(255) DEFAULT NULL,
		  `recipient_email` varchar(255) DEFAULT NULL,
		  `url` varchar(255) DEFAULT NULL,
		  `created` datetime NOT NULL,
		  `send_at` datetime NOT NULL,
		  `email_subject` varchar(100) DEFAULT NULL,
		  `unique_no` varchar(100) DEFAULT NULL,
		  `bcc` varchar(100) DEFAULT NULL,
		  `hash` varchar(255) DEFAULT NULL,
		  `email_content` mediumtext,
		  `event_info` text,
		   PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET={$charset}; ";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta( $query );

		$email_chain = $wpdb->get_row("SELECT * FROM {$prefix}sip_aenwc_email_chain");

		if(!isset($email_chain->header_css)){
			$wpdb->query("ALTER TABLE {$prefix}sip_aenwc_email_chain ADD header_css TEXT NOT NULL");
		}
	}

	
}