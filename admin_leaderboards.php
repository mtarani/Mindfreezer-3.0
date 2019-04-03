<?php
	session_start();
	if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['acc_type'] == 1))
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
		<title>Player-Dashboard</title>
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
				padding-left:130px;
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
		</style>
	</head>
	<body>
	
		<div class="container-fluid">
			<ul id="gn-menu" class="gn-menu-main">
				
				<li id="ml1"><a href="admin_dashboard.php"><i class="fas fa-home"></i><span class = "menu-text1">Questions</span></a></li>
				<li id="ml2"><a href="admin_submissions.php"><i class="fas fa-list-alt"></i><span class = "menu-text2">Submissions</span></a></li>
				<li id="ml5"><a href="#"><span class = "menu-text5">Admin Panel</span></a></li>
				<li id="ml3"><a href="admin_leaderboards.php"  class="active-tab"><i class="fas fa-trophy"></i><span class = "menu-text3">Leaderboards</span></a></li>
				<li id="ml4"><a class="codrops-icon" href="logout.php"><span class = "menu-text4">Log Out </span><i class="fas fa-sign-out-alt"></i></a></li>
			</ul>
			
			<header id="main-window">
				<div class="row">
					<div class="col-md-8 mx-auto d-block">
						<h1>Leaderboard</h1>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8 mx-auto d-block">
						<table id="leaderboard">
						  <tr>
							<th>Rank</th>
							<th>Name</th>
							<th>Points</th>
						  </tr>
						  <?php 
							include_once 'db_functions.php';
							$db = new DB_Functions();
							$result = $db->getLeaderboard();
							$i=0;
							$p=0;
							while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
								if($p!=$row["total_points"]){
									$p=$row["total_points"];
									$i++;
								}
								?>
								<tr>
									<td><?php echo($i); ?></td>
									<td><?php echo($row["fname"]." ".$row["lname"]); ?></td>
									<td><?php echo($row["total_points"]); ?></td>
								</tr>
								<?php
							}
						  ?>
						  
						</table>
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