<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemprop="blogPost">
  <header class="article-header">
    <?php if (get_the_category_list()) : ?>
    <div class="article-categories">
      <?= get_the_category_list(', '); ?>
    </div>
    <?php endif; ?>
    <?php if (is_single()) : ?>
      <h1 class="article-title" itemprop="name"><?php the_title(); ?></h1>
    <?php else : ?>
      <h1 itemprop="name">
        <a href="<?= esc_url(get_permalink()); ?>" class="article-title"><?php the_title(); ?></a>
      </h1>
    <?php endif; ?>
  </header>
  <div class="article-entry" itemprop="articleBody">
    <?php the_content(__('Continue reading', 'caramel')); ?>
    <?php wp_link_pages() ?>
  </div>
  <footer class="article-footer">
    <div class="article-meta">
      <a href="<?= esc_url(get_permalink()); ?>" class="article-date">
        <time datetime="<?= esc_attr(get_the_date('c')); ?>" itemprop="datePublished"><?= esc_html(get_the_date()) ?></time>
      </a>
      <?php
      if (comments_open() || get_comments_number()){
        comments_popup_link(__('Comments', 'caramel'), __('1 comment', 'caramel'), __('% comments', 'caramel'), 'article-comment-link');
      }
      ?>
    </div>
    <?php if (get_the_tag_list()) : ?>
    <div class="article-tags">
      <?= get_the_tag_list(); ?>
    </div>
    <?php endif; ?>
  </footer>
</article>