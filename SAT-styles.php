<?php

// Enqueue the styles and scripts.
function SAT_styles() {
	// Variables Setup
	global $post;

	// Make sure the shortcode exists first.
	if ( is_post_type_archive() || ! has_shortcode( $post->post_content, 'gallery' ) ) {
		return;
	}

	wp_enqueue_style( 'sat_styles', SAT_URL . 'css/style.css' );
	wp_enqueue_script( 'sat_scripts', SAT_URL . 'js/sat_gallery.min.js', '', '', true );
}

add_action( 'wp_enqueue_scripts', 'SAT_styles', 11 );
