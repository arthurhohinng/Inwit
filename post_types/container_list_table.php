<php?

if(!class_exists('WP_List_Table')) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class container_post_list_table extends WP_List_Table
{	
	function column_cb( $item ) {
		return sprintf('<input type="checkbox" name="container[]" value="%s" />', $item['container_id']);    
	}
	
	function get_columns(){
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'container_id' => 'ID',
			'restaurant_id' => 'Restaurant',
			'container_status' => 'Status',
			'transaction_date' => 'Transaction Date',
			'order_id' => 'Order Number',
			'recipient_id' => 'Recipient'
		);
		return $columns;
	}
	
	function column_default( $item, $column_name ) {
		switch( $column_name ) { 
			case 'container_id':
			case 'restaurant_id':
			case 'container_status':
			case 'transaction_date':
			case 'order_id':
			case 'recipient_id':
				return $item[ $column_name ];
		default:
				return print_r( $item, true );
		}
	}

	function prepare_items() {
		global $wpdb;
		
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = array();
		$this->_column_headers = array($columns, $hidden, $sortable);
		
		$query = $wpdb->prepare("SELECT * FROM `Container`");
		$result = $wpdb->get_results( $query, "ARRAY_A" );
		
		// get user information
		$query_users = $wpdb->prepare("SELECT * FROM `wpar_users`");
		$result_users = $wpdb->get_results( $query_users, "OBJECT_K" );

		// map numbers from table to more informative labels
		foreach ( $result as $key => $row ) {
			$result[$key]["restaurant_id"] = $result_users[$row["recipient_id"]]->display_name . " ({$row["restaurant_id"]})";
			$result[$key]["recipient_id"] = $result_users[$row["recipient_id"]]->user_nicename . " ({$result_users[$row["recipient_id"]]->ID})";
		}
		
		$this->items = $result;
	}
	
	function column_container_id( $item ) {
		$actions = array(
			'add' => sprintf('<a href="post.php?post=1735&action=edit">Add New</a>'),
			'edit' => sprintf('<a href="post.php?post=1733&action=edit">Edit</a>'),
			'delete' => sprintf('<a href="post.php?post=1737&action=edit">Delete</a>')
        );
		return sprintf('%1$s %2$s', $item['container_id'], $this->row_actions($actions) );
	}
	
	function get_bulk_actions() {
		$actions = array(
			'delete' => 'delete'
		);
		return $actions;
	}
}


add_filter( 'views_edit-container',  "set_container_post_list_table");
function set_container_post_list_table() {
    global $wp_list_table;
    $list_table = new container_post_list_table();
	$list_table->prepare_items();
    $wp_list_table = $list_table;
}