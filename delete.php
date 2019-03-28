<?php
session_start();

require_once "connect.php";

		$id = $_POST['user_id'];
 $response = array();

$sql="DELETE FROM users WHERE user_id='".$id."'";
if ($conn->query($sql) === TRUE) {
	$msgThread .="Account deleted!";
	$response['code'] 	= 201;
	$response['thread'] = $msgThread;
		
} else {
  $msgThread .="Sorry this user cannot be deleted!";
	$response['code'] 	= 200;
	$response['thread'] = $msgThread;
}




	
 	
 	echo json_encode($response); die;


$conn->close();


?>