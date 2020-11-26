<?php
// Include config file
require_once "includes/config.php";

$username = $password = $confirm_password = $full_name = $email = "";
$message_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $message_err = "Please enter a username.";
    } 
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $message_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    if(empty(trim($_POST["full_name"]))){
        $message_err = "Please enter your name.";     
    } else{
        $full_name = trim($_POST["full_name"]);
    }
    
    
    if(empty(trim($_POST["email"]))){
        $message_err = "Please enter your email.";     
    } else if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) === false){
        $message_err = "Invalid email address";
    }else if (is_email_exists(trim($_POST["email"]),$link)){
        $message_err = "This email is already exist";
    }else{
        $email = trim($_POST["email"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $message_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $message_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $message_err = "Please confirm password.";     
    } else{
        
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($message_err) && ($password != $confirm_password)){
            $message_err = "Password did not match.";
        }
    }

    
    if(empty($message_err) ){
       
        $sql = "INSERT INTO users (full_name,email,username, password) VALUES (?,?, ?,?)";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss",$param_full_name, $param_email,$param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_full_name = $full_name;
            $param_email = $email;
            
            if(mysqli_stmt_execute($stmt)){
                header('location:../index.php');

            } else{
                echo "Something went wrong. Please try again later.";
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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/lity.css">

    <!-- Link family font and icon -->
    <link rel="shortcut icon" href="favicon.ico" />
    <script src="https://kit.fontawesome.com/5f6bd21d5d.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Noto+Sans+JP&display=swap" rel="stylesheet">
    
    <link rel="shortcut icon" href="../img/class_icon.png" type="image/png" sizes="16x16">

    <title>Sign In</title>
</head>
<body>
    <?php include "includes/nav.php"?>
    <div class="wrapper" >
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <?php 
                error_reporting(0);
                if($message_err){
                    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                                <strong>Error ! </strong> '. $message_err.'
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">  
                                        <span aria-hidden="true">×</span>  
                                    </button> 
                                </div> '; 
                }
                
            
            ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete="off" method="post">
            <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?php echo $full_name; ?>">
            </div>  
            <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
            </div>  
            <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            </div>   
            
            <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            </div>
            <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-primary" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>