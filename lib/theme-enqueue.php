<?php
/**
 * Enqueue all styles and scripts
 */

function theme_scripts() {
	$theme = wp_get_theme();
	$theme_uri = get_template_directory_uri();

	wp_deregister_script( 'wp-embed' );

	// Deregister the jquery version bundled with WordPress.
	wp_dequeue_script( 'jquery' );
	wp_deregister_script( 'jquery' );

	//register jquery - 
	//mobile menu on everypage
	wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, true );
	if(
		is_page(10) || //home
		is_page(22) || //about
		// is_page(23) || //drinks 
		// is_tax('drink_family', 12) || //soda
		// is_tax('drink_family', 13) || //seltzer
		// is_tax('drink_family', 14) || //energy
		is_singular('drink')
	) {
		// wp_enqueue_script('passive', $theme_uri . "/www/js/passive.js", ['jquery'], $theme->version, true);
		
		// slick
	} 
	wp_enqueue_style('slick-styles', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false, $theme->version);
	wp_enqueue_style('slick-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', false, $theme->version);
	wp_enqueue_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], $theme->version, true);
	// else {
	// 	wp_enqueue_script( 'jquery', 'https://cdn.jsdelivr.net/npm/cash-dom@8.1.1/dist/cash.min.js', array(), null, true );
	// 	// wp_enqueue_script( 'jquery', 'https://cdn.skypack.dev/cash-dom', array(), null, true );
	// }


	//home - fast-acting
	// if(
	// 	is_front_page() || 
	// 	is_page(10)
	// ) {
		wp_enqueue_script('basicscroll', 'https://cdn.jsdelivr.net/npm/basicscroll@3.0.4/dist/basicScroll.min.js', ['jquery'], $theme->version, true);
	// }

	//filtering
	// if(
	// 	is_tax('drink_family', 12) || //soda
	// 	is_tax('drink_family', 13) || //seltzer
	// 	is_tax('drink_family', 14)    //energy
	// ) {
		wp_enqueue_script('isotope', 'https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js', ['jquery'], $theme->version, true);
	// }


	//lity - modals
	// wp_enqueue_style('lity', "https://cdn.jsdelivr.net/npm/lity@2.4.1/dist/lity.min.css", false, $theme->version);
	// wp_enqueue_script('lity', "https://cdn.jsdelivr.net/npm/lity@2.4.1/dist/lity.min.js", ['jquery'], $theme->version, true);

	//svelte/bundle
	//TODO wp_enqueue_style('components-css', $theme_uri . "/src/css/components.css",  false, $theme->version);
	wp_enqueue_style('theme-css', $theme_uri . "/build/css/bundle.css",  false, $theme->version);

	// theme js
	// if(
	// 	is_page(10) || //home
	// 	is_page(22) || //about
	// 	is_page(23) || //drinks
	// 	is_tax('drink_family', 12) || //soda
	// 	is_tax('drink_family', 13) || //seltzer
	// 	is_tax('drink_family', 14) || //energy
	// 	is_singular('drink')
	// ) {
	// 	wp_enqueue_script('theme-js', $theme_uri . "/build/js/bundle.js", ['jquery', 'wp-api'], $theme->version, true);
	// } else {
	wp_enqueue_script('theme-js', $theme_uri . "/build/js/bundle.js", ['jquery'], $theme->version, true);
	// }
	wp_enqueue_script('main-js', $theme_uri . "/src/main.js", ['jquery'], $theme->version, true);
}
add_action( 'wp_enqueue_scripts', 'theme_scripts', 10 );