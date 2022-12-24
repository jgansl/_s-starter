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
	
	foreach([ //TODO autogenerate field group for new blocks
		'article-slider',
		'about-overview',
		'about-press',
		'best-sellers',
		'drink-description',
		'drink-properties',
		'drink-reviews',
		'drink-slider',
		'drink-weed',
		'drinks-content',
		'email-subscription',
		'faqs',
		'faqs-live-chat',
		'featured-grid',
		'hero',
		'home-fast-acting',
		'home-hero',
		'instagram',
		'join',
		'shop-map-locations',
		'shop-near-me',
		'shop-search'
	] as $label) {
		acf_register_block([ //TODO
			'name'			=> $label,
			'title'			=> implode(' ', array_map(function($w) {return ucfirst($w);}, explode('-', $label))),
			'render_template'	=> "blocks/$label.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'mode'			=> 'edit',
			'keywords'		=> [$label, 'hi5'],
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
				'name'         => 'bg-blue-wave',
				'label'        => __('Blue Wave Background', 'textdomain'),
				'is_default'   => false,
				'inline_style' => '.wp-block-group.is-style-blue-wave',
			)
		);
	}
}
add_action('acf/init', 'theme_register_blocks_style');
