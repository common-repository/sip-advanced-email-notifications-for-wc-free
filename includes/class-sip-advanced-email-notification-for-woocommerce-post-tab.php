<?php

/**
 * Sip_Advanced_Email_Notification_WC_Admin_Post_Tab class that will display our custom table
 * records in nice table
 */
class Sip_Advanced_Email_Notification_WC_Admin_Post_Tab_Free extends WP_List_Table {
  
  /**
   * declare constructor and give some basic params
   */
  function __construct( ){

    global $status, $page;

    parent::__construct( array (
      'singular'  => 'Email Notification',
      'plural'    => 'Email Notifications',
    ));
  
  }

  /**
   * this is a default column renderer
   *
   * @param $item - row (key, value array)
   * @param $column_name - string (key)
   * @return HTML
   */
  function column_default( $item, $column_name ) {
  
    return $item[$column_name];
  
  }

  /**
   * how to render specific column
   *
   *
   * @param $item - row (key, value array)
   * @return HTML
   */
  function column_post_date( $item ) {
  
    return '' . $item['post_date'] . '';
  
  }

  /**
   *  render column with actions,
   *  hover row "Edit | Delete" links showed
   *
   * @param $item - row (key, value array)
   * @return HTML
   */
  function column_post_title( $item ) {
      
    $actions = array(
      'edit'    => sprintf( '<a href="post.php?post=%s&action=edit">%s</a>', $item['ID'], esc_html__( 'Edit', 'sip-advanced-email-notifications-for-wc-free' ) ),
      'delete'  => sprintf( '<a href="?page=%s&action=delete&id=%s">%s</a>', sanitize_text_field($_REQUEST['page']), $item['ID'], esc_html__( 'Delete', 'sip-advanced-email-notifications-for-wc-free' ) ),
    );

    return sprintf( '%s %s',
      $item['post_title'],
      $this->row_actions( $actions )
    );
  
  }

  /**
   * checkbox column renders
   *
   * @param $item - row (key, value array)
   * @return HTML
   */
  function column_cb( $item ) {
  
    return sprintf(
      '<input type="checkbox" name="id[]" value="%s" />',
      $item['ID']
    );
  
  }

  /**
   * return columns to display in table
   * like content, or description
   *
   * @return array
   */
  function get_columns( ) {
  
    $columns = array(
      'cb'            => '<input type="checkbox" />', //Render a checkbox instead of text
      'post_title'    => esc_html__( 'Title', 'sip-advanced-email-notifications-for-wc-free' ),
      'post_date'     => esc_html__( 'Date',  'sip-advanced-email-notifications-for-wc-free' ),
      'meta_value'    => esc_html__( 'Status', 'sip-advanced-email-notifications-for-wc-free' ),
      'post_status'   => esc_html__( 'Post Status', 'sip-advanced-email-notifications-for-wc-free' ),
    );
    return $columns;
  
  }

  /**
   * return columns that may be used to sort table
   * all strings in array - is column names
   *
   * @return array
   */
  function get_sortable_columns( ) {

    $sortable_columns = array(
      'post_title'    => array( 'title', true ),
      'post_date'     => array( 'post_date', false ),
      'meta_value'    => array( 'meta_value', false ),
      'post_status'   => array( 'post_status', false ),
    );
    return $sortable_columns;
  
  }

  /**
   * bult actions if has any
   *
   * @return array
   */
  function get_bulk_actions( ) {
  
    $actions = array(
      'delete' => 'Delete'
    );
    return $actions;
  
  }


  /**
   * Delete a rule record.
   *
   * @param int $id maillog ID
   */
  public static function delete_rule( $id ) {
    global $wpdb;

    $wpdb->delete(
      "{$wpdb->prefix}posts",
      [ 'id' => $id ],
      [ '%d' ]
      );
  }

  /**
   * processes bulk actions
   * message about successful deletion will be shown on page in next part
   */
  function process_bulk_action( ) {
  
    global $wpdb, $sip_advanced_email_notification_for_woocommerce_free;

    if ( 'delete' === $this->current_action( ) ) {
      $ids = isset( $_REQUEST['id'] ) ? is_array($_REQUEST['id'])? $sip_advanced_email_notification_for_woocommerce_free->recursive_sanitize_text_field($_REQUEST['id']):sanitize_text_field($_REQUEST['id']) : array();
      if (!empty( $ids ) ) {
        if ( is_array( $ids ) ){
          foreach ( $ids as $id ) {
            self::delete_rule( $id );
          }
        } else {
            self::delete_rule( $ids );
        }
      }
    }
  
  }

	protected function get_table_classes() {
		$mode = get_user_setting( 'posts_list_mode', 'list' );

		$mode_class = esc_attr( 'table-view-' . $mode );

		return array( 'widefat', 'fixed', 'striped', $mode_class, $this->_args['plural'], "free-email-notification-list-table" );
	}

  /**
   * important method
   *
   * It will get rows from database and prepare them to be showed in table
   */
  function prepare_items( ) {
  
    global $wpdb;

    $per_page   = 10; // constant, how much records will be shown per page
    $columns    = $this->get_columns();
    $hidden     = array(); 
    $sortable   = $this->get_sortable_columns();
    
    // here we configure table headers, defined in our methods
    $this->_column_headers = array( $columns, $hidden, $sortable );

    // process bulk action if any
    $this->process_bulk_action();

    // will be used in pagination settings
    $total_items = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->posts WHERE `post_type` = 'a_e_n_shop' AND (`post_status`='publish' OR `post_status`='draft') ");

    $paged      = isset($_REQUEST['paged']) ? max(0, intval(sanitize_text_field($_REQUEST['paged'])) - 1) : 0;
    $orderby    = (isset($_REQUEST['orderby']) && in_array(sanitize_text_field($_REQUEST['orderby']), array_keys($this->get_sortable_columns()))) ? sanitize_text_field($_REQUEST['orderby']) : 'post_title';
    $order      = (isset($_REQUEST['order']) && in_array(sanitize_text_field($_REQUEST['order']), array('asc', 'desc'))) ? sanitize_text_field($_REQUEST['order']) : 'asc';

    $paged=$per_page*$paged;
    $querystr = $wpdb->prepare("
        SELECT $wpdb->posts.ID, $wpdb->posts.post_title, $wpdb->posts.post_date, $wpdb->postmeta.meta_value, $wpdb->posts.post_status 
        FROM $wpdb->posts, $wpdb->postmeta
        WHERE ($wpdb->posts.post_status = 'publish' OR $wpdb->posts.post_status = 'draft') 
        AND $wpdb->posts.ID = $wpdb->postmeta.post_id 
        AND $wpdb->postmeta.meta_key = 'sip_a_e_n_wc_status'
        AND $wpdb->posts.post_type = 'a_e_n_shop'
        ORDER BY $orderby $order
        LIMIT %d OFFSET %d" , $per_page, $paged
     );

      $pageposts = $wpdb->get_results($querystr, ARRAY_A);
      $this->items = $pageposts;

      $this->set_pagination_args( array(
          'total_items'   => $total_items, // total items defined above
          'per_page'      => $per_page, // per page constant defined at top of method
          'total_pages'   => ceil( $total_items / $per_page ) // calculate pages count
      ));
    }
	
  }
