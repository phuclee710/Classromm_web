<?php
    // Include config file
    require_once "includes/config.php";
    error_reporting(0);
    $class_code = $class_name = $section = $detail = $room = "";
    $message_err = $err = "";
    $email_default = $_SESSION['email'];
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $_SESSION['email'] = $_GET['email'];
        $_SESSION['class_code'] = $_GET['class_code'];
        $_SESSION['full_name'] = $_GET['full_name'];
        if(isset($_GET['teacher'])){
            $_SESSION['teacher'] = $_GET['teacher'];
        }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(trim($_POST["add_member"])){
            $email = $_POST["add_member"];
            $class_code = $_GET["class_code"];
            if(!is_email_exists($email,$link)){
                $message_err = "This email is not exist.";
            }
            $sql = "SELECT id_list FROM list_class where email = ? and class_code =  ? ";
            if($stmt = mysqli_prepare($link, $sql)){ 
                mysqli_stmt_bind_param($stmt, "si",$param_email, $param_class_code);
                $param_class_code = $class_code ;
                $param_class_code = $email;

                if(mysqli_stmt_execute($stmt)){
                    
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 0){
                        $sql1 = "SELECT class_name FROM classroom where class_code =  ?";
                        if($stmt = mysqli_prepare($link, $sql)){ 
                            mysqli_stmt_bind_param($stmt, "i", $param_class_code);
                            $param_class_code = trim($_POST["class_code"]);

                            if(mysqli_stmt_execute($stmt)){
                                mysqli_stmt_store_result($stmt);
                                session_start();
                                $class_name = 'helo';
                               

                                if(mysqli_stmt_num_rows($stmt) == 1){
                                    $sql1 = 'INSERT INTO list_class(email,class_code) VALUES(?,?)';

                                    if($stmt1 = mysqli_prepare($link, $sql1)){
                                        mysqli_stmt_bind_param($stmt1, "si", $param_email,$param_class_code);

                                        $param_email = $email;
                                        $param_class_code =  $class_code ;
                                        
                                        if(mysqli_stmt_execute($stmt1)){
                
                                            header("location:../index.php?email=$email");

                                        }else{
                                            $message_err = "The student already join in";
                                        }
                                        mysqli_stmt_close($stmt1);
                                    }
                                }
                            }
                        }
                    }else{
                        $message_err = "The student already join in";
                    }
                }
                mysqli_stmt_close($stmt);
            }else{
                $message_err = "Oh !! Something is wrong. Please try again later.";
            }
        }
    }

?>





<nav class="navbar navbar-expand-lg   " >
    <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tham Gia Lớp Học</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">    
                    <form class=" animate" id="create_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                        <div class="form_group">
                            <div class="container infor_create <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>" >
                                <input type="text"  placeholder="Nhập vào email" name="add_member" id ="add_member"  value="<?php echo $add_member;?>">
                            </div>
                        </div>
                    </form>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href='../detail.php?email=<?php echo $email_default?>'">Hủy</button>
                    <button type="submit"  class="btn btn-green" form="create_form" value="Submit">Tham Gia</button>
                </div>
            </div>
        </div>
    </div>
    

        <div class="container-fluid ">
                <div class="nav_left_detail">
                    <div class="bar_nav" id="bar_icon">
                        <span class="navbar-toggler-icon" id="main_menu"><i class="fas fa-bars fa-lg"></i></span>
                    </div>
                    <div class="bar_nav">
                        <a href="#">
                        <span>  <img src="../img/google.png" alt="" height="45px" width="87px">
                         Classroom</span>
                        </a>
                    </div>
                </div>
                <div class="nav_middle_detail">
                    <div class=" navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item  ">
                                <a class="nav-link middle_item <?php if($page == 'home'){ echo 'action';}?> " href="detail.php">Stream <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link middle_item <?php if($page == 'classroom'){ echo 'action';}?>" href="#">Classroom</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link middle_item <?php if($page == 'people'){ echo 'action';}?>"  href="people.php">People</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="nav_right_detail">
                    <ul class="navbar-nav ml-auto">
                        <div class="dropdown">
                            <li class="nav-item" >
                                <a class="nav_link " href="#" id="acount_sign">
                                    <span><i class="fas fa-user-plus"></i>
                                    </span></a>
                            </li>
                            <div class="dropdown-content">
                                <button type="button" class="btn" data-toggle="modal" data-target="#Modal3">Thêm thành viên</button>
                            </div>
                            
                            </div>
                        <div class="dropdown">
                            <li class="nav-item" >
                                <a class="nav-link" href="#"><span>
                                    <i class="far fa-user-circle fa-2x"></i>
                                </span></a>
                            </li>
                            <div class="dropdown-content">
                                <p id="user_account" ><?php echo"Hi ,"?></p>
                                <hr style="width:110px;border-color:black; margin: auto;">
                                <a href="../reset_login.php">Đổi mật khẩu </a>
                                <a href="../includes/logout.php">Đăng xuất </a>
                            </div>
                            
                        </div>
                        
                    </ul>
                </div>

        </div>
    
    
</nav>