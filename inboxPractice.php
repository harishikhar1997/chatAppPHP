<?php	
session_start();

require_once "connect.php";
$currUser=$_SESSION['currUser'];
?>

<?php

// Left join has been used as we want the data of new users who have been added to the inbox but the chat has not been initated; i.e. the users who have null as lastmsg_id .

$sql="SELECT chat.chat_id,chat.part1,chat.part2,chat.lastmsg_id,
			
			users.username,DATE_FORMAT(last_activity,'%W, %M %e, %Y @ %h:%i %p') dt,users.currStatus,	users.user_id,users.file_name,users.last_activity,

			message.msg,message.msg_id,message.status,message.sender,message.reciever,DATE_FORMAT(sent_at,'%H:%i %p') TIMEONLY

			FROM chat INNER JOIN users ON users.user_id=IF(chat.part2!='".$currUser."',chat.part2,chat.part1) 

			LEFT JOIN message ON message.msg_id=chat.lastmsg_id 

			WHERE part1='".$currUser."' OR part2='".$currUser."' AND message.msg_id=lastmsg_id 

			ORDER BY chat.lastmsg_id DESC";

$result = $conn->query($sql);

if ($result->num_rows>=0){

	while($row = $result->fetch_assoc()){

				$lastmsg_id=$row["lastmsg_id"];
				$chat_id=$row["chat_id"];
				$part1=$row["part1"];
				$part2=$row["part2"];

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



