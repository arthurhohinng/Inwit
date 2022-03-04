<?php
function custom_tip() {
	$args = array(
	'type' => 'number');
	
	echo '<div id="custom-tip">';
	echo '<span>Enter a number in the first box to tip a percent of the total</span><br>';
	echo '<span>Enter a number in the second box to tip any amount in dollars</span>';
    echo '<h3>Enter Custom Tip </h3>';
	woocommerce_form_field( 'amount', $args, WC()->checkout->get_value('amount'));
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
