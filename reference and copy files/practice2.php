<?php
session_start();


	require_once "connect.php";

	$currUser=$_SESSION['currUser'];

	//'".$currUser."'

	// $sql="SELECT * FROM users INNER JOIN chat ON users.user_id=chat.part1 OR users.user_id=chat.part2 WHERE users.user_id NOT IN (".$currUser.")";

	// $sql="SELECT * FROM users INNER JOIN chat ON users.user_id=(chat.part1='".$currUser."' OR chat.part2='".$currUser."')";

	// $sql="SELECT username FROM users WHERE EXISTS (SELECT * FROM chat WHERE part1='".$currUser."' OR part2='".$currUser."') AND users.user_id NOT IN (".$currUser.")";

//	$names=array();

	$sql="SELECT * FROM users WHERE users.user_id NOT IN (".$currUser.")";

	$res=$conn->query($sql);

	if ($res->num_rows>=0){

	while($row=$res->fetch_assoc()){
		
		$sql2="SELECT * FROM chat WHERE (part1='".$row['user_id']."' AND part2=".$currUser.") OR (part2='".$row['user_id']."' AND part1=".$currUser.")";

		$res2=$conn->query($sql2);
		if($res2->num_rows == 0){
		$names[]=$row['username'];
		}
	}	
}
else{
	echo "error";
}
//echo count($names);
foreach($names as $name) {
echo "$name ";
}



?>