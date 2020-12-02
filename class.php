<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src='main.js'></script>
    <title>STREAM</title>
</head>
<body>
    <main>
        <div>
            <nav class="navbar fixed-top navbar-expand-lg navbar-light">
                <span onclick="togMenu()">&#9776;</span>
                <a class="navbar-brand mb-0 h1" href="#">CLASS NAME HERE</a>
            </nav>
        </div>

        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#homesrc">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#classworksrc">Classwork</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#peoplesrc">People</a>
                </li>
            </ul>
        </div>

        <div class="tab-content" style="height: 100%;">
            <div id="homesrc" class="container tab-pane active"><br>
              <p>Post and content</p>
            </div>
            <div id="classworksrc" class="container tab-pane fade"><br>
              <p>Work to do</p>
            </div>
            <div id="peoplesrc" class="container tab-pane fade"><br>
              <p>Class members</p>
            </div>
        </div>

        <div id="leftMenu" class="sidenav">
            <a href="javascript:void(0)" class="closeMenubtn" onclick="closeNav()">&times;</a>
            <a href="#">Class 1</a>
            <a href="#">Class 2</a>
            <a href="#">Class 3</a>
            <a href="#">Class 4</a>
        </div>

        <footer>
            <p>Empty</p>
        </footer>
    </main>
</body>
</html>