<?php
// Variables Setup
global $post;

// Make sure the shortcode exists first.
if ( !shortcode_exists('gallery') )
	return false;

// Enqueue the styles and scripts.
function SAT_styles() {
	wp_enqueue_style( 'sat_styles', SAT_URL.'css/style.css' );
	wp_enqueue_script( 'sat_scripts', SAT_URL.'scripts/min/sat_gallery-ck.js' );
}

add_action( 'wp_head', 'SAT_styles' );