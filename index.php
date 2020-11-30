<?php
session_start();



if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "includes/config.php";
$class_name_edit = $section_edit = $detail_edit = $room_edit = "";
if(isset($_GET['class_code']) && !isset($_GET['edit'])){
    $class_code = $_GET['class_code'];
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM list_class where email = '$email' and class_code = '$class_code' ";
    $qry= mysqli_query($link,$sql);
    if ($qry->num_rows > 0) {
        while($row=mysqli_fetch_assoc($qry)){
            if($row['teacher'] == 0 ){
                $sql1 = "DELETE FROM list_class WHERE class_code = '$class_code' and email='$email'"; 
                if( mysqli_query($link,$sql1)){ 
                    header("location:../index.php?email=$email");
                } else{ 
                    $message_err = "Somthing is wrong . Please try agian later.";
                } 
            }
            else{
                $sql2 = "DELETE FROM list_class WHERE class_code = '$class_code' "; 
                if( mysqli_query($link,$sql2)){
                    $sql3 = "DELETE FROM classroom WHERE class_code = '$class_code' "; 
                    if( mysqli_query($link,$sql3    )){
                        header("Location:../index.php?email=$email");
                    }
                } else{ 
                    $message_err = "Oh !!! Somthing is wrong . Please try agian later.";
                } 
            }
        }
    }
   
    $message_err = "Oh ! Bạn chưa có nhập tên lớp học . Vui lòng nhập lại ";

    mysqli_close($link);
}

