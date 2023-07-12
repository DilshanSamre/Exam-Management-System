<?php
session_start();
include "connection.php";

$SId = $_SESSION['SId'];
$LId = $_SESSION['LId'];

$res = $conn->query("SELECT * FROM lessons WHERE LId = $LId")->fetch(PDO::FETCH_ASSOC);
$LName = $res["LName"];
$videolink = $res["VideoLink"];
?>

<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Lesson Video</title>
    </head>

    <body>
        <?php include 'stu_headerN.php';?>


        <div class="site-section home">
            <div class="grid-container">
                <div class="row g-4">
                    <div class="service-item-h">
                        <?php
                            if($videolink == ""){
                                echo "<h1>No Video to Show</h1>";
                            }
                            else{
                                ?>
                                    <h1><?php echo $LId;?>. <?php echo $LName; ?></h1>
                                    <video src = "lesson_videos/<?php echo $videolink; ?>" controls>
                                    </video>
                                <?php
                            }
                        ?>
                    </div>   
                </div>
            </div>
        </div>
    </body>
</html>
