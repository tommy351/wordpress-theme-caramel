<?php get_header(); ?>
<div id="content" role="main">
<?php
if (get_header_image()) : ?>
<div id="banner">
  <div id="banner-img"></div>
</div>
<?php
endif;

while (have_posts()){
  the_post();
  get_template_part('content', 'page');
  if (comments_open() || get_comments_number()){
    comments_template();
  }
}
?>
<?php get_footer(); ?>