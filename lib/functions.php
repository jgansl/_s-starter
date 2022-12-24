<?php
define("IS_LOCAL", wp_get_environment_type() == "local");

ini_set("error_log", get_template_directory() . "/debug.txt");
//var_dump settings
// ini_set("xdebug.var_display_max_children", '-1');
// ini_set("xdebug.var_display_max_data", '-1');
// ini_set("xdebug.var_display_max_depth", '-1');

require_once "lib/util/svg-includes.php";
// require_once "lib/util/menu-walker.php";

require_once "lib/theme-setup.php";
require_once "lib/theme-enqueue.php";
require_once "lib/theme-blocks.php";
// require_once "lib/theme-rest.php";
// require_once "sql.php";

//Custom Post Types
require_once 'lib/cpt/drink.php';
require_once 'lib/cpt/faq.php';
require_once 'lib/cpt/location.php';
require_once 'lib/cpt/taxonomies.php';

// //dev setup automation
// if (IS_LOCAL) {
// 	require_once "lib/develop-setup.php";
// }

function social_share($soc_name)
{
	$share_options = [
		"facebook" =>
		"https://www.facebook.com/sharer/sharer.php?u=" . get_the_permalink(),
		"twitter" =>
		"https://twitter.com/intent/tweet?text=" .
			get_the_title() .
			"&url=" .
			get_the_permalink(),
		"linkedin" =>
		"https://www.linkedin.com/cws/share?url=" . get_the_permalink(),
		"email" =>
		"mailto:?subject=I wanted you to see this: " .
			get_the_title() .
			"&amp;body=" .
			get_the_permalink(),
	];

	echo $share_options[$soc_name];
}

//REMOTE MEDIA
// require_once "lib/util/remote-media/remote-media.php";
if (IS_LOCAL) {
	// add_filter(
	// 	'be_media_from_production_url',
	// 	function () {
	// 		 //SITE
	// 		return 'https://enjoyhi5.wpengine.com/';
	// 	}
	// );
}

// options
function fetch_option_fields() {
   global $option_fields;
   if(!defined('option_fields')) {
		$option_fields = get_fields('options');
   }
}

add_action('template_redirect', 'fetch_option_fields');


// Allow SVG
// add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

// 	global $wp_version;
// 	if ( $wp_version !== '4.7.1' ) {
// 		return $data;
// 	}
 
// 	$filetype = wp_check_filetype( $filename, $mimes );
 
// 	return [
// 		 'ext'             => $filetype['ext'],
// 		 'type'            => $filetype['type'],
// 		 'proper_filename' => $data['proper_filename']
// 	];
 
// }, 10, 4 );
 
// function theme_mime_types( $mimes ){
// 	// $mimes['svg'] = 'image/svg+xml';
// 	$mimes['webp'] = 'image/webp';
// 	return $mimes;
// }
// add_filter( 'upload_mimes', 'theme_mime_types' );
 
// function fix_svg() {
// 	echo '<style type="text/css">
// 			.attachment-266x266, .thumbnail img {
// 					width: 100% !important;
// 					height: auto !important;
// 			}
// 			</style>';
// }
// add_action( 'admin_head', 'fix_svg' );

