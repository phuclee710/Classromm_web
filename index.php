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

    <div class="container-fluid " >
        <div class="round-border">
            <div class="head_border">
                <h2 style="color:black;">Học viên</h2>
            </div>
            <div class="row">
                <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                    <div class="card " >
                        <div class="card-header">
                            <div class="title">
                                <a href="#">
                                    <h4 class="header_title" >Hello World</h4>
                                    <span  class="header_section">Version</span>
                                </a>
                                <p style="font-size: 14px;">Lê Ngọc Nhơn</p>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <span class="upcoming">Upcoming</span>
                            <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>

                <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                        <div class="card " >
                            <div class="card-header">
                                <div class="title">
                                    <a href="#">
                                        <h4 class="header_title" >Hello World</h4>
                                        <span  class="header_section">Version</span>
                                    </a>
                                    <p style="font-size: 14px;">Lê Ngọc Nhơn</p>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <span class="upcoming">Upcoming</span>
                                <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                </div>
                <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                        <div class="card " >
                            <div class="card-header">
                                <div class="title">
                                    <a href="#">
                                        <h4 class="header_title" >Hello World</h4>
                                        <span  class="header_section">Version</span>
                                    </a>
                                    <p style="font-size: 14px;">Lê Ngọc Nhơn</p>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <span class="upcoming">Upcoming</span>
                                <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                </div>
                <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                        <div class="card " >
                            <div class="card-header">
                                <div class="title">
                                    <a href="#">
                                        <h4 class="header_title" >Hello World</h4>
                                        <span  class="header_section">Version</span>
                                    </a>
                                    <p style="font-size: 14px;">Lê Ngọc Nhơn</p>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <span class="upcoming">Upcoming</span>
                                <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                </div>
                <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                        <div class="card " >
                            <div class="card-header">
                                <div class="title">
                                    <a href="#">
                                        <h4 class="header_title" >Hello World</h4>
                                        <span  class="header_section">Version</span>
                                    </a>
                                    <p style="font-size: 14px;">Lê Ngọc Nhơn</p>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <span class="upcoming">Upcoming</span>
                                <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                </div>
            </div>
        </div>

        <!-- Giáo viên -->
        <div class="round-border">
            <div class="head_border">
                <h2 style="color:black;">Giáo viên</h2>
            </div>
            <div class="row">
                <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                        <div class="card " >
                            <div class="card-header">
                                <div class="title">
                                    <a href="#">
                                        <h4 class="header_title" >Hello World</h4>
                                        <span  class="header_section">Version</span>
                                    </a>
                                    <p style="font-size: 14px;">Lê Ngọc Nhơn</p>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <span class="upcoming">Upcoming</span>
                                <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                </div>

                <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                        <div class="card " >
                            <div class="card-header">
                                <div class="title">
                                    <a href="#">
                                        <h4 class="header_title" >Hello World</h4>
                                        <span  class="header_section">Version</span>
                                    </a>
                                    <p style="font-size: 14px;">Lê Ngọc Nhơn</p>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <span class="upcoming">Upcoming</span>
                                <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                </div>
                <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                        <div class="card " >
                            <div class="card-header">
                                <div class="title">
                                    <a href="#">
                                        <h4 class="header_title" >Hello World</h4>
                                        <span  class="header_section">Version</span>
                                    </a>
                                    <p style="font-size: 14px;">Lê Ngọc Nhơn</p>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <span class="upcoming">Upcoming</span>
                                <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                </div>
                <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                        <div class="card " >
                            <div class="card-header">
                                <div class="title">
                                    <a href="#">
                                        <h4 class="header_title" >Hello World</h4>
                                        <span  class="header_section">Version</span>
                                    </a>
                                    <p style="font-size: 14px;">Lê Ngọc Nhơn</p>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <span class="upcoming">Upcoming</span>
                                <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                </div>
                <div class="fivecolumns .col-md-2, .fivecolumns .col-sm-2, .fivecolumns .col-lg-2  m-3" >
                        <div class="card " >
                            <div class="card-header">
                                <div class="title">
                                    <a href="#">
                                        <h4 class="header_title" >Hello World</h4>
                                        <span  class="header_section">Version</span>
                                    </a>
                                    <p style="font-size: 14px;">Lê Ngọc Nhơn</p>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <span class="upcoming">Upcoming</span>
                                <a href=""><p class="card-text">title anddsadasdasdasdasdasdas make up the bulk ofádasdasdasdasdas the card's content.</p></a>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                </div>
            </div>
         
            
            
        </div>
    </div>
    
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="../js/all.js"></script>
</body>
</html>