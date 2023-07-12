<?php
session_start();

$SId =  $_SESSION['SId'];

?>

<html>
    <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/style.css">
        <title>Student Homepage</title>
    </head>



<body>  

<?php 
        include 'stu_headerN.php';
?>

<div class="site-section home">
    <div class="grid-container">
            <div class="row g-12">
                <div class="col-lg-6 wow zoomIn" data-wow-delay="0.1s" style="min-height: auto;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute " src="images/hero.gif" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s" text-align="center">
                 
                    <h1 class="mb-4">Welcome</h1>
                    <p class="mb-4" >Get ready to improve your results with our comprehensive exam system.Prepare for your exams with our realistic mock exams.
Practice under exam-like conditions to build confidence and familiarity.</p>
                    <p class="mb-4">Take exams online to evaluate your knowledge and skills.
                    Track your performance and receive instant feedback upon completion. Check your exam results and see how you performed.Identify your strengths and weaknesses to prioritize your study efforts effectively.</p>
                    
                    <a class="btn btn-primary py-3 px-5 mt-2" href="grades.php">View Grades</a>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="request_mock_exam.php">Go for a Mock Exam</a>
                </div>
            </div>
        </div>
    </div>


</body>
</html>