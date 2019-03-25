<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	
	<style>
		<?php include 'mystyle.css'; ?>
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
	 echo "<div class='container-fluid h-100'>
	 					<div class='row justify-content-center h-100'>
	 						<div class='col-md-4 col-xl-3 chat'>
	 							<div class='card mb-sm-3 mb-md-0 contacts_card'>
	 								
	 								<div class='card-header'>
	 									
	 									<div class='add-contact col-md-2'>
	 										<i class='fas fa-plus' aria-hidden='true'></i>
	 									</div>

										<div class='input-group col-md-10'>
							<input type='text' placeholder='Search...'' class='form-control search'>
							
							<div class='input-group-prepend'>
								<span class='input-group-text search_btn'><i class='fas fa-search'></i></span></div>
								</div></div>";
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


			$sql2="SELECT users.username,users.currStatus FROM users WHERE users.user_id='".$parti."'";
			$result1 = $conn->query($sql2);
			while($user_row = $result1->fetch_assoc()){
				$username = $user_row['username'];
				$currStatus=$user_row['currStatus'];
			}

			$sql3="SELECT message.msg,message.status FROM message WHERE message.msg_id='".$lastmsg_id."'";
			$result2 = $conn->query($sql3);
			while($msg_row = $result2->fetch_assoc()){
				$message = $msg_row['msg'];
				$status = $msg_row['status'];
			}

			echo "<div class='card-body contacts_body'>
							<ui class='contacts'>
								<li>
									<div class='d-flex bd-highlight'
										<div class='img_cont'>
											<img src='http://www.clker.com/cliparts/4/7/6/2/1370391492782346139business_user-1.png' class='rounded-circle user_img'>";
											if($currStatus==1)
											{
													echo "<span class='online_icon'></span>";
											}
											else
											{	
													echo "<span class='online_icon offline'></span>";
											}	
											echo"<div class='user_info'>
													<span>". $username ."</span>";
													if($status==0)
													{
														echo "<p style='font-weight:bolder'>". $message ."</p>
																	<i class='fas fa-eye-slash'></i>
	 																</div>";
													}
													else{
														echo "<div class='seen'><p>". $message ."</p>
	 																	<i class='fas fa-eye'></i>
	 																</div>";
													}
	}
		echo "</div></div>
					</li></ui>
		</div></div></div>";

		echo "<div class='col-md-8 col-xl-6 chat1'>
						<div class='card'>";


		echo "</div></div>
				</div></div>";

}else{
	echo "0 results";
}





$conn->close();

?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>

</body>
</html>