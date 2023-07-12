<?php
session_start();
include "connection.php";

$LId = $_SESSION['LId'];
$GId = $_SESSION['GId'];
$SubId = $_SESSION['SubId'];

?>

<html>
    <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/style.css">
        <title>Add Student Details</title>
    </head>

    <body>
        <?php include 'instructor_header.php';
            
        ?>
            <div class="site-section home">
                <div class="grid-container">
                        <div class="row g-12">
                            <h3 class="ml-4">Add Question</h3>  
                        </div>
                            
                            

                        <div class="row g-12 mt-2">
                            <div class="col-md-10">
                                <div class=" ml-5">
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="question">Question</label>
                                                <input placeholder="Question" type="text" name="Addquestion" value="" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="option1">Option 1</label>
                                                <input placeholder="Option 1" type="text" name="Addoption1" value="" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="option2">Option 2</label>
                                                <input placeholder="Option 2" type="text" name="Addoption2" value="" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="option3">Option 3</label>
                                                <input placeholder="Option 3" type="text" name="Addoption3" value="" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="option4">Option 4</label>
                                                <input placeholder="Option 4" type="text" name="Addoption4" value="" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="correct_answer">Correct Answer</label>
                                                <input placeholder="Correct Answer" type="text" name="Addcorrect_answer" value="" required/>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary mb-1 col-md-2 col-sm-4 col-5" name="Addquiz" type="submit" value="Add">
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <?php 
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Retrieve the value sent from subjects.php


                                if(isset($_POST['Addquiz'])) {
                                    $Addquestion = $_POST["Addquestion"];
                                    $Addoption1 = $_POST["Addoption1"];
                                    $Addoption2 = $_POST["Addoption2"];
                                    $Addoption3 = $_POST["Addoption3"];
                                    $Addoption4 = $_POST["Addoption4"];
                                    $correct_answer = $_POST["Addcorrect_answer"];
                                    
                                    $sql2 = "INSERT INTO questions(GId, SubId, LId, question, option1, option2, option3, option4, correct_answer) VALUES( '$GId', '$SubId', '$LId', '$Addquestion', '$Addoption1', '$Addoption2', '$Addoption3', '$Addoption4',  '$correct_answer')";
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