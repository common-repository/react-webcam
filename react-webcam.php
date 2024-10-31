<?php
/*
Plugin Name: React Webcam
Version: 1.2.0
Author: Radek Matej
Description: Add auto-refreshing image from your webcam to any page.
*/

namespace ReactWebcam;

const WEBCAM_DIR = 'webcam';
const SUBDIR_ATTNAME = 'dir';
const REFRESHINT_ATTNAME = 'refreshinterval';
const REFRESHINT_DEFAULT = 60; // seconds

function init($atts) {

	$atts = shortcode_atts(array(
		REFRESHINT_ATTNAME => REFRESHINT_DEFAULT,
		SUBDIR_ATTNAME => NULL
	), $atts);

	wp_register_script('react', plugins_url('js/vendor/react.min.js', __FILE__));
	wp_enqueue_script('ReactWebcam_ActualImage', plugins_url('js/ActualImage.js', __FILE__), array('react'));

	$upload_dir = wp_upload_dir();
	$ajax_url = admin_url('admin-ajax.php');
	$images_root_url = $upload_dir['baseurl'] . '/' . WEBCAM_DIR . '/';
	if ($atts[SUBDIR_ATTNAME]) {
		$images_root_url .= $atts[SUBDIR_ATTNAME] . '/';
	}
	$initial_image_filename = get_last_filename($atts[SUBDIR_ATTNAME]);

	return '
		<div class="react-webcam"
			data-ajax-url="' . $ajax_url . '"
			data-images-root-url="' . $images_root_url . '"
			data-subdir="' . $atts[SUBDIR_ATTNAME] . '"
			data-initial-image-filename="' . $initial_image_filename . '"
			data-refresh-interval="' . $atts[REFRESHINT_ATTNAME] . '">
			<img src="' . $images_root_url . $initial_image_filename . '" />
		</div>';

};


// Returns filename of the last webcam image.
function get_last_filename($subdir) {

	$upload_dir = wp_upload_dir();
	$webcam_dir = $upload_dir['basedir'] . '/' . WEBCAM_DIR . '/';

	if ($subdir && preg_match('/[a-z0-9]/i', $subdir)) {
		$webcam_dir .= $subdir . '/';
	}

	foreach (array_filter(glob($webcam_dir . '*'), 'is_file') as $path) {
		$last_filename = basename($path);
	}
	return $last_filename;

};


// AJAX call handler to return last webcam image filename.
function last_image() {
	$subdir = $_GET['dir'];
	echo get_last_filename($subdir);
	wp_die();
}


add_action('wp_ajax_last_image', 'ReactWebcam\last_image');
add_action('wp_ajax_nopriv_last_image', 'ReactWebcam\last_image');

add_shortcode('reactwebcam', 'ReactWebcam\init');

?>
