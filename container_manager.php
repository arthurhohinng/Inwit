<?php

//Helper function to determine if a user is in possession of a container. Note: "containerid" is also "postid".
function is_user_container_possessor($userid, $containerid) {
	global $wpdb;
	
	$prepared = $wpdb->prepare("SELECT `recipient_id` 
								FROM `Container` 
								WHERE `container_id` = %d 
								ORDER BY `transaction_date` DESC 
								LIMIT 1",
							    $containerid);
	$query_result = $wpdb->get_results($prepared);
	
	return ($query_result != null) ? ($query_result[0]->recipient_id == $userid) : (false);
}


// A helper function for counting the number of each status $status can be Active, Lost, Broken, All
function get_container_status($status){
	global $wpdb;
	
	if (is_user_logged_in()) { //check if user is logged in
	
		$user = wp_get_current_user(); //capture the current user information
		
		//Get a list of containers the user has ever been in possession of
		$prepared = $wpdb->prepare("SELECT DISTINCT `container_id` 
									FROM `Container` 
									WHERE `recipient_id` = %d",
								    $user->id);
		$query_result = $wpdb->get_results($prepared);
		
		$count = 0;
		
		if (($query_result != null) && (function_exists('is_user_container_possessor'))) {
			
			//Check each container if user is currently in possession of it
			foreach ($query_result as $value) {
				$cont_id = $value->container_id;
				if (is_user_container_possessor($user->id, $cont_id)) {
					if ($status == 'All'){
						$count++; 
					}
					else{
						if ($status == $value->container_status){
							$count++;
						}
					}
				}
			}				
		}
		
		echo $count;
		
	}
}

// Function to return the total number of containers a logged-in user has. Note: A restuarant is considered a user. 
function get_user_container_count() {
	
	get_container_status('All');

}

// Function to return the total number of active containers a logged-in user has. Note: A restuarant is considered a user. 
function get_user_active_container_count() {
	
	get_container_status('Active');

}

// Function to return the total number of lost containers a logged-in user has. Note: A restuarant is considered a user. 
function get_user_lost_container_count() {
	
	get_container_status('Lost');

}

// Function to return the total number of broken containers a logged-in user has. Note: A restuarant is considered a user. 
function get_user_broken_container_count() {
	
	get_container_status('Broken');

}


add_shortcode ('print_loggedin_user_container_count', 'get_user_container_count');
add_shortcode ('print_loggedin_user_active_container_count', 'get_user_active_container_count');
add_shortcode ('print_loggedin_user_lost_container_count', 'get_user_lost_container_count');
add_shortcode ('print_loggedin_user_broken_container_count', 'get_user_broken_container_count');


?>
