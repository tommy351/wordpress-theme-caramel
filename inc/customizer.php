<?php
function caramel_customize_register($wp_customize){
  /*
  // Link Color
  $wp_customize->add_setting('link_color' , array(
    'default' => '#e94e77'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', array(
    'label' => __('Link Color', 'mytheme'),
    'section' => 'colors',
    'settings' => 'link_color',
  )));

  // Text Color
  $wp_customize->add_setting('text_color', array(
    'default' => '#c6a49a'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'text_color', array(
    'label' => __('Text Color', 'mytheme'),
    'section' => 'colors',
    'settings' => 'text_color',
  )));*/
}

add_action('customize_register', 'caramel_customize_register');