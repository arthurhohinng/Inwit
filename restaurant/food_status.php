// Part 1 
// Display Radio Buttons
  
add_action( 'woocommerce_review_order_before_payment', 'bbloomer_checkout_radio_choice' );
  
function bbloomer_checkout_radio_choice() {
     
   $chosen = WC()->session->get( 'radio_chosen' );
   $chosen = empty( $chosen ) ? WC()->checkout->get_value( 'radio_choice' ) : $chosen;
   $chosen = empty( $chosen ) ? '0' : $chosen;
        
   $args = array(
   'type' => 'radio',
   'class' => array( 'form-row-wide', 'update_totals_on_change' ),
   'options' => array(
      '0' => 'I will return the containers',
      '5' => 'Pick up my empties ($5)',
   ),
   'default' => $chosen
   );
     
   echo '<div id="checkout-radio">';
   echo '<h3>Container Return</h3>';
   woocommerce_form_field( 'radio_choice', $args, $chosen );
   echo '</div>';
     
}
  
// Part 2 
// Add Fee and Calculate Total
   
add_action( 'woocommerce_cart_calculate_fees', 'bbloomer_checkout_radio_choice_fee', 20, 1 );
  
function bbloomer_checkout_radio_choice_fee( $cart ) {
   
   if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    
   $radio = WC()->session->get( 'radio_chosen' );
     
   if ( $radio ) {
      $cart->add_fee( 'Pickup Fee', $radio );
   }
   
}
  
// Part 3 
// Add Radio Choice to Session
  