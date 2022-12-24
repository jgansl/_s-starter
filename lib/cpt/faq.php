<?php

/**
 * Registers the `faq` post type.
 */
function faq_init() {
	register_post_type(
		'faq',
		[
			'labels'                => [
				'name'                  => __( 'FAQs', 'hi5' ),
				'singular_name'         => __( 'FAQ', 'hi5' ),
				'all_items'             => __( 'All FAQs', 'hi5' ),
				'archives'              => __( 'FAQ Archives', 'hi5' ),
				'attributes'            => __( 'FAQ Attributes', 'hi5' ),
				'insert_into_item'      => __( 'Insert into FAQ', 'hi5' ),
				'uploaded_to_this_item' => __( 'Uploaded to this FAQ', 'hi5' ),
				'featured_image'        => _x( 'Featured Image', 'faq', 'hi5' ),
				'set_featured_image'    => _x( 'Set featured image', 'faq', 'hi5' ),
				'remove_featured_image' => _x( 'Remove featured image', 'faq', 'hi5' ),
				'use_featured_image'    => _x( 'Use as featured image', 'faq', 'hi5' ),
				'filter_items_list'     => __( 'Filter FAQs list', 'hi5' ),
				'items_list_navigation' => __( 'FAQs list navigation', 'hi5' ),
				'items_list'            => __( 'FAQs list', 'hi5' ),
				'new_item'              => __( 'New FAQ', 'hi5' ),
				'add_new'               => __( 'Add New', 'hi5' ),
				'add_new_item'          => __( 'Add New FAQ', 'hi5' ),
				'edit_item'             => __( 'Edit FAQ', 'hi5' ),
				'view_item'             => __( 'View FAQ', 'hi5' ),
				'view_items'            => __( 'View FAQs', 'hi5' ),
				'search_items'          => __( 'Search FAQs', 'hi5' ),
				'not_found'             => __( 'No FAQs found', 'hi5' ),
				'not_found_in_trash'    => __( 'No FAQs found in trash', 'hi5' ),
				'parent_item_colon'     => __( 'Parent FAQ:', 'hi5' ),
				'menu_name'             => __( 'FAQs', 'hi5' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor' ],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'faq',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

}

add_action( 'init', 'faq_init' );

/**
 * Sets the post updated messages for the `faq` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `faq` post type.
 */
function faq_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['faq'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'FAQ updated. <a target="_blank" href="%s">View FAQ</a>', 'hi5' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'hi5' ),
		3  => __( 'Custom field deleted.', 'hi5' ),
		4  => __( 'FAQ updated.', 'hi5' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'FAQ restored to revision from %s', 'hi5' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'FAQ published. <a href="%s">View FAQ</a>', 'hi5' ), esc_url( $permalink ) ),
		7  => __( 'FAQ saved.', 'hi5' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'FAQ submitted. <a target="_blank" href="%s">Preview FAQ</a>', 'hi5' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'FAQ scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>', 'hi5' ), date_i18n( __( 'M j, Y @ G:i', 'hi5' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'FAQ draft updated. <a target="_blank" href="%s">Preview FAQ</a>', 'hi5' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'faq_updated_messages' );

/**
 * Sets the bulk post updated messages for the `faq` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `faq` post type.
 */
function faq_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['faq'] = [
		/* translators: %s: Number of FAQs. */
		'updated'   => _n( '%s FAQ updated.', '%s FAQs updated.', $bulk_counts['updated'], 'hi5' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 FAQ not updated, somebody is editing it.', 'hi5' ) :
						/* translators: %s: Number of FAQs. */
						_n( '%s FAQ not updated, somebody is editing it.', '%s FAQs not updated, somebody is editing them.', $bulk_counts['locked'], 'hi5' ),
		/* translators: %s: Number of FAQs. */
		'deleted'   => _n( '%s FAQ permanently deleted.', '%s FAQs permanently deleted.', $bulk_counts['deleted'], 'hi5' ),
		/* translators: %s: Number of FAQs. */
		'trashed'   => _n( '%s FAQ moved to the Trash.', '%s FAQs moved to the Trash.', $bulk_counts['trashed'], 'hi5' ),
		/* translators: %s: Number of FAQs. */
		'untrashed' => _n( '%s FAQ restored from the Trash.', '%s FAQs restored from the Trash.', $bulk_counts['untrashed'], 'hi5' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'faq_bulk_updated_messages', 10, 2 );
