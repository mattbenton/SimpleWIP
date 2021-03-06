<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SimpleWIP: WIP for those with no time.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	<script src="./res/js/jquery-1.8.3.min.js"></script>
	<script src="./res/js/jqBootstrapValidation.js"></script>
	<script src="./res/bootstrap/js/bootstrap.js"></script>
	<script src="./res/js/loaderlay.js"></script>
	<script src="./res/js/event.js"></script>
  <script src="./res/chosen/chosen.jquery.js"></script>

  <!--
	<script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>
	<script type="text/javascript" src="https://cdn.firebase.com/v0/firebase-auth-client.js"></script>
  -->
  <script type='text/javascript' src="/res/js/firebase.js"></script>
  <script type="text/javascript" src="/res/js/firebase-auth-client.js"></script>
  <script src="/res/js/api.js"></script>

    <!-- Le styles -->
    <link href="./res/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="./res/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

	<link href="./res/bootstrap/css/font-awesome.css" rel="stylesheet">
		
	<link href="./res/css/base.css" rel="stylesheet">
  <link href="./res/chosen/chosen.css" rel="stylesheet">
  <link href="./res/css/global.css" rel="stylesheet">
  <link href="./res/css/home.css" rel="stylesheet">


	<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,900,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900,400italic,900italic' rel='stylesheet' type='text/css'>
		
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="./res/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./res/img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./res/img/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./res/img/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="./res/img/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="./res/img/ico/favicon.png">
									   
	<script>
		var authClient;
		// so we can call logout later
		
		var authEvents = {};
		$().ready(function(){
			$.addEventModel(authEvents);
      $(".chzn-select").chosen({
        create_option: true,
        create_option_text: 'Create tag',
        persistent_create_option: true
      })
      $(".wip-follow-tooltip").tooltip({
        title: 'Follow tag'
      })

		});
	</script>