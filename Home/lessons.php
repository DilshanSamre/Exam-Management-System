<?php
//start session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the value sent from subjects.php
        $_SESSION['SubId'] = $_POST["SValue"];
      }
      
      if (!isset($_SESSION['SubId'] , $_SESSION['GId'])) {
                 header("location: grades.php");
}
    $SubId = $_SESSION['SubId'];
    $GId = $_SESSION['GId'];

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

<html>
    <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">
        <title>Lessons</title>

    </script>
    </head>

    <body>
        <?php include 'stu_headerN.php';?>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "exam";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            //query
            $sql = "SELECT 	LId, GId, SubId, LName  FROM lessons WHERE GId=$GId AND SubId=$SubId";
            $result = $conn->query($sql);
            $lessonCounter = 0;
            
        ?>

        <div class="site-section home">
            <div class="grid-container">
                    <div class="row g-12">
                        <h3 class="ml-4 mt-4">Grade <?php echo $GId; echo " "; echo $Subject ?> Lessons</h3>  
                    </div>
                    <div class="row g-12 mt-2">
                        <div class="col-md-9">

                        <!-- confirmbox funtion -->
                        <script>
                            function myFunction(event) {
                                let text = "Exam is ready to Begin.\nAre you sure you want to start the exam? ";
                                if (confirm(text) == true) {
                                    const conBox = document.getElementById('confirmation');
                                    conBox.action = "examView.php";
                                }else{
                                    window.location.reload();
                                }
                            }

                        </script>

                            <?php
                            //display Lessone list
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $lessonCounter = $lessonCounter + 1;
                                        $setLessonName = $lessonCounter .". ". $row["LName"];
                                        echo '
                                                <div class=" text-center ml-5">
                                                    <form id="confirmation"  method="post">
                                                        <input type="hidden" name="LValue" value="'.$row["LId"].'"/>
                                                        <input onclick="myFunction()" class="btn mb-1 col-md-12 text-left" type="submit" value="'.$setLessonName.'">
                                                    </form>
                                                </div>';                                    }
                                } else {
                                    echo "<div class='service-item-h'><h5>No results to show.</h5></div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>            

            </div>
        </div>

    </body>
</html>