(function($){var $form, $textarea, insert, textarea;

$form = $('#commentform');

$textarea = $('#comment');

textarea = $textarea[0];

insert = function(before, after) {
  var cursorPos, endPos, startPos, value;
  if (after == null) {
    after = '';
  }
  if ((textarea.selectionStart != null) && (textarea.selectionEnd != null)) {
    startPos = textarea.selectionStart;
    endPos = textarea.selectionEnd;
    cursorPos = endPos;
    value = textarea.value;
    textarea.value = [value.substring(0, startPos), before, value.substring(startPos, endPos), after, value.substring(endPos, value.length)].join('');
    cursorPos += before.length;
    if (startPos !== endPos) {
      cursorPos += after.length;
    }
    return textarea.selectionStart = textarea.selectionEnd = cursorPos;
  }
};

$form.on('focus', 'input', function() {
  return $(this).parent().addClass('focus');
}).on('blur', 'input', function() {
  return $(this).parent().removeClass('focus');
}).on('keyup', 'input', function() {
  if ($(this).val()) {
    return $(this).parent().addClass('unblank');
  } else {
    return $(this).parent().removeClass('unblank');
  }
});

$('#comments').on('click', '.comment-quote-link', function() {
  var $comment, $this, author, content, id;
  $this = $(this);
  $comment = $this.parentsUntil('#comment-list').last();
  id = $comment.attr('id');
  author = $comment.find('.comment-author').html();
  content = $comment.find('.article-entry').html();
  return insert("<blockquote cite=\"#" + id + "\"><a href=\"#" + id + "\">" + author + "</a>: \n" + content + "</blockquote>");
}).on('click', '.comment-reply-link', function() {
  var $comment, $this, author, id;
  $this = $(this);
  $comment = $this.parentsUntil('#comment-list').last();
  id = $comment.attr('id');
  author = $comment.find('.comment-author').html();
  return insert("<a href=\"#" + id + "\">@" + author + "</a> ");
}).on('click', '.comment-form-link', function() {
  var title, url;
  switch ($(this).data('cmd')) {
    case 'bold':
      return insert('<strong>', '</strong>');
    case 'italic':
      return insert('<em>', '</em>');
    case 'delete':
      return insert('<del>', '</del>');
    case 'link':
      url = prompt('URL:');
      if (url) {
        return insert("<a href=\"" + url + "\">", '</a>');
      }
      break;
    case 'quote':
      return insert('<blockquote>', '</blockquote>');
    case 'image':
      url = prompt('URL:');
      if (url) {
        title = prompt('Title:');
        if (title) {
          return insert("<img src=\"" + url + "\" alt=\"" + title + "\">");
        } else {
          return insert("<img src=\"" + url + "\">");
        }
      }
      break;
    case 'code':
      return insert('<pre>', '</pre>');
  }
});

$('#cancel-comment-reply-link').on('click', function() {
  return $textarea.val('');
});
})(jQuery)