<?php
function caramel_custom_header_setup(){
  add_theme_support('custom-header', apply_filters('caramel_custom_header_args', array(
    'default-text-color' => 'fff',
    'width' => 650,
    'height' => 250,
    'flex-height' => true,
    'wp-head-callback' => 'caramel_header_style',
    'admin-head-callback' => 'caramel_admin_header_style',
    'admin-preview-callback' => 'caramel_admin_header_image'
  )));
}

add_action('after_setup_theme', 'caramel_custom_header_setup');

function caramel_header_style(){
  //
}

function caramel_admin_header_style(){
  //
}

function caramel_admin_header_image(){
  //
}