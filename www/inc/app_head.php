<?
  if (!empty($page) && file_exists('./res/css/' . $page . '.css')){
    ?><link href="./res/css/<?=$page?>.css" rel="stylesheet"><?
  }
?>
</head><body>

<div class="container app-container">

  <div class="row-fluid">
    <div class="span12">
      <ul class="nav">

        <a id="logout">Logout</a>

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

      </div>
    </ul>
  </div>