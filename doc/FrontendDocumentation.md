# Frontend Documentation

This document contains documentation for the frontend of this project, along with instructions for contribution. All frontend pages were created using WordPress' Elementor plugin.

## Creating Pages
Each page in Elementor is composed of various blocks. Each block represents a different element of the page such as headers, text or images. Blocks can be added to a page using the WordPress' Elementor interactive page editor.

Elementor offers a large default library of blocks to choose from, though other plugins also offer their own blocks. Blocks from the plugin WooCommerce were used alongside default Elementor blocks to create styles for pages in the application.

Blocks can be further customized through the Content, Style and Advanced tabs on the side of the Elementor page editor. If the provided customization is inadequate, blocks can be further customized using shortcode. Shortcode allows a developer to manually define the behaviour and appearance of a block and can be defined through a snippet.

Pages can be created through the `Pages` page in the WordPress admin view: `Pages > Add New Page`. To save progress for a page, please **save as default** and only **publish** when the page is finished.

## Shortcode
Shortcode can be defined through Snippets. The behaviour of a shortcode should be defined in a function within the Snippet. The following piece of code defines the behaviour of a shortcode called *my_shortcode* in the function `my_shortcode_function()`:

```php
function my_shortcode_function() {
    ...
    $result = $get_row( $query );
    echo "<p>{$result->value}</p>";
}

add_shortcode( 'my_shortcode', 'my_shortcode_function' );
```

Then in the Elementor page editor `[my_shortcode]` can be input into a shortcode block on the page. The shortcode will be activated when the page is loaded.

Snippets can be defined through the `Snippets` page in the WordPress admin view: `Snippets > Add New`.

For more information on shortcodes, visit this [link](https://developer.wordpress.org/reference/functions/add_shortcode/).

## Linking Pages


Page URLs are created and linked together using the WordPress interface.