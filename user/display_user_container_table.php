<?php
function display_user_container_table(){
	global $wpdb;
	$container_statuses = array("Active", "Pending", "Lost", "Broken", "Purchased");
		if (isset($_GET['pg'])) {
			$page = $_GET['pg'];
			}
		else {
			$page = 1;
		}
		if ( is_user_logged_in() ){
			
			
			$num_per_page = 7;
			$start_from = ($page - 1) * $num_per_page;
			
			
			$user = wp_get_current_user();
			$query = $wpdb->prepare("SELECT * 
										FROM `Container` 
										WHERE `recipient_id` = %d 
										ORDER BY `transaction_date` DESC 
										LIMIT $start_from, $num_per_page"
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
						<div class='date'>Days Left to Return: ". max(0, 7 - floor((strtotime(date('Y-m-d H:i:s')) - strtotime($row->transaction_date)) / 86400)) . "</div>
					</div>
					<div class='right'>
						<div class='status' style='text-align: right'>" . $container_statuses[$row->container_status] . "</div>";
				// If container status is pending show link to get container details
				// Assuming 1 == pending
				if ( $row->container_status == 1 ){
					echo "<a href='./?id=$row->container_id'> View Options </a>";
				}
					echo "</div>
				</div>";
			}
			
			
			$query = $wpdb->prepare("SELECT COUNT(*) AS num_rows 
										FROM `Container` 
										WHERE `recipient_id` = %d", $user->id);
			$num_rows = ($wpdb->get_row( $query))->num_rows;
			$total_page = ceil($num_rows/$num_per_page);
			$prev_page = $page - 1;
			$next_page = $page + 1;
			
			if($page>1) {
				
				echo "<a href='./?pg=$prev_page'> Previous </a>";
			}
			
			if ($page < $total_page) {
				echo "<a href='./?pg=$next_page'> Next </a>";
			}
			
		}
	}
