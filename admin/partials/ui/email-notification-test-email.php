<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	wp_nonce_field( 'save_sip_advanced_email_notification_meta_box_free', 'sip_advanced_email_notification_meta_box_nonce' );
?>
	<div class="card ">
		<div class="card-header">
			<h5 class="card-title">Test Email</h5>
		</div>
		<div class="card-body">
			<div class="panel clear" id="sip_coupon">
				<div class="options_group row">
				<div class=" col-md-6 form-field sip_a_e_n_wc_test_email_field ">
					<label for="sip_a_e_n_wc_test_email" ><?php _e('Email', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
					<?php
						$sip_a_e_n_wc_test_email = '';
						if( get_post_meta( $post->ID, 'sip_a_e_n_wc_test_email', true ) ) {
							$sip_a_e_n_wc_test_email = get_post_meta( $post->ID, 'sip_a_e_n_wc_test_email', true );
						}
						?>
					<input type="text" placeholder="name@example.com" value="<?php echo esc_html($sip_a_e_n_wc_test_email);?>" id="sip_a_e_n_wc_test_email" name="sip_a_e_n_wc_test_email" style="" class="short form-control">
				</div>
				<div class="col-md-6  form-field">
					<?php $order_id = sip_aenwc_get_last_order_id_free(); ?>
					<?php if (empty($order_id)) { ?>
						<label for="sip_a_e_n_wc_test_email_button" ><?php _e('At least one order is required to send a test email, please place a test order and refresh this page (save your changes first).', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
					<?php } else { ?>
						<label for="sip_a_e_n_wc_test_email_button" ><?php _e('Test Mail', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
						<input type="hidden" value="<?php echo $post->ID; ?>" id="sip_a_e_n_wc_test_email_id">
						<?php $ajax_nonce = wp_create_nonce( "sip-aenwc-ajax-nonce" ); ?>
						<input type="hidden" value="<?php echo $ajax_nonce; ?>" id="sip_a_e_n_wc_ajax_nonce">
						<input type="button" value="Send" id="sip_a_e_n_wc_test_email_button" class="short btn btn-danger d-block">
					<?php } ?>
				</div>
				<div align="center" id="sip-a-e-n-wc-test-email-<?php echo $post->ID; ?>" style="display:none"><img src="<?php echo SIP_AENWCF_URL; ?>admin/images/ajax-loader-email.gif" width="100"></div>
				</div>
			</div>
		</div>
	</div>