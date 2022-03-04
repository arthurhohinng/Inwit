# Frontend Documentation

All frontend pages were created using WordPress' Elementor plugin.

## Creating Pages
Each page in Elementor is composed of various blocks. Each block represents a different element
of the page such as headers, text or images. Blocks can be added to a page using the WordPress'
Elementor interactive page editor.

Elementor offers a large default library of blocks to choose from, though other plugins also offer
their own blocks. Blocks from the plugin WooCommerce was used alongside default Elementor blocks
to create default styles for pages in the application.

Blocks can be further customized through the Content, Style and Advanced tabs on the side of the
Elementor page editor. If the functionality of a given block is inadequate, the functionality
can be customized using shortcode. Shortcode allows a developer to manually define the behaviour
and appearance of a block using php and can be defined through a snippet.

Pages can be created through the `Pages` page in the WordPress admin view: `Pages > Add New Page`. To save progress for a page, please **save as default** and only **publish** when the page is finished.

## Shortcode
Shortcodes can be defined through snippets. The behaviour of a shortcode should be defined in a function that will be linked. The following piece of code defines the behaviour of a shortcode in the function :

```php
function my_shortcode() {
    ...
    $result = $get_row( $query );
    echo "<p>{$result->value}</p>";
}

add_shortcode( 'some_name', 'my_shortcode' );
```

Then in the Elementor page editor `[some_name]` can be input into a shortcode block on the page to activate the page editor.

Snippets can be defined through the `Snippets` page in the WordPress admin view: `Snippets > Add New`.

For more information on shortcodes, visit this [link](https://developer.wordpress.org/reference/functions/add_shortcode/).

## Linking Pages


Page URLs are created and linked together using the WordPress interface.