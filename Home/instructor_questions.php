<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['addquestion'])) {
        $_SESSION['LId'] = $_POST["LValue"];
    }
}
$LId = $_SESSION['LId'];
$GId = $_SESSION['GId'];
$SubId = $_SESSION['SubId'];

?>

<html>
    <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/style.css">
        <title>Customize Lessons</title>
    </head>

    <body>
            <style>
                table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                margin:auto;
                text-align:center;
                }

                th{
                background-color: rgba(150, 212, 212, 0.4);
                padding: 1px 10px;
                }

                td:nth-child(8) {
                background-color: rgba(150, 212, 212, 0.4);
                }
            </style>

        <?php include 'instructor_header.php';?>
        <?php

            //query
            $res = $conn->query("SELECT * FROM lessons WHERE GId=$GId AND SubId=$SubId")->fetch(PDO::FETCH_ASSOC);
            $LName = $res["LName"];
            
        ?>

            <div class="site-section home">
                <div class="grid-container">
                        <div class="row g-12">
                            <div class="service-item-h">
                                <h3 class="ml-4"><?php echo $LId; echo ". "; echo $LName; ?> Lessson Questions</h3>
                            </div> 
                            <div class="service-item-h">
                                <a class="btn btn-primary" href="instructor_add_questions.php">Add Question</a>
                            </div>
                        </div>
                        <div classs="col-md-12">
                            <?php 
                            
                            $res = $conn->prepare("SELECT * FROM questions WHERE SubId = $SubId AND GId = $GId AND LId = $LId");
                            $res->setFetchMode(PDO :: FETCH_OBJ);
                            $res->execute();

                            $query = $conn->query("SELECT * FROM questions WHERE SubId = $SubId AND GId = $GId AND LId = $LId");
        
                            if ($query->rowCount() > 0) {
                                ?>
                                <table style="width:auto; line-height:40px;"> 
                                    <tr>
                                        <th> No </th>
                                        <th> Question ID </th> 
                                        <th> Question </th> 
                                        <th> Option 1 </th>
                                        <th> Option 2 </th>
                                        <th> Option 3 </th>
                                        <th> Option 4 </th>
                                        <th> Correct Answer </th>
                                        <th colspan="2"> Action </th>                                     
                                    </tr> 
                                    
                                    <?php
                                    $i=1;
        
                                    while($row=$res->fetch()) 
                                    { 
                                    ?> 
                                    <tr> 
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row->QId; ?></td> 
                                        <td><?php echo $row->question; ?></td> 
                                        <td><?php echo $row->option1; ?></td>
                                        <td><?php echo $row->option2; ?></td>
                                        <td><?php echo $row->option3; ?></td>
                                        <td><?php echo $row->option4; ?></td>
                                        <td><?php echo $row->correct_answer; ?></td>
                                        <td>
                                            <?php
                                            echo '<form action="instructor_edit_questions.php" method="post">
                                                <input type="hidden" name="QValue" value="'.$row->QId.'"/>
                                                <input name="EditQuiz" class="btn btn-primary" type="submit" value="Edit">
                                            </form>';
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">
                                                <input type="hidden" name="QValue" value="'.$row->QId.'"/>
                                                <input name="DeleteQuiz" class="btn btn-danger" type="submit" value="Delete">
                                            </form>';
                                            ?>
                                        </td>
                                    </tr> 
                                    <?php 
                                    }
                                    ?>
                                </table>
                                <?php
                            } 
                            else{
                                echo "<div class='service-item-h'><h3>No results to show.</h3></div>";
                            }
                            ?> 
                        </div>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            //action delete
                            if(isset($_POST['DeleteQuiz'])) {
                                $deleteQid = $_POST["QValue"];
                                $sql = "DELETE FROM questions WHERE QId=$deleteQid"  ;
                                if ($conn->exec($sql) == true) {
                                    echo "<script>window.location.href='instructor_questions.php';</script>";
                                    exit;
                                } else {
                                    echo "Error deleting record: " . $conn->error;
                                }
                            }
                        }
                        ?>
                        

                </div>
            </div>

    </body>
</html>