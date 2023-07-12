<?php
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['getGrades'])) {
        $_SESSION['GId'] = $_POST["GValue"];
    }
    // Retrieve the value sent from instructor_grades_lessons.php
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
        <title>Customize Lessons</title>
    </head>

    <body>
        <?php include 'instructor_header.php';?>
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
            $sql2 = "";
            
        ?>

            <div class="site-section home">
                <div class="grid-container">
                        <div class="row g-12">
                            <h3 class="ml-4">Grade <?php echo $GId; echo " "; echo $Subject ?> Lessons</h3>  
                        </div>
                            
                                <?php
                                //display Lesson list
                                
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            $lessonCounter = $lessonCounter + 1;
                                            $setLessonName = $lessonCounter .". ". $row["LName"];
                                            echo '<div class="row g-12 mt-2 ml-2">
                                                    <div class="col-md-9">
                                                        <div class=" text-center">
                                                            <form action="instructor_questions.php" method="post">
                                                                <input type="hidden" name="LValue" value="'.$row["LId"].'"/>
                                                                <input name="addquestion" class="btn mb-1 col-md-12 text-left" type="submit" value="'.$setLessonName.'">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-4 col-5 pt-1">
                                                        <form action="'.$_SERVER['PHP_SELF'].'" method="post">
                                                            <input type="hidden" name="LValue" value="'.$row["LId"].'"/>
                                                            <input name="DeleteLessons" class="btn btn-danger mb-1 col-md-12" type="submit" value="Delete">
                                                        </form>
                                                    </div>
                                                </div>
                                                    ';
                                        }
                                    } else {
                                        echo "<div class='service-item-h'><h5>No results to show.</h5></div>";
                                    }
                                ?>
                            
                            

                        <div class="row g-12 mt-2">
                            <div class="col-md-10">
                                <div class=" ml-5">
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-4 col-sm-4">
                                                <label for="LNumber">Lesson Number</label>
                                                <input placeholder="Lesson Number" type="number" name="AddLid" value="" required/>
                                            </div>
                                            <div class="form-group col-md-8 col-sm-8">
                                                <label for="LName">Lesson Name</label>
                                                <input placeholder="Lesson Name" type="text" name="AddSValue" value="" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lesson_video">Lesson Video</label>
                                            <br>
                                            <input name="Addlesson_video" type="file">
                                        </div>
                                        <input class="btn btn-primary mb-1 col-md-2 col-sm-4 col-5" name="AddLessons" type="submit" value="Add">
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <?php 
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                
                                if(isset($_POST['AddLessons'])) {
                                    $AddLid = $_POST["AddLid"];
                                    $AddSValue = $_POST["AddSValue"];
                                    $video_name = $_FILES["Addlesson_video"]["name"];
                                    $tmp_name = $_FILES["Addlesson_video"]["tmp_name"];
                                    $size = $_FILES["Addlesson_video"]["size"];

                                    if ($size <= 41943000){
                                            $video_upload_path = 'lesson_videos/' .$video_name;
                                            move_uploaded_file($tmp_name, $video_upload_path);
                                    }
                                    else{
                                        echo "Select a video file less than 40MB.";
                                    }


                                    $sql2 = "INSERT INTO lessons(LId, GId, SubId, LName, VideoLink) VALUES( $AddLid, $GId, $SubId, '$AddSValue', '$video_name')";
                                    if ($conn->query($sql2) === TRUE) {         
                                        echo "<script>window.location.href='instructor_lessons.php';</script>";
                                        exit;
                                    } else {
                                        echo "Error: " . $sql2 . "<br>" . $conn->error;
                                    }
                                }
                                if(isset($_POST['DeleteLessons'])) {
                                    $deleteLid = $_POST["LValue"];
                                    $sql = "DELETE FROM lessons WHERE GId=$GId AND SubId=$SubId AND LId=$deleteLid"  ;
                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>window.location.href='instructor_lessons.php';</script>";
                                        exit;
                                    } else {
                                        echo "Error deleting record: " . $conn->error;
                                    }
                                }
                                
                            } 
                            
                        ?>

                    </div>            
                </div>
            </div>

    </body>
</html>