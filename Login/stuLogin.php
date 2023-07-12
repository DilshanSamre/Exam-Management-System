<?php
    session_start();
    include "../backend/connection.php";

    $studentId = $_POST['studentId'];
    $password = $_POST['password'];

    $errorMsg = "Invalid username or password";

    $sql = "SELECT * FROM student_details WHERE studentId = '$studentId' AND password = '$password'";
    $result = $con->query($sql);

    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        if($row['studentId'] === $studentId && $row['password'] === $password){
            $_SESSION['SId'] = $row['SId'];
            // $_SESSION['password'] = $row['password'];
            header("location: ../Home/stu_home.php");
            exit();
        }
    }else {
        echo "<script>alert('$errorMsg')</script>";
        echo '<script>window.location.href = "Home.html";</script>';

    }
    
    $con->close();