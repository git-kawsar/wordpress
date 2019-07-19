<?php
// send value to js by php in wordpress
	//first generate the value (whatever you want) to send 
	$prefix_date = get_post_meta($post->ID, 'meta_key', true);
	wp_localize_script($handler, $data, array(
		'date' => $prefix_date
	));
	// than set your $data to your js file
	'date' => $data.date,
	
	
