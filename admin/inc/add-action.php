<?php // Silence is golden

function sip_aenwc_check_woocommerce_order_status_free( $id ) { 

	$array = wc_get_order_statuses();
	foreach ($array as $key => $value) {
		$order_statuses = str_replace('wc-', '', $key);
		$order_statuses = 'woocommerce_order_status_'.$order_statuses ;
		add_action ( $order_statuses , 'sip_aenwc_add_in_mail_queue_free', 5 );
	}
}
add_action ('init', 'sip_aenwc_check_woocommerce_order_status_free');
add_action ('woocommerce_payment_complete', 'sip_aenwc_add_in_mail_queue_free', 5 );

function sip_aenwc_woocommerce_order_status_changed_free( $id, $old_status, $new_status ){
	if ( "sendemail" == $new_status ) {
		// $order = new WC_Order($id);
		add_filter( "woocommerce_mail_content", "sip_aenwc_mail_content_free" );
		// $order->update_status($old_status, '');

		// Update post ID
		$update_status = array(
			'ID' => $id,
			'post_status' => "wc-" . $old_status,
		);

		// Update the post into the database
		wp_update_post( $update_status );
	}

	if ( "sendemail" == $old_status ) {
		add_filter( "woocommerce_mail_content", "sip_aenwc_mail_content_free" );
	}
}
add_action( 'woocommerce_order_status_changed', 'sip_aenwc_woocommerce_order_status_changed_free', 5, 3);

function sip_aenwc_mail_content_free( $mes ) {
	return "";
}