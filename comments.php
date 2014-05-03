<?php
if (post_password_required()){
  return;
}
?>
<div id="comments">
  <?php if (have_comments()) : ?>
  <ol id="comment-list">
    <?php wp_list_comments(array('callback' => 'caramel_list_comments')); ?>
  </ol>
  <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
  <nav class="page-nav" role="navigation">
    <?php
    paginate_comments_links(array(
      'prev_text' => '&#9664;',
      'next_text' => '&#9654;'
    ));
    ?>
  </nav>
  <?php endif; // page_comments ?>
  <?php endif; // have_comments() ?>
  <?php if (!comments_open()) : ?>
    <p class="no-comments"><?php __('Comments are closed.', 'caramel') ?></p>
  <?php endif; // !comments_open() ?>
  <?php
  $args = array(
    'title_reply' => '',
    'title_reply_to' => '',
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'comment_field' => '<p class="comment-form-comment">'
      . '<a class="comment-form-link" data-cmd="bold">' . __('Bold', 'caramel') . '</a>'
      . '<a class="comment-form-link" data-cmd="italic">' . __('Italic', 'caramel') . '</a>'
      . '<a class="comment-form-link" data-cmd="delete">' . __('Delete', 'caramel') . '</a>'
      . '<a class="comment-form-link" data-cmd="link">' . __('Link', 'caramel') . '</a>'
      . '<a class="comment-form-link" data-cmd="quote">' . __('Quote', 'caramel') . '</a>'
      . '<a class="comment-form-link" data-cmd="image">' . __('Image', 'caramel') . '</a>'
      . '<a class="comment-form-link" data-cmd="code">' . __('Code', 'caramel') . '</a>'
      . '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>'
      . '</p>'
  );

  if (is_user_logged_in()){
    global $current_user;
    get_currentuserinfo();

    $args['logged_in_as'] = '<div class="logged-in-as">'
      . '<div class="logged-in-as-avatar">'
        . get_avatar($current_user->user_email, 80)
      . '</div>'
      . '<header class="logged-in-as-header">'
        . '<a class="logged-in-as-name" href="' . admin_url('profile.php') . '">' . $current_user->display_name . '</a>'
      . '</header>'
      . '<div class="logged-in-as-links">'
        . '<a class="logged-in-as-link" href="' . admin_url('profile.php') . '">' . __('Profile', 'caramel') . '</a>'
        . '<a class="logged-in-as-link" href="' . wp_logout_url(get_permalink()) . '">' . __('Log out', 'caramel') . '</a>'
      . '</div>'
      . '</div>';
  }

  comment_form($args);
  ?>
</div>