<?php session_start(); 
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Thank you</title>
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
				<li class="nav-item"><a id="addQuizLink" class="nav-link active" href="<?php echo "CreateQuiz.php?id=$course_id";?>">Add a Quiz</a></li>
				<li class="nav-item"><a id="editQuizLink" class="nav-link" href="<?php echo "EditMyQuizzes.php?id=$course_id";?>">Edit My Quizzes</a></li>
				<li class="nav-item"><a id="randomQuizlink" class="nav-link" href="<?php echo "TakeRandomQuiz.php?id=$course_id";?>">Take Random Quiz</a></li>
			</ul>

		</div>

		<?php
 

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		//Get the number of question and the quiz id from the hidden input of the previous page
		$nbQuestion2 = $_POST['nbQuestion2'];
		$quizID = $_POST['quizID'];
 
		
		//Store Questions
		for ($i = 0; $i < $nbQuestion2; $i++) {
				$question[$i] = $_POST['titleQus'.($i+1)];
				 
 				$sql = "INSERT INTO quiz_questions (quizID,questionTitle) VALUES ('$quizID','$question[$i]')";
				mysqli_query($conn, $sql);
			
			
				//Store the questions' IDs
				$sql0 = "SELECT quizQuestionID FROM quiz_questions ORDER BY quizQuestionID DESC LIMIT 1";
				$query0 = mysqli_query($conn, $sql0);

				while($row = mysqli_fetch_array($query0)){

					$questionID[$i] = $row['quizQuestionID'];

				}
			
				 
 
			}
		
		//Store Choices
		for ($i = 0; $i < $nbQuestion2; $i++) {
			
			for ($j = 0; $j < 4; $j++) {
				
 			$choice[$i][$j] = $_POST['c'.($j+1).'Q'.($i+1)];
			 
 
			}
		}
 		 		
		
	
			
		for ($x = 0; $x < $nbQuestion2; $x++) {
			
			for ($y = 0; $y < 4; $y++) {
				 
 				$sql = "INSERT INTO quiz_choices (questionID , choiceValue) VALUES ('$questionID[$x]', '{$choice[$x][$y]}')";
				mysqli_query($conn, $sql);
 
			}
		}
		
		 
	
	 
	 	//Store answers
	 			
		for ($i = 0; $i < $nbQuestion2; $i++) {
			
			    $answer[$i] = $_POST['radio'.($i+1)];
				 
 				$sql = "INSERT INTO quiz_answers (quizID ,questionID , answerValue) VALUES ('$quizID','$questionID[$i]', '$answer[$i]')";
				mysqli_query($conn, $sql);
 
			
		}
		
		
		
	}



?>

		<form id="takeQuizInfo" method="post" action="ViewQuizzes.php">


			<!-- One "tab" for each step in the form: -->

			<div style="text-align:center" id="Questions_div" class="container">

				<br>
				<h2>Thank You.</h2>
				<h2>The Quiz is Added</h2>
				<h2>Successfully.</h2>

				<br>
				<div style="text-align:center;">
					<a href="<?php echo "ViewQuizzes.php?id=$course_id";?>"><button type="button" class="btn btn-primary">CLICK HERE TO SEE IT</button></a></div>
				<br>
				<br>



			</div>

		</form>

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
