<?php
session_start();
	require_once "connect.php";
	
	//fetch current user through session:-when a user does a signIn / LogIn
	$currUser=$_SESSION['currUser'];

	$part1=$_POST['part1'];
	$part2=$_POST['part2'];
	
	$sql="SELECT message.msg,message.sender,message.reciever,message.sent_at from message where message.chat_id='".$_POST['chat_id']."'";
	$res=$conn->query($sql);

	if($res->num_rows>0)
	{
		while($row = $res->fetch_assoc())
		{
			$chat_id=$row['chat_id'];
			$sender=$row['sender'];
			$reciever=$row['reciever'];
			$sent_at=$row['sent_at'];

			if($reciever==$currUser)
			{
				//blue
				echo "<div class='d-flex justify-content-start mb-4'><div class='msg_cotainer' style='color:black; font-size: 12px;'>".$row['msg']."<div class='msg_time'>".$row['sent_at']."</div>
				</div>
						</div>";
			}
			else if($sender==$currUser){

				//green
				echo "<div class='d-flex justify-content-end mb-4'><div class='msg_cotainer_send' style='color:black; font-size: 12px;'>".$row['msg']."
						<div class='msg_time_send'>".$row['sent_at']."</div>
					</div>
				</div>";
			}
		
		}
	
	}else{
		echo "No message";
	}

	$conn->close();

?>

<!-- alert(chat_id); -->