			$chat_id=$row['chat_id'];
			$sender=$row['sender'];
			$reciever=$row['reciever'];

			if($chat_id==$_POST['chat_id'] && $sender==4)
			{
				echo "<div class='rightAlign' style='color:red;'>".$row['msg']."</div>";
			}
			elseif ($chat_id==$_POST['chat_id'] && $reciever!=4) {
				echo "<div class='leftAlign' style='color:green;'>".$row['msg']."</div>";
			}



			".$row['sent_at']."


			<form class='type_msg' method='post' action='insert.php'>
								<input type='text' name='msg' placeholder='Type your message...'></input>


								<div class='input-group'>
								<textarea name='' class='form form-control type_msg' placeholder='Type your message...'></textarea>
								<div class='input-group-append'>
									<span class='input-group-text send_btn'><i class='fas fa-location-arrow'></i></span>
								</div>
							</div>


							<script>
	$(document).ready(function(){
	$("#submit").click(function(){
		var chat_id = $(this).attr("data-chat-id");
		var sender=$(this).attr("sender");
		var reciever=$(this).attr("reciever");
		//alert(msg);
		$.ajax({
			type:"POST",
			url:"insert.php",
			data:$('#myform input').serialize(),

			success: function(dta){
				console.log(dta);
			}
		});
	});
});
</script>


data: {chat_id : chat_id,sender: sender,reciever: reciever,msg1: msg1},

data:$('#myform').serialize(),
