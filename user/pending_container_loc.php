function get_user_container_details(){
	global $wpdb;
	
	if ( is_user_logged_in() ){
		if ( isset( $_GET["id"] ) ){
			$container_id = $_GET["id"];
			$user = wp_get_current_user();
			$query = $wpdb->prepare("SELECT * 
									FROM `Container` 
									WHERE `container_id` = %d
									AND `recipient_id` = %d
									AND `container_status` = 1"
								, array( $container_id, $user->ID ));
			$result = $wpdb->get_row($query);
			if ( count( $result ) > 0 ){
				echo "<div> Container ID: " . $container_id . "</div>";
				echo "<div> Container Status: " . strval($result->container_status) . "</div>";
				echo "<div> Order #" . strval( $result->order_id ) . "</div>";

				// You can return containers to any of Inwit's participating restaurants
				echo "<br>";
				
				echo "<details>
				<summary style=\"list-style-type: disc\">Where do I return my container?</summary>
				<p>After you’ve enjoyed your meal, out of courtesy for the restaurant, we ask that you give the container a good rinse (please make sure there is no food left in it). 



Then, simply place the rinsed containers into a Contactless Return Station at any participating location. Your account will be adjusted once they are sanitized and placed back in circulation (within 24 hours). Please do not hand our containers to restaurant staff or leave them on the counter. We rely on all parties to ensure a contactless experience for all 🙂 </p>
				</details>";
					
				// Product id of buy container == 1342
				echo "<a href='/cart/?add-to-cart=1342&quantity=1&container_id=$container_id'>
						<button>Buy Container</button>
					  </a>";
				// Product id of pickup container == 1341
				echo "<a href='/cart/?add-to-cart=1341&quantity=1'>
						<button>Pickup Container</button>
					  </a>";
			}
			
		}
		
	}
}

add_shortcode ( 'get_user_container_details', 'get_user_container_details' );
