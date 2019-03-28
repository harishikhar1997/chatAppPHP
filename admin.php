<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) 
{
	if($_SESSION["role"] !="admin"){
    header("location: welcome.php");
    exit;
  }
}

require_once "connect.php";
// echo "<a href='logout.php' style='font-size:15px;' class='btn btn-danger'>Sign Out</a>";
?>

<html>
<head>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">



<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<!-- <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script> -->


 

<style>
		<?php include 'mystyle.css'; ?>
	</style>
</head>

<body>
<?php

$currUser=$_SESSION['currUser'];
$username=$_SESSION["username"];

echo "<div class='navbar navbar-inverse'>

    <div class='navbar-inner'>

   <div id='mySidenav' class='sidenav'>
  	<a href='javascript:void(0)' class='closebtn' onclick='closeNav()'>&times;</a>
  	<a href='#'>About</a>
  	<a href='#'>Services</a>
  	<a class='subscribers' href='#'>Subscribers</a>
  	<a href='#'>Contact</a>
	</div>

	<div id='main' style='margin-left: 1px;margin-bottom: -43px;'> <span style='font-size:30px;cursor:pointer' onclick='openNav()'><i class='fas fa-bars'></i></span></div>




		<div class='container-fluid' style='padding-right: 65px;padding-left: 80px;'>
			<a class='brand' name='top'>Admin Panel</a>
			<div class='nav-collapse collapse'>
				<ul class='nav'>
					<li><a href='#'><i class='icon-home icon-white'></i> Home</a></li>
					<li class='divider-vertical'></li>
					<li class='active'><a href='add.php'><i class='icon-file icon-white'></i>Add New User</a></li>
					<li class='divider-vertical'></li>
					<li><a href='#'><i class='icon-envelope icon-white'></i> Messages</a></li>
					<li class='divider-vertical'></li>
                  	<li><a href='#'><i class='icon-signal icon-white'></i> Stats</a></li>
					<li class='divider-vertical'></li>
					<li><a href='#'><i class='icon-lock icon-white'></i> Permissions</a></li>
					<li class='divider-vertical'></li>
				</ul>

				<div class='btn-group pull-right'>
					<a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>
						<i class='icon-user'></i> ".$username."	<span class='caret'></span>
					</a>
					<ul class='dropdown-menu'>
						<li><a href='#'><i class='icon-wrench'></i> Settings</a></li>
						<li class='divider'></li>
						<li><a href='logout.php'><i class='icon-share'></i> Logout</a></li>
					</ul>
				</div>

			</div>

		</div>

	</div>

</div>";

echo "<div class='utable' style='display:none;'>";

	
	$sql="SELECT * FROM users WHERE role='subscriber'";

	echo '<table id="table_id" border="1" cellspacing="2" cellpadding="2"> 

	<thead>
      <tr> 
          <td> <font face="Arial"><b>User Id</b></font> </td> 
          <td> <font face="Arial"><b>User Name</b></font> </td> 
          <td> <font face="Arial"><b>Password</b></font> </td> 
          <td> <font face="Arial"><b>Last Seen</b></font> </td> 
          <td> <font face="Arial"><b>status</b></font> </td>
          <td> <font face="Arial"><b>Display picture Path</b></font> </td>
          <td> <font face="Arial"><b>Role</b></font> </td>
          <td> <font face="Arial"><b>Active/inactive</b></font> </td>
          <td> <font face="Arial"><b>Action</b></font> </td>

      </tr>
  </thead>';

	$result = $conn->query($sql);
	if ($result->num_rows>=0){
		while($row = $result->fetch_assoc()){
			$user_id = $row["user_id"];
			$pass = $row["password"];
			$username1=$row["username"];
			$last_seen=$row["last_activity"];
			$currStatus=$row["currStatus"];
			$userImage=$row["file_name"];
			$role=$row["role"];
			$activity=$row["activity"];


			echo '<tbody><tr> 
                  <td>'.$user_id.'</td> 
                  <td>'.$username1.'</td> 
                  <td>'.$pass.'</td> 
                  <td>'.$last_seen.'</td> 
                  <td>'.$currStatus.'</td> 
                  <td>'.$userImage.'</td>
                  <td>'.$role.'</td>
                  <td>'.$activity.'</td>
                 	<td align="center">
									<a href="edit.php?id='.base64_encode(convert_uuencode($user_id)).'">Edit</a> |
									<a class="delete" id="del" href="delete.php?id='.$user_id.'">Delete</a></td>
              </tr></tbody>';

		}
	}


echo "</div>";


?>




<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>

<script>
	$(document).ready(function(){
	// 	$("body").on("click",".delete",function(){
	// 	//$(".chat1").fadeIn();
	// 	alert("Do you want to delete this record?");
	// });
 $('#table_id').DataTable();
	$("body").on("click",".subscribers",function(){
		$(".utable").fadeIn();
	});

	});

</script>


</body>
</html>