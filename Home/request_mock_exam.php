<?php
  session_start();

  $SId =  $_SESSION['SId'];

?>

<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Request Mock Exam</title>
    </head>

    <body>
        <?php 
        
        include 'stu_headerN.php';
        include 'connection.php';
            
        ?>
        <style>
            select {
                width: 100%;
                padding: 9px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                font-size: 15px;
            }
        </style>

            <div class="site-section home">
                <div class="grid-container">
                        <div class="row g-12">
                            <h3 class="ml-4">Request Mock Exam</h3>  
                        </div>
                            
                        <div class="row g-12 mt-2">
                            <div class="col-md-10">
                                <div class=" ml-5">
                                    <form method="post" action="mock_examView.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="fname">Select Grade</label>
                                                <select name="ReqestGrade" required>
                                                    <option value="none" selected disabled hidden> </option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                </select>
                                                <!-- <input class=" form-control border border-primary mb-1 col-md-6 " placeholder="Enter Grade 6- 11" type="number" name="ReqestGrade" value="" required/> -->
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="lname">Select Subject</label>
                                                <select name="RequsestSub" required>
                                                    <option value="none" selected disabled hidden> </option>
                                                    <option value="1">Mathematics</option>
                                                    <option value="2">Science</option>
                                                    <option value="3">English</option>
                                                </select>
                                                <!-- <input class=" form-control border border-primary mb-1 col-md-6 " placeholder="Select a Subject"type="text" name="RequsestSub" value="" required/> -->
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="grade">Number of Questions</label>
                                                <select name="NoOfQuestions" required>
                                                    <option value="none" selected disabled hidden> </option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                </select>
                                                <!-- <input class=" form-control border border-primary mb-1 col-md-6 " placeholder="Number of Questions(5-10)"type="number" name="NoOfQuestions" value="" required/> -->
                                            </div>
                                        </div>
                                        <input class="btn btn-primary mb-1 col-md-2 col-sm-4 col-5" name="RequestMockExam" type="submit" value="Request">
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>            
                </div>
            </div>

    </body>
</html>