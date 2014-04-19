<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemprop="blogPost">
  <header class="article-header">
    <?php if (is_single()) : ?>
      <h1 class="article-title" itemprop="name"><?php the_title(); ?></h1>
    <?php else : ?>
      <h1 itemprop="name">
        <a href="<?php the_permalink(); ?>" class="article-title"><?php the_title(); ?></a>
      </h1>
    <?php endif; ?>
  </header>
  <div class="article-entry">
    <?php the_content(__('Continue reading', 'caramel')); ?>
    <?php wp_link_pages() ?>
  </div>
</article>