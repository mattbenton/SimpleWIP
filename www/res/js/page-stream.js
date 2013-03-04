var apiUser = null;

$(function() {
  var $createPost = $('#create-post');
  var $postText = $('#post-text');
  var $postTags = $('#post-tags');

  var $postList     = $('.wip-list');
  var $postTemplate = $('#post-template').removeAttr('id').remove();

  $('.wip-buttons').on('click', '.btn', function() {
    var $button = $(this);

    var postText = $postText.val();

    if ( !postText ) {
      return;
    }

    var tags = [];
    $postTags.find(':selected').each(function() {
      tags.push($(this).val());
    });

    var post = {
      message: postText,
      tags:    tags,
      help:    $button.hasClass('btn-danger')
    };

    api.createPost(apiUser, post);

    $postText.val('')
    $postTags.val('').trigger('liszt:updated');

  });

  var isFirstProfileUpdate = true;

  var $teamMemberList       = $('.team-list');
  var $teamMememberTemplate = $('#team-memember-template').remove().removeAttr('id').clone();

  var onUpdateProfile = function ( user ) {
    apiUser = user;
    console.log('got profile', user);

    $('.user-name').text(user.name);
    $('.user-title').text(user.title);
    $('.user-avatar').attr('src', '//gravatar.com/avatar/' + md5(user.email));

    if ( isFirstProfileUpdate ) {
      api.onOrgUsers(apiUser.orgId, function(user) {
        var $user = $teamMememberTemplate.clone();

        $user.find('.user-name').text(user.name);
        $user.find('.wip-avatar img').attr('src', '//gravatar.com/avatar/' + md5(user.email));

        $user.appendTo($teamMemberList).show();
      });
    }

    isFirstProfileUpdate = false;
  };

  authEvents.on('login', function(event, user) {
    api.onUpdateProfile(user.email, onUpdateProfile);
  });

  api.onPost(function(post) {
    var $post = $postTemplate.clone().insertAfter($createPost);
    $post.find('.wip-name').text(post.user.name);
    $post.find('.wip-message').text(post.message);
    $post.find('.wip-time').text(timeSince(post.timestamp));

    $post.find('.avatar').attr('src', '//gravatar.com/avatar/' + md5(post.user.email));

    post.tags = post.tags || [];

    $post.data('id', post.id);

    $post.toggleClass('wip-help', post.help || false);

    api.onPostComment(post.id, function(comment) {
      console.log('comment', comment);

      var html = '<div class="wip-comment"><div class="wip-avatar">';
      html += '<img width="25" height="25" src="' + '//gravatar.com/avatar/' + md5(comment.email) + '" />';
      html += '</div><span class="wip-name">' + comment.user.name + '</span> ' + comment.message + '</div>';

      $post.find('.wip-comment-list').append(html);
      $post.find('.wip-comment-input').val('').blur();
      // var wipComments = $(this).parents('.wip-comment').prev();
      // wipComments.append(tmpl);
      // $(this).val('').blur();
      // return false;
    });

    // var tags = ['jQuery'];
    var tags = post.tags;
    var tagHtml = '';
    for ( var i = 0; i < tags.length; i++ ) {
      tagHtml += '<span class="tag">#' + tags[i] + '</span>';
    }
    $post.find('.wip-tags').html(tagHtml);

    $post.show();
  });

  // $postTags.find('option').remove().trigger('liszt:updated');
  api.onTag(function(tag) {
    $postTags.append('<option value="' + tag.name + '">' + tag.name + '</option>').trigger('liszt:updated');
  });

  $('#profileModal').on('shown', function() {
    $('#nameInp').val(apiUser.name);
    $('#orgInp').val(apiUser.org);
    $('#titleInp').val(apiUser.title);
    console.log('load profile for user ', apiUser.email);
  });

  var postComment = function ( $post ) {
    var $input = $post.find('.wip-comment-input');

    if ( !$input.val() ) return;

    api.createComment({
      postId: $post.data('id'),
      email:  apiUser.email,
      message: $input.val()
    });

    console.log('post comment', $input.val());
  };

  $postList.on('keydown', '.wip-comment-input', function(e){
    if ( e.keyCode == 13 ) {
      postComment($(this).closest('.wip'));
    }
  });

  $postList.on('click', '.btn-submit-comment', function() {
    postComment($(this).closest('.wip'));
    return false;
  });

});