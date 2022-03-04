<?php
function display_user_container_table(){
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
			foreach ($query_result as $row) {
				echo "
				<div class='order'>
					<div class='left'>
						<a href='../view-order/$row->order_id'>
							<div class='ID'>Order #" . $row->order_id . "</div>
						</a>
						<div class='date'>" . $row->transaction_date . "</div>
					</div>
					<div class='right'>
						<div class='status'>" . $row->container_status . "</div>";
				// If container status is pending show link to get container details
				// Assuming 1 == pending
				if ( $row->container_status == 1 ){
					echo "<a href='./?id=$row->container_id'> View Options </a>";
				}
					echo "</div>
				</div>";
			}
			
		}
	}

?>

add_shortcode ( 'display_user_container_data', 'display_user_container_data' );