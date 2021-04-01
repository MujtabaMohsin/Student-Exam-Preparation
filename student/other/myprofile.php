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
	  
  $ID = $_SESSION["userID"];

?>
  	<?php


if(isset($_POST['submit'])) {
            
		  $name = $_POST['n'];
		  $email = $_POST['e'];
		  
		 $sql = "UPDATE users SET User_name='$name' , User_email='$email'  WHERE User_ID= $ID ";

		if(mysqli_query($conn, $sql)){
			// Refrash after submting 
		 
			echo '<div style="text-align:center;" class="alert alert-success"><strong>Success!</strong> Profile was updated successfuly</div>';
			
		}                        
 
		 
	}

?>

  	<div class="container">
  		<br>


  		<br>
  		<h1 style="text-align:center;">Update My Profile</h1>
  		<div class=" ">
  			<br>
  			<?php
include "../../connect/connect.php";
            

              $sql = "SELECT * FROM users WHERE User_ID = $ID";
              $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0){
               $row = mysqli_fetch_array($result);
 
					 $name = $row['User_name'];
					 $email = $row['User_email'];
					 $pass = $row['password'];
					  
                 
              }
				  
			  
               
          ?>

  			<br>
  			<div>
  				<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">



  					<div class="form-group">
  						<label class="control-label"><strong>Name:</strong></label>
  						<div class="">
  							<input required type="text" value="<?php echo $name?>" class="form-control" id="name" placeholder="Name" name="n">
  						</div>
  					</div>

  					<br>



  					<div class="form-group">
  						<label class="control-label" for="name"><strong>Email:</strong></label>
  						<div class="">
  							<input required type="email" class="form-control" id="name" value="<?php echo $email;?>" placeholder="Email" name="e">
  						</div>
  					</div>

  					<br>

  					<div class="form-group">
  						<label id="pass2" class="control-label" for="name"><strong>Change Passowrd:</strong></label>
  						<div id="changePass">
  							<a href="#" id="" onclick="changePass()">Click Here to change password</a>
  						</div>
  					</div>

  					<div style="display: none;" id="change_div">
  						<div class="form-group">
  							<label class="control-label" for="name"><strong>Current Password:</strong></label>
  							<div class="col-sm-6">
  								<input type="password" class="form-control" id="name" placeholder="Current Password" name="n1">
  							</div>
  						</div>

  						<br>

  						<div class="form-group">
  							<label class="control-label" for="name"><strong>New Password:</strong></label>
  							<div class="col-sm-6">
  								<input type="password" class="form-control" id="name" placeholder="New Password" name="n2">
  							</div>
  						</div>

  						<br>

  						<div class="form-group">
  							<label class="control-label" for="name"><strong>Repeat Password:</strong></label>
  							<div class="col-sm-6">
  								<input type="password" class="form-control" id="name" placeholder="Repeat Password" name="n3">
  							</div>
  						</div>

  					</div>




  					<br>

  					<div class="form-group">
  						<input type="submit" name="submit" class="btn btn-primary" value="Save">
  					</div>
  				</form>
  			</div>
  			<br>
  			<br>





  		</div>
  	</div>
  	</div>
  	</div>


  	<script>
  		function changePass() {

  			var hide_div = document.getElementById("changePass");
  			hide_div.style.display = "none";

  			var hide_div2 = document.getElementById("pass2");
  			hide_div2.style.display = "none";


  			var show_div = document.getElementById("change_div");
  			show_div.style.display = "block";

  		}

  	</script>




  </body>

  </html>
