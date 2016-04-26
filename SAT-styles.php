<?php

// Enqueue the styles and scripts.
function SAT_styles() {
	// Variables Setup
	global $post;

	// Make sure the shortcode exists first.
	if ( is_post_type_archive() || !has_shortcode( $post->post_content, 'gallery') )
		return false;

	wp_enqueue_style( 'sat_styles', SAT_URL.'css/style.css' );
	wp_enqueue_script( 'froogaloop', SAT_URL.'scripts/vendors/froogaloop.min.js', '', '', true );
	wp_enqueue_script( 'sat_scripts', SAT_URL.'scripts/min/sat_gallery-ck.js', '', '', true );
}

add_action( 'wp_enqueue_scripts', 'SAT_styles', 11 );