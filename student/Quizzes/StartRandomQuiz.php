<?php session_start(); 
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Start Random Quiz</title>
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
				<li class="nav-item"><a id="allQuizLink" class="nav-link " href="<?php echo "ViewQuizzes.php?id=$course_id";?>">View All Quizzes</a></li>
				<li class="nav-item"><a id="addQuizLink" class="nav-link " href="<?php echo "CreateQuiz.php?id=$course_id";?>">Add a Quiz</a></li>
				<li class="nav-item"><a id="editQuizLink" class="nav-link" href="<?php echo "EditMyQuizzes.php?id=$course_id";?>">Edit My Quizzes</a></li>
				<li class="nav-item"><a id="randomQuizlink" class="nav-link active" href="<?php echo "TakeRandomQuiz.php?id=$course_id";?>">Take Random Quiz</a></li>
			</ul>

		</div>

		<?php
 
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

 		$time = $_POST['time'];
		$nbQuestion_byUser= $_POST['nbQuestion'];
 		$topic = $_POST['mySelect']; 
		
	} 
 	
	//Get all questions of the bank 
	
	if($topic == "General"){
		$sql_questions = "SELECT * FROM questions WHERE courseID='$course_id'";
		$query_questions = mysqli_query($conn,$sql_questions);	
		$num_questions_inDB = mysqli_num_rows($query_questions);
		 
	}
	else{
		$sql_questions = "SELECT * FROM questions WHERE courseID='$course_id' and topic = '$topic' ";
		$query_questions = mysqli_query($conn,$sql_questions);
		$num_questions_inDB = mysqli_num_rows($query_questions);
	}


	if($num_questions_inDB < $nbQuestion_byUser ){
		?>
		<form id="takeQuizInfo" method="post" action="">


			<!-- One "tab" for each step in the form: -->

			<div id="Questions_div" class="container">

				<br>
				<h2 style="text-align:center;">Sorry, but the topic you choiced</h2>
				<h2 style="text-align:center;">has questions less than you want.</h2>
				<br>
				<h4 style="text-align:center;">The number of available questions in this topic is: <strong><?php echo $num_questions_inDB ?> </strong></h4>



				<br>
				<div style="text-align:center;">
					<a href="<?php echo "TakeRandomQuiz.php?id=$course_id";?>"><button type="button" class="btn btn-primary">Try Again </button></a></div>
				<br>
				<br>



			</div>

		</form>
		<?php
	}
	
	else{

	//put all questions ids in an array

	$i = 0;
	while($row = mysqli_fetch_array($query_questions)){

	$question_ids[$i]= $row['questionID'];

	$i=$i+1;
	}

	// define empty arrays
	$selected_question_ids = array();
	$randomNum_array = array();


	// now take an N number of questions randomly
	for ($i = 0; $i < $nbQuestion_byUser; $i++) { $is_it_in=true; while($is_it_in){ $random_num=rand(0,$num_questions_inDB-1); if (!(in_array($random_num, $randomNum_array))){ $randomNum_array[$i]=$random_num; $is_it_in=false; } } $selected_question_ids[$i]=$question_ids[$random_num];; } // store the titles of question in an array 
		
		for ($i=0; $i < $nbQuestion_byUser; $i++) { $sql_questions="SELECT title FROM questions WHERE questionID='$selected_question_ids[$i]'" ; $query_questions=mysqli_query($conn,$sql_questions); while($row=mysqli_fetch_array($query_questions)){ $questions_title[$i]=$row['title']; } } // store the choices of question in an array 
		
		for ($q=0; $q < $nbQuestion_byUser; $q++) {
			$sql_choices="SELECT * FROM choices WHERE questionID='$selected_question_ids[$q]'" ; $query_choices=mysqli_query($conn,$sql_choices); 
			$num_choices[$q]=mysqli_num_rows($query_choices); 
			$c=0; while($row=mysqli_fetch_array($query_choices)){ $questions_choices[$q][$c]=$row['choiceValue']; $c=$c+1; } } 
		
		// store the answers of question in an array 
		
		for ($i=0; $i < $nbQuestion_byUser; $i++) { 
			$sql_questions="SELECT answerValue FROM answers WHERE questionID='$selected_question_ids[$i]'" ; $query_questions=mysqli_query($conn,$sql_questions); 
			while($row=mysqli_fetch_array($query_questions)){ $correct_answes[$i]=$row['answerValue']; } } ?>


		<form id="StartQuiz" method="post" action="ResultRandomQuiz.php?id=<?php echo $course_id?>">

			<div style="text-align: right;" id="timer">Time Left: <span id="time">00:00</span></div>

			<!-- One "tab" for each step in the form: -->

			<div id="Questions_div" class="container">

				<?php 

				for ($q = 0; $q < $nbQuestion_byUser; $q++) {
				 
				?>

				<div id="q1" class="tab">
					<h4 style="text-align:center;">Question <?php echo $q+1 ?></h4>

					<label>
						<h5><?php echo $questions_title[$q] ?></h5>
					</label>



					<div id="Multible_choices">

						<?php  
						 
						
						for ($c = 0; $c < $num_choices[$q]; $c++) {
							
						?>

						<div class="custom-control custom-radio">

							<input type="radio" class="custom-control-input" id="choice<?php echo $c?>Q<?php echo $q?>" value="c<?php echo $c+1?>" name="radio<?php echo $q?>">

							<label class="custom-control-label" for="choice<?php echo $c?>Q<?php echo $q?>">
								<?php echo $questions_choices[$q][$c] ?>
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
				for ($i = 1; $i <= $nbQuestion_byUser; $i++) { 
			?>
				<span class="step"></span>

				<?php 
				}
    		?>

			</div>

			<input type="hidden" name="nbQuestion2" value="<?php echo $nbQuestion_byUser?>">

			<?php for ($a = 0; $a < $nbQuestion_byUser; $a++) {  ?>

			<input type="hidden" name="a<?php echo $a?>" value="<?php echo $correct_answes[$a]?>">


			<?php }  ?>
		</form>
		<?php }  ?>




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
