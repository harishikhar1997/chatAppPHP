<?php
session_start();

$currUser=$_SESSION['currUser'];
$currUserName=$_SESSION['username'];
$image1=$_SESSION["image"];

require_once "connect.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if($_SESSION["role"] == "subscriber"){
    header("location: welcome.php");
    exit();    
}

// $id1 = $_GET['id'];
 
//  $id=convert_uudecode(base64_decode($id1));
//  echo $id;exit();


if(isset($_POST['update']))
{    
        $id1 = $_POST['id'];
 
 $id=convert_uudecode(base64_decode($id1));

    //$id = $_POST['id'];
    //echo $id;exit();
    $name=$_POST['name'];

    $role=$_POST['role'];
    $image=$_POST['image'];
    $select=$_POST['select'];  
    $password=$_POST['password'];
    
    // echo $id;exit();
    // checking empty fields
    if(empty($name) || empty($role)) {            
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($role)) {
            echo "<font color='red'>Role field is empty.</font><br/>";
        }
              
    } else {    
        //updating the table
        $password1=md5($password);
        $sql2="UPDATE users SET username='".$name."',password='".$password1."',role='".$role."',activity='".$select."' WHERE user_id='".$id."'";
        if ($conn->query($sql2) === TRUE) {
            console.log("success");
        
      
        header("Location: tables-data.php");
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
    $password=$row['password'];
    }
}
require_once 'sidebar.php'; 
?>



    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
         <?php require_once 'header.php'; ?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="tables-data.php">Table</a></li>
                            <li class="active">Edit Form</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">

                                            <div class="col-lg-10">
                                                <div class="card">

                                                <form name="form1" method="post" action="forms-basic.php">
                                                    <div class="card-header">
                                                        <strong>Edit User Data</strong>
                                                    </div>
                                                    <div class="card-body card-block">
                                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">


                                                            <div class="row form-group">
                                                                <div class="col col-md-3"><label for="name" class=" form-control-label">Name Input</label></div>
                                                                <div class="col-12 col-md-9"><input type="name" id="name" name="name" value="<?php echo $name;?>" placeholder="Enter Name" class="form-control"><small class="help-block form-text">Please enter name</small></div>
                                                            </div>


                                                            <div class="row form-group">
                                                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Role</label></div>
                                                                <div class="col-12 col-md-9"><input type="text" id="role" name="role" value="<?php echo $role;?>" placeholder="Role" class="form-control"><small class="form-text text-muted">Role should be of subscriber</small></div>
                                                            </div>


                                                            
                                                            <div class="row form-group">
                                                                <div class="col col-md-3"><label for="password-input" class=" form-control-label">Password</label></div>
                                                                <div class="col-12 col-md-9"><input type="password" id="password" name="password" value="<?php echo $password;?>" placeholder="Password" class="form-control"><small class="help-block form-text">Please enter a complex password</small></div>
                                                            </div>
                                                          
                                                    <!--         <div class="row form-group">
                                                                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Textarea</label></div>
                                                                <div class="col-12 col-md-9"><textarea name="textarea-input" id="textarea-input" rows="9" placeholder="Content..." class="form-control"></textarea></div>
                                                            </div> -->
                                                                

                                                                <div class="row form-group">
                                                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Active/Inactive</label></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="select" id="select" class="form-control">
                                                                            <option value="1">1</option>
                                                                            <option value="0">0</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                               
<!--                                                                 <div class="row form-group">
                                                                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">File input</label></div>
                                                                    <div class="col-12 col-md-9"><input type="file" id="file" name="file" class="form-control-file"></div>
                                                                </div> -->
                                                    </div>
                                                    <div class="card-footer">
                                                        <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>

                                                        <button type="submit" name="update" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i>Update
                                                        </button>
                                                        <button type="reset" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-ban"></i> Reset
                                                        </button>
                                                    </div>

                                                </form>
                                                </div>
                                            </div>



                                            </div>
                                        </div><!-- .animated -->
                                    </div><!-- .content -->
                                </div><!-- /#right-panel -->
                                <!-- Right Panel -->


                            <script src="vendors/jquery/dist/jquery.min.js"></script>
                            <script src="vendors/popper.js/dist/umd/popper.min.js"></script>

                            <script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
                            <script src="vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>

                            <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                            <script src="assets/js/main.js"></script>

                            <script src="admin/myjs.js"></script> 
</body>
</html>
