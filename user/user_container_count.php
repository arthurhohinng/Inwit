<?php
function get_user_container_count(){
	global $wpdb;

	if ( is_user_logged_in() ){

		$user = wp_get_current_user();

		$query = $wpdb->prepare("SELECT COUNT(DISTINCT `container_id`)
									AS num_containers
									FROM `Container` 
									WHERE `recipient_id` = %d"
								   , $user->ID);
		$result = $wpdb->get_row($query);
		$count = strval($result->num_containers);

		echo $count;

	}
}

add_shortcode ( 'get_user_container_count', 'get_user_container_count' );