<?php
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		include_once 'db_functions.php';
		$db = new DB_Functions();
		

		if(isset($_POST["uname"]) && !empty($_POST["uname"])
			&& isset($_POST["fname"]) && !empty($_POST["fname"])
			&& isset($_POST["lname"]) && !empty($_POST["lname"])
			&& isset($_POST["email"]) && !empty($_POST["email"])
			&& isset($_POST["uname"]) && !empty($_POST["uname"])
			&& isset($_POST["city"]) && !empty($_POST["city"])
			&& isset($_POST["password"]) && !empty($_POST["password"])
			&& isset($_POST["mob_no"]) && !empty($_POST["mob_no"])
			&& isset($_POST["reg_no"]) && !empty($_POST["reg_no"])
			&& isset($_POST["colg_name"]) && !empty($_POST["colg_name"])){
			
			$uname=$db->checkData($_POST["uname"]);
			//$pass=md5(mysqli_real_escape_string($_POST["pass"]));
			$pass=$db->checkData($_POST["password"]);
			$fname=$db->checkData($_POST["fname"]);
			$lname=$db->checkData($_POST["lname"]);
			$email=$db->checkData($_POST["email"]);
			$city=$db->checkData($_POST["city"]);
			$colg_name=$db->checkData($_POST["colg_name"]);
			$reg_no=$db->checkData($_POST["reg_no"]);
			$mob_no=$db->checkData($_POST["mob_no"]);
			
			$ver_code=$db->randStrGen(8);
			$pswd=$pass;
			$pass=md5($pass);
			$result = $db->checkUserAvailability($uname);
			if(mysqli_num_rows($result)>0) 
			{
				?><script>$("#err").html("Username not available");</script><?php
			}
			else{
				$result = $db->checkEmailAvailability($email);
				if(mysqli_num_rows($result)>0) 
				{
					?><script>$("#err").html("Email already in use");</script><?php
				}
				else{
					$result = $db->addUser($fname, $lname, $uname, $pass, $email, $city, $reg_no, $mob_no, $colg_name, $ver_code);

					$to = $email; 
					$subject = "Mind Freezer 3.0 Verification";
$message = "Congratulations! You have successfully registered for Mind Freezer 3.0. Please enter the verification code mentioned to complete the registration process. 
					
Username - ".$uname."
Password - ".$pswd."
Verification Code - ".$ver_code."
Login Using above vericification code here - http://scanitjsr.org/mindfreezer/login.php";
					
					$from = "admin@mindfreezer.com";
					$headers = "From:" . $from;
					mail($to,$subject,$message,$headers);
					echo "Verification code sent. Please Login to continue.";
					if($db->isAjax())
						echo ("1");
					else
						header('location:login.php');
				}
			}
		}
		else{
			?><script>$("#err").html("Fill all fields");</script><?php
		}
	}
?>