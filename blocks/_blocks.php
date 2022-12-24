<?php

// Block categories
add_filter('block_categories_all', function ($categories, $post) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'theme-blocks',
				'title' => 'Theme Blocks',
			),
		)
	);
}, 10, 2);

add_action('acf/init', 'theme_register_blocks');
function theme_register_blocks()
{
	if (!function_exists('acf_register_block')) {
		return;
	}
	
	foreach([
		'page-hero',
	] as $label) {
		error_log(json_encode($label, JSON_PRETTY_PRINT));//debug
		acf_register_block([ //TODO
			'name'			=> $label,
			'title'			=> implode(' ', array_map(function($w) {return ucfirst($w);}, explode('-', $label))),
			'render_template'	=> "blocks/$label.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'mode'			=> 'edit',
			'keywords'		=> array_merge(explode('-', $label), explode("-", TEXTDOMAIN)),
			'supports' => ['align' => false],
		]);
	}
}


function theme_register_blocks_style()
{
	if (function_exists('register_block_style')) {
		register_block_style(
			'core/group',
			array(
				'name'         => 'bg-colored',
				'label'        => __('Colored Background', TEXTDOMAIN),
				// 'is_default'   => false,
				// 'inline_style' => '.wp-block-group.is-style-bg-colored',
			)
		);
		register_block_style( 'core/heading',array('name'=> 'title-is-1','label'=>__('Size 1', TEXTDOMAIN), ) );
		register_block_style( 'core/heading',array('name'=> 'title-is-2','label'=>__('Size 2', TEXTDOMAIN), ) );
		register_block_style( 'core/heading',array('name'=> 'title-is-3','label'=>__('Size 3', TEXTDOMAIN), ) );
		register_block_style( 'core/heading',array('name'=> 'title-is-4','label'=>__('Size 4', TEXTDOMAIN), ) );
		register_block_style( 'core/heading',array('name'=> 'title-is-5','label'=>__('Size 5', TEXTDOMAIN), ) );
		register_block_style( 'core/heading',array('name'=> 'title-is-6','label'=>__('Size 6', TEXTDOMAIN), ) );
	}
}
add_action('acf/init', 'theme_register_blocks_style');
