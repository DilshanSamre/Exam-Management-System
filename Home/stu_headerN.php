<?php
    include 'connection.php';

    $SId = $_SESSION['SId'];

    if (!isset($SId)) {
        session_destroy();
        header("Location: ../Login/Home.html");
        exit();
    }

    $query = $conn->query("SELECT * FROM student_details WHERE SId = $SId ")->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="css/style1.css">
    
    <!----===== Boxicons CSS ===== -->
    
    <title>New Header</title> 
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <a href="stu_profile.php"><img src="images/stu_logo.png" alt=""></a>
                </span>

                <div class="text logo-text">
                    <span class="name"><?php echo $query['studentId']; ?></span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'><img style="width: 90%;" src="icons/menu.png"></i>
        </header>

        <div class="menu-bar">
            <div class="menu">


                <ul class="menu-links">
                    <li  class="">
                        <a class="mya" href="stu_home.php">
                            <i  class='bx bx-menu icon' ><img style="width: 50%;" src="icons/home.png"></i>
                            <span  class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="mya" href="grades.php">
                            <i class='bx bx-bell icon'><img style="width: 50%;" src="icons/grade.png"></i>
                            <span class="text nav-text">Select Grade</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="mya" href="std_results.php">
                            <i class='bx bx-pie-chart-alt icon'><img style="width: 50%;" src="icons/result.png"></i>
                            <span class="text nav-text">View Results</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="mya" href="stu_ResultAnalysis.php">
                            <i class='bx bx-heart icon' ><img style="width: 50%;" src="icons/analysis.png"></i>
                            <span class="text nav-text"> Results Analysis</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="mya" href="stu_profile.php">
                            <i class='bx bx-heart icon' ><img style="width: 50%;" src="icons/profile1.png"></i>
                            <span class="text nav-text">Your Profile</span>
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