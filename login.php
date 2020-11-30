<?php
session_start();
error_reporting(0);
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
require_once "includes/config.php" ;
 
$username = $password = "";
$message_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $full_name = trim($_POST["full_name"]);

    if(empty(trim($_POST["username"]))){
        $message_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $message_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($message_err) ){
        $sql = "SELECT id, full_name,email,username, password  FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $full_name, $email,$username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                       
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;   
                            $_SESSION["full_name"] = $full_name;                          
                            $_SESSION["email"] = $email;
                            header("location: index.php?email=$email");
                        } else{
                            $message_err = "The password you entered was not valid.";
                        }
                        
                    }
                } else{
                    $message_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/head.php"?> 
    <title>Sign In</title>
</head>
<body>
    <?php include "includes/nav.php" ?>

    <div class="wrapper" >
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <?php 
                error_reporting(0);
                if($message_err) { 
    
                    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                                <strong>Error!</strong> '. $message_err.'
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">  
                                        <span aria-hidden="true">×</span>  
                                    </button> 
                                </div> ';
                } 
            
            ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            </div>    
            <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <a href="reset_email.php" class="forgot">Forgot password?</a>
            <button id="login-button">Sign in</button>

            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>   
    
  
</body>
</html>