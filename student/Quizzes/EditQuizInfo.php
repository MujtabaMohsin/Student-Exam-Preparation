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



$quizID = $_GET['qid'];
 

$sql = "SELECT * FROM quizzes WHERE quizID='$quizID'";

$query = mysqli_query($conn,$sql);

$row = mysqli_fetch_array($query);


?>

		<!-- Question Information div -->
		<div id="CreateQuiz" class="container">
			<br><br>
			<h2>Edit Quiz's Information</h2>
			<br>
			<form id="MainForm" method="post" action="EditQuestionsQuiz.php?id=<?php echo $course_id?>&qid=<?php echo $quizID?>">
				<div class="form-group">
					<label> <b>Title of Quiz:</b> </label>
					<input type="text" class="form-control" id="quizTile" placeholder="Title" name="quizTile" value="<?php echo $row['quizTitle']; ?>">
				</div>
				<br>

				<div class="form-group">
					<label> <b>Number of Questions:</b> </label>
					<input type="number" class="form-control" id="nbQuestion" placeholder="5-10" name="nbQuestion" min="1" max="10" value="<?php echo $row['nbQuestions']; ?>" readonly>
				</div>
				<br>

				<div class="form-group">
					<label> <b>Time:</b> </label>
					<input type=number class="form-control" id="time" placeholder="5-10 min" name="time" min="5" max="10" value="<?php echo $row['time']; ?>">
				</div>

				<div class="form-group">
					<label> <b>Description:</b> </label>
					<input type="text" id="desc" class="md-textarea form-control" name="description" rows="3" placeholder="Briefly describe the quiz" value="<?php echo $row['description'];?>">
				</div>


				<br>

				<input type="hidden" name="quizID" value="<?php echo $quizID ?>">

				<button type="submit" id="submit" name="submit" class="btn btn-primary"> Continue</button>


			</form>
			<br>
		</div>

		<br>

		<script>
			ToQuizzes();

		</script>



</body>

</html>
