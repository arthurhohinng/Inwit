<?php

function fetch_user_container_data(){
	global $wpdb;
	
	if ( is_user_logged_in() ){
		
		$user = wp_get_current_user();
		
		$query = $wpdb->prepare("SELECT * 
									FROM `Container` 
									WHERE `recipient_id` = %d 
									ORDER BY `transaction_date` DESC 
									LIMIT 10"
								, $user->id);
		$query_result = $wpdb->get_results( $query);
		
	}
}
?>

