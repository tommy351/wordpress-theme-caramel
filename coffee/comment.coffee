$form = $('#commentform')
$textarea = $('#comment')
textarea = $textarea[0]

insert = (before, after = '') ->
  if textarea.selectionStart? && textarea.selectionEnd?
    startPos = textarea.selectionStart
    endPos = textarea.selectionEnd
    cursorPos = endPos
    value = textarea.value

    textarea.value = [
      value.substring 0, startPos
      before
      value.substring startPos, endPos
      after
      value.substring endPos, value.length
    ].join ''

    cursorPos += before.length
    cursorPos += after.length if startPos isnt endPos

    textarea.selectionStart = textarea.selectionEnd = cursorPos

$form.on 'focus', 'input', ->
  $(@).parent().addClass 'focus'
.on 'blur', 'input', ->
  $(@).parent().removeClass 'focus'
.on 'keyup', 'input', ->
  if $(@).val()
    $(@).parent().addClass 'unblank'
  else
    $(@).parent().removeClass 'unblank'

$('#comments').on 'click', '.comment-quote-link', ->
  $this = $(@)
  $comment = $this.parentsUntil('#comment-list').last()
  id = $comment.attr 'id'
  author = $comment.find('.comment-author').html()
  content = $comment.find('.article-entry').html()

  insert "<blockquote cite=\"##{id}\"><a href=\"##{id}\">#{author}</a>: \n#{content}</blockquote>"
.on 'click', '.comment-reply-link', ->
  $this = $(@)
  $comment = $this.parentsUntil('#comment-list').last()
  id = $comment.attr 'id'
  author = $comment.find('.comment-author').html()

  insert "<a href=\"##{id}\">@#{author}</a> "

.on 'click', '.comment-form-link', ->
  switch $(@).data('cmd')
    when 'bold'
      insert '<strong>', '</strong>'
    when 'italic'
      insert '<em>', '</em>'
    when 'delete'
      insert '<del>', '</del>'
    when 'link'
      url = prompt 'URL:'
      insert "<a href=\"#{url}\">", '</a>' if url
    when 'quote'
      insert '<blockquote>', '</blockquote>'
    when 'image'
      url = prompt 'URL:'
      if url
        title = prompt 'Title:'

        if title
          insert "<img src=\"#{url}\" alt=\"#{title}\">"
        else
          insert "<img src=\"#{url}\">"
    when 'code'
      insert '<pre>', '</pre>'

$('#cancel-comment-reply-link').on 'click', ->
  $textarea.val ''
