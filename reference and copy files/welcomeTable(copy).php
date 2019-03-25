<html>
<head>
	<style>
		table,th,td{
			border: 1px solid black;
		}
		table{
			margin-left: 300px;
			margin-top: 100px;
		}
	</style>
</head>

<body>
<?php
$server="localhost";
$user="root";
$pass="Toor@123";
$dbname="Sharma";

$currUser=4;

$conn=new mysqli($server,$user,$pass,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// $sql="SELECT users.username,message.msg,message.status FROM users INNER JOIN message ON users.user_id=message.reciever";

$parti="";
$lastmsg_id="";
$sql="SELECT * FROM chat WHERE part1='".$currUser."' OR part2='".$currUser."'";

$result = $conn->query($sql);

if ($result->num_rows > 0){	
	echo "<table><tr><th>reciever</th><th>msg</th><th>status</th></tr>";
	while($row = $result->fetch_assoc()){
		if($row["part2"]!=4)
			{
				$parti=$row["part2"];
			}
			else
			{
				$parti=$row["part1"];  	 
			}
				$lastmsg_id=$row["lastmsg_id"];


			$sql2="SELECT users.username FROM users WHERE users.user_id='".$parti."'";
			$result1 = $conn->query($sql2);
			while($user_row = $result1->fetch_assoc()){
				$username = $user_row['username'];
			}

			$sql3="SELECT message.msg,message.status FROM message WHERE message.msg_id='".$lastmsg_id."'";
			$result2 = $conn->query($sql3);
			while($msg_row = $result2->fetch_assoc()){
				$message = $msg_row['msg'];
				$status = $msg_row['status'];
			}
			if($status==0)
			{
			echo "<tr style='font-weight:bold'><td>". $username. "</td><td>". $message. "</td><td>". $status. "</td></tr>";
			}
			else{
				echo "<tr><td>". $username. "</td><td>". $message. "</td><td>". $status. "</td></tr>";
			}
	}
		echo "</table>";
}else{
	echo "0 results";
}

$conn->close();

?>

</body>
</html>