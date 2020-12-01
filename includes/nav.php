<?php
    // Include config file
    require_once "includes/config.php";
    error_reporting(0);
    $class_code = $class_name = $section = $detail = $room = "";
    $message_err = $err = "";
    if(isset($_GET['email']) ){ 
        $email = $_SESSION['email'];
        if(filter_var($email, FILTER_SANITIZE_EMAIL) === false ){
            $err = "Your email is not valid ! Please logsin again";
        }

    }
    else if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_GET['edit'])){
        
        
        if(trim($_POST["class_code"])){
            $email = $_SESSION['email'];
            $class_code = trim($_POST["class_code"]);
            if( $class_code  === 0){
                header("location:../index.php?email=$email");
            }
            else if(empty($message_err)){
                $sql = "SELECT class_name FROM classroom where class_code =  ?";
                if($stmt = mysqli_prepare($link, $sql)){ 
                    mysqli_stmt_bind_param($stmt, "i", $param_class_code);
                    $param_class_code = trim($_POST["class_code"]);

                    if(mysqli_stmt_execute($stmt)){
                        
                        mysqli_stmt_store_result($stmt);

                        if(mysqli_stmt_num_rows($stmt) == 1){
                            
                            $sql1 = 'INSERT INTO list_class(email,class_code) VALUES(?,?)';

                            if($stmt1 = mysqli_prepare($link, $sql1)){
                                mysqli_stmt_bind_param($stmt1, "si", $param_email,$param_class_code);

                                $param_email = $email;
                                $param_class_code = trim($_POST["class_code"]);
                               
                                if(mysqli_stmt_execute($stmt1)){
                                    mysqli_stmt_store_result($stmt1);
                                    if(mysqli_stmt_num_rows($stmt1) == 1){
                                        header("location:../index.php?email=$email");
                                    }
                                }else{
                                    $message_err = "You have already join in the classroom.";
                                }
                                mysqli_stmt_close($stmt1);
                            }
                        }else{
                            $message_err = "The class code is not valid";
                        }
                    }
                    mysqli_stmt_close($stmt);
                }else{
                    $message_err = "The class code is not valid";
                }
            }
            mysqli_close($link);

            echo "<meta http-equiv='refresh' content='0'>";

        } 
        else if( trim($_POST["class_name"])){
            $email = $_SESSION["email"] ;
            if(empty(trim($_POST["class_name"]))){
                $message_err = "Please enter a class name.";
            } 
            else{
                $class_name =$_POST["class_name"];
            }
           

            $section = $_POST['section'];
            $detail = $_POST['detail'];
            $room = $_POST['room'];
            if(empty($message_err)){
                $sql = 'INSERT INTO classroom(class_name,section,detail,room) VALUES (?,?,?,?)';
                $stmt = $link->prepare($sql);
                $param_class_name = $class_name;
                $param_section = $section;
                $param_detail = $detail;
                $param_room = $room;
                $stmt -> bind_param("sssi",$param_class_name,$param_section,$param_detail,$param_room);
                if($stmt->execute()){
                    
                    $sql2 = "SELECT * FROM classroom ORDER BY class_code DESC";
                    $qry= mysqli_query($link,$sql2);
                    if($row=mysqli_fetch_assoc($qry)){
                        $class_code = $row['class_code'];
                    }
                    else{
                        $message_err = "Oh ! Something went wrong. Please try again later.";
                    }
                    $sql1 = 'INSERT INTO list_class(email,class_code,teacher) VALUES(?,?,?)';
                    if($stmt1 = mysqli_prepare($link, $sql1)){
                        mysqli_stmt_bind_param($stmt1, "sii", $param_email,$param_class_code,$param_teacher);
                       
                        $param_email = $email;
                        $param_class_code = $class_code;
                        $param_teacher = 1;
                        if(mysqli_stmt_execute($stmt1)){
                            
                            mysqli_stmt_store_result($stmt1);
                            if(mysqli_stmt_num_rows($stmt1) == 0){
                                
                                header("location:../index.php?email=$email");
                            }
                        }
                        mysqli_stmt_close($stmt1);
                    }
                    

                } else{
                    echo "Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($stmt);
            }
            echo "<meta http-equiv='refresh' content='0'>";

        }
        mysqli_close($link);

        
    }

?>


<nav class="navbar navbar-expand-lg  " style="background-color:rgb(31,163,99);">
    <div class="container-fluid">
        <div class="brand">
            <div class="nav_left">
                <div class="bar_nav" id="bar_icon">
                    <span class="navbar-toggler-icon" id="main_menu"><i class="fas fa-bars fa-lg"></i></span>
                </div>
                <div class="bar_nav">
                    <a href="index.php<?php echo "?email=". $_SESSION['email'] ?>">
                    <span>  <img src="../img/google.png" alt="" height="45px" width="87px">
                         Classroom</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <div class="container infor_create" <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>>
                                    <input type="text"  placeholder="Mã Lớp" name="class_code" id ="class_code" value="<?php echo $class_code;?>">
                                </div>
                            </div>
                        </form>  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href='../index.php'">Hủy</button>
                        <button type="submit"  class="btn btn-green" form="create_form" value="Submit">Tham Gia</button>
                    </div>
                </div>
            </div>
        </div>
         
        <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tạo Lớp Học</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        <form class=" animate" id="infor_create" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="container infor_create">
                                    <input type="text" placeholder="Tên Lớp" name="class_name" value="<?php echo $class_name; ?>">
                                
                                    <input type="text" placeholder="Đặc tả" name="section" value="<?php echo $section; ?>">
                                
                                    <input type="text" placeholder="Chi Tiết" name="detail" value="<?php echo $detail; ?>">
                                
                                    <input type="text" placeholder="Phòng" name="room" value="<?php echo $room; ?>">
                                
                                </div>
                                
                        </form>   
                                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href='../index.php'">Hủy</button>
                        <button type="submit"  class="btn btn-green" form="infor_create" value="Submit">Tạo Lớp</button>
                    </div>
                </div>
            </div>
        </div>
        
                       
        <?php
            error_reporting(0);
            session_start();

            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                
                ?> 
                <div class="nav_right">
                    <ul class="navbar-nav ml-auto">
                        <div class="dropdown">
                            <li class="nav-item" >
                                <a class="nav_link " href="#" id="acount_sign">
                                    <span><i class="fas fa-plus  "></i>
                                    </span></a>
                            </li>
                            <div class="dropdown-content">
                                <button type="button" class="btn" data-toggle="modal" data-target="#Modal">Tham Gia Lớp</button>
                                <button type="button" class="btn" data-toggle="modal" data-target="#Modal1">Tạo Lớp Học</button>
                            </div>
                            
                        </div>
                        
                        <div class="dropdown">
                            <li class="nav-item" >
                                <a class="nav-link" href="#"><span>
                                    <i class="far fa-user-circle fa-2x"></i>
                                </span></a>
                            </li>
                            <div class="dropdown-content">
                                <p id="user_account" ><?php echo"Hi ,".$_SESSION["full_name"]. "."?></p>
                                <hr style="width:110px;border-color:black; margin: auto;">
                                <a href="../reset_login.php">Đổi mật khẩu </a>
                                <a href="../includes/logout.php">Đăng xuất </a>
                            </div>
                            
                        </div>
                        
                    </ul>
                </div>
                <?php
                
            } 
        ?>
        
    </div>
    
</nav>