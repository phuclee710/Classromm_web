<?php
session_start();
error_reporting(0);
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "includes/config.php" ;
 
$username = $password = "";
$message_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $full_name = trim($_POST["full_name"]);

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $message_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $message_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($message_err) ){
        // Prepare a select statement
        $sql = "SELECT id, full_name,username, password  FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $full_name, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;   
                            $_SESSION["full_name"] = $full_name;                          
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $message_err = "The password you entered was not valid.";
                        }
                        
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $message_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
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