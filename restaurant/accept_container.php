<?php

function inwit_checkin_sys() {
	
	global $wpdb;
	$user = wp_get_current_user(); //capture the current user(restaurant) information 
	$container_id = get_the_ID(); //get the current post id. (i.e. id of the container)
	$prepared = $wpdb->prepare("SELECT `restaurant_id` 
								FROM `Container` 
								WHERE `container_id` = %d",
							    $containerid);
	$query_result = $wpdb->get_results($prepared);

	if ( is_user_logged_in() && $query_result[0]->restaurant_id == $user->id) { //check if user is logged in
		date_default_timezone_set('Canada/Toronto');
		$date = date('m/d/Y h:i:s a', time());
		
		// $current_date_time = current_time('mysql');
		
		$query = $wpdb->prepare("UPDATE `Container` 
								 SET `restaurant_id` = %d, `recipient_id` = null, `order_id` = null, 
								 `container_status` = 0, `transaction_date` = %s
								 WHERE `container_id` = %d" 
								, array($user->id, $date, $container_id ));
		$result = $wpdb->get_results($query);

		// email the restaurant
		$email = $user->user_email
		wp_mail($user->user_email, "Container Scanned", "A container with id: $container_id has been scanned at $date.");

        // if ( !(is_user_container_possessor($user->id, $post_id)) ) { //Vendor does not possess container in database, ready for scanning back into the restaurant's inventory

        //     // sets the container status to available
        //     set_container_status(0, $post_id)
        //     //echo nl2br("Container received!\n"); //DEBUG PURPOSES
            
        //     if ( ($previous_user_role != null) && ($previous_user_role == 'customer') ) {
        //         reward_impactpoints_on_return($wpdb->insert_id, $previous_user->transaction_id);
        //     }
        //     close_window_wp_head(); //close page at the end of script
        // }												
		
		// elseif ( in_array( 'customer', $roles ) ) { //Is the user a customer?
			
		// 	wp_redirect( 'http://sandbox.inwit.app/landing'); //send customer to their landing page
		// 	exit;
			
		// }
		// else {
		// 	close_window_wp_head(); //close page at the end of script
		// }

	}
	
	else { // if no logged in user
		wp_redirect( 'http://sandbox.inwit.app/login' );
		exit;
	}
	
}

add_shortcode ( 'exec_checkin_script', 'inwit_checkin_sys' );

?>
