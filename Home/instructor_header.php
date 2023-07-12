<?php
    include 'connection.php';

    $InsId =  $_SESSION['InsId'];

    if(!isset($InsId)){
      session_destroy();
      header('Location:../Login/Home.html');
      exit();
    } 

    $query = $conn->query("SELECT * FROM instructor_details WHERE InsId = $InsId ")->fetch(PDO::FETCH_ASSOC);
    $InsUname = $query['instructorId'];
    $SubId = $query['SubId'];
  
    if($SubId == '1'){
      $Subject = "Mathematics";
    }
    else if($SubId == '2'){
      $Subject = "Science";
    }
    else if($SubId == '3'){
      $Subject = "English";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="images/ins_logo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name"><?php echo $InsUname; ?></span>
                    <span class="profession"><?php echo $Subject; ?></span>
                    <span class="profession"> Instructor</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'><img style="width: 90%;" src="icons/menu.png"></i>
        </header>

        <div class="menu-bar">
            <div class="menu">


                <ul class="menu-links">
                    <li  class="">
                        <a class="mya" href="instructor_homepage.php">
                            <i  class='bx bx-menu icon' ><img style="width: 50%;" src="icons/home.png"></i>
                            <span  class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="mya" href="instructor_grades_lessons.php">
                            <i class='bx bx-bell icon'><img style="width: 50%;" src="icons/edit.png"></i>
                            <span class="text nav-text">Edit Lesson</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="mya" href="instructor_grades_results.php">
                            <i class='bx bx-pie-chart-alt icon'><img style="width: 50%;" src="icons/result.png"></i>
                            <span class="text nav-text">View Results</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../Login/logout.php">
                        <i class='bx bx-log-out icon' ><img style="width: 50%;" src="icons/logout.png"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>        
            </div>
        </div>

    </nav>
    <section  class="home">

    </section>

    </div>

    <script src="js/script.js"></script>

</body>
</html>