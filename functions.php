<?php
ini_set("error_log", get_template_directory() . "/debug.txt");

if ( ! defined( 'IS_LOCAL' ) ) {
	define('IS_LOCAL', wp_get_environment_type() == 'local');
}
if ( ! defined( 'TEXTDOMAIN' ) ) {
	define('TEXTDOMAIN', '_s');
}
if ( ! defined( 'REMOTE_URL' ) ) {
	// define('REMOTE_URL', '.wpengine.com');
}

require get_template_directory() . '/_s/functions.php';
require get_template_directory() . '/lib/theme-setup.php';

/** CUSTOM POST TYPES */
require_once 'lib/cpt/team.php';


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