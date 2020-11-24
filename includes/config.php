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
        function sendActivationEmail($email,$token){
        

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
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
                $mail->Subject = 'Xác minh tài khoản của bạn';
                $mail->Body    = "Click <a href='http://localhost/index.php '>vào đây</a> để xác minh tài khoảng của bạn ";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                return true;
            } catch (Exception $e) { 
                return false;
            }
        }
        
        function activeAccount($email,$token){
            $sql = 'SELECT username from users where email = ? and 
            activate_token = ? and activated = 0';

            $stm = $link->prepare($sql);
            $stm-> blind_param('ss',$email,$token);

            if(!$stm->execute()){
                return array('code' => 1, 'error' => 'Can not execute command');
            }
            $result = $stm->get_result();
            if($result->num_rows == 0){
                return array('code' => 2, 'error' => 'Email address or token not found');
            }

            //found

            $sql = "UPDATE users set activated = 1 , activate_token = '' where email = ? ";
            $stm = $link->prepare($sql);
            $stm-> blind_param('s',$email);

            if(!$stm->execute()){
                return array('code' => 1, 'error' => 'Can not execute command');
            }
            sendActivationEmail($email,$token);
            return array('code' => 0, 'error' => 'Account activated');
        
        }
    }


?>