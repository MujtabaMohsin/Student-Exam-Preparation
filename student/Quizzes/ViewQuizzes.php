<?php session_start(); 
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Craete course</title>
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
$userID = $_SESSION["userID"];	
?>
	<!-- This is the main div -->

	<div class="container">
		<div id="quizzes_nav">

			<ul class="nav nav-tabs " style="width: auto;height: 100%;">
				<li class="nav-item"><a id="allQuizLink" class="nav-link active" href="<?php echo "ViewQuizzes.php?id=$course_id";?>">View All Quizzes</a></li>
				<li class="nav-item"><a id="addQuizLink" class="nav-link " href="<?php echo "CreateQuiz.php?id=$course_id";?>">Add a Quiz</a></li>
				<li class="nav-item"><a id="editQuizLink" class="nav-link" href="<?php echo "EditMyQuizzes.php?id=$course_id";?>">Edit My Quizzes</a></li>
				<li class="nav-item"><a id="randomQuizlink" class="nav-link" href="<?php echo "TakeRandomQuiz.php?id=$course_id";?>">Take Random Quiz</a></li>
			</ul>

		</div>

		<!-- Main Div for the page -->
		<div id="questions_div">

			<br>
			<h2 style="text-align:center;">View All Quizzes</h2>
			<br>


			<!-- Fetching data from database -->
			<?php
		
	$quiz_num = 0;	
	
    $sql = "SELECT * FROM quizzes WHERE courseID='$course_id'";
    $query = mysqli_query($conn, $sql);

    $rows = mysqli_num_rows($query);

    if($rows == 0){
        echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-secondary'>There is no quiz available now</span><br><br>";

    }
		
	
		

    while($row = mysqli_fetch_array($query)){
	 $quiz_num = $quiz_num + 1;	
	 $quizID = $row['quizID'];	
		
		//Get best result for the quiz
		    $sql = "SELECT MAX(result_value) AS maximum FROM quiz_results WHERE quizID='$quizID' AND studentID='$userID' ";
    		$query0 = mysqli_query($conn, $sql);
			$row1 = mysqli_fetch_array($query0); 
			$maximum_score = $row1['maximum'];
			 
	
    ?>



			<!-- Card for each quiz -->
			<div id="question_card_view" class="question_card card col-md-3" data-toggle="modal" data-target="#exampleModal<?php echo $quizID?>">
				<div class="card-body">
					<div class="card-header">

						<?php echo "<b>Quiz $quiz_num</b>"; ?>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><b><?php echo $row['quizTitle'];?></b></li>
						<li class="list-group-item"><?php echo $row['nbQuestions'];?> Questions , <?php echo $row['time'];?> Minutes</li>
						<li class="list-group-item">Best Score: <b><?php echo $maximum_score ?></b> </li>
					</ul>




					<ul style="" class="list-group list-group-flush">
						<a href="../Quizzes/TakeQuizInfo.php?id=<?php echo $course_id?>&qid=<?php echo $quizID?>"><button style="" type="button" class="btn btn-primary">Enter Quiz</button></a>
					</ul>


				</div>
				<a style="font-size: 12px;" href="" data-toggle="modal" data-target="#reportModal<?php echo $quiz_num?>" data-dismiss="modal">Report a problem</a>
				<br>
				<br>
			</div>





			<!--Report Modal-->
			<div class="modal fade" id="reportModal<?php echo $quiz_num?>" tabindex="-1" caller-id="" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body confirm-delete">
							<form id="report_form" method="post">
								Describe shortly the problem in this Quiz:
								<br><br>
								<input style="width: 90%" type="text" name="report_txt<?php echo $quiz_num?>" id="report_txt<?php echo $quiz_num?>">
						</div>
						<div class="modal-footer" style="margin: auto;">



							<input type="submit" id="report<?php echo $quiz_num?>" name="report<?php echo $quiz_num?>" class="btn btn-primary" value="Report">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

							</form>
						</div>
					</div>
				</div>
			</div>




			<!-- If a report is submitted -->
			<?php
		
		if(isset($_POST['report'.$quiz_num])){
			 $reporterID = $_SESSION["userID"];
			 $report_txt = $_POST['report_txt'.$quiz_num];
			 $sql_r = "INSERT INTO quiz_reports (quizID, text, reporterID) VALUES ('$quizID','$report_txt','$reporterID')";
			 mysqli_query($conn, $sql_r);
			
			 echo "<meta http-equiv='refresh' content='0'>";
			 
		}
		
		
 	
		?>


			<?php
        }
            ?>


		</div>
	</div>
	</div>
	</div>


	<script>
		ToQuizzes()

	</script>


</body>

</html>
