<?php // Silence is golden

// include css inliner
if ( ! class_exists( 'Emogrifier' ) && class_exists( 'DOMDocument' ) ) {
    include_once( dirname( __FILE__ ) . '/libraries/class-emogrifier.php' );
}

function sip_aenwc_add_in_mail_queue_free( $orderId ) {
    
    global $wpdb;

    $prefix = $wpdb->prefix;
    $table_name = $prefix . 'sip_aenwc_queue';
    $order = new WC_Order ( $orderId );
    $items = $order->get_items();
    $meta = get_metadata ( 'post', $orderId );
    $order_status = method_exists( $order, 'get_status' ) ? $order->get_status() : $order->status;
    $order_customer_user = method_exists( $order, 'get_customer_id' ) ? $order->get_customer_id() : $order->customer_user;
    $rules = sip_aenwc_get_rules_free ( $order_status );
    $customer = get_userdata( $order_customer_user );

    $match_condition_group = true;
    $mail_condition = false;
    $match = false;
    
    if ( $rules && count ( $rules ) > 0 ) {

        foreach ( $rules as $rule ) {

            $condition_groups = get_post_meta( $rule ['ID'], '_sip_shipping_method_conditions', true );
            
            
            $mail_condition = false;
            foreach ( $condition_groups as $condition_group => $conditions ) :

                $match_condition_group = true;

                foreach ( $conditions as $condition ) :

                    $store_r    = ""; // Store Result
                    $condition  = apply_filters( 'sip_aenwc_check_values', $condition );

                    switch ( $condition['condition'] ) {

                            case 'subtotal':
                                $store_r = method_exists( $order, 'get_total' ) ? $order->get_total() : $order->order_total;
                                $match   = sip_aenwc_check_subtotal_free ( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'country':
                                $store_r = method_exists( $order, 'get_billing_country' ) ? $order->get_billing_country() : $order->billing_country;
                                $match   = sip_aenwc_check_country_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'shipping_country':
                                $store_r = method_exists( $order, 'get_shipping_country' ) ? $order->get_shipping_country() : $order->shipping_country;
                                $match   = sip_aenwc_check_shipping_country_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'subtotal_ex_tax':
                                $get_order_total = method_exists( $order, 'get_total' ) ? $order->get_total() : $order->order_total;
                                $get_total_tax = method_exists( $order, 'get_total_tax' ) ? $order->get_total_tax() : $order->order_tax;
                                $store_r = $get_order_total - $get_total_tax;
                                $match   = sip_aenwc_check_subtotal_ex_tax_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'role':
                                $store_r = $customer->roles[0];
                                $match   = sip_aenwc_check_role_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'state':
                                $store_r = method_exists( $order, 'get_billing_state' ) ? $order->get_billing_state() : $order->billing_state;
                                $match   = sip_aenwc_check_state_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'shipping_state':
                                $store_r = method_exists( $order, 'get_shipping_state' ) ? $order->get_shipping_state() : $order->shipping_state;
                                $match   = sip_aenwc_check_shipping_state_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'sku':
                                $match   = sip_aenwc_check_sku_free( false, $condition['operator'], $condition['value'], $items );
                                break;

                            case 'email':
                                $store_r = method_exists( $order, 'get_billing_email' ) ? $order->get_billing_email() : $order->billing_email;
                                $match   = sip_aenwc_check_email_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'city':
                                $store_r = method_exists( $order, 'get_billing_city' ) ? $order->get_billing_city() : $order->billing_city;
                                $match   = sip_aenwc_check_city_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'shipping_city':
                                $store_r = method_exists( $order, 'get_shipping_city' ) ? $order->get_shipping_city() : $order->shipping_city;
                                $match   = sip_aenwc_check_shipping_city_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'zipcode':
                                $store_r = method_exists( $order, 'get_billing_postcode' ) ? $order->get_billing_postcode() : $order->billing_postcode;
                                $match   = sip_aenwc_check_zipcode_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'shipping_zipcode':
                                $store_r = method_exists( $order, 'get_shipping_postcode' ) ? $order->get_shipping_postcode() : $order->shipping_postcode;
                                $match   = sip_aenwc_check_shipping_zipcode_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'contains_product':
                                $match   = sip_aenwc_check_contains_product_free( false, $condition['operator'], $condition['value'], $items );
                                break;

                            case 'contains_shipping_methods':
                                $store_r = $order->get_shipping_method();
                                $match   = sip_aenwc_check_shipping_method_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'contains_shipping_zone':
                                $store_r = $order->get_shipping_method();
                                $match   = sip_aenwc_check_shipping_method_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'contains_shipping_class':
                                //$store_r = method_exists( $order, 'get_shipping_class' ) ? $order->get_shipping_class() : $order->shipping_class( );
                                $match   = sip_aenwc_check_contains_shipping_class_free( false, $condition['operator'], $condition['value'], $items );
                                break;

                            case 'tax':
                                $store_r = method_exists( $order, 'get_total_tax' ) ? $order->get_total_tax() : $order->order_tax;
                                $match   = sip_aenwc_check_tax_free( false, $condition['operator'], $condition['value'], $store_r );
                                break;

                            case 'weight':
                                $match   = sip_aenwc_check_weight_free( false, $condition['operator'], $condition['value'], $items );
                                break;

                            case 'height':
                                $match   = sip_aenwc_check_height_free( false, $condition['operator'], $condition['value'], $items );
                                break;

                            case 'length':
                                $match   = sip_aenwc_check_length_free( false, $condition['operator'], $condition['value'], $items );
                                break;

                            case 'stock':
                                $match   = sip_aenwc_check_stock_free( false, $condition['operator'], $condition['value'], $items );
                                break;

                            case 'width':
                                $match   = sip_aenwc_check_width_free( false, $condition['operator'], $condition['value'], $items );
                                break;

                            case 'quantity':
                                $match = sip_aenwc_check_quantity_free( false, $condition['operator'], $condition['value'], $items );
                                break;

                            case 'stock_status':
                                $match = sip_aenwc_check_stock_status_free( false, $condition['operator'], $condition['value'], $items );
                                break;

                            case 'match_all_orders':
                                $match = true;
                                break;

                            default:
                                $match   = false;
                                break;
                        }

                    if ( false == $match ) {
                        $match_condition_group = false;
                    }

                endforeach;

                // return true if one condition group matches
                if ( true == $match_condition_group ) :
                    $mail_condition = true;
                endif;

            endforeach;
           
            $mail_condition = apply_filters( "sip_aenwc_check_conditions", $mail_condition, $condition_groups, $order, $rule, $customer );

            if ( $mail_condition == false ) {
                //return false;
                continue;
            }

            // check to see the queue mail exist or not
            $args = array (
                    $rule ['ID'],
                    $orderId 
            );
            $query = $wpdb->prepare ( "select * from {$table_name} where rule_id = %s and event_info = %s", $args );
            $result = $wpdb->get_results ( $query, ARRAY_A );
            
            $multeple_email = true;
            if ( isset( $rule['sip_a_e_n_wc_multeple_email'] ) && ( $rule['sip_a_e_n_wc_multeple_email'] == "yes" ) ) {

                $receiver_email = method_exists( $order, 'get_billing_email' ) ? $order->get_billing_email() : $order->billing_email;
                $args = array (
                        $rule ['ID'],
                        $receiver_email 
                );

                $query = $wpdb->prepare ( "select * from {$table_name} where rule_id = %s and recipient_email = %s", $args );
                $result1 = $wpdb->get_results ( $query, ARRAY_A );

                if ( $result1 ) {
                    $multeple_email = false;
                }
            }
            
            if ( !($result) && ($multeple_email) ) {

                $mail_data = array ();
                $mail_data['sender_name']  = get_option( 'woocommerce_email_from_name' );
                $mail_data['sender_email'] = get_option( 'woocommerce_email_from_address' );
                $mail_data['rule_id']      = $rule['ID'];
                $mail_data['event_name']   = $rule['post_title'];
                $mail_data['status']       = 'pending';
                $mail_data['event_info']   = $orderId;
                update_post_meta( $orderId, 'sip_current_order_status', $order_status );

                if (!  $order_customer_user ) {

                    $user       = $order_customer_user;
                    $user_meta  = get_metadata ( 'user', $user );

                    $mail_data ['recipient_email']      = method_exists( $order, 'get_billing_email' ) ? $order->get_billing_email() : $order->billing_email;
                    $mail_data ['recipient_first_name'] = method_exists( $order, 'get_billing_first_name' ) ? $order->get_billing_first_name() : $order->billing_first_name;
                    $mail_data ['recipient_last_name']  = method_exists( $order, 'get_billing_last_name' ) ? $order->get_billing_last_name() : $order->billing_last_name;

                } else {

                    $mail_data ['recipient_email']      = method_exists( $order, 'get_billing_email' ) ? $order->get_billing_email() : $order->billing_email;
                    $mail_data ['recipient_first_name'] = method_exists( $order, 'get_billing_first_name' ) ? $order->get_billing_first_name() : $order->billing_first_name;
                    $mail_data ['recipient_last_name']  = method_exists( $order, 'get_billing_last_name' ) ? $order->get_billing_last_name() : $order->billing_last_name;
                }

                $email_chains = sip_aenwc_get_chain_of_post_id_free ( $rule['ID'] );
                
                if ( $email_chains && ! empty ( $email_chains ) ) {
                        
                        $get_date_modified = method_exists( $order, 'get_date_modified' ) ? $order->get_date_modified() : $order->post->post_modified;
                        $post_date_strtotime = strtotime($get_date_modified);

                        $send_at = $post_date_strtotime;
                        $send_at = date($format, $send_at);

                        $date = new DateTime ();
                        $format = 'Y-m-d H:i:s';
                        $mail_data ['created'] = $date->format ( $format );

                        if ( $send_at < $date->format ( $format ) ) {
                            $mail_data['send_at'] = $date->format ( $format );
                        } else {
                            $mail_data['send_at'] = $send_at;
                        }

                        $mail_data['email_subject'] = sip_aenwc_shortcode_subject_free( $email_chains['subject'], $order, $mail_data['recipient_first_name'], $mail_data['recipient_last_name'], $rule, $mail_data, $customer );
                        $mail_data['email_content'] = sip_aenwc_shortcode_content_free( $email_chains['content'], $order, $mail_data['recipient_first_name'], $mail_data['recipient_last_name'], $rule, $mail_data, $customer, $email_chains['header_css'] );

                        $mail_data = apply_filters( "sip_aenwc_mail_data", $mail_data, $order, $rule, $customer );
                        if ( $mail_data['recipient_email'] != '' ) {
                            $wpdb->insert( $table_name, $mail_data );
                        }

                        $row = $wpdb->get_row( "select * from {$table_name} ORDER BY id DESC" , ARRAY_A );
                        
                        if ( isset( $row['id'] ) ) {
                            sip_aenwc_send_mail_free( $mail_data , $row['id'] );
                        }
                    
                }
            }

            $meta_key = 'sip_aen_wc_order_' . $orderId;
            update_post_meta( $rule['ID'], $meta_key, 'processed' );
        }// foreach loop rules
    }
}

function sip_aenwc_get_rules_free( $orderStatus ) {
    
    global $wpdb;
    $rules       = array ();
    $prefix      = $wpdb->prefix;
    $postMetaTbl = $prefix . 'postmeta';
    $postsTbl    = $prefix . 'posts';
    
    $query = "select * from $postsTbl as p
    join  $postMetaTbl as statuskey on statuskey.post_id = p.id and statuskey.meta_key= %s and statuskey.meta_value = %s
    join  $postMetaTbl as orderkey on orderkey.post_id = p.id and orderkey.meta_key = %s and orderkey.meta_value  = %s
    where p.post_type = %s and p.post_status=%s";
    $refinedQuery = $wpdb->prepare ( $query, array (
            'sip_a_e_n_wc_status',
            'active',
            'sip_a_e_n_wc_order_status_field',
            $orderStatus,
            'a_e_n_shop',
            'publish' 
    ) );
    $postids = $wpdb->get_col ( $refinedQuery );

    if ( $postids ) {
        foreach ( $postids as $id ) {
            $post = get_post ( $id );
            
            $meta = get_metadata ( 'post', intval ( $id ), '', true );
            foreach ( $meta as $key => $value ) {
                $meta[$key] = $value[0];
            }
            
            $rule = array_merge ( $post->to_array(), $meta );
            $rules[] = $rule;
        }
    }
    
    return $rules;
}

function sip_aenwc_shortcode_subject_free( $content, $order, $customer_first_name, $customer_last_name, $rule, $mail_data, $customer ) {
    $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
    $ip = get_post_meta( $order_id, '_customer_ip_address', true );
    $replaces = apply_filters( 'sip_aenwc_subject_replaces', array (
            '{{customer_name}}' => $customer_first_name . " " . $customer_last_name,
            '{{customer_first_name}}' => $customer_first_name,
            '{{customer_last_name}}'  => $customer_last_name,
            '{{username}}'  => ( isset($customer->data->user_login) ? $customer->data->user_login : "" ),
            '{{email}}'  => ( isset($customer->data->user_email) ? $customer->data->user_email : "" ),
            '{{ID}}'  => ( isset($customer->data->ID) ? $customer->data->ID : "" ),
            '{{IP}}'  => $ip,
            '{{booking_start_date}}'  => sip_aenwc_booking_start_date_time_free( $order_id, 'date' ),
            '{{booking_start_time}}'  => sip_aenwc_booking_start_date_time_free( $order_id, 'time' ),
            '{{booking_end_date}}'  => sip_aenwc_booking_end_date_time_free( $order_id, 'date' ),
            '{{booking_end_time}}'  => sip_aenwc_booking_end_date_time_free( $order_id, 'time' ),
            '{{store_url}}'     => get_permalink ( wc_get_page_id( 'shop' ) ),
            '{{store_name}}'    => get_bloginfo ( 'name' ),
            '{{order_number}}'  => $order->get_order_number(),
            '{{order_total}}'   => $order->get_total(),
            '{{order_url}}'     => $order->get_view_order_url(),
            '{{order_items}}'   => sip_aenwc_get_order_items_free( $order_id ),
            '{{tracking}}'      => get_post_meta( $order_id, '_aftership_tracking_number', true ),
            '{{order_items_with_thumbnail}}' =>sip_aenwc_get_order_items_with_thumnail_free( $order_id )
        ), $content, $order, $customer_first_name, $customer_last_name, $rule, $mail_data, $customer
    );

    if ( !empty( $replaces ) ) { 
        foreach ( $replaces as  $find => $replace ) {
        
            $content = str_replace( $find,$replace ,$content );
        }
    }
    
    return $content;
}

function sip_aenwc_shortcode_content_free( $content, $order, $customer_first_name, $customer_last_name, $rule, $mail_data, $customer, $header_css ) {
    $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
    $ip = method_exists( $order, 'get_customer_ip_address' ) ? $order->get_customer_ip_address() : $order->customer_ip_address;
    $replaces = apply_filters( 'sip_aenwc_content_replaces', array (
            '{{customer_name}}' => $customer_first_name . " " . $customer_last_name,
            '{{customer_first_name}}' => $customer_first_name,
            '{{customer_last_name}}' => $customer_last_name,
            '{{customer_username}}' => (isset($customer->data->user_login) ? $customer->data->user_login : ""),
            '{{username}}' => (isset($customer->data->user_login) ? $customer->data->user_login : "" ),
            '{{email}}' => (isset($customer->data->user_email) ? $customer->data->user_email : "" ),
            '{{customer_email}}' => (isset($customer->data->user_email) ? $customer->data->user_email : ""),
            '{{ID}}' => (isset($customer->data->ID) ? $customer->data->ID : ""),
            '{{customer_id}}' => (isset($customer->data->ID) ? $customer->data->ID : ""),
            '{{IP}}' => $ip,
            '{{customer_ip}}' => $ip,
            'sip_custom_field' => 'sip_custom_field order_id="'.$order_id.'"',
            '{{order_language}}' => get_post_meta( $order_id, '_sip_order_language', true ),
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
        ), $content, $order, $customer_first_name, $customer_last_name, $rule, $mail_data, $customer
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
    
    $content = sip_aenwc_add_css_free( $content, $header_css );
    $content = do_shortcode( $content );


    return $content;
}

function sip_aenwc_add_css_free( $content, $header_css ) {
    
    $email_body = "<!DOCTYPE html>";
    $email_body .= "<html>";
    $email_body .= "<body>";
    $email_body .= $content;
    $email_body .= "</body>";
    $email_body .= "</html>";

    return $email_body;
}

function sip_aenwc_order_address_free( $order = array() ) {
    
    $result = "";
    $address = method_exists( $order, 'get_address' ) ? $order->get_address() : $order->address;
    $address_count = count($address);
    $address_count = $address_count - 1;
    foreach ($address as $key => $value) {
        $result .= $key ." => ". $value;
        if ( $address_count != $key ) {
            $result .= "<br>";
        }
    }

    return $result;
}

function sip_aenwc_order_used_coupons_free( $order = array() ) {
    
    $result = "";
    $coupons = method_exists( $order, 'get_coupon_codes' ) ? $order->get_coupon_codes() : $order->used_coupons;
    $coupons_count = count($coupons);
    $coupons_count = $coupons_count - 1;
    foreach ($coupons as $key => $value) {
        $result .= $value;
        if ( $coupons_count != $key ) {
            $result .= " ";
        }
    }

    return $result;
}

function sip_aenwc_get_order_items_free( $orderId ) {
    
    ob_start();
    $template_path  = SIP_AENWCF_DIR . 'admin/templates/email/';
    $default_path   = SIP_AENWCF_DIR . 'admin/templates/email/';
    $order          = new WC_Order ( $orderId );
    wc_get_template( 'order-items.php', array(
        'order'     => $order,
        'order_id'  => $orderId,
        ), $template_path, $default_path
    );
    return ob_get_clean();
}

function sip_aenwc_get_order_details_free( $orderId ) {

    ob_start();
    $template_path  = SIP_AENWCF_DIR . 'admin/templates/email/';
    $default_path   = SIP_AENWCF_DIR . 'admin/templates/email/';
    $order          = new WC_Order ( $orderId );
    
    wc_get_template( 'admin-new-order.php', array(
        'order'     => $order,
        'email_heading' => "",
        'sent_to_admin' => false,
        'plain_text'    => false,
        'email'         => "",
        ), $template_path, $default_path
    );
    return ob_get_clean();
}

function sip_aenwc_style_inline_free( $content ) {

    ob_start();
    $template_path  = SIP_AENWCF_DIR . 'admin/templates/email/';
    $default_path   = SIP_AENWCF_DIR . 'admin/templates/email/';
    wc_get_template( 'email-styles.php', "", $template_path, $default_path);
    $css = ob_get_clean();

    try {
        // apply CSS styles inline for picky email clients
        $emogrifier = new Emogrifier( $content, $css );
        $content    = $emogrifier->emogrify();

    } catch ( Exception $e ) {

        $logger = new WC_Logger();

        $logger->add( 'emogrifier', $e->getMessage() );
    }

    return $content;
}

function sip_aenwc_get_order_items_with_thumnail_free( $orderId ) {

    ob_start();
    $template_path  = SIP_AENWCF_DIR . 'admin/templates/email/';
    $default_path   = SIP_AENWCF_DIR . 'admin/templates/email/';
    $order          = new WC_Order ( $orderId );
    wc_get_template( 'order-item-with-thumnail.php', array(
        'order'     => $order,
        'order_id'  => $orderId,
        ), $template_path, $default_path
    );
    return ob_get_clean();
}


function sip_order_downloadable_items_free( $order ) {

    $links = array();
    $downloads = $order->get_downloadable_items();
    foreach ( $downloads as $download ) : 

        $links[] = '<small style="font-size: 15pt !important;"><a href="' . esc_url( $download['download_url'] ) . '">' . sprintf( esc_html__( '%s', 'sip-advanced-email-notifications-for-wc-free' ), esc_html( $download['download_name'] ) ) . '</a></small>';

    endforeach;

    return implode( ', ', $links );
}

function sip_order_downloadable_product_name_free( $order ) {

    $links = array();
    $downloads = $order->get_downloadable_items();
    foreach ( $downloads as $download ) : 

        $links[] = esc_html( $download['product_name'] );

    endforeach;

    return implode( ', ', $links );
}

function sip_order_downloads_remaining_free( $order ) {

    $downloads_remaining = array();
    $downloads = $order->get_downloadable_items();
    foreach ( $downloads as $download ) : 

        $downloads_remaining[] = esc_html( $download['downloads_remaining'] );

    endforeach;

    return implode( ', ', $downloads_remaining );
}

function sip_order_download_access_expires_free( $order ) {

    $access_expires = array();
    $downloads = $order->get_downloadable_items();
    foreach ( $downloads as $download ) : 

        // $date = date_i18n( get_option( 'date_format' ), $download['access_expires'] );
        $date = date_i18n( 'l j F Y', strtotime( $download['access_expires'] ) );
        $access_expires[] = esc_html( $date );

    endforeach;

    return implode( ', ', $access_expires );
}

if (!function_exists('sip_aenwc_get_post_id_by_meta_key_and_value')) {
    /**
     * Get post id from meta key and value
     * @param string $key
     * @param mixed $value
     * @return int|bool
     * @author David M&aring;rtensson <david.martensson@gmail.com>
     */
    function sip_aenwc_get_post_id_by_meta_key_and_value($key, $value) {
        global $wpdb;
        // $meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".$wpdb->escape($value)."'");
        $meta = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->postmeta." WHERE meta_key=%s AND meta_value=%s", $key, $value ) );

        if (is_array($meta) && !empty($meta) && isset($meta[0])) {
            $meta = $meta[0];
        }       
        if (is_object($meta)) {
            return $meta->post_id;
        }
        else {
            return false;
        }
    }
}

