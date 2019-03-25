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

$currUser=$_SESSION['currUser'];
 

// $sql="SELECT users.username,message.msg,message.status FROM users INNER JOIN message ON users.user_id=message.reciever";

echo "<div align='center'>
        <div class='sm-6'>
        <h1>Hi, <b>".$_SESSION['username']."</b> Welcome to our chatting site.</h1>
        </div>
        <div class='sm-6'>
            <a href='logout.php' style='font-size:15px;' class='btn btn-danger'>Sign Out</a>
        </div>
    </div>";



$parti="";
$lastmsg_id="";
$sql="SELECT * FROM chat WHERE part1='".$currUser."' OR part2='".$currUser."'";

$result = $conn->query($sql);

if ($result->num_rows > 0){

	$sql5="SELECT * FROM users WHERE user_id NOT IN (".$currUser.")";
	$res5=$conn->query($sql5);


	 echo "<div class='container-fluid h-100'>
	 					<div class='row justify-content-center h-100'>
	 						<div class='col-md-4 col-xl-3 chat'>
	 							<div class='card mb-sm-3 mb-md-0 contacts_card'>
	 								
	 								<div class='card-header'>
	 									
	 									<div id='myBtn' class='add-contact col-md-2'>
	 										<i class='fas fa-plus' aria-hidden='true'></i>
	 											
	 											<div id='myModal' class='modal'>

													  <div class='modal-content' style='font-family: Arial, Helvetica, sans-serif;'>
													    <div class='modal-header'>
							
													      <h2>Start chatting with..</h2>
													    <span class='close'>&times;</span>
													    </div>

													    <div class='modal-body list-type6'>";
										while($row5 = $res5->fetch_assoc()){	
												echo "<ul><button style='background:none;border:none;'><a data-nuser='".$row5['username']."' data-nid='".$row5['user_id']."' class='new-users'>". $row5['username'] ."</a></button></ul>";
										}
												echo	"</div>
													    <div class='modal-footer'>
													      <a href='logout.php' style='font-size:15px;' class='btn btn-danger'>Sign in as different User?</a>
													    </div>
													  </div>
												</div>	

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
				$part1=$row["part1"];
				$part2=$row["part2"];



			$sql2="SELECT users.username,users.currStatus,users.user_id FROM users WHERE users.user_id='".$parti."'";
			$result1 = $conn->query($sql2);
			while($user_row = $result1->fetch_assoc()){
				$username = $user_row['username'];
				$currStatus=$user_row['currStatus'];
				$userid = $user_row['user_id'];
			}

			$sql3="SELECT message.msg,message.msg_id,message.status,message.sender,message.reciever FROM message WHERE message.msg_id='".$lastmsg_id."'";
			$result2 = $conn->query($sql3);
			while($msg_row = $result2->fetch_assoc()){
				$message = $msg_row['msg'];
				$status = $msg_row['status'];
				$sender=$msg_row['sender'];
				$reciever=$msg_row['reciever'];
				$msg_id=$msg_row['msg_id'];
			}

			
	//important part is <li> tag where data-chat-id variable is used to store chat_id
			echo "<div class='card-body contacts_body'>
							<ui class='contacts'>
								<li data-chat-id='".$chat_id."' class='chat-li' data-user='".$username."' data-status='".$currStatus."' sender='".$sender."' reciever='".$reciever."' m_id='".$m_id."'>
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
									<input type='hidden' name='parti' id='parti'>
									<input type='hidden' name='m_id' id='m_id'>
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



	$(".chat-li").click(function loadLink(){
		var chat_id = $(this).attr("data-chat-id");
		var m_id=$(this).attr("m_id");
		/*var sender=$(this).attr("sender");
		var reciever=$(this).attr("reciever");*/
		//alert(m_id);

		getChatByChatID(chat_id)
		 //setTimeout(loadLink, 3000);

		 var username=$(this).attr("data-user");
		 $('.uname').html(username);
		 var status=$(this).attr("data-status");
		 if(status==1)
		 	$('.ustatus').html("online");
		 else
		 	$('.ustatus').html("offline");
	});

function getChatByChatID(chat_id){

		$.ajax({
		 	type : "POST",
		 	url : "data.php",
		 	data : {chat_id : chat_id},
		 	success : function(res){
		 		 
		 		var $data = $.parseJSON(res);

		 		if($data.code==200)
		 		{

		 			 alert($data.reciever);
		 
		 			$('.test').html($data.thread);
		 			$('#c_id').val(chat_id);
		 			$('#reciever').val($data.reciever);
		 			
		 		}
		 		//setInterval(function(){$('.test').load('http://127.0.0.1/Hari/chatting/welcome.php');},3000);
		 		
		 	}
		 });
}

	//script to insert data in table
	
	$("#myform").submit(function(e){
		e.preventDefault();
		
		$.ajax({
			type:"POST",
			url:"insert.php",
			data:$('#myform').serialize(),
			success: function(dta){

			var $data = $.parseJSON(dta);

			if($data.code==200)
			{
				console.log(dta);
				$('.test').append($data.thread);
				$('#msg1').val("");
			}			

		}
		});	
	});


//////////////////////////////////////////////////////////////////////////////////
	//Script to create model for new users to start chat with..

	// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
		

///////////////////////////////////////////////////////////////////////////////////////
	//Starting chat with new user

	$('.new-users').click(function(){
		
		var nuser = $(this).attr("data-nuser");
		var nid = $(this).attr("data-nid");

		$.ajax({
			type : "POST",
		 	url : "newuser.php",
		 	data : {nid:nid,nuser:nuser},
		 	success:function(res){
		 		$('#myModal').hide();
		 		var response = $.parseJSON(res);
		 		if(response.code==200){
		 			var chat_id = response.last_id;
		 			getChatByChatID(chat_id);
		 		}else{
		 			alert("something went wrong!");
		 		}
		 		
		 		
		 	}
		});
	});

});
</script>

</body>
</html>