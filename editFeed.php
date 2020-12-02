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


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
  <?php 
    $result = getClassTeacherById($_GET['id']);
    $error = null;

    if (isset($_POST['content']))
    {
      $content = $_POST['content'];
      if (!empty($content))
      {
        $resultUpdate = updateFeed($_GET['feedID'], $content);
        if ($resultUpdate['code'] != 0)
        {
          $error = $resultUpdate['error'];
        }
        else {
          $classID = $_GET['id'];
          $teacherEmail = $_GET['teacherEmail'];
          header("Location: classteacher.php?id=$classID&teacherEmail=$teacherEmail");
        }
      }
    }
    else{
      $content = $_GET['content'];
    }
  ?>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <nav class="navbar fixed-top navbar-expand-sm navbar-light">

        <a class="navbar-brand mb-0 navname" href="#"><?=$result['classname']?></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        
        
        
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
              <div class="add">
                  <h1>Thêm thông báo</h1>
              </div>
            <form action="" class="addFeed" method="post">
                <div class="row">
                    <div class="col-25">
                      <label for="subject">Nội dung</label>
                    </div>
                    <div class="col-75">
                      <textarea id="subject" name="content" placeholder="Write something.."><?=$content?></textarea>
                    </div>
                  </div>
                
                <div class="row">
                  <input type="submit" value="Edit" class="col-lg-3">
                  <span class="col-lg-6"></span>
                </div>
              </form>
              <div class="row">
                <a class="col-lg-3" href="classteacher.php?id=<?=$_GET['id']?>&teacherEmail=<?=$_GET['teacherEmail']?>">Back</a>
              </div>
            
          </div>
          <div class="col-lg-3">
          
          </div>
        </div>     
    </div>

      <div class="tab-content">
          <div id="homesrc" class="container tab-pane active"><br>
          </div>
          <div id="classworksrc" class="container tab-pane fade"><br>
          </div>
          <div id="peoplesrc" class="container tab-pane fade"><br>
          </div>
      </div>
  
</body>
</html>