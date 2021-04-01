<?php
session_start();
$courseID = $_GET["id"];
$userID = $_SESSION["userID"];
include "../../page/header.php";
include "../../page/Left_List.php";

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Cource Homepage</title>
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
	<script src="../../assets/js/sc.js"></script>

</head>

<body>
	<?php 
include_once "../../page/header.php";
include_once "../../page/Left_List.php";

	

	$sql = "SELECT * FROM user_courses WHERE Course_ID =  $courseID and User_ID = $userID  ";
     $result = mysqli_query($conn, $sql);
 

?>
	<div class="d-flex flex-column content" style="padding-left: 0; width:80%">

		<br><br>
		<div class="container">
			<div class="float-right">
				<div>
					<form method="post">
						<?php if(mysqli_num_rows($result) == 0){ ?>
						<button class="btn btn-primary float-right" type="submit" name="submit1" style="margin-top: 0.5%;"><i class="icon ion-person-add"></i>
							<span> Register </span></button>
						<?php } else{ ?>

						<button class="btn btn-danger float-right" type="submit" name="submit1" style="margin-top: 0.5%;"><i class="icon ion-android-checkbox-outline"></i>
							<span> Registered </span></button>
						<?php } ?>
					</form>
				</div>

				<br>
				<br>
				<div>

					<?php if(mysqli_num_rows($result) == 0){ ?>
					<button class="btn btn-success float-right" type="button" data-toggle="modal" data-target="#modalInvite" style=" "><i style="font-size: 28px" class="icon ion-ios-people"></i>
						<span>&nbsp; Invite </span></button>
					<?php } else{ ?>

					<button class="btn btn-success float-right" type="button" data-toggle="modal" data-target="#modalInvite" style="margin-left: 0.5%;"><i style="font-size: 28px" class="icon ion-ios-people"></i>
						<span>&nbsp; Invite &nbsp; &nbsp;</span></button>
					<?php } ?>




				</div>


			</div>


			<?php 
		
			// courses table
			$sql_courses = "SELECT * FROM courses WHERE Course_ID = $courseID";
			$query_courses = mysqli_query($conn, $sql_courses);
			$coursesRow = mysqli_fetch_array($query_courses);
			$course_code = $coursesRow['Course_Code'];
		 
			// courses_table
			$sql_code = "SELECT * FROM courses_code WHERE Course_Code = '$course_code'";
			$query_code = mysqli_query($conn, $sql_code);
			$codeRow = mysqli_fetch_array($query_code);
			$department = $codeRow['Department_ID'];
		
		
			// department table
			$sql_dep = "SELECT * FROM department WHERE department_ID = $department";
			$query_dep = mysqli_query($conn, $sql_dep);
			$DepRow = mysqli_fetch_array($query_dep);
		
		
			// user_courses table
			$sql_user = "SELECT * FROM user_courses WHERE Course_ID = $courseID";
			$query_user = mysqli_query($conn, $sql_user);
		 	$studentsNumber = mysqli_num_rows($query_user);
			$userRow = mysqli_fetch_array($query_user);
		    
		
		
		
		?>

			<div class="float-left" style="" id="homepage" class="active2">
				<h1><?php echo $course_code ?></h1>

				<h3>- <?php echo $codeRow['Course_Name'];?></h3>
				<h4>- <?php echo $DepRow['department_Name'];?> Department</h4>
				<h4>- <?php echo $studentsNumber?> Regestering Student</h4>



			</div>

			<div>

			</div>
		</div>
	</div>
	</div>
	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../assets/js/sc.js"></script>


	<!-- The popup window -->

	<div class="modal fade" id="modalInvite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">




		<div class="modal-dialog" role="document">


			<form action="<?php $val = $_GET["id"]; echo "invite.php?id=$val";?>" method="post">


				<div class="modal-content">
					<div class="modal-header text-center">
						<h4 class="modal-title w-100 font-weight-bold">Invite a Friend</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body mx-3">


						<!-- Course Name -->
						<div class="md-form mb-3">
							<label data-error="wrong" data-success="right" for="price">Enter the invitee Email</label>
							<input type="email" id="email" name="email" class="form-control validate">

						</div>

						<!-- SUBMIT -->
						<div class="modal-footer d-flex justify-content-center">
							<button type="submit" class="btn btn-primary">Send</button>
							<button type="button" class="btn btn-primary" style="background-color:red;" data-toggle="modal" data-target="#modalInvite">Cancel</button>


						</div>
					</div>
				</div>
			</form>
		</div>
		<script>





		</script>



		<!-- Register or unregister   -->
		<?php
		
		if(isset($_POST['submit1'])) {
            
			$sql1 = "SELECT * FROM user_courses WHERE Course_ID = $courseID and User_ID = $userID";
     		$result1 = mysqli_query($conn, $sql1);  
			
		   if(mysqli_num_rows($result) == 0){ 
	
			$sql = "INSERT INTO user_courses (Course_ID , User_ID) VALUES ('$courseID', '$userID' )";
			mysqli_query($conn, $sql);
	
		   }
			
		   else{
			   
			   $sql_d_q = "DELETE FROM user_courses WHERE Course_ID = $courseID and User_ID = $userID";
				mysqli_query($conn, $sql_d_q);
		   }
 
	
		// Refrash after submting 
		echo "<meta http-equiv='refresh' content='0'>";
		
		 
		 
	}

?>





</body>

</html>
