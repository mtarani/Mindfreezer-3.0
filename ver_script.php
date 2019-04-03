<?php
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		include_once 'db_functions.php';
		$db = new DB_Functions();
		

		if(isset($_POST["code"]) && !empty($_POST["code"])){
			
			session_start();
			$uid=$_SESSION["uid"];
			
			$code=$db->checkData($_POST["code"]);
			
			$result = $db->checkCode($uid, $code);
			
			if(mysqli_num_rows($result)>0) 
			{
				$result = $db->activateAccount($uid);
				$_SESSION['activated'] = 1;
				echo("1");
			}
			else{
				?><script>$("#err").html("Wrong Code");</script><?php
			}
		}
		else{
			?><script>$("#err").html("Fill all fields");</script><?php
		}
	}
?>