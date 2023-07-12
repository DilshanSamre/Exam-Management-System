<?php
session_start();
include "connection.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION['LId'] = $_POST["LValue"];
    
}

$LId = $_SESSION['LId'];
$SId = $_SESSION['SId'];
$GId = $_SESSION['GId'];
$SubId = $_SESSION['SubId'];



$attempts = $conn->query("SELECT * FROM exam_results WHERE SId=$SId AND LID = $LId AND GID = $GId AND SubID = $SubId ");
if($attempts->rowCount() >= 3){
    echo "<script>alert('Maximum Number of Attempts have already Reached!');document.location='../Home/stu_home.php'</script>";
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
    <script type="text/javascript" >
        function preventBack(){window.history.forward();}
            setTimeout("preventBack()", 0);
            window.onunload=function(){null};
    </script>

</head>
<body>
 <?php 
    $selExam = $conn->query("SELECT * FROM questions WHERE LID = $LId AND GID = $GId AND SubID = $SubId ")->fetch(PDO::FETCH_ASSOC);
    $selExamTimeLimit = 10;
    $exDisplayLimit = 10;
 ?>
<link rel="stylesheet" type="text/css" href="css/mycss.css">
<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<script type="text/javascript" href="javascript/exam.js"></script>

<div class="app-main__outer">
<div class="app-main__inner">
    <div class="col-md-12">
         <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>
                            <?php 'Exam'; ?>
                            <div class="page-title-heading">
                                <b>
                                    <?php echo 'Grade 6 Maths'; ?>
                                </b>
                            </div>
                        </div>
                    </div>
                    <div class="page-title-actions mr-5" style="font-size: 20px;">
                        <form name="cd">
                          <input type="hidden" name="" id="timeExamLimit" value="10">
                          <label>Remaining Time : </label>
                          <div id="timer" style="border:none;background-color: transparent;color:blue;font-size: 25px;"></div>
                      </form> 
                    </div>   
                 </div>
            </div>  
    </div>

    <div class="col-md-12 p-0 mb-4">
        <form method="post" action="result.php" id="submitAnswerFrm">
            <input type="hidden" name="exam_id" id="exam_id" value="<?php echo 'Grade 6 Maths'; ?>">
            <input type="hidden" name="examAction" id="examAction" >
        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
        <?php 
            $selQuest = $conn->query("SELECT * FROM questions WHERE LID = $LId AND SubID = $SubId ORDER BY rand() LIMIT $exDisplayLimit ");
            if($selQuest->rowCount() > 0)
            {
                $i = 1;
                while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                      <?php $questId = $selQuestRow['QId']; ?>
                    <tr>
                        <td>
                            <p><b><?php echo $i++ ; ?> .) <?php echo $selQuestRow['question']; ?></b></p>
                            <div class="col-md-4 float-left">
                              <div class="form-group pl-4 ">
                                <input name="answer[<?php echo $questId; ?>][correct_answer]" value="<?php echo $selQuestRow['option1']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >
                               
                                <label class="form-check-label" for="invalidCheck">
                                    <?php 
                                    echo "a) ";
                                    echo $selQuestRow['option1']; 
                                    ?>
                                </label>
                              </div>  

                              <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct_answer]" value="<?php echo $selQuestRow['option2']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >
                               
                                <label class="form-check-label" for="invalidCheck">
                                    <?php 
                                    echo "b) ";
                                    echo $selQuestRow['option2']; 
                                    ?>
                                </label>
                              </div>   
                            </div>
                            <div class="col-md-8 float-left">
                             <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct_answer]" value="<?php echo $selQuestRow['option3']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >
                               
                                <label class="form-check-label" for="invalidCheck">
                                    <?php 
                                    echo "c) ";
                                    echo $selQuestRow['option3']; 
                                    ?>
                                </label>
                              </div>  

                              <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct_answer]" value="<?php echo $selQuestRow['option4']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" required >
                               
                                <label class="form-check-label" for="invalidCheck">
                                    <?php 
                                    echo "d) ";
                                    echo $selQuestRow['option4']; 
                                    ?>
                                </label>
                              </div>   
                            </div>
                            </div>
                             

                        </td>
                    </tr>

                <?php }
                ?>
                       <tr>
                             <td style="padding: 20px;">
                                 <button type="button" onclick="resetRadio()" class="btn btn-xlg btn-warning p-3 pl-4 pr-4" id="resetExamFrm">Reset</button>
                                 <button type="button" onclick="submitFormOnClick()" class="btn btn-xlg btn-primary p-3 pl-4 pr-4 float-right" >Submit</button>
                             </td>
                         </tr>

                <?php
            }
            else
            { ?>
                <b>No question at this moment</b>
            <?php }
         ?>   
              </table>

        </form>
    </div>
</div>



<!-- JS -->
<script>
        var countdownDuration = 1 * 60;
        var timerElement = document.getElementById("timer");

        function updateTimer() {
            var minutes = Math.floor(countdownDuration / 60);
            var seconds = countdownDuration % 60;

            var minutesString = minutes.toString().padStart(2, "0");
            var secondsString = seconds.toString().padStart(2, "0");

            timerElement.innerHTML = minutesString + ":" + secondsString;

            countdownDuration--;

            if (countdownDuration < 0) {
                clearInterval(timerInterval);
                alert("Time Limit is Over! Your Responses are Auto Submitted....");
                submitFormOnTimeLimit();
                //clearRadio();
            }
        }

        updateTimer();

        var timerInterval = setInterval(updateTimer, 1000);



       /* function clearRadio() {
        
            var radioButtons = document.querySelectorAll('#submitAnswerFrm input[type="radio"]');
            radioButtons.forEach(function(radioButton) {
                radioButton.required = false;
                submitForm();

            });
         }*/



         function submitFormOnClick() {
                var radioButtons = document.querySelectorAll('#submitAnswerFrm input[type="radio"]');
                var checkedCount = 0;

              radioButtons.forEach(function(radioButton) {
                    if (radioButton.checked) {
                        checkedCount++;
                    }
                });

                if (checkedCount == (radioButtons.length/4)) {
                    var form = document.getElementById("submitAnswerFrm");
                    form.submit();
                } else {
                    alert("Please select an option for all questions.");
                }
        }

            function submitFormOnTimeLimit() {
                var radioButtons = document.querySelectorAll('#submitAnswerFrm input[type="radio"]');
                radioButtons.forEach(function(radioButton) {
                    radioButton.required = false;
                });
                var form = document.getElementById("submitAnswerFrm");
                form.submit();
        }





        function resetRadio(){
            var radioButtons = document.querySelectorAll('#submitAnswerFrm input[type="radio"]');
            radioButtons.forEach(function(radioButton) {
                radioButton.checked = false;
            });

        }
    </script>






    
</body>
</html>






































