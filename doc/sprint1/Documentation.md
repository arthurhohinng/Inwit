All code for features in the snippets plugin is stored as snippets of code. You can turn on and off any snippet you want with a click. 

Snippets: 

Separate WooCommerce Customer Registration: 
The code here uses the Woocommerce hook 'wc_reg_form_kiuloper' to allow customers to register through a form. It creates HTML and styling is done with default Woocommerce styling. It takes the email and password and sends a confirmation email on submission. 

Customized Empty Cart: 
This uses the Woocommerce hook woocommerce_cart_is_empty to modify how an empty list looks and Elementor can edit how it looks as well. 

Add a short description to Archive: 
This uses the Woocommerce hook 'woocommerce_after_shop_loop_item_title', to allow us to add a short description to products. 

Get user container count: 
This has a function that queries from MySQL for the current user, using their userID, and returns the count. It creates a shortcode that links to the function. 

Container Post Type: 
This has a function that allows you to make a custom post with the fields necessary to make a container. We then make a shortcode that links to that create container function. 

Add option for a restaurant to lend container/ pick up my empties in checkout page: 
This has the function "bbloomer_checkout_radio_choice" which uses the Woocommerce hooks to create a custom field in the checkout. It then assigns the price using the Woocommerce hook 'woocommerce_checkout_update_order_review' and calls that function we made for it. These both add the fee and calculate the total price and refreshes it using AJAX.

Display user_container_table: This has a function that queries MySQL from the container table and creates a table with HTML and styles it with CSS to show the table. 

Add user containers to an easy to view page: 
This has a function that queries MySQL from the container table and makes a shortcode that shows a list of the information of the container for a specific user. fetch_user_container_data: This has a function that queries MySQL from the container table for a specific user and adds a shortcode that calls that function. 

Add custom order statuses - "Waiting for Response", "Preparing", & "Ready for Pickup" + make waiting for the default: This calls Woocommerce hooks to add custom the statuses "Waiting for Response", "Preparing", & "Ready for Pickup". It also adds it as a possible status a store can choose. 

Container Manager - Get Container Status Count and Update Container Status: Helper functions to determine if a user is in possession of a container. Queries the database and creates multiple shortcodes to see whether they have them, how many of theirs are broken, lost, active.