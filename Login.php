<?php 
  session_start();
  ob_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styleForm.css">
    <title>Đăng nhập-Tài Khoản Google</title>

</head>
<body class ="login-form">
<?php

  require_once('connect.php');

  $error = null;
  if(isset($_POST['username']) && isset($_POST['password']))
  {
      $username = $_POST['username'];
      $password = $_POST['password'];
      if(empty($username))
      {
        $error = 'Please enter your email!';
      }
      else if(empty($password))
      {
        $error = 'Please enter your password!';
      }
      else{
        
        $result = login($username,$password);
        if($result['code']==0)
        {
          $data = $result['data'];
          

          if ($data['isGV'] == 1)
          {
            header("Location: hometeacher.php?username=$username");
          }
          else
          {
            header("Location: homestudent.php?username=$username");
          } 
        }
        else
        {
          $error = $result['error'];
        }

      }
  }
?>

    <div class="login-wrapper">
        <form  method="post" action="" class="form">
          <img src="img/avatar.png" alt="">
          <h2>Đăng nhập</h2>
          <div class="input-group">
            <input type="text" name="username" id="loginUser" required>
            <label for="loginUser">Tên email</label>
          </div>
          <div class="input-group">
            <input type="password" name="password" id="loginPassword" required>
            <label for="loginPassword">Mật khẩu</label>
          </div>
         
          <?php
              if (!empty($error)) {
                  echo "<div style='color:red' class='alert alert-danger'>$error</div>";
              }
          ?>
         
          <div class="form-group custom-control custom-checkbox">
              <input <?= isset($_POST['remember']) ? 'checked' : '' ?> name="remember" type="checkbox" class="custom-control-input" id="remember">
              <label class="custom-control-label" for="remember">Remember login</label>
          </div>

          <input type="submit" value="Login" class="submit-btn">

          <div class="  ">
              <p>Don't have an account yet? <a href="Register.php">Register now</a>.</p>
              <p>Forgot your password? <a href="FogotPW.php">Reset your password</a>.</p>
          </div>
        </form>
        
    </div>
    
</body>
</html>