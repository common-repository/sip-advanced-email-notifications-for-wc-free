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

function sip_aenwc_send_test_email_callback_free() {

	$id = intval( $_POST['id'] );
	$post = get_post( $id );

    $meta = get_metadata ( 'post', intval ( $id ), '', true );
    foreach ( $meta as $key => $value ) {
        $meta [$key] = $value [0];
    }
    $rule = array_merge ( $post->to_array (), $meta );

	$mail_data = array ();
	$mail_data ['sender_name']  = get_option( 'woocommerce_email_from_name' );
	$mail_data ['sender_email'] = get_option( 'woocommerce_email_from_address' );
	$mail_data ['rule_id']      = $id;
	$mail_data ['event_name']   = $post->post_title;
	$mail_data ['status']       = 'pending';

    $order_id = sip_aenwc_get_last_order_id_free(); // Last order ID
    $order = wc_get_order( $order_id ); // Get an instance of the WC_Order oject

	$sip_a_e_n_wc_test_email = get_bloginfo('admin_email');
    if( get_post_meta( $id, 'sip_a_e_n_wc_test_email', true ) ) {
		$sip_a_e_n_wc_test_email = get_post_meta( $id, 'sip_a_e_n_wc_test_email', true );
	}
    if(isset($_POST['custom_email_address']) && !empty($_POST['custom_email_address'])){
        $sip_a_e_n_wc_test_email = sanitize_email($_POST['custom_email_address']);
    }
	

	$mail_data ['recipient_email'] = $sip_a_e_n_wc_test_email;
    $mail_data['recipient_first_name'] = method_exists( $order, 'get_billing_first_name' ) ? $order->get_billing_first_name() : $order->billing_first_name;
    $mail_data['recipient_last_name']  = method_exists( $order, 'get_billing_last_name' ) ? $order->get_billing_last_name() : $order->billing_last_name;

    $send_at = time();
    $mail_data['send_at'] = date_i18n( get_option( 'date_format' ), strtotime($send_at) );

	$email_chains = sip_aenwc_get_chain_of_post_id_free ( $id );
    
    if ( $email_chains && ! empty ( $email_chains ) ) {
        
            $mail_data ['subject'] = sip_test_email_aenwc_shortcode_subject_free( $email_chains['subject'], $mail_data ['recipient_first_name'], $mail_data ['recipient_last_name'], $rule, $mail_data );
            $mail_data ['content'] = sip_test_email_aenwc_shortcode_content_free( $email_chains ['content'], $mail_data ['recipient_first_name'], $mail_data ['recipient_last_name'], $rule, $mail_data );
            
            try {
                add_filter( 'wp_mail_content_type', 'sip_aenwc_set_html_content_type_free' );
                wp_mail ( $mail_data['recipient_email'], $mail_data['subject'], $mail_data['content'] );
                remove_filter( 'wp_mail_content_type', 'sip_aenwc_set_html_content_type_free' );

                echo "1";
            } catch ( Exception $e ) {
                echo "0";
            }
        
    }

    wp_die(); // this is required to terminate immediately and return a proper response
}
add_action( 'wp_ajax_sip_aenwc_send_test_email', 'sip_aenwc_send_test_email_callback_free' );
add_action( 'wp_ajax_nopriv_sip_aenwc_send_test_email', 'sip_aenwc_send_test_email_callback_free' );

