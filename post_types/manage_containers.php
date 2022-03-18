<?php

function edit_container_table( $post_ID, $post_after, $post_before ) {
	global $wpdb;
	
	// edit containers
	if ($post_ID == 1733) {
		$meta = get_post_meta( $post_ID );
		
		$wpdb->update('Container', array(
			'restaurant_id' => $meta['Restaurant'][0],
			'container_status' => $meta['Status'][0],
			'transaction_date' => $meta['Transaction Date'][0],
			'order_id' => $meta['Order'][0],
			'recipient_id' => $meta['Recipient'][0]),
			array('container_id' => $meta['Container ID'][0])
		);
	}
	
	// add containers
	if ($post_ID == 1735) {
		$meta = get_post_meta( $post_ID );
		
		$wpdb->insert('Container', array(
			'restaurant_id' => $meta['Restaurant'][0],
			'container_status' => $meta['Status'][0],
			'transaction_date' => $meta['Transaction Date'][0],
			'order_id' => $meta['Order'][0],
			'recipient_id' => $meta['Recipient'][0]
		));
	}
	
	// delete containers
	if ($post_ID == 1737) {
		$meta = get_post_meta( $post_ID );
		
		$wpdb->delete('Container', array('container_id' => $meta['Container ID'][0]));
	}
}
add_action( 'post_updated', 'edit_container_table', 10, 3 );