//enable WEBP
//enable upload for webp image files.
// function webp_upload_mimes($existing_mimes) {
// 	$existing_mimes['webp'] = 'image/webp';
// 	return $existing_mimes;
// }
// add_filter('mime_types', 'webp_upload_mimes');
//enable preview / thumbnail for webp image files.
function webp_is_displayable($result, $path) {
	if ($result === false) {
		 $displayable_image_types = array( IMAGETYPE_WEBP );
		 $info = @getimagesize( $path );
		 if (empty($info)) {
			  $result = false;
		 } elseif (!in_array($info[2], $displayable_image_types)) {
			  $result = false;
		 } else {
			  $result = true;
		 }
	}
	return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

/** 
 * Single Drink Pagination 
 *  
 */
function drink_prev_post_link() {
	if( !$prev = get_adjacent_post(true, '', true, 'drink_family') ) {
		$prev = new WP_Query('posts_per_page=-1&order=DESC&post_type=drink'); 
		$prev = $prev->the_post();
	}
	$content = svg('arrow-left', $echo=false) . '<span class="sr-only">previous drink</span>';
	echo '<a class="prev-link" href="' . get_permalink($prev) . '" data-wenk="' . get_the_title() . '">'.$content.'</a>';
	wp_reset_query();
}
function drink_next_post_link() {
	if( !$next = get_adjacent_post(true, '', false, 'drink_family') ) {
		$next = new WP_Query('posts_per_page=-1&order=ASC&post_type=drink'); 
		$next = $next->the_post();
	}
	$content = svg('arrow-right', $echo=false) . '<span class="sr-only">next drink</span>';
	echo '<a class="next-link" href="' . get_permalink($next) . '" data-wenk="' . get_the_title() . '">'.$content.'</a>';
	wp_reset_query();
}

//TODO rm $content = "
// 	&lt;!-- wp:acf/drink-slider {\"id\":\"block_6359951825af3\",\"name\":\"acf/drink-slider\",\"data\":{\"drink_selection\":\"\",\"_drink_selection\":\"field_63597a2f0015f\"},\"align\":\"\",\"mode\":\"edit\"} /--&gt;
// 	&lt;!-- wp:acf/drink-properties {\"id\":\"block_6359952125af4\",\"name\":\"acf/drink-properties\",\"data\":[],\"align\":\"\",\"mode\":\"edit\"} /--&gt;
// 	&lt;!-- wp:acf/drink-description {\"id\":\"block_6359952925af5\",\"name\":\"acf/drink-description\",\"data\":[],\"align\":\"\",\"mode\":\"edit\"} /--&gt;
// 	&lt;!-- wp:acf/drink-reviews {\"id\":\"block_6359953225af6\",\"name\":\"acf/drink-reviews\",\"data\":[],\"align\":\"\",\"mode\":\"edit\"} /--&gt;
// 	&lt;!-- wp:acf/best-sellers {\"id\":\"block_6359953725af7\",\"name\":\"acf/best-sellers\",\"data\":{\"headline\":\"Best Sellers\",\"_headline\":\"field_634dbdc265ac7\",\"best_sellers\":[\"139\",\"138\",\"137\",\"142\"],\"_best_sellers\":\"field_634dbcf377c09\"},\"align\":\"\",\"mode\":\"edit\"} /--&gt;
// 	&lt;!-- wp:acf/faqs {\"id\":\"block_63599568dd90a\",\"name\":\"acf/faqs\",\"data\":{\"heading\":\"FAQs\",\"_heading\":\"field_63599b41caf20\",\"faqs\":[\"154\",\"155\",\"157\"],\"_faqs\":\"field_63599664e109b\"},\"align\":\"\",\"mode\":\"edit\"} /--&gt;
// ";


// add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
// 	$filetype = wp_check_filetype( $filename, $mimes );
// 	return [
// 		 'ext'             => $filetype['ext'],
// 		 'type'            => $filetype['type'],
// 		 'proper_filename' => $data['proper_filename']
// 	];
//  }, 10, 4 );
 function cc_mime_types( $mimes ){
	// $mimes['svg'] = 'image/svg+xml';
	$mimes['webp'] = 'image/webp';
	return $mimes;
 }
 add_filter( 'upload_mimes', 'cc_mime_types' );
 function fix_svg() {
	echo '<style type="text/css">
			.attachment-266x266, .thumbnail img {
				  width: 100% !important;
				  height: auto !important;
			}
			</style>';
 }
//  add_action( 'admin_head', 'fix_svg' );

 function custom_topic_link( $link, $term, $taxonomy )
 {
	  if ( $taxonomy !== 'drink_family' )
			return $link;
 
	  return str_replace( 'drink_family/', '', $link );
  }
//  add_filter( 'term_link', 'custom_topic_link', 10, 3 );

function get_mapbox_token() { //TODO localize
	return 'pk.eyJ1IjoiamdhbnN0ZiIsImEiOiJjbDl5a29vdGIwNXNsM3Bxb3ltZmhteDI3In0.Q5PZdLZvu8eUDiy7jPOO8g';
	// return 'pk.eyJ1Ijoib29wc2llIiwiYSI6ImNsYm1odnY0ZjBoajczb3F4cHFoM2Fwc24ifQ.JvvWPLjylOkf3tAMT6ZmiQ';
}

function location_add_property_coords($post_id) {
	$fields = get_fields($post_id);
	if ($coords = $fields['geo_coords']) { //TODO apply regex
	  // error_log('has_coords');
	  update_field('geo_coords', trim(preg_replace('/\s+/', '', $coords)), $post_id);
	  return;
	}
	$address_line_one = $fields['address_line_one'];
	$address_line_two = $fields['address_line_two'];
	$url_address = urlencode("$address_line_one, $address_line_two");
	$token = get_mapbox_token();
	$request = Requests::get("https://api.mapbox.com/geocoding/v5/mapbox.places/$url_address.json?access_token=$token");
	if ($request->status_code === 200) { //is_ok() raise_for_status
		// error_log($request->body);
		$res = json_decode($request->body);
		// error_log(json_encode($res, JSON_PRETTY_PRINT));//debug
		$coords_arr = $res->features[0]->center;
		//TODO regex
		$coords = $coords_arr[1] . ',' . $coords_arr[0]; //string: lng, lat from lat,lng
		// error_log('coords: ' . $coords);
		// error_log('post_id: ' . $post_id);
		update_field('geo_coords', $coords, $post_id);
	} else {
		error_log(json_encode($request->body, JSON_PRETTY_PRINT));//debug
	}
}

// post updated universal hook
function theme_post_updated( $post_id ) {
	// logic by post type
	$post_type = get_post_type($post_id);
	if ($post_type === 'location') {
		location_add_property_coords($post_id);
		return;
	}
}
add_action('acf/save_post', 'theme_post_updated');


function sortByLocation($zip) {
	//set transientes

	//for all coordinates
	//geioographize 
	$dX = 0;
	$dY = 0;
}

//on_save, clear cache

//TODO
add_action( 'acf/init', function() {
	$google_api_key = 'AIzaSyCoDoZrtL6L2-iAr_zvx9qWzU13AcfWT5w';
	acf_update_setting( 'google_api_key', $google_api_key );
} );


//on create pre-fill singe-drink
// add_action('wp_insert_post', function() {
// 	error_log(json_encode('new post', JSON_PRETTY_PRINT));//debug
// });

//TODO single-location
add_filter( 'default_content', 'set_default_content', 10, 2 );
function set_default_content( $content, $post ) {
	// if(!IS_LOCAL) { return; }
	if($post->post_status == "auto-draft" && $post->post_type == 'drink' && !$post->post_content) {
		//error_log(json_encode($post, JSON_PRETTY_PRINT));//debug
		//error_log(json_encode($content, JSON_PRETTY_PRINT));//debug
		// wp_update_post([
		// 	'ID' => $post->ID,
		// 	'post_content' => 'test'
		// ]);
		
		$content = "
		<!-- wp:acf/drink-slider {\"id\":\"block_6359951825af3\",\"name\":\"acf/drink-slider\",\"data\":{\"drink_selection\":\"\",\"_drink_selection\":\"field_63597a2f0015f\"},\"align\":\"\",\"mode\":\"edit\"} /-->
		<!-- wp:acf/drink-properties {\"id\":\"block_6359952125af4\",\"name\":\"acf/drink-properties\",\"data\":{\"attributes_0_img\":173,\"_attributes_0_img\":\"field_635ab22c7524a\",\"attributes_0_label\":\"bubbly\",\"_attributes_0_label\":\"field_635ab33e7524b\",\"attributes_1_img\":176,\"_attributes_1_img\":\"field_635ab22c7524a\",\"attributes_1_label\":\"fast-acting\",\"_attributes_1_label\":\"field_635ab33e7524b\",\"attributes_2_img\":178,\"_attributes_2_img\":\"field_635ab22c7524a\",\"attributes_2_label\":\"refreshing\",\"_attributes_2_label\":\"field_635ab33e7524b\",\"attributes_3_img\":177,\"_attributes_3_img\":\"field_635ab22c7524a\",\"attributes_3_label\":\"gluten-free\",\"_attributes_3_label\":\"field_635ab33e7524b\",\"attributes_4_img\":175,\"_attributes_4_img\":\"field_635ab22c7524a\",\"attributes_4_label\":\"discreet\",\"_attributes_4_label\":\"field_635ab33e7524b\",\"attributes_5_img\":179,\"_attributes_5_img\":\"field_635ab22c7524a\",\"attributes_5_label\":\"resealable child-proof lid\",\"_attributes_5_label\":\"field_635ab33e7524b\",\"attributes\":6,\"_attributes\":\"field_635ab22075249\"},\"align\":\"\",\"mode\":\"edit\"} /-->
		<!-- wp:acf/drink-description {\"id\":\"block_6359952925af5\",\"name\":\"acf/drink-description\",\"data\":{\"headline\":\"\",\"_headline\":\"field_6360590381c1d\",\"content\":\"\",\"_content\":\"field_6360591081c1e\",\"btn_text\":\"\",\"_btn_text\":\"field_6360591864a4b\",\"btn_url\":\"\",\"_btn_url\":\"field_636059337e38b\"},\"align\":\"\",\"mode\":\"edit\"} /-->
		<!-- wp:acf/drink-reviews {\"id\":\"block_6359953225af6\",\"name\":\"acf/drink-reviews\",\"data\":{\"reviews\":\"\",\"_reviews\":\"field_635ac372bd254\"},\"align\":\"\",\"mode\":\"edit\"} /-->
		<!-- wp:acf/best-sellers {\"id\":\"block_6359953725af7\",\"name\":\"acf/best-sellers\",\"data\":{\"headline\":\"Best Sellers\",\"_headline\":\"field_634dbdc265ac7\",\"best_sellers\":\"\",\"_best_sellers\":\"field_634dbcf377c09\"},\"align\":\"\",\"mode\":\"edit\"} /-->
		<!-- wp:acf/faqs {\"id\":\"block_63599568dd90a\",\"name\":\"acf/faqs\",\"data\":{\"faqs_heading\":\"FAQs\",\"_faqs_heading\":\"field_63599b41caf20\",\"faqs\":\"\",\"_faqs\":\"field_63599664e109b\"},\"align\":\"\",\"mode\":\"edit\"} /-->
		";
	}
	return $content;
}

//haversine function - as the crow flies, not driving directions
//TODO compare to https://stackoverflow.com/questions/24006342/haversine-formula-in-php
function getDistance($latitude1, $longitude1, $latitude2, $longitude2) {
    
	$earth_radius = 6371;

	$dLat = deg2rad($latitude2 - $latitude1);
	$dLon = deg2rad($longitude2 - $longitude1);

	$a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
	$c = 2 * asin(sqrt($a));
	$d = $earth_radius * $c;

	return $d;
	
}

/**
 * Calculates the great-circle distance between two points, with
 * the Haversine formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 */
function haversineGreatCircleDistance(
	$latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
 {
	// convert from degrees to radians
	$latFrom = deg2rad($latitudeFrom);
	$lonFrom = deg2rad($longitudeFrom);
	$latTo = deg2rad($latitudeTo);
	$lonTo = deg2rad($longitudeTo);
 
	$latDelta = $latTo - $latFrom;
	$lonDelta = $lonTo - $lonFrom;
 
	$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
	  cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
	return $angle * $earthRadius;
}

// haversine formula
 
function haversine($lat1, $lon1,
                   $lat2, $lon2)
{
    // distance between latitudes
    // and longitudes
    $dLat = ($lat2 - $lat1) *
                M_PI / 180.0;
    $dLon = ($lon2 - $lon1) *
                M_PI / 180.0;
 
    // convert to radians
    $lat1 = ($lat1) * M_PI / 180.0;
    $lat2 = ($lat2) * M_PI / 180.0;
 
    // apply formulae
    $a = pow(sin($dLat / 2), 2) +
         pow(sin($dLon / 2), 2) *
             cos($lat1) * cos($lat2);
    $rad = 6371;
    $c = 2 * asin(sqrt($a));
    return $rad * $c;
}
 
// // Driver code
// $lat1 = 51.5007;
// $lon1 = 0.1246;
// $lat2 = 40.6892;
// $lon2 = 74.0445;
 
// echo haversine($lat1, $lon1,
//                $lat2, $lon2) .
//                       " K.M.";

function getDistanceBetween($coordinatesSet) {
	// echo '<script>console.log('.json_encode($coordinatesSet, JSON_PRETTY_PRINT).');</script>';//debug
	// echo '<script>console.log('.json_encode(getDistance(
	// 		$coordinatesSet[0][0], 
	// 		$coordinatesSet[0][1],
	// 		// 47.54119627680181, 
	// 		// -122.26707173280053,
	// 		$coordinatesSet[1][0], 
	// 		$coordinatesSet[1][1]
	// 	)/ 0.6213712, JSON_PRETTY_PRINT).');</script>';//debug
	// // echo '<script>console.log('.json_encode(haversineGreatCircleDistance(
	// // 		// $coordinatesSet[0][0], 
	// // 		// $coordinatesSet[0][1],
	// // 		47.54119627680181, 
	// // 		-122.26707173280053,
	// // 		$coordinatesSet[1][0], 
	// // 		$coordinatesSet[1][1],
	// // 	) / 0.6213712, JSON_PRETTY_PRINT).');</script>';//debug
	// echo '<script>console.log('.json_encode(haversine(
	// 		$coordinatesSet[0][0], 
	// 		$coordinatesSet[0][1],
	// 		// 47.54119627680181, 
	// 		// -122.26707173280053,
	// 		$coordinatesSet[1][0],
	// 		$coordinatesSet[1][1]
	// ) / 0.6213712." Miles.", JSON_PRETTY_PRINT).');</script>';//debug
	// // return getDistance(
	// // 	$coordinatesSet[0][0], 
	// // 	$coordinatesSet[0][1],
	// // 	$coordinatesSet[1][0], 
	// // 	$coordinatesSet[1][1]
	// // );
	return haversine( $coordinatesSet[0][0], $coordinatesSet[0][1], $coordinatesSet[1][0], $coordinatesSet[1][1] ) / 0.6213712 ;
}