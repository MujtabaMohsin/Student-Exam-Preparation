<?php session_start(); 
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Creat Quiz</title>
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
	<script>
		ToQuizzes()

	</script>

</head>

<body>
	<?php 
include_once "../../page/header.php";
include_once "../../page/Left_List.php";
$course_id = $_GET["id"];
$userID = $_SESSION["userID"];
?>
	<!-- This is the main div -->

	<div class="container" style="width:80%">
		<div id="quizzes_nav">

			<ul class="nav nav-tabs " style="width: auto;height: 100%;">
				<li class="nav-item"><a id="allQuizLink" class="nav-link " href="<?php echo "ViewQuizzes.php?id=$course_id";?>">View All Quizzes</a></li>
				<li class="nav-item"><a id="addQuizLink" class="nav-link active" href="<?php echo "CreateQuiz.php?id=$course_id";?>">Add a Quiz</a></li>
				<li class="nav-item"><a id="editQuizLink" class="nav-link" href="<?php echo "EditMyQuizzes.php?id=$course_id";?>">Edit My Quizzes</a></li>
				<li class="nav-item"><a id="randomQuizlink" class="nav-link" href="<?php echo "TakeRandomQuiz.php?id=$course_id";?>">Take Random Quiz</a></li>
			</ul>

		</div>


		<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$quizTile = $_POST['quizTile'];
 		$time = $_POST['time'];
		$nbQuestion = $_POST['nbQuestion'];
 		$description = $_POST['description']; 
		
						
		$sql = "INSERT INTO quizzes (quizTitle, nbQuestions, time, description, courseID, studentID) VALUES ('$quizTile','$nbQuestion' , '$time', '$description' , '$course_id' , $userID )";
		mysqli_query($conn, $sql);
		
		//Get the created quiz ID

		$sql0 = "SELECT quizID FROM quizzes ORDER BY quizID DESC LIMIT 1";
		$query0 = mysqli_query($conn, $sql0);
	
		while($row = mysqli_fetch_array($query0)){
		
		$quizID = $row['quizID'];
		
		}

		 
		
	}

?>
		<form id="StartQuiz" method="post" action="thankyou.php?id=<?php echo $course_id?>">


			<!-- One "tab" for each step in the form: -->

			<div id="Questions_div" class="container">

				<?php 
    			for ($i = 1; $i <= $nbQuestion; $i++) { 
			?>

				<div id="q1" class="tab">
					<h4 style="text-align:center">Question <?php echo $i ?></h4>
					<h5>Question Title:</h5>
					<p><input type="text" name="titleQus<?php echo $i?>" id="title"></p>



					<h5>Choices:</h5>
					<div id="Multible_choices">
						<!-- Group of default radios - option 1 -->
						<div class="custom-control custom-radio">

							<input type="radio" class="custom-control-input" id="choice1Q<?php echo $i?>" value="c1" name="radio<?php echo $i?>" checked>

							<label style="width: 100%" class="custom-control-label" for="choice1Q<?php echo $i?>">
								<input type="text" name="c1Q<?php echo $i?>">
							</label>
						</div>

						<br>
						<!-- Group of default radios - option 2 -->
						<div class="custom-control custom-radio">

							<input type="radio" class="custom-control-input" id="choice2<?php echo $i?>" value="c2" name="radio<?php echo $i?>">

							<label style="width: 100%" class="custom-control-label" for="choice2<?php echo $i?>">
								<input type="text" name="c2Q<?php echo $i?>">
							</label>
						</div>

						<br>
						<!-- Group of default radios - option 3 -->
						<div class="custom-control custom-radio">

							<input style="width: 100%" type="radio" class="custom-control-input" id="choice3<?php echo $i?>" value="c3" name="radio<?php echo $i?>">

							<label style="width: 100%" class="custom-control-label" for="choice3<?php echo $i?>">
								<input type="text" name="c3Q<?php echo $i?>">
							</label>
						</div>

						<br>

						<!-- Group of default radios - option 4 -->
						<div class="custom-control custom-radio">

							<input type="radio" class="custom-control-input" id="choice4<?php echo $i?>" value="c4" name="radio<?php echo $i?>">

							<label style="width: 100%" class="custom-control-label" for="choice4<?php echo $i?>">
								<input type="text" name="c4Q<?php echo $i?>">
							</label>
						</div>



						<br>


					</div>

				</div>

				<?php } ?>
			</div>

			<div style="overflow:auto;">
				<div style="float:right;">
					<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
					<button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
				</div>
			</div>
			<!-- Circles which indicates the steps of the form: -->
			<div style="text-align:center;margin-top:40px;">
				<?php 
				for ($i = 1; $i <= $nbQuestion; $i++) { 
			?>
				<span class="step"></span>

				<?php 
				}
    		?>

			</div>

			<input type="hidden" name="nbQuestion2" value="<?php echo $nbQuestion?>">
			<input type="hidden" name="quizID" value="<?php echo $quizID?>">

		</form>



		<!-- After Submit -->
		<?php 
	

	
	
	?>




		<script>
			var currentTab = 0; // Current tab is set to be the first tab (0)
			showTab(currentTab); // Display the current tab

			function showTab(n) {
				// This function will display the specified tab of the form...
				var x = document.getElementsByClassName("tab");
				x[n].style.display = "block";
				//... and fix the Previous/Next buttons:
				if (n == 0) {
					document.getElementById("prevBtn").style.display = "none";
				} else {
					document.getElementById("prevBtn").style.display = "inline";
				}
				if (n == (x.length - 1)) {
					document.getElementById("nextBtn").innerHTML = "Submit";
				} else {
					document.getElementById("nextBtn").innerHTML = "Next";
				}
				//... and run a function that will display the correct step indicator:
				fixStepIndicator(n)
			}

			function nextPrev(n) {
				// This function will figure out which tab to display
				var x = document.getElementsByClassName("tab");
				// Exit the function if any field in the current tab is invalid:
				if (n == 1 && !validateForm()) return false;
				// Hide the current tab:
				x[currentTab].style.display = "none";
				// Increase or decrease the current tab by 1:
				currentTab = currentTab + n;
				// if you have reached the end of the form...
				if (currentTab >= x.length) {
					// ... the form gets submitted:
					document.getElementById("StartQuiz").submit();
					return false;
				}
				// Otherwise, display the correct tab:
				showTab(currentTab);
			}

			function validateForm() {
				// This function deals with validation of the form fields
				var x, y, i, valid = true;
				x = document.getElementsByClassName("tab");
				y = x[currentTab].getElementsByTagName("input");
				// A loop that checks every input field in the current tab:
				for (i = 0; i < y.length; i++) {
					// If a field is empty...
					if (y[i].value == "") {
						// add an "invalid" class to the field:
						y[i].className += " invalid";
						// and set the current valid status to false
						valid = false;
					}
				}
				// If the valid status is true, mark the step as finished and valid:
				if (valid) {
					document.getElementsByClassName("step")[currentTab].className += " finish";
				}
				return valid; // return the valid status
			}

			function fixStepIndicator(n) {
				// This function removes the "active" class of all steps...
				var i, x = document.getElementsByClassName("step");
				for (i = 0; i < x.length; i++) {
					x[i].className = x[i].className.replace(" active", "");
				}
				//... and adds the "active" class on the current step:
				x[n].className += " active";
			}

		</script>


		<script>
			ToQuizzes();

		</script>
</body>

</html>
