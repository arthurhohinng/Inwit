<?php
add_action( 'woocommerce_checkout_after_customer_details', 'custom_tip');

function custom_tip() {
	$args1 = array(
		'type' => 'number',
		'placeholder' => 'Enter any amount in $...');
	$args2 = array(
	'type' => 'number',
	'placeholder' => 'Enter any percentage...');
	
	echo '<div id="custom-tip">';
	echo '<span>Enter a number in the first box to tip a percent of the total</span><br>';
	echo '<span>Enter a number in the second box to tip a percent of the total</span>';
    	echo '<h3>Enter Custom Tip </h3>';
	woocommerce_form_field( 'amount', $args1, WC()->checkout->get_value('amount'));
	woocommerce_form_field( 'percent', $args2, WC()->checkout->get_value('percent'));
	echo '</div>';
}

add_action( 'woocommerce_cart_calculate_fees', 'custom_tip_fee_amount');

function custom_tip_fee_amount($cart) {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) || ! is_checkout() ) return;
	$total_sum_tip = WC()->session->get( 'nominal_tip' );
	$price        = 5;
	if ( ! empty( $thegoodplugin_amount ) ) {
		$price = $thegoodplugin_amount;
	}
	if ($total_sum_tip) {
		// add fee to cart
		$cart->add_fee( $thegoodplugin_button_text, + ( WC()->checkout->get_value('amount') * $price) );
	}
}

add_action( 'woocommerce_cart_calculate_fees', 'custom_tip_fee_percent');

function custom_tip_fee_percent($cart) {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) || ! is_checkout() ) return;
	$total_sum_tip = WC()->session->get( 'nominal_tip' );
	if ($total_sum_tip) {
		// add fee to cart
		$cart->add_fee( $thegoodplugin_button_text, + ( WC()->checkout->get_value('percent') ) );
	}
}

add_action( 'woocommerce_checkout_update_order_review', 'custom_tip_set_session');

function custom_tip_set_session($posted_data) {
	parse_str( $posted_data, $output );
	if ( isset( $output['amount'] ) ){
			WC()->session->set( 'amount', $output['amount'] );
	}
}
?>
