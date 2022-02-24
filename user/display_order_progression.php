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
function check_progression( $stage, $order_id ) {
    $order_value = map_order_status( $order_id )

    if $stage == "placed":
        return ($order_value >= 1) ? True : False;
    else if $stage == "confirmed":
        return ($order_value >= 2) ? True : False;
    else if $stage == "shipped":
        return ($order_value >= 3) ? True: False;
    else if $stage == "pickup":
        return ($order_value >= 4) ? True: False;
    else if $stage == "complete":
        return ($order_value >= 5) ? True: False;
    else:
        return False;
}

/**
 * Displays a page containing the progression of an order.
 * (order placed -> confirmed -> on the way -> pickup -> delivered)
 */
function display_order_progression( $order_id ) {
    global $wpdb;
    
    if ( is_user_logged_in() ){
            
        $user = wp_get_current_user();

        $query = $wpdb->prepare("SELECT *
                                    FROM 'wpar_dokan_orders'
                                    WHERE 'order_id' = %d"
                                , $order_id);
        $order = $wpdb->get_results( $query );

        $order_info = "<div>YOUR ORDER NUMBER: <span>#" . $order_id . "</span></div><div>ORDER TOTAL: <span>$" . $order->order_total . "</span></div>"

        $order_placed = "<li><p>Order Placed</p><p>" . var_export(check_progression("placed", $order->order_status), true) ."</p></li>"
        $confirmed = "<li><p>Confirmed</p><p>" . var_export(check_progression("confirmed", $order->order_status), true) ."</p></li>"
        $on_the_way = "<li><p>Food On The Way</p><p>" . var_export(check_progression("shipped", $order->order_status), true) ."</p></li>"
        $pickup = "<li><p>Awaiting Pickup</p><p>" . var_export(check_progression("pickup", $order->order_status), true) ."</p></li>"
        $delivered = "<li><p>Food Delivered</p><p>" . var_export(check_progression("complete", $order->order_status), true) ."</p></li>"
        
        echo $order_info . "<div><ul>". $order_placed . $confirmed . $on_the_way . $pickup . $delivered . "</ul></div>" . "<button>Go back</button>"
    }
}



add_shortcode ( 'display_order_progression', 'display_order_progression' );