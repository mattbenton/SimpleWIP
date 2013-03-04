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

    api.createPost(apiUser, {
      message: postText,
      tags:    tags
    });
  });

  var onUpdateProfile = function ( user ) {
    $('.user-name').text(user.name);
  };

  api.onUpdateProfile('m@b.com', function(user) {
    apiUser = user;
    console.log('got profile', user);
    $('.user-name').text(user.name);
  });

  authEvents.on('login', function(event, user) {
    api.onUpdateProfile(user.email, onUpdateProfile);
  });

  api.onPost(function(post) {
    var $post = $postTemplate.clone().insertAfter($createPost);
    $post.find('.wip-name').text(post.user.name);
    $post.find('.wip-message').text(post.message);
    $post.find('.wip-time').text(timeSince(post.timestamp));

    post.tags = post.tags || [];

    // var tags = ['jQuery'];
    var tags = post.tags;
    var tagHtml = '';
    for ( var i = 0; i < tags.length; i++ ) {
      tagHtml += '<span class="tag">#' + tags[i] + '</span>';
    }
    $post.find('.wip-tags').html(tagHtml);

    $post.show();
  });

  $postTags.find('option').remove().trigger('liszt:updated');
  api.onTag(function(tag) {
    console.log(tag);
    $postTags.append('<option value="' + tag.name + '">' + tag.name + '</option>').trigger('liszt:updated');
  });

  $('#profileModal').on('shown', function() {
    $('#nameInp').val(apiUser.name);
    $('#orgInp').val(apiUser.org);
    console.log('load profile for user ', apiUser.email);
  });

});