<?php
  session_start();
  
  include 'connection.php';

  $InsId = $_SESSION['InsId'];

  if(!isset($InsId)){
    session_destroy();
    header('Location:../Login/Home.html');
    exit();
  } 

  $res = $conn->query("SELECT * FROM instructor_details WHERE InsId = $InsId")->fetch(PDO::FETCH_ASSOC);
  $_SESSION['SubId'] = $res["SubId"];
  $SubId = $_SESSION['SubId'];

?>

<html>
    <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/style.css">
      <title>Instructor Homepage</title>
  </head>

<body>

<?php include 'instructor_header.php';?>


<div class="site-section home">
    <div class="grid-container">
            <div class="row g-12">
                <div class="col-lg-6 wow zoomIn" data-wow-delay="0.1s" style="min-height: auto;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute " src="images/math.gif" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s" text-align="center">
                 
                    <h1 class="mb-4">Welcome</h1>
                    <p class="mb-4" >Take control of your teaching with our comprehensive exam system.
                        Empower your students with effective lesson creation and result monitoring. Offer personalized feedback and recommendations to your students. Design engaging and informative lessons for your students.</p>
                    <p class="mb-4">Enhance your lessons with interactive question sets. Gain insights into your students' performance and progress.
                        Access comprehensive reports on individual and overall class results. Track the collective progress of your class.
                        Analyze class-wide performance trends through visual representations.</p>
                    
                    <a class="btn btn-primary py-3 px-5 mt-2" href="instructor_grades_results.php">Student Results</a>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="instructor_grades_lessons.php">Customize Lessons</a>
                </div>
            </div>
        </div>
    </div>
    
      
  </body>
</html>