<?php

/**
 * Registers the `location`(Dispensary) post type.
 */
function location_init() {
	register_post_type(
		'location',
		[
			'labels'                => [
				'name'                  => __( 'Dispensaries', 'hi5' ),
				'singular_name'         => __( 'Dispensary', 'hi5' ),
				'all_items'             => __( 'All Dispensaries', 'hi5' ),
				'archives'              => __( 'Dispensary Archives', 'hi5' ),
				'attributes'            => __( 'Dispensary Attributes', 'hi5' ),
				'insert_into_item'      => __( 'Insert into Dispensary', 'hi5' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Dispensary', 'hi5' ),
				'featured_image'        => _x( 'Featured Image', 'location', 'hi5' ),
				'set_featured_image'    => _x( 'Set featured image', 'location', 'hi5' ),
				'remove_featured_image' => _x( 'Remove featured image', 'location', 'hi5' ),
				'use_featured_image'    => _x( 'Use as featured image', 'location', 'hi5' ),
				'filter_items_list'     => __( 'Filter Dispensaries list', 'hi5' ),
				'items_list_navigation' => __( 'Dispensaries list navigation', 'hi5' ),
				'items_list'            => __( 'Dispensaries list', 'hi5' ),
				'new_item'              => __( 'New Dispensary', 'hi5' ),
				'add_new'               => __( 'Add New Dispensary', 'hi5' ),
				'add_new_item'          => __( 'Add New Dispensary', 'hi5' ),
				'edit_item'             => __( 'Edit Dispensary', 'hi5' ),
				'view_item'             => __( 'View Dispensary', 'hi5' ),
				'view_items'            => __( 'View Dispensaries', 'hi5' ),
				'search_items'          => __( 'Search Dispensaries', 'hi5' ),
				'not_found'             => __( 'No Dispensaries found', 'hi5' ),
				'not_found_in_trash'    => __( 'No Dispensaries found in trash', 'hi5' ),
				'parent_item_colon'     => __( 'Parent Dispensary:', 'hi5' ),
				'menu_name'             => __( 'Dispensaries', 'hi5' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'location',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

}

add_action( 'init', 'location_init' );

/**
 * Sets the post updated messages for the `location` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `location` post type.
 */
function location_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['location'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Dispensary updated. <a target="_blank" href="%s">View Dispensary</a>', 'hi5' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'hi5' ),
		3  => __( 'Custom field deleted.', 'hi5' ),
		4  => __( 'Dispensary updated.', 'hi5' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Dispensary restored to revision from %s', 'hi5' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Dispensary published. <a href="%s">View Dispensary</a>', 'hi5' ), esc_url( $permalink ) ),
		7  => __( 'Dispensary saved.', 'hi5' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Dispensary submitted. <a target="_blank" href="%s">Preview Dispensary</a>', 'hi5' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Dispensary scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Dispensary</a>', 'hi5' ), date_i18n( __( 'M j, Y @ G:i', 'hi5' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Dispensary draft updated. <a target="_blank" href="%s">Preview Dispensary</a>', 'hi5' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'location_updated_messages' );

/**
 * Sets the bulk post updated messages for the `location` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `location` post type.
 */
function location_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['location'] = [
		/* translators: %s: Number of Locations. */
		'updated'   => _n( '%s Dispensary updated.', '%s Dispensaries updated.', $bulk_counts['updated'], 'hi5' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Dispensary not updated, somebody is editing it.', 'hi5' ) :
						/* translators: %s: Number of Dispensaries. */
						_n( '%s Dispensary not updated, somebody is editing it.', '%s Dispensaries not updated, somebody is editing them.', $bulk_counts['locked'], 'hi5' ),
		/* translators: %s: Number of Dispensaries. */
		'deleted'   => _n( '%s Dispensary permanently deleted.', '%s Dispensaries permanently deleted.', $bulk_counts['deleted'], 'hi5' ),
		/* translators: %s: Number of Dispensaries. */
		'trashed'   => _n( '%s Dispensary moved to the Trash.', '%s Dispensaries moved to the Trash.', $bulk_counts['trashed'], 'hi5' ),
		/* translators: %s: Number of Dispensaries. */
		'untrashed' => _n( '%s Dispensary restored from the Trash.', '%s Dispensaries restored from the Trash.', $bulk_counts['untrashed'], 'hi5' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'location_bulk_updated_messages', 10, 2 );
