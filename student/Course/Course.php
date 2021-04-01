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
  		<!--<button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#modalAddCourse">Create Course</button> -->


  		<br>
  		<h1 style="text-align:center;">My Courses</h1>
  		<div class="container parent">
  			<br>
  			<?php
include "../../connect/connect.php";
              $ID = $_SESSION["userID"];

              $sql = "SELECT * FROM user_courses WHERE User_ID = $ID";
              $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                  $courseSQL = "SELECT * FROM courses WHERE Course_ID = $row[Course_ID]";
                  $result1 =  mysqli_query($conn, $courseSQL);
                  if(mysqli_num_rows($result1) > 0){
                    $row1= mysqli_fetch_array($result1);
                    echo '<a style="" class="child elegent" href="';
                    $val = $row["Course_ID"]; 
                    echo "Course-Homepage.php?id=$val";
                    echo '" ">
                      <div>
                          <h4 id="courseName" style="background:none; color:white; width:100%">'.$row1["course_name"].' '.$row1["Course_Code"].'</h4>
                         
                      </div>
                  </a>';
            
                  }
                }
              }
			
			
			?>
  		</div>
  		<div style="text-align:center;">
  			<?php
			if(mysqli_num_rows($result) == 0){
			
			echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-secondary'>You haven't regestired any courses</span><br><br>";
			}
              $conn->close();
          ?>



  		</div>



  		<!-- The popup window -->

  		<div class="modal fade" id="modalAddCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">




  			<div class="modal-dialog" role="document">


  				<form action="createCourse.php" method="post">


  					<div class="modal-content">
  						<div class="modal-header text-center">
  							<h4 class="modal-title w-100 font-weight-bold">Create Course</h4>
  							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>

  						<div class="modal-body mx-3">

  							<!-- Course Name -->
  							<div class="md-form mb-3">
  								<label data-error="wrong" data-success="right" for="cName">Course Name</label>
  								<input maxlength="20" type="text" id="cName" name="cName" class="form-control validate" placeholder="ICS102 Section 5" required>

  							</div>


  							<!-- Department -->
  							<div class="md-form mb-3">
  								<label data-error="wrong" data-success="right" for="dept">Department</label>
  								<select class="form-control validate" id="dept" name="dept">
  									<?php
               
               include "../../connect/connect.php";


               $sql1 = "SELECT department_Name, department_ID FROM department";
               $result1 = mysqli_query($conn,$sql1);
              
               
               if(mysqli_num_rows($result1) > 0){
                   while($row1 = mysqli_fetch_array($result1)){
                       echo '<option value="'.$row1[department_ID].'">'.$row1[department_Name].'</option>';

                   }
               }
               $conn->close();
            ?>
  								</select>

  							</div>
  							<!-- Course Code -->
  							<div class="md-form mb-3">
  								<label data-error="wrong" data-success="right" for="dept">Course Code</label>
  								<select class="form-control validate" id="code" name="code">

  								</select>
  							</div>
  							<!-- Course Name -->
  							<div class="md-form mb-3">
  								<label data-error="wrong" data-success="right" for="price">University Course Name</label>
  								<input type="text" id="uName" name="uName" class="form-control validate" disabled>

  							</div>

  							<!-- dESC -->
  							<div class="md-form">
  								<label data-error="wrong" data-success="right" for="form8">Descreption</label>
  								<textarea maxlength="99" type="text" id="desc" name="desc" class="md-textarea form-control" rows="4"></textarea>

  							</div>

  						</div>
  						<!-- SUBMIT -->
  						<div class="modal-footer d-flex justify-content-center">
  							<button type="button" class="btn btn-primary" style="background-color:red;" data-toggle="modal" data-target="#modalAddCourse">Cancel</button>
  							<button type="submit" class="btn btn-primary">Add </button>

  						</div>
  					</div>
  			</div>
  			</form>
  		</div>

  		<script>
  			var dict = {};
  			$(document).ready(function() {
  				var query = $('#dept').val();
  				console.log(query);

  				$.ajax({
  					url: "showCode.php",
  					method: "POST",
  					data: {
  						query: query
  					},
  					dataType: 'json',
  					success: function(data) {

  						fillDict(data);
  						fillCode(data);
  						$("#code").prop("selectedIndex", 0).val();
  						courseCode()
  					}
  				});
  				$('#dept').on('change', function() {
  					var query = $(this).val();

  					$.ajax({
  						url: "showCode.php",
  						method: "POST",
  						data: {
  							query: query
  						},
  						dataType: 'json',
  						success: function(data) {
  							fillDict(data);
  							fillCode(data);
  							$("#code").prop("selectedIndex", 0).val();
  							courseCode()
  						}
  					});

  				});

  				$('#code').on('change', function() {
  					courseCode()
  				})
  			});


  			function fillDict(data) {
  				var i;
  				for (i = 0; i < data[0].length; i++)
  					dict[data[0][i]] = data[1][i]

  			}

  			function fillCode(data) {
  				$('#code').empty()
  				data[0].forEach(function(item) {
  					$('#code').append('<option value="' + item + '" >' + item + '</option>');
  				});
  			}

  			function courseCode() {
  				var courseCode = $('#code').find(":selected").val();
  				$('#uName').val(dict[courseCode]);
  			}

  		</script>







  </body>

  </html>
