<?php
session_start();

//require_once "connect.php";
    $server="localhost";
    $user="root";
    $pass="Toor@123";
    $dbname="Sharma";

    $conn=new mysqli($server,$user,$pass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

$targetDir = "images/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST['submit']) && !empty($_FILES["file"]["name"])){
	$name=trim($_POST['name']);
	$password = trim($_POST['password']);

	if(!empty($name) && !empty($password))
	{
		if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
			 $sql="INSERT INTO users(username,password,currStatus,file_name) values('$name','$password',1,'".$targetFilePath."')";

       if ($conn->query($sql) === TRUE) {

                header('location:admin.php');
       } else {
       		echo "Error: " . $sql . "<br>" . $conn->error;
       }
		}
	}

}


?>

<html>
<head>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<style>
		<?php include 'mystyle.css'; ?>
	</style>
</head>

<body>
<?php

$currUser=$_SESSION['currUser'];
$username=$_SESSION["username"];

echo "	<div class='navbar navbar-inverse'>

    <div class='navbar-inner'>		
		
	<div class='container-fluid' style='padding-right: 65px;padding-left: 80px;'>
			<a class='brand' name='top'>Admin Panel</a>
			<div class='nav-collapse collapse'>
				<ul class='nav'>
					<li><a href='#'><i class='icon-home icon-white'></i> Home</a></li>
					<li class='divider-vertical'></li>
					<li class='active'><a href='add.php'><i class='icon-file icon-white'></i> Add New User</a></li>
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
?>

	<div class="form">
<div>
<h1>Insert New Record</h1>
<form name="form" method="post" action="add.php"> 
<p><input type="text" name="name" placeholder="Enter Name" required /></p>
<p><input type="text" name="password" placeholder="Set Password" required /></p>

<label>Select your Display Picture to upload:</label>
        <div class="btn-group" role="group">
            <input type="file"  name="file" id="file" class="btn btn-secondry" accept="image/*">
        </div>

<p><input name="submit" type="submit" value="Submit" /></p>
</form>
<p style="color:#FF0000;"><?php echo $status; ?></p>
</div>
</div>


</body>
</html>