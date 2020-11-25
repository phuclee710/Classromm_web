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
        function sendEmail($email,$token){
        

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();     
                $email->Charset = 'UTF-8';                                       // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'phuclee710@gmail.com';                     // SMTP username
                $mail->Password   = 'doaqfvfxaxugfwbt';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('phuclee710@gmail.com', 'Classroom Clone');
                $mail->addAddress($email, 'Người nhận');     // Add a recipient
                // $mail->addAddress('ellen@example.com');               // Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Khôi phục mật khẩu của bạn';
                $mail->Body    = "Click <a href='http://classroom.local/reset.php'>vào đây</a> khôi phục mật khẩu của bạn ";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                return true;
            } catch (Exception $e) { 
                return false;
            }
        }
        function is_email_exists($email){
            $sql = 'SELECT username from users where email = ?';
            $stm = $link->prepare($sql);
            $stm->blind_param('s',$email);
            if(!$stm->execute()){
                die('Query error : ' , $stm->error);
            }
            $result = $stm->get_result();
            if($result->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }

        function reset_password($email){
            if(!is_email_exists($email)){
                return array('code' => 1 , 'error' => 'Email does not exist');
            }
    
            $token = md5($email . '+ ' . random_int(1000,9999));
            $sql = 'UPDATE reset_token set token = ? where email = ?';
    
            $stm = $link->prepare($sql);
            $stm->blind_param('ss', $token , $email);
    
            if(!$stm->execute()){
                return array('code' => 2 , 'error' => 'Can not execute command');
            }
    
            if($stm->affected_rows == 0){
                $exp = time() + 60;
    
                $sql = 'INSERT INTO reset token values(?,?,?)';
                $stm = $link->prepare($sql);
                $stm->blind_parram('ssi',$email , $token , $exp);
    
                if(!$stm->execute()){
                    return array('code' => 1 ,'error' => 'Can not excute command');
                }
            }
            sendEmail($email,$token);
        }
        
    }
    

?>