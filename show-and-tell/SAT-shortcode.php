<?php

// Add Show and Tell Shortcode, return output
remove_shortcode('gallery');

add_shortcode('gallery', 'show_and_tell_setup');

function show_and_tell_setup($attr) {
	global $post;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order',
		'id'         => $post ? $post->ID : 0,
		'size'       => 'full',
		'include'    => '',
		'exclude'    => '',
		'ids'        => '',
		'autoplay'   => false
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($ids) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $ids );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	// Build the output
	$output = '';
	$output .= "<div id='sat_gallery_".rand(0, 1000)."' class='sat-gallery' data-autoplay='$autoplay'><div class='images'>";

	foreach ( $attachments as $id => $attachment ) {
		$imagearr = wp_get_attachment_image_src( $id, $size, false);

		$output .= '<div class="image" style="background-image:url('.$imagearr[0].');"></div>';
	}
	$output .= "</div><!-- images -->";

	foreach ( $attachments as $id => $attachment ) {
		if (trim($attachment->post_excerpt) ) {$captions[] = wptexturize($attachment->post_excerpt); }
	}

	//if (($captions) ) {
			$output .= "
			<div class='caption'><div class='captions'>";
			foreach ( $attachments as $id => $attachment ) {
				$output .= "<p>";
				if (trim($attachment->post_excerpt) ) {
					$output .= wptexturize($attachment->post_excerpt);
				} else {
					$output .= "&nbsp;";
				}
				$output .= "</p>";
			}
			if ($attachments > 1) {
			$output .= "
			</div>
			<div class=\"sat-nav\">
			<a href=\"#\" class=\"sat-back\"><span class=\"optional\">Back</span></a>
			<a href=\"#\" class=\"sat-next\"><span class=\"optional\">Next</span></a>
			</div>";
			}
			$output .= "</div>";
	//}
	$output .= "<div class='clearfloat'></div></div><div class='clearfloat'></div>";

	return $output;
}
