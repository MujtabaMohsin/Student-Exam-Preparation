<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Resources</title>

	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">
	<link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
	<link rel="stylesheet" href="../../assets/fonts/ionicons.min.css">
	<link rel="stylesheet" href="../../assets/fonts/material-icons.min.css">
	<link rel="stylesheet" href="../../assets/fonts/simple-line-icons.min.css">
	<link rel="stylesheet" href="../../assets/css/-Login-form-Page-BS4-.css">
	<link rel="stylesheet" href="../../assets/css/styles.css">
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">






	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

	<?php 
include_once "../../page/header.php";
include_once "../../page/Left_List.php";
?>
	<br>
	<div class="d-flex flex-column" style="margin-left:4%">
		<header style="width: 100%;margin-left: 1%;margin-right: 1%;">
			<h1 class="float-left" style="width: auto;height: auto;font-size: 2em;">Resources</h1>
			<div class="float-right">
		</header>

		<br>
		<div>
			<main class="d-flex flex-column justify-content-between align-items-center align-content-center" id="discussion">

				<header style="height: 47px; width: 985.975px">

					<button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#modalAddResource" style="margin-top: 0.5%;"><i class="material-icons" style="font-size: 20px;">note_add</i><span>&nbsp; Add Resource</span></button>

					<div class="d-flex justify-content-between align-items-center align-content-center" style="height: 100%;width: 50%;">

						<div>
							<div class="form-check "><input class="form-check-input visabilty" type="radio" id="formCheck-1" checked name="visibility" value="All Notes"><label class="form-check-label" for="formCheck-1">All Resources</label></div>
							<div class="form-check "><input class="form-check-input visabilty" type="radio" id="formCheck-2" name="visibility" value="My Notes"><label class="form-check-label" for="formCheck-2">My Resources</label></div>
						</div>


						<p style="margin-left:10%; margin-bottom:6%"> <b>Type: </b></p>
						<br>
						<div>
							<br><br>
							<div class="form-check "><input class="form-check-input type" type="checkbox" id="formCheck-1" name="type" value="Video"><label class="form-check-label" for="formCheck-1">Video</label></div>
							<div class="form-check "><input class="form-check-input type" type="checkbox" id="formCheck-2" name="type" value="Document"><label class="form-check-label" for="formCheck-2">Document</label></div>

						</div>

						<div style="margin-left:10%">
							<br><br>
							<div class="form-check "><input class="form-check-input type" type="checkbox" id="formCheck-3" name="type" value="Book"><label class="form-check-label" for="formCheck-3">Book</label></div>
							<div class="form-check "><input class="form-check-input type" type="checkbox" id="formCheck-4" name="type" value="Website"><label class="form-check-label" for="formCheck-4">Website</label></div>

						</div>

					</div>


					<!-- <div class="d-flex justify-content-between align-items-center align-content-center" style="height: 100%;width: 20%;">
                        fdsfdsf
                    </div> -->
				</header>

				<br> <br>
				<div role="tablist" id="accordion-1" class="acc" style="margin-top:1%;">


				</div>
			</main>
		</div>
	</div>


	<div class="modal fade" id="modalAddResource" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">




		<div class="modal-dialog" role="document">


			<form action="<?php $val = $_GET["id"]; echo "addResource.php?id=$val";?>" method="post" enctype="multipart/form-data">


				<div class="modal-content">
					<div class="modal-header text-center">
						<h4 class="modal-title w-100 font-weight-bold">Add Resource</h4>
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
							<label data-error="wrong" data-success="right" for="chapter">Resource Title</label>
							<input type="text" id="title" name="title" class="form-control validate" required>
						</div>



						<div class="md-form mb-3">
							<label data-error="wrong" data-success="right" for="chapter">Related Chapter (If General Select <b>0</b>).</label>
							<input type="number" id="chapter" name="chapter" value=0 min=0 class="form-control validate" required>
						</div>





						<div class="md-form mb-3">
							<label data-error="wrong" data-success="right" for="type">Resource Type</label>

							<select name="type" id="type" class="form-control validate">

								<option value="Video">Video</option>
								<option value="Document">Document</option>
								<option value="Book">Book</option>
								<option value="Website">Website</option>
							</select>
						</div>


						<div class="md-form mb-3">
							<label data-error="wrong" data-success="right" for="chapter">Upload From</label>

							<select name="from" id="from" class="form-control validate">
								<option value="link">Link</option>
								<option value="My Computer">My Computer</option>
							</select>
						</div>


						<div class="md-form mb-3" id="LinkDiv">
							<label data-error="wrong" data-success="right" for="chapter">Link</label>
							<input type="url" id="Link" name="Link" class="form-control validate" required>
						</div>




						<div class="md-form mb-3" id="MyComputer" hidden>
							<label for="img" data-success="right" for="img">Select File:</label>
							<input type="file" id="img" name="img" accept="image/*, .pdf, .doc, .docx, .ppt, .pptx">
						</div>








						<!-- SUBMIT -->
						<div class="modal-footer d-flex justify-content-center">
							<button type="button" class="btn btn-primary" style="background-color:red;" data-toggle="modal" data-target="#modalAddNote">Cancel</button>
							<button type="submit" class="btn btn-primary">Send</button>

						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	</div>








	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../assets/js/sc2.js"></script>


	<script>
		$("#from").change(function() {

			if ($(this).val() == "link") {
				$("#LinkDiv").attr("hidden", false);
				$("#MyComputer").attr("hidden", true);
				$("#Link").attr("required", true);
				$("#img").attr("required", false);
			} else if ($(this).val() == "My Computer") {
				$("#LinkDiv").attr("hidden", true);
				$("#MyComputer").attr("hidden", false);
				$("#Link").attr("required", false);
				$("#img").attr("required", true);
			}

		});

		$(document).ready(function() {



			filter_data();



			function filter_data() {
				//store data in variable
				$('.acc').html('<div id="loading" style="" ></div>');
				var action = 'fetch_data';

				var visabilty = get_filter('visabilty');
				var type = get_filter('type');

				$.ajax({
					url: "<?php $val = $_GET["id"]; echo "showResources.php?id=$val";?>",
					method: "POST",
					data: {
						action: action,
						visabilty: visabilty,
						type: type
					},
					success: function(data) {
						$('.acc').html(data);
					}
				});
			}

			function get_filter(class_name) {
				var filter = [];
				$('.' + class_name + ':checked').each(function() {
					filter.push($(this).val());

				});
				return filter;
			}

			$('.visabilty').click(function() {
				filter_data();
			});
			$('.type').click(function() {
				filter_data();
			});
		});

	</script>


	<script>
		ToResources();

	</script>
</body>

</html>
