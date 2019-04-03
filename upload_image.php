<?php

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$path = 'q_images/'; // upload directory

if($_FILES['q_image'])
{
$img = $_FILES['q_image']['name'];
$tmp = $_FILES['q_image']['tmp_name'];

// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

// can upload same image using rand function
$final_image = rand(1000,1000000).$img;

// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 

if(move_uploaded_file($tmp,$path)) 
{
//echo "<img src='$path' />";
//echo $insert?'ok':'err';
include_once 'db_functions.php';
	$db = new DB_Functions();
	$result = $db->updateImage($_POST["qid"], $path);
	echo ($result);
}
} 
else 
{
echo ("0");
}
}
?>