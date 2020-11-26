<?php
session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "includes/config.php" ;
 
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    if(empty($new_password_err) && empty($confirm_password_err)){
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            if(mysqli_stmt_execute($stmt)){
                session_destroy();
                header("location: login.php");
                exit();
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

</head> 
<body>
    <?php include "includes/nav.php"?>
    <div class="container infor">
        <div class="row">
            <div class="col-sm-3 " >
                <h1 class="my-4">Setting</h1>
                <ul class="list-group">
                    <li class="list-group-item"><a href="reset.php">Reset Password</a></li>
                    <li class="list-group-item"><a href="#">Favorite</a></li>
                </ul>
            </div>
            <div class="col-sm-9">
                <div class=" reset">
                    <div class="wrapper">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                            <h2>Reset Password</h2>
                            <p>Please fill out this form to reset your password.</p>
                            <div class="form-group reset_form <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                                <label>New Password</label>
                                <input type="password" class="input_text" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                                <span class="help-block"><?php echo $new_password_err; ?></span>
                            </div>
                            <div class="form-group reset_form <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                <label>Confirm Password</label>
                                <input type="password" class="input_text" name="confirm_password" class="form-control">
                                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                            </div>
                            <div class="form-group reset_form" id="button_reset">
                                <button type="submit" class="btn btn--gradient" >Submit</button>
                                <a class="btn btn--gradient" href="index.php" >Cancel</a>
                            </div>
                        </form>
                    </div> 
                </div>  
            </div>
        </div>
    </div>   
</body>
</html>