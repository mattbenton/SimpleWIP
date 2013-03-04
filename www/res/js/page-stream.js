$(function() {
  var $postText = $('#post-text');
  var $postTags = $('#post-tags');

  var $postList     = $('.wip-list');
  var $postTemplate = $('#post-template').removeAttr('id').remove();

  var apiUser = null;

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

  authEvents.on('login', function(event, user) {
    // console.log('loggd i', user.email);
    api.getUser(user.email, function(user) {
      apiUser = user;
      console.log('got api user: ', user);
    });
  });

  api.onPost(function(post) {
    var $post = $postTemplate.clone().prependTo($postList);
    $post.find('.wip-name').text(post.user.name);
    $post.find('.wip-message').text(post.message);

    // var tags = ['jQuery'];
    var tags = post.tags;
    var tagHtml = '';
    for ( var i = 0; i < tags.length; i++ ) {
      tagHtml += '<a href="#' + tags[i] + '">#' + tags[i] + '</a> ';
    }
    $post.find('.wip-tags').html(tagHtml);

    $post.show();
  });

});