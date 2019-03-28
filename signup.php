<?php
    $server="localhost";
    $user="root";
    $pass="Toor@123";
    $dbname="Sharma";

    $conn=new mysqli($server,$user,$pass,$dbname);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";


    // File upload path
$targetDir = "images/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

//print_r($fileName);die();


    if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["file"]["name"])){
        // print_r($_FILES);
        // die();

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
        $sql="INSERT INTO users(username,password,currStatus,file_name) values('$username','$password1',1,'".$targetFilePath."')";

        if ($conn->query($sql) === TRUE) {

                header('location:login.php');
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }
   // }
    }
     $conn->close();   
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{
                font: 14px sans-serif;
                background-image: url("images/bg3.png"); 
            }
        .form1{ width: 350px; padding: 20px; }

        .form2{padding-left: 270px;}

        @keyframes slideInFromLeft {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(0);
        }
    }

    .form1,.form2{  
  /* This section calls the slideInFromLeft animation we defined above */
  animation: 1s ease-out 0s 1 slideInFromLeft;
  
 
}
    </style>
</head>
<body>
    <div class="form1" style="width:800px; margin:0 auto;">
        <h2>Sign Up</h2>
        <p>Create Account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <label>Select your Display Picture to upload:</label>
        <div class="btn-group" role="group">
            <input type="file"  name="file" id="file" class="btn btn-secondry" accept="image/*">
        </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="submit">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        


        </form>
    </div>   



</body>
</html>