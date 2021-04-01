<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Summary</title>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">
	<link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
	<link rel="stylesheet" href="../../assets/fonts/ionicons.min.css">
	<link rel="stylesheet" href="../../assets/fonts/material-icons.min.css">
	<link rel="stylesheet" href="../../assets/fonts/simple-line-icons.min.css">
	<link rel="stylesheet" href="../../assets/css/-Login-form-Page-BS4-.css">
	<link rel="stylesheet" href="../../assets/css/styles.css">
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">


	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../assets/js/sc2.js"></script>
</head>

<body>

	<?php 
include_once "../../page/header.php";
include_once "../../page/Left_List.php";
?>
	<div class="d-flex flex-column content" style="padding-left: 0;">
		<br>
		<header style="width: 100%;margin-left: 1%;margin-right: 1%;">
			<h1 class="float-left" style="width: auto;height: auto;font-size: 2em;">Summaries</h1>
			<!-- <div class="float-right"> -->
			<!-- <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#modalInvite" style="margin-top: 0.5%;"><i class="icon ion-person-add"></i> -->
			<!-- <span>&nbsp; Invite</span></button></div> -->
		</header>
		<div class="d-flex justify-content-start align-items-start flex-nowrap flex-sm-row flex-md-row flex-lg-row flex-xl-row parent">



			<main id="summary">
				<header style="height: 47px; width: 1295.975px">
					<button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#modalAddSummary" style="margin-top: 0.5%;"><i class="material-icons" style="font-size: 20px;">note_add</i><span>&nbsp; Add Summary</span></button>
					<div class="d-flex justify-content-between align-items-center align-content-center" style="height: 100%;width:20%;">
						<div class="form-check "><input class="form-check-input visabilty1" type="radio" id="formCheck-11" checked name="visibility1" value="All Notes"><label class="form-check-label" for="formCheck-1"><strong>All Notes</strong></label></div>
						<div class="form-check "><input class="form-check-input visabilty1" type="radio" id="formCheck-21" name="visibility1" value="My Notes"><label class="form-check-label" for="formCheck-2"><strong>My notes</strong></label></div>
					</div>
				</header>


				<div role="tablist" id="accordion-2" class="acc1">


				</div>
			</main>
		</div>
	</div>



	<div class="modal fade" id="modalAddSummary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">




		<div class="modal-dialog" role="document">


			<form action="<?php $val = $_GET["id"]; echo "addSummary.php?id=$val";?>" method="post" enctype="multipart/form-data">


				<div class="modal-content">
					<div class="modal-header text-center">
						<h4 class="modal-title w-100 font-weight-bold">Add Note</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body mx-3">


						<!-- Course Name -->
						<div class="md-form mb-3">
							<input type="radio" id="public" value="public" name="addType" checked>
							<label data-error="wrong" data-success="right" for="public" style="margin-right:2%">Public</label>

							<input type="radio" id="private" value="private" name="addType">
							<label data-error="wrong" data-success="right" for="private">Private</label>

						</div>

						<!--  -->
						<div class="md-form mb-3">
							<label data-error="wrong" data-success="right" for="chapter">Note Chapter No.</label>
							<input type="number" id="chapter" name="chapter" class="form-control validate" required>
						</div>

						<div class="md-form mb-3">
							<label data-error="wrong" data-success="right" for="section">Note Section No.</label>
							<input type="number" id="section" name="section" class="form-control validate" required>
						</div>

						<div class="md-form mb-3">
							<label for="img" data-success="right" for="img">Select image:</label>
							<input type="file" id="img" name="note" accept="image/*, .pdf, .doc, .docx, .ppt, .pptx" required>
						</div>








						<!-- SUBMIT -->
						<div class="modal-footer d-flex justify-content-center">
							<button type="button" class="btn btn-primary" style="background-color:red;" data-toggle="modal" data-target="#modalAddSummary">Cancel</button>
							<button type="submit" class="btn btn-primary">Send</button>

						</div>
					</div>
				</div>
			</form>
		</div>




		<script>
			$(document).ready(function() {
				ToSummary();
				filter_data();



				function filter_data() {
					//store data in variable
					$('.acc1').html('<div id="loading" style="" ></div>');
					var action = 'fetch_data';

					var visabilty1 = get_filter('visabilty1');


					$.ajax({
						url: "<?php $val = $_GET["id"]; echo "showSummary.php?id=$val";?>",
						method: "POST",
						data: {
							action: action,
							visabilty1: visabilty1
						},
						success: function(data) {
							$('.acc1').html(data);
						}
					});
				}

				function get_filter(class_name) {
					var filter = [];
					$('.' + class_name + ':checked').each(function() {
						filter.push($(this).val());
						console.log($(this).val());
					});
					return filter;
				}

				$('.visabilty1').click(function() {
					filter_data();
				});
			});

		</script>
</body>

</html>
