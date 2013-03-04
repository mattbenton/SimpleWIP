<? require_once('./inc/head.php'); ?>
</head><body>

    <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container">

        <div class="navbar navbar-inverse">
          <div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#">Simple<span>WIP</span></a>
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
    </div><!-- /.navbar-wrapper -->

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
          <img src="./res/img/slide1.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1><span class="simple">Simple</span><span class="wip">WIP</span> for those with no time.</h1>
              <p class="lead">Invite your workers to join SimpleWIP and you’re on your way to social business insights and less wasted time.</p>
              <a class="btn btn-large btn-primary" href="#signupModal" id="signup" data-toggle="modal">Sign up today</a>
			  <a class="btn btn-large btn-success" href="#loginModal" id="login" data-toggle="modal">Log in</a>
            </div>
          </div>
        </div>
      </div>
	  <!-- 
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	  -->
    </div><!-- /.carousel -->

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="span4">
          <i class="icon-lock" style="font-size: 96px; color: gold;"></i>
          <h2>Private</h2>
          <p>Your WIPs are private, only viewable to your organisation or team.</p>
        </div><!-- /.span4 -->
        <div class="span4">
          <i class="icon-leaf" style="font-size: 96px; color: darkgreen;"></i>
          <h2>Unobtrusive</h2>
          <p>2 minutes a day. We stay out of your way so you don't waste time.</p>
        </div><!-- /.span4 -->
        <div class="span4">
          <i class="icon-comments" style="font-size: 96px; color: lightblue;"></i>
          <h2>Social</h2>
          <p>Get social insights without the distraction of a <em>social network</em>.</p>
        </div><!-- /.span4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2013 SimpleWUIP, Inc. &middot; <a href="mailto:contact@simplewip.com">Contact</a></p>
      </footer>

    </div><!-- /.container -->
	
    <!-- modals
    ================================================== -->
	
	<!-- Signup -->
	<div id="signupModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true" data-backdrop="static">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="signupModalLabel">Sign Up</h3>
	  </div>
	  <div class="modal-body">
		  
		<div class="alert alert-error" style="display: none;" id="signup-alert"></div>
		  
		<p>Enter your details to sign up.</p>
		<form class="form-horizontal">
		  <div class="control-group">
			<label class="control-label" for="emailInp">Email</label>
			<div class="controls">
			  <input type="email" id="emailInp" placeholder="... your identity" required>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="passInp">Password</label>
			<div class="controls">
			  <input type="password" name="passInp" id="passInp" placeholder="... don't forget" required>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="againInp">Password (Again)</label>
			<div class="controls">
			  <input type="password" id="againInp" placeholder="... we know this is annoying" data-validation-matches-match="passInp">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label" for="nameInp">Name</label>
			<div class="controls">
			  <input type="text" id="nameInp" placeholder="... what you was born with" required>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label" for="orgInp">Organisation</label>
			<div class="controls">
			  <input type="text" id="orgInp" placeholder="... the man!" required>
			</div>
		  </div>
		  
		</form>
	  </div>
	  <div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button class="btn btn-primary" id="sign-up-now">Sign Up</button>
	  </div>
	</div>
	
	<!-- Login -->
	<div id="loginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="loginModalLabel">Log In</h3>
	  </div>
	  <div class="modal-body">

		<div class="alert alert-error" style="display: none;" id="login-alert"></div>
		  
		<form class="form-horizontal">
		  <div class="control-group">
			<label class="control-label" for="emailInpLogin">Email</label>
			<div class="controls">
			  <input type="email" id="emailInpLogin" placeholder="... your identity" required>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="passInpLogin">Password</label>
			<div class="controls">
			  <input type="password" id="passInpLogin" placeholder="... you remember right?" required>
			</div>
		  </div>
		</form>
		  
	  </div>
	  <div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button class="btn btn-primary" id="log-in-now">Log In</button>
	  </div>
	</div>
	
    <!-- Le javascript
    ================================================== -->
	
	<script>
		$().ready(function(){
			$("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
			
			var fireb = new Firebase('https://simplewip.firebaseio.com/');
			//fireb.set('test', {'hello': 'world', 'and': 123});
			
			var firstHit = true;
			authClient = new FirebaseAuthClient(fireb, function(err, user) {
				authError = null;
				authUser = null;
				if (err) {
					// an error occurred while attempting login
					authEvents.trigger('error', err);
				} else if (user) {
					// user authenticated with Firebase
					authEvents.trigger('login', user);
					if (firstHit){
						$('body').loaderlay({message: 'Loggin in ...'});
						window.location.href = './app.php?p=stream';
					}
				} else {
					// no user logged in
					authEvents.trigger('none');
				}
				firstHit = false;
			});
			
			$('#signupModal input').on('keydown', function(e){
				if (e.keyCode == 13){
					$('#sign-up-now').trigger('click');
				}
			});
			
			$('#signupModal').on('shown', function() {
				$("#emailInp").focus();
			})
			
			$('#sign-up-now').click(function(e){
				e.preventDefault();
				
				var email = $('#emailInp').val();
				var pass = $('#passInp').val();
				var again = $('#againInp').val();
				var name = $('#nameInp').val();
				var org = $('#orgInp').val();
				
				if (email && pass && again && pass == again && name && org){
					$('#signupModal').loaderlay({message: 'Working ...'});
					$('#signup-alert').hide();
					
					authClient.createUser(email, pass, function(err, user) {
					  if (!err) {
						Loaderlay.hideAll();
						$('#signupModal').loaderlay({message: 'Loggin in ...'});
						
						// log user in
						authEvents.on('error', function(e, error){
							Loaderlay.hideAll();
							if (error.code == 'INVALID_USER'){
								$('#signup-alert').show().html('Invalid email address.');
							}else if (error.code == 'INVALID_PASSWORD'){
								$('#signup-alert').show().html('Wrong password. Hope you remember it!');
							}else{
								$('#signup-alert').show().html('Error: ' + error.code);
							}
						});
						authEvents.on('login', function(e, user){
							// creat user and
              api.signUp({
                userName:  name,
                userEmail: email,
                orgName:   org
              }, function() { 
                window.location.href = './app.php?p=stream';
              });
						});
						
						authClient.login('password', {
						  email: email,
						  password: pass,
						  rememberMe: true
						});
						
					  }else{
						Loaderlay.hideAll();
						$('#signup-alert').show();
						if (err.code == 'EMAIL_TAKEN'){
							$('#signup-alert').html('A user with that email is already on our system. Please log in instead.');
						}else{
							$('#signup-alert').html('ERROR: ' + err.code);
						}
					  }
					});
				}
			});

			$('#loginModal input').on('keydown', function(e){
				if (e.keyCode == 13){
					$('#log-in-now').trigger('click');
				}
			});
			
			$('#loginModal').on('shown', function() {
				$("#emailInpLogin").focus();
			})
			
			$('#log-in-now').click(function(e){
				e.preventDefault();
				var email = $('#emailInpLogin').val();
				var pass = $('#passInpLogin').val();
				if (email && pass){
					$('#loginModal').loaderlay({message: 'Thinking ...'});
					$('#login-alert').hide();
					
					authEvents.on('error', function(e, error){
						Loaderlay.hideAll();
						if (error.code == 'INVALID_USER'){
							$('#login-alert').show().html('Invalid email address.');
						}else if (error.code == 'INVALID_PASSWORD'){
							$('#login-alert').show().html('Wrong password. Hope you remember it!');
						}else{
							$('#login-alert').show().html('Error: ' + error.code);
						}
					});
					authEvents.on('login', function(e, user){
						$('#loginModal').loaderlay({message: 'Logging in ...'});
						
						// redirect to app
						window.location.href = './app.php?p=stream';
					});
					
					authClient.logout();
					authClient.login('password', {
					  email: email,
					  password: pass,
					  rememberMe: true
					});
				}
			});
		});
	</script>

<? require_once('./inc/foot.php'); ?>
  </body>
</html>