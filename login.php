<?php
session_start();

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
    }

    require_once "connect.php";

    $username = $password = "";
    $username_err = $password_err = "";


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }

    if(empty($username_err) && empty($password_err)){
        $sql="SELECT * FROM users WHERE users.username='$username' AND users.password='$password'";
        $res=$conn->query($sql);
        if ($res->num_rows==1) {
            while($row = $res->fetch_assoc()){
        // $username1 = $row['username'];
        //$password = $row['password'];
        $currUser=$row['user_id'];

                        // Password is correct, so start a new session
        session_start();
                            
                            // Store data in session variables
        
        $_SESSION["loggedin"] = true;
        $_SESSION["currUser"] = $currUser;
        $_SESSION["username"] = $username;
        // echo $currUser;
        // exit();                      

        $sql2="UPDATE users SET currStatus=1 WHERE user_id='".$currUser."'";
        if ($conn->query($sql2) === TRUE) {
            console.log("success");
        }
        else{
            echo "error";
        }
                            
        }          
                            
                            // Redirect user to welcome page
        
        header("location: welcome.php");
        
        } else {
                // echo "Error: " . $sql . "<br>" . $conn->error;
                $username_err = "Username or password is incorrect!";
        }
    }
        $conn->close(); 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif;
        background-image: url("images/bg3.png"); }
        .form1{ width: 350px; padding: 20px; 
        }

        @keyframes slideInFromLeft {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(0);
        }
    }

    .form1{  
  /* This section calls the slideInFromLeft animation we defined above */
  animation: 1s ease-out 0s 1 slideInFromLeft;
  
  padding: 30px;
}
    </style>
</head>
<body>
    <div class="form1" style="width:800px; margin:0 auto;">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
        </form>

        
    </div>
</body>
</html>