<?php

/**
* Maillogs_List class that will display our custom table
* records in nice table
*/
if ( ! class_exists( 'WP_List_Table' ) ) {
  require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Maillogs_List_Free extends WP_List_Table {

  /**
   * declare constructor and give some basic params
   */
  function __construct( ){

    // global $status, $page;

    parent::__construct( array (
      'singular'  => 'Mail log',
      'plural'    => 'Mail logs',
      ));

  }


  protected function get_views(){
    global $wpdb;
    $database_name = $wpdb->prefix.'sip_aenwc_queue' ;

    $views = array();
    $current = ( isset($_REQUEST['status']) ? sanitize_text_field($_REQUEST['status']) : 'all');

  //All link
    $class = ($current == 'all' ? ' class="current"' :'');
    $all_url = remove_query_arg('status');
    $status_count = $wpdb->get_var( "SELECT COUNT(*) FROM $database_name where status<>'trash'" );
    $views['all'] = "<a href='{$all_url }' {$class} >All <span class='count'>({$status_count})</span></a>";

  //Sent link
    $sent_url = add_query_arg('status','sent');
    $class = ($current == 'sent' ? ' class="current"' :'');
    $status_count = $wpdb->get_var( "SELECT COUNT(*) FROM $database_name where status='sent'" );
    if ( $status_count > 0 ) {
      $views['sent'] = "<a href='{$sent_url}' {$class} >Sent <span class='count'>({$status_count})</span></a>";
    }


  //Pending link
    $pending_url = add_query_arg('status','pending');
    $class = ($current == 'pending' ? ' class="current"' :'');
    $status_count = $wpdb->get_var( "SELECT COUNT(*) FROM $database_name where status='pending'" );
    if ( $status_count > 0 ) {
      $views['pending'] = "<a href='{$pending_url}' {$class} >Pending <span class='count'>({$status_count})</span></a>";
    }

  //Cancelled link
    $cancelled_url = add_query_arg('status','cancelled');
    $class = ($current == 'cancelled' ? ' class="current"' :'');
    $status_count = $wpdb->get_var( "SELECT COUNT(*) FROM $database_name where status='cancelled'" );
    if ( $status_count > 0 ) {
      $views['cancelled'] = "<a href='{$cancelled_url}' {$class} >Cancelled <span class='count'>({$status_count})</span></a>";
    }

  //Trash link
    $trash_url = add_query_arg('status','trash');
    $class = ($current == 'trash' ? ' class="current"' :'');
    $status_count = $wpdb->get_var( "SELECT COUNT(*) FROM $database_name where status='trash'" );
    if ( $status_count > 0 ) {
      $views['trash'] = "<a href='{$trash_url}' {$class} >Trash <span class='count'>({$status_count})</span></a>";
    }
    return $views;
  }

  /**
   * Retrieve maillog’s data from the database
   *
   * @param int $per_page
   * @param int $page_number
   *
   * @return mixed
   */
  public static function get_maillogs( $per_page = 50, $page_number = 1, $status = "all" ) {

    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->prefix}sip_aenwc_queue";

    if ( ($status != "all") && ( $status == "sent" ||  $status == "pending" ||  $status == "cancelled" ||  $status == "trash" ) ){
      $sql .= ' where status = "' . sanitize_text_field( $status );
      $sql .= '"';
    } else {
      $sql .= ' where status <> "trash"';
    }

    if ( isset( $_REQUEST['orderby'] ) ) {
      $sql .= ' ORDER BY ' . sanitize_text_field( $_REQUEST['orderby'] );
      $sql .= isset( $_REQUEST['order'] ) ? ' ' . sanitize_text_field( $_REQUEST['order'] ) : ' ASC';
    } else {
      $sql .= ' ORDER BY id desc';
    }

    $sql .= " LIMIT $per_page";
    $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;

    $result = $wpdb->get_results( $sql, 'ARRAY_A' );

    return $result;
  }

  /**
   * Delete a maillog record.
   *
   * @param int $id maillog ID
   */
  public static function delete_maillog( $id ) {
    global $wpdb;

    $wpdb->delete(
      "{$wpdb->prefix}sip_aenwc_queue",
      [ 'id' => $id ],
      [ '%d' ]
      );
  }

  /**
   * update a maillog record.
   *
   * @param int $id maillog ID
   */
  public static function update_maillog( $id , $status) {
    global $wpdb;
    
    if ( $status == 'sent' ) {
      $mailTbl = $wpdb->prefix . 'sip_aenwc_queue';
      $query = "select * from {$mailTbl} where id = %d";
      $mail = $wpdb->get_row ( $wpdb->prepare ( $query, $id ), ARRAY_A );
      
      if ( !empty( $mail ) ) {
        sip_aenwc_send_mail_free( $mail, $id );
      }
    }

    $wpdb->update( 
      "{$wpdb->prefix}sip_aenwc_queue", 
      array( 
        'status' => $status
        ), 
      array( 'id' => $id ), 
      array( '%s' ), 
      array( '%d' ) 
      );
  }


  /**
   * Returns the count of records in the database.
   *
   * @return null|string
   */
  public static function record_count($status) {
    global $wpdb;

    $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}sip_aenwc_queue";
    if ( $status == "sent" ||  $status == "pending" ||  $status == "cancelled" ||  $status == "trash" ){
      $sql .= ' where status = "' . sanitize_text_field( $status );
      $sql .= '"';
    }

    return $wpdb->get_var( $sql );
  }

  /** Text displayed when no maillog data is available */
  public function no_items() {
    _e( 'No maillogs avaliable.', 'sip-advanced-email-notifications-for-wc-free' );
  }

  /**
   * Method for name column
   *
   * @param array $item an array of DB data
   *
   * @return string
   */
  function column_id( $item ) {

  // create a nonce
    $delete_nonce   = wp_create_nonce( 'sp_delete_maillog' );
    $send_nonce   = wp_create_nonce( 'sp_send_maillog' );
    $pending_nonce  = wp_create_nonce( 'sp_pending_maillog' );
    $cancel_nonce   = wp_create_nonce( 'sp_cancel_maillog' );
    $trash_nonce  = wp_create_nonce( 'sp_trash_maillog' );

    $current = ( isset($_REQUEST['status']) ? sanitize_text_field($_REQUEST['status']) : 'all');
    $title = '<strong>' . $item['id'] . '</strong>';

    $actions = [
    'send'    => sprintf( '<a href="?page=%s&tab=%s&status=%s&action=%s&id=%s&_wpnonce=%s">Send</a>',sanitize_text_field($_REQUEST['page']),'mail_log', $current, 'send',absint( $item['id'] ),$send_nonce),
    'pending'   => sprintf( '<a href="?page=%s&tab=%s&status=%s&action=%s&id=%s&_wpnonce=%s">Pending</a>',sanitize_text_field($_REQUEST['page']),'mail_log', $current, 'pending',absint( $item['id'] ),$pending_nonce),
    'cancel'  => sprintf( '<a href="?page=%s&tab=%s&status=%s&action=%s&id=%s&_wpnonce=%s">Cancel</a>',sanitize_text_field($_REQUEST['page']),'mail_log', $current, 'cancel',absint( $item['id'] ),$cancel_nonce)
    ];

    if( $current != "trash" ) {

      $action = [
      'trash' => sprintf( '<a href="?page=%s&tab=%s&status=%s&action=%s&id=%s&_wpnonce=%s">Trash</a>', sanitize_text_field( $_REQUEST['page'] ),'mail_log', $current, 'trash', absint( $item['id'] ),$trash_nonce )
      ];
    } else {
      $action = [
      'delete' => sprintf( '<a href="?page=%s&tab=%s&status=%s&action=%s&id=%s&_wpnonce=%s">Delete</a>', sanitize_text_field( $_REQUEST['page'] ),'mail_log', $current, 'delete', absint( $item['id'] ), $delete_nonce )
      ];
    }

    $result = array_merge($actions, $action);
    return $title . $this->row_actions( $result );
  }

  /**
   * Render a column when no column specific method exists.
   *
   * @param array $item
   * @param string $column_name
   *
   * @return mixed
   */
  public function column_default( $item, $column_name ) {

    switch ( $column_name ) {
      case 'id':
      case 'event_name':
      case 'recipient_email':
      case 'status':
      case 'created':
      case 'send_at':
      return $item[ $column_name ];
      default:
    return $item[ 'id' ];
    }
  }

  /**
   * Render the bulk edit checkbox
   *
   * @param array $item
   *
   * @return string
   */
  function column_cb( $item ) {
    return sprintf(
      '<input type="checkbox" name="bulk-action[]" value="%s" />
      <input class="hidden" id="subject-%s" value="%s">
      <textarea class="hidden" id="content-%s">%s</textarea>
      ', absint( $item['id']), absint( $item['id'] ), $item['email_subject'], absint( $item['id'] ), $item['email_content']
    );
  }

  /**
   *  Associative array of columns
   *
   * @return array
   */
  function get_columns() {
    $columns = [
      'cb'  => '<input type="checkbox" />',
      'id'  => esc_html__( 'ID', 'sip-advanced-email-notifications-for-wc-free' ),
      'event_name' => esc_html__( 'Rule Name', 'sip-advanced-email-notifications-for-wc-free' ),
      'recipient_email' => esc_html__( 'Recipient', 'sip-advanced-email-notifications-for-wc-free' ),
      'status'  => esc_html__( 'Status', 'sip-advanced-email-notifications-for-wc-free' ),
      'created' => esc_html__( 'Created time', 'sip-advanced-email-notifications-for-wc-free' ),
      'send_at' => esc_html__( 'Scheduled send time', 'sip-advanced-email-notifications-for-wc-free' )
    ];

    return $columns;
  }


  /**
   * Columns to make sortable.
   *
   * @return array
   */
  public function get_sortable_columns() {
    $sortable_columns = array(
      'id' => array('id',false),
      'event_name' => array('event_name',false),
      'recipient_email' => array('recipient_email',false),
      'status' => array('status',false),
      'created' => array('created',false),
      'send_at' => array('send_at',false)
    );

    return $sortable_columns;
  }

  /**
   * Returns an associative array containing the bulk action
   *
   * @return array
   */
  public function get_bulk_actions() {
    
    $current = ( isset($_REQUEST['status']) ? sanitize_text_field($_REQUEST['status']) : 'all');

    $actions = [
      'bulk-send' => 'Send',
      'bulk-pending' => 'pending',
      'bulk-cancel' => 'Cancel'
    ];

    if( $current != "trash" ) {

      $action = [
        'bulk-trash' => 'Move to Trash'
      ];

    } else {

      $action = [
        'bulk-delete' => 'Delete'
      ];
    }

    $result = array_merge($actions, $action);
    return $result;
  }

  /**
   * Handles data query and filter, sorting, and pagination.
   */
  public function prepare_items() {

    $columns    = $this->get_columns();
    $hidden     = array(); 
    $sortable   = $this->get_sortable_columns();
    
    //here we configure table headers, defined in our methods
    $this->_column_headers = array( $columns, $hidden, $sortable );
    $status = ( isset($_REQUEST['status']) ? sanitize_text_field($_REQUEST['status']) : 'all');

    /** Process bulk action */
    $this->process_bulk_action();

    $per_page     = $this->get_items_per_page( 'maillogs_per_page', 50 );
    $current_page = $this->get_pagenum();
    $total_items  = self::record_count($status);

    $total_pages = ceil($total_items/$per_page);
    if ($total_pages < 1) {
      $total_pages = 1;
    }

    $this->set_pagination_args( [
      'total_items' => $total_items, //WE have to calculate the total number of items
      'total_pages' => $total_pages,
      'per_page'    => $per_page //WE have to determine how many items to show on a page
    ] );

    $this->items = self::get_maillogs( $per_page, $current_page, $status );
  }

  public function process_bulk_action() {
    global $sip_advanced_email_notification_for_woocommerce_free;

    //Detect when a bulk action is being triggered...
    if ( 'delete' === $this->current_action() ) {

      // In our file that handles the request, verify the nonce.
      $nonce = ( isset($_REQUEST['_wpnonce']) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : "" );
      $status = ( isset($_REQUEST['status']) ? sanitize_text_field( $_REQUEST['status'] ) : "" );
      $tab = ( isset( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : "" );
      $id = ( isset( $_REQUEST['id'] ) ? sanitize_text_field( $_REQUEST['id'] ) : "" );

      if ( ! wp_verify_nonce( $nonce, 'sp_delete_maillog' ) ) {
        die( 'Go get a life script kiddies' );
      } else {
        self::delete_maillog( absint( sanitize_text_field($_GET['id']) ) );

        wp_redirect( admin_url( 'admin.php?page=sip-advanced-email-notification-settings&tab='.$tab.'&status='.$status.'&id='. $id ) );
        exit;
      }

    } else if ( 'cancel' === $this->current_action() ) {

      // In our file that handles the request, verify the nonce.
      $nonce = ( isset($_REQUEST['_wpnonce']) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : "" );
      $status = ( isset($_REQUEST['status']) ? sanitize_text_field( $_REQUEST['status'] ) : "" );
      $tab = ( isset( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : "" );
      $id = ( isset( $_REQUEST['id'] ) ? sanitize_text_field($_REQUEST['id']) : "" );
      
      if ( ! wp_verify_nonce( $nonce, 'sp_cancel_maillog' ) ) {
        die( 'Go get a life script kiddies' );
      } else {
        self::update_maillog( absint( $id ), 'cancelled' );

        wp_redirect( admin_url( 'admin.php?page=sip-advanced-email-notification-settings&tab='.$tab.'&status='.$status.'&id='.$id.'&_wpnonce='.$nonce ) );
        exit;
      }

    } else if ( 'trash' === $this->current_action() ) {

      // In our file that handles the request, verify the nonce.
      $nonce = ( isset($_REQUEST['_wpnonce']) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : "" );
      $status = ( isset($_REQUEST['status']) ? sanitize_text_field( $_REQUEST['status'] ) : "" );
      $tab = ( isset( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : "" );
      $id = ( isset( $_REQUEST['id'] ) ? sanitize_text_field($_REQUEST['id']) : "" );

      if ( ! wp_verify_nonce( $nonce, 'sp_trash_maillog' ) ) {
        die( 'Go get a life script kiddies' );
      } else {
        self::update_maillog( absint( $id ), 'trash' );

        wp_redirect( admin_url( 'admin.php?page=sip-advanced-email-notification-settings&tab='.$tab.'&status='.$status.'&id='.$id.'&_wpnonce='.$nonce ) );
        exit;
      }

    } else if ( 'send' === $this->current_action() ) {

      // In our file that handles the request, verify the nonce.
      $nonce = ( isset($_REQUEST['_wpnonce']) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : "" );
      $status = ( isset($_REQUEST['status']) ? sanitize_text_field( $_REQUEST['status'] ) : "" );
      $tab = ( isset( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : "" );
      $id = ( isset( $_REQUEST['id'] ) ? sanitize_text_field($_REQUEST['id']): "" );

      if ( ! wp_verify_nonce( $nonce, 'sp_send_maillog' ) ) {
        die( 'Go get a life script kiddies' );
      } else {
        self::update_maillog( absint( $id ), 'sent' );

        wp_redirect( admin_url( 'admin.php?page=sip-advanced-email-notification-settings&tab='.$tab.'&status='.$status.'&id='.$id.'&_wpnonce='.$nonce ) );
        exit;
      }

    } else if ( 'pending' === $this->current_action() ) {

      // In our file that handles the request, verify the nonce.
      $nonce = ( isset($_REQUEST['_wpnonce']) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : "" );
      $status = ( isset($_REQUEST['status']) ? sanitize_text_field( $_REQUEST['status'] ) : "" );
      $tab = ( isset( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : "" );
      $id = ( isset( $_REQUEST['id'] ) ? sanitize_text_field($_REQUEST['id']) : "" );
      
      if ( ! wp_verify_nonce( $nonce, 'sp_pending_maillog' ) ) {
        die( 'Go get a life script kiddies' );
      } else {
        self::update_maillog( absint( $id ), 'pending' );

        wp_redirect( admin_url( 'admin.php?page=sip-advanced-email-notification-settings&tab='.$tab.'&status='.$status.'&id='.$id.'&_wpnonce='.$nonce ) );
        exit;
      }

    }

    if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-send' ) || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-send' ) ) {

      $send_ids = ( isset($_POST['bulk-action']) ? $sip_advanced_email_notification_for_woocommerce_free->recursive_sanitize_text_field($_POST['bulk-action']) : "" );
      $status = ( isset($_REQUEST['status']) ? sanitize_text_field( $_REQUEST['status'] ) : "" );
      $tab = ( isset( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : "" );
      

    // loop over the array of record IDs and delete them
      foreach ( $send_ids as $id ) {
        self::update_maillog( $id , 'sent' );
      }

      wp_redirect( admin_url( 'admin.php?page=sip-advanced-email-notification-settings&tab='.$tab.'&status='.$status ) );
      exit;
    } else if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-pending' ) || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-pending' ) ) {

      $pending_ids = ( isset($_POST['bulk-action']) ? $sip_advanced_email_notification_for_woocommerce_free->recursive_sanitize_text_field($_POST['bulk-action']) : "" );
      $status = ( isset($_REQUEST['status']) ? sanitize_text_field( $_REQUEST['status'] ) : "" );
      $tab = ( isset( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : "" );
      

    // loop over the array of record IDs and delete them
      foreach ( $pending_ids as $id ) {
        self::update_maillog( $id , 'pending' );
      }

      wp_redirect( admin_url( 'admin.php?page=sip-advanced-email-notification-settings&tab='.$tab.'&status='.$status ) );
      exit;
    } else if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-cancel' ) || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-cancel' ) ) {

      $cancelled_ids = ( isset($_POST['bulk-action']) ? $sip_advanced_email_notification_for_woocommerce_free->recursive_sanitize_text_field($_POST['bulk-action'])  : "" );
      $status = ( isset($_REQUEST['status']) ? sanitize_text_field( $_REQUEST['status'] ) : "" );
      $tab = ( isset( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : "" );
      
    // loop over the array of record IDs and delete them
      foreach ( $cancelled_ids as $id ) {
        self::update_maillog( $id, 'cancelled' );
      }

      wp_redirect( admin_url( 'admin.php?page=sip-advanced-email-notification-settings&tab='.$tab.'&status='.$status ) );
      exit;
    } else if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-trash' ) || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-trash' ) ) {

      $trash_ids = ( isset($_POST['bulk-action']) ?  $sip_advanced_email_notification_for_woocommerce_free->recursive_sanitize_text_field($_POST['bulk-action'])  : "" );
      $status = ( isset($_REQUEST['status']) ? sanitize_text_field( $_REQUEST['status'] ) : "" );
      $tab = ( isset( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : "" );

    // loop over the array of record IDs and delete them
      foreach ( $trash_ids as $id ) {
        self::update_maillog( $id, 'trash' );
      }

      wp_redirect( admin_url( 'admin.php?page=sip-advanced-email-notification-settings&tab='.$tab.'&status='.$status ) );
      exit;
    }
  }
}