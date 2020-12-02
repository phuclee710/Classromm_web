
<?php
    session_start();
    require_once('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="LogoGG" href="Images/LOGO-G.png" />
    <link rel="shortcut icon" href="Images/LOGO-G.png">
    <link rel="stylesheet" href="styleForm.css" />

    <title >Đăng ký tài khoản</title>
</head>
<body class="register-form">

<?php

    $error = '';
    $first_name = '';
    $last_name = '';
    $email = '';
    $pass = '';
    $pass_confirm = '';
    $role = '';

    if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email'])
    && isset($_POST['password']) && isset($_POST['passconfirm']) && isset($_POST['role']))
    {
        $first_name = $_POST['first'];
        $last_name = $_POST['last'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $pass_confirm = $_POST['passconfirm'];
        #Them role
        $role = $_POST['role'];

        
        if (empty($first_name)) {
            $error = 'Please enter your first name';
        }
        else if (empty($last_name)) {
            $error = 'Please enter your last name';
        }
        else if (empty($email)) {
            $error = 'Please enter your email';
        }
        else if (empty($email)) {
            $error = 'Please enter your email';
        }
        else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $error = 'This is not a valid email address';
        }
        else if (empty($pass)) {
            $error = 'Please enter your password';
        }
        else if (strlen($pass) < 6) {
            $error = 'Password must have at least 6 characters';
        }
        else if ($pass != $pass_confirm) {
            $error = 'Password does not match';
        }
        else{
            $result = register($email,$pass,$first_name,$last_name,$role);
            if($result['code']==0)
            {
                header("Location: Login.php");               
            }

            else if($result['code']==1){
                $error = 'This email is already exists';
            }
            else{
                $error = 'An error occured. Please try again later';
            }
        }
    }
?>


<div class="container">
        <div class="row">
            <div class="col-lg-3">

            </div>
            <div class="col-lg-6">
                <div id ="ui">
                    <h1 >Đăng ký tài khoản</h1>
                    <form action="" class="form-group" method="post">
                        <div class="form-group col-lg-6">
                            
                            <input value="" name="first" required class="form-control" type="text"  id="firstname">
                            <label for="firstname">First Name</label>
                        </div>
                        <div class="form-group col-lg-6">
                            
                            <input value="" name="last" required class="form-control" type="text"  id="lastname">
                            <label for="firstname">Last Name</label>
                        </div>
                        <div class="form-group col-lg-12" >
                            
                            <input value="" name="email" required class="form-control" type="email"  id="email">
                            <label for="email">Email</label>
                        </div>
                        
                        <div class="form-group col-lg-6" >
                            
                            <input value="" name="password" required class="form-control" type="password" id="pass">
                            <label for="pass">Password</label>
                        </div>
                        <div class="form-group col-lg-6" >
                            
                            <input value="" name="passconfirm" required class="form-control" type="password"  id="pass">
                            <label for="pass">Confirm Password</label>
                        </div>

                        <span class="role">
                            <b>Role:</b>
                            <input type="radio" name="role" >Giáo viên
                            <input type="radio" name="role" >Học sinh
                        </span>
                        
                        <div class="form-group col-lg-12" >
                        </div>

                        <?php
                            if (!empty($error)) {
                                echo "<div style='color:red' class='alert'>$error</div>";
                            }
                        ?>
                        

                        <div class="form-group col-lg-12" >
                            <button type="submit" class="btn btn-success px-5 mt-3 mr-2">Đăng ký</button>
                            
                        </div>
                        
                        
                        <div class="form-group col-lg-12" >
                            <p>Bạn đã có tài khoản? <a href="Login.php">Đăng nhập ngay</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3">
                    
            </div>
        </div>
    </div>
</body>
</html>