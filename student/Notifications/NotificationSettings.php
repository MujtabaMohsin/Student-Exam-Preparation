<?php session_start();
$userID = $_SESSION["userID"];
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Notification Settings</title>
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
	<script src="../../assets/js/sc2.js"></script>

</head>

<body>
	<?php 
include_once "../../page/header.php";
include "../../connect/connect.php";
 
?>

	<div style="text-align:center;" class="container">
		<br>
		<h2>Notification Settings</h2>
		<br><br>

		<?php 
		
		$sql = "SELECT receive_type, time_before FROM notificationsettings WHERE userID=$userID ";
		$query = mysqli_query($conn, $sql);
		$rows = mysqli_fetch_array($query);
		$number_of_rows = mysqli_num_rows($query);
		 
		if($number_of_rows > 0){
			$receive_type = $rows['receive_type'];
			$time_before = $rows['time_before'];
		}
		else{
			$receive_type = 0;
			$time_before = 24;
		}
		
 
		
		?>

		<form method="post">
			<div>
				<label>
					<H4 style="margin-right: 200px;"><B>Receiving Reminders :</B></H4>
				</label>
				<div class="form-check">
					<input style="transform: scale(1.5);" type="hidden" id="receive" name="receive" value="0">

					<?php if($receive_type  == 0){ ?>
					<input style="transform: scale(1.5);" type="checkbox" id="receive" name="receive" value="1">

					<?php } else{ ?>

					<input style="transform: scale(1.5);" type="checkbox" id="receive" name="receive" value="1" checked>

					<?php } ?>


					<label style="font-size: 24px;" for="receive">&nbsp; I don't want to receive reminders for the events</label><br>

				</div>
				<br><br>

				<label>
					<H4 style="margin-right: 146px;"><B>Receive Reminders Before:</B></H4>
				</label>
				<div class="form-check">
					<select style="width:30%; margin-right: 196px;" name="notibefore" id="notibefore">
						<?php if($time_before  == 1){ ?>
						<option selected="selected" value="1">1 hour</option>
						<?php } 
						else{ ?>
						<option value="1">1 hour</option>
						<?php }  ?>

						<?php if($time_before  == 24){ ?>
						<option selected="selected" value="24">1 day</option>
						<?php } 
						else{ ?>
						<option value="24">1 day</option>
						<?php }  ?>

						<?php if($time_before  == 48){ ?>
						<option selected="selected" value="48">2 days</option>
						<?php } 
						else{ ?>
						<option value="48">2 days</option>
						<?php }  ?>
					</select>

				</div>
				<br><br>



				<button style="width:10%;" type="submit" id="submit" name="submit" class="btn btn-success">Update</button>


		</form>


	</div>

	<!-- If form is submitted  -->
	<?php
		
if(isset($_POST['submit'])) {
 
	$receive = $_POST['receive'];
 
	$notibefore = $_POST['notibefore'];
	
	if($receive != 1){
		$receive = 0;
	}
	
	$sql = "SELECT * FROM notificationsettings WHERE userID='$userID'";
	$query = mysqli_query($conn,$sql);
	$number_of_rows = mysqli_num_rows($query);
	
	if($number_of_rows>0){
		 
		$sql = "UPDATE notificationsettings SET receive_type='$receive' , time_before='$notibefore'  WHERE userID='$userID'";
		$query = mysqli_query($conn, $sql);

		
	}
	
	else{
		
		$sql = "INSERT INTO notificationsettings (userID,receive_type,time_before) VALUES ('$userID', '$receive' ,'$notibefore')";
		mysqli_query($conn, $sql);
	}

		//Refrash after submting 
		echo "<meta http-equiv='refresh' content='0'>";
		
		 
		 
	}

?>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>










</html>
