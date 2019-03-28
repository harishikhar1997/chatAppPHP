<?php
session_start();


require_once "connect.php";

if(isset($_POST['update']))
{    

	$id1 = $_POST['id'];
 
 $id=convert_uudecode(base64_decode($id1));

    //$id = $_POST['id'];
    //echo $id;exit();
    $name=$_POST['name'];
    $role=$_POST['role'];
    $image=$_POST['image'];
    $activity=$_POST['activity'];    
    
    // checking empty fields
    if(empty($name) || empty($role) || empty($image)) {            
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($role)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
        
        if(empty($image)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }        
    } else {    
        //updating the table
        $sql2="UPDATE users SET username='".$name."',role='".$role."',file_name='".$image."' WHERE user_id='".$id."'";
        if ($conn->query($sql2) === TRUE) {
            console.log("success");
        
      
        header("Location: admin.php");
        }
        
        
    }
}
?>

<?php
//getting id from url
$id1 = $_GET['id'];
 
 $id=convert_uudecode(base64_decode($id1));
 

//selecting data associated with this particular id
$sql="SELECT * FROM users WHERE user_id='".$id."'";

$result = $conn->query($sql);
if ($result->num_rows>=0){
 
	while($row = $result->fetch_assoc())
	{
    $name = $row['username'];
    $role = $row['role'];
    $activity = $row['activity'];
    $image = $row['file_name'];
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
	<h1>Edit data</h1>
	<form name="form1" method="post" action="edit.php">
        <table id="table_id" border="0" style="margin-top: 100px;margin-left: 325px;">
            <tr> 
                <td>Name:</td>
                <td><input type="text" name="name" value="<?php echo $name;?>"></td>
            </tr>
            <tr> 
                <td>Role:</td>
                <td><input type="text" name="role" value="<?php echo $role;?>"></td>
            </tr>
            <tr> 
                <td>Active/Inactive:</td>
                <td><select type="text" name="role">
                	<option value="<?php echo $activity;?>"><?php echo $activity;?></option>
                	<option value="0">0</option>
                </select></td>
            </tr>
            <tr> 
                <td>image:</td>
                <td><input type="text" name="image" value="<?php echo $image;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>


</body>
</html>