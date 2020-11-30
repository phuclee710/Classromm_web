<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/head.php"?> 
</head>
<body>
    <?php include "includes/nav.php"?> 
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
                                                <div class="head">
                                                    <a href="#">
                                                        <h4 class="header_title" ><?php echo $row1['class_name']; ?></h4>
                                                        <span  class="header_section"><?php echo $row1['section']; ?></span>
                                                    </a>
                                                </div>
                                                <div class="author">
                                                    <p style="font-size: 14px;"><?php echo $row2['full_name']; ?></p>
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
                        ?>
                            <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                                <div class="card " >
                                    <div class="card-header">
                                        <div class="title">
                                            <a href="#">
                                                <h4 class="header_title" ><?php echo $row1['class_name']; ?></h4>
                                                <span  class="header_section"><?php echo $row1['section']; ?></span>
                                            </a>
                                            <p style="font-size: 14px;"><?php echo $_SESSION['full_name']; ?></p>
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