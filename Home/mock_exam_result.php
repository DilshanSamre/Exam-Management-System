<?php
session_start();
header("Cache-Control: no cache");
include "connection.php";

$SId = $_SESSION['SId'];
$NoOfQuestions = $_SESSION['$NoOfQuestions'];
?>

<html>
  <head>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <title>Mock Exam Results</title>
  </head>

  <body>
    <?php include 'stu_headerN.php';?>

 
      <div class="site-section home">
        <div class="grid-container">

        <div class="row g-4">
          <div class="service-item-h">
            <h1>Your Results</h1>
          </div>
        </div>
            
              <?php
                  if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $counter = 0;
                  // collect value of input field
                      foreach ($_POST['answer'] as $questId => $answerData) {
                      // Access the correct_answer value for each questId
                          $answers[]=$answerData['correct_answer'];
                          $ids[]=$questId;
                          $counter++;
                      }  
                      
                      $result=0;
                      //checking for the correct answer
                      for($i=0; $i<$counter; $i++){    
                        
                        $res = $conn->query("SELECT * FROM questions WHERE QId = $ids[$i]")->fetch(PDO::FETCH_ASSOC);
                        $question = $res["question"];
                        $c_answer = $res["correct_answer"];
                        $LId = $res['LId'];
                        
                        ?>
                        <div class="row g-4">
                        <?php

                        if($res["correct_answer"]==$answers[$i]){
                          ?>
                          <div class="service-item-c">
                          <?php
                          echo $i+1;
                          echo ". ";
                          echo $question;
                          ?>
                          <br>
                          <br>
                          <b>
                          <?php

                          echo "Your answer is Correct. : ";
                          echo $answers[$i];
                          ?>
                          </b>
                          <?php
                          $result++;

                          ?>
                          </div>
                          <?php
                        }
                        else{
                          ?>
                          <div class="service-item-w">
                          <?php
                          echo $i+1;
                          echo ". ";
                          echo $question;
                          ?>
                          <br>
                          <br>
                          <?php

                          echo "Your answer is Wrong! : ";
                          echo $answers[$i];

                          ?>
                          <br>
                          <br>
                          <b>
                          <?php
                          echo "Correct answer is : ";
                          echo $c_answer;
                          $_SESSION['LId']= $res['LId'];
                          ?>
                          </b>
                          <form method="POST" action="mock_exam_videoPage.php">
                            <input class="btn-primary" type="submit" value="View Lesson Video">
                         </form>
                          </div>
                          <?php
                        }
                        ?>
                        </div>
                        <?php
                      }
                  //showing results
                  ?>
                  <div class="row g-4">
                  <div class="service-item-n">
                    <b>
                    <?php
                    echo "Your Result: ";
                    echo $result;
                    echo "/";
                    echo $NoOfQuestions;
                    ?>
                    </b>
                    <?php
                  }
                    
                    echo "Your marks have been Recorded.";

                    ?>
                    <br>
                    <br>
                    </div>
                    <?php
              ?>
          </div>
        </div>  
      </div>

  </body>
</html>