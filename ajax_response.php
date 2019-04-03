<?php

	session_start();
	if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['acc_type'] == 1))
		header('location:login.php');

	include_once 'db_functions.php';
	$req=$_POST["request"];
	
	$db = new DB_Functions();
	if($req==="getQuestionList"){
		
		$result = $db->getQuestionList();
		$i=1;
		if($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				?>
				<li class="">
				<a id = <?php echo ($row["qid"]); ?> class="question-no"><span>Q<?php echo ($i++); ?></span></a>
				<a id = <?php echo ($row["qid"]); ?> class="question-edit"><i class="fas fa-edit"></i></a>
				<a id = <?php echo ($row["qid"]); ?> class="question-remove"><i class="fas fa-trash-alt"></i></a>
				</li>
				<?php
			}
		}
		?>
		<li class="">
		<a id="q-add" class="question-add"><span>Add Question</span><i class="fas fa-plus"></i></a>
		</li>
		<?php
	}
	else if($req==="getQuestion"){
		$qid = $_POST["qid"];
		$qno = $_POST["qno"];
		$result = $db->$req($qid);
		$row = $row = mysqli_fetch_array($result, MYSQLI_BOTH);
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
			<div class="col-md-12">
				<h1>Question Explanation</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 exp-box">
				<p><?php echo(nl2br($row["explanation"])); ?></p>
			</div>
		</div>
		<?php
	}
	else if($req==="editQuestion"){
		$qid = $_POST["qid"];
		$qno = $_POST["qno"];
		$result = $db->getQuestion($qid);
		$row = $row = mysqli_fetch_array($result, MYSQLI_BOTH);
		?>
		
		<form method="POST" enctype="multipart/form-data" id="q-form">
			<div class="row">
				<div class="col-md-12">
					<h1>Q<?php echo($qno); ?>) Question Title</h1>
					<textarea name="q_title" id="q_title" class = "input-box"><?php echo($row["q_title"]); ?></textarea>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<h1>Question Description</h1>
					<textarea name="q_desc" id="q_desc" class = "input-box"><?php echo($row["q_description"]); ?></textarea>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<h1>Question Image</h1>
					<?php
						if($row["q_image"] != null){
							?>
							<img src="<?php echo($row["q_image"]) ?>" class="q-image"/>
							<?php
						}
					?>
					<input type="file" name="q_image" id="q_image">
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<h1>Question Explanation</h1>
					<textarea name="q_exp" id="q_exp" class = "input-box"><?php echo($row["explanation"]); ?></textarea>
				</div>
			</div>
			
			
			<?php $year = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			$datetime=preg_split("/[\s-:]+/", $row["date"]); 			
			?>
			<div class="row">
				<div class="col-md-12">
					<h1>Starting Time</h1>
					<div class="row">
						<div class="col-md-2">
							<select name="yy" id="yy">
								<option value="0" selected > Select Year </option>
								<?php for($i=2018; $i<2020; $i++) {?>
									<option value="<?php echo($i); ?>" <?php if($i==$datetime[0]) echo("selected"); ?> > <?php echo($i); ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-2">
							<select name="mm" id="mm">
								<option value="0"> Select Month </option>
								<?php for($i=0; $i<12; $i++) {?>
									<option value="<?php echo($i+1); ?>" <?php if($i+1==$datetime[1]) echo("selected"); ?> > <?php echo($year[$i]); ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-2">
							<select name="dd" id="dd">
								<option value="0" selected > Select Date </option>
								<?php for($i=1; $i<=31; $i++) {?>
								<option value="<?php echo($i); ?>" <?php if($i==$datetime[2]) echo("selected"); ?> > <?php echo($i); ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-2">
							<select name="hh" id="hh">
								<option value="0" selected > Select Hour </option>
								<?php for($i=0; $i<24; $i++) {?>
								<option value="<?php echo($i); ?>" <?php if($i==$datetime[3]) echo("selected"); ?> > <?php echo($i); ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-2">
							<select name="mt" id="mt">
								<option value="0" selected > Select Minutes </option>
								<?php for($i=0; $i<60; $i++) {?>
								<option value="<?php echo($i); ?>" <?php if($i==$datetime[4]) echo("selected"); ?> > <?php echo($i); ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-2">
							<input type="hidden" id="qid" name="qid" value=<?php echo($qid); ?> >
							<input type="hidden" id="qno" name="qno" value=<?php echo($qno); ?> >
							<input type="submit" class="myButton" id="q-save" value="Save">
						</div>
					</div>
				</div>
			</div>
		</form>
		<?php
	}
	else if($req==="updateQuestion"){
		$qid = $_POST["qid"];
		$qno = $_POST["qno"];
		$result = $db->updateQuestion($qid, $_POST["q_title"], $_POST["q_desc"], $_POST["q_exp"], $_POST["date"]);
		echo($result);
	}
	else if($req==="removeQuestion"){
		$qid = $_POST["qid"];
		$result = $db->$req($qid);
	}
	else if($req==="getQuestionListSub"){
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
	else if($req==="getQuestionSubs"){
		$qid = $_POST["qid"];
		$qno = $_POST["qno"];
		$result = $db->getQuestionSubmissions($qid);
		?>
		<div class="row">
			<div class="col-md-8">
				<h1>Q<?php echo($qno); ?>) Submissions</h1>
				<input type="hidden" id="qno" name="qno" value=<?php echo($qno); ?> >
				<input type="hidden" id="qid" name="qid" value=<?php echo($qid); ?> >
			</div>
			<div class="col-md-4">
				<input type="submit" class="myButton" id="l-update" value="Update Leaderboard">
			</div>
		</div>
		<?php
		if($result) {
			$i=0;
			?>
			<div class="row">
			<?php
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				
				if($i%3==0 && $i!=0){
					?>
					</div>
					<div class="row">
					<?php
				}
				$ic;
				if($row["status"]=="-1")
					$ic="exclamation-circle";
				else if($row["status"]=="0")
					$ic="times";
				else
					$ic="check";
				?>
					<div class="col-md-4 sub-box">
						<div class="sub-head" id="<?php echo($row["subid"]); ?>">
							<div class="ids">
								<span class="uid">User Id -  <?php echo($row["uid"]); ?></span><br>
								<span class="subid">Submission Id -  <?php echo($row["subid"]); ?></span><br>
							</div>
							<div class="icons">
								<i class="fas fa-<?php echo($ic); ?>"></i>
							</div>
						</div>
					</div>
				<?php
			}
			?>
			</div>
			<?php
		}
	}
	else if($req==="openSubmission"){
		$subid = $_POST["subid"];
		$result = $db->$req($subid);
		$qid = $_POST["qid"];
		$qno = $_POST["qno"];
		$row = mysqli_fetch_array($result, MYSQLI_BOTH);
		?>
		
		<div class="row">
			<div class="col-md-12">
				<h1>Submission Id - <?php echo($row["subid"]); ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 sub-ans">
				<p><xmp><?php echo(nl2br($row["submission"])); ?></xmp></p>
				<p><?php echo(nl2br($row["submission"])); ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 sub-box mx-auto d-block">
				<div class="sub-head check" id="right">
					<div class="correction">
						<h4>Right</h4>
					</div>
					<div class="icons">
						<i class="fas fa-check"></i>
					</div>
				</div>
			</div>
			<div class="col-md-3 sub-box mx-auto d-block">
				<div class="sub-head check" id="wrong">
					<div class="correction">
						<h4>Wrong</h4>
					</div>
						<div class="icons">
						<i class="fas fa-times"></i>
					</div>
				</div>
			</div>
			<input type="hidden" id="qid" name="qid" value=<?php echo($qid); ?> >
			<input type="hidden" id="qno" name="qno" value=<?php echo($qno); ?> >
			<input type="hidden" id="subid" name="subid" value=<?php echo($subid); ?> >
		</div>
		<?php
	}
	else if($req==="checkQuestionSubmissions"){
		$subid = $_POST["subid"];
		$result = $db->$req($subid, $_POST["check"]);
		$qid = $_POST["qid"];
		$qno = $_POST["qno"];
		$result = $db->getQuestionSubmissions($qid);
		?>
		<div class="row">
			<div class="col-md-8">
				<h1>Q<?php echo($qno); ?>) Submissions</h1>
				<input type="hidden" id="qno" name="qno" value=<?php echo($qno); ?> >
				<input type="hidden" id="qid" name="qid" value=<?php echo($qid); ?> >
			</div>
			<div class="col-md-4">
				<input type="submit" class="myButton" id="l-update" value="Update Leaderboard">
			</div>
		</div>
		<?php
		if($result) {
			$i=0;
			?>
			<div class="row">
			<?php
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				
				if($i%3==0 && $i!=0){
					?>
					</div>
					<div class="row">
					<?php
				}
				$ic;
				if($row["status"]=="-1")
					$ic="exclamation-circle";
				else if($row["status"]=="0")
					$ic="times";
				else
					$ic="check";
				?>
					<div class="col-md-4 sub-box">
						<div class="sub-head" id="<?php echo($row["subid"]); ?>">
							<div class="ids">
								<span class="uid">User Id -  <?php echo($row["uid"]); ?></span><br>
								<span class="subid">Submission Id -  <?php echo($row["subid"]); ?></span><br>
							</div>
							<div class="icons">
								<i class="fas fa-<?php echo($ic); ?>"></i>
							</div>
						</div>
					</div>
				<?php
			}
			?>
			</div>
			<?php
		}
	}
	else if($req==="updateLeaderboard"){
		
		$qid = $_POST["qid"];
		
		$result = $db->updateLeaderboard1($qid);
		if($result) {
			$i=5;
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				$result2 = $db->updateLeaderboard2($row["subid"], $i);
				$i=max($i-1, 1);
			}
		}
		echo($result);
	}
	else
		$result = $db->$req();
?>