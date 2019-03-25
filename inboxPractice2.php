<?php	
session_start();

require_once "connect.php";
$currUser=$_SESSION['currUser'];
?>

<?php

//$parti="";

// $sql="SELECT chat.chat_id,chat.part1,chat.part2,chat.lastmsg_id,users.username,DATE_FORMAT(last_activity,'%W, %M %e, %Y @ %h:%i %p') dt,users.currStatus,users.user_id,users.file_name,users.last_activity FROM chat INNER JOIN users ON  WHERE part1='".$currUser."' OR part2='".$currUser."' ORDER BY lastmsg_id DESC";

$sql="SELECT chat.chat_id,chat.part1,chat.part2,chat.lastmsg_id,
				
				users.username,DATE_FORMAT(last_activity,'%W, %M %e, %Y @ %h:%i %p') dt,users.currStatus,users.user_id,users.file_name,users.last_activity,
				
				message.msg,message.msg_id,message.status,message.sender,message.reciever,DATE_FORMAT(sent_at,'%H:%i %p') TIMEONLY 
				
				FROM users INNER JOIN message ON users.user_id=message.reciever INNER JOIN chat ON users.user_id=(chat.part2!='".$currUser."'? chat.part2 : chat.part1) WHERE message.msg_id='".$lastmsg_id."' ORDER BY chat.lastmsg_id DESC";

$result = $conn->query($sql);

if ($result->num_rows>=0){

	while($row = $result->fetch_assoc()){

				$lastmsg_id=$row["lastmsg_id"];
				$chat_id=$row["chat_id"];
				$part1=$row["part1"];
				$part2=$row["part2"];
				$parti=$row["parti"];

				$username = $row['username'];
				$currStatus=$row['currStatus'];
				$userid = $row['user_id'];
				$image=$row['file_name'];
				$last_seen=$row['dt'];

				$message = $row['msg'];
				$status = $row['status'];
				$sender=$row['sender'];
				$reciever=$row['reciever'];
				$msg_id=$row['msg_id'];
				$time=$row['TIMEONLY'];

			//	'".$parti."'

			// $sql2="SELECT chat.chat_id,chat.part1,chat.part2,chat.lastmsg_id,users.username,DATE_FORMAT(last_activity,'%W, %M %e, %Y @ %h:%i %p') dt,users.currStatus,users.user_id,users.file_name,users.last_activity,message.msg,message.msg_id,message.status,message.sender,message.reciever,DATE_FORMAT(sent_at,'%H:%i %p') TIMEONLY, IF(chat.part2!='".$currUser."',chat.part2,chat.part1) AS parti FROM users INNER JOIN message ON users.user_id=message.reciever INNER JOIN chat ON users.user_id=chat.parti AND message.msg_id='".$lastmsg_id."' ORDER BY lastmsg_id DESC";
			// $result1 = $conn->query($sql2);
			
			// while($user_row = $result1->fetch_assoc()){
			// 	$username = $user_row['username'];
			// 	$currStatus=$user_row['currStatus'];
			// 	$userid = $user_row['user_id'];
			// 	$image=$user_row['file_name'];
			// 	$last_seen=$user_row['dt'];

			// 	$message = $user_row['msg'];
			// 	$status = $user_row['status'];
			// 	$sender=$user_row['sender'];
			// 	$reciever=$user_row['reciever'];
			// 	$msg_id=$user_row['msg_id'];
			// 	$time=$user_row['TIMEONLY'];
			// }

			// $sql3="SELECT message.msg,message.msg_id,message.status,message.sender,message.reciever,DATE_FORMAT(sent_at,'%H:%i %p') TIMEONLY FROM message WHERE message.msg_id='".$lastmsg_id."'";
			// $result2 = $conn->query($sql3);
			// while($msg_row = $result2->fetch_assoc()){
			// 	$message = $msg_row['msg'];
			// 	$status = $msg_row['status'];
			// 	$sender=$msg_row['sender'];
			// 	$reciever=$msg_row['reciever'];
			// 	$msg_id=$msg_row['msg_id'];
			// 	$time=$msg_row['TIMEONLY'];
			// }

			
	//important part is <li> tag where data-chat-id variable is used to store chat_id

			echo "<li data-chat-id='".$chat_id."' data-image='".$image."' class='chat-li' data-user='".$username."' data-status='".$currStatus."' sender='".$sender."' reciever='".$reciever."' m_id='".$m_id."' part1='".$part1."' part2='".$part2."' parti='".$parti."' last_seen='".$last_seen."'>
									<div class='d-flex bd-highlight'
										<div class='img_cont'>
											<img src='".$image."' class='rounded-circle user_img'>";
										
											if($currStatus==1)
											{
													echo "<span class='online_icon'></span>";
											}
											else
											{	
													echo "<span class='online_icon offline'></span>";
											}	
											echo "<div class='user_info'>
													<button class='link'>". $username ."</button>";
											if(isset($lastmsg_id)){
													if($status==0)
													{
														echo "<p style='font-weight:bolder'>". $message ."</p>
																					<p>". $time ."</p>
																	<i class='fas fa-eye-slash'></i>
	 												</div>";
													}
													else{
														echo "<div class='seen'><p>". $message ."</p>
														<p>". $time ."</p>
	 	  														<i class='fas fa-eye'></i>
	 	  															</div>";
													}
											}
											else{
												echo " ";
											}
	}
		echo "</div></div></li>";
}

?>



