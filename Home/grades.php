<?php
  session_start();

?>

<html>
    <head>
      <title>Grades</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
  </head>

<body>
<?php include 'stu_headerN.php';?>


    
      <div class="site-section home">
        <div class="grid-container">

        <div class="row g-4">
          <div class="service-item-h">
            <h1>Select a Grade</h1>
          </div>
        </div>

          <div class="row g-4">
                <div class="col-md-4">
                  <div class="text-center pt-3">
                    <!-- <div class="p-5"> -->
                      <form method="POST" action="subjects.php">
                        <input type="hidden" name="GValue" value="6">
                        <input class="btn mb-1 col-md-12 p-5" type="submit" value="Grade 6">
                      </form>
                    <!-- </div> -->
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="text-center pt-3">
                    <!-- <div class="p-5"> -->
                      <form method="POST" action="subjects.php">
                        <input type="hidden" name="GValue" value="7">
                        <input class="btn mb-1 col-md-12 p-5" type="submit" value="Grade 7">
                      </form>
                    <!-- </div>  -->
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="text-center pt-3">
                    <!-- <div class="p-5"> -->
                      <form method="POST" action="subjects.php">
                        <input type="hidden" name="GValue" value="8">
                        <input class="btn mb-1 col-md-12 p-5" type="submit" value="Grade 8">
                      </form>
                    <!-- </div>  -->
                  </div>
                </div>
          </div>  
          

        <div class="row g-4">  
          <div class="col-md-4">
            <div class="text-center pt-3">
              <!-- <div class="p-5"> -->
                <form method="POST" action="subjects.php">
                  <input type="hidden" name="GValue" value="9">
                  <input class="btn mb-1 col-md-12 p-5" type="submit" value="Grade 9">
                </form>
              <!-- </div>  -->
            </div>
          </div>

          <div class="col-md-4">
            <div class="text-center pt-3">
              <!-- <div class="p-5"> -->
                <form method="POST" action="subjects.php">
                  <input type="hidden" name="GValue" value="10">
                  <input class="btn mb-1 col-md-12 p-5" type="submit" value="Grade 10">
                </form>
              <!-- </div>  -->
            </div>
          </div>

          <div class="col-md-4">
            <div class="text-center pt-3">
              <!-- <div class="p-5"> -->
                <form method="POST" action="subjects.php">
                  <input type="hidden" name="GValue" value="11">
                  <input class="btn mb-1 col-md-12 p-5" type="submit" value="Grade 11">
                </form>
                <!-- </div>  -->
              </div>
            </div>
          </div>
        </div>  
        </div>
      </div>  


  </body>
</html>


