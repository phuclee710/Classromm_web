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
                                <a href="../join.php">Vào Lớp Học </a>
                                <a href="#" onclick="document.getElementById('id01').style.display='block'">Tạo Lớp Học </a>

                                <div id="id01" class="modal">

                                    <form class="modal-content animate" action="Subject1.html" method="post">
                                        <div class="imgcontainer">
                                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                        <h3>Tạo lớp học</h3>
                                        </div>

                                        <div class="container">
                                        <input type="text" placeholder="Tên lớp học (Bắt buộc)" name="uname" required>
                                        
                                        <input type="text" placeholder="Phần" name="psw" required>
                                        
                                        <input type="text" placeholder="Chủ đề" name="psw" required>
                                        
                                        <input type="text" placeholder="Phòng" name="psw" required>
                                        
                                        <input type="password" placeholder="Mật khẩu (nếu có)" name="psw" required>
                                        </div>

                                        <div class="container" style="background-color:#f1f1f1">
                                        <button type="submit" onclick="href:Subject1.html">Tạo</button>
                                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                        </div>
                                    </form>
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