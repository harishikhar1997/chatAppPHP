echo "<div class='page-header'>
        <div class='sm-6'>
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
        </div>
        <div class='sm-6'>
            <a href='logout.php' class='btn btn-danger'>Sign Out of Your Account</a>
        </div>
    </div>";



    <?php
// Initialize the session
session_start();
 
 // echo "<h1>Hi, <b>".$_SESSION['currUser']."</b> Welcome to our site.</h1>";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "connect.php";

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	
	<style>
		<?php include 'mystyle.css'; ?>
	</style>
</head>

<body>
<?php

$currUser=4;
 

// $sql="SELECT users.username,message.msg,message.status FROM users INNER JOIN message ON users.user_id=message.reciever";

echo "<div align='center'>
        <div class='sm-6'>
        <h1>Hi, <b>".$_SESSION['username']."</b> Welcome to our site.</h1>
        </div>
        <div class='sm-6'>
            <a href='logout.php' class='btn btn-danger'>Sign Out of Your Account</a>
        </div>
    </div>";



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
		if($row["part2"]!=$currUser)
			{
				$parti=$row["part2"];
			}
			else
			{
				$parti=$row["part1"];  	 
			}
				$lastmsg_id=$row["lastmsg_id"];
				$chat_id=$row["chat_id"];


			$sql2="SELECT users.username,users.currStatus,users.user_id FROM users WHERE users.user_id='".$parti."'";
			$result1 = $conn->query($sql2);
			while($user_row = $result1->fetch_assoc()){
				$username = $user_row['username'];
				$currStatus=$user_row['currStatus'];
				$userid = $user_row['user_id'];
			}

			$sql3="SELECT message.msg,message.status,message.sender,message.reciever FROM message WHERE message.msg_id='".$lastmsg_id."'";
			$result2 = $conn->query($sql3);
			while($msg_row = $result2->fetch_assoc()){
				$message = $msg_row['msg'];
				$status = $msg_row['status'];
				$sender=$msg_row['sender'];
				$reciever=$msg_row['reciever'];
			}

	//important part is <li> tag where data-chat-id variable is used to store chat_id
			echo "<div class='card-body contacts_body'>
							<ui class='contacts'>
								<li data-chat-id='".$chat_id."' class='chat-li' data-user='".$username."' data-status='".$currStatus."' sender='".$sender."' reciever='".$reciever."'>
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
													<button class='link'>". $username ."</button>";
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
						<div class='card'>
						<div class='card-header msg_head'>
									<div class='d-flex bd-highlight'>
									<div class='img_cont'>
											<img src='http://www.clker.com/cliparts/4/7/6/2/1370391492782346139business_user-1.png' class='rounded-circle user_img'></div>
										<div class='user_info'>
											<div class='uname'></div>
											<div class='ustatus'></div>
										</div>
									</div></div>	
							<div class='card-body msg_card-body'>
								
						<div class='test'></div></div>

						<div class='container card-footer'>
							<form id='myform' method='post' action='insert.php'>
								<div class='form-group col-lg-9 m-auto'>
									<input type='text' name='msg1' id='msg1' class='form-control' placeholder='Type your message here...'>
									<input type='hidden' name='chat_id' id='c_id'>
									<input type='hidden' name='sender' id='sender'>
									<input type='hidden' name='reciever' id='reciever'>
								</div>
									<div class='col-lg-2'>
								<input type='submit' class='send_btn' name='submit' value='Send' id='submit'>
								</div>
							</form>
						</div>";


		echo "</div></div>
				</div></div>";

}else{
	echo "0 results";
}
$conn->close();

?>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->


<script type="text/javascript">
$(document).ready(function(){
	$(".chat1").hide();
	$(".link").click(function(){
		$(".chat1").fadeIn();
	});

	$(".chat-li").click(function(){
		var chat_id = $(this).attr("data-chat-id");
		var sender=$(this).attr("sender");
		var reciever=$(this).attr("reciever");
		 $.ajax({
		 	type : "POST",
		 	url : "data.php",
		 	data : {chat_id : chat_id},
		 	success : function(res){
		 		$('.test').html(res);
		 		$('#c_id').val(chat_id);
		 		$('#sender').val(sender);
		 		$('#reciever').val(reciever);
		 	//	anotherAjax(res);
		 	}
		 });

		 var username=$(this).attr("data-user");
		 $('.uname').html(username);
		 var status=$(this).attr("data-status");
		 if(status==1)
		 	$('.ustatus').html("online");
		 else
		 	$('.ustatus').html("offline");
	});


	//script to insert data in table
	
	$("#myform").submit(function(e){
		e.preventDefault();
		$('#msg1').val("");
		// $(".chat1").show();
	//	function anotherAjax(data){
		$.ajax({
			type:"POST",
			url:"insert.php",
			data:$('#myform').serialize(),
			success: function(dta){
				console.log(dta);
		//		$('.test').html(data);
			}
		});
	//}
	
	});

});
</script>

</body>
</html>