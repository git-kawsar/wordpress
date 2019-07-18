<?php
function my_function(){
  laod_theme_textdomain();
  add_theme_support('title-tag');
  add_theme_support('post-thumbnail');
  add_theme_support('custom-header', array(
    'default-text-color' => '#c0000', // get_header_textcolor();
    'header-text' => true // if(!display_header_text()){ echo "display: none;"; }
  )); // header_image();
  add_theme_support('custom-logo', array(
    'width' => '100',
    'height' => '100'
  )); // the_custom_logo();
}
add_action('after_setup_theme', 'my_functin');
