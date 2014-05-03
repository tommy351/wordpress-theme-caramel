<?php
if (have_posts()){
  while (have_posts()){
    the_post();
    get_template_part('content', get_post_format());
  }
  caramel_paging_nav();
} else {
  get_template_part('content', 'none');
}