function sip_aenwc_booking_start_date_time_free( $id = 0, $date_time = 'date' ) {
    global $wpdb;
    $prefix = $wpdb->get_blog_prefix();
    $wp_posts = $prefix . 'posts';
    $wp_postmeta = $prefix . 'postmeta';

    $row = $wpdb->get_row( "SELECT ID FROM {$wp_posts} WHERE post_type = 'wc_booking' AND post_parent = {$id}" , ARRAY_A );

    if ( $row['ID'] < 1 ) {
        return "Booking time not found";
    }

    $booking_date_time = get_post_meta( $row['ID'], '_booking_start', true );

    if ($date_time == 'date') {
        //$result = $date = '20180601160000'; get_option( 'date_format' )
        $result = date_i18n( 'l j F Y', strtotime($booking_date_time) );//date('l j F Y', strtotime($booking_date_time));
    } else {
        $result = date_i18n( get_option( 'time_format' ), strtotime($booking_date_time) );//date('h:i A', strtotime($booking_date_time));
    }

    return $result;
}

function sip_aenwc_booking_end_date_time_free( $id = 0, $date_time = 'date' ) {
    global $wpdb;
    $prefix = $wpdb->get_blog_prefix();
    $wp_posts = $prefix . 'posts';
    $wp_postmeta = $prefix . 'postmeta';

    $row = $wpdb->get_row( "SELECT ID FROM {$wp_posts} WHERE post_type = 'wc_booking' AND post_parent = {$id}" , ARRAY_A );

    if ( $row['ID'] < 1 ) {
        return "Booking time not found";
    }

    $booking_date_time = get_post_meta( $row['ID'], '_booking_end', true );

    if ($date_time == 'date') {
        $result = date_i18n( 'l j F Y', strtotime($booking_date_time) );//date('l j F Y', strtotime($booking_date_time));
    } else {
        $result = date_i18n( get_option( 'time_format' ), strtotime($booking_date_time) );//date('h:i A', strtotime($booking_date_time));
    }

    return $result;
}