else if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_SESSION['email'];
    $class_code = $_SESSION['class_code'];
    if(!empty(trim($_POST["class_name_edit"]))){
        $sql = "UPDATE classroom SET class_name = ?, section = ? , detail = ? , room = ? WHERE class_code = ? ";
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssii", $param_class_name, $param_section,$param_detail , $param_room , $param_class_code);
            $param_class_name = $_POST['class_name_edit'];
            $param_section = $_POST['section_edit'];
            $param_detail = $_POST['detail_edit'];
            $param_room = $_POST['room_edit'];
            $param_class_code = $class_code;
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php?email=$email");
            } else{
                $message_err= "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        } else{
            $message_err = "Oh ! Bạn chưa có nhập tên lớp học . Vui lòng nhập lại ";
            header("location: login.php?email = $email");
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
        <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tạo Lớp Học</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        <form class=" animate" id="edit_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                            <div class="form_group">
                                <div class="container infor_create" <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>>
                                    <input type="text"  placeholder="Tên Lớp" name="class_name_edit"  value="<?php echo $class_name_edit;?>">
                                </div>
                                <div class="container infor_create" <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>>
                                    <input type="text"  placeholder="Tiêu Đề" name="section_edit"  value="<?php echo $section_edit;?>">
                                </div>
                                <div class="container infor_create" <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>>
                                    <input type="text"  placeholder="Chi Tiết" name="detail_edit"  value="<?php echo $detail_edit;?>">
                                </div>
                                <div class="container infor_create" <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>>
                                    <input type="text"  placeholder="Phòng học" name="room_edit"  value="<?php echo $room_edit;?>">
                                </div>
                                
                            </div>
                        </form>  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href='../index.php'">Hủy</button>
                        <button type="submit"  class="btn btn-green" form="edit_form" id="submit"value="Submit">Tham Gia</button>
                    </div>
                </div>
            </div>
        </div>
        
    <hr >
    <?php
    if($err){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                <strong>Error!</strong> '. $err.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">  
                        <span aria-hidden="true">×</span>  
                    </button> 
                </div> ';
    }
    else{
    ?>
    <?php 
        error_reporting(0);
        if($message_err) { 

            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                        <strong>Error!</strong> '. $message_err.'
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">  
                                <span aria-hidden="true">×</span>  
                            </button> 
                        </div> ';
        } 

    ?>
    <div class="container-fluid " >

        <?php 
            require_once "includes/config.php";
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM list_class where email = '$email' and teacher = 0";
            $qry= mysqli_query($link,$sql);
            if ($qry->num_rows > 0) {
                ?> 
                
                    <div class="round-border">
                        <div class="head_border">
                            <h2 style="color:black;">Học viên</h2>
                        </div>
                        <div class="row">
                <?php
                
                while($row=mysqli_fetch_assoc($qry)){
                    $class_code = $row['class_code'];
                    $sql1 = "SELECT * FROM classroom WHERE class_code = '$class_code'";
                    $qry1= mysqli_query($link,$sql1);
                    $sql2 = "SELECT * FROM users a,list_class b where a.email = b.email and b.teacher = 1 and b.class_code = '$class_code' ";
                    $qry2= mysqli_query($link,$sql2);   
                    
                    while($row1=mysqli_fetch_assoc($qry1)){
                        while($row2=mysqli_fetch_assoc($qry2)){
                
                            ?>
                                <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                                    <div class="card " >
                                        <div class="card-header">
                                            <div class="title">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="head">
                                                            <a href="#">
                                                                <h4 class="header_title" id = "class_code"><?php echo $row1['class_name']; ?></h4>
                                                                <span  class="header_section"><?php echo $row1['section']; ?></span>
                                                            </a>
                                                            
                                                        </div>
                                                        <div class="author">
                                                            <p style="font-size: 14px;"><?php echo $row2['full_name']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 select">
                                                        <div class="dropdown ">
                                                            <span data-toggle="dropdown" id = "span_card"><i class="fas fa-ellipsis-v" id="select_card"></i></span>
                                                            <ul class="dropdown-menu action_select dropdown-menu-right" aria-labelledby="span_card">
                                                                <li><a href="../index.php?email=<?php echo $email?>&class_code=<?php echo $class_code ?>" id="confirmation">Hủy đăng kí</a></li>
                                                            </ul>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <span class="upcoming">Upcoming</span>
                                            <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                                        </div>
                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                            <?php
                        }
                    }      
                        
                    
                }
            
                ?> 
                        </div>
                    </div>
                <?php
                
            }
            
        ?>

        <?php 
            require_once "includes/config.php";
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM list_class where email = '$email' and teacher = 1";
            $qry= mysqli_query($link,$sql);
            if ($qry->num_rows > 0) {
                ?> 
                    <!-- Giáo viên -->
                    <div class="round-border">
                        <div class="head_border">
                            <h2 style="color:black;">Giáo viên</h2>
                        </div>
                        <div class="row">
                <?php
                while($row=mysqli_fetch_assoc($qry)){
                    $class_code = $row['class_code'];
                    $sql1 = "SELECT * FROM classroom WHERE class_code = '$class_code'";
                    $qry1= mysqli_query($link,$sql1);
                    while($row1=mysqli_fetch_assoc($qry1)){
                        if($row1['section'] == NULL){
                            $row1['section'] = 'section';
                        }
                        ?>
                            <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                                <div class="card " >
                                    <div class="card-header">
                                        <div class="title">
                                            <div class="row">
                                                <div class="col-10">
                                                    <a href="#">
                                                        <h4 class="header_title" ><?php echo $row1['class_name']; ?></h4>
                                                        <span  class="header_section"><?php echo $row1['section']; ?></span>
                                                    </a>
                                                    <p style="font-size: 14px;"><?php echo $_SESSION['full_name']; ?></p>
                                                </div>
                                                <div class="col-2 select">
                                                    <div class="dropdown ">
                                                        <span data-toggle="dropdown" id = "span_card"><i class="fas fa-ellipsis-v" id="select_card" name ="class_code" value = "<?php echo $class_code ?>"></i></span>
                                                        <ul class="dropdown-menu action_select dropdown-menu-right" aria-labelledby="span_card">
                                                            <li><a href="../index.php?email=<?php echo $email?>&class_code=<?php echo $class_code ?>&edit=<?php echo 'true'?> "  >Sửa thông tin</a></li>
                                                            <li><a href="../index.php?email=<?php echo $email?>&class_code=<?php echo $class_code ?> " id="confirmation_teacher">Xóa Lớp</a></li>
                                                        </ul>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        <span class="upcoming">Upcoming</span>
                                        <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                            
                        <?php
                    }
                }
            }
            ?>
                        </div>
                    </div> 
            <?php
        ?>
    
    </div>
    
    <?php }?>

    <?php include "includes/script.php";?>
</body>
</html>



<?php 
if(isset($_GET['edit']) && isset($_GET['class_code'])){
    $class_code = $_GET['class_code'];
    $_SESSION['class_code'] = $class_code;
    echo "<script>modal2();</script>";
}
?>