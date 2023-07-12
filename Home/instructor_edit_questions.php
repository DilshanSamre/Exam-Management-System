<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['EditQuiz'])) {
        $_SESSION['QId'] = $_POST["QValue"];
    }

}

$QId = $_SESSION['QId'];
$LId = $_SESSION['LId'];
$GId = $_SESSION['GId'];
$SubId = $_SESSION['SubId'];

?>

<html>
    <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/style.css">
        <title>Edit Question</title>
    </head>

    <body>
        <?php include 'instructor_header.php';

              $query = $conn->query("SELECT * FROM questions WHERE QId = $QId ")->fetch(PDO::FETCH_ASSOC);
            
        ?>
            <div class="site-section home">
                <div class="grid-container">
                        <div class="row g-12">
                            <h3 class="ml-4">Add Student Details</h3>  
                        </div>
                            
                            

                        <div class="row g-12 mt-2">
                            <div class="col-md-10">
                                <div class=" ml-5">
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="question">Question</label>
                                                <input placeholder="Question" type="text" name="Editquestion" value="<?php echo $query['question'] ?>" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="option1">Option 1</label>
                                                <input placeholder="Option 1" type="text" name="Editoption1" value="<?php echo $query['option1'] ?>" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="option2">Option 2</label>
                                                <input placeholder="Option 2" type="text" name="Editoption2" value="<?php echo $query['option2'] ?>" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="option3">Option 3</label>
                                                <input placeholder="Option 3" type="text" name="Editoption3" value="<?php echo $query['option3'] ?>" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="option4">Option 4</label>
                                                <input placeholder="Option 4" type="text" name="Editoption4" value="<?php echo $query['option4'] ?>" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="correct_answer">Correct Answer</label>
                                                <input placeholder="Correct Answer" type="text" name="Editcorrect_answer" value="<?php echo $query['correct_answer'] ?>" required/>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary mb-1 col-md-2 col-sm-4 col-5" name="Editquiz" type="submit" value="Update">
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <?php 
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                if(isset($_POST['Editquiz'])) {
                                    $Editquestion = $_POST["Editquestion"];
                                    $Editoption1 = $_POST["Editoption1"];
                                    $Editoption2 = $_POST["Editoption2"];
                                    $Editoption3 = $_POST["Editoption3"];
                                    $Editoption4 = $_POST["Editoption4"];
                                    $Editcorrect_answer = $_POST["Editcorrect_answer"];
                                    $sql2 = "UPDATE questions  SET question='$Editquestion', option1='$Editoption1', option2='$Editoption2', option3='$Editoption3', option4='$Editoption4', correct_answer='$Editcorrect_answer' WHERE QId=$QId";
                                    if ($conn->exec($sql2) == true) {       
                                        echo "<script>window.location.href='instructor_questions.php';</script>";
                                        exit();
                                    }else{
                                        echo "Error while adding data to database!";
                                    }
                                }
                            }
                        ?>

                    </div>            
                </div>
            </div>
    </body>
</html>