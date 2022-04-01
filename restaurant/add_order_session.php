
<?php
# Add session associated with order_id for when user clicks the scan button
function add_order_session(){

	// Start the session
	session_start();
	// Set the current session order to our current order
	$url_components = parse_url($_SERVER);
	parse_str($url_components['query'], $params);
	
	$_SESSION["curr_order"] = $params['order_id'];
	
	
}

add_shortcode ( 'add_order_session', 'add_order_session' );

?>
