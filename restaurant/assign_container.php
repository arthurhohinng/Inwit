<?php

//Helper function to get a customer id by order id
function get_customer_id_by_order_id( $order_id ) {
		
	$order = wc_get_order( $order_id );
	$customer_id = ( $order != null ) ? ( $order->get_customer_id() ) : (null);

	return $customer_id;
}

// Function for when container is scanned
function assign_container( $container_id, $order_id ) {
	global $wpdb;
	
	$customer_id = get_customer_id_by_order_id( $order_id );
	date_default_timezone_set('America/Toronto');
	$date = date('Y/m/d h:i:s', time());
	$query = $wpdb->prepare("UPDATE `Container` 
							 SET `recipient_id` = %d, `order_id` = %d, 
							 `container_status` = 1, `transaction_date` = %s
							 WHERE `container_id` = %d" 
							, array( $customer_id, $order_id, $date, $container_id ));
	$result = $wpdb->get_results($query);
	
}

function assign_container_script() {
	session_start();
	if ( isset( $_SESSION["curr_order"] ) ) {
		$order_id = $_SESSION["curr_order"];
		$container_id = explode( "-", $_SERVER['REQUEST_URI'] )[1];
		$container_id = intval( substr( $container_id, 0, 6 ) );
		
		echo $order_id;
		assign_container( $container_id, $order_id );
		
	}
	
}

add_shortcode ( 'assign_container_script', 'assign_container_script' );