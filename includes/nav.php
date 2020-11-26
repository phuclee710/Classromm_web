<nav class="navbar navbar-expand-lg  " style="background-color:rgb(31,163,99);">
    <div class="container-fluid">
        <div class="brand">
            <div class="nav_left">
                <div class="bar_nav" id="bar_icon">
                    <span class="navbar-toggler-icon" id="main_menu"><i class="fas fa-bars fa-lg"></i></span>
                </div>
                <div class="bar_nav">
                    <a href="index.php">
                    <span>  <img src="../img/google.png" alt="" height="45px" width="87px">
                         Classroom</span>
                    </a>
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
                                <!-- <a href="../join.php">Vào Lớp Học </a>
                                <a href="../create.php">Tạo Lớp Học </a> -->
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Smzall Modal</button>

                                <!-- Modal -->
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Modal Header</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>This is a small modal.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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