<?php
	session_start();
	if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['acc_type'] == 0))
		header('location:login.php');
	
	if ($_SESSION['activated'] == 0)
		header('location:verification.php');
	
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Rules</title>
		<meta name="description" content="Solve Mind Freezer 3.0" />
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
		<script src="js/jquery-fallr-2.0.1.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		<style>
			body{
				color:#fff;
			}
			#gn-menu{
				z-index:100;
			}
			#answer-box{
				resize: none;
				width: 90%;
				height: 300px;
				border: 3px solid #cccccc;
				padding : 1em;
				margin : 1em 2em;
				font-size : 1.4em;
			}
			.input-box{
				resize: none;
				width: 90%;
				height: 300px;
				border: 3px solid #cccccc;
				padding : 1em;
				margin : 1em 2em;
				font-size : 1.4em;
				border-radius: 7px;
				box-shadow: 1px 1px 6px 1px #b3c8d4;
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
				display:inline-block !important;
			}
			.gn-menu-wrapper.gn-open-all{
				width:100px;
			}
			.gn-scroller{
				width:130px;
			}
			.container-fluid > header{
				padding: 8em 2em;
				padding-leftt:130px;
				font-size:.6em;
				font-family: 'Lato', Arial, sans-serif;
				font-weight:300;
				min-height: 95vh;
			}
			h1{
				font-family: 'Lato', Arial, sans-serif;
				font-weight:300;
				font-size: 3.2em;
			}
			p{
				font-size:1.7em;
				font-weight:400;
			}
			.exp-box{
				border: 2px solid;
				border-radius: 5px;
				padding:2em 2em;
			}
			#ml5>a:hover{
				color:#5f6f81;
				background:#fff;
			}
			.mt-hidden{
				display:none !important;
			}
			.menu-text5{
				width:100%;
			}
			#loading{
			    width: 50px;
			}
			#messfage{
				width: 50px;
				display: inline-block;
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
			
			.submit-b-box{
				float:right;
			}
			.submit-msg{
				float:right;
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
			
			#leaderboard {
			  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			  border-collapse: collapse;
			  font-size:1.6em;
			  width: 100%;
			}

			#leaderboard td, #leaderboard th {
			  border: 1px solid #ddd;
			  padding: 8px;
			}

			#leaderboard tr:nth-child(even){background-color: #f2f2f2; color:#34495e}

			#leaderboard tr:hover {background-color: #607386;}
			#leaderboard tr:nth-child(even):hover{background-color: #ddd;}

			#leaderboard th {
				font-size:1.2em;
			  padding-top: 12px;
			  padding-bottom: 12px;
			  text-align: left;
			  background-color: #34495e;
			  color: white;
			}
			.rule-list{
				font-size:2em;
			}
		</style>
	</head>
	<body>
	
		<div class="container-fluid">
			<ul id="gn-menu" class="gn-menu-main">
				
				<li id="ml1"><a href="player_dashboard.php"><i class="fas fa-home"></i><span class = "menu-text1">Questions</span></a></li>
				
				<li id="ml3"><a href="player_leaderboards.php"><i class="fas fa-trophy"></i><span class = "menu-text3">Leaderboards</span></a></li>
				
				<li id="ml5"><a href="#"><span class = "menu-text5">Mind Freezer 3.0</span></a></li>
				
				<li id="ml2"><a href="rules.php" class="active-tab"><i class="fas fa-list-alt"></i><span class = "menu-text2">Rules</span></a></li>
				
				<li id="ml4"><a class="codrops-icon" href="logout.php"><span class = "menu-text4">Log Out </span><i class="fas fa-sign-out-alt"></i></a></li>
			</ul>
			
			<header id="main-window">
				<div class="row">
					<div class="col-md-8 mx-auto d-block">
						<h1>Rules</h1>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8 mx-auto d-block">
						<ul class="rule-list">
							<li>
							A question will be available at 10:00 PM everyday. No questions would be given on 25th, 30th, 31st of December and 1st of January.
							</li>
							<li>
							You will be allowed to answer that question till 12:00 PM of the subsequent day.
							</li>
							<li>
							The answer to the question asked would be disclosed the subsequent day at 5:00 PM.
							</li>
							<li>
							Question may be from any technical domain.
							</li>
							<li>
							If a question has subparts then all the subparts have to be answered together as one.
							</li>
							<li>Points are also rewarded for partial submissions.</li>
							<li>Hints for questions will be provided if required between 11:00 PM - 11:30 PM</li>
							<li>
							User may submit more than one answer (only the last one would be considered).
							</li>
							<li>
							Leaderboard would be updated at 7:00PM everyday.
							</li>
							<li>
							Participant need to submit their answer with breif explanation as some questions may have more than one way of solving.
							</li>
							<li>
							Participant quick enough to submit the precise and crisp answer to the question would be awarded with maximum points.
							</li>
							<li>
							Scoring Pattern
								<ul>
									<li>1st user to solve a question correctly will be awarded 5 points</li>
									<li>2nd user to solve a question correctly will be awarded 4 points</li>
									<li>3rd user to solve a question correctly will be awarded  3 points</li>
									<li>4th user to solve a question correctly will be awarded  2 points</li>
									<li>Rest all users to solve a question correctly will be awarded 1 point</li>
								</ul>
							</li>
							<li>Note: Decision of judges will not be subjective to any further scrutiny and will be final.</li>

				</ul>
					</div>
				</div>
				

 


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
		<script>
			function ml5resize(){
				$view=$(window).width();
				$x=$('#ml1').width() + $('#ml2').width() + $('#ml3').width() + $('#ml4').width();
				$('#ml5').width($view-$x-23);
			}
			$(window).on('load', ml5resize);
			$(window).resize(ml5resize);

			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>