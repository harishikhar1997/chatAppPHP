<?php	
session_start();

require_once "connect.php";
$currUser=$_SESSION['currUser'];
?>

<?php
$sql="SELECT * FROM chat WHERE part1='".$currUser."' OR part2='".$currUser."' ORDER BY lastmsg_id DESC";

$result = $conn->query($sql);

if ($result->num_rows>=0){

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



			$sql2="SELECT users.username,DATE_FORMAT(last_activity,'%W, %M %e, %Y @ %h:%i %p') dt,users.currStatus,users.user_id,users.file_name,users.last_activity FROM users WHERE users.user_id='".$parti."'";
			$result1 = $conn->query($sql2);
			while($user_row = $result1->fetch_assoc()){
				$username = $user_row['username'];
				$currStatus=$user_row['currStatus'];
				$userid = $user_row['user_id'];
				$image=$user_row['file_name'];
				$last_seen=$user_row['dt'];
			}

			$sql3="SELECT message.msg,message.msg_id,message.status,message.sender,message.reciever,DATE_FORMAT(sent_at,'%H:%i %p') TIMEONLY FROM message WHERE message.msg_id='".$lastmsg_id."'";
			$result2 = $conn->query($sql3);
			
			while($msg_row = $result2->fetch_assoc()){
				$message = $msg_row['msg'];
				$status = $msg_row['status'];
				$sender=$msg_row['sender'];
				$reciever=$msg_row['reciever'];
				$msg_id=$msg_row['msg_id'];
				$time=$msg_row['TIMEONLY'];
			}

			
	//important part is <li> tag where data-chat-id variable is used to store chat_id

			$inboxThread.= "<li data-chat-id='".$chat_id."' data-image='".$image."' class='chat-li' data-user='".$username."' data-status='".$currStatus."' sender='".$sender."' reciever='".$userid."' m_id='".$m_id."' part1='".$part1."' part2='".$part2."' parti='".$parti."' last_seen='".$last_seen."' time='".$time."' lastmsg_id='".$lastmsg_id."'>
									<div class='d-flex bd-highlight'
										<div class='img_cont'>
											<img src='".$image."' class='rounded-circle user_img'>";
										
											if($currStatus==1)
											{
													$inboxThread.= "<span class='online_icon'></span>";
											}
											else
											{	
													$inboxThread.= "<span class='online_icon offline'></span>";
											}	
											$inboxThread.="<div class='user_info'>
													<button class='link'>". $username ."</button>";
											if(isset($lastmsg_id)){
													if($status==0)
													{
														$inboxThread.= "<p style='font-weight:bolder'>". $message ."</p>
																					<p>". $time ."</p>
																	<i class='fas fa-eye-slash'></i>
	 												</div>";
													}
													else{
														$inboxThread.= "<div class='seen'><p>". $message ."</p>
														<p>". $time ."</p>
	 	  														<i class='fas fa-eye'></i>
	 	  															</div>";
													}
											}
											else{
												$inboxThread.= " ";
											}
	}
		$inboxThread.= "</div></div></li>";
}
		$response=array();
		$response['code']=200;
		$response['thread']=$inboxThread;
		$response['chat_id']=$chat_id;
		$response['reciever']=$reciever;
		$conn->close();

		echo json_encode($response);
		die;		
?>



