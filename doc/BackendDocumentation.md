# **Backend Documentation**

All code for the features are stored as snippets of code. You can turn on and off any snippet you want with a click. This can be accessed via the method outlined in the README.md.


# **Snippets**


## display_user_container_table.php: 

This function queries the MySQL database, to extract the container information: order_id, transacation_date, and container_status. Also calculates the days remaining the user client has left to return the container by, otherwise they have to pay a fee. All the information is created in a table with HTML and styled with CSS to show the table. Orders can be clicked on this page, and the page will be redirected to a detailed order status page. Pending containers also link to view more options that call get_specific_container_details.php. A maximum of 10 containers are displayed per page.


## option_to_pick_up_empties.php:

This has "bbloomer_checkout_radio_choice" which is a Woocommerce hook to create a custom field in the checkout. It then assigns the price using the Woocommerce hook 'woocommerce_checkout_update_order_review' and calls that function we made for it to pass in the price. These both add the fee and calculate the total price and refreshes it using AJAX.


## get_specific_container_details.php:

This snippet gets the container details with id=&lt;container_id> passed in url. It checks for whether “id” is passed into the url and if it is, and the container is owned by the user, then container details show up on the container page. The shown details allows for users to select whether they want to buy a container or have someone pickup the container. In addition to the functionality, we now added a dropdown that allows customers to see where to return their pending containers. The product owner told us that all pending containers get returned to the same location, which is reflected on the website.


## display_order_progression.php:

This snippet retrieves the status of an order from the database. The status of an order can be one of: wc-pending, wc-processing, wc-confirmed, wc-shipped, wc-pickup, wc-completed, wc-on-hold, wc-canceled, wc-refunded, wc-failed. Certain stages are checked so that the frontend can display the progress for the user: processing, confirmed, shipped, pickup, completed. For example, if an order is at “wc-shipped”, all stages processing to shipped would be checked as met.


## custom_tips.php:

This snippet allows a user to enter a custom amount for a tip, either in the form of any amount in dollars, or a percent of the total price. It uses the Woocommerce hook woocommerce_form_field to add a field to enter a number for the tip amount, and then adds the two amounts into the cart for the total fee. Then, to update the checkout page to show these changes, it sets the amount field in the session to the actual tip amount entered by the user.


## container_manager.php

This snippet shows the counts of containers that are active, pending, lost, and broken corresponding to the status ids of 0, 1, 2, 3 respectively from the database. This snippet also sets the status of a given container to a provided status id in the database. 


## user_container_count.php:

This is a snippet that queries the MySQL database for the current user using their userID and then matches all containers that are being held by the user with userID. The number of containers matched is returned. 


## food_status.php: 

This calls Woocommerce hooks to add custom statuses: "Waiting for Response", "Accepted", “Declined”, and "Ready for Pickup" as an option stores can select for an order. Then add_action( 'init', 'register_waiting_status') is used to add it as an action so it initializes. Then add_filter( 'wc_order_statuses', 'add_register_waiting_statuses' ) is used to add it to the order statuses. This is done for every new status. Then add_action('woocommerce_thankyou', 'change_default_order_status') is used to change the default status.


## assign_container.php: 

This function is called when the container is scanned to an order. It updates the container and assigns the order id, the recipient, the container status, and the transaction date. The function uses a helper function get_customer_id_by_order_id which takes an order id and returns the customer id for that order. The helper function uses wc_get_order which is a Woocommerce function that takes an order_id and returns the row with order_id.


## accept_container.php: 

This function is called when the container is scanned after clicking the accept containers button in the restaurant status view. It authenticates the user and updates the container status, and the transaction date and sets the recepient_id to null and order_id to null. It also sends an email to the restaurant owner. 


## container_list_table.php: 

This creates a table in the WordPress admin view for the Container table. The table is located in the page for managing Container post types. Also replaces numeric values for restaurant ID and recipient ID with the restaurant’s name and the recipient username, respectively (retrieved from the database). Enables sorting by restaurant ID and date.


## manage_container.php: 

This allows an admin to add, edit or delete containers through the WordPress interface. Hover over an entry in the table click “Add New”, “Edit” and “Delete” to go to the page for the corresponding action. Edit the fields in the form and press update to perform the action.


## edit_order_status.php: 

This modifies the original order details page for the dokan plugin. The templates/orders/details.php file is overwritten in the child theme. I removed the &lt;select> tag and replaced the inner &lt;option> tags with &lt;button> tags and applied flexbox and margin styling.


## impact_points_table.php: 

This shows the impact point each user has received based on their orders. It calls wp_get_current_user()->ID to get the current user’s ID, then queries the container history table to show their history and impact points.


## scan_container_option.php: 

This modifies the original order details page for the dokan plugin. The templates/orders/details.php file is overwritten in the child theme. I added a &lt;button> tag in the general details tab that on selection launches the camera to scan the container.


## show_containers_for_each_order.php: 

This allows the restaurant to view all the containers associated with each order. This uses a dokan-panel class (part of the Dokan plugin) to create a box. We then retrieve all containers associated with the order and restaurant user, and then display those containers with their statuses, in a table inside that box. Previously, this information was not available to the restaurant page, and has also been updated for the restaurant to view.


## add_order_session.php: 

This function stores the current order page’s order_id in a session. This is later used to associate a container id to it, when our Inwit tablet scans a container’s NFC tag to use it. 


## update_purchased_containers.php

This function update the Inwit container database to update the container status to reflect that a customer has purchased it.


## cfwc_add_custom_data_order.php

This allows products to add a custom container_id fields, which allows for differentiation between containers in different product pages. 
