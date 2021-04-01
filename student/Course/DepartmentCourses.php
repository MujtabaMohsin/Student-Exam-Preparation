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
$Department_ID =  $_GET["id"];

	  $sql0 = "SELECT department_code FROM department WHERE Department_ID =  $Department_ID ";
      $result0 = mysqli_query($conn, $sql0);
	  $row0 = mysqli_fetch_array($result0)

?>

  	<div class="content">
  		<br>
  		<br>
  		<h1 style="text-align:center;"><?php echo $row0['department_code'] ?> Courses</h1>
  		<br>
  		<div class="container parent">
  			<br>

  			<?php
include "../../connect/connect.php";
              $ID = $_SESSION["userID"];

			  $sql = "SELECT Course_Code FROM courses_code WHERE Department_ID =  $Department_ID ";
              $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
					
					$course =  $row['Course_Code'];
					 
					$sql2 = "SELECT Course_ID FROM courses WHERE Course_Code = '$course' ";
              	    $result2 = mysqli_query($conn, $sql2);
                   	$row2 = mysqli_fetch_array($result2);
					$val = $row2['Course_ID']; 
                    echo '<a style="" class="child elegent" href="';
                    
					 
                    echo "Course-Homepage.php?id=$val";
                    echo '" ">
                      <div>
                          <h4 id="courseName" style="background:none; color:white; width:100%">'.$row["Course_Code"].'</h4>
                         
                      </div>
                  </a>';
            
                  }
                
              }
			
				else{
						?>
  			<div style="text-align:center; margin-left: 260px;">
  				<?php
						echo "<br><br><span style='font-size: 32px;  font-weight: normal;' class='badge badge-success'>There is no courses available now</span><br><br>";
						?>
  			</div>
  			<?php
				}
              $conn->close();
          ?>


  		</div>
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
