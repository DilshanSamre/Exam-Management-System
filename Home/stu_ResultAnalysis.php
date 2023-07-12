<?php
//start session
session_start();
$SId =  $_SESSION['SId'];

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Result Analysis</title>
    </head>
    <body>
    <?php include 'stu_headerN.php';?>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "exam";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        ?>
        
        <div class="site-section home">
            <div class="grid-container">

            <div class="row g-4">
                <div class="service-item-h">
                    <h1>Your Progress</h1>
                </div>
            </div>

                <form class="p-3" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                        <select class="form-control" name="SelGrade">
                            <option value="0">Select Grade</option>
                            <option value="6">Grade 6</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                            <option value="11">Grade 11</option>
                        </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="SelSubject">
                                <option value="0">Select Subject</option>
                                <option value="1">Mathematics</option>
                                <option value="2">Science</option>
                                <option value="3">English</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-success mb-1 mt-3 col-8" name="ShowResult" type="submit" value="Show Result Analysis">
                    </div>
                </form>
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                
                if(isset($_POST['ShowResult'])) {
                    $SelGrade = $_POST["SelGrade"];
                    $SelSubject = $_POST["SelSubject"];
                    
                }}
                
                //query
            if(isset($SelGrade) && isset($SelSubject)){
            $sql = "SELECT * FROM exam_results WHERE GId=$SelGrade AND SubId=$SelSubject AND SId=$SId";
            $result = $conn->query($sql);
            $result2 = $conn->query($sql);
            $lessonCounter = 0;

            $dataPoints1 = array();
            $dataPoints2 = array();
            $dataPoints3 = array();
                if ($result2->num_rows > 0) {
                    $maxnum=0;
                    while($row2 = $result2->fetch_assoc()) {
                        if($maxnum<$row2["LId"]){
                            $maxnum = $row2["LId"];
                        }
                    }
                    for ($x = 0; $x < $maxnum; $x++) {
                        $dataPoints1[$x]["label"]=($x+1).' lessons';
                        $dataPoints1[$x]["y"]=null;
                        $dataPoints2[$x]["label"]=($x+1).' lessons';
                        $dataPoints2[$x]["y"]=null;
                        $dataPoints3[$x]["label"]=($x+1).' lessons';
                        $dataPoints3[$x]["y"]=null;
                      }
                }
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($dataPoints1[$row["LId"]-1]["y"]!=null && $dataPoints2[$row["LId"]-1]["y"]!=null){
                            $dataPoints3[$row["LId"]-1]["y"]=$row["result"];
                        }else if($dataPoints1[$row["LId"]-1]["y"]!=null){
                            $dataPoints2[$row["LId"]-1]["y"]=$row["result"];
                        }else{
                            $dataPoints1[$row["LId"]-1]["y"]=$row["result"];
                        }
                        
                    }
                } else {
                    echo "<div class='service-item-h'><h5>No results to show.</h5></div>";
                    }
            }  
            ?>
            <div class="p-2">
                <div id="chartContainer"  style="height: 370px; width: 100%;"></div>
            </div>
            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
            <script>
            window.onload = function () {
            
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title:{
                    text: " Your Results "
                },
                axisY:{
                    includeZero: true
                },
                legend:{
                    cursor: "pointer",
                    verticalAlign: "center",
                    horizontalAlign: "right",
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "column",
                    name: "1nd attempt",
                    indexLabel: "{y}",
                    yValueFormatString: "#0.##",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                },{
                    type: "column",
                    name: "2nd attempt",
                    indexLabel: "{y}",
                    yValueFormatString: "#0.##",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                },{
                    type: "column",
                    name: "3nd attempt",
                    indexLabel: "{y}",
                    yValueFormatString: "#0.##",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
            
            function toggleDataSeries(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                }
                else{
                    e.dataSeries.visible = true;
                }
                chart.render();
            }
            
            }
        </script>
        </div>
        </div> 
    </body>
</html>