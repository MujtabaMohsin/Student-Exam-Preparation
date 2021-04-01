<?php session_start(); 
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Take Random Quiz</title>
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
		<!-- Question Information div -->
		<div id="CreateQuiz" class="container">
			<br><br>
			<h2>Take Random Quiz</h2>
			<p>
				<h6>You will take a random quiz from a number of questions from Question Bank</h6>
			</p>
			<br>
			<form id="MainForm" method="post" action="../Quizzes/StartRandomQuiz.php?id=<?php echo $course_id?>">

				<div class="form-group">
					<label> <b>Number of Questions:</b> </label>
					<input type="number" class="form-control" id="nbQuestion" placeholder="1-20" name="nbQuestion" min="1" max="20">
				</div>


				<div class="form-group">
					<label> <b>Time:</b> </label>
					<input type=number class="form-control" id="time" placeholder="1-20 min" name="time" min="1" max="20">
				</div>

				<div class="form-group">
					<label> <b>Topic:</b> </label>
					<select id="mySelect" name="mySelect" class="custom-select">
						<?php  
						$sql = "SELECT * FROM course_topics WHERE course_ID = $course_id";
						$query = mysqli_query($conn, $sql);
						$num_topics = mysqli_num_rows($query);
					?>
						<option value="General" selected>All topics</option>
						<?php 
					
					$topics = [];
					$topics[0] = "General";
					$i = 1;
					while($row = mysqli_fetch_array($query)){
						  $topics[$i] = $row['topic'];	

						?>
						<option value="<?php echo $topics[$i]?>"><?php echo $topics[$i] ?></option>


						<?php 
						$i++;	
					}
					?>

					</select>
				</div>

				<br>

				<button onclick="validateMyForm();" type="submit" id="submit" name="submit" class="btn btn-primary">Start Quiz</button>



			</form>
			<br>
			<p id="demo"></p>
		</div>
	</div>
	</div>
	</div>


	<?php 

	//Get all questions of the bank 
		
	$sql_questions = "SELECT * FROM questions WHERE courseID='$course_id'";
	$query_questions = mysqli_query($conn,$sql_questions);
	$num_questions_inDB = mysqli_num_rows($query_questions);
 
	
?>



	<script>
		$(document).ready(function() {

			$('#MainForm').submit(function(e) {
				var x, text;

				// Get the value of the input field with  
				x = document.getElementById("nbQuestion").value;




				if (isNaN(x) || x > <?php echo $num_questions_inDB  ?>) {
					text = "The number of available questions now is less than you want, Try again ";

					e.preventDefault();


					document.getElementById("demo").innerHTML = text;
				}




			});
		});

	</script>

	<script>
		ToQuizzes();

	</script>

</body>

</html>