function sip_test_email_aenwc_shortcode_subject_free( $content, $customer_first_name, $customer_last_name, $rule, $mail_data ) {
    $order_id = sip_aenwc_get_last_order_id_free(); // Last order ID
    $order = new WC_Order ( $order_id );
    $order_customer_user = method_exists( $order, 'get_customer_id' ) ? $order->get_customer_id() : $order->customer_user;
    $customer = get_userdata( $order_customer_user );
    $replaces = array (
            '{{customer_name}}' => $customer_first_name . " " . $customer_last_name,
            '{{customer_first_name}}' => $customer_first_name,
            '{{customer_last_name}}'  => $customer_last_name,
            '{{username}}'  => $customer->data->user_login,
            '{{email}}'  => $customer->data->user_email,
            '{{ID}}'  => $customer->data->ID,
            '{{IP}}'  => method_exists( $order, 'get_customer_ip_address' ) ? $order->get_customer_ip_address() : $order->customer_ip_address,
            '{{booking_start_date}}'  => sip_aenwc_booking_start_date_time_free( $order_id, 'date' ),
            '{{booking_start_time}}'  => sip_aenwc_booking_start_date_time_free( $order_id, 'time' ),
            '{{booking_end_date}}'  => sip_aenwc_booking_end_date_time_free( $order_id, 'date' ),
            '{{booking_end_time}}'  => sip_aenwc_booking_end_date_time_free( $order_id, 'time' ),
            '{{store_url}}'     => get_permalink ( wc_get_page_id( 'shop' ) ),
            '{{store_name}}'    => get_bloginfo ( 'name' ),
            '{{order_number}}'  => $order->get_order_number (),
            '{{order_total}}'   => $order->get_total(),
            '{{order_url}}'     => $order->get_view_order_url () ,
            '{{order_items}}'   => sip_aenwc_get_order_items_free( $order_id ),
            '{{tracking}}'      => get_post_meta( $order_id, '_aftership_tracking_number', true ),
            '{{aftership_tracking}}'      => get_post_meta( $order_id, '_aftership_tracking_number', true ),
            '{{order_items_with_thumbnail}}' =>sip_aenwc_get_order_items_with_thumnail_free( $order_id )
    );

    if ( !empty( $replaces ) ) {
        foreach ( $replaces as  $find => $replace ) {
            $content = str_replace( $find,$replace ,$content );
        }
    }
    
    return $content;
}

