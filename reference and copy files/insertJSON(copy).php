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
	$sender=$currUser;
	$msgThread='';


	if(!empty($_POST)){
		$msg1=	$_POST['msg1'];
		$chat_id=	$_POST['chat_id'];
		$reciever=	$_POST['reciever'];


		$sql6="SELECT message.msg_id FROM message WHERE message.chat_id='".$chat_id."'";
			$res6=$conn->query($sql6);
			while($row6=$res6->fetch_assoc()){
				$m_id=$row6['msg_id'];
			}
			//$m_id1=$m_id;
			// echo $m_id1;
			// exit();


		$sql="INSERT INTO message(chat_id,sender,reciever,msg,status) VALUES('$chat_id','$currUser','$reciever','$msg1',0)";

		// $res=$conn->query($sql);
		if ($conn->query($sql) === TRUE) {
			//$last_id = mysqli_insert_id($conn);
			//echo $last_id;

			$sql4="UPDATE chat SET chat.lastmsg_id='".$m_id."' WHERE chat.chat_id='".$chat_id."'";		
			if($conn->query($sql4)===TRUE)
			{
				console.log("Success");
			}
			else{
				echo "Error: " . $sql4 . "<br>" . $conn->error;
			}

			if($sender==$currUser)
			{
				//green
				$msgThread.= "<div class='d-flex justify-content-end mb-4'><div class='msg_cotainer_send' style='color:black; font-size: 12px;'>".$msg1."
						<div class='msg_time_send'>".date('m/d/Y H:i:s', time())."</div>
					</div>
				</div>";
			}
			else{
				//blue
				$msgThread.= "<div class='d-flex justify-content-start mb-4'><div class='msg_cotainer' style='color:black; font-size: 12px;'>".$msg1."<div class='msg_time'>".date('m/d/Y H:i:s', time())."</div>
				</div>
						</div>";
			}

		} else {
    	$msgThread.= "Error: " . $sql . "<br>" . $conn->error;
		}

		$response=array();
		$response['code']=200;
		$response['thread']=$msgThread;
		$conn->close();

		echo json_encode($response);
		die;		
}


	?>