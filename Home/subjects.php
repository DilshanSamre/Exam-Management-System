<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $_SESSION['GId'] = $_POST["GValue"];
}
?>

<html>
    <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">

<link rel="stylesheet" href="css/style.css">
      <title>Subjects</title>
  </head>

<body>
<?php include 'stu_headerN.php';?>

    
      <div class="site-section home">
        <div class="grid-container">

        <div class="row g-4">
          <div class="service-item-h">
            <h1>Select a Subject</h1>
          </div>
        </div>

          <div class="row g-4">
                <div class="col-md-4">
                  <div class="text-center pt-3">
                    <!-- <div class="p-5"> -->
                      <form method="POST" action="lessons.php">
                        <input type="hidden" name="SValue" value="1">
                        <input class="btn mb-1 col-md-12 p-5" type="submit" value="Mathematics">
                      </form>
                    <!-- </div>  -->
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="text-center pt-3">
                    <!-- <div class="p-5"> -->
                      <form method="POST" action="lessons.php">
                        <input type="hidden" name="SValue" value="2">
                        <input class="btn mb-1 col-md-12 p-5" type="submit" value="Science">
                      </form>
                    <!-- </div>  -->
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="text-center pt-3">
                    <!-- <div class="p-5"> -->
                      <form method="POST" action="lessons.php">
                        <input type="hidden" name="SValue" value="3">
                        <input class="btn mb-1 col-md-12 p-5" type="submit" value="English">
                      </form>
                    <!-- </div>  -->
                  </div>
                </div>
          </div>    
        </div>
      </div>  

  </body>
</html>