<?php
  session_start();

  include 'connection.php';

  $SId =  $_SESSION['SId'];
?>

<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        
        <link rel="stylesheet" href="css/style.css">

      <title>Student Profile</title>
  </head>

<body>
<?php include 'stu_headerN.php';
?>


<!-- Student Profile -->
<div class="site-section home">
<div class="grid-container">
<div class="student-profile py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent text-center">
            <img class="profile_img" class="a" src="images\logo.png" width="90%" height="90%" style="border-radius: 50%" alt=""/>
            <?php
			
				
            $query = $conn->query("SELECT * FROM student_profile WHERE SId = $SId ");
            if($query->rowCount() == 0){
              header("Location: add_stu_details.php");
              exit();
            }else{
              $query = $conn->query("SELECT * FROM student_profile WHERE SId = $SId ")->fetch(PDO::FETCH_ASSOC);
              echo "<h3>".$query['Fname']."</h3>";
			      ?>
          </div>
          
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>User Information</h3>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tr>
                <th width="30%">Username</th>
                <td width="2%">:</td>
                <td>
                <?php
				
				echo "<h6>".$query['Lname']."</h6>";
			?></td>
              </tr>
              <tr>
                <th width="30%">First Name</th>
                <td width="2%">:</td>
                <td>
                <?php
                
                echo "<h6>".$query['Fname']."</h6>";
                
                ?>    
                </td>
        
              </tr>
              <tr>
                <th width="30%">Last Name</th>
                <td width="2%">:</td>
                <td>
                <?php
				
				          echo "<h6>".$query['Lname']."</h6>";
			          ?>
              </td>
              </tr>
              <tr>
                <th width="30%">Grade</th>
                <td width="2%">:</td>
                <td>
                <?php
				
				          echo "<h6>".$query['Grade']."</h6>";
			        ?></td>
              </tr>
              <tr>
                <th width="30%">Email</th>
                <td width="2%">:</td>
                <td>
                <?php
				
				          echo "<h6>".$query['Email']."</h6>";}
			          ?></td>
              </tr>
              
            </table>
            <a class="btn btn-primary float-lg-right" href="update_stu_details.php">Update</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>



  </body>
</html>