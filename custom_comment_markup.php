<?php
  $verum_comment_form_args = array(
		'fields' => 'custom_field',
		'comment_field' => 'custom_field',
		'submit_button' => 'custom_field',
		'comment_note_before' => 'Your email address will not be published. Required fields are marked *',
		'comment_note_after' => 'after comment ',
		'title_replay' => '',
		'class_form' => 'comment-form'
	);
	comment_form( $verum_comment_form_args );
