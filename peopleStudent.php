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
    <script src='main.js'></script>

    <title>STREAM</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
  <?php
    $result = getClassTeacherById($_GET['id']);
  ?>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <nav class="navbar fixed-top navbar-expand-sm navbar-light">
        <span onclick="togMenu()">&#9776;</span>
        <a class="navbar-brand mb-0 navname" href="homestudent.php?username=<?=$_GET['studentEmail']?>">Trang chủ</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        
        <ul class="nav navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link" href="classstudent.php?id=<?=$_GET['id']?>&studentEmail=<?=$_GET['studentEmail']?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#classworksrc">Classwork</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="peopleStudent.php?id=<?=$_GET['id']?>&studentEmail=<?=$_GET['studentEmail']?>">People</a>
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
          <div class="col-lg-3">
              
          </div>
          <div class="col-lg-6">
            <main class="danhsach"> 
                <div>
                    <div>
                      <h2>Teacher</h2>
                    </div>
                  <table class="teacher-name">
                    <tbody>
                      <tr>
                        <td>
                          <div>
                            <span><?=$result['lastname'] . ' ' . $result['firstname']?></span>
                          </div>
                        </td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div>
                  <div>
                    <h2>ClassMates</h2>
                  </div>
                </div>
                <table class="students-name">
                  <tbody>
                    <?php
                      $result = findStudentByClassID($_GET['id']);
                      while($row = $result['result']->fetch_assoc())
                      {
                    ?>

                    <tr>
                      <td>
                          <span><?=$row['studentemail']?></span>
                      </td>
                      <td></td>
                      
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
                
            </main>
            
          </div>
          <div class="col-lg-3">
          
          </div>
        </div>     
    </div>

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
            <?php
                $resultClass = getClassForStudent($_GET['studentEmail']);
                while($row = $resultClass->fetch_assoc())
                {
            ?>
                  <a href="classstudent.php?id=<?=$row['id']?>&studentEmail=<?=$_GET['studentEmail']?>"><?=$row['classname']?></a>
            <?php
                }
            ?>
      </div>

  
</body>
</html>