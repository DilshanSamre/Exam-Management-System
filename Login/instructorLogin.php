<?php
    session_start();
    include "../backend/connection.php";

    $instructorId = $_POST['instructorId'];
    $password = $_POST['password'];

    $errorMsg = "Invalid username or password";

    $sql = "SELECT * FROM instructor_details WHERE instructorId = '$instructorId' AND password = '$password'";
    $result = $con->query($sql);

    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        if($row['instructorId'] === $instructorId && $row['password'] === $password){
            $_SESSION['InsId'] = $row['InsId'];
            // $_SESSION['password'] = $row['password'];
            header("location: ../Home/instructor_homepage.php");
            exit();
        }
    }else {
        echo "<script>alert('$errorMsg')</script>";
        echo '<script>window.location.href = "Home.html";</script>';
    }
    
    $con->close();
?>