<?php 

/**
 * Subtotal.
 *
 * Match the condition value against the order subtotal.
 */
function sip_aenwc_check_subtotal_free( $bool, $operator, $value, $order ) {

    // Make sure its formatted correct
    $value = str_replace( ',', '.', $value );

    if ( '==' == $operator ) :
        $bool = ( $order == $value );
    elseif ( '!=' == $operator ) :
        $bool = ( $order != $value );
    elseif ( '>=' == $operator ) :
        $bool = ( $order >= $value );
    elseif ( '<=' == $operator ) :
        $bool = ( $order <= $value );
    elseif ( 'is_not_empty' == $operator ) :
        $bool = ( empty( $order ) ? flase : true );
    elseif ( 'is_empty' == $operator ) :
        $bool = ( empty( $order ) ? true : false );
    endif;

    return $bool;
}


/**
 * Subtotal excl. taxes.
 *
 * Match the condition value against the order subtotal excl. taxes.
 */
function sip_aenwc_check_subtotal_ex_tax_free( $bool, $operator, $value, $order ) {

    // Make sure its formatted correct
    $value = str_replace( ',', '.', $value );

    if ( '==' == $operator ) :
        $bool = ( $order == $value );
    elseif ( '!=' == $operator ) :
        $bool = ( $order != $value );
    elseif ( '>=' == $operator ) :
        $bool = ( $order >= $value );
    elseif ( '<=' == $operator ) :
        $bool = ( $order <= $value );
    elseif ( 'is_not_empty' == $operator ) :
        $bool = ( empty( $order ) ? flase : true );
    elseif ( 'is_empty' == $operator ) :
        $bool = ( empty( $order ) ? true : false );
    endif;

    return $bool;
}


/**
 * Taxes.
 *
 * Match the condition value against the cart taxes.
 */
function sip_aenwc_check_tax_free( $bool, $operator, $value, $order ) {

    if ( '==' == $operator ) :
        $bool = ( $order == $value );
    elseif ( '!=' == $operator ) :
        $bool = ( $order != $value );
    elseif ( '>=' == $operator ) :
        $bool = ( $order >= $value );
    elseif ( '<=' == $operator ) :
        $bool = ( $order <= $value );
    elseif ( 'is_not_empty' == $operator ) :
        $bool = ( empty( $order ) ? flase : true );
    elseif ( 'is_empty' == $operator ) :
        $bool = ( empty( $order ) ? true : false );
    endif;

    return $bool;
}


/**
 * Quantity.
 *
 * Match the condition value against the order quantity.
 */
function sip_aenwc_check_quantity_free( $bool, $operator, $value, $items ) {

    $result = 0;
    foreach ( $items as $item ) {
        $qty = $item['qty'];
        $result = $result + $qty; 
    }

    if ( '==' == $operator ) :
        $bool = ( $result == $value );
    elseif ( '!=' == $operator ) :
        $bool = ( $result != $value );
    elseif ( '>=' == $operator ) :
        $bool = ( $result >= $value );
    elseif ( '<=' == $operator ) :
        $bool = ( $result <= $value );
    elseif ( 'is_not_empty' == $operator ) :
        $bool = ( empty( $result ) ? flase : true );
    elseif ( 'is_empty' == $operator ) :
        $bool = ( empty( $result ) ? true : false );
    endif;

    return $bool;
}

/**
 * Contains product.
 *
 * Matches if the condition value product is in the order or not.
 */
function sip_aenwc_check_contains_product_free( $bool, $operator, $values, $items ) {

    $product_ids = array();
    $text        = "";
    
    if ( is_int( $values ) || ctype_digit($values) ) {
        foreach ( $items as $item ) {
            $product_ids[] = method_exists( $item, 'get_product_id' ) ? $item->get_product_id() : $item['product_id'];
        }
    } else {
        $values = explode( "," , $values );
        foreach ( $items as $item ) {
            $text .= method_exists( $item, 'get_name' ) ? $item->get_name() : $item['name'];
            $text .= " ";
        }
    }

    if ( 'exactly_match' == $operator ) :
        foreach ($product_ids as $product_id) {
            if ( !empty( $product_id ) ) {
                $bool = ( $product_id == $values );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'contains' == $operator ) :
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $text );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $text );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }

        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $text ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $text ) ? true : false );

    endif;

    return $bool;
}


/**
 * Shipping method.
 *
 * Matches if the condition value shipping method is in the order.
 */
