<?php
function caramel_paging_nav(){
  // Don't print empty markup if there's only one page.
  if ($GLOBALS['wp_query']->max_num_pages < 2){
    return;
  }

  $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
  $pagenum_link = html_entity_decode(get_pagenum_link());
  $query_args = array();
  $url_parts = explode('?', $pagenum_link);

  if (isset($url_parts[1])){
    wp_parse_str($url_parts[1], $query_args);
  }

  $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
  $pagenum_link = trailingslashit($pagenum_link) . '%_%';

  $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
  $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

  // Set up paginated links.
  $links = paginate_links(array(
    'base'     => $pagenum_link,
    'format'   => $format,
    'total'    => $GLOBALS['wp_query']->max_num_pages,
    'current'  => $paged,
    'mid_size' => 1,
    'add_args' => array_map('urlencode', $query_args),
    'prev_text' => '&#9664;',
    'next_text' => '&#9654;',
  ));

  if ($links) : ?>
  <nav class="page-nav" role="navigation">
    <?php echo $links; ?>
  </nav>
  <?php endif;
}

function caramel_list_comments($comment, $args, $depth){
  $comment_type = $comment->comment_type; ?>
  <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
    <?php if ($comment_type == 'pingback' || $comment_type == 'trackback') : ?>
    <?php else : ?>
      <div class="comment-avatar">
        <?= get_avatar($comment, 80) ?>
      </div>
      <div class="comment-content">
        <header class="comment-header">
          <?php if (get_comment_author_url()) : ?>
            <a href="<?php comment_author_url(); ?>" rel="nofollow external" target="_blank" class="comment-author"><?php comment_author(); ?></a>
          <?php else : ?>
            <span class="comment-author"><?php comment_author(); ?></span>
          <?php endif; // get_comment_author_url() ?>
          <time class="comment-date" title="<?= get_comment_date() . ' ' . get_comment_time() ?>" datetime="<?php comment_time('c'); ?>"><?= human_time_diff(get_comment_time('U'), current_time('timestamp')); ?></time>
          <?php if (comments_open()) : ?>
            <a class="comment-quote-link" title="<?= __('Quote', 'caramel') ?>"><?= __('Quote', 'caramel') ?></a>
          <?php endif; ?>
          <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
          <?php edit_comment_link(); ?>
        </header>
        <div class="article-entry"><?php comment_text(); ?></div>
      </div>
    <?php endif;
}