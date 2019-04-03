<?php
	
	session_start();
	if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['acc_type'] == 0))
		header('location:login.php');

	include_once 'db_functions.php';
	$req=$_POST["request"];
	$uid=$_SESSION["uid"];
	
	$db = new DB_Functions();
	if($req==="getQuestionList"){
		
			$result = $db->getQuestionList();
			$i=1;
			if($result) {
				while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
					?>
					<li class="">
					<a id = <?php echo ($row["qid"]); ?> class="question-no"><span>Q<?php echo ($i++); ?></span></a>
					</li>
					<?php
				}
			}
	}
	else if($req==="getQuestion"){
		$qid = $_POST["qid"];
		$qno = $_POST["qno"];
		$result = $db->$req($qid);
		$row = $row = mysqli_fetch_array($result, MYSQLI_BOTH);
		
		$currtime = new DateTime(date('Y-m-d H:i:s'));
		$qtime = new DateTime($row["date"]);
		$interval = $currtime->diff($qtime);
		//echo($currtime->format('%y%%h%a days'));
		//echo($qtime->format('%y%%h%a days'));
		//echo($interval->format('%d days').$interval->format('%h hours'));/*
		$hours=$interval->days * 24 + $interval->h;
		if($currtime<$qtime){
			//echo($qtime->format('Y'));
			
			?>
			<div class="row align-items-center">
				<div class="col-xl-6 mx-auto d-block" style="margin:2em;">
					<div class="clock mx-auto d-block" style="margin:2em;"></div>
				</div>
			</div>
			<script type="text/javascript">
			var clock;
			$(document).ready(function() {
				// Grab the current date
				var currentDate = new Date();
				// Set some date in the future. In this case, it's always Jan 1
				var futureDate  = new Date(parseInt(<?php echo($qtime->format('Y')) ?>),parseInt(<?php echo($qtime->format('m')) ?>)-1, parseInt(<?php echo($qtime->format('d')) ?>), parseInt(<?php echo($qtime->format('H')) ?>), parseInt(<?php echo($qtime->format('i')) ?>),parseInt(<?php echo($qtime->format('s')) ?>), 0);

				/*var futureDate  = new Date(<?php echo($qtime->format(Y)) ?>, <?php echo($qtime->format(m)) ?>, <?php echo($qtime->format(d)) ?>, <?php echo($qtime->format(H)) ?>, <?php echo($qtime->format(i)) ?>, <?php echo($qtime->format(s)) ?>, 0);*/
				// Calculate the difference in seconds between the future and current date
				var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
				// Instantiate a coutdown FlipClock
				clock = $('.clock').FlipClock(diff, {
					clockFace: 'DailyCounter',
					countdown: true,
					callbacks: {
						stop: function() {
							location.reload(true);
						}
					}
				});
			});			
		</script>
		<?php
		}
			
		else if($hours<14){
			?>
			<div class="row">
				<div class="col-md-12">
					<h1>Q<?php echo($qno.") ".$row["q_title"]); ?></h1>
					<p><?php echo(nl2br($row["q_description"])); ?></p>
					<?php
					if($row["q_image"] != null){
						?>
						<img src="<?php echo($row["q_image"]) ?>" class="q-image"/>
						<?php
					}
					?>
				</div>
			</div>	
			<form method="POST" enctype="multipart/form-data" id="q-form" action="player_ajax_response.php">
			<div class="row">
				<div class="col-md-12">
					<h1>Your Answer Here</h1>
					<textarea name="q_sub" id="q_sub" class = "input-box" placeholder="Enter your answer here."></textarea>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-9">
					<div class="submit-msg"></div>
				</div>
				<div class="col-md-3 submit-b-box">				
						<input type="hidden" id="qid" name="qid" value=<?php echo($qid); ?> >
						<input type="hidden" id="request" name="request" value="submitAnswer" >
						<input type="submit" class="myButton" id="q-submit" value="Submit">
				</div>
			</div>
			</form>
			<?php
		}
		else if($hours>19){
			?>
			<div class="row">
				<div class="col-md-12">
					<h1>Q<?php echo($qno.") ".$row["q_title"]); ?></h1>
					<p><?php echo(nl2br($row["q_description"])); ?></p>
					<?php
					if($row["q_image"] != null){
						?>
						<img src="<?php echo($row["q_image"]) ?>" class="q-image"/>
						<?php
					}
					?>
				</div>
			</div>	
			<div class="row">
				<div class="col-md-12 exp-box">
					<p><?php echo(nl2br($row["explanation"])); ?></p>
				</div>
			</div>
			<?php
		}
		else{
			?>
			<div class="row">
				<div class="col-md-12">
					<h1>Question Explanation at 05:00 PM</h1>
				</div>
			</div>
			<?php
		}
	}
	
	else if($req==="submitAnswer") {
		$result = $db->addSubmission($_POST["qid"], $uid, $_POST["q_sub"]);
		echo($result);
	}
	else
		echo("Invalid Request");
?>