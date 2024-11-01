<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://shopitpress.com
 * @since      1.0.0
 *
 * @package    Sip_Advanced_Email_Notification_For_Woocommerce_Free
 * @subpackage Sip_Advanced_Email_Notification_For_Woocommerce_Free/admin/partials
 */


/**
 * add new post type to manage follow up email rules
 */
function sip_aenwc_create_post_type_free() {

	 register_post_type ( 'a_e_n_shop', array (
        'labels' => array (
            'name' 					=> esc_html__( 'Advanced email notification', 'sip-advanced-email-notifications-for-wc-free' ),
            'singular_name' 		=> esc_html__( 'Advanced email notification', 'sip-advanced-email-notifications-for-wc-free'),
            'menu_name'             => _x( 'Advanced email notification', 'Admin menu name', 'sip-advanced-email-notifications-for-wc-free' ),
            'add_new' 				=> esc_html__( 'Add New', 'sip-advanced-email-notifications-for-wc-free'),
            'add_new_item' 			=> esc_html__( 'Add New Advanced email notification', 'sip-advanced-email-notifications-for-wc-free'),
            'edit'                  => esc_html__( 'Edit', 'sip-advanced-email-notifications-for-wc-free' ),
            'edit_item' 			=> esc_html__( 'Edit Advanced email notification', 'sip-advanced-email-notifications-for-wc-free'),
            'new_item' 				=> esc_html__( 'New Advanced email notification', 'sip-advanced-email-notifications-for-wc-free'),
            'view'                  => esc_html__( 'View Advanced email notification', 'sip-advanced-email-notifications-for-wc-free' ),
            'view_item' 			=> esc_html__( 'View Advanced email notification', 'sip-advanced-email-notifications-for-wc-free'),
            'search_items' 			=> esc_html__( 'Search Advanced email notification', 'sip-advanced-email-notifications-for-wc-free'),
            'not_found' 			=> esc_html__( 'No advanced email notification found', 'sip-advanced-email-notifications-for-wc-free'),
            'not_found_in_trash'	=> esc_html__( 'No advanced email notification found in Trash', 'sip-advanced-email-notifications-for-wc-free'),
            'parent'                => esc_html__( 'Parent Advanced email notification', 'sip-advanced-email-notifications-for-wc-free' )
        ),
        'show_ui' 				=> true,
        'show_in_menu' 			=> false,
        'capability_type' 		=> 'post',
        'map_meta_cap' 			=> true,
        'rewrite' 				=> array( 'slug' => 'was', 'with_front' => true ),
        '_builtin' 				=> false,
        'query_var' 			=> true,
        'supports' 				=> array( 'title' )
        )
    );
    register_post_status ( 'inactive', array (
        'label' => __ ( 'In active', 'sip-advanced-email-notifications-for-wc-free' ),
        'public' => true,
        'exclude_from_search' => false,
        'show_in_admin_all_list' => true,
        'show_in_admin_status_list' => true,
        'label_count' => _n_noop ( 'In active <span class="count">(%s)</span>', 'In active <span class="count">(%s)</span>' )
    ) );	
}

add_action ( 'init', 'sip_aenwc_create_post_type_free' );