function sip_aenwc_check_shipping_method_free( $bool, $operator, $values, $shipping_method ) {

    $shipping_method = strtolower( $shipping_method );
    $values = strtolower( $values );
    $values = explode( "," , $values );
    
    if ( 'exactly_match' == $operator ) :
        foreach ($values as $value) {
            if ( !empty( $value ) ) {
                $bool = ( $shipping_method == $value );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'contains' == $operator ) :
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $shipping_method );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $shipping_method );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $shipping_method ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $shipping_method ) ? true : false );

    endif;

    return $bool;
}


/**
 * Shipping class.
 *
 * Matches if the condition value shipping class is in the order.
 */
function sip_aenwc_check_contains_shipping_class_free( $bool, $operator, $values, $items ) {

    $values = strtolower( $values );
    $values = explode( "," , $values );
    
    if ( 'exactly_match' == $operator ) :
        foreach ($values as $value) {
            if ( !empty( $value ) ) {
    
                $term_meta = get_term( $value );

                foreach ( $items as $item ) {   
                    $_product_id = method_exists( $item, 'get_product_id' ) ? $item->get_product_id() : $item['product_id'];
                    $terms = get_the_terms( $_product_id, 'product_shipping_class' );
                    foreach ($terms as $key => $term) {
                        
                        $bool = ( $term->name == $term_meta->name );
                        if ( $bool ) {
                            break 3;
                        }
                    }
                }
            }
        }
    elseif ( 'contains' == $operator ) :
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                
                foreach ( $items as $item ) {
                    $_product_id = method_exists( $item, 'get_product_id' ) ? $item->get_product_id() : $item['product_id'];
                    $terms = get_the_terms( $_product_id, 'product_shipping_class' );
                    foreach ($terms as $key => $term) {
                        if ( empty( $term->name )) {
                            continue;
                        }
                        $bool = sip_aenwc_contains_free( $value, $term->name );
                        if ( $bool ) {
                            break 3;
                        }
                    }
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = false;
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {

                foreach ( $items as $item ) {
                    $_product_id = method_exists( $item, 'get_product_id' ) ? $item->get_product_id() : $item['product_id'];
                    $terms = get_the_terms( $_product_id, 'product_shipping_class' );
                    foreach ($terms as $key => $term) {
                        if ( empty( $term->name ) || empty( $value ) || isset( $term->name ) || isset( $value ) ) {
                            continue;
                        }
                        $result = true;
                        $bool = sip_aenwc_contains_free( $value, $term->name );
                        if ( $bool ) {
                            $result = false;
                            $bool   = false;
                            break 3;
                        }
                    }
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $items ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $items ) ? true : false );

    endif;

    return $bool;
}


/**
 * State.
 *
 * Match the condition value against the users shipping state
 */
function sip_aenwc_check_state_free( $bool, $operator, $values, $shipping_state ) {

    $shipping_state = strtolower( $shipping_state );
    $values = strtolower( $values );
    $values = explode( "," , $values );

    if ( 'exactly_match' == $operator ) :
        foreach ($values as $value) {
            if ( !empty( $value ) ) {
                $value = explode( "_", $value );
                $bool = ( $shipping_state == $value[1] );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'contains' == $operator ) :
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $shipping_state );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $shipping_state );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $shipping_state ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $shipping_state ) ? true : false );

    endif;

    return $bool;
}


/**
 * State.
 *
 * Match the condition value against the users shipping state
 */
function sip_aenwc_check_shipping_state_free( $bool, $operator, $values, $shipping_state ) {

    $shipping_state = strtolower( $shipping_state );
    $values = strtolower( $values );
    $values = explode( "," , $values );
    
    if ( 'exactly_match' == $operator ) :
        foreach ($values as $value) {
            if ( !empty( $value ) ) {
                $value = explode( "_", $value );
                $bool = ( $shipping_state == $value[1] );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'contains' == $operator ) :
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $shipping_state );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $shipping_state );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $shipping_state ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $shipping_state ) ? true : false );

    endif;

    return $bool;
}


/**
 * Country.
 *
 * Match the condition value against the users shipping country.
 */
