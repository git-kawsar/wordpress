<?php
/*
==================================================================================================================
                                            Theme support Functions
==================================================================================================================
*/
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

/*
==================================================================================================================
                                            Protected Title Format 
==================================================================================================================
*/
  function alfa_protected_title_change($title){
      return '%s';
  }
  add_filter('protected_title_format', 'alfa_protected_title_change');

  function alfa_the_excerpt($excerpt){
      if(!post_password_required()){
          return $excerpt;
      }else{
          echo get_the_password_form();
      }
  }
  add_filter('the_excerpt', 'alfa_the_excerpt');

/*
==================================================================================================================
                                            Add Css class to li item 
==================================================================================================================
*/
  function alfa_nav_menu_css_class($class, $item){
      $class[] = 'list-inline-item';
      return $class;
  }
  add_filter('nav_menu_css_class', 'alfa_nav_menu_css_class', 10, 2);



