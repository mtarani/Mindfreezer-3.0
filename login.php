<?php
include_once 'login_script.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mind Freezer 3.0 - Login</title>
	
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<meta name="description" content="Login to Mind Freezer 3.0" />
	<meta name="author" content="SCA WEB TEAM" />
<!--===============================================================================================-->	
	<link rel="icon" href="images/mind_logo1.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<style>
	body{
			background: linear-gradient(to bottom, #293441, #c9d1d9) no-repeat;
			overflow:scroll;
		}
	.container-login100{
			background: linear-gradient(to bottom, #293441, #c9d1d9) no-repeat;

	}
	.wrap-login100{
		width:750px;
		padding:70px 50px 30px 50px;
	}
	.p-t-136 {
		padding-top: 30px;
	}
</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt style="width:310px;height: 310px; " >
					<img src="images/mind_logo1.png" alt="IMG" stysle="background: #FF4136;border-radius:50%;">
				</div>

				<form class="login100-form validate-form" id="login-form" method=post >
					<span class="login100-form-title">
						Student Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Username is required" >
						<input class="input100" type="text" name="id" placeholder="Login Id">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                      
					</div>
					
					<div class="container-login100-form-btn">
                        <div class="error" id="err" style="visibility:hidden;position:absolute; text-align:center;font-weight:700;z-index:3;">Login Id or Password is Invalid</div>
						<button class="login100-form-btn" style="margin-top:10%;">
							Login
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="reg.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script src="js/login.js"></script>
</body>
</html>