function sip_aenwc_check_country_free( $bool, $operator, $values, $shipping_country ) {

    $values = strtolower( $values );
    $values = explode( "," , $values );
    
    if ( 'exactly_match' == $operator ) :
        foreach ($values as $value) {
            if ( !empty( $value ) ) {
                $shipping_country = strtolower( $shipping_country );
                $bool = ( $shipping_country == $value );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'contains' == $operator ) :
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $shipping_country = WC()->countries->countries[ $shipping_country ];
                $shipping_country = strtolower( $shipping_country );
                $bool = sip_aenwc_contains_free( $value, $shipping_country );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $shipping_country = WC()->countries->countries[ $shipping_country ];
                $shipping_country = strtolower( $shipping_country );
                $bool = sip_aenwc_contains_free( $value, $shipping_country );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $shipping_country ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $shipping_country ) ? true : false );

    endif;

    return $bool;
}


/**
 * Country.
 *
 * Match the condition value against the users shipping country.
 */
function sip_aenwc_check_shipping_country_free( $bool, $operator, $values, $shipping_country ) {

    $values = strtolower( $values );
    $values = explode( "," , $values );
    
    if ( 'exactly_match' == $operator ) :
        foreach ($values as $value) {
            if ( !empty( $value ) ) {
                $shipping_country = strtolower( $shipping_country );
                $bool = ( $shipping_country == $value );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'contains' == $operator ) :
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $shipping_country = WC()->countries->countries[ $shipping_country ];
                $shipping_country = strtolower( $shipping_country );
                $bool = sip_aenwc_contains_free( $value, $shipping_country );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $shipping_country = WC()->countries->countries[ $shipping_country ];
                $shipping_country = strtolower( $shipping_country );
                $bool = sip_aenwc_contains_free( $value, $shipping_country );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $shipping_country ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $shipping_country ) ? true : false );

    endif;

    return $bool;
}


/**
 * City.
 *
 * Match the condition value against the users shipping city.
 */
function sip_aenwc_check_shipping_city_free( $bool, $operator, $values, $order_city ) {

    $order_city = strtolower( $order_city );
    $values     = strtolower( $values );

    if ( 'exactly_match' == $operator ) :
        $bool = ( $order_city == $values );
    elseif ( 'contains' == $operator ) :
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_city );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_city );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $order_city ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $order_city ) ? true : false );

    endif;

    return $bool;
}


/**
 * City.
 *
 * Match the condition value against the users shipping city.
 */
function sip_aenwc_check_city_free( $bool, $operator, $values, $order_city ) {

    $order_city = strtolower( $order_city );
    $values     = strtolower( $values );

    if ( 'exactly_match' == $operator ) :
        $bool = ( $order_city == $values );
    elseif ( 'contains' == $operator ) :
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_city );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_city );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $order_city ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $order_city ) ? true : false );

    endif;

    return $bool;
}


/**
 * Zipcode.
 *
 * Match the condition value against the users shipping zipcode.
 */
function sip_aenwc_check_zipcode_free( $bool, $operator, $values, $order_zipcode ) {

    $order_zipcode = strtolower( $order_zipcode );
    $values        = strtolower( $values );

    if ( 'exactly_match' == $operator ) :
        $bool = ( $order_zipcode == $values );
    elseif ( 'contains' == $operator ) :
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_zipcode );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_zipcode );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $order_zipcode ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $order_zipcode ) ? true : false );

    endif;

    return $bool;
}


/**
 * Zipcode.
 *
 * Match the condition value against the users shipping zipcode.
 */
function sip_aenwc_check_shipping_zipcode_free( $bool, $operator, $values, $order_zipcode ) {

    $order_zipcode = strtolower( $order_zipcode );
    $values        = strtolower( $values );

    if ( 'exactly_match' == $operator ) :
        $bool = ( $order_zipcode == $values );
    elseif ( 'contains' == $operator ) :
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_zipcode );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_zipcode );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $order_zipcode ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $order_zipcode ) ? true : false );

    endif;

    return $bool;
}


/**
 * User role.
 *
 * Match the condition value against the users role.
 */
function sip_aenwc_check_role_free( $bool, $operator, $values, $order_user_role ) {

    $order_user_role = strtolower( $order_user_role );
    $values          = strtolower( $values );

    if ( 'exactly_match' == $operator ) :
        $bool = ( $order_user_role == $values );
    elseif ( 'contains' == $operator ) :
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_user_role );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_user_role );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $order_user_role ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $order_user_role ) ? true : false );

    endif;

    return $bool;
}


/**
 * Stock status.
 *
 * Match the condition value against all cart products stock statusses.
 */
