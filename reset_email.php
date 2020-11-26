<?php
    session_start();

    $email_error ='';
    require_once "includes/config.php" ;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["email"]))){
            $email_error = "Please enter email.";
        } else{
            $email = trim($_POST["email"]);
            if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
                $email_error = "Invalid email address";
            }
            else{
                $email_error = reset_password($email,$link);
            }
        }
        
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/head.php"?>
    <title>Classroom</title>
</head>
<body>
    <?php include "includes/nav.php"?>
    <div class="wrapper">
        <h2><center>Find your email</center></h2>
        <p><center>Enter your email </center></p>
        <?php 
                error_reporting(0);
                if($email_error){
                    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                                <strong>Error ! </strong> '. $email_error.'
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">  
                                        <span aria-hidden="true">×</span>  
                                    </button> 
                                </div> '; 
                }
                
            
            ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post">
            <div class="subscribe-form <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="email" name="email" class="subscribe-form-input" placeholder="Enter your email"  value="<?php echo $email; ?>">
                <input type="submit" class="subscribe-form-button" value="Submit">

            </div>
        </form>
    </div>
</body>
</html>