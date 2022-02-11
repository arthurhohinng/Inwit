<?php
function display_user_containers() {
	global $wpdb;
	if (is_user_logged_in()) {
        	$user = wp_get_current_user();
        	$query = $wpdb->prepare("SELECT * FROM 'Container' WHERE
                                 'recipient_id' = %d", $user->ID);
        	$results = $wpdb->get_results($query);
        	echo "Your Containers";

        	foreach ($results as $result) {
            		echo <<<EOL
					"Container ID: " $result->container_id
					"Restaurant ID: " $result->restaurant_id
					"Container Status: " $result->container_status 
					"Transaction Date: " . $result->transaction_date
					"Order ID: " . $result->order_id"
					EOL;
        	}
    	}
}
add_shortcode( 'display_user_containers', 'display_user_containers');
