/*jshint unused: false */
/*globals Firebase: true, Team:true, User:true */

var api = {};

$(function() {
  var email = 'matt@mattbenton.net';
  var team  = 'awesome';

  api.getTeamUserEmails(team);
});

(function() {

  var F = new Firebase('https://simplewip.firebaseio.com/');

  var encodeKey = function ( key ) {
    return encodeURIComponent(key).replace(/\./g, '%2E');
  };

  var decodeKey = function ( key ) {
    return decodeURIComponent(key.replace(/%2E/g, '.'));
  };

  var error = function ( namespace, message ) {
    if ( message ) {
      console.error('[%s]', namespace, message);
    } else {
      console.error(message);
    }
  };

  var hasRequired = function ( namespace, obj, items ) {
    if ( typeof items === 'string' ) {
      items = items.replace(/\s/g, '').split(',');
    }
    for ( var i = 0; i < items.length; i++ ) {
      if ( !obj[items[i]] ) {
        error(namespace, 'Missing required option "' + items[i] + '"');
        return false;
      }
    }
    return true;
  };

  api.setUser = function ( email, data, callback ) {
    var ref = F.child('user/' + encodeKey(email));
    ref.update(data, function() {
      if ( callback ) {
        callback();
      }
    });
  };

  api.getUser = function ( email, callback, timeout ) {
    F.child('user/' + encodeKey(email)).once('value', function(item) {
      callback(item.val());
    });
  };

  api.createTeam = function ( name, data ) {
    var ref = F.child('team/' + encodeKey(name));
    ref.set(data);
  };

  api.getTeam = function ( name, callback ) {
    F.child('user/' + encodeKey(name)).once('value', function(item) {
      callback(item.val());
    });
  };

  api.userJoinTeam = function ( userEmail, teamName ) {
    var ref = F.child('teamUsers/' + encodeKey(teamName) + '/' + encodeKey(userEmail));
    ref.set(true);
  };

  api.createPost = function ( options ) {
    var defaults = {
      message: null,
      email: null,
      tags: []
    };

    var o = $.extend(defaults, options);
    if ( !hasRequired('createPost', o, 'email,message') ) {
      return;
    }

    var post = {
      email:   o.email,
      message: o.message
    };

    var timestamp = Date.now();

    // Save actual post
    var postRef = F.child('posts').push();
    var postId  = postRef.name();
    postRef.setWithPriority(post, timestamp);

    // Save reference to post on user


    // var posts = F.child('post');
    // var postRef = posts.push();
    // postRef.setWithPriority(post, timestamp);
    // var postId = postRef.name();
    // console.log('created post: ', postId);

    var postsUri = 'user/' + encodeKey(o.email) + '/posts';

    var userPosts   = F.child(postsUri);
    var userPostRef = userPosts.push();
    var postUri     = postsUri + '/' + userPostRef.name();
    userPostRef.setWithPriority(post, timestamp);

    for ( var i = 0; i < o.tags.length; i++ ) {
      var tag = o.tags[i];
      var tagListRef = F.child('tags/' + encodeKey(tag)).push();

      tagListRef.setWithPriority({
        id:  userPostRef.name(),
        uri: postsUri
      }, timestamp);
    }
  };

  api.getPostsByUser = function ( email, callback ) {
    F.child('user/' + encodeKey(email) + '/posts').on('child_added', function(item) {
      if ( callback ) {
        callback(item.val());
      }
      console.log(item.val());
    });
  };

  api.getPostsByTag = function ( tag ) {
    var tagList = F.child('tags/' + encodeKey(tag));
    tagList.on('child_added', function(item) {
      var link = item.val();
      F.child(link.uri + '/' + link.id).once('value', function(post) {
        console.log(post.val());
      });
    });
  };

  api.getTeamUserEmails = function ( teamName, callback ) {
    F.child('teamUsers/' + encodeKey(teamName)).on('child_added', function(item) {
      if ( callback ) {
        callback(decodeKey(item.name()));
      }
    });
  };

}());