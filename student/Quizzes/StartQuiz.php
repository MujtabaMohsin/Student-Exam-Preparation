<?php session_start(); 
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Start Quiz</title>
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
include_once "../../page/Left_List.php";
$course_id = $_GET["id"];
?>
	<!-- This is the main div -->

	<div class="container" style="width:80%">
		<div id="quizzes_nav">

			<ul class="nav nav-tabs " style="width: auto;height: 100%;">
				<li class="nav-item"><a id="allQuizLink" class="nav-link active" href="<?php echo "ViewQuizzes.php?id=$course_id";?>">View All Quizzes</a></li>
				<li class="nav-item"><a id="addQuizLink" class="nav-link " href="<?php echo "CreateQuiz.php?id=$course_id";?>">Add a Quiz</a></li>
				<li class="nav-item"><a id="editQuizLink" class="nav-link" href="<?php echo "EditMyQuizzes.php?id=$course_id";?>">Edit My Quizzes</a></li>
				<li class="nav-item"><a id="randomQuizlink" class="nav-link" href="<?php echo "TakeRandomQuiz.php?id=$course_id";?>">Take Random Quiz</a></li>
			</ul>

		</div>

		<?php
 

$quizID = $_GET['qid'];
 
$sql = "SELECT * FROM quizzes WHERE quizID='$quizID'";

$query = mysqli_query($conn,$sql);

$row = mysqli_fetch_array($query);

$nbQuestion = $row['nbQuestions'];


 // Get the time of the quiz
 $sql = "SELECT * FROM quizzes WHERE quizID='$quizID'";
 $query1 = mysqli_query($conn, $sql);

 $rows = mysqli_fetch_array($query1);

 $time = $rows['time'];
 
 
	
 
?>


		<form id="StartQuiz" method="post" action="ResultQuiz.php?id=<?php echo $course_id?>&qid=<?php echo $quizID?>">

			<div style="text-align: right;" id="timer">Time Left: <span id="time">00:00</span></div>

			<!-- One "tab" for each step in the form: -->

			<div id="Questions_div" class="container">

				<?php 
    			  $sql = "SELECT * FROM quiz_questions WHERE quizID='$quizID'";
				  $query1 = mysqli_query($conn, $sql);
			
				 

				  $quizID = $row['quizID'];
				 $i = 0;
			
			//fetch all questions
    		while($rows = mysqli_fetch_array($query1)){
				
				$i = $i+1;
					
				 
				 
			?>

				<div id="q1" class="tab">
					<h4 style="text-align:center" ;>Question <?php echo $i ?></h4>

					<label>
						<h5><?php echo $rows['questionTitle'] ?></h5>
					</label>


					<?php 
				 $qusID = $rows['quizQuestionID'];
				 $sql2 = "SELECT * FROM quiz_choices WHERE questionID='$qusID'";
				 $query2 = mysqli_query($conn, $sql2);
				
				?>



					<div id="Multible_choices">

						<?php  
					$y = 0;
					//fetch all choices of this question
				while($rows2 = mysqli_fetch_array($query2)){
					$y=$y+1;
					?>

						<div class="custom-control custom-radio">

							<input type="radio" class="custom-control-input" id="choice<?php echo $y?>Q<?php echo $i?>" value="c<?php echo $y?>" name="radio<?php echo $i?>">

							<label class="custom-control-label" for="choice<?php echo $y?>Q<?php echo $i?>">
								<?php echo $rows2['choiceValue'] ?>
							</label>
						</div>

						<br>
						<?php }?>
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

	</div>
	</div>


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


		function startTimer(duration, display) {
			var start = Date.now(),
				diff,
				minutes,
				seconds;

			function timer() {
				// get the number of seconds that have elapsed since 
				// startTimer() was called
				diff = duration - (((Date.now() - start) / 1000) | 0);

				// does the same job as parseInt truncates the float
				minutes = (diff / 60) | 0;
				seconds = (diff % 60) | 0;

				minutes = minutes < 10 ? "0" + minutes : minutes;
				seconds = seconds < 10 ? "0" + seconds : seconds;

				display.textContent = minutes + ":" + seconds;

				if (diff <= 0) {
					// add one second so that the count down starts at the full duration
					// example 05:00 not 04:59
					document.getElementById("StartQuiz").submit();
					return false;
				}
			};
			// we don't want to wait a full second before the timer starts
			timer();
			setInterval(timer, 1000);
		}

		window.onload = function() {
			var Minutes = 60 * <?php echo $time ?>,
				display = document.querySelector('#time');
			startTimer(Minutes, display);
		};

	</script>
	<script>
		ToQuizzes();

	</script>


</body>

</html>
