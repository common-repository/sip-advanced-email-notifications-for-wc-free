<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
$text_align = is_rtl() ? 'right' : 'left';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
    <title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
  </head>
  <body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    <div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'?>">
      <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tr>
          <td align="center" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container">
              <tr>
                <td align="center" valign="top">
                  <!-- Body -->
                  <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
                    <tr>
                      <td valign="top" id="body_content">
                        <!-- Content -->
                        <table border="0" cellpadding="20" cellspacing="0" width="100%">
                          <tr>
                            <td valign="top">
                              <div id="body_content_inner">
                                <h2><?php printf( esc_html__( 'Order #%s', 'woocommerce' ), $order->get_order_number() ); ?></h2>

                                <table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
                                  <thead>
                                    <tr>
                                      <th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php _e( 'Product', 'woocommerce' ); ?></th>
                                      <th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
                                      <th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php _e( 'Price', 'woocommerce' ); ?></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php echo wc_get_email_order_items( $order, array(
                                      'show_sku'      => $sent_to_admin,
                                      'show_image'    => false,
                                      'image_size'    => array( 32, 32 ),
                                      'plain_text'    => $plain_text,
                                      'sent_to_admin' => $sent_to_admin,
                                    ) ); ?>
                                  </tbody>
                                  <tfoot>
                                    <?php
                                      if ( $totals = $order->get_order_item_totals() ) {
                                        $i = 0;
                                        foreach ( $totals as $total ) {
                                          $i++;
                                          ?><tr>
                                            <th class="td" scope="row" colspan="2" style="text-align:<?php echo $text_align; ?>; <?php echo ( 1 === $i ) ? 'border-top-width: 4px;' : ''; ?>"><?php echo $total['label']; ?></th>
                                            <td class="td" style="text-align:<?php echo $text_align; ?>; <?php echo ( 1 === $i ) ? 'border-top-width: 4px;' : ''; ?>"><?php echo $total['value']; ?></td>
                                          </tr><?php
                                        }
                                      }
                                    ?>
                                  </tfoot>
                                </table>

                                 <?php
                                    $fields = apply_filters( 'woocommerce_email_order_meta_fields', array(), $sent_to_admin, $order );
                                    $_fields = apply_filters( 'woocommerce_email_order_meta_keys', array(), $sent_to_admin );

                                    if ( $_fields ) {
                                      foreach ( $_fields as $key => $field ) {
                                        if ( is_numeric( $key ) ) {
                                          $key = $field;
                                        }

                                        $fields[ $key ] = array(
                                          'label' => wptexturize( $key ),
                                          'value' => wptexturize( get_post_meta( $order->get_id(), $field, true ) ),
                                        );
                                      }
                                    }

                                    if ( $fields ) {

                                      if ( $plain_text ) {

                                        foreach ( $fields as $field ) {
                                          if ( isset( $field['label'] ) && isset( $field['value'] ) && $field['value'] ) {
                                            echo $field['label'] . ': ' . $field['value'] . "\n";
                                          }
                                        }
                                      } else {

                                        foreach ( $fields as $field ) {
                                          if ( isset( $field['label'] ) && isset( $field['value'] ) && $field['value'] ) {
                                            echo '<p><strong>' . $field['label'] . ':</strong> ' . $field['value'] . '</p>';
                                          }
                                        }
                                      }
                                    }

                                    $fields = array();

                                    if ( $order->get_customer_note() ) {
                                      $fields['customer_note'] = array(
                                        'label' => esc_html__( 'Note', 'woocommerce' ),
                                        'value' => wptexturize( $order->get_customer_note() ),
                                      );
                                    }

                                    if ( $order->get_billing_email() ) {
                                      $fields['billing_email'] = array(
                                        'label' => esc_html__( 'Email address', 'woocommerce' ),
                                        'value' => wptexturize( $order->get_billing_email() ),
                                      );
                                    }

                                    if ( $order->get_billing_phone() ) {
                                      $fields['billing_phone'] = array(
                                        'label' => esc_html__( 'Phone', 'woocommerce' ),
                                        'value' => wptexturize( $order->get_billing_phone() ),
                                      );
                                    }

                                    if ( ! empty( $fields ) ) : ?>
                                  <h2><?php _e( 'Customer details', 'woocommerce' ); ?></h2>
                                  <ul>
                                    <?php foreach ( $fields as $field ) : ?>
                                      <li><strong><?php echo esc_html( $field['label'] ); ?>:</strong> <span class="text"><?php echo wp_kses_post( $field['value'] ); ?></span></li>
                                    <?php endforeach; ?>
                                  </ul>
                                <?php endif; ?><table id="addresses" cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top;" border="0">
                                  <tr>
                                    <td class="td" style="text-align:<?php echo $text_align; ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" valign="top" width="50%">
                                      <h3><?php _e( 'Billing address', 'woocommerce' ); ?></h3>

                                      <p class="text"><?php echo $order->get_formatted_billing_address(); ?></p>
                                    </td>
                                    <?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && ( $shipping = $order->get_formatted_shipping_address() ) ) : ?>
                                      <td class="td" style="text-align:<?php echo $text_align; ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" valign="top" width="50%">
                                        <h3><?php _e( 'Shipping address', 'woocommerce' ); ?></h3>

                                        <p class="text"><?php echo $shipping; ?></p>
                                      </td>
                                    <?php endif; ?>
                                  </tr>
                                </table>
                              </div>
                            </td>
                          </tr>
                        </table>
                        <!-- End Content -->
                      </td>
                    </tr>
                  </table>
                  <!-- End Body -->
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>