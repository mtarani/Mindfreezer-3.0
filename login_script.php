<?php
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		include_once 'db_functions.php';
		$db = new DB_Functions();
		

		if(isset($_POST["id"]) && !empty($_POST["id"])
			&& isset($_POST["pass"]) && !empty($_POST["pass"])){
			
			$uname=$db->checkData($_POST["id"]);
			//$pass=md5(mysqli_real_escape_string($_POST["pass"]));
			$pass=$db->checkData($_POST["pass"]);
			$pass=md5($pass);
			$result = $db->checkLogin($uname, $pass);
			if(mysqli_num_rows($result)>0) 
			{
				$row = mysqli_fetch_array($result, MYSQLI_BOTH);
				//echo($row["uid"]);
				
				session_start();
				$_SESSION["uid"] = $row["uid"];
				$_SESSION["loggedin"] = true;
				$_SESSION["activated"] = $row["activated"];

				//setcookie("uid", $row["uid"], strtotime( '+30 days' ), "/", "", "", TRUE);
				
				if($row["acc_type"]=="0"){
					$_SESSION["acc_type"] = 0;
					if($db->isAjax())
						//echo json_encode(array("location" => "player_dashboard.php"));
						echo ("0");
					else
						header('location:player_dashboard.php');
				}
				
				if($row["acc_type"]=="1"){
					$_SESSION["acc_type"] = 1;
					if($db->isAjax())
						//echo json_encode(array("location" => "admin_dashboard.php"));
						echo ("1");
					else
						header('location:admin_dashboard.php');
				}
			}
			else
				echo ("err");
		}
	}
?>