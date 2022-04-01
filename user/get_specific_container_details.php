<?php
/**
 * Gets the container details with id=<container_id> passed in url
 */

function get_user_container_details(){
	global $wpdb;
	$container_statuses = array("Active", "Pending", "Lost", "Broken", "Purchased");
	if ( is_user_logged_in() ){
		if ( isset( $_GET["id"] ) ){
			$container_id = $_GET["id"];
			$user = wp_get_current_user();
			$query = $wpdb->prepare("SELECT * 
									FROM `Container` 
									WHERE `container_id` = %d
									AND `recipient_id` = %d"
								, array( $container_id, $user->ID ));
			$result = $wpdb->get_row($query);
			if ( count( $result ) > 0 ){
				echo "<div> Container ID: " . $container_id . "</div>";
				echo "<div> Container Status: " . $container_statuses[strval($result->container_status)] . "</div>";
				echo "<div> Order #" . strval( $result->order_id ) . "</div>";
				echo "<a href='../product/container/?id=$container_id&option=buy'>
						<button>Buy Container</button>
					  </a>";
				echo "<a href='../product/container/?id=$container_id&option=pickup'>
						<button>Pickup Container</button>
					  </a>";
			}
			
		}
		
	}
}

add_shortcode ( 'get_user_container_details', 'get_user_container_details' );
