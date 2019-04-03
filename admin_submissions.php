<?php
	session_start();
	if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['acc_type'] == 1))
		header('location:login.php');
?>


<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Admin-Dashboard</title>
		<meta name="description" content="Check participant's submission for Mind Freezer 3.0" />
		<meta name="author" content="SCA WEB TEAM" />
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
		<link rel="icon" href="images/mind_logo1.png">
		
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/button.css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


		<script src="js/modernizr.custom.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		<style>
			body{
				color:#fff;
			}
			.active-tab{
			    background: #5f6f81 !important;
				color: white !important;
			}
			.fas{
				font-size: 2em;
				margin:0em .5em;
			}
			.question-no{
				font-weight:1000;
			    padding-left: 30px;
				width:100px;
				display:inline-block;
			}
			.gn-menu-wrapper.gn-open-all{
				width:100px;
			}
			.gn-scroller{
				width:130px;
			}
			.container-fluid > header{
				padding: 6em 2em;
				padding-left:130px;
				font-size:.8em;
				font-family: 'Lato', Arial, sans-serif;
				font-weight:300;
				min-height: 95vh;
			}
			h1{
				font-family: 'Lato', Arial, sans-serif;
				font-weight:300;
				font-size: 3.2em;
				text-decoration:underline;
			}
			p{
				font-size:1.2em;
				font-weight:400;
			}
			.sub-ans{
				border: 2px solid;
				border-radius: 5px;
				padding:2em 2em;
			}
			.uid, .subid{
				font-weight:800;
				text-decoration:underline;
			}
			.mt-hidden{
				display:none !important;
			}
			#ml5>a:hover{
				color:#5f6f81;
				background:#fff;
			}
			#answer-box{
				resize: none;
				width: 90%;
				height: 300px;
				border: 3px solid #cccccc;
				padding : 1em;
				margin : 1em 2em;
				font-size : 1.3em;
			}
			@media only screen and (max-width: 600px) {
			.fas{
				margin: 0em;
			}
			}
			@media only screen and (max-width: 1030px) {
				#ml5{
					display:none;
				}
			}
			@media only screen and (max-width: 420px) {
				.gn-menu-main > li > a{
					padding:5px 15px;
				}
			}
			
			.ids{
				float:left;
				font-size:1em;
				font-weight:500;
			}
			.icons{
				float:right;
				margin:.5em 0em 0em 0em;
			}
			.sub-head{
				height:50px;
				margin: .8em .5em;
				box-shadow:1px 1px 12px 1px #f0f0f0;
				border-radius: 5px;
				padding: .5em 1em;
				background:#fff;
				color:#34495e;
			}
			.sub-head:hover{
				background:#394b5c;
				color:#fff;
				cursor:pointer;
			}
			.sub-head:active{
				margin: .3em .3em;
			}
			.correction{
				float:left;
			}
			
			.footer-nav{
				padding-left:130px;
				background-color:#222f3d;
				text-align:center;
			}
			.footer-nav a, .footer-nav a:hover{
				text-decoration:none;
			}
			#web-team-link {
				text-align: center;
				padding: 6px 0 0 0;
				font-size:1em;
				color: #969595;
				line-height: 1.62em;
				//margin-bottom: 1.3em;
				margin:0em;
			}
			#l-update{
				margin-top: 3em;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger" id="ml0">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<li id="ml1"><a href="admin_dashboard.php"><i class="fas fa-home"></i><span class = "menu-text1">Questions</span></a></li>
				<li id="ml2"><a href="admin_submissions.php" class="active-tab"><i class="fas fa-list-alt"></i><span class = "menu-text2">Submissions</span></a></li>
				<li id="ml5"><a href="#"><span class = "menu-text5">Admin Panel</span></a></li>
				<li id="ml3"><a href="admin_leaderboards.php"><i class="fas fa-trophy"></i><span class = "menu-text3">Leaderboards</span></a></li>
				<li id="ml4"><a class="codrops-icon" href="logout.php"><span class = "menu-text4">Log Out </span><i class="fas fa-sign-out-alt"></i></a></li>
			</ul>
			<header id="main-window">
				
				
			</header> 
			
		</div><!-- /container -->
		
		<nav class="footer-nav" role="navigation">
                <div class="container-fluid">
                    <div class="row">
					<div class="col-md-12">
						<a href="#"><p id="web-team-link">©2018 WEB TEAM Society Of Computer Applications</p></a>
					</div>
					</div>
                </div><!-- /.container -->
		</nav>
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script src="js/admin_subs.js"></script>
		<script>
			function ml5resize(){
				$view=$(document).width();
				$x=$('#ml1').width() + $('#ml2').width() + $('#ml3').width() + $('#ml4').width();
				$('#ml5').width($view-$x-23);
			}
			$(window).on('load', ml5resize);
			$(window).resize(ml5resize);

			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>