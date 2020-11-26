<?php
session_start();
require_once "includes/config.php" ;
 
$new_password = $confirm_password = $email = "";

$display_email = filter_input(INPUT_GET,'email',FILTER_SANITIZE_EMAIL);
$message_err = '';
if( isset($_GET['email']) && isset($_GET['token']) && isset($_GET['exp'])){
    $email = $_GET['email'];
    $token = $_GET['token'];
    $current = time();
    $exp = $_GET['exp'];

    if(filter_var($email, FILTER_SANITIZE_EMAIL) === false ){
        $message_err = 'This is not a valid email address';
    }
    else if (strlen($token) != 32 ){
        $message_err = 'This is not a valid reset token';
    }
    
    else if ($exp < $current){
        $message_err = 'Your token has expired';
    }
}
else if ($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $message_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $message_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($message_err) && ($new_password != $confirm_password)){
            $message_err = "Password did not match.";
        }
    }

    $email = trim($_POST["email"]);
    if(!is_email_exists($email,$link)){
        $email_err = "This email is not exist.";
    }
        
    if(empty($message_err) ){
        $sql = "UPDATE users set password = ? where email = ? ";
        
        $stmt = $link->prepare($sql);
        $param_email = $email;
        $param_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt->bind_param("ss",$param_password, $param_email);

        if($stmt->execute()){
            header('location:../index.php');
            exit();
        }
        else{
            $message_err = "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
        
        
    }
    
    mysqli_close($link);
}
else{
    $message_err = 'Invalid email address or token ';
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
            <div class="col-sm-12">
                <div class=" reset">
                    <div class="wrapper">
                        <h2>Reset Password</h2>
                        <p>Please fill out this form to reset your password.</p>
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
                        else{
                           ?><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novaliddate method="post"> 
                            
                           <div class="form-group reset_form <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                               <label>Email</label>
                               <input  class="input_text" name="email" class="form-control" value="<?=  $display_email; ?> " readonly>
                               <span class="help-block"><?php echo $message_err; ?></span>
                           </div>
                           <div class="form-group reset_form <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                               <label>New Password</label>
                               <input type="password" class="input_text" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                               <span class="help-block"><?php echo $message_err; ?></span>
                           </div>
                           <div class="form-group reset_form <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                               <label>Confirm Password</label>
                               <input type="password" class="input_text" name="confirm_password" class="form-control">
                               <span class="help-block"><?php echo $message_err; ?></span>
                           </div>
                           <div class="form-group reset_form" id="button_reset">
                               <button type="submit" class="btn btn--gradient" >Change Password</button>
                               <a class="btn btn--gradient" href="index.php" >Cancel</a>
                           </div>
                       </form> <?php
                        }
                        
                    
                        ?>
                    
                        
                    </div> 
                </div>  
            </div>
        
    </div>   
</body>
</html>