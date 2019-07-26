<?php

function child_theme_assets(){
  wp_enqueue_style('parent-style', get_pareent_theme_file_uri('/style.css'));
}
add_action('wp_enqueue_scripts', 'child_theme_assets');

function child_dequeue_assets(){
  wp_dequeue_style($handler_of_parent_theme);
  wp_deregister_style($handler_of_parent_theme);
  wp_enqueue_style('$handler, get_theme_file_uri('/assets/css/file_name.css'));
}
add_action('wp_enqueue_scripts', 'child_dequeue_assets');