function sip_aenwc_check_stock_status_free( $bool, $operator, $values, $items ) {

    $stock_statuss = array();
    foreach ( $items as $item ) {
        $stock_statuss[] = get_post_meta( $item['product_id'], "_stock_status", true);
    }
    
    $values  = strtolower( $values );
    $values  = explode( "," , $values );

    $stock_statuss = strtolower( $stock_statuss );

    if ( 'exactly_match' == $operator ) :
        foreach ( $stock_statuss as $stock_status ) {
            $bool = ( $stock_status == $values[0] );
            if ( $bool ) {
                return $bool;
            }
        }
    elseif ( 'contains' == $operator ) :
        foreach ( $stock_statuss as $stock_status ) {
            foreach ( $values as $value ) {
                if ( !empty( $stock_status ) && !empty( $value ) ) {
                    $bool = sip_aenwc_contains_free( $value, $stock_status );
                    if ( $bool ) {
                        break 2;
                    }
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        foreach ( $stock_statuss as $stock_status ) {
            foreach ( $values as $value ) {
                if ( !empty( $stock_status ) && !empty( $value ) ) {
                    $bool = sip_aenwc_contains_free( $value, $stock_status );
                    if ( $bool ) {
                        $result = false;
                        $bool   = false;
                    }
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $stock_statuss ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $stock_statuss ) ? true : false );

    endif;

    return $bool;
}


/**
 * SKU.
 *
 * Match the condition value against all cart products stock statusses.
 */
function sip_aenwc_check_sku_free( $bool, $operator, $values, $items ) {

    $_sku = array();
    foreach ( $items as $item ) {
        $_sku[] = strtolower( get_post_meta( $item['product_id'], "_sku", true) );    
    }
    
    $values  = strtolower( $values );
    $values  = explode( "," , $values );

    

    if ( 'exactly_match' == $operator ) :
        foreach ( $_sku as $sku ) {
            $bool = ( $sku == $values[0] );
            if ( $bool ) {
                return $bool;
            }
        }
    elseif ( 'contains' == $operator ) :
        foreach ( $_sku as $sku ) {
            foreach ( $values as $value ) {
                if ( !empty( $sku ) && !empty( $value ) ) {
                    $bool = sip_aenwc_contains_free( $value, $sku );
                    if ( $bool ) {
                        break 2;
                    }
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        foreach ( $_sku as $sku ) {
            foreach ( $values as $value ) {
                if ( !empty( $sku ) && !empty( $value ) ) {
                    $bool = sip_aenwc_contains_free( $value, $sku );
                    if ( $bool ) {
                        $result = false;
                        $bool   = false;
                    }
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $_sku ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $_sku ) ? true : false );

    endif;

    return $bool;
}

/**
 * Email.
 *
 * Match the condition value against all cart products stock statusses.
 */
function sip_aenwc_check_email_free( $bool, $operator, $values, $email ) {

    $order_email = strtolower( $email );
    $values = strtolower( $values );

    if ( 'exactly_match' == $operator ) :
        $bool = ( $order_email == $values );
    elseif ( 'contains' == $operator ) :
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_email );
                if ( $bool ) {
                    break;
                }
            }
        }
    elseif ( 'not_contains' == $operator ) :
        $result = true;
        $values = explode( "," , $values );
        foreach ( $values as $value ) {
            if ( !empty( $value ) ) {
                $bool = sip_aenwc_contains_free( $value, $order_email );
                if ( $bool ) {
                    $result = false;
                    $bool   = false;
                }
            }
        }
        if( $result ) {
            $bool = true;
        } else {}

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $order_email ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $order_email ) ? true : false );

    endif;

    return $bool;
}


/**
 * Weight.
 *
 * Match the condition value against the order weight.
 */
function sip_aenwc_check_weight_free( $bool, $operator, $value, $items ) {

    $results = array();
    
    foreach ( $items as $item ) {
        
        $results[] = get_post_meta( $item['product_id'], "_weight", true);
    }

    // Make sure its formatted correct
    $value   = str_replace( ',', '.', $value );

    if ( '==' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result == $value );
                if ( $bool ) {
                    break;
                }
            }
        }
        
    elseif ( '!=' == $operator ) :
        
        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bools = ( $result != $value );
                if ( $bools ) {
                    $bool = $bools;
                }else{
                    $bool = false;
                    break;
                }
            }
        }

    elseif ( '>=' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result >= $value );
                if ( $bool ) {
                    break;
                }
            }
        }

    elseif ( '<=' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result <= $value );
                if ( $bool ) {
                    break;
                }
            }
        }

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $results ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $results ) ? true : false );

    endif;

    return $bool;
}


/**
 * Width.
 *
 * Match the condition value against the widest product in the order.
 */
