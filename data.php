<?php
session_start();
	require_once "connect.php";
	
	//fetch current user through session:-when a user does a signIn / LogIn
  $currUser=$_SESSION['currUser'];


	$sql="SELECT message.msg,message.sender,message.reciever,message.sent_at,chat.part1,chat.part2 from message INNER JOIN chat ON chat.chat_id=message.chat_id where message.chat_id='".$_POST['chat_id']."'";
	$res=$conn->query($sql);
	$msgThread ='';

	if($res->num_rows>0)
	{
		while($row = $res->fetch_assoc())
		{

			 
			$chat_id  =$row['chat_id'];
			$sender   =$row['sender'];
			$reciever =$row['reciever'];
			$sent_at  =$row['sent_at'];

			$part1  =$row['part1'];
			$part2  =$row['part2'];

			

			if($sender==$currUser)
			{
				//green
				$msgThread .= "<div class='d-flex justify-content-end mb-4'><div class='msg_cotainer_send' style='color:black; font-size: 12px;'>".$row['msg']."
						<div class='msg_time_send'>".$row['sent_at']."</div>
					</div>
				</div>";
			}
			else{
				//blue
				$msgThread .= "<div class='d-flex justify-content-start mb-4'><div class='msg_cotainer' style='color:black; font-size: 12px;'>".$row['msg']."<div class='msg_time'>".$row['sent_at']."</div>
				</div>
						</div>";
			}
		
		}
	
	}else{
		$msgThread .= "No messages yet!";
	}

	$response = array();

	/*if($currUser!=$part1){
		$response['reciever'] 	= $part1;
	}else{
		$response['reciever'] 	= $part2;
	}*/
	
	$response['code'] 	= 200;
	$response['thread'] = $msgThread;
	$conn->close();
 	echo json_encode($response); die;
	
?>
