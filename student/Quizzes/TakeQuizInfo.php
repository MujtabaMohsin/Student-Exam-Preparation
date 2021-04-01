<?php session_start(); 
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Take Quiz</title>
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



?>


		<form id="takeQuizInfo" method="post" action="">





			<div id="Questions_div" class="container">

				<br>
				<h3><b>Quiz information</b></h3>
				<br>
				<h5><b>Title: </b><?php echo $row['quizTitle']; ?></h5>
				<h5><b>Number of Question: </b><?php echo $row['nbQuestions']; ?></h5>
				<h5><b>Time:</b> <?php echo $row['time']; ?></h5>
				<h5><b>Description: </b><?php echo $row['description']; ?></h5>

				<br>
				<a href="StartQuiz.php?id=<?php echo $course_id?>&qid=<?php echo $quizID?>"><button style="" type="button" class="btn btn-primary">Start Quiz</button></a>
				<br>
				<br>
				<br>




			</div>

		</form>

		<script>
			ToQuizzes();

		</script>


</body>

</html>
