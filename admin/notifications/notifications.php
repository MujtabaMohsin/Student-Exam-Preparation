<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Admin Notifications</title>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">
	<link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
	<link rel="stylesheet" href="../../assets/fonts/ionicons.min.css">
	<link rel="stylesheet" href="../../assets/fonts/material-icons.min.css">
	<link rel="stylesheet" href="../../assets/fonts/simple-line-icons.min.css">
	<link rel="stylesheet" href="../../assets/css/-Login-form-Page-BS4-.css">
	<link rel="stylesheet" href="../../assets/css/styles.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>


	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

</head>

<body>
	<?php 
include_once "../header.php";
include "../../connect/connect.php";
//$dateNow = date('H:i', time());
?>

	<div style="text-align:center;" class="container">
		<br>
		<h1>Admin Notifications</h1>
		<br>


		<?php 
		  
 
		
		if($reportsForThisUser != 0 ){
			
		for ($i = 0; $i < $reportsForThisUser; $i++) { 
			
			if($reportTypes[$i] == "QB"){
		 ?>


		<div class="list-group">
			<div href="#" class="list-group-item list-group-item-action flex-column align-items-start  ">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1">This Question <b>"<?php echo $notification2[$i][0];?> "</b> has been reported by someone.</h5>
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
					<h5 class="mb-1">This Flash Card <b>"<?php echo $notification2[$i][0];?> "</b> has been reported by someone.</h5>
					<small>Today</small>
				</div>
				<p style="text-align:left;" class="mb-1"><b>Problem Description:</b> <?php echo $notification2[$i][1];?></p>

				<small><a onclick="myAjax2<?php echo $i;?>()" href="#">I Got it, Delete this.</a></small>
			</div>

		</div>
		<?php }?>

		<?php 			
			if($reportTypes[$i] == "CU"){
		 ?>


		<div class="list-group">
			<div href="#" class="list-group-item list-group-item-action flex-column align-items-start  ">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1">The user <b>"<?php echo $notification2[$i][0];?>"</b> has sent a massage to the admins.</h5>
					<small>Today</small>
				</div>
				<p style="text-align:left;" class="mb-1"><b>Massage:</b> <?php echo $notification2[$i][1];?></p>

				<small><a onclick="myAjax2<?php echo $i;?>()" href="#">I Got it, Delete this.</a></small>
			</div>

		</div>
		<?php }?>



		<br><br>
		<?php }
	}
		
	if($reportsForThisUser == 0 ){
	echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-success'>There is no notifications available now</span><br><br>";

	}
		?>



	</div>

	</div>
	</div>
	</div>




	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>






<script>
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
