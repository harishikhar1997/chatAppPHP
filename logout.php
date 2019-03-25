<?php
// Initialize the session
session_start();
 $currUser=$_SESSION['currUser'];
$server="localhost";
	$user="root";
	$pass="Toor@123";
	$dbname="Sharma";

	$conn=new mysqli($server,$user,$pass,$dbname);
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}

	$sql="UPDATE users SET currStatus=0,last_activity=NOW() WHERE user_id='".$currUser."'";
	if ($conn->query($sql) === TRUE) {
		console.log("success");
	}
	else{
		echo "error";
	}


// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();


 
// Redirect to login page
header("location: login.php");
exit;
?>