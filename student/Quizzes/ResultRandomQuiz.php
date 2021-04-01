<?php session_start(); 
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Quiz Result</title>
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
		
		
		$nbQuestion = $_POST['nbQuestion2'];
		$correct_num = 0;
			 	// get the user's answers		
		for ($i = 0; $i < $nbQuestion; $i++) {
			
			if(isset($_POST['radio'.($i)])){
					
				$answer_user[$i] = $_POST['radio'.($i)];
				}
			
			    else{
					
					$answer_user[$i] = "und";
				}
 
		}
		
		
		//get the correct answers and compare it to the user's
		for ($i = 0; $i < $nbQuestion; $i++) {
			
			$correct_ans[$i] = $_POST['a'.($i)];
			
			 
 			 
		}
			

		 
		 for ($i = 0; $i < $nbQuestion; $i++) {
			  
			 if( $correct_ans[$i] == $answer_user[$i]){
				 $correct_num=$correct_num+1;
				 
			 }
			  
		
		}
		
		 
		 
	}


?>



		<form id="takeQuizInfo" method="post" action="">


			<!-- One "tab" for each step in the form: -->

			<div id="Questions_div" class="container">

				<br>
				<h2 style="text-align:center;">Thank You for</h2>
				<h2 style="text-align:center;">Taking The Quiz</h2>
				<h2 style="text-align:center;">You Score is: <?php echo $correct_num ?> out of <?php echo $nbQuestion ?> </h2>

				<br>
				<div style="text-align:center;">
					<a href="<?php echo "ViewQuizzes.php?id=$course_id";?>"><button type="button" class="btn btn-primary">CLICK HERE TO BACK</button></a></div>
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
