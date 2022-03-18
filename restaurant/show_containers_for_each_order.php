add_shortcode('display_containers_associated_with_all_orders', 'display_containers_associated_with_all_orders');
// this function is for the restaurant view
function display_containers_associated_with_all_orders(){
	global $wpdb;
	
	if ( is_user_logged_in() ){
		$user = wp_get_current_user();
		$query = $wpdb->prepare("SELECT * 
								FROM `Container` 
								WHERE `container_status` = 1
								AND `restaurant_id` = %d"
							, $user->ID );
		$results = $wpdb->get_results($query);
		echo "<div> Containers for your orders </div>";
		foreach($results as $val) {
			echo "<div> Container ID: " . $val->container_id . "</div>";
			echo "<div> Order #" . strval( $val->order_id ) . "</div>";
		}
	}
}
