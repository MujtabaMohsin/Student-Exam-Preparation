<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Notifications</title>
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
//$dateNow = date('H:i', time());
?>

	<div style="text-align:center;" class="container">
		<br>
		<h1>Notifications</h1>
		<br>


		<?php 
		  
	if($noteForThisUser != 0 && $receive_type == 0){
			
		for ($i = 0; $i < $noteForThisUser; $i++) { 
			
			if($EventsType[$i] == 'course_events'){
		 ?>


		<div class="list-group">
			<div href="#" class="list-group-item list-group-item-action flex-column align-items-start  ">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1">Reminder about <b><?php echo $notification[$i][0];?> Event</b> in <?php echo $notification[$i][1];?> course </h5>
					<small>Today</small>
				</div>
				<p style="text-align:left;" class="mb-1"><b>Event Description:</b> <?php echo $notification[$i][2];?></p>
				<small><a onclick="myAjax<?php echo $i;?>()" href="#">I Got it, Delete this.</a></small>
			</div>

		</div>
		<?php }
		elseif($EventsType[$i] == 'user_events'){
		?>

		<div class="list-group">
			<div href="#" class="list-group-item list-group-item-action flex-column align-items-start  ">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1">Reminder your personal <b><?php echo $notification[$i][0];?> Event</b></h5>
					<small>Today</small>
				</div>
				<p style="text-align:left;" class="mb-1"><b>Event Description:</b> <?php echo $notification[$i][2];?></p>
				<small><a onclick="myAjax<?php echo $i;?>()" href="#">I Got it, Delete this.</a></small>
			</div>

		</div>


		<?php }?>
		<br><br>
		<?php }
	}
		
		if($reportsForThisUser != 0 ){
			
		for ($i = 0; $i < $reportsForThisUser; $i++) { 
			
			if($reportTypes[$i] == "QB"){
		 ?>


		<div class="list-group">
			<div href="#" class="list-group-item list-group-item-action flex-column align-items-start  ">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1">Your Question <b>"<?php echo $notification2[$i][0];?> "</b> has been reported by someone.</h5>
					<small>Today</small>
				</div>
				<p style="text-align:left;" class="mb-1"><b>Problem Description:</b> <?php echo $notification2[$i][1];?></p>

				<small><a onclick="myAjax2<?php echo $i;?>()" href="#">I Got it, Delete this.</a></small>
			</div>

		</div>
		<?php }?>

		<?php 			
			if($reportTypes[$i] == "FC"){
		 ?>


		<div class="list-group">
			<div href="#" class="list-group-item list-group-item-action flex-column align-items-start  ">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1">Your Flash Card <b>"<?php echo $notification2[$i][0];?> "</b> has been reported by someone.</h5>
					<small>Today</small>
				</div>
				<p style="text-align:left;" class="mb-1"><b>Problem Description:</b> <?php echo $notification2[$i][1];?></p>

				<small><a onclick="myAjax2<?php echo $i;?>()" href="#">I Got it, Delete this.</a></small>
			</div>

		</div>
		<?php }?>



		<br><br>
		<?php }
	}
		
	if($reportsForThisUser == 0 && $noteForThisUser == 0 ){
	echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-success'>There is no notifications available now</span><br><br>";

	}
		?>

		<a href="NotificationSettings.php"><button style="margin-left: 80%;" class="btn btn-secondary btn-sm" type="button">Notification Settings</button></a>
		<br><br>

	</div>

	</div>
	</div>
	</div>




	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>






<script>
	<?php for ($i = 0; $i < $noteForThisUser; $i++) {  ?>

	function myAjax<?php echo $i ?>() {
		$.ajax({
			type: "POST",
			url: 'DeleteNotification.php/?id=' + <?php echo $new_EventIDs[$i] ?> + '&num=' + <?php echo $noteForThisUser ?>,
			data: {
				action: 'call_this<?php echo $i ?>'

			},
			success: function(html) {

				location.reload();
			}

		});
	}
	<?php }  ?>


	<?php for ($i = 0; $i < $reportsForThisUser; $i++) {  ?>

	function myAjax2<?php echo $i ?>() {
		$.ajax({
			type: "POST",
			url: 'DeleteNotification.php/?id=' + <?php echo $reportIDs[$i] ?> + '&num=' + <?php echo $reportsForThisUser ?>,
			data: {
				action: 'call_this<?php echo $i ?>'

			},
			success: function(html) {

				location.reload();
			}

		});
	}
	<?php }  ?>

</script>






</html>
