<?php
  session_start();

  $SId =  $_SESSION['SId'];

?>

<html>
    <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">
        <title>Add Student Details</title>
    </head>

    <body>
        <?php include 'stu_headerN.php';
              include 'connection.php';
            
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
                                                <label for="fname">First Name</label>
                                                <input placeholder="First Name" type="text" name="AddFname" value="" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="lname">Last Name</label>
                                                <input placeholder="Last Name" type="text" name="AddLname" value="" required/>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="grade">Grade</label>
                                                <select name="AddGrade" required>
                                                    <option value="none" selected disabled hidden> </option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="email">Email</label>
                                                <input placeholder="Email" type="text" name="AddEmail" value="" required/>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary mb-1 col-md-2 col-sm-4 col-5" name="AddStudentDetails" type="submit" value="Add">
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <?php 
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                if(isset($_POST['AddStudentDetails'])) {
                                    $AddFname = $_POST["AddFname"];
                                    $AddLname = $_POST["AddLname"];
                                    $AddGrade = $_POST["AddGrade"];
                                    $AddEmail = $_POST["AddEmail"];
                                    $sql2 = "INSERT INTO student_profile(SId, Fname, Lname, Grade, Email) VALUES( '$SId', '$AddFname', '$AddLname', '$AddGrade', '$AddEmail')";
                                    if ($conn->exec($sql2) == true) {       
                                        echo "<script>window.location.href='stu_profile.php';</script>";
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