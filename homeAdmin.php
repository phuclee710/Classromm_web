<?php
    require_once("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <?php
        if (isset($_GET['updateRole']) and isset($_GET['isAdmin']))
        {
            if (!empty($_GET['updateRole']))
            {
                
                if ($_GET['isAdmin'] == 0)
                {
                    $updateResult = updateRole($_GET['updateRole'], 1);
                }
                else
                {
                    $updateResult = updateRole($_GET['updateRole'], 0);
                }
                header("Location: homeAdmin.php");
            } 
        }
    ?>
    <nav class="navbar navbar-light" style="background-color: #b3b3b3">
		<p class="navbar-brand pl-5 fontColor"><h2>Admin quản lý người dùng</h2></p>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      </button>
      
      <span class="fa fa-sign-out p-2"></span>
	</nav>
    
    


    <div class="background">
        <table class="table table-bordered table">
            <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">isAdmin</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
                $result =  getAllTeacher();
                $error = null;
                if ($result['code'] != 0)
                {
                    $error = $result['error'];
                    echo "<th>$error</th>";
                }
                else
                {
                    $stt = 1;
                    
                    while ($row = $result['result']->fetch_assoc())
                    {
                        $isAdmin = 0;
            ?>

                        <tr>
                            <th scope="row"><?=$stt?></th>
                            <td><?=$row['firstname']?></td>
                            <td><?=$row['lastname']?></td>
                            <td><?=$row['email']?></td>
                            <?php
                                if (empty($row['isAdmin']))
                                {
                                    echo "<td>NO</td>";
                                }
                                else
                                {
                                    $isAdmin = 1;
                                    echo "<td>YES</td>";
                                }
                            ?>
                            <td><a class="btn btn-primary button" href="homeAdmin.php?updateRole=<?=$row['email']?>&isAdmin=<?=$isAdmin?>">Update Role</a></td>
                        </tr>

            <?php
                        $stt++;
                    }
                }
            ?>

            
            </tbody>
        </table>

    </div>
    
</body>


</html>