// Register waiting for response status
function register_waiting_status() {
    register_post_status( 'wc-waiting-for-response', array(
        'label'                     => 'Waiting for Response',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Waiting for Response (%s)', 'Waiting for Response (%s)' )
    ) );
}
add_action( 'init', 'register_waiting_status' );

// Add to list of WC Order statuses
function add_waiting_statuses( $order_statuses ) {
 
    $new_order_statuses = array();
 
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
 
        $new_order_statuses[ $key ] = $status;
 
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-waiting-for-response'] = 'Waiting for Response';
        }
    }
 
    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_waiting_statuses' );


// Register Preparing status
function register_preparing_status() {
    register_post_status( 'wc-preparing', array(
        'label'                     => 'Preparing',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Preparing (%s)', 'Preparing (%s)' )
    ) );
}
add_action( 'init', 'register_preparing_status' );

// Add to list of WC Order statuses
function add_preparing_statuses( $order_statuses ) {
 
    $new_order_statuses = array();
 
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
 
        $new_order_statuses[ $key ] = $status;
 
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-preparing'] = 'Preparing';
        }
    }
 
    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_preparing_statuses' );


// Register Ready status
function register_ready_status() {
    register_post_status( 'wc-ready-for-pickup', array(
        'label'                     => 'Ready for Pickup',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Ready for Pickup', 'Ready for Pickup' )
    ) );
}
add_action( 'init', 'register_ready_status' );

// Add to list of WC Order statuses
function add_ready_statuses( $order_statuses ) {
 
    $new_order_statuses = array();
 
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
 
        $new_order_statuses[ $key ] = $status;
 
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-ready-for-pickup'] = 'Ready for Pickup';
        }
    }
 
    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_ready_statuses' );


// Make "Waiting for Response" the default status
function change_default_order_status( $order_id ) {  
                if ( ! $order_id ) {return;}            
                $order = wc_get_order( $order_id );
                if( 'processing'== $order->get_status() ) {
                    $order->update_status( 'wc-waiting-for-response' );
                }
}
add_action('woocommerce_thankyou','change_default_order_status');