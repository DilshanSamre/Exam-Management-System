<?php
session_start();
include "connection.php";

$SId = $_SESSION['SId'];

?>

<html>
  <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/style.css">

      <title>All Results</title>
  </head>

  <body>
    <?php include 'stu_headerN.php' ?>
      <div class="site-section home">
        <div class="grid-container">

            <div class="row g-4">
                <div class="service-item-h">
                    <h1>Your Results</h1>
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
                        
                    $res = $conn->prepare("SELECT * FROM exam_results WHERE SId = $SId ");
                    $res->setFetchMode(PDO :: FETCH_OBJ);
                    $res->execute();

                    $query = "SELECT COUNT(*) AS total_rows FROM exam_results WHERE SId = $SId ";
                    $stmt = $conn->query($query);
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $num_rows = $result['total_rows'];

                    if ($num_rows > 0) {
                    ?>
                        <table style="width:600px; line-height:40px;"> 
                            <tr>
                                <th> No </th>
                                <th> Student ID </th> 
                                <th> Grade </th> 
                                <th> Subject </th> 
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
                                  <td><?php echo $row->GId; ?></td> 
                                  <td>
                                      <?php 
                                      if($row->SubId == '1'){
                                          echo "Mathematics";
                                      }
                                      else if($row->SubId == '2'){
                                          echo "Science";
                                      }
                                      else if($row->SubId == '3'){
                                          echo "English";
                                      }
                                      ?>
                                  </td> 
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