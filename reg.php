<?php 

include_once('reg_script.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mind Freezer 3.0</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
    <script type="text/javascript">
        function fx(){
            document.getElementById('err').style.visibility='visible';
            
        }
    </script>
	
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
	@media only screen and (max-width: 650px) {
		.wrap-input10{
			width:80%;
		}
	}
	</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login-reg">
				<!--<div class="login100-pic js-tilt" data-tilt style="width:310px;height: 310px; " >
					<img src="images/img-01.png" alt="IMG" style="background: #FF4136;border-radius:50%;">
				</div> -->

				<form class="login100-form-reg validate-form" method="post" action="" id="reg-form">
					<span class="login100-form-title" style="text-align: center; width:100%;font-size:40px;">
						Student Registration
					</span>
                    
                     <div class="wrap-input10 validate-input" >
						<input class="input10" type="text" name="fname" placeholder="First Name" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100"> 
						<!--	<i class="fa fa-envelope" aria-hidden="true"></i>-->
						</span>
					</div>
                    
                    <div class="wrap-input10 validate-input" >
						<input class="input10" type="text" name="lname" placeholder="Last Name" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100"> 
						<!--	<i class="fa fa-envelope" aria-hidden="true"></i>-->
						</span>
					</div>
                    
					<div class="wrap-input10 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input10" type="email" name="email" placeholder="Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100"> 
						
						</span>
					</div>
                    
                    <div class="wrap-input10 validate-input" >
						<input class="input10" type="text" name="uname" placeholder="User Name" id="uname" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100"> 
						<!--	<i class="fa fa-envelope" aria-hidden="true"></i>-->
						</span>
					</div>
                    

					<div class="wrap-input10 validate-input" data-validate = "Password is required">
						<input class="input10" type="password" name="password" id='pass' placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						<!--	<i class="fa fa-lock" aria-hidden="true"></i>-->
						</span>
					</div>
                    
                    <div class="wrap-input10 validate-input" data-validate = "Password is required">
						<input class="input10" type="password" name="cpassword" id='cpass' placeholder="Confirm Password" onblur="cp()">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						<!--	<i class="fa fa-lock" aria-hidden="true"></i>-->
						</span>
					</div>
                    
                   
                    
                    <div class="wrap-input10 validate-input" >
						<input class="input10" type="text" name="colg_name" placeholder="College/Institute Name" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100"> 
						<!--	<i class="fa fa-envelope" aria-hidden="true"></i>-->
						</span>
					</div>
                    
                     <div class="wrap-input10 validate-input" >
						<input class="input10" type="text" name="reg_no" placeholder="Registration No" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100"> 
						<!--	<i class="fa fa-envelope" aria-hidden="true"></i>-->
						</span>
					</div>
                    
                    <div class="wrap-input10 validate-input">
						<input class="input10" type="tel" pattern="[0-9]{10}" name="mob_no" placeholder="Mobile No" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100"> 
						<!--	<i class="fa fa-envelope" aria-hidden="true"></i>-->
						</span>
					</div>
                    
                     <div class="wrap-input10 validate-input" >
						<input class="input10" type="text" name="city" placeholder="City" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100"> 
						<!--	<i class="fa fa-envelope" aria-hidden="true"></i>-->
						</span>
					</div>
                    
                    
                    
                   
					
					<div class="container-login100-form-btn">

                       <div class="error" id="err" style="visibility:hiddesn;position:absolute;text-align:center;font-weight:700;z-index:5;"></div>
						<button class="login100-form-btn" style="width:40%;margin-top:5%;">
							Create Account <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						
						</button>
					</div>

					

					<div class="text-center p-t-136" style="margin-top:0;">
						<a class="txt2" href="login.php">
							Login here
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
	<script src="js/registration.js"></script>
<script>
    function cp()
    {
        pass=document.getElementById('pass').value;
        cpass=document.getElementById('cpass').value;
        if(pass==cpass!= true)
         {   $("#err").html("Password does not match");
         }
    }
    
    </script>
</body>
</html>