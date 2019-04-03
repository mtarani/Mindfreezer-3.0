<?php

class DB_Functions {

    private $db;
    private $conn;

    //put your code here
    // constructor
    function __construct() {

        include_once './db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $GLOBALS['conn']=$this->db->connect();

    }


    // destructor
    function __destruct() {
        
    }
	
	public function verifyResult($result) {
		
        if ($result) {
			return true;
        }
		else {			
			// For other errors
			return false;
		}
	}
	
	public function checkData($data){
		$result = mysqli_real_escape_string($GLOBALS['conn'], $data);
		
        return $result;
	}
	
	public function addQuestion() {
		
		$time=date('Y-m-d H:i:s');
		$add_by=$_SESSION["uid"];
		$sql = "INSERT INTO questions(added_by, date) VALUES ('$add_by', '$time')";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
		return $this->verifyResult($result);
	}
	
	public function removeQuestion($qid) {
		$qid=$this->checkData($qid);
		$sql = "DELETE FROM questions WHERE qid='$qid'";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
		return $this->verifyResult($result);
	}
	
	public function getQuestionList() {
		
		$sql = "SELECT qid, date FROM questions ORDER BY date ASC";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	public function getQuestion($qid) {
		$qid=$this->checkData($qid);
		$sql = "SELECT * FROM questions WHERE qid = '$qid'";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	public function updateQuestion($qid, $q_title, $q_desc, $q_exp, $date) {
		
		$qid=$this->checkData($qid);
		$q_title=$this->checkData($q_title);
		$q_desc=$this->checkData($q_desc);
		$q_exp=$this->checkData($q_exp);
		$date=$this->checkData($date);
		$sql = "UPDATE questions SET q_title = '$q_title', q_description = '$q_desc', explanation = '$q_exp', date = '$date' WHERE qid='$qid'";
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
		return $this->verifyResult($result);
	}
	
	public function updateImage($qid, $q_image) {
		$qid=$this->checkData($qid);
		$sql = "UPDATE questions SET q_image = '$q_image' WHERE qid='$qid'";
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
		return $this->verifyResult($result);
	}
	
	public function getQuestionSubmissions($qid) {
		$qid=$this->checkData($qid);
		
		$sql = "SELECT t.subid, t.uid, t.qid, t.submission, t.status, t.time as sub_time FROM submissions t INNER JOIN(SELECT uid, MAX(time) time FROM submissions WHERE qid = '$qid' GROUP BY uid) b ON t.uid = b.uid AND t.time = b.time ORDER BY sub_time ASC";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	public function openSubmission($subid) {
		
		$subid=$this->checkData($subid);
		
		$sql = "SELECT * FROM submissions WHERE subid='$subid'";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	public function checkQuestionSubmissions($subid, $check) {
		
		$subid=$this->checkData($subid);
		$check=$this->checkData($check);
		
		$sql = "UPDATE submissions SET status = '$check' WHERE subid='$subid'";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	public function addSubmission($qid, $uid, $sub) {
		
		$time=date('Y-m-d H:i:s');
		$qid=$this->checkData($qid);
		$uid=$this->checkData($uid);
		$sub=$this->checkData($sub);
		
		$sql = "INSERT INTO submissions(qid, uid, submission, time) VALUES ('$qid', '$uid', '$sub', '$time')";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
		return $this->verifyResult($result);
	}
	
	public function updateLeaderboard1($qid) {
		
		$qid=$this->checkData($qid);
		
		$sql = "SELECT t.subid, t.uid, t.qid, t.submission, t.status, t.time as sub_time FROM submissions t INNER JOIN(SELECT uid, MAX(time) time FROM submissions WHERE qid = '$qid' AND status = 1 GROUP BY uid) b ON t.uid = b.uid AND t.time = b.time ORDER BY sub_time ASC";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	public function updateLeaderboard2($subid, $points) {
		
		$subid=$this->checkData($subid);
		$points=$this->checkData($points);
		
		$sql = "UPDATE submissions SET points = '$points' WHERE subid='$subid'";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	public function getLeaderboard() {
		
		$sql = "SELECT t.fname, t.lname, t.uid, b.points as total_points FROM users t INNER JOIN(SELECT uid, SUM(points) points FROM submissions GROUP BY uid) b ON t.uid = b.uid ORDER BY total_points DESC LIMIT 10";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	
	public function checkUserAvailability($uname){
		
		$uname=$this->checkData($uname);
		$sql = "SELECT uid FROM users WHERE uname='$uname'";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	public function checkEmailAvailability($email){
		
		$email=$this->checkData($email);
		$sql = "SELECT uid FROM users WHERE email='$email'";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	public function checkLogin($uname, $pass){
		
		$uname=$this->checkData($uname);
		$pass=$this->checkData($pass);
		
		$sql = "SELECT uid, acc_type, activated FROM users WHERE (uname='$uname' OR email='$uname') AND password='$pass' LIMIT 1";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	
	
	function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
	
	function randStrGen($len){

		$result = "";
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789$$$$$$$1111111";
		$charArray = str_split($chars);
		for($i = 0; $i < $len; $i++){
			$randItem = array_rand($charArray);
			$result .= "".$charArray[$randItem];
		}
		return $result;
	}
	
	public function addUser($fname, $lname, $uname, $pass, $email, $city, $reg_no, $mob_no, $colg_name, $ver_code) {
		
		$sql = "INSERT INTO users(fname, lname, uname, password, email, city, reg_no, mob_no, colg_name, ver_code) VALUES ('$fname', '$lname', '$uname', '$pass', '$email', '$city', '$reg_no', '$mob_no', '$colg_name', '$ver_code')";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
		return $this->verifyResult($result);
	}
	
	public function checkCode($uid, $ver_code){
		$sql = "SELECT * FROM users WHERE uid='$uid' AND ver_code='$ver_code' LIMIT 1";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	public function activateAccount($uid){
		$v=1;
		$sql = "UPDATE users SET activated = '$v' WHERE uid='$uid'";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}
	
	public function getemail(){
		$sql = "SELECT uid, email FROM users ORDER BY uid ASC";
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
        return $result;
	}

}

?>