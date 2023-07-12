<?php
  session_start();
  include "connection.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION['GId'] = $_POST["GValue"];
  }

  $InsId = $_SESSION['InsId'];
  $GId = $_SESSION['GId'];
  $SubId = $_SESSION['SubId'];

  if($SubId == '1'){
    $Subject = "Mathematics";
  }
  else if($SubId == '2'){
    $Subject = "Science";
  }
  else if($SubId == '3'){
    $Subject = "English";
  }
?>

<html>
  <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/style.css">
      <title>Student Results</title>
  </head>

  <body>
    <?php include 'instructor_header.php' ?>
    <main>
      <div class="site-section home">
        <div class="grid-container">

            <div class="row g-4">
                <div class="service-item-h">
                    <h1>Grade <?php echo $GId; echo " "; echo $Subject; ?> Results</h1>
                </div>
            </div>

            <style>
                table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                margin:auto;
                text-align:center;
                }

                th{
                background-color: rgba(150, 212, 212, 0.4);
                }

                td:nth-child(6) {
                background-color: rgba(150, 212, 212, 0.4);
                }
            </style>
            
              <?php 
                        
                    $res = $conn->prepare("SELECT * FROM exam_results WHERE SubId = $SubId AND GId = $GId");
                    $res->setFetchMode(PDO :: FETCH_OBJ);
                    $res->execute();

                    $query = "SELECT COUNT(*) AS total_rows FROM exam_results WHERE SubId = $SubId AND GId = $GId";
                    $stmt = $conn->query($query);
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $num_rows = $result['total_rows'];

                      if ($num_rows > 0) {
                        ?>
                        <table style="width:600px; line-height:40px;"> 
                            <tr>
                                <th> No </th>
                                <th> Student ID </th> 
                                <th> Lesson No </th> 
                                <th> Marks </th>
                                
                            </tr> 
                            
                            <?php
                            $i=1;

                              while($row=$res->fetch()) 
                              { 
                              ?> 
                              <tr> 
                                  <td><?php echo $i++; ?></td>
                                  <td><?php echo $row->SId; ?></td> 
                                  <td><?php echo $row->LId; ?></td> 
                                  <td><?php echo $row->result; ?></td> 
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
      </div>
  </body>