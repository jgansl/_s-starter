<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
// function create_block_gutenpride_block_init() {
// 	register_block_type( __DIR__ . '/gutenpride/build' );
// }
// add_action( 'init', 'create_block_gutenpride_block_init' );

// function create_block_cropper_block_init() {
	// 	register_block_type( __DIR__ . '/cropper/build' );
	// }
	// add_action( 'init', 'create_block_cropper_block_init' );
	
add_action( 
	'init', 
	function(){
		foreach([
			'cropper',
			'gutenpride'
		] as $name)
		register_block_type( __DIR__ . "/$name/build" );
	}
);