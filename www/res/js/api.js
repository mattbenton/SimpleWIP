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

  var userCache = {};

  api.signUp = function ( options, callback ) {
    if ( !hasRequired('signUp', options, 'userName, userEmail, orgName') ) {
      return;
    }

    if ( !callback ) {
      return error('signUp', 'missing callback');
    }

    var savedUser = false;
    var savedOrg  = false;

    var onSave = function () {
      if ( savedUser && savedOrg ) {
        callback();
      }
    };

    api.setUser(options.userEmail, {
      name:  options.userName,
      email: options.userEmail,
      org:   options.orgName
    }, function() {
      savedUser = true;
      onSave();
    });

    api.setTeam(options.orgName, {
      name: options.orgName
    }, function() {
      savedOrg = true;
      onSave();
    });
  };

  api.setUser = function ( email, data, callback ) {
    var ref = F.child('user/' + encodeKey(email));
    ref.update(data, function() {
      if ( callback ) {
        callback();
      }
    });
  };

  api.getUser = function ( email, callback ) {
    if ( userCache[email] ) {
      return userCache[email];
    }

    F.child('user/' + encodeKey(email)).once('value', function(item) {
      var user = item.val();
      userCache[email] = user;
      callback(user);
    });
  };

  api.createOrg = function ( data, callback ) {
    if ( !hasRequired('createOrganisation', data, 'name') ) {
      return;
    }

    var orgRef = F.child('orgs').push();
    var orgId  = orgRef.name();

    orgRef.setWithPriority(data, Date.now(), function() {
      if ( callback ) {
        data.id = orgId;
        callback(data);
      }
    });
  };

  api.updateOrg = function ( data, callback ) {
    if ( !hasRequired('updateOrg', data, 'id') ) {
      return;
    }

    var id = data.id;
    delete data.id;

    F.child('orgs/' + id).update(data, callback);
  };

  api.getOrg = function ( orgId, callback ) {
    F.child('orgs/' + id).once('value', function(item) {
      callback(item.val());
    });
  };

  api.onTag = function ( callback ) {
    F.child('tags').on('child_added', function(item) {
      callback(item.val());
    });
  };

  api.addUserToOrg = function ( options, callback ) {
    if ( !hasRequired('addUserToOrg', options, 'email, orgId') ) {
      return;
    }

    var completeCount = 0;
    var onComplete = function() {
      if ( completeCount === 2 ) {
        callback();
      }
    };

    var ref = F.child('orgUsers/' + encodeKey(options.orgId) + '/' + encodeKey(options.email));
    ref.set(true, callback);

    // api.setUser({
    //   orgId: options.orgId
    // }, function)
  };

  api.onOrgUsers = function ( orgId, callback ) {
    F.child('orgUsers/' + orgId).on('child_added', function(item) {
      api.getUser(item.val().email, function(user) {
        user.orgId = orgId;
        callback(user);
      });
    });
  };

  api.setTeam = function ( name, data, callback ) {
    var ref = F.child('team/' + encodeKey(name));
    ref.update(data, function() {
      if ( callback ) {
        callback();
      }
    });
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

  api.onUpdateProfile = function ( email, callback ) {
    F.child('user/' + encodeKey(email)).on('value', function(item) {
      if ( callback ) {
        callback(item.val());
      }
    });
  };

  api.createPost = function ( apiUser, options ) {
    var defaults = {
      message: null,
      tags: [],
      help: false
    };

    if ( !apiUser ) {
      return error('createPost', 'missing apiUser');
    }

    var o = $.extend(defaults, options);
    if ( !hasRequired('createPost', o, 'tags, message') ) {
      return;
    }

    var timestamp = Date.now();

    var post = {
      email:     apiUser.email,
      message:   o.message,
      tags:      o.tags,
      timestamp: timestamp,
      help:      o.help
    };

    // Save actual post
    var postRef = F.child('posts').push();
    var postId  = postRef.name();
    postRef.setWithPriority(post, timestamp);

    // Save user post reference;
    var userPostRef = F.child('userPosts/' + encodeKey(apiUser.email)).push();
    userPostRef.setWithPriority(postId, timestamp);

    // Save tags
    for ( var i = 0; i < o.tags.length; i++ ) {
      var tag = o.tags[i];
      var tagListRef = F.child('tagPosts/' + encodeKey(tag)).push();
      tagListRef.setWithPriority(postId, timestamp);

      F.child('tags/' + encodeKey(tag)).set({ name: tag });
    }
  };

  api.onPost = function ( callback ) {
    F.child('posts').on('child_added', function(item) {
      var post = item.val();

      var user = userCache[post.email];
      if ( user ) {
        post.user = user;
        return callback(post);
      }

      api.getUser(post.email, function(user) {
        post.user = user;
        callback(post);
      });
    });
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

function timeSince ( ts ) {
  var now  = Date.now();
  var dt   = (now - ts) / 1000;
  var dayT = Math.floor(dt / 86400);

  if ( dt < 60 )    return 'just now';
  if ( dt < 120 )   return '1 minute ago';
  if ( dt < 3600 )  return Math.floor(dt / 60) + ' minutes ago';
  if ( dt < 7200 )  return '1 hour ago';
  if ( dt < 86400 ) return Math.floor(dt / 3600) + ' hours ago';
  
  if ( dayT === 1 ) return 'Yesterday';
  if ( dayT < 7 )   return dayT + ' days ago';
  if ( dayT < 31 )  return Math.ceil(dayT/7) + ' weeks ago';
}