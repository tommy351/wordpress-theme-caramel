<?php

if (!isset($content_width)){
  $content_width = 680;
}

function caramel_setup(){
  // Translation support
  load_theme_textdomain( 'twentyfourteen', get_template_directory() . '/languages' );

  // Add RSS feed links to <head> for posts and comments
  add_theme_support('automatic_feed_links');

  // Register menus
  register_nav_menus(array(
    'primary' => __('Primary menu', 'caramel')
  ));

  // HTML5 support
  add_theme_support('html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
  ));

  // Allow users to set a custom background
  add_theme_support('custom-background', apply_filters('twentyfourteen_custom_background_args', array(
    'default-color' => 'f4ead5',
  )));
}

add_action('after_setup_theme', 'caramel_setup');

function caramel_scripts(){
  wp_enqueue_style('caramel-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'caramel_scripts');

// Change the title based on the current page
function caramel_wp_title($title, $sep){
  global $paged, $page;

  if (is_feed()) return $title;

  // Add the site name.
  $title .= get_bloginfo('name', 'display');

  // Add the site description for the home/front page.
  $site_description = get_bloginfo('description', 'display');
  if ( $site_description && (is_home() || is_front_page())){
    $title = "$title $sep $site_description";
  }

  // Add a page number if necessary.
  if ($paged >= 2 || $page >= 2){
    $title = "$title $sep " . sprintf(__('Page %s', 'twentyfourteen'), max($paged, $page));
  }

  return $title;
}

add_filter('wp_title', 'caramel_wp_title', 10, 2);

// Customize search form
function caramel_search_form($form){
  $form = '<form role="search" method="get" id="search-form" action="' . home_url('/') . '">
  <input type="search" value="' . get_search_query() . '" name="s" id="search-form-input" placeholder="' . __('Search', 'caramel') . '">
  </form>';

  return $form;
}

add_filter('get_search_form', 'caramel_search_form');

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Add Theme Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';