<?php

/**
 * Maps order statuses to numbers.
 * Each number represents a stage of progression in the order lifecycle.
 */
function map_order_status( $order_status ) {
    switch ( $order_status ) {
        case "wc-pending":
            return 1;
        case "wc-processing":
            return 1;
        case "wc-confirmed":
            return 2;
        case "wc-shipped":
            return 3;
        case "wc-pickup":
            return 4;
        case "wc-completed":
            return 5;
        case "wc-on-hold":
            return 0;
        case "wc-cancelled":
            return -1;
        case "wc-refunded":
            return -1;
        case "wc-failed":
            return -1;
        default:
            return 0;
    }
}

/**
 * Checks whether the order has reached a certain stage of progress or not.
 */
function reached_stage( $curr_status, $check_stage ) {
    return map_order_status( $curr_status ) >= map_order_status( $check_stage );
}

function get_progression_div( $curr_status, $check_stage ) {
	if ( reached_stage($curr_status, $check_stage) ) {
		return "<div class='circle filled'></div>";
	} else {
		return "<div class='circle empty'></div>";
	}
}

/**
 * Returns the order id within the URL.
 */
function get_order_id() {
	global $wp;
	
	$path = explode( home_url( $wp->request ), "/" );
	return $path[count($path)-1];
}

/**
 * Displays the number and total cost of the order.
 */
function display_info( $order_id, $order_total ) {
	echo "<div class='order-info'><p class='info-p bold'>YOUR ORDER NUMBER:  <span class='green'>#{$order_id}</span></p><p class='info-p bold'>ORDER TOTAL:  <span class='green'>\${$order_total}</span></p></div>";
}

/**
 * Displays the progression of the order for the user.
 */
function display_progression( $status ) {
	$display = "<ul>";
	$display .= "<li><div class='li-left'>" . get_progression_div($status, "wc-completed") . "</div><div class='li-right'><p class='bold li-text'>Food Delivered</p><p class='li-text'>Delivered on 21/01/2022</p></div></li>";
	$display .= "<li><div class='li-left'>" . get_progression_div($status, "wc-pickup") . "</div><div class='li-right'><p class='bold li-text'>Awaiting Pickup</p><p class='li-text'>We are waiting for you to pickup</p></div></li>";
	$display .= "<li><div class='li-left'>" . get_progression_div($status, "wc-shipped") . "</div><div class='li-right'><p class='bold li-text'>Food On The Way</p><p class='li-text'>Food is now being delivered</p></div></li>";
	$display .= "<li><div class='li-left'>" . get_progression_div($status, "wc-confirmed") . "</div><div class='li-right'><p class='bold li-text'>Confirmed</p><p class='li-text'>Your order has been confirmed</p></div></li>";
	$display .= "<li><div class='li-left'>" . get_progression_div($status, "wc-processing") . "</div><div class='li-right'><p class='bold li-text'>Order Placed</p><p class='li-text'>We have received your order</p></div></li>";
	$display .= "</ul>";
	echo $display;
}

function display_order_progression_page() {
	global $wpdb;
    
    if ( is_user_logged_in() && isset( $_GET["id"] ) ) {
		$user = wp_get_current_user();
		$order_id = $_GET["id"];

		$query = $wpdb->prepare("SELECT *
									FROM `wpar_dokan_orders`
									WHERE `order_id` = %d"
								, $order_id);
		$result = $wpdb->get_row( $query );
		$id = is_null($order_id) ? "-" : $order_id;
		$total = is_null($result->order_total) ? "-" : number_format($result->order_total, 2);
		$status = is_null($result->order_status) ? "" : $result->order_status;

		echo "<div class='order-progression-body'>";
		display_info( $id, $total );
		display_progression( $status );
		echo "</div>";
	}
}

/**
 * Add a button to the View Order page that leads to the Track Order page
 */
function add_view_progression_button($order) {
	echo "<form action='https://beta.inwit.app/my-account/track-order/' method='GET'><input type='hidden' name='id' value='2'><input type='submit' value='Track Order'/></form>";
}
add_action("woocommerce_order_details_after_customer_details", "add_view_progression_button");


add_shortcode( 'display_order_progression', 'display_order_progression_page' );