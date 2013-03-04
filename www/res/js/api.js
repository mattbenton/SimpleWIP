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

    var createUser = function ( org ) {
      var orgId = org && org.id || options.orgId;

      var actionCount = 0;
      var onSave = function () {
        actionCount++;
        if ( actionCount === 2 ) {
          callback();
        }
      };

      api.setUser(options.userEmail, {
        name:  options.userName,
        email: options.userEmail,
        org:   options.orgName,
        orgId: orgId
      }, onSave);

      api.addUserToOrg({
        email: options.userEmail,
        orgId:     orgId
      }, onSave);
    };

    if ( !options.orgId ) {
      api.createOrg({
        name: options.orgName
      }, function(org) {
        createUser(org);
      });
    } else {
      createUser();
    }
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
    // if ( userCache[email] ) {
    //   console.log('exit earky');
    //   return userCache[email];
    // }

    api.querySingle('user/' + encodeKey(email), callback);
    return;

    console.log('getUser');

    F.child('orgUsers').on('child_added', function(orgItem) {
      var org = orgItem.val();
      console.log(org);
    });

    F.child('user/' + encodeKey(email)).once('value', function(item) {
      var user = item.val();
      console.log('got user');
      userCache[email] = user;
      // callback(user);
    });
  };

  api.createOrg = function ( data, callback ) {
    if ( !hasRequired('createOrg', data, 'name') ) {
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

  api.getOrg = function ( id, callback ) {
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

    F.child('user/' + encodeKey(options.email)).update({
      orgId: options.orgId
    });

    // api.setUser({
    //   orgId: options.orgId
    // }, function)
  };

  api.addUserToOrg({ email: 'tarwin@gmail.com', orgId: '-IonVblzI_JDb5bVx8-b' });

  api.onOrgUsers = function ( orgId, callback ) {
    F.child('orgUsers/' + orgId).on('child_added', function(item) {
      var email = decodeKey(item.name());
      api.getUser(email, function(user) {
        if ( user ) {
          user.orgId = orgId;
          callback(user);
        }
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
      // callback(post);

      // console.log(post.email);

      api.getUser(post.email, function(user) {
        // console.log(user);
        if ( user ) {
          post.user = user;
          callback(post);
        }
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

  var queryCache = {};

  api.querySingle = function ( key, callback ) {
    var query = queryCache[key];
    if ( query ) {
      // console.log('adding listener for key', key);
      query.listeners.push(callback);
    } else {
      query = {
        key: key,
        listeners: [callback]
      };

      // console.log('create query: ', key);

      queryCache[key] = query;

      F.child(key).once('value', function(item) {
        for ( var i = 0; i < query.listeners.length; i++ ) {
          var listener = query.listeners[i];
          if ( listener ) {
            listener(item.val());
          }
        }
        delete queryCache[key];
      });
    }
  };

}());


// query all posts
  // get post
  // get user


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

// MD5
(function(a){function b(a,b){var c=(a&65535)+(b&65535),d=(a>>16)+(b>>16)+(c>>16);return d<<16|c&65535}function c(a,b){return a<<b|a>>>32-b}function d(a,d,e,f,g,h){return b(c(b(b(d,a),b(f,h)),g),e)}function e(a,b,c,e,f,g,h){return d(b&c|~b&e,a,b,f,g,h)}function f(a,b,c,e,f,g,h){return d(b&e|c&~e,a,b,f,g,h)}function g(a,b,c,e,f,g,h){return d(b^c^e,a,b,f,g,h)}function h(a,b,c,e,f,g,h){return d(c^(b|~e),a,b,f,g,h)}function i(a,c){a[c>>5]|=128<<c%32,a[(c+64>>>9<<4)+14]=c;var d,i,j,k,l,m=1732584193,n=-271733879,o=-1732584194,p=271733878;for(d=0;d<a.length;d+=16)i=m,j=n,k=o,l=p,m=e(m,n,o,p,a[d],7,-680876936),p=e(p,m,n,o,a[d+1],12,-389564586),o=e(o,p,m,n,a[d+2],17,606105819),n=e(n,o,p,m,a[d+3],22,-1044525330),m=e(m,n,o,p,a[d+4],7,-176418897),p=e(p,m,n,o,a[d+5],12,1200080426),o=e(o,p,m,n,a[d+6],17,-1473231341),n=e(n,o,p,m,a[d+7],22,-45705983),m=e(m,n,o,p,a[d+8],7,1770035416),p=e(p,m,n,o,a[d+9],12,-1958414417),o=e(o,p,m,n,a[d+10],17,-42063),n=e(n,o,p,m,a[d+11],22,-1990404162),m=e(m,n,o,p,a[d+12],7,1804603682),p=e(p,m,n,o,a[d+13],12,-40341101),o=e(o,p,m,n,a[d+14],17,-1502002290),n=e(n,o,p,m,a[d+15],22,1236535329),m=f(m,n,o,p,a[d+1],5,-165796510),p=f(p,m,n,o,a[d+6],9,-1069501632),o=f(o,p,m,n,a[d+11],14,643717713),n=f(n,o,p,m,a[d],20,-373897302),m=f(m,n,o,p,a[d+5],5,-701558691),p=f(p,m,n,o,a[d+10],9,38016083),o=f(o,p,m,n,a[d+15],14,-660478335),n=f(n,o,p,m,a[d+4],20,-405537848),m=f(m,n,o,p,a[d+9],5,568446438),p=f(p,m,n,o,a[d+14],9,-1019803690),o=f(o,p,m,n,a[d+3],14,-187363961),n=f(n,o,p,m,a[d+8],20,1163531501),m=f(m,n,o,p,a[d+13],5,-1444681467),p=f(p,m,n,o,a[d+2],9,-51403784),o=f(o,p,m,n,a[d+7],14,1735328473),n=f(n,o,p,m,a[d+12],20,-1926607734),m=g(m,n,o,p,a[d+5],4,-378558),p=g(p,m,n,o,a[d+8],11,-2022574463),o=g(o,p,m,n,a[d+11],16,1839030562),n=g(n,o,p,m,a[d+14],23,-35309556),m=g(m,n,o,p,a[d+1],4,-1530992060),p=g(p,m,n,o,a[d+4],11,1272893353),o=g(o,p,m,n,a[d+7],16,-155497632),n=g(n,o,p,m,a[d+10],23,-1094730640),m=g(m,n,o,p,a[d+13],4,681279174),p=g(p,m,n,o,a[d],11,-358537222),o=g(o,p,m,n,a[d+3],16,-722521979),n=g(n,o,p,m,a[d+6],23,76029189),m=g(m,n,o,p,a[d+9],4,-640364487),p=g(p,m,n,o,a[d+12],11,-421815835),o=g(o,p,m,n,a[d+15],16,530742520),n=g(n,o,p,m,a[d+2],23,-995338651),m=h(m,n,o,p,a[d],6,-198630844),p=h(p,m,n,o,a[d+7],10,1126891415),o=h(o,p,m,n,a[d+14],15,-1416354905),n=h(n,o,p,m,a[d+5],21,-57434055),m=h(m,n,o,p,a[d+12],6,1700485571),p=h(p,m,n,o,a[d+3],10,-1894986606),o=h(o,p,m,n,a[d+10],15,-1051523),n=h(n,o,p,m,a[d+1],21,-2054922799),m=h(m,n,o,p,a[d+8],6,1873313359),p=h(p,m,n,o,a[d+15],10,-30611744),o=h(o,p,m,n,a[d+6],15,-1560198380),n=h(n,o,p,m,a[d+13],21,1309151649),m=h(m,n,o,p,a[d+4],6,-145523070),p=h(p,m,n,o,a[d+11],10,-1120210379),o=h(o,p,m,n,a[d+2],15,718787259),n=h(n,o,p,m,a[d+9],21,-343485551),m=b(m,i),n=b(n,j),o=b(o,k),p=b(p,l);return[m,n,o,p]}function j(a){var b,c="";for(b=0;b<a.length*32;b+=8)c+=String.fromCharCode(a[b>>5]>>>b%32&255);return c}function k(a){var b,c=[];c[(a.length>>2)-1]=undefined;for(b=0;b<c.length;b+=1)c[b]=0;for(b=0;b<a.length*8;b+=8)c[b>>5]|=(a.charCodeAt(b/8)&255)<<b%32;return c}function l(a){return j(i(k(a),a.length*8))}function m(a,b){var c,d=k(a),e=[],f=[],g;e[15]=f[15]=undefined,d.length>16&&(d=i(d,a.length*8));for(c=0;c<16;c+=1)e[c]=d[c]^909522486,f[c]=d[c]^1549556828;return g=i(e.concat(k(b)),512+b.length*8),j(i(f.concat(g),640))}function n(a){var b="0123456789abcdef",c="",d,e;for(e=0;e<a.length;e+=1)d=a.charCodeAt(e),c+=b.charAt(d>>>4&15)+b.charAt(d&15);return c}function o(a){return unescape(encodeURIComponent(a))}function p(a){return l(o(a))}function q(a){return n(p(a))}function r(a,b){return m(o(a),o(b))}function s(a,b){return n(r(a,b))}function t(a,b,c){return b?c?r(b,a):s(b,a):c?p(a):q(a)}"use strict",typeof define=="function"&&define.amd?define(function(){return t}):a.md5=t})(this);