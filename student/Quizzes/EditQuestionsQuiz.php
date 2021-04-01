<?php session_start(); 
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Edit Quiz</title>
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
				<li class="nav-item"><a id="editQuizLink" class="nav-link active" href="<?php echo "EditMyQuizzes.php?id=$course_id";?>">Edit My Quizzes</a></li>
				<li class="nav-item"><a id="randomQuizlink" class="nav-link" href="<?php echo "TakeRandomQuiz.php?id=$course_id";?>">Take Random Quiz</a></li>
			</ul>

		</div>


		<?php
 


	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$quizID = $_POST['quizID'];
		$quizTile = $_POST['quizTile'];
 		$time = $_POST['time'];
		$nbQuestion = $_POST['nbQuestion'];
 		$description = $_POST['description']; 
		

		$sql_q = "UPDATE quizzes SET quizTitle='$quizTile' , nbQuestions = '$nbQuestion' , time='$time' , description= '$description' WHERE quizID='$quizID'";
		$query_q = mysqli_query($conn, $sql_q);
		
		 
		
	}


			//Store the questions' IDs
			$sql0 = "SELECT quizQuestionID FROM quiz_questions WHERE quizID = '$quizID' ";
			$query0 = mysqli_query($conn, $sql0);

			$i = 0;
			while($row = mysqli_fetch_array($query0)){
					
				$questionID[$i] = $row['quizQuestionID'];
				 
				$i=$i+1;
				}



			//Store the answers
		for ($q = 0; $q < $nbQuestion; $q++) {
			$sql0 = "SELECT answerValue FROM quiz_answers WHERE questionID = '$questionID[$q]' ";
			$query0 = mysqli_query($conn, $sql0);

			$i = 0;
			$row = mysqli_fetch_array($query0);
					
			$answerValue[$q] = $row['answerValue'];
				 
			 
		}
	
	
 
?>


		<form id="StartQuiz" method="post" action="EditDone.php?id=<?php echo $course_id?>&qid=<?php echo $quizID?>">


			<!-- One "tab" for each step in the form: -->

			<div id="Questions_div" class="container">

				<?php 
    			  $sql = "SELECT * FROM quiz_questions WHERE quizID='$quizID'";
				  $query1 = mysqli_query($conn, $sql);
			
				 	
 
				 $i = 0;
			
			//fetch all questions
    		while($rows = mysqli_fetch_array($query1)){
				
			$i = $i+1;

			?>

				<div id="q1" class="tab">
					<h4 style="text-align:center">Question <?php echo $i ?></h4>

					<h5>Question Title:</h5>
					<label style="width: 100%">
						<p><input type="text" name="titleQus<?php echo $i?>" id="title" value="<?php echo $rows['questionTitle']; ?>"></p>
					</label>




					<?php 
				 $qusID = $rows['quizQuestionID'];
				 $sql2 = "SELECT * FROM quiz_choices WHERE questionID='$qusID'";
				 $query2 = mysqli_query($conn, $sql2);
				
				?>



					<div id="Multible_choices">

						<h5>Choices:</h5>
						<?php  
				
				
				$y = 0;
				
					//fetch all choices of this question
				while($rows2 = mysqli_fetch_array($query2)){
					$y=$y+1;
					?>

						<div class="custom-control custom-radio">

							<?php 
						if($answerValue[$i-1] == 'c'.$y){ ?>
							<input type="radio" class=" " id="choice<?php echo $y?>Q<?php echo $i?>" value="c<?php echo $y?>" name="radio<?php echo $i?>" checked>

							<?php  } 
						else{ ?>
							<input type="radio" class=" " id="choice<?php echo $y?>Q<?php echo $i?>" value="c<?php echo $y?>" name="radio<?php echo $i?>">
							<?php  } ?>




							<input type="text" name="c<?php echo $y?>Q<?php echo $i?>" value="<?php echo $rows2['choiceValue'] ?>">

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

	</script>

	<!-- No Resubmit if you reload -->
	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}

	</script>

	<script>
		ToQuizzes();

	</script>

</body>

</html>
