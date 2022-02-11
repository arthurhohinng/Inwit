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
	
			echo "<style>";
			echo "body {font-family: Arial;}";
	
			echo ".table_container { padding: 10px 12px 0px 12px;  border: 1px solid #ccc;  }";
			echo ".table_container th { background-color:lightblue; color:black; font-weight:bold; border-left: 1px solid white;}";
			echo "</style></head>";
			echo "<body>";
	
			echo "<div class=\"table_container\"><table>";
			echo "<tr><th style=\"padding-left:10px;\">Order #</th><th>Order Date</th><th>Status</th></tr>";
			foreach ($query_result as $row) {
				echo "<tr><td>" . $row->order_id . "</td><td>" . $row->transaction_date . "</td><td>" . $row->container_status . "</tr>";
			}
			echo "</table></div>";
			
		}
	}

?>

add_shortcode ( 'display_user_container_data', 'display_user_container_data' );