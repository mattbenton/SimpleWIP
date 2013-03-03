<? require_once('./inc/head.php'); ?>
    <style>

    /* GLOBAL STYLES
    -------------------------------------------------- */
    /* Padding below the footer and lighter body text */

    body {
      padding-bottom: 40px;
      color: #5a5a5a;
	  
	  font-family: 'Raleway', sans-serif;
	  font-family: 'Lato', sans-serif;
    }



    /* CUSTOMIZE THE NAVBAR
    -------------------------------------------------- */

    /* Special class on .container surrounding .navbar, used for positioning it into place. */
    .navbar-wrapper {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      z-index: 10;
      margin-top: 20px;
      margin-bottom: -90px; /* Negative margin to pull up carousel. 90px is roughly margins and height of navbar. */
    }
    .navbar-wrapper .navbar {

    }

    /* Remove border and change up box shadow for more contrast */
    .navbar .navbar-inner {
      border: 0;
      -webkit-box-shadow: 0 2px 10px rgba(0,0,0,.25);
         -moz-box-shadow: 0 2px 10px rgba(0,0,0,.25);
              box-shadow: 0 2px 10px rgba(0,0,0,.25);
    }

    /* Downsize the brand/project name a bit */
    .navbar .brand {
      padding: 14px 20px 16px; /* Increase vertical padding to match navbar links */
      font-size: 16px;
      font-weight: 300;
      text-shadow: 0 -1px 0 rgba(0,0,0,.5);
    }
	.navbar .brand span {
		font-weight: 900;
		color: #ccc;
		font-style: italic;
	}

    /* Navbar links: increase padding for taller navbar */
    .navbar .nav > li > a {
      padding: 15px 20px;
    }

    /* Offset the responsive button for proper vertical alignment */
    .navbar .btn-navbar {
      margin-top: 10px;
    }



    /* CUSTOMIZE THE CAROUSEL
    -------------------------------------------------- */

    /* Carousel base class */
    .carousel {
      margin-bottom: 60px;
    }

    .carousel .container {
      position: relative;
      z-index: 9;
    }

    .carousel-control {
      height: 80px;
      margin-top: 0;
      font-size: 120px;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
      background-color: transparent;
      border: 0;
      z-index: 10;
    }

    .carousel .item {
      height: 500px;
    }
    .carousel img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 500px;
    }

    .carousel-caption {
      background-color: transparent;
      position: static;
      max-width: 550px;
      padding: 0 20px;
      margin-top: 200px;
    }
    .carousel-caption h1,
    .carousel-caption .lead {
      margin: 0;
      line-height: 1.25;
      color: #fff;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
    }
    .carousel-caption .btn {
      margin-top: 10px;
    }



    /* MARKETING CONTENT
    -------------------------------------------------- */

    /* Center align the text within the three columns below the carousel */
    .marketing .span4 {
      text-align: center;
    }
    .marketing h2 {
      font-weight: normal;
    }
    .marketing .span4 p {
      margin-left: 10px;
      margin-right: 10px;
    }


    /* Featurettes
    ------------------------- */

    .featurette-divider {
      margin: 80px 0; /* Space out the Bootstrap <hr> more */
    }
    .featurette {
      padding-top: 120px; /* Vertically center images part 1: add padding above and below text. */
      overflow: hidden; /* Vertically center images part 2: clear their floats. */
    }
    .featurette-image {
      margin-top: -120px; /* Vertically center images part 3: negative margin up the image the same amount of the padding to center it. */
    }

    /* Give some space on the sides of the floated elements so text doesn't run right into it. */
    .featurette-image.pull-left {
      margin-right: 40px;
    }
    .featurette-image.pull-right {
      margin-left: 40px;
    }

    /* Thin out the marketing headings */
    .featurette-heading {
      font-size: 50px;
      font-weight: 300;
      line-height: 1;
      letter-spacing: -1px;
    }



    /* RESPONSIVE CSS
    -------------------------------------------------- */

    @media (max-width: 979px) {

      .container.navbar-wrapper {
        margin-bottom: 0;
        width: auto;
      }
      .navbar-inner {
        border-radius: 0;
        margin: -20px 0;
      }

      .carousel .item {
        height: 500px;
      }
      .carousel img {
        width: auto;
        height: 500px;
      }

      .featurette {
        height: auto;
        padding: 0;
      }
      .featurette-image.pull-left,
      .featurette-image.pull-right {
        display: block;
        float: none;
        max-width: 40%;
        margin: 0 auto 20px;
      }
    }


    @media (max-width: 767px) {

      .navbar-inner {
        margin: -20px;
      }

      .carousel {
        margin-left: -20px;
        margin-right: -20px;
      }
      .carousel .container {

      }
      .carousel .item {
        height: 300px;
      }
      .carousel img {
        height: 300px;
      }
      .carousel-caption {
        width: 65%;
        padding: 0 70px;
        margin-top: 100px;
      }
      .carousel-caption h1 {
        font-size: 30px;
      }
      .carousel-caption .lead,
      .carousel-caption .btn {
        font-size: 18px;
      }

      .marketing .span4 + .span4 {
        margin-top: 40px;
      }

      .featurette-heading {
        font-size: 30px;
      }
      .featurette .lead {
        font-size: 18px;
        line-height: 1.5;
      }

    }
    </style>

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
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown">User <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Login</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div><!--/.nav-collapse -->
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
              <h1>WIP for those with no time.</h1>
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

	
    <!-- TokBox
    ================================================== -->
    <!--    <div id="myPublisherDiv"></div>
        <script type="text/javascript">
          // Initialize API key, session, and token...
          // Think of a session as a room, and a token as the key to get in to the room
          // Sessions and tokens are generated on your server and passed down to the client
          var apiKey = "23136542";
          var sessionId = "2_MX4yMzEzNjU0Mn4xMjcuMC4wLjF-U2F0IE1hciAwMiAyMDowOTowOCBQU1QgMjAxM34wLjEwNzYyNTE5fg";
          var token = "T1==cGFydG5lcl9pZD0yMzEzNjU0MiZzZGtfdmVyc2lvbj10YnJ1YnktdGJyYi12MC45MS4yMDExLTAyLTE3JnNpZz01MjE2NmIzOTE0Yzk3Njc4ZWMyODEwNmVjOWQ0NDI4ZmJjODViMjk3OnJvbGU9cHVibGlzaGVyJnNlc3Npb25faWQ9JmNyZWF0ZV90aW1lPTEzNjIyODM3NDgmbm9uY2U9MC44NzU5MzYyMjI2NTA4NzgxJmV4cGlyZV90aW1lPTEzNjIzNzAxNDUmY29ubmVjdGlvbl9kYXRhPQ==";

          // Initialize session, set up event listeners, and connect
          var session = TB.initSession(sessionId);
          session.addEventListener('sessionConnected', sessionConnectedHandler);
          session.connect(apiKey, token);
          
          function sessionConnectedHandler(event) {
            var publisher = TB.initPublisher(apiKey, 'myPublisherDiv');
            session.publish(publisher);
          }
        </script>
	-->


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
        <p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
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
			  <input type="password" id="passInp" placeholder="... don't forget" required>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="againInp">Password (Again)</label>
			<div class="controls">
			  <input type="password" id="againInp" placeholder="... we know this is annoying" data-validation-matches-match="passInp">
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
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./res/js/holder.js"></script>
	
	<script>
		$().ready(function(){
			$("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
			
			var fireb = new Firebase('https://simplewip.firebaseio.com/');
			//fireb.set('test', {'hello': 'world', 'and': 123});
			
			var authEvents = {};
			$.addEventModel(authEvents);
			
			var authError, authLoggedIn;
			var authClient = new FirebaseAuthClient(fireb, function(err, user) {
				authError = null;
				authUser = null;
				if (err) {
					// an error occurred while attempting login
					authEvents.trigger('error', err);
					authError = err;
				} else if (user) {
					// user authenticated with Firebase
					authEvents.trigger('login', user);
					authUser = user;
				} else {
					// no user logged in
					authEvents.trigger('none');
				}
			});
			
			$('#sign-up-now').click(function(e){
				e.preventDefault();
				var email = $('#emailInp').val();
				var pass = $('#passInp').val();
				var again = $('#againInp').val();
				if (email && pass && again && pass == again){
					$('#signupModal').loaderlay({message: 'Working ...'});
					$('#signup-alert').hide();
					
					authClient.createUser(email, pass, function(err, user) {
					  if (!err) {
						Loaderlay.hideAll();
						$('#signupModal').loaderlay({message: 'Loggin in ...'});
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
			
			$('#log-in-now').click(function(e){
				e.preventDefault();
				var email = $('#emailInpLogin').val();
				var pass = $('#passInpLogin').val();
				if (email && pass){
					$('#loginModal').loaderlay({message: 'Thinking ...'});
					$('#login-alert').hide();
					
					authClient.logout();
					authClient.login('password', {
					  email: email,
					  password: pass,
					  rememberMe: true
					});
					
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
						//console.log('user', user);
					});
				}
			});
		});
	</script>

<? require_once('./inc/foot.php'); ?>