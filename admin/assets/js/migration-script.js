
/* 
	Migrate script tag js
*/
var $ = jQuery;
$(document).ready(function(){

	if($("#bulk-action-selector-top").length > 0){
		$( "#bulk-action-selector-top" ).addClass( "custom-select" );
		$( "#bulk-action-selector-bottom" ).addClass( "custom-select" );
		$( "#doaction" ).removeClass( "button" ) .addClass( "btn btn-danger " );
		$( "#doaction2" ).removeClass( "button" ) .addClass( "btn btn-danger " );
	}
	

	if ($('.my-features').length > 0 && $('.my-features').is(':checked')) {
		// $('#' + coupon).show();
		$('#sip_a_e_n_wc_coupon_enable').hide();
		$('#hidden').show();
		$('.sip_a_e_n_wc_coupon_pattern_field').show();
		$('#sip_a_e_n_wc_coupon_expiry_type_field').show();
		$('.sip_a_e_n_wc_coupon_type_field').show();
		$('#sip_a_e_n_wc_coupon_expiry_type').show();
		$('.sip_a_e_n_wc_coupon_expiry_type_field').show();
		$('.sip_a_e_n_wc_coupon_amount_field').show();
		$('.sip_a_e_n_wc_coupon_expiry_date_field').show();
		$('.sip_a_e_n_wc_coupon_Usage_limit_field').show();
		$('.sip_a_e_n_wc_coupon_Usage_limit_per_user_field').show();
		$('.sip_a_e_n_wc_coupon_Usage_limit_minimum_spend_field').show();
		$('.sip_a_e_n_wc_coupon_Usage_limit_maximum_spend_field').show();
		$('.sip_a_e_n_wc_coupon_exclude_sale_items_field').show();
		$('.sip_a_e_n_wc_coupon_products_field').show();
		$('.sip_a_e_n_wc_coupon_exclude_products_field').show();
		$('.sip_a_e_n_wc_coupon_product_categories_field').show();
		$('.sip_a_e_n_wc_coupon_email_restrictions_field').show();
		$('.sip_a_e_n_wc_coupon_exclude_categories_field').show();
		$('.sip_a_e_n_wc_coupon_apply_before_tax_field').show();
		$('.sip_a_e_n_wc_coupon_individual_use_field').show();
		$('.sip_a_e_n_wc_coupon_enable_freeshipping_field').show();
	

		$('.my-features').on('click', function () {
			var checkbox = $(this);
			var coupon = checkbox.data('name');
			if (checkbox.is(':checked')) {
				$('#' + coupon).show();
				$('#sip_a_e_n_wc_coupon_enable').hide();
				$('#hidden').show();
				$('.sip_a_e_n_wc_coupon_pattern_field').show();
				$('#sip_a_e_n_wc_coupon_expiry_type_field').show();
				$('.sip_a_e_n_wc_coupon_type_field').show();
				$('#sip_a_e_n_wc_coupon_expiry_type').show();
				$('.sip_a_e_n_wc_coupon_expiry_type_field').show();
				$('.sip_a_e_n_wc_coupon_amount_field').show();
				$('.sip_a_e_n_wc_coupon_expiry_date_field').show();
				$('.sip_a_e_n_wc_coupon_Usage_limit_field').show();
				$('.sip_a_e_n_wc_coupon_Usage_limit_per_user_field').show();
				$('.sip_a_e_n_wc_coupon_Usage_limit_minimum_spend_field').show();
				$('.sip_a_e_n_wc_coupon_Usage_limit_maximum_spend_field').show();
				$('.sip_a_e_n_wc_coupon_exclude_sale_items_field').show();
				$('.sip_a_e_n_wc_coupon_products_field').show();
				$('.sip_a_e_n_wc_coupon_exclude_products_field').show();
				$('.sip_a_e_n_wc_coupon_product_categories_field').show();
				$('.sip_a_e_n_wc_coupon_email_restrictions_field').show();
				$('.sip_a_e_n_wc_coupon_exclude_categories_field').show();
				$('.sip_a_e_n_wc_coupon_apply_before_tax_field').show();
				$('.sip_a_e_n_wc_coupon_individual_use_field').show();
				$('.sip_a_e_n_wc_coupon_enable_freeshipping_field').show();
			} else {
				$('#' + coupon).hide();
				$('#sip_a_e_n_wc_coupon_enable').hide();
				$('#hidden').hide();
				$('.sip_a_e_n_wc_coupon_pattern_field').hide();
				$('#sip_a_e_n_wc_coupon_expiry_type_field').hide();
				$('.sip_a_e_n_wc_coupon_type_field').hide();
				$('#sip_a_e_n_wc_coupon_expiry_type').hide();
				$('.sip_a_e_n_wc_coupon_expiry_type_field').hide();
				$('.sip_a_e_n_wc_coupon_amount_field').hide();
				$('.sip_a_e_n_wc_coupon_expiry_date_field').hide();
				$('.sip_a_e_n_wc_coupon_Usage_limit_field').hide();
				$('.sip_a_e_n_wc_coupon_Usage_limit_per_user_field').hide();
				$('.sip_a_e_n_wc_coupon_Usage_limit_minimum_spend_field').hide();
				$('.sip_a_e_n_wc_coupon_Usage_limit_maximum_spend_field').hide();
				$('.sip_a_e_n_wc_coupon_exclude_sale_items_field').hide();
				$('.sip_a_e_n_wc_coupon_products_field').hide();
				$('.sip_a_e_n_wc_coupon_exclude_products_field').hide();
				$('.sip_a_e_n_wc_coupon_product_categories_field').hide();
				$('.sip_a_e_n_wc_coupon_email_restrictions_field').hide();
				$('.sip_a_e_n_wc_coupon_exclude_categories_field').hide();
				$('.sip_a_e_n_wc_coupon_apply_before_tax_field').hide();
				$('.sip_a_e_n_wc_coupon_individual_use_field').hide();
				$('.sip_a_e_n_wc_coupon_enable_freeshipping_field').hide();
				// $('#' + checkbox.attr('data-name')).hide();
			}
		});

	}


	
	/*end*/


	/** email condition script starts */

	function sip_aenwc_products( ) {
		var res = saenwc_migrate_variables.products;
		return res;
	}
	
	function sip_aenwc_roles( ) {
		var res = saenwc_migrate_variables.roles;
		return res;
	}
	function sip_aenwc_country( ) {
		var res = saenwc_migrate_variables.get_all_countries;
		return res;
	}
	function sip_aenwc_custom_field( ) {
		var res = '<input name="" type="text" class="sip-value form-control" placeholder="Variable_name, compare Value">';
		return res;
	}
	function sip_aenwc_sku( ) {
		var res = saenwc_migrate_variables.product_skus;
		return res;
	}
	function sip_aenwc_payment_gateways( ) {
		var res = saenwc_migrate_variables.get_all_payment_gateways;
		return res;
	}
	function sip_aenwc_states( ) {
		var res = jQuery('.select-city').clone().removeClass('select-city hidden');
		return res;
	}
	function sip_aenwc_shipping_states( ) {
		var res = jQuery('.select-city').clone().removeClass('select-city hidden');
		return res;
	}
	function sip_aenwc_shipping( ) {
		var ress_shipping = saenwc_migrate_variables.get_shipping_classes;
		return ress_shipping;
	}
	function sip_aenwc_shipping_methods( ) {
		var ress_shipping = saenwc_migrate_variables.get_shipping_methods;
		return ress_shipping;
	}
	function sip_aenwc_shipping_zone( ) {
		var ress_shipping = saenwc_migrate_variables.get_shipping_zone;
		return ress_shipping;
	}
	function sip_aenwc_stock_status( ) {
		return '<select name="" class="sip-value custom-select"><option value="instock">'+saenwc_migrate_variables.static_text_arr.in_stock+'</option><option value="outofstock">'+saenwc_migrate_variables.static_text_arr.out_of_stock+'</option></select>'
	}
	
	function sip_aenwc_desc( text ) {
		var des = '<div class="description">' +
		'<img width="24" height="24" src="'+saenwc_migrate_variables.woocommerce_plugin_url+'assets/images/help.png" class="sip_tip">' +
		'<div class="sip_desc">'+text+'</div>' +
		'</div>';
		return;
	}
	jQuery(document).on('change', '.sip-condition', function () {
		jQuery(this).closest('.first-div').find('.sip-value').val('');
		var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
		jQuery(this).closest('.first-div').find('.sip-value-wrap').html('<input value="" class="sip-value form-control" type="text" name="' + name + '" placeholder="">');
		jQuery(this).closest('.first-div').find('.sip-description').empty();
		sip_aenwc_numerical_operators(jQuery(this));
		var condition = jQuery(this).val();
		sip_aenwc_operators_hide_all( jQuery(this), condition );
		switch (condition) {
			case 'contains_product':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_products()).find('.sip-value').attr('name', name);
				jQuery(this).closest('.first-div').find('.sip-description').html(sip_aenwc_desc('Cart must contain one of this product, other products are allowed'));
				sip_aenwc_operators(jQuery(this));
				break;
			case 'contains_shipping_class':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_shipping()).find('.sip-value').attr('name', name);
				jQuery(this).closest('.first-div').find('.sip-description').html(sip_aenwc_desc('Cart must contain at least one product with the selected shipping class'));
				sip_aenwc_operators(jQuery(this));
				break;
			case 'contains_shipping_methods':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_shipping_methods()).find('.sip-value').attr('name',name);
				jQuery(this).closest('.first-div').find('.sip-description').html(sip_aenwc_desc('Cart must contain at least one product with the selected shipping methods'));
				sip_aenwc_operators(jQuery(this));
				break;
			case 'contains_shipping_zone':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_shipping_zone()).find('.sip-value').attr('name',name);
				jQuery(this).closest('.first-div').find('.sip-description').html(sip_aenwc_desc('Cart must contain at least one product with the selected shipping zone'));
				sip_aenwc_operators(jQuery(this));
				break;
			case 'state':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_states()).find('.sip-value').attr('name', name);
				jQuery(this).closest('.first-div').find('.sip-description').html(sip_aenwc_desc('States must be installed in WC'));
				sip_aenwc_operators(jQuery(this));
				break;
			case 'shipping_state':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_shipping_states()).find('.sip-value').attr('name', name);
				jQuery(this).closest('.first-div').find('.sip-description').html(sip_aenwc_desc('States must be installed in WC'));
				sip_aenwc_operators(jQuery(this));
				break;
			case 'country' :
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_country()).find('.sip-value').attr('name', name);
				sip_aenwc_operators(jQuery(this));
				break;
			case 'custom_field' :
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_custom_field()).find('.sip-value').attr('name', name);
				sip_aenwc_operators_all(jQuery(this));
				break;
			case 'match_all_orders' :
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_custom_field()).find('.sip-value').attr('name', name);
				break;
			case 'user_meta' :
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_custom_field()).find('.sip-value').attr('name', name);
				sip_aenwc_operators_all(jQuery(this));
				break;
			case 'product_meta' :
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_custom_field()).find('.sip-value').attr('name', name);
				sip_aenwc_operators_all(jQuery(this));
				break;
			case 'shipping_country' :
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_country()).find('.sip-value').attr('name', name);
				sip_aenwc_operators(jQuery(this));
				break;
			case 'city':
				sip_aenwc_operators(jQuery(this));
				break;
			case 'shipping_city':
				sip_aenwc_operators(jQuery(this));
				break;
			case 'email':
				sip_aenwc_operators(jQuery(this));
				break;
			case 'sku':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_sku()).find('.sip-value').attr('name', name);
				sip_aenwc_operators(jQuery(this));
				break;
			case 'payment_method':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_payment_gateways()).find('.sip-value').attr('name', name);
				sip_aenwc_operators(jQuery(this));
				break;
			case 'zipcode':
				sip_aenwc_operators(jQuery(this));
				break;
			case 'shipping_zipcode':
				sip_aenwc_operators(jQuery(this));
				break;
			case 'role':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_roles()).find('.sip-value').attr('name', name);
				sip_aenwc_operators(jQuery(this));
				break;
			case 'stock_status':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_stock_status()).find('.sip-value').attr('name', name);
				jQuery(this).closest('.first-div').find('.sip-description').html(sip_aenwc_desc('All products in cart must match stock status'));
				sip_aenwc_operators(jQuery(this));
				break;
		}
	});
	function sip_aenwc_contains_free( ) {
		return '<select name="" class="sip-operator custom-select"><option value="exactly_match">'+saenwc_migrate_variables.static_text_arr.exactly_match+'</option><option value="contains">'+saenwc_migrate_variables.static_text_arr.contains+'</option><option value="not_contains">'+saenwc_migrate_variables.static_text_arr.does_not_contain+'</option><option value="is_empty">'+saenwc_migrate_variables.static_text_arr.is_empty+'</option><option value="is_not_empty">'+saenwc_migrate_variables.static_text_arr.is_not_empty+'</option></select>';
	}
	function sip_aenwc_contains_all( ) {
		return '<select name="" class="sip-operator custom-select"><option value="exactly_match">'+saenwc_migrate_variables.static_text_arr.exactly_match+'</option><option value="contains">'+saenwc_migrate_variables.static_text_arr.contains+'</option><option value="not_contains">'+saenwc_migrate_variables.static_text_arr.does_not_contain+'</option><option value="==">'+saenwc_migrate_variables.static_text_arr.equal_to+'</option><option value="!=">'+saenwc_migrate_variables.static_text_arr.not_equal_to+'</option><option value=">=">'+saenwc_migrate_variables.static_text_arr.greater_or_equal_to+'</option><option value="<=">'+saenwc_migrate_variables.static_text_arr.less_or_equal_to+'</option><option value="is_empty">'+saenwc_migrate_variables.static_text_arr.is_empty+'</option><option value="is_not_empty">'+saenwc_migrate_variables.static_text_arr.is_not_empty+'</option></select>';
	}
	function sip_aenwc_operators( elem ) {
		var operator = elem.closest('.first-div').find('.sip-operator-wrap').find('.sip-operator').attr('name');
		elem.closest('.first-div').find('.sip-operator-wrap').html(sip_aenwc_contains_free()).find('.sip-operator').attr('name', operator);
	}
	function sip_aenwc_operators_all( elem ) {
		var operator = elem.closest('.first-div').find('.sip-operator-wrap').find('.sip-operator').attr('name');
		elem.closest('.first-div').find('.sip-operator-wrap').html(sip_aenwc_contains_all()).find('.sip-operator').attr('name', operator);
	}
	function sip_aenwc_operators_hide_all( elem, condition ) {

		switch (condition) {
		case 'match_all_orders':
			elem.closest('.first-div').find(".sip-operator-wrap, .condition-add-delete, .sip-value-wrap").addClass("d-none");
			elem.closest('.first-div').find(".sip-operator-wrap, .condition-add-delete, .sip-value-wrap").removeClass("d-inline");
		break;

		default :
			elem.closest('.first-div').find(".sip-operator-wrap, .condition-add-delete, .sip-value-wrap").addClass("d-inline");
			elem.closest('.first-div').find(".sip-operator-wrap, .condition-add-delete, .sip-value-wrap").removeClass("d-none");
		break;
		}
	}
	function sip_aenwc_operators_all_val( elem ) {
		var operator = elem.find('.sip-operator-wrap').find('.sip-operator').attr('name');
		var operator_val = elem.find('.sip-operator-wrap').find('.sip-operator').val();
		elem.find('.sip-operator-wrap').html(sip_aenwc_contains_all()).find('.sip-operator').attr('name', operator).val(operator_val);
	}
	function sip_aenwc_operators_val( elem ) {
		var operator = elem.find('.sip-operator-wrap').find('.sip-operator').attr('name');
		var operator_val = elem.find('.sip-operator-wrap').find('.sip-operator').val();
		elem.find('.sip-operator-wrap').html(sip_aenwc_contains_free()).find('.sip-operator').attr('name', operator).val(operator_val);
	}
	function sip_aenwc_num_operator( ) {
		return '<select name="" class="sip-operator custom-select"><option value="==">'+saenwc_migrate_variables.static_text_arr.equal_to+'</option><option value="!=">'+saenwc_migrate_variables.static_text_arr.not_equal_to+'</option><option value=">=">'+saenwc_migrate_variables.static_text_arr.greater_or_equal_to+'</option><option value="<=">'+saenwc_migrate_variables.static_text_arr.less_or_equal_to+'</option><option value="is_empty">'+saenwc_migrate_variables.static_text_arr.is_empty+'</option><option value="is_not_empty">'+saenwc_migrate_variables.static_text_arr.is_not_empty+'</option></select>';
	}
	function sip_aenwc_numerical_operators( elem ) {
		var operator = elem.closest('.first-div').find('.sip-operator-wrap').find('.sip-operator').attr('name');
		elem.closest('.first-div').find('.sip-operator-wrap').html(sip_aenwc_num_operator()).find('.sip-operator').attr('name', operator);
	}
	function sip_aenwc_numerical_operators_values( elem ) {
		var operator = elem.find('.sip-operator-wrap').find('.sip-operator').attr('name');
		var operator_val = elem.find('.sip-operator-wrap').find('.sip-operator').val();
		elem.find('.sip-operator-wrap').html(sip_aenwc_num_operator()).find('.sip-operator').attr('name', operator).val(operator_val);
	}
	function sip_aenwc_operator_check_contains( elem, html, name, val, operator ) {
		switch (operator) {
			case 'exactly_match':
				elem.find('.sip-value-wrap').html(html).find('.sip-value').attr('name', name).val(val);
				break;
		}
	}
	jQuery('.sip .parent_div .first-div').each(function () {
		var condition = jQuery(this).find('.sip-condition').val();
		var operator = jQuery(this).find('.sip-operator').val();
		var val = jQuery(this).find('.sip-value').val();
		switch (condition) {
			case 'contains_product':
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_products(), name,val, operator );
				jQuery(this).find('.sip-description').html(sip_aenwc_desc('Cart must contain one of this product, other products are allowed'));
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'contains_shipping_class':
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_shipping(), name,val, operator );
				jQuery(this).find('.sip-description').html(sip_aenwc_desc('Cart must contain at least one product with the selected shipping class'));
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'contains_shipping_methods':
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_shipping_methods(), name,val, operator );
				jQuery(this).find('.sip-description').html(sip_aenwc_desc('Cart must contain at least one product with the selected shipping class'));
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'contains_shipping_zone':
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_shipping_zone(), name,val, operator );
				jQuery(this).find('.sip-description').html(sip_aenwc_desc('Cart must contain at least one product with the selected shipping class'));
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'state':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_states(), name,val, operator );
				jQuery(this).find('.sip-description').html(sip_aenwc_desc('States must be installed in WC'));
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'shipping_state':
				var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_shipping_states(), name,val, operator );
				jQuery(this).find('.sip-description').html(sip_aenwc_desc('States must be installed in WC'));
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'country' :
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_country(), name,val, operator );
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'custom_field' :
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_custom_field(), name,val, operator );
				sip_aenwc_operators_all_val(jQuery(this));
				break;
			case 'user_meta' :
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_custom_field(), name,val, operator );
				sip_aenwc_operators_all_val(jQuery(this));
				break;
			case 'product_meta' :
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_custom_field(), name,val, operator );
				sip_aenwc_operators_all_val(jQuery(this));
				break;
			case 'shipping_country' :
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_country(), name,val, operator );
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'city':
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'shipping_city':
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'email':
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'sku':
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_sku(), name,val, operator );
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'payment_method':
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_payment_gateways(), name,val, operator );
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'zipcode':
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'shipping_zipcode':
				sip_aenwc_operators_val(jQuery(this));
				break;
			case 'role':
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_roles(), name,val, operator );
				sip_aenwc_operators_val(jQuery(this));
				break;

			case 'stock_status':
				var name = jQuery(this).find('.sip-value-wrap').find('.sip-value').attr('name');
				sip_aenwc_operator_check_contains( jQuery(this), sip_aenwc_stock_status(), name,val, operator );
				jQuery(this).find('.sip-description').html(sip_aenwc_desc('All products in cart must match stock status'));
				sip_aenwc_operators_val(jQuery(this));
				break;
			
			default :
				sip_aenwc_numerical_operators_values(jQuery(this));
				break;
		}
	});
	jQuery(document).on('change', '.sip-operator', function () {
		jQuery(this).closest('.first-div').find('.sip-value').val('');
		var select = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('select.sip-value');
		var name = jQuery(this).closest('.first-div').find('.sip-value-wrap').find('.sip-value').attr('name');

		var condition = jQuery(this).val();
		var condition_ = jQuery(this).closest('.first-div').find('.sip-condition').val();
		switch (condition) {
			case 'exactly_match':
				
					switch(condition_){
						case 'contains_product':
							jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_products()).find('.sip-value').attr('name', name);
							break;
						case 'contains_shipping_class':
							jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_shipping()).find('.sip-value').attr('name', name);
							break;
						case 'state':
							jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_states()).find('.sip-value').attr('name', name);
							break;
						case 'shipping_state':
							jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_shipping_states()).find('.sip-value').attr('name', name);
							break;
						case 'country' :
							jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_country()).find('.sip-value').attr('name', name);
							break;
						case 'shipping_country' :
							jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_country()).find('.sip-value').attr('name', name);
							break;
						case 'sku' :
							jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_sku()).find('.sip-value').attr('name', name);
							break;
						case 'role':
							jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_roles()).find('.sip-value').attr('name', name);
							break;
						case 'stock_status':
							jQuery(this).closest('.first-div').find('.sip-value-wrap').html(sip_aenwc_stock_status()).find('.sip-value').attr('name', name);
							break;
					}
				break;
			case 'contains':
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html('<input value="" class="sip-value form-control" type="text" name="' + name + '" placeholder="">');
				break;
			case 'not_contains':
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html('<input value="" class="sip-value form-control" type="text" name="' + name + '" placeholder="">');
				break;
			case 'is_empty':
				if( condition_ == "product_meta" ||  condition_ == "user_meta" ||  condition_ == "custom_field" ) {
					jQuery(this).closest('.first-div').find('.sip-value-wrap').html('<input value="" class="sip-value form-control" type="text" name="' + name + '" placeholder="Variable_name">');
				} else {
					jQuery(this).closest('.first-div').find('.sip-value-wrap').html('<input value="" disabled class="sip-value form-control" type="text" name="' + name + '" placeholder="">');
				}

				break;
			case 'is_not_empty':
				if( condition_ == "product_meta" ||  condition_ == "user_meta" ||  condition_ == "custom_field" ) {
					jQuery(this).closest('.first-div').find('.sip-value-wrap').html('<input value="" class="sip-value form-control" type="text" name="' + name + '" placeholder="Variable_name">');
				} else {
					jQuery(this).closest('.first-div').find('.sip-value-wrap').html('<input value="" disabled class="sip-value form-control" type="text" name="' + name + '" placeholder="">');
				}

				break;
			case '==':
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html('<input value="" class="sip-value form-control" type="text" name="' + name + '" placeholder="">');
			case '!=':
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html('<input value="" class="sip-value form-control" type="text" name="' + name + '" placeholder="">');
			case '<=':
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html('<input value="" class="sip-value form-control" type="text" name="' + name + '" placeholder="">');
			case '>=':
				jQuery(this).closest('.first-div').find('.sip-value-wrap').html('<input value="" class="sip-value form-control" type="text" name="' + name + '" placeholder="">');
		}
	});
	function l( log ) {
		console.log( log );
	}


	var j = jQuery;
	var data ='';
	// Add condition
	j(document).on( 'click', '.condition-add', function() {
		if(j(this).closest('.condition-group').find(".card-body").length > 0){
			swal("Sorry", "You need to buy pro version to add unlimited email notifications.", "warning");
			return;
		}else{
			var clone = j(this).closest('.first-div').clone();
			var datagroup = j(this).data("group");
			j(this).closest('.condition-group').append(sip_aenwc_add(clone,datagroup));
		}
		
	});
	function sip_aenwc_add( clone, datagroup ) {
		var data = sip_aenwc_getRandomInt( 1000, 5000 );
		clone.find('.sip-value-wrap').html('<input value="" type="text" class="sip-value form-control" name="" placeholder="">');
		clone.find("input").val('');
		clone.find("select").prop("selected", false);
		clone.find(".sip-condition-wrap").html(j('.copy-html').find('.sip-condition').clone());
		clone.find(".sip-operator-wrap").html(j('.copy-html').find('.sip-operator').clone());
		clone.find(".sip-description").empty();
		clone.attr("class", "card-body  first-div sip-condition-" + data);
		clone.find(".sip-condition-wrap").attr("class", "col-md-3 sip-condition-wrap sip-condition-wrap-" + data).find('.sip-condition').attr("name", "_sip_shipping_method_conditions[" + datagroup + "][" + data + "][condition]");
		clone.find(".sip-operator-wrap").attr("class", "col-md-3 sip-operator-wrap sip-operator-wrap-" + data).find('.sip-operator').attr("name", "_sip_shipping_method_conditions[" + datagroup + "][" + data + "][operator]");
		clone.find(".sip-value-wrap").attr("class", "col-md-3 sip-value-wrap sip-value-wrap-" + data).find('.sip-value').attr("name", "_sip_shipping_method_conditions[" + datagroup + "][" + data + "][value]");
		return clone;
	}
	function sip_aenwc_getRandomInt( min, max ) {
		return Math.floor( Math.random() * (max - min + 1)) + min;
	}
	j(document).on( 'click', '.condition-delete', function() {
		var len = j(this).closest('.first-div').parent().find('.first-div').length;
		var group_number = j(this).data("group");
		if(len != 1){
			j(this).closest('.first-div').remove();
		}else{
			j(this).closest('.condition-group').remove();
			j('.condition-or-group-'+group_number).hide();
		}
	});
	j('.condition-group-add').on('click',function(){
		if(j('.sip_meta_box.sip_conditions_meta_box').find(".condition-group").length > 0){
			swal("Sorry", "You need to buy pro version to add unlimited email notifications.", "warning");
			return;
		}else{
			j('.sip_meta_box.sip_conditions_meta_box').append(sip_aenwc_add_new_add_or(j('.copy-html').find('.condition-or-group-0').clone()));
			j('.sip_meta_box.sip_conditions_meta_box').append(sip_aenwc_add_new(j('.copy-html').find('.parent_div').clone()));
		}
		
	});
	$dg = j('.parent_div').last().data('group')+1;
	function sip_aenwc_add_new( clone ) {
		clone.attr('class', 'condition-group condition-group-'+$dg+' parents_div card tx-black bg-light').attr('data-group', $dg);
		var data = sip_aenwc_getRandomInt(1000,5000);
		clone.find("input").val('');
		clone.find("select").prop("selected",false);
		clone.find(".sip-description").empty();
		clone.find(".first-div").attr("class","card-body  first-div sip-condition-"+data);
		clone.find(".sip-condition-wrap").attr("class","col-md-3 sip-condition-wrap sip-condition-wrap-"+data).find('.sip-condition.custom-select').attr("name","_sip_shipping_method_conditions["+$dg+"]["+data+"][condition]");
		clone.find(".sip-operator-wrap").attr("class","col-md-3 sip-operator-wrap sip-operator-wrap-"+data).find('.sip-operator.custom-select').attr("name","_sip_shipping_method_conditions["+$dg+"]["+data+"][operator]");
		clone.find(".sip-value-wrap").attr("class","col-md-3 sip-value-wrap sip-value-wrap-"+data).find('.sip-value.form-control').attr("name","_sip_shipping_method_conditions["+$dg+"]["+data+"][value]");
		clone.find(".condition-add").attr("class","btn btn-outline-success  btn-md text-decoration-none  condition-add").attr("data-group",$dg);
		clone.find(".condition-delete").attr("class","btn btn-outline-danger  btn-md text-decoration-none  condition-delete").attr("data-group",$dg);
		$dg++;
		return clone;
	}
	function sip_aenwc_add_new_add_or( clone ) {
		clone.attr('class', 'condition-or-group-'+$dg).attr('data-group', $dg);
		return clone;
	}



	/** email condition script ends */



});