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
	  
	 
if(isset($_POST['submit'])) {
            
		  $title = $_POST['title'];
		  $studentID = $_SESSION["userID"];
		  $msg = $_POST['msg'];
	
	  
 
		$sql = "INSERT INTO reminders (event_type , event_ID, msg) VALUES ('CU', '$ID' , '$msg' )";
		mysqli_query($conn, $sql);
		
	 
 
		// Refrash after submting 
		echo '<div style="text-align:center;" class="alert alert-success"><strong>Thank you!</strong> your message was submitted successfuly</div>';
		
//		header("location:ViewQuestionBank.php?id=$courseID");
//		die();
			
	}

?>




  	<div class="container">
  		<br>


  		<br>
  		<h2 style="text-align:center;">Contact Us</h2>
  		<br>

  		<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">



  			<div class="form-group">
  				<label class="control-label"><strong>Title:</strong></label>
  				<div class="md-form">
  					<input required type="text" class="form-control" id="name" placeholder="Title" name="title">
  				</div>
  			</div>

  			<br>



  			<div class="form-group">
  				<label class="control-label" for="name"><strong>Message:</strong></label>
  				<div class="md-form">
  					<textarea id="form7" class="md-textarea form-control" name="msg" rows="6" placeholder="Your message is here"></textarea>
  				</div>
  			</div>

  			<br>


  			<div class="form-group">
  				<input type="submit" name="submit" class="btn btn-primary" value="Submit">
  			</div>
  		</form>


  	</div>
  	</div>
  	</div>
  	</div>





  </body>

  </html>
