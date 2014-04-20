<?php get_header(); ?>
<div id="content" role="main">
<?php
if (get_header_image()) : ?>
<div id="banner">
  <div id="banner-img"></div>
</div>
<?php
endif;

if (have_posts()){
  while (have_posts()){
    the_post();
    get_template_part('content', get_post_format());
  }
  caramel_paging_nav();
} else {
  get_template_part('content', 'none');
}
?>
<?php get_footer(); ?>