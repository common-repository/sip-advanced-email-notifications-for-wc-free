<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_nonce_field( 'save_sip_advanced_email_notification_meta_box_free', 'sip_advanced_email_notification_meta_box_nonce' );
    global $woocommerce;
?>
    <div class="card ">
		<div class="card-header">
			<h5 class="card-title">Advanced Email conditions</h5>
		</div>
		<div class="card-body">
			<div class="copy-html" style="display: none">
			<h2 class="condition-or-group-0 add-orcl-btn">Or</h2>
			<div data-group="0"  class="condition-group parent_div card tx-black bg-light">
				<div class="card-header tx-semibold"><?php _e('Match all of the following rules:', 'sip-advanced-email-notifications-for-wc-free' ); ?></div>
					<div class="sip-condition-0 first-div card-body">
						<div class="row">
							<div class="col-md-3 sip-condition-wrap sip-condition-wrap-1">
								<select name="" class="sip-condition custom-select">
									<optgroup label="Cart">
										<option value="subtotal"><?php _e('Subtotal', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="subtotal_ex_tax"><?php _e('Subtotal ex. taxes', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="tax"><?php _e('Tax', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="pro" disabled><?php _e('Day of the week', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="quantity"><?php _e('Quantity', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="contains_product"><?php _e('Contains product', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="pro" disabled><?php _e('Coupon', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="weight"><?php _e('Weight', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="contains_shipping_class"><?php _e('Shipping class', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="contains_shipping_methods"><?php _e('Shipping Methods', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="contains_shipping_zone"><?php _e('Shipping Zone', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="pro" disabled><?php _e('Payment Method', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="pro" disabled><?php _e('Custom field', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									</optgroup>
									<optgroup label="User Details">
										<option value="zipcode"><?php _e('Zipcode', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="shipping_zipcode"><?php _e('Shipping Zipcode', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="city"><?php _e('City', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="shipping_city"><?php _e('Shipping City', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="state"><?php _e('State', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="shipping_state"><?php _e('Shipping State', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="country"><?php _e('Country', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="shipping_country"><?php _e('Shipping Country', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="role"><?php _e('User role', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="email"><?php _e('Email', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="pro" disabled><?php _e('Custom field', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									</optgroup>
									<optgroup label="Product">
										<option value="width"><?php _e('Width', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="height"><?php _e('Height', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="length"><?php _e('Length', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="stock"><?php _e('Stock', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="stock_status"><?php _e('Stock status', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="pro" disabled><?php _e('Category', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="sku"><?php _e('SKU', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="pro" disabled><?php _e('Product type', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
										<option value="pro" disabled><?php _e('Custom field', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									</optgroup>
									<optgroup label="Match All">
										<option value="match_all_orders"><?php _e('Match all orders', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									</optgroup>
								</select>
							</div>
							<div class="col-md-3 sip-operator-wrap sip-operator-wrap-1 d-none">
								<select name="" class="sip-operator custom-select">
									<option value="=="><?php _e('Equal to', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="!="><?php _e('Not equal to', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value=">="><?php _e('Greater or equal to', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="<="><?php _e('Less or equal to', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="is_empty"><?php _e('is empty', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="is_not_empty"><?php _e('is not empty', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								</select>
							</div>
							<div class="col-md-3 sip-value-wrap custom-select">
								<input type="text" value="" placeholder="" name="" class="sip-value form-control">
								<!-- <input type="hidden" value="< ? php //echo $cur;?>" placeholder="" name=""
										class="sip-value-spy">       -->
							</div>
							<div class="col-md-3 condition-add-delete">
								<a href="javascript:void(0);" data-group="" class="btn btn-outline-success  btn-md text-decoration-none  condition-add disabled">+</a>                
								<a href="javascript:void(0);" class="btn btn-outline-danger  btn-md text-decoration-none  condition-delete disabled">-</a>                
								<span class="sip-description no-description"></span>
							</div>
						</div>
					</div>
			</div>
		</div>
		
		<?php
			$countries_obj = new WC_Countries();
			if (is_callable(array($countries_obj, 'get_states'))) {
				$res = '';
				foreach( array_filter( $countries_obj->get_states() ) as $key => $val ) {
					$res .= '<optgroup label="'.$key.'">';
					foreach($val as $k => $v){
						$v = str_replace("'", " ", $v);
						$res .= "<option value='".$key."_".$k."'>".str_replace( ";", " ", $v )."</options>";
					}
					$res .="</optgroup>";
				}
				echo '<select name="" class="sip-value select-city hidden">'.$res.'</select>';
			}
		?>


		<div class="sip sip_conditions sip_meta_box sip_conditions_meta_box">

		<?php
		if( get_post_meta( $post->ID, '_sip_shipping_method_conditions', true ) ) {
			$res = get_post_meta( $post->ID, '_sip_shipping_method_conditions', true );
			
			$i = 0;
			if ( $res ) {
				foreach( $res as $key => $value ) { 
		?>
				<?php 
					if ( $i > 0 ) {
				?>
					<h2 class="condition-or-group-<?php echo $i; ?> add-orcl-btn">Or</h2>
				<?php 
					}
				?>
				<div data-group="<?php echo $key;?>" class="condition-group condition-group-<?php echo $key;?> parent_div card tx-black bg-light">
					<?php
					if( $i > 0 ) {
						echo '<div class="card-header tx-semibold">'. esc_html__('Match all of the following rules:', 'sip-advanced-email-notifications-for-wc-free' ).'</div>';
					}
					$i++;
					foreach ($value as $keys => $val) {
						$cond = $val['condition'];
					?>
					<div class="sip-condition-0 first-div card-body">
					<div class="row">
						<div class="col-md-3 sip-condition-wrap sip-condition-wrap-0">

							<select name="_sip_shipping_method_conditions[<?php echo $key;?>][<?php echo $keys;?>][condition]" class="sip-condition custom-select">
								<optgroup label="Cart">
									<option value="subtotal" <?php echo ($cond == "subtotal")? 'selected ="selected"': ''; ?>><?php _e('Subtotal', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="subtotal_ex_tax" <?php echo ($cond == "subtotal_ex_tax")? 'selected ="selected"': ''; ?>><?php _e('Subtotal ex. taxes', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="tax" <?php echo ($cond == "tax")?'selected ="selected"':''; ?>><?php _e('Tax', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="pro" disabled><?php _e('Day of the week (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="quantity" <?php echo ($cond == "quantity")? 'selected ="selected"':''; ?>><?php _e('Quantity', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="contains_product" <?php echo ($cond == "contains_product")? 'selected ="selected"':''; ?>><?php _e('Contains product', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="pro" disabled><?php _e('Coupon (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="weight" <?php echo ($cond == "weight")? 'selected ="selected"':''; ?>><?php _e('Weight', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="contains_shipping_class" <?php echo ($cond == "contains_shipping_class")? 'selected ="selected"':''; ?>><?php _e('Shipping class', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="contains_shipping_methods" <?php echo ($cond == "contains_shipping_methods")? 'selected ="selected"':''; ?>><?php _e('Shipping Methods', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="contains_shipping_zone" <?php echo ($cond == "contains_shipping_zone")? 'selected ="selected"':''; ?>><?php _e('Shipping Zone', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="pro" disabled><?php _e('Payment Method (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="pro" disabled><?php _e('Custom field (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								</optgroup>
								<optgroup label="User Details">
									<option value="zipcode" <?php echo ($cond == "zipcode")? 'selected ="selected"':''; ?>><?php _e('Zipcode', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="shipping_zipcode" <?php echo ($cond == "shipping_zipcode")? 'selected ="selected"':''; ?>><?php _e('Shipping Zipcode', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="city" <?php echo ($cond == "city")? 'selected ="selected"':''; ?>><?php _e('City', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="shipping_city" <?php echo ($cond == "shipping_city")? 'selected ="selected"':''; ?>><?php _e('Shipping City', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="state" <?php echo ($cond == "state")? 'selected ="selected"':''; ?>><?php _e('State', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="shipping_state" <?php echo ($cond == "shipping_state")? 'selected ="selected"':''; ?>><?php _e('Shipping State', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="country" <?php echo ($cond == "country")? 'selected ="selected"':''; ?>><?php _e('Country', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="shipping_country" <?php echo ($cond == "shipping_country")? 'selected ="selected"':''; ?>><?php _e('Shipping Country', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="role" <?php echo ($cond == "role")? 'selected ="selected"':''; ?>><?php _e('User role', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="email" <?php echo ($cond == "email")? 'selected ="selected"':''; ?>><?php _e('Email', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="pro" disabled><?php _e('Custom field (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								</optgroup>
								<optgroup label="Product">
									<option value="width" <?php echo ($cond == "width")? 'selected ="selected"':''; ?>><?php _e('Width', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="height" <?php echo ($cond == "height")? 'selected ="selected"':''; ?>><?php _e('Height', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="length" <?php echo ($cond == "length")? 'selected ="selected"':''; ?>><?php _e('Length', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="stock" <?php echo ($cond == "stock")? 'selected ="selected"':''; ?>><?php _e('Stock', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="stock_status" <?php echo ($cond == "stock_status")? 'selected ="selected"':''; ?>><?php _e('Stock status', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="pro" disabled><?php _e('Category (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="pro" disabled><?php _e('Product type (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="sku" <?php echo ($cond == "sku")? 'selected ="selected"':''; ?>><?php _e('SKU', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
									<option value="pro" disabled><?php _e('Custom field (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								</optgroup>
								<optgroup label="Match All">
									<option value="match_all_orders"  <?php echo ($cond == "match_all_orders")? 'selected ="selected"':''; ?>><?php _e('Match all orders', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								</optgroup>
							</select>

						</div>
						<div class="col-md-3 sip-operator-wrap sip-operator-wrap-0 <?php if ($cond == "match_all_orders") { echo 'd-none'; }?>">
							<?php $oper = $val['operator'];?>
							<input type="text" value="<?php echo esc_html($oper);?>" placeholder=""
								name="_sip_shipping_method_conditions[<?php echo $key;?>][<?php echo $keys;?>][operator]"
								class="sip-operator form-control">
						</div>
						<div class="col-md-3 sip-value-wrap sip-value-wrap-0 <?php if ($cond == "match_all_orders") { echo 'd-none'; }?>">
							<?php $cur = ( isset($val['value']) ? $val['value'] : "") ;?>
							<?php $is_disabled = ( ( $oper == "is_not_empty" || $oper == "is_empty" ) ? "disabled" : "" ); ?>
							<?php $is_disabled = ( ( $cond == "product_meta" || $cond == "user_meta" || $cond == "custom_field" ) ? "" : $is_disabled); ?>
							<input type="text" value="<?php echo $cur;?>" placeholder=""
								name="_sip_shipping_method_conditions[<?php echo $key;?>][<?php echo $keys;?>][value]"
								class="sip-value form-control" <?php echo $is_disabled; ?>>
							<input type="hidden" value="<?php echo $cur;?>" placeholder="" name=""
								class="sip-value-spy">
						</div>
						<div class="col-md-3 condition-add-delete <?php if ($cond == "match_all_orders") { echo 'd-none'; }?>">
							<a href="javascript:void(0);" data-group="<?php echo $key;?>" class="btn btn-outline-success  btn-md text-decoration-none  condition-add disabled" >+</a>
							<a href="javascript:void(0);" data-group="<?php echo $key;?>" class="btn btn-outline-danger  btn-md text-decoration-none  condition-delete disabled">-</a>
						</div>
					</div>
					</div>
					<?php
					}
					?>
				</div>
		<?php
				}
			}
		}else{
			require_once(SIP_AENWCF_DIR . "admin/partials/ui/email-notification-new-condition.php");  
		}
		?>
		</div>

		<div class="card-footer border-top-0"> <a href="javascript:void(0);" class="btn btn-danger condition-group-add text-decoration-none disabled"><?php _e("Add Or group", 'sip-advanced-email-notifications-for-wc-free' ); ?></a></div>

		<div class=" card tx-black bg-light">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4 form-field sip_a_e_n_wc_order_status_field">
						<label for="sip_a_e_n_wc_order_status_field" ><?php _e('AND status of order', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
						<?php
							$order = '';
							if( get_post_meta( $post->ID, 'sip_a_e_n_wc_order_status_field', true ) ) {
								$order = get_post_meta( $post->ID, 'sip_a_e_n_wc_order_status_field', true );
							}
							?>
						<select style="" class="select short custom-select" name="sip_a_e_n_wc_order_status_field" id="sip_a_e_n_wc_order_status_field">
							<?php
								$array1 = wc_get_order_statuses();
								$array2 = array();
								$array = array_merge($array1,$array2);
								foreach ($array as $key => $value) {
									$key = str_replace('wc-', '', $key);
									?>
							<option value="<?php echo $key; ?>"   <?php if( $order == $key )   { echo 'selected="selected"';}?> ><?php echo $value; ?></option>
							<?php
								}
								?>
						</select>
					</div>

					<div class="col-md-3 form-field sip_a_e_n_wc_status_field ">
						<label for="sip_a_e_n_wc_status" ><?php _e('Status', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
						<?php
							$status = '';
							if( get_post_meta( $post->ID, 'sip_a_e_n_wc_status', true ) ) {
								$status = get_post_meta( $post->ID, 'sip_a_e_n_wc_status', true );
							}
							?>
						<select style="" class="select short custom-select" name="sip_a_e_n_wc_status" id="sip_a_e_n_wc_status">
							<option value="active"   <?php if( $status == 'active' )    { echo 'selected="selected"';}?> ><?php _e('Active', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
							<option value="inactive" <?php if( $status == 'inactive' )  { echo 'selected="selected"';}?> ><?php _e('Inactive', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
						</select>
					</div>

					<div class="col-md-5 form-field sip_a_e_n_wc_multeple_email_field ">
						<label for="sip_a_e_n_wc_multeple_email" ><?php _e('Send one email per customer for this rule', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
						<?php
							$status = 'no';
							if( get_post_meta( $post->ID, 'sip_a_e_n_wc_multeple_email', true ) ) {
								$status = get_post_meta( $post->ID, 'sip_a_e_n_wc_multeple_email', true );
							}
							?>
						<select style="" class="select short custom-select" name="sip_a_e_n_wc_multeple_email" id="sip_a_e_n_wc_multeple_email">
							<option value="yes"   <?php if( $status == 'yes' )    { echo 'selected="selected"';}?> ><?php _e('Yes', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
							<option value="no" <?php if( $status == 'no' )  { echo 'selected="selected"';}?> ><?php _e('No', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
						</select>
					</div>


				</div>
			</div>
		</div>

	</div>

    