function sip_aenwc_set_html_content_type_free( ) {
    return 'text/html';
}

function sip_aenwc_send_mail_free( $mail , $id ) {

    global $wpdb;
    $format = 'Y-m-d H:i:s';
    $datetime = new DateTime();
    
    $prefix = $wpdb->get_blog_prefix();
    $table_name   = $prefix . 'sip_aenwc_queue';
    $email_count = substr_count($mail['recipient_email'],"@");

    try {
        if ( $email_count == 1 ) {
            $to = $mail['recipient_first_name'] . '<' . $mail['recipient_email'] . '>';
        } elseif ($email_count > 1) {
            $to = str_replace(" ", ",", $mail['recipient_email']);
            $to = str_replace(";", ",", $to);
            $to = explode(",", $to);
        }

        $subject = $mail['email_subject'];
        $message = $mail['email_content'];

        $headers = array ();
        $headers [] = "Content-Type: text/html";

        if ( $mail['sender_email'] ) {

            $headers [] = 'From: ' . get_option( 'woocommerce_email_from_name' ) .  ' <' . $mail['sender_email'] . '>'. "\r\n";
        }

        add_filter( 'wp_mail_content_type', 'sip_aenwc_set_html_content_type_free' );

        
        $subject = apply_filters( "sip_aenwc_filter_email_subject", $subject );
        $message = apply_filters( "sip_aenwc_filter_email_message", $message ); 
        $headers = apply_filters( "sip_aenwc_filter_email_headers", $headers );

        $is_sent = false;
        if (empty($headers)) {
            $is_sent = wp_mail ( $to, $subject, $message );
        } else {
            $is_sent = wp_mail ( $to, $subject, $message, $headers );
        }

        remove_filter( 'wp_mail_content_type', 'sip_aenwc_set_html_content_type_free' );

        if($is_sent){
            $wpdb->update ( $table_name, array (
                    'status' => 'sent'
            ), array (
                    'id' => $id
            ) );
            
            //  settings_fields( 'sip-advanced-eEmail-notification-settings-group' );
            if ( get_option( 'do_not_log_emails_sent' ) == "true" ) {
                $wpdb->delete( $table_name , array( 'id' => $id, 'status' => 'sent' ) );        
            }
        }

    } catch ( Exception $e ) {

        $mail ['status'] = 3; // status 3 means failed
        $wpdb->update ( $table_name, array (
                'status' => 'failed'
        ), array (
                'id' => $id
        ) );
    }
}