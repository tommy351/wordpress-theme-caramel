<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="main">
<header id="header">
  <h1>
    <a href="<?= esc_url(home_url('/')); ?>" rel="home" id="logo"><?php bloginfo('name'); ?></a>
  </h1>
  <h2 id="tagline"><?php bloginfo('description'); ?></h2>
  <nav id="main-nav" role="navigation">
    <?php wp_nav_menu(array('theme_location' => 'primary', 'depth' => 1)); ?>
  </nav>
  <?php get_search_form(); ?>
</header>