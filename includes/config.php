<?php
    
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require './vendor/autoload.php';

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'classroom');

    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    else{
        function sendEmail($email,$token,$exp){

            $mail = new PHPMailer(true);
            try {
                             
                $mail->isSMTP();     
                $mail->Charset = 'UTF-8';                                    
                $mail->Host       = 'smtp.gmail.com';     
                $mail->SMTPAuth   = true;                             
                $mail->Username   = 'phuclee710@gmail.com';                    
                $mail->Password   = 'doaqfvfxaxugfwbt';                             
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $mail->Port       = 587;                                   

                
                $mail->setFrom('phuclee710@gmail.com', 'Classroom Clone');
                $mail->addAddress($email, 'Người nhận');    
               
                
            
                $mail->isHTML(true);                             
                $mail->Subject = 'Reset Password';
                $mail->Body    = "Click <a href='http://classroom.local/reset.php?email=$email&token=$token&exp=$exp'>vào đây</a> khôi phục mật khẩu của bạn ";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                return true;
            } catch (Exception $e) { 
                return false;
            }
        }
        function is_email_exists($email,$link){
            $sql = 'SELECT username from users where email = ?';
            
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_email);
    
                $param_email = $email;
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   
                    if(mysqli_stmt_num_rows($stmt) == 0){
                        return false;
                    } else{
                        
                        return true;
                    }
                } else{
                    echo "Oh ! Something went wrong. Please try again later.";
                }
     
                mysqli_stmt_close($stmt);
            }
        }

        function reset_password($email,$link){
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            $message = '';
            if(!is_email_exists($email,$link)){
                
                return "The email does not exist";
            }
    
            $token = md5($email . '+ ' . random_int(1000,2000));
            $sql = 'UPDATE reset_token set token = ? where email = ?';
            $exp = time() + 60 * 5;
            
            $stmt = $link->prepare($sql);
            $param_email = $email;
            $param_token = $token;
            $stmt->bind_param("ss", $param_token,$param_email);

                
            // execute the query
            if(!$stmt->execute()){
                return 'Can not execute command';
            }

            if($stmt->affected_rows == 0){
                $sql1 = 'INSERT INTO reset_token values(?,?,?)';

                if($stmt1 = $link -> prepare($sql1)){
                    $stmt1->bind_param( "ssi",$param_email, $param_token, $param_exp);

                    $param_email = $email;
                    $param_token = $token;
                    $param_exp = $exp;
                    $_SESSION["exp"] = $exp;
                    if($stmt1->execute()){
                        header('location:../index.php');
                    }
                    mysqli_stmt_close($stmt1);
                }
                
            } 
                
                sendEmail($email,$token,$exp);
                mysqli_stmt_close($stmt);

            
            
            mysqli_close($link);
            return $message;
        }
        
    }
    

?>