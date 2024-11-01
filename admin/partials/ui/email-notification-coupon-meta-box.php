<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_nonce_field( 'save_sip_advanced_email_notification_meta_box_free', 'sip_advanced_email_notification_meta_box_nonce' );
          ?>
   <div class="card ">
      <div class="card-header">
         <h5 class="card-title">Coupon option</h5>
      </div>
      <div class="card-body">
         <div class="panel clear" id="sip_coupon">
            <div class="options_group row">
              <?php
                  $sip_a_e_n_wc_coupon_exclude_follow_up_email_rule = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_exclude_follow_up_email_rule', true ) ) {
                      $sip_a_e_n_wc_coupon_exclude_follow_up_email_rule = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_exclude_follow_up_email_rule', true );
                  }?>
                  <div class="custom-control custom-checkbox">
              <input name="sip_a_e_n_wc_coupon_exclude_follow_up_email_rule" id="enable-coupon-follow-up-email-rule" value="yes" <?php if( $sip_a_e_n_wc_coupon_exclude_follow_up_email_rule === 'yes'){ echo 'checked'; }?> type="checkbox" data-name="div1" class="my-features checkbox custom-control-input" />
               <label class="custom-control-label" for="enable-coupon-follow-up-email-rule">&nbspEnable coupon for this follow-up email rule</label>
             </div>
               <div class="col-md-6 form-group form-field sip_a_e_n_wc_coupon_enable_field ">
                  
               </div>
               <div class="col-md-6  form-group form-field sip_a_e_n_wc_coupon_pattern_field ">
               <label id="hidden" for="sip_a_e_n_wc_coupon_pattern" ><?php _e('Coupon Name', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
               <?php
                  $sip_a_e_n_wc_coupon_pattern = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_pattern', true ) ) {
                      $sip_a_e_n_wc_coupon_pattern = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_pattern', true );
                  }
                  ?>
               <input type="text" placeholder="" value="<?php echo $sip_a_e_n_wc_coupon_pattern;?>" id="sip_a_e_n_wc_coupon_pattern" name="sip_a_e_n_wc_coupon_pattern" style="" class="short  form-control">
               </div>
               <div class="col-md-6  form-group form-field sip_a_e_n_wc_coupon_expiry_type_field ">
               <label for="sip_a_e_n_wc_coupon_expiry_type" ><?php _e('You can choose fixed expiry date or after x days email is sent', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
               <?php
                  $sip_a_e_n_wc_coupon_expiry_type = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_expiry_type', true ) ) {
                      $sip_a_e_n_wc_coupon_expiry_type = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_expiry_type', true );
                  }?>
               <select style="" class="select short custom-select" name="sip_a_e_n_wc_coupon_expiry_type" id="sip_a_e_n_wc_coupon_expiry_type">
               <option value="fixed_date"   <?php if( $sip_a_e_n_wc_coupon_expiry_type == 'fixed_date' )   { echo 'selected = "selected"';}?> ><?php _e('Fixed date', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
               <option value="after_x_days" <?php if( $sip_a_e_n_wc_coupon_expiry_type == 'after_x_days' ) { echo 'selected = "selected"';}?> ><?php _e('After x day', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
               </select>
               </div>
               <div class="col-md-6  form-group form-field sip_a_e_n_wc_coupon_expiry_date_field ">
               <label for="sip_a_e_n_wc_coupon_expiry_date" ><?php _e('Coupon expiry date', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
               <?php
                  $sip_a_e_n_wc_coupon_expiry_date = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_expiry_date', true ) ) {
                      $sip_a_e_n_wc_coupon_expiry_date = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_expiry_date', true );
                  }?>
               <input type="text" placeholder="YYYY-MM-DD" value="<?php echo $sip_a_e_n_wc_coupon_expiry_date; ?>" id="sip_a_e_n_wc_coupon_expiry_date" name="sip_a_e_n_wc_coupon_expiry_date" style="" class="short  form-control">
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_expiry_after_x_days_field " style="display: none;">
               <label for="sip_a_e_n_wc_coupon_expiry_after_x_days" ><?php _e('Coupon expiry date after x days after email is sent', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
               <?php
                  $sip_a_e_n_wc_coupon_expiry_after_x_days = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_expiry_after_x_days', true ) ) {
                      $sip_a_e_n_wc_coupon_expiry_after_x_days = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_expiry_after_x_days', true );
                  }?>
               <input type="text" placeholder="" value="<?php echo $sip_a_e_n_wc_coupon_expiry_after_x_days; ?>" id="sip_a_e_n_wc_coupon_expiry_after_x_days" name="sip_a_e_n_wc_coupon_expiry_after_x_days" style="" class="short  form-control">
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_type_field">
               <label for="sip_a_e_n_wc_coupon_type" ><?php _e('Coupon type', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
               <?php
                  $sip_a_e_n_wc_coupon_type = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_type', true ) ) {
                      $sip_a_e_n_wc_coupon_type = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_type', true );
                  }?>
               <select style="" class="select short custom-select" name="sip_a_e_n_wc_coupon_type" id="sip_a_e_n_wc_coupon_type">
               <option value="fixed_cart"      <?php if( $sip_a_e_n_wc_coupon_type == 'fixed_cart' )       { echo 'selected = "selected"';}?> ><?php _e('Cart Discount', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
               <option value="percent"         <?php if( $sip_a_e_n_wc_coupon_type == 'percent' )          { echo 'selected = "selected"';}?> ><?php _e('Cart % Discount', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
               <option value="fixed_product"   <?php if( $sip_a_e_n_wc_coupon_type == 'fixed_date' )       { echo 'selected = "selected"';}?> ><?php _e('Product Discount', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
               <option value="percent_product" <?php if( $sip_a_e_n_wc_coupon_type == 'percent_product' )  { echo 'selected = "selected"';}?> ><?php _e('Product % Discount', 'sip-advanced-email-notifications-for-wc-free' ); ?></option>
               </select>
               </div>
               <div class="col-md-6  form-group form-field sip_a_e_n_wc_coupon_amount_field ">
               <label for="sip_a_e_n_wc_coupon_amount" ><?php _e('Amount/Percentage', 'sip-advanced-email-notifications-for-wc-free' ); ?> </label>  <a tabindex="0" class="formhelpp" role="button" data-toggle="tooltip"  data-original-title="<?php _e('E.g 8.8 , do not include percent symbol', 'sip-advanced-email-notifications-for-wc-free' ); ?>"> <i class="ion-ios-help-circle"></i></a>  
               <?php
                  $sip_a_e_n_wc_coupon_amount = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_amount', true ) ) {
                      $sip_a_e_n_wc_coupon_amount = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_amount', true );
                  }?>
               <input type="text" placeholder="" value="<?php echo $sip_a_e_n_wc_coupon_amount;?>" id="sip_a_e_n_wc_coupon_amount" name="sip_a_e_n_wc_coupon_amount" style="" class="short  form-control">
               </div>
               <div class="col-md-6 form-field  form-group  sip_a_e_n_wc_coupon_Usage_limit_field">
               <label for="sip_a_e_n_wc_coupon_Usage_limit" ><?php _e('Usage limit per coupon', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
               <?php
                  $sip_a_e_n_wc_coupon_Usage_limit = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_Usage_limit', true ) ) {
                      $sip_a_e_n_wc_coupon_Usage_limit = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_Usage_limit', true );
                  }?>
               <input type="number" placeholder="Unlimited usage" value="<?php echo $sip_a_e_n_wc_coupon_Usage_limit;?>" id="sip_a_e_n_wc_coupon_Usage_limit" name="sip_a_e_n_wc_coupon_Usage_limit" style="" class="short  form-control">
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_Usage_limit_per_user_field">
               <label for="sip_a_e_n_wc_coupon_Usage_limit_per_user" ><?php _e('Usage limit per user', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
               <?php
                  $sip_a_e_n_wc_coupon_Usage_limit_per_user = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_Usage_limit_per_user', true ) ) {
                      $sip_a_e_n_wc_coupon_Usage_limit_per_user = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_Usage_limit_per_user', true );
                  }?>
               <input type="number" placeholder="Unlimited usage" value="<?php echo $sip_a_e_n_wc_coupon_Usage_limit_per_user;?>" id="sip_a_e_n_wc_coupon_Usage_limit_per_user" name="sip_a_e_n_wc_coupon_Usage_limit_per_user" style="" class="short  form-control">
               </div>
               <div class="col-md-6 form-field  form-group  sip_a_e_n_wc_coupon_Usage_limit_minimum_spend_field">
               <label for="sip_a_e_n_wc_coupon_Usage_limit_minimum_spend" ><?php _e('Minimum spend', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
               <?php
                  $sip_a_e_n_wc_coupon_Usage_limit_minimum_spend = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_Usage_limit_minimum_spend', true ) ) {
                      $sip_a_e_n_wc_coupon_Usage_limit_minimum_spend = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_Usage_limit_minimum_spend', true );
                  }?>
               <input type="number" placeholder="No minimum" value="<?php echo $sip_a_e_n_wc_coupon_Usage_limit_minimum_spend;?>" id="sip_a_e_n_wc_coupon_Usage_limit_minimum_spend" name="sip_a_e_n_wc_coupon_Usage_limit_minimum_spend" style="" class="short  form-control">
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_Usage_limit_maximum_spend_field">
               <label for="sip_a_e_n_wc_coupon_Usage_limit_maximum_spend" ><?php _e('Maximum spend', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
               <?php
                  $sip_a_e_n_wc_coupon_Usage_limit_maximum_spend = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_Usage_limit_maximum_spend', true ) ) {
                      $sip_a_e_n_wc_coupon_Usage_limit_maximum_spend = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_Usage_limit_maximum_spend', true );
                  }?>
               <input type="number" placeholder="No maximum" value="<?php echo $sip_a_e_n_wc_coupon_Usage_limit_maximum_spend;?>" id="sip_a_e_n_wc_coupon_Usage_limit_maximum_spend" name="sip_a_e_n_wc_coupon_Usage_limit_maximum_spend" style="" class="short  form-control">
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_exclude_sale_items_field">
               <div class="custom-control custom-checkbox">
               <?php
                  $sip_a_e_n_wc_coupon_exclude_sale_items = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_exclude_sale_items', true ) ) {
                      $sip_a_e_n_wc_coupon_exclude_sale_items = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_exclude_sale_items', true );
                  }?>
               <input type="checkbox" value="yes" <?php if( $sip_a_e_n_wc_coupon_exclude_sale_items === 'yes'){ echo 'checked'; }?> id="sip_a_e_n_wc_coupon_exclude_sale_items" name="sip_a_e_n_wc_coupon_exclude_sale_items" class="checkbox custom-control-input">
               <label class="custom-control-label" for="sip_a_e_n_wc_coupon_exclude_sale_items" ><?php _e('Exclude sale items', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>  <a tabindex="0" class="formhelpp" role="button" data-toggle="tooltip"  data-original-title="<?php _e('Check this box if the coupon should not apply to items on sale. Per-item coupons will only work if the item is not on sale. Per-cart coupons will only work if there are no sale items in the cart.', 'sip-advanced-email-notifications-for-wc-free' ); ?>"> <i class="ion-ios-help-circle"></i></a>  
               </div>
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_products_field">
               <label for="sip_a_e_n_wc_coupon_products" ><?php _e('Products', 'sip-advanced-email-notifications-for-wc-free' ); ?> </label> <a tabindex="0" class="formhelpp" role="button" data-toggle="tooltip"  data-original-title="<?php _e('Products which need to be in the cart to use this coupon or, for &quot;Product Discounts&quot;, which products are discounted.', 'sip-advanced-email-notifications-for-wc-free' ); ?>"> <i class="ion-ios-help-circle"></i></a>   
               <?php
                  $sip_a_e_n_wc_coupon_products = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_products', true ) ) {
                      $sip_a_e_n_wc_coupon_products = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_products', true );
                  }?>
               <input type="text" placeholder="Name of product" value="<?php echo $sip_a_e_n_wc_coupon_products;?>" id="sip_a_e_n_wc_coupon_products" name="sip_a_e_n_wc_coupon_products" style="" class="short  form-control">
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_exclude_products_field">
               <label for="sip_a_e_n_wc_coupon_exclude_products" ><?php _e('Exclude products', 'sip-advanced-email-notifications-for-wc-free' ); ?>  </label> <a tabindex="0" class="formhelpp" role="button" data-toggle="tooltip"  data-original-title="<?php _e('roducts which must not be in the cart to use this coupon or, for &quot;Product Discounts&quot;, which products are not discounted.', 'sip-advanced-email-notifications-for-wc-free' ); ?>"> <i class="ion-ios-help-circle"></i></a> 
               <?php
                  $sip_a_e_n_wc_coupon_exclude_products = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_exclude_products', true ) ) {
                      $sip_a_e_n_wc_coupon_exclude_products = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_exclude_products', true );
                  }?>
               <input type="text" placeholder="Name of product" value="<?php echo $sip_a_e_n_wc_coupon_exclude_products;?>" id="sip_a_e_n_wc_coupon_exclude_products" name="sip_a_e_n_wc_coupon_exclude_products" style="" class="short  form-control">
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_product_categories_field">
               <label for="sip_a_e_n_wc_coupon_product_categories" ><?php _e('Product categories', 'sip-advanced-email-notifications-for-wc-free' ); ?>    </label> <a tabindex="0" class="formhelpp" role="button" data-toggle="tooltip"  data-original-title="<?php _e('A product must be in this category for the coupon to remain valid or, for &quot;Product Discounts&quot;, products in these categories will be discounted.', 'sip-advanced-email-notifications-for-wc-free' ); ?>"> <i class="ion-ios-help-circle"></i></a> 
               <?php
                  $sip_a_e_n_wc_coupon_product_categories = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_product_categories', true ) ) {
                      $sip_a_e_n_wc_coupon_product_categories = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_product_categories', true );
                  }?>
               <input type="text" placeholder="Any category" value="<?php echo $sip_a_e_n_wc_coupon_product_categories;?>" id="sip_a_e_n_wc_coupon_product_categories" name="sip_a_e_n_wc_coupon_product_categories" style="" class="short  form-control">
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_exclude_categories_field">
               <label for="sip_a_e_n_wc_coupon_exclude_categories" ><?php _e('Exclude categories', 'sip-advanced-email-notifications-for-wc-free' ); ?> </label> <a tabindex="0" class="formhelpp" role="button" data-toggle="tooltip"  data-original-title="<?php _e('Product must not be in this category for the coupon to remain valid or, for &quot;Product Discounts&quot;, products in these categories will not be discounted.', 'sip-advanced-email-notifications-for-wc-free' ); ?>"><i class="ion-ios-help-circle"></i></a> 
               <?php
                  $sip_a_e_n_wc_coupon_exclude_categories = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_exclude_categories', true ) ) {
                      $sip_a_e_n_wc_coupon_exclude_categories = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_exclude_categories', true );
                  }?>
               <input type="text" placeholder="No categories" value="<?php echo $sip_a_e_n_wc_coupon_exclude_categories;?>" id="sip_a_e_n_wc_coupon_exclude_categories" name="sip_a_e_n_wc_coupon_exclude_categories" style="" class="short  form-control">
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_email_restrictions_field">
               <label for="sip_a_e_n_wc_coupon_email_restrictions" ><?php _e('Email restrictions', 'sip-advanced-email-notifications-for-wc-free' ); ?>  </label> <a tabindex="0" class="formhelpp" role="button" data-toggle="tooltip"  data-original-title="<?php _e('List of allowed emails to check against the customer&#039;s billing email when an order is placed. Separate email addresses with commas.', 'sip-advanced-email-notifications-for-wc-free' ); ?>"><i class="ion-ios-help-circle"></i></a> 
               <?php
                  $sip_a_e_n_wc_coupon_email_restrictions = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_email_restrictions', true ) ) {
                      $sip_a_e_n_wc_coupon_email_restrictions = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_email_restrictions', true );
                  }?>
               <input type="email" placeholder="No restrictions" value="<?php echo $sip_a_e_n_wc_coupon_email_restrictions;?>" id="sip_a_e_n_wc_coupon_email_restrictions" name="sip_a_e_n_wc_coupon_email_restrictions" style="" class="short form-control">
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_apply_before_tax_field ">
               <div class="custom-control custom-checkbox">
               <?php
                  $sip_a_e_n_wc_check = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_apply_before_tax', true ) ) {
                      $sip_a_e_n_wc_check = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_apply_before_tax', true );
                  }?>
               <input type="checkbox" value="yes" <?php if( $sip_a_e_n_wc_check === 'yes'){ echo 'checked'; }?> id="sip_a_e_n_wc_coupon_apply_before_tax" name="sip_a_e_n_wc_coupon_apply_before_tax" style="" class="checkbox custom-control-input">
               <label class="custom-control-label" for="sip_a_e_n_wc_coupon_apply_before_tax" ><?php _e('Apply before tax', 'sip-advanced-email-notifications-for-wc-free' ); ?>  </label> <a tabindex="0" class="formhelpp" role="button" data-toggle="tooltip"  data-original-title="<?php _e('Check this check box if the coupon should applied before calculating tax', 'sip-advanced-email-notifications-for-wc-free' ); ?>"> <i class="ion-ios-help-circle"></i></a>  
               </div>
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_individual_use_field ">
               <div class="custom-control custom-checkbox">
               <?php
                  $sip_a_e_n_wc_ind = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_individual_use', true ) ) {
                      $sip_a_e_n_wc_ind = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_individual_use', true );
                  }?>
               <input type="checkbox" value="yes" <?php if( $sip_a_e_n_wc_ind === 'yes'){ echo 'checked'; }?> id="sip_a_e_n_wc_coupon_individual_use" name="sip_a_e_n_wc_coupon_individual_use" style="" class="checkbox custom-control-input">
               <label class="custom-control-label" for="sip_a_e_n_wc_coupon_individual_use" ><?php _e('Individual use', 'sip-advanced-email-notifications-for-wc-free' ); ?> </label> <a tabindex="0" class="formhelpp" role="button" data-toggle="tooltip"  data-original-title="<?php _e('Check this check box if the coupon can not use in with other coupon', 'sip-advanced-email-notifications-for-wc-free' ); ?>"><i class="ion-ios-help-circle"></i></a>  
               </div>
               </div>
               <div class="col-md-6 form-field  form-group sip_a_e_n_wc_coupon_enable_freeshipping_field ">
               <div class="custom-control custom-checkbox">
               <?php
                  $sip_a_e_n_wc_free = '';
                  if( get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_enable_freeshipping', true ) ) {
                      $sip_a_e_n_wc_free = get_post_meta( $post->ID, 'sip_a_e_n_wc_coupon_enable_freeshipping', true );
                  }?>
               <input type="checkbox" value="yes" <?php if( $sip_a_e_n_wc_free === 'yes' ) { echo 'checked'; }?> id="sip_a_e_n_wc_coupon_enable_freeshipping" name="sip_a_e_n_wc_coupon_enable_freeshipping" style="" class="checkbox custom-control-input">
               <label class="custom-control-label" for="sip_a_e_n_wc_coupon_enable_freeshipping" ><?php _e('Enable freeshipping', 'sip-advanced-email-notifications-for-wc-free' ); ?> </label>  <a tabindex="0" class="formhelpp" role="button" data-toggle="tooltip"  data-original-title="<?php _e('Check this check box if the coupon can enable freeshipping', 'sip-advanced-email-notifications-for-wc-free' ); ?>"> <i class="ion-ios-help-circle"></i></a> 
               </div>
               </div>
            </div>
         </div>
         </coupon>
      </div>
   </div>
   <?php