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
	
	//fetch current user through session:-when a user does a signIn / LogIn
	$currUser=$_SESSION['currUser'];
 

	if(!empty($_POST)){
		$msg1=	$_POST['msg1'];
		$chat_id=	$_POST['chat_id'];
		$sender=	$_POST['sender'];
		$reciever=	$_POST['reciever'];


		$sql="INSERT INTO message(chat_id,sender,reciever,msg,status) VALUES('$chat_id','$sender','$reciever','$msg1',0)";

		// $res=$conn->query($sql);
		if ($conn->query($sql) === TRUE) {

			// $sql4="UPDATE chat SET chat.lastmsg_id=message.msg_id WHERE chat.chat_id='".$chat_id."'";		
			// if($conn4->query($sql4)===TRUE)
			// {
			// 	console.log("Success");
			// }
			// else{
			// 	echo "Error: " . $sql4 . "<br>" . $conn4->error;
			// }

			if($reciever==$currUser)
			{
				//blue
				echo "<div class='d-flex justify-content-start mb-4'><div class='msg_cotainer' style='color:black; font-size: 12px;'>".$msg1."<div class='msg_time'>".date('m/d/Y H:i:s', time())."</div>
				</div>
						</div>";
			}
			else if($sender==$currUser){
				//green
				echo "<div class='d-flex justify-content-end mb-4'><div class='msg_cotainer_send' style='color:black; font-size: 12px;'>".$msg1."
						<div class='msg_time_send'>".date('m/d/Y H:i:s', time())."</div>
					</div>
				</div>";
			}

		} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
		}

$conn->close();		
}


	?>