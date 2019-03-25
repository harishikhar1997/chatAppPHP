<?php
session_start();

	// require_once "connect.php";

	$server="localhost";
	$user="root";
	$pass="Toor@123";
	$dbname="Sharma";

	$conn=new mysqli($server,$user,$pass,$dbname);
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}
	
	//fetch current user through session:-when a user does a signUp / LogIn
	$currUser=$_SESSION['currUser'];
	$nuser=$_POST['nuser'];
	$nid=$_POST['nid'];
	$cstat=$_POST['cstat'];


	
	$sql="INSERT INTO chat (part1,part2) VALUES ('$currUser','$nid')";
	if($conn->query($sql)===TRUE)
	{
		$last_id = mysqli_insert_id($conn);

		if($cstat==1){
			$sql7="UPDATE users SET users.chatStatus=0 WHERE users.user_id='".$nid."'";
			$conn->query($sql7);
		}
	}
	
	if(!empty($last_id)){
			$response['last_id']=$last_id;
			$response['code']=200;
		}else{
			$response['last_id']=null;
			$response['code']=202;
		}
	echo json_encode($response); die;
	?>