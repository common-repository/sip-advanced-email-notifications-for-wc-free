<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div data-group="0" class="condition-group condition-group-0 parent_div card tx-black bg-light">
				<div class="card-header tx-semibold"><?php _e('Match all of the following rules:', 'sip-advanced-email-notifications-for-wc-free' ); ?></div>
				<div class="sip-condition-0 first-div card-body">
				<div class="row">
					<div class="col-md-3 sip-condition-wrap sip-condition-wrap-0">
						<select name="_sip_shipping_method_conditions[0][0][condition]" class="sip-condition custom-select">
							<optgroup label="Cart">
								<option value="subtotal"><?php _e('Subtotal', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="subtotal_ex_tax"><?php _e('Subtotal ex. taxes', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="tax"><?php _e('Tax', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="pro" disabled><?php _e('Day of the week (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="quantity"><?php _e('Quantity', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="contains_product"><?php _e('Contains product', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="pro" disabled><?php _e('Coupon (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="weight"><?php _e('Weight', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="contains_shipping_class"><?php _e('Shipping class', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="contains_shipping_methods"><?php _e('Shipping Methods', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="contains_shipping_zone"><?php _e('Shipping Zone', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="pro" disabled><?php _e('Payment Method (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="pro" disabled><?php _e('Custom field (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
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
								<option value="pro" disabled><?php _e('Custom field (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
							</optgroup>
							<optgroup label="Product">
								<option value="width"><?php _e('Width', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="height"><?php _e('Height', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="length"><?php _e('Length', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="stock"><?php _e('Stock', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="stock_status"><?php _e('Stock status', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="pro" disabled><?php _e('Category (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="pro" disabled><?php _e('Product type (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?>
								</option>
								<option value="sku"><?php _e('SKU', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
								<option value="pro" disabled><?php _e('Custom field (Pro)', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
							</optgroup>
							<optgroup label="Match All">
								<option value="match_all_orders"><?php _e('Match all orders', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
							</optgroup>
						</select>
					</div>
					<div class="col-md-3 sip-operator-wrap sip-operator-wrap-0">
						<select name="_sip_shipping_method_conditions[0][0][operator]" class="sip-operator custom-select">
							<option value="=="><?php _e('Equal to', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
							<option value="!="><?php _e('Not equal to', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
							<option value=">="><?php _e('Greater or equal to', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
							<option value="<="><?php _e('Less or equal to', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
							<option value="is_empty"><?php _e('is empty', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
							<option value="is_not_empty"><?php _e('is not empty', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
						</select>
					</div>
					<div class="col-md-3 sip-value-wrap sip-value-wrap-0">
						<input type="text" value="" placeholder="" name="_sip_shipping_method_conditions[0][0][value]" class="sip-value form-control">
					</div>
					<div class="col-md-3 condition-add-delete">
						<a href="javascript:void(0);" data-group="0" class="btn btn-outline-success  btn-md text-decoration-none  condition-add disabled">+</a>
						<a href="javascript:void(0);" data-group="0" class="btn btn-outline-danger  btn-md text-decoration-none  condition-delete disabled">-</a>
					</div>
				</div>
				</div>
			</div>