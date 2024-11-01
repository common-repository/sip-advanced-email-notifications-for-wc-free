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
   function sip_advanced_email_notification_meta_boxes_free( ) {
       global $post;
       add_meta_box ( 'sip-advanced-email-notification-rule', esc_html__( 'Advanced Email conditions', 'sip-advanced-email-notifications-for-wc-free' ), 'sip_advanced_email_notification_meta_box_free', 'a_e_n_shop', 'normal', 'high' );

       add_meta_box ( 'sip-advanced-email-notification-email', esc_html__( 'Emails', 'sip-advanced-email-notifications-for-wc-free' ), 'sip_advanced_email_notification_email_meta_box_free', 'a_e_n_shop', 'normal', 'default' );

       add_meta_box ( 'sip-advanced-email-notification-test-email', esc_html__( 'Test Email', 'sip-advanced-email-notifications-for-wc-free' ), 'sip_advanced_email_notification_test_email_meta_box_free', 'a_e_n_shop', 'normal', 'default' );

       remove_meta_box ( 'commentstatusdiv', 'a_e_n_shop', 'normal' );
       remove_meta_box ( 'commentsdiv', 'a_e_n_shop', 'normal' );
       remove_meta_box ( 'slugdiv', 'a_e_n_shop', 'normal' );
   }
   add_action ( 'add_meta_boxes', 'sip_advanced_email_notification_meta_boxes_free' );


    function sip_advanced_email_notification_admin_footer_free() {

        global $pagenow, $typenow;
        if (isset( $_GET['post'] )) {
            $post_type = get_post_type( sanitize_text_field($_GET['post']) );
        } else {
            $post_type = $typenow;
        }

        if ( ( $pagenow == 'edit.php' || $pagenow =='post-new.php' || $pagenow =='post.php' ) && $post_type =='a_e_n_shop') {
               /*  echo  '<!-- The Modal -->
                <div id="myModal" class="modal">
                
                    <!-- Modal content -->
                    <div class="modal-content">
                    <span class="close">&times;</span>
                    <iframe id="iframe1" class="output-email-preview"></iframe>
                    </div>
                
                </div'; */
        }
    }
    add_action('admin_footer', 'sip_advanced_email_notification_admin_footer_free');

    function sip_advanced_email_notification_meta_box_free( $post ) {
        require_once(SIP_AENWCF_DIR . "admin/partials/ui/email-conditions.php");     
    }
    function sip_advanced_email_notification_email_meta_box_free( $post ) {
        require_once(SIP_AENWCF_DIR . "admin/partials/ui/email-notification-email-meta-box.php");       
    }



    function save_sip_advanced_email_notification_meta_box_free( $post_id, $post ) {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $emailChainTbl = $prefix . 'sip_aenwc_email_chain';
        // Check if our nonce is set.
        if ( ! isset( $_POST['sip_advanced_email_notification_meta_box_nonce'] ) ) {
            return;
        }
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST['sip_advanced_email_notification_meta_box_nonce'], 'save_sip_advanced_email_notification_meta_box_free' ) ) {
            return;
        }

        $sip_a_e_n_args = array(
            "post_type" => "a_e_n_shop",
            "posts_per_page" => -1,
            "order" => "desc",
            "orderby" => "ID",
            "fields" => "ids",
            "post_status" => array("publish")
        );
            
        if(isset($_POST["original_post_status"]) && $_POST["original_post_status"] == "auto-draft"){
            $sip_a_e_n_query = new Wp_Query($sip_a_e_n_args);
            if($sip_a_e_n_query->found_posts > 3){
                wp_delete_post($post->ID, true);
                $url = esc_url( admin_url( 'admin.php?page=sip-advanced-email-notification-settings' ) );
                wp_redirect( add_query_arg('message', 0,  $url) );
                die;
            }
        }
            

        // Is the user allowed to edit the post?
        if ( !current_user_can( 'edit_post', $post->ID ) ){ return $post->ID; }
          
        $data['sip_a_e_n_wc_status'] = sanitize_text_field($_POST['sip_a_e_n_wc_status']);
        $data['sip_a_e_n_wc_multeple_email'] = ( isset( $_POST['sip_a_e_n_wc_multeple_email'] ) ? sanitize_text_field($_POST['sip_a_e_n_wc_multeple_email']) : 'no' );
        $data['sip_a_e_n_wc_order_status_field'] = sanitize_text_field($_POST['sip_a_e_n_wc_order_status_field']);
        // $wpdb->delete($emailChainTbl, array('post_id' => $post_id ));
        
        ////////////////////insert/update email chain
        
        if (isset ( $_POST ['chain'] ) && count ( $_POST ['chain'] ) > 0) {
            foreach ( $_POST ['chain'] as $key => $value ) {
                if (isset( $value ['BEFORE']) && isset($value ['subject']) && isset($value ['content'])) {
                    $value ['is_new'] = sanitize_text_field($value ['is_new']);
                    $email_chain_data = array (
                            'post_id' => $post_id,
                            'before_or_after' => sanitize_text_field($value ['BEFORE']),
                            'day' => 0,
                            'hour' => 0,
                            'mins' => 0,
                            'subject' => sanitize_text_field($value ['subject']),
                            'content' => wp_kses_post($value ['content']),
                            'bcc' => "",
                            'to_customer' => sanitize_text_field($value ['TO_CUSTOMER']),
                            'header_css' => ''
                    );
                    $before  = sanitize_text_field($value ['BEFORE']);
                    $day     = 0;
                    $hour    = 0;
                    $mins    = 0;
                    $subject = sanitize_text_field($value ['subject']);
                    $content = wp_kses_post($value ['content']);
                    $bcc     = "";
                    $to_customer = sanitize_text_field($value ['TO_CUSTOMER']);
                    $header_css = '';
                    $email_chain_id = sanitize_text_field($value ['email_chain_id']);
                    if ( $email_chain_data['subject'] && !empty($email_chain_data['subject']) && $email_chain_data['content']  ) {
                        if ( isset($value ['is_new'])  ) {
                                if($value ['is_new'] == 1){
                                    $query = "INSERT INTO {$emailChainTbl} 
                                    (`post_id`, `before_or_after`, `day`, `hour`, `mins`, `subject`, `bcc`, `content`, `to_customer`, `header_css`)
                                    VALUES ($post_id,$before,$day, $hour , $mins, '$subject', '$bcc', '$content', '$to_customer', '$header_css')";
                                    $wpdb->query($query);
                                }else{
                                    $query = "Update {$emailChainTbl} set `before_or_after` = {$before} , `day` ={$day} , `hour` = {$hour},`mins` ={$mins},`bcc`='{$bcc}' ,`subject`='{$subject}' , `content` = '{$content}', `to_customer` = '{$to_customer}', `header_css` = '{$header_css}' where `id` ={$email_chain_id} ";
                                    $wpdb->query($query);
                                }
                                
                        } else {
                            $query = "Update {$emailChainTbl} set `before_or_after` = {$before} , `day` ={$day} , `hour` = {$hour},`mins` ={$mins},`bcc`='{$bcc}' ,`subject`='{$subject}' , `content` = '{$content}', `to_customer` = '{$to_customer}', `header_css` = '{$header_css}' where `id` ={$email_chain_id} ";
                            $wpdb->query($query);
                        }
                    }
                }
            }
        }
          
          
          if (isset( $_POST['sip_a_e_n_wc_test_email'] )) {
              $data['sip_a_e_n_wc_test_email'] = sanitize_email($_POST['sip_a_e_n_wc_test_email']);
          } else {
              $data['sip_a_e_n_wc_test_email'] = "";
          }
          $data['_sip_shipping_method_conditions'] = sip_admin_recursive_sanitize_text_field($_POST['_sip_shipping_method_conditions']);
            
          $data = sip_admin_recursive_sanitize_text_field($data);
          foreach ( $data as $key => $value ) {
              // if ( $post->post_type == 'revision' ) return;
              //$value = implode( ',', (array)$value );
              if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value it will update
                  update_post_meta( $post->ID, $key, $value );
              } else { // If the custom field doesn't have a value it will add
                  add_post_meta( $post->ID, $key, $value );
              }
              if (!$value) delete_post_meta( $post->ID, $key ); // Delete if blank value
          }
      }

    

    add_action( 'save_post', 'save_sip_advanced_email_notification_meta_box_free', 1, 2 );
    function sip_aenwc_get_chain_of_post_id_free( $postId ) {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $chainTbl = $prefix . 'sip_aenwc_email_chain';
        $query = "select * from $chainTbl where post_id = $postId";
        $rows = $wpdb->get_row ( $query, ARRAY_A );
        if ( !empty($rows) ) {
            return $rows;
        }
        return array();
    }
      
    function sip_advanced_email_notification_test_email_meta_box_free( $post ) {
        require_once(SIP_AENWCF_DIR . "admin/partials/ui/email-notification-test-email.php"); 
    }

    function sip_advanced_email_notification_add_columns_free( $columns ) {
        $new_columns = (is_array ( $columns )) ? $columns : array ();
        // $new_columns['title'] ;
        unset ( $new_columns ['date'] );
        unset ( $new_columns ['comments'] );

        $new_columns ["sip_a_e_n_wc_status"]        = esc_html__( 'Status', 'sip-advanced-email-notifications-for-wc-free' );
        return $new_columns;
    }
    add_filter ( 'manage_edit-a_e_n_shop_columns', 'sip_advanced_email_notification_add_columns_free' );

    function sip_advanced_email_notification_custom_columns_free( $column ) {
        global $post;
        switch ( $column ) {
            case "sip_a_e_n_wc_status" :
            $status = get_post_meta ( $post->ID, 'sip_a_e_n_wc_status', true );
            echo $status;
            break;
        }
    }
    add_action ( 'manage_a_e_n_shop_posts_custom_column', 'sip_advanced_email_notification_custom_columns_free', 2 );


    function sip_admin_recursive_sanitize_text_field($array) {
		foreach ( $array as $key => &$value ) {
			if ( is_array( $value ) ) {
				$value = sip_admin_recursive_sanitize_text_field($value);
			}
			else {
				$value = sanitize_text_field( $value );
			}
		}
	
		return $array;
	}