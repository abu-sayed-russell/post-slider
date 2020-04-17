<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package  PostSlider
 */

/** Exit if uninstall.php is not called by WordPress. */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

function MMWPS_Delete_Post_Slider_Options() {
	global $wpdb;
	delete_option('MMWPS_VERSION');
	delete_option('mmwps_post_slider');
	$mmwps_unposts = get_posts(
    array(
	    'post_type' => 'mmwps',
	    'numberposts' => -1,
	    'post_status' => 'any',
    )
);
   
    foreach ( $mmwps_unposts as $post ) {
        wp_delete_post( $post->ID, true );
    }
}
MMWPS_Delete_Post_Slider_Options();