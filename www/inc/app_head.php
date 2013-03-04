<?
  if (!empty($page) && file_exists('./res/css/' . $page . '.css')){
    ?><link href="./res/css/<?=$page?>.css" rel="stylesheet"><?
  }
?>
</head><body>

<div class="container app-container">

  <div class="navbar navbar-inverse">
    <div class="navbar-inner">
      <a class="brand" href="#">Simple<span>WIP</span></a>

      <ul class="unstyled">
        <li class="active"><a href="#">Organization</a></li>
        <li><a href="#">Team</a></li>
        <li><a href="#">World</a></li>
      </ul>

      <ul class="unstyled logout">
        <li><a href="#" id="logout">Logout</a></li>
      </ul>

      <script>
        $().ready(function(){
        
          var fireb = new Firebase('https://simplewip.firebaseio.com/')

          var firstHit = true;
          authClient = new FirebaseAuthClient(fireb, function(err, user) {
            if (err) {
              // an error occurred while attempting login
              authEvents.trigger('error', err);
            } else if (user) {
              // user authenticated with Firebase
              authEvents.trigger('login', user);
            } else {
              // no user logged in
              authEvents.trigger('none');
              if (firstHit){
                $('body').loaderlay({message: 'Loggin out ...'});
                window.location.href = './';
              }
            }
            firstHit = false;
          });
        
          $('#logout').click(function(){
            $('body').loaderlay({message: 'Logging out ...'});
            authEvents.on('none', function(e){
              window.location.href = './';
            });
            authClient.logout();
          });
        });
      </script>

    </div><!-- /.navbar-inner -->
  </div>
