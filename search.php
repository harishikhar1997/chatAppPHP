<?php	
session_start();

require_once "connect.php";
$currUser=$_SESSION['currUser'];
?>

<?php

	// $key=$_GET['key'];
 //  $array = array();

	$searchTerm = $_GET['term'];

  $sql="SELECT users.username,users.user_id

			FROM chat INNER JOIN users ON users.user_id=IF(chat.part2!='".$currUser."',chat.part2,chat.part1) 

			LEFT JOIN message ON message.msg_id=chat.lastmsg_id 

			WHERE username LIKE '%".$searchTerm."%' AND (part1='".$currUser."' OR part2='".$currUser."')";

  $result = $conn->query($sql);

  if ($result->num_rows>=0){

  	while($row = $result->fetch_assoc()){

  		$array[] = $row['username'];

  	}
  }

  echo json_encode($array);

  $conn->close();




?>