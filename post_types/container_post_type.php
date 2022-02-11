<php?

/**
 * Creates a custom post type called Container.
 */
function create_post_type_container() {
	$args = array(
		'labels' => array(
			'name' => __( 'Containers' ),
			'singular_name' => __( 'Container' )
		),
		'description' => 'For managing containers',
		'public' => true,
		'menu_position' => 56,
		'menu_icon' => 'dashicons-archive'
	);
	register_post_type( 'container', $args);
}

add_action( 'init', 'create_post_type_container' );