function sip_test_email_aenwc_shortcode_content_free( $content, $customer_first_name, $customer_last_name, $rule, $mail_data ) {
    $order_id = sip_aenwc_get_last_order_id_free(); // Last order ID
    $order = new WC_Order ( $order_id );
    $order_customer_user = method_exists( $order, 'get_customer_id' ) ? $order->get_customer_id() : $order->customer_user;
    $customer = get_userdata( $order_customer_user );
    $replaces = array (
            '{{customer_name}}' => $customer_first_name . " " . $customer_last_name,
            '{{customer_first_name}}' => $customer_first_name,
            '{{customer_last_name}}' => $customer_last_name,
            '{{customer_username}}' => $customer->data->user_login,
            '{{username}}' => $customer->data->user_login,
            '{{email}}' => $customer->data->user_email,
            '{{customer_email}}' => $customer->data->user_email,
            '{{ID}}' => $customer->data->ID,
            '{{customer_id}}' => $customer->data->ID,
            '{{IP}}' => method_exists( $order, 'get_customer_ip_address' ) ? $order->get_customer_ip_address() : $order->customer_ip_address,
            '{{customer_ip}}' => method_exists( $order, 'get_customer_ip_address' ) ? $order->get_customer_ip_address() : $order->customer_ip_address,
            'sip_custom_field' => 'sip_custom_field order_id="'.$order_id.'"',
            '{{booking_start_date}}' => sip_aenwc_booking_start_date_time_free( $order_id, 'date' ),
            '{{booking_start_time}}' => sip_aenwc_booking_start_date_time_free( $order_id, 'time' ),
            '{{booking_end_date}}' => sip_aenwc_booking_end_date_time_free( $order_id, 'date' ),
            '{{booking_end_time}}' => sip_aenwc_booking_end_date_time_free( $order_id, 'time' ),
            '{{store_url}}' => get_permalink( wc_get_page_id( 'shop' ) ),
            '{{store_name}}' => get_bloginfo( 'name' ),
            '{{download_url}}' => sip_order_downloadable_items_free( $order ),
            '{{product_name}}' => sip_order_downloadable_product_name_free( $order ),
            '{{downloads_remaining}}' => sip_order_downloads_remaining_free( $order ),
            '{{access_expires}}' => sip_order_download_access_expires_free( $order ),
            '{{order_number}}' => $order->get_order_number(),
            '{{order_total}}' => $order->get_total(),
            '{{order_url}}' => $order->get_view_order_url(),
            '{{order_items}}' => sip_aenwc_get_order_items_free( $order_id ),
            '{{tracking}}' => get_post_meta( $order_id, '_aftership_tracking_number', true ),
            '{{aftership_tracking}}' => get_post_meta( $order_id, '_aftership_tracking_number', true ),
            '{{order_items_with_thumbnail}}' => sip_aenwc_get_order_items_with_thumnail_free( $order_id ),
            '{{order_currency}}' => method_exists( $order, 'get_currency' ) ? $order->get_currency() : $order->currency,
            '{{order_date_created}}' => method_exists( $order, 'get_date_created' ) ? $order->get_date_created() : $order->date_created,
            '{{order_status}}' => method_exists( $order, 'get_status' ) ? $order->get_status() : $order->status,
            '{{order_shipping_total}}' => method_exists( $order, 'get_shipping_total' ) ? $order->get_shipping_total() : $order->shipping_total,
            '{{order_total_tax}}' => method_exists( $order, 'get_total_tax' ) ? $order->get_total_tax() : $order->total_tax,
            '{{order_total_discount}}' => method_exists( $order, 'get_total_discount' ) ? $order->get_total_discount() : $order->total_discount,
            '{{order_subtotal}}' => method_exists( $order, 'get_subtotal' ) ? $order->get_subtotal() : $order->subtotal,
            '{{order_item_count}}' => method_exists( $order, 'get_item_count' ) ? $order->get_item_count() : $order->item_count,
            '{{order_key}}' => method_exists( $order, 'get_order_key' ) ? $order->get_order_key() : $order->order_key,
            '{{order_customer_id}}' => method_exists( $order, 'get_customer_id' ) ? $order->get_customer_id() : $order->customer_id,
            '{{order_billing_first_name}}' => method_exists( $order, 'get_billing_first_name' ) ? $order->get_billing_first_name() : $order->billing_first_name,
            '{{order_billing_last_name}}' => method_exists( $order, 'get_billing_last_name' ) ? $order->get_billing_last_name() : $order->billing_last_name,
            '{{order_billing_company}}' => method_exists( $order, 'get_billing_company' ) ? $order->get_billing_company() : $order->billing_company,
            '{{order_billing_address_1}}' => method_exists( $order, 'get_billing_address_1' ) ? $order->get_billing_address_1() : $order->billing_address_1,
            '{{order_billing_address_2}}' => method_exists( $order, 'get_billing_address_2' ) ? $order->get_billing_address_2() : $order->billing_address_2,
            '{{order_billing_city}}' => method_exists( $order, 'get_billing_city' ) ? $order->get_billing_city() : $order->billing_city,
            '{{order_billing_state}}' => method_exists( $order, 'get_billing_state' ) ? $order->get_billing_state() : $order->billing_state,
            '{{order_billing_postcode}}' => method_exists( $order, 'get_billing_postcode' ) ? $order->get_billing_postcode() : $order->billing_postcode,
            '{{order_billing_country}}' => method_exists( $order, 'get_billing_country' ) ? $order->get_billing_country() : $order->billing_country,
            '{{order_billing_email}}' => method_exists( $order, 'get_billing_email' ) ? $order->get_billing_email() : $order->billing_email,
            '{{order_billing_phone}}' => method_exists( $order, 'get_billing_phone' ) ? $order->get_billing_phone() : $order->billing_phone,
            '{{order_shipping_first_name}}' => method_exists( $order, 'get_shipping_first_name' ) ? $order->get_shipping_first_name() : $order->shipping_first_name,
            '{{order_shipping_last_name}}' => method_exists( $order, 'get_shipping_last_name' ) ? $order->get_shipping_last_name() : $order->shipping_last_name,
            '{{order_shipping_company}}' => method_exists( $order, 'get_shipping_company' ) ? $order->get_shipping_company() : $order->shipping_company,
            '{{order_shipping_address_1}}' => method_exists( $order, 'get_shipping_address_1' ) ? $order->get_shipping_address_1() : $order->shipping_address_1,
            '{{order_shipping_address_2}}' => method_exists( $order, 'get_shipping_address_2' ) ? $order->get_shipping_address_2() : $order->shipping_address_2,
            '{{order_shipping_city}}' => method_exists( $order, 'get_shipping_city' ) ? $order->get_shipping_city() : $order->shipping_city,
            '{{order_shipping_state}}' => method_exists( $order, 'get_shipping_state' ) ? $order->get_shipping_state() : $order->shipping_state,
            '{{order_shipping_postcode}}' => method_exists( $order, 'get_shipping_postcode' ) ? $order->get_shipping_postcode() : $order->shipping_postcode,
            '{{order_shipping_country}}' => method_exists( $order, 'get_shipping_country' ) ? $order->get_shipping_country() : $order->shipping_country,
            '{{order_payment_method}}' => method_exists( $order, 'get_payment_method' ) ? $order->get_payment_method() : $order->payment_method,
            '{{order_payment_method_title}}' => method_exists( $order, 'get_payment_method_title' ) ? $order->get_payment_method_title() : $order->payment_method_title,
            '{{order_transaction_id}}' => method_exists( $order, 'get_transaction_id' ) ? $order->get_transaction_id() : $order->transaction_id,
            '{{order_customer_ip_address}}' => method_exists( $order, 'get_customer_ip_address' ) ? $order->get_customer_ip_address() : $order->customer_ip_address,
            '{{order_customer_user_agent}}' => method_exists( $order, 'get_customer_user_agent' ) ? $order->get_customer_user_agent() : $order->customer_user_agent,
            '{{order_created_via}}' => method_exists( $order, 'get_created_via' ) ? $order->get_created_via() : $order->created_via,
            '{{order_customer_note}}' => method_exists( $order, 'get_customer_note' ) ? $order->get_customer_note() : $order->customer_note,
            '{{order_date_completed}}' => method_exists( $order, 'get_date_completed' ) ? $order->get_date_completed() : $order->date_completed,
            '{{order_date_paid}}' => method_exists( $order, 'get_date_paid' ) ? $order->get_date_paid() : $order->date_paid,
            '{{order_address}}' => sip_aenwc_order_address_free( $order ), // array
            '{{order_shipping_address_map_url}}' => method_exists( $order, 'get_shipping_address_map_url' ) ? $order->get_shipping_address_map_url() : $order->shipping_address_map_url,
            '{{order_billing_full_name}}' => method_exists( $order, 'get_formatted_billing_full_name' ) ? $order->get_formatted_billing_full_name() :$order->formatted_billing_full_name,
            '{{order_shipping_full_name}}' => method_exists( $order, 'get_formatted_shipping_full_name' ) ? $order->get_formatted_shipping_full_name() :$order->formatted_shipping_full_name,
            '{{order_billing_address}}' => method_exists( $order, 'get_formatted_billing_address' ) ? $order->get_formatted_billing_address() : $order->formatted_billing_address,
            '{{order_shipping_address}}' => method_exists( $order, 'get_formatted_shipping_address' ) ? $order->get_formatted_shipping_address() :$order->formatted_shipping_address,
            '{{order_payment_url}}' => method_exists( $order, 'get_checkout_payment_url' ) ? $order->get_checkout_payment_url() : $order->checkout_payment_url,
            '{{order_received_url}}' => method_exists( $order, 'get_checkout_order_received_url' ) ? $order->get_checkout_order_received_url() :$order->checkout_order_received_url,
            '{{cancel_order_url}}' => method_exists( $order, 'get_cancel_order_url' ) ? $order->get_cancel_order_url() : $order->cancel_order_url,
            '{{order_url}}' => method_exists( $order, 'get_view_order_url' ) ? $order->get_view_order_url() : $order->view_order_url,
            '{{order_used_coupons}}' => sip_aenwc_order_used_coupons_free( $order ) // array
    );

    if ( !empty( $replaces ) ) { 
        foreach ( $replaces as  $find => $replace ) {
            $content = str_replace( $find,$replace ,$content );
        }
    }

    // $content = nl2br($content);
    if (strpos($content, '{{order_details}}') !== false) {

        $replaces = array (
            '{{order_details}}' => sip_aenwc_style_inline_free( sip_aenwc_get_order_details_free( $order_id ) )
        );
        
        foreach ( $replaces as  $find => $replace ) {
            $content = str_replace( $find,$replace ,$content );
        }
    }
    
    $content = sip_aenwc_style_inline_free( $content );
    $content = do_shortcode( $content );
    
    return $content;
}

function sip_aenwc_get_last_order_id_free() {
    global $wpdb;
    $statuses = array_keys(wc_get_order_statuses());
    $statuses = implode( "','", $statuses );
    // Getting last Order ID (max value)
    $results = $wpdb->get_col( "SELECT MAX(ID) FROM {$wpdb->prefix}posts WHERE post_type LIKE 'shop_order' AND post_status IN ('$statuses')" );
    return reset($results);
}
?>