function sip_aenwc_check_width_free( $bool, $operator, $value, $items ) {

    $results = array();
    
    foreach ( $items as $item ) {
        
        $results[] = get_post_meta( $item['product_id'], "_width", true);
    }

    // Make sure its formatted correct
    $value   = str_replace( ',', '.', $value );

    if ( '==' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result == $value );
                if ( $bool ) {
                    break;
                }
            }
        }
        
    elseif ( '!=' == $operator ) :
        
        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bools = ( $result != $value );
                if ( $bools ) {
                    $bool = $bools;
                }else{
                    $bool = false;
                    break;
                }
            }
        }

    elseif ( '>=' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result >= $value );
                if ( $bool ) {
                    break;
                }
            }
        }

    elseif ( '<=' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result <= $value );
                if ( $bool ) {
                    break;
                }
            }
        }

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $results ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $results ) ? true : false );

    endif;

    return $bool;
}


/**
 * Height.
 *
 * Match the condition value against the highest product in the order.
 */
function sip_aenwc_check_height_free( $bool, $operator, $value, $items ) {

    $results = array();
    
    foreach ( $items as $item ) {
        
        $results[] = get_post_meta( $item['product_id'], "_height", true);
    }

    // Make sure its formatted correct
    $value   = str_replace( ',', '.', $value );

    if ( '==' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result == $value );
                if ( $bool ) {
                    break;
                }
            }
        }
        
    elseif ( '!=' == $operator ) :
        
        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bools = ( $result != $value );
                if ( $bools ) {
                    $bool = $bools;
                }else{
                    $bool = false;
                    break;
                }
            }
        }

    elseif ( '>=' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result >= $value );
                if ( $bool ) {
                    break;
                }
            }
        }

    elseif ( '<=' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result <= $value );
                if ( $bool ) {
                    break;
                }
            }
        }

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $results ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $results ) ? true : false );

    endif;

    return $bool;
}


/**
 * Length.
 *
 * Match the condition value against the lenghtiest product in the order.
 */
function sip_aenwc_check_length_free( $bool, $operator, $value, $items ) {

    $results = array();
    
    foreach ( $items as $item ) {
        
        $results[] = get_post_meta( $item['product_id'], "_length", true);
    }

    // Make sure its formatted correct
    $value   = str_replace( ',', '.', $value );

    if ( '==' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result == $value );
                if ( $bool ) {
                    break;
                }
            }
        }
        
    elseif ( '!=' == $operator ) :
        
        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bools = ( $result != $value );
                if ( $bools ) {
                    $bool = $bools;
                }else{
                    $bool = false;
                    break;
                }
            }
        }

    elseif ( '>=' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result >= $value );
                if ( $bool ) {
                    break;
                }
            }
        }

    elseif ( '<=' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result <= $value );
                if ( $bool ) {
                    break;
                }
            }
        }

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $results ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $results ) ? true : false );

    endif;

    return $bool;
}


/**
 * Product stock.
 *
 * Match the condition value against all cart products stock.
 */
function sip_aenwc_check_stock_free( $bool, $operator, $value, $items ) {

    $results = array();
    
    foreach ( $items as $item ) {
        
        $results[] = get_post_meta( $item['product_id'], "_stock", true);
    }

    // Make sure its formatted correct
    $value   = str_replace( ',', '.', $value );
    $results = explode( "," , $results );

    if ( '==' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result == $value );
                if ( $bool ) {
                    break;
                }
            }
        }
        
    elseif ( '!=' == $operator ) :
        
        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bools = ( $result != $value );
                if ( $bools ) {
                    $bool = $bools;
                }else{
                    $bool = false;
                    break;
                }
            }
        }

    elseif ( '>=' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result >= $value );
                if ( $bool ) {
                    break;
                }
            }
        }

    elseif ( '<=' == $operator ) :

        foreach ( $results as $result ) {
            if ( !empty( $result ) && !empty( $value ) ) {
                $bool = ( $result <= $value );
                if ( $bool ) {
                    break;
                }
            }
        }

    elseif ( 'is_not_empty' == $operator ) :

        $bool = ( empty( $results ) ? flase : true );

    elseif ( 'is_empty' == $operator ) :

        $bool = ( empty( $results ) ? true : false );

    endif;

    return $bool;
}


// returns true if $sub_string is a substring of $super_string
function sip_aenwc_contains_free( $sub_string, $super_string ) {

    $super_string = strtolower( $super_string );
    $sub_string   = strtolower( $sub_string );

    return strpos($super_string, $sub_string) !== false;
}