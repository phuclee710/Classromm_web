<?php
    session_start();
    require_once('connect.php');
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src='main.js'></script>
    
    <title>STREAM</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
      $result = getClassTeacherById($_GET['id']);
    ?>

    <nav class="navbar fixed-top navbar-expand-sm navbar-light">
        <span onclick="togMenu()">&#9776;</span>
        <a class="navbar-brand mb-0 navname" href="homestudent.php?username=<?=$_GET['studentEmail']?>">Trang chủ</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        <span class="fa fa-sign-out p-2"></span>
        </button>
        
        <ul class="nav navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link active" href="classstudent.php?id=<?=$_GET['id']?>&studentEmail=<?=$_GET['studentEmail']?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#classworksrc">Classwork</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="peopleStudent.php?id=<?=$_GET['id']?>&studentEmail=<?=$_GET['studentEmail']?>">People</a>
            </li>
        </ul>
        <span class="fa fa-sign-out p-2"></span>
    </nav>

    <div class="container">
        <div class="row">
          <div class="col-sm-12 pt-5">
            <div class="card classbg bg-primary">
              <h1><?=$result['lastname'] . ' ' . $result['firstname']?></h1>
              <h4><?=$result['subject'] . '_' . $result['room']?></h4>
            </div>
          </div>
        </div> 

        <div class="row">
         
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
              <h5 class="card-title">Upcoming</h5>
              <p class="card-text">Woohoo, no work due soon!</p>
              <a href="#" class=" ">View all</a>
              </div>
            </div>
          </div>
          
        <?php
          $feeds = getFeedByClassID($_GET['id']);
          $arrayFeedRevert = array();
          if ($feeds['code'] != 0)
          {
            $error = $feeds['error'];
          }
          else
          {
            while ($row = $feeds['result']->fetch_assoc())
            {
              array_unshift($arrayFeedRevert, $row);
            }
          
            if (isset($arrayFeedRevert[0]))
            {
        ?>
            <div class="col-sm-9">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?=$result['lastname'] . ' ' . $result['firstname']?></h5>
                  <p class="card-text"><?=$arrayFeedRevert[0]['content']?></p>
                
                  <div class="row">
                    <div class="col-sm-10">
                        <div class="input-group">
                            <textarea class="form-control cmt" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-2">
                      <button class="btn btn-primary">Nhập</button>
                    </div>

                  </div>

                  
                </div>
              </div>
            </div>
          </div>
          <?php
              }
              array_shift($arrayFeedRevert);
              foreach ($arrayFeedRevert as $afr)
              {
          ?>

            <div class="row">
          
              <div class="col-sm-3">
                
              </div>
    
              <div class="col-sm-9">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><?=$result['lastname'] . ' ' . $result['firstname']?></h5>
                    <p class="card-text"><?=$afr['content']?></p>
                  
                    <div class="row">
                      <div class="col-sm-10">
                          <div class="input-group">
                              <textarea class="form-control cmt" rows="1"></textarea>
                          </div>
                      </div>
                      <div class="col-sm-2">
                        <button class="btn btn-primary">Nhập</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
              }
            }
            ?>


            

        
      <div class="tab-content" style="height: 100%;">
          <div id="homesrc" class="container tab-pane active"><br>
          </div>
          <div id="classworksrc" class="container tab-pane fade"><br>
          </div>
          <div id="peoplesrc" class="container tab-pane fade"><br>
          </div>
      </div>

      <div id="leftMenu" class="sidenav">
            <a href="javascript:void(0)" class="closeMenubtn" onclick="closeNav()">&times;</a>
            <input type="text" id="searchbar" onkeyup="searchclass()" placeholder="Search for class...">
            <ul id="classlist">
            <?php
                $result = getClassForStudent($_GET['studentEmail']);
                while($row = $result->fetch_assoc())
                {

            ?>
                    <li><a href="classstudent.php?id=<?=$row['id']?>&studentEmail=<?=$_GET['studentEmail']?>"><?=$row['classname']?></a></li>
            <?php
                }
            ?>
            </ul>
        </div>

  
</body>
</html>