

# **Backend Documentation**

All code for the features are stored as snippets of code. You can turn on and off any snippet you want with a click. This can be accessed via the method outlined in the README.md.


# **Snippets**


## display_user_container_table.php: 

This function queries the MySQL database, to extract the container information: order_id, transacation_date, and container_status. Also calculates the days remaining the user client has left to return the container by, otherwise they have to pay a fee. All the information is created in a table with HTML and styled with CSS to show the table. Orders can be clicked on this page, and the page will be redirected to a detailed order status page. Pending containers also link to view more options that call get_specific_container_details.php.


## option_to_pick_up_empties.php:

This has "bbloomer_checkout_radio_choice" which is a Woocommerce hook to create a custom field in the checkout. It then assigns the price using the Woocommerce hook 'woocommerce_checkout_update_order_review' and calls that function we made for it to pass in the price. These both add the fee and calculate the total price and refreshes it using AJAX.


## get_specific_container_details.php:

This snippet gets the container details with id=&lt;container_id> passed in url. It checks for whether “id” is passed into the url and if it is, and the container is owned by the user, then container details show up on the container page. The shown details allows for users to select whether they want to buy a container or have someone pickup the container.


## display_order_progression.php:

This snippet retrieves the status of an order from the database. The status of an order can be one of: wc-pending, wc-processing, wc-confirmed, wc-shipped, wc-pickup, wc-completed, wc-on-hold, wc-cancelled, wc-refunded, wc-failed. Certain stages are checked so that the frontend can display the progress for the user: processing, confirmed, shipped, pickup, completed. For example, if an order is at “wc-shipped”, all stages processing to shipped would be checked as met.


## custom_tips.php:

This snippet allows a user to enter a custom amount for a tip, either in the form of any amount in dollars, or a percent of the total price. It uses the Woocommerce hook woocommerce_form_field to add a field to enter a number for the tip amount, and then adds the two amounts into the cart for the total fee. Then, to update the checkout page to show these changes, it sets the amount field in the session to the actual tip amount entered by the user.


## container_manager.php

This snippet shows the counts of containers that are active, pending, lost, and broken corresponding to the status ids of 0, 1, 2, 3 respectively from the database. This snippet also sets the status of a given container to a provided status id in the database. 


## user_container_count.php:

This is a snippet that queries the MySQL database for the current user using their userID and then matches all containers that are being held by the user with userID. The number of containers matched is returned. 


## food_status.php: 

This calls Woocommerce hooks to add custom statuses: "Waiting for Response", "Accepted", “Declined”, and "Ready for Pickup" as an option stores can select for an order. Then add_action( 'init', 'register_waiting_status') is used to add it as an action so it initializes. Then add_filter( 'wc_order_statuses', 'add_register_waiting_statuses' ) is used to add it to the order statuses. This is done for every new status. Then add_action('woocommerce_thankyou', 'change_default_order_status') is used to change the default status.
