<div class="" style="width:100%">
                <div class="dokan-panel dokan-panel-default">
                    <div class="dokan-panel-heading"><strong><?php esc_html_e( 'Containers for your order', 'dokan-lite' ); ?></strong></div>
                    <div class="dokan-panel-body" id="dokan-order-notes">
                        <?php 
                        $user = wp_get_current_user();
                        $container_statuses = array("Active", "Pending", "Lost", "Broken", "Purchased");
                        $query = $wpdb->prepare("SELECT * 
								FROM `Container` 
								WHERE `restaurant_id` = %d
								AND order_id = {$order_id}"
							, $user->ID );
		                $results = $wpdb->get_results($query);
		                echo '<table><thead><tr>';
		                echo '<th>'.'Container ID'.'</th>';
		                echo '<th>'.'Container Status'.'</th>';
		                echo '</tr></thead><tbody>';
		                foreach($results as $val) {
			                echo '<tr>';
			                echo '<td>' . $val->container_id . '</td>';
			                echo '<td>' . $container_statuses[$val->container_status] . '</td>';
			                echo '</tr>';
		                }
		                echo '</tbody></table>';
                        ?>
                    </div>
                </div>
        </div>
