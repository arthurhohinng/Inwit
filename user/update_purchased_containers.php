<?php

/**
 * Set purchased containers to purchased status in database and email restaurant and Inwit.
 */

function update_purchased_containers( $order_id ) {

	$order = wc_get_order( $order_id );
    $items = $order->get_items();

    foreach( $items as $product ) {
		// Check if item is buy container (buy container id = 1339)
		if ( $product['product_id'] == 1339 ) {
			$container_id = $product['container_id'];
			
			global $wpdb;
			if ( is_user_logged_in() ){
				$user = wp_get_current_user();
				date_default_timezone_set('America/Toronto');
				$date = date('Y/m/d h:i:s', time());
				// Sets the container to purchased (container_status 4 maps to purchased)
				$query = $wpdb->prepare("UPDATE `Container` 
							 			 SET `recipient_id` = %d, `order_id` = %d, 
							 			 `container_status` = 4, `transaction_date` = %s
							 			 WHERE `container_id` = %d" 
										 , array( $user->ID, $order_id, $date, $container_id ));
				$result = $wpdb->get_results( $query );
				
				// SELECT restaurant_id of container
				$query = $wpdb->prepare("SELECT restaurant_id
										 FROM `Container`
										 WHERE `container_id` = %d"
									    , $container_id);
				$result = $wpdb->get_row( $query );
				$restaurant_id = $result->restaurant_id;
				$restaurant = get_userdata( $restaurant_id );

				// Email
				// the message
				$msg = "Container $container_id from restaurant: $restaurant_id was purchased!";

				// use wordwrap() if lines are longer than 70 characters
				$msg = wordwrap($msg,70);

				// send email (recipient email, subject, message)
				// mail to user
				mail($user->user_email, "A Container Purchased!", $msg);
				// mail to Inwit
				// mail(whatever email inwit uses, "A Container Purchased!", $msg);
				// mail to restaurant
				mail($restaurant->user_email, "A Container Purchased!", $msg);
				
			}
		}
    }
}

add_action('woocommerce_payment_complete', 'update_purchased_containers');