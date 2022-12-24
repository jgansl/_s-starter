<?php

/**
 * Registers the `location_type` taxonomy,
 * for use with 'location'.
 */
function location_type_init() {
	register_taxonomy( 'location_type', [ 'location' ], [
		'hierarchical'          => true,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'query_var'             => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __( 'Dispensary Types', 'hi5' ),
			'singular_name'              => _x( 'Dispensary type', 'taxonomy general name', 'hi5' ),
			'search_items'               => __( 'Search Dispensary Types', 'hi5' ),
			'popular_items'              => __( 'Popular Dispensary Types', 'hi5' ),
			'all_items'                  => __( 'All Dispensary Types', 'hi5' ),
			'parent_item'                => __( 'Parent Dispensary type', 'hi5' ),
			'parent_item_colon'          => __( 'Parent Dispensary type:', 'hi5' ),
			'edit_item'                  => __( 'Edit Dispensary type', 'hi5' ),
			'update_item'                => __( 'Update Dispensary type', 'hi5' ),
			'view_item'                  => __( 'View Dispensary type', 'hi5' ),
			'add_new_item'               => __( 'Add New Dispensary type', 'hi5' ),
			'new_item_name'              => __( 'New Dispensary type', 'hi5' ),
			'separate_items_with_commas' => __( 'Separate dispensary Types with commas', 'hi5' ),
			'add_or_remove_items'        => __( 'Add or remove dispensary Types', 'hi5' ),
			'choose_from_most_used'      => __( 'Choose from the most used dispensary Types', 'hi5' ),
			'not_found'                  => __( 'No dispensary Types found.', 'hi5' ),
			'no_terms'                   => __( 'No dispensary Types', 'hi5' ),
			'menu_name'                  => __( 'Dispensary Types', 'hi5' ),
			'items_list_navigation'      => __( 'Dispensary Types list navigation', 'hi5' ),
			'items_list'                 => __( 'Dispensary Types list', 'hi5' ),
			'most_used'                  => _x( 'Most Used', 'location_type', 'hi5' ),
			'back_to_items'              => __( '&larr; Back to Dispensary Types', 'hi5' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'location_type',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'location_type_init' );

/**
 * Sets the post updated messages for the `location_type` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `location_type` taxonomy.
 */
function location_type_updated_messages( $messages ) {

	$messages['location_type'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Dispensary type added.', 'hi5' ),
		2 => __( 'Dispensary type deleted.', 'hi5' ),
		3 => __( 'Dispensary type updated.', 'hi5' ),
		4 => __( 'Dispensary type not added.', 'hi5' ),
		5 => __( 'Dispensary type not updated.', 'hi5' ),
		6 => __( 'Dispensary types deleted.', 'hi5' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'location_type_updated_messages' );
