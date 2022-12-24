<?php

add_action('rest_api_init', function () {
	$namespace = 'dev/v1';
	register_rest_route( $namespace, '/init', array(
		'methods'  => 'GET',
		'callback' => 'initSetup',
   ));
});

function initSetup() {
   // add_action('after_setup_theme', 'setup');
   $auto = new AutoSetup();
   $auto->init_home();
   return new WP_REST_Response(['complete']);
   // return json_encode(['complete']);
}

final class AutoSetup { //TODO memo persistence

	// some code

	public function __construct(){
		add_action('after_switch_theme', array( $this, 'activate' ));
	}

	// public function activate() {
	// 	file_put_contents(__DIR__.'\de.log','TEST');
	// }

	public function init_home() {
		$title = 'Front Page';
		if (! $homepage = get_page_by_title($title) ) {
			$pid = wp_insert_post([
				'post_type' => 'page',
				'post_status' => 'publish',
				'post_title' => $title,
				'post_content' => "
               <!-- wp:acf/page-hero {\"id\":\"block_63a65fc7ee37e\",\"name\":\"acf/page-hero\",\"data\":[],\"align\":\"\",\"mode\":\"edit\"} /-->
            ",
				'menu_order' => -99,
			]);
		}
		$homepage = get_page_by_title( $title );
		update_option( 'page_on_front', $homepage->ID );
		update_option( 'show_on_front', 'page' );

      //Discourage Search Engines
      echo 'discouraging search engine';
      update_option('blog_public', '0');

      //update blog title setup.json
	}

	public function rm_def_post() { //https://stackoverflow.com/questions/25103949/wordpress-get-posts-by-title-like
		if($def_post = get_page_by_title('Hello World', OBJECT, 'post')) {
			wp_trash_post($def_post->ID, true);
		}
	}

	public function gen_sample() { //typograhphy, fonts, colors
		//add content to home page
	}
}