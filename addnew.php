<?php
session_start();

$currUser=$_SESSION['currUser'];
$currUserName=$_SESSION['username'];
$image1=$_SESSION["image"];

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if($_SESSION["role"] == "subscriber"){
    header("location: welcome.php");
    exit();    
}

require_once "connect.php";

    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";


    // File upload path
$targetDir = "images/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);



    if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["file"]["name"])){
 

        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        }else{
            $username = trim($_POST['username']);
            if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
                $username_err = "Only letters and white space allowed"; 
            }
        }

        if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST['password']);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }

       // $allowTypes = array('jpg','png','jpeg','gif','pdf');

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        

      //  if(in_array($fileType, $allowTypes)){
         if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            //die("hello");
            $password1=md5($password);
        $sql="INSERT INTO users(username,password,currStatus,file_name) values('$username','$password1',0,'".$targetFilePath."')";

        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Added!","New User Added!","success");';
            echo '}, 1000);</script>';
            // echo 'window.location.href = "http://127.0.0.1/Hari/chatting/tables-data.php";</script>';
            //header('location:index.php');
            
        } else {
         echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Sorry","New User cannot be Added!","error");';
            echo '}, 1000);</script>';

        //echo "Error: " . $sql . "<br>" . $conn->error;
        }
       
        
        }
   // }
    }
     $conn->close();   
    }


require_once 'sidebar.php'; 
?>


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
                            <li><a href="tables-data.php">Add New User</a></li>
                            <li class="active">New User Form</li>
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

                                                <form name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                                    <div class="card-header">
                                                        <strong>Add New User</strong>
                                                    </div>
                                                    <div class="card-body card-block">
                                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">


            <div class="row form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
           <div class="col col-md-3"><label>Name</label></div>
               <div class="col-12 col-md-9">
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <small class="form-text text-muted">Please Enter name</small>
                <span class="help-block"><?php echo $username_err; ?></span>
                </div>
            </div>


                                                            <div class="row form-group">
                                                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Role</label></div>
                                                                <div class="col-12 col-md-9"><input type="text" id="role" name="role" value="<?php echo $role;?>" placeholder="Role" class="form-control"><small class="form-text text-muted">Role should be of subscriber</small></div>
                                                            </div>


                                                            
            <div class="row form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <div class="col col-md-3"><label>Password</label></div>
                <div class="col-12 col-md-9">
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
                </div>
            </div>
            
            <div class="row form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <div class="col col-md-3"><label>Confirm Password</label></div>
                <div class="col-12 col-md-9">
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>            
            </div>
                                                          
                                                                

                                                                <div class="row form-group">
                                                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Active/Inactive</label></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="select" id="select" class="form-control">
                                                                            <option value="1">1</option>
                                                                            <option value="0">0</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="row form-group">
                                                                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">File input</label></div>
                                                                    <div class="col-12 col-md-9"><input type="file" id="file" accept="image/*" name="file" class="form-control-file"></div>
                                                                </div>
                                                    </div>
                                                    <div class="card-footer">

                                                        <button type="submit" id="sub" name="submit" value="submit" class="submit btn btn-primary btn-sm">
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

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>

                          <!--   <script>
                                $("body").on("click",".submit",function(){
                                    alert("Done");

                                    //swal("added","New user Added","success");
                                });
                            </script> -->
</body>
</html>