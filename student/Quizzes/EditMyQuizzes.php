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

	<div class="container">
		<div id="quizzes_nav">

			<ul class="nav nav-tabs " style="width: auto;height: 100%;">
				<li class="nav-item"><a id="allQuizLink" class="nav-link " href="<?php echo "ViewQuizzes.php?id=$course_id";?>">View All Quizzes</a></li>
				<li class="nav-item"><a id="addQuizLink" class="nav-link " href="<?php echo "CreateQuiz.php?id=$course_id";?>">Add a Quiz</a></li>
				<li class="nav-item"><a id="editQuizLink" class="nav-link active" href="<?php echo "EditMyQuizzes.php?id=$course_id";?>">Edit My Quizzes</a></li>
				<li class="nav-item"><a id="randomQuizlink" class="nav-link" href="<?php echo "TakeRandomQuiz.php?id=$course_id";?>">Take Random Quiz</a></li>
			</ul>

		</div>

		<!-- Main Div for the page -->
		<div id="questions_div">

			<br>
			<h2 style="text-align:center;">Edit My Quizzes</h2>
			<br>
			<input type="hidden" name="course_id" value="<?php echo $course_id?>">

			<!-- Fetching data from database -->
			<?php
		
	$quiz_num = 0;	
	
    $sql = "SELECT * FROM quizzes WHERE studentID=$userID";
    $query = mysqli_query($conn, $sql);

    $rows = mysqli_num_rows($query);

    if($rows == 0){
        echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-secondary'>There is no quiz available now</span><br><br>";

    }
		
	
		

    while($row = mysqli_fetch_array($query)){
	 $quiz_num = $quiz_num + 1;	
	 $quizID = $row['quizID'];	
		
		//Get best result for the quiz
		    $sql = "SELECT MAX(result_value) AS maximum FROM quiz_results WHERE quizID='$quizID' AND studentID='1' ";
    		$query0 = mysqli_query($conn, $sql);
			$row1 = mysqli_fetch_array($query0); 
			$maximum_score = $row1['maximum'];
			 
	
    ?>



			<!-- Card for each quiz -->
			<div id="question_card_edit" class="question_card card col-md-3" data-toggle="modal" data-target="#exampleModal<?php echo $quizID?>">
				<div class="card-body">
					<div class="card-header">

						<?php echo "<b>Quiz $quiz_num</b>"; ?>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><b><?php echo $row['quizTitle'];?></b></li>
						<li class="list-group-item"><?php echo $row['nbQuestions'];?> Questions , <?php echo $row['time'];?> Minutes</li>
					</ul>

					<a href="../Quizzes/EditQuizInfo.php?id=<?php echo $course_id?>&qid=<?php echo $quizID?>"><button style="" type="button" class="btn btn-success">Edit Quiz</button></a>
					<button style="" type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?php echo $quiz_num?>">Delete Quiz</button>



				</div>

				<br>

			</div>


			<!--Delete Modal-->
			<div class="modal fade" id="confirmDeleteModal<?php echo $quiz_num?>" tabindex="-1" caller-id="" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body confirm-delete">
							Are you sure you want to delete this quiz?
						</div>
						<div class="modal-footer">
							<form method="post">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

								<input type="submit" name="delete<?php echo $quiz_num?>" class="btn btn-danger" value="Delete">

							</form>
						</div>
					</div>
				</div>
			</div>






			<!-- If a deleation is submitted -->
			<?php
		
	if(isset($_POST['delete'.$quiz_num])){
		
		//Store the questions' IDs
		$sql0 = "SELECT quizQuestionID FROM quiz_questions WHERE quizID = '$quizID' ";
		$query0 = mysqli_query($conn, $sql0);

		$i = 0;
		while($row = mysqli_fetch_array($query0)){
					
		$questionID[$i] = $row['quizQuestionID'];
				 
		$i=$i+1;
		}
		
		
		//Delete quizzes by quiz ids
		$sql_d_quiz = "DELETE FROM quizzes WHERE quizID='$quizID'";
		mysqli_query($conn, $sql_d_quiz);
		
		
		//Delete question by quiz ids
		$sql_d_qus = "DELETE FROM quiz_questions WHERE quizID='$quizID'";
		mysqli_query($conn, $sql_d_qus);
		
		
		//Delete answers by quiz ids
		$sql_d_ans = "DELETE FROM quiz_answers WHERE quizID='$quizID'";
		mysqli_query($conn, $sql_d_ans);
		
		
		//Delete choices by question ids
		for ($q = 0; $q < count($questionID); $q++) {
			
		$sql_d_cho = "DELETE FROM quiz_choices WHERE questionID='$questionID[$q]'";
		mysqli_query($conn, $sql_d_cho);
		}
		
		
		//Delete reports by quiz ids
		$sql_d_rep = "DELETE FROM quiz_reports WHERE quizID='$quizID'";
		mysqli_query($conn, $sql_d_rep);
		
		
		//Delete answers by quiz ids
		$sql_d_res = "DELETE FROM quiz_results WHERE quizID='$quizID'";
		mysqli_query($conn, $sql_d_res);
		
		
		
		

 
		
		echo "<meta http-equiv='refresh' content='0'>";
		
	}
		
		
		
 	
		?>


			<?php
        }
            ?>


		</div>



		<script>
			ToQuizzes();

		</script>


</body>

</html>
