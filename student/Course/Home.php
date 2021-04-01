  <?php session_start(); ?>
  <!DOCTYPE html>
  <html>

  <head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, deptrink-to-fit=no">
  	<title>My courses</title>
  	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">
  	<link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
  	<link rel="stylesheet" href="../../assets/fonts/ionicons.min.css">
  	<link rel="stylesheet" href="../../assets/css/styles.css">
  	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">
  	<link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
  	<link rel="stylesheet" href="../../assets/fonts/ionicons.min.css">
  	<link rel="stylesheet" href="../../assets/fonts/material-icons.min.css">
  	<link rel="stylesheet" href="../../assets/css/-Login-form-Page-BS4-.css">
  	<link rel="stylesheet" href="../../assets/fonts/simple-line-icons.min.css">
  	<script src="../../assets/js/jquery.min.js"></script>
  	<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

  	<link rel="stylesheet" href="../../assets/css/styles.css">
  	<script src="../../assets/js/jquery.min.js"></script>
  	<script src="../../assets/js/sc.js"></script>

  	<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
  </head>

  <body>
  	<?php 
include_once "../../page/header.php";


?>

  	<div class="content">
  		<br>
  		<br>
  		<h1 style="text-align:center;">Departments</h1>
  		<br>
  		<div class="container parent">
  			<br>

  			<?php
include "../../connect/connect.php";
              $ID = $_SESSION["userID"];

			$sql = "SELECT * FROM department ";
              $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
					          
                    echo '<a style="" class="child elegentDep" href="';
                    $val = $row["department_ID"]; 
                    echo "DepartmentCourses.php?id=$val";
                    echo '" ">
                      <div>
                          <h4 id="courseName" style="background:none; color:white; width:100%">'.$row["department_code"].'</h4>
                         
                      </div>
                  </a>';
            
                  }
                
              }
              $conn->close();
          ?>


  		</div>
  	</div>










  </body>

  </html>
