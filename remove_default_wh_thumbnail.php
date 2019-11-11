<?php

function verum_post_thumbnail_html( $html ){
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}
add_filter( 'post_thumbnail_html', 'verum_post_thumbnail_html' );
