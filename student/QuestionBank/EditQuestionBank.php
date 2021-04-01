<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Edit My Questions</title>
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
$courseID = $_GET["id"];
?>
	<!-- This is the main div -->
	<div class="container" style="width:80%">
		<div>

			<ul class="nav nav-tabs " style="width: auto;height: 100%;">
				<li class="nav-item"><a id="allQuestionsLink" class="nav-link " href="<?php $val = $_GET["id"]; echo "ViewQuestionBank.php?id=$val";?>">View All Questions</a></li>
				<li class="nav-item"><a id="addQuestionLink" class="nav-link " href="<?php $val = $_GET["id"]; echo "AddQuestionBank.php?id=$val";?>">Add a Question</a></li>
				<li class="nav-item"><a id="editQuestionLink" class="nav-link active" href="<?php $val = $_GET["id"]; echo "EditQuestionBank.php?id=$val";?>">Edit My Questions</a></li>
			</ul>

		</div>
		<!-- Main Div for the page -->
		<div id="questions_div">

			<br>
			<h2 style="text-align:center;">Edit My Question Bank</h2>
			<br>

			<!-- Fetching data from database -->
			<?php
	
		
	$question_num = 0;	
 
    $courseID = $_GET["id"];
    $studentID = $_SESSION["userID"];
   

    $sql = "SELECT * FROM questions WHERE courseID = $courseID AND studentID = $studentID";
    $query = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($query);
	$num_myqus = $rows;
			
    if($rows == 0){
		?>
			<div style="text-align:center;">
				<?php
        echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-secondary'>There is no questions available now</span><br><br>";
				?>
			</div>
			<?php

    }
		
	
 
if($rows > 0){
    while($row = mysqli_fetch_array($query)){
	 $question_num=$question_num+1;	
	 $QID = $row['questionID'];	
	 
    ?>

			<div id="question_card_edit" class="question_card_edit card col-md-3">
				<div class="card-body">
					<form method="post">
						<div class="card-header">

							<?php echo "<b>Question $question_num</b>"; ?>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item"><?php echo $row['title'];?></li>
						</ul>
						<button style="padding: 4px 5px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#eexampleModal<?php echo $question_num?>">Edit</button>
						<button style="padding: 4px 5px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?php echo $question_num?>">Delete</button>
				</div>
				<br>

			</div>




			<!-- Modal for each card -->
			<div style="text-align:center;" class="modal fade" id="eexampleModal<?php echo $question_num?>" tabindex="-1" role="dialog" aria-labelledby="eexampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-header">
							<h5 class="modal-title" id="eexampleModalLabel">
								<input style="width: 417px;" name="question" type="text" value="<?php echo $row['title'];?>" required>
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>



						<!--------------------- choices------------------------- -->
						<div class="modal-body">
							<?php 
		
							$sql_answer = "SELECT answerValue FROM answers WHERE questionID=$QID ";
							$query_ans = mysqli_query($conn, $sql_answer);
		
							while($row = mysqli_fetch_array($query_ans)){
								$checked_ans = $row['answerValue'];
							}
							
							 
							 
			
							$sql2 = "SELECT * FROM choices WHERE questionID=$QID ";
							$query2 = mysqli_query($conn, $sql2);

							$rows_choiced = mysqli_num_rows($query2);
		
							$choice_num = 0;
		
							$Array = array();

							while($row = mysqli_fetch_array($query2)){
								
								$Array[$choice_num] = $row['choiceID'];
								
								$choice_num=$choice_num+1;
								
							  

						?>
							<div style="margin-right: 174px;" class="radio" id="choices">

								<label>


									<?php 
								 
								if($checked_ans == ('c'.$choice_num) ){ ?>
									<input type="radio" id="radio" name="radio" class="Q<?php echo $question_num?>" value="c<?php echo $choice_num;?>" checked>
									<?php } 

								 else{ ?>
									<input type="radio" id="radio" name="radio" class="Q<?php echo $question_num?>" value="c<?php echo $choice_num;?>">
									<?php } ?>

									<input style="width: 247px;" type="text" name="c<?php echo $choice_num;?>" id="c<?php echo $choice_num;?>" value="<?php echo $row['choiceValue'];?>" required></label>


							</div>

							<?php 	
							
								}
							
							?>


							<p id="result<?php echo $question_num?>"></p>


							<?php
						
							$sql3 = "SELECT answerValue FROM answers WHERE questionID=$QID ";
							$query3 = mysqli_query($conn, $sql3);

							while($row = mysqli_fetch_array($query3)){
								
								$corect_answer = $row['answerValue'];
							}
		
 
						?>


							<!-- --------------new divs------------------- -->

							<div class="d-flex justify-content-between align-items-center align-content-center" style="height: 100%;width: 78%; margin-left: 50px;">
								<div onclick="selectTopic<?php echo $question_num?>()" class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="topic1<?php echo $question_num?>" value="selecttopic<?php echo $question_num?>" name="topic<?php echo $question_num?>" checked>
									<label class="custom-control-label" for="topic1<?php echo $question_num?>">Select a topic
									</label>
								</div>
								<div onclick="newTopic<?php echo $question_num?>()" class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="topic2<?php echo $question_num?>" value="newtopic<?php echo $question_num?>" name="topic<?php echo $question_num?>">
									<label class="custom-control-label" for="topic2<?php echo $question_num?>">Create a new topic
									</label>
								</div>

							</div>

							<br>

							<?php 
							
							$sql5 = "SELECT topic FROM questions WHERE questionID=$QID ";
							$query5 = mysqli_query($conn, $sql5);

							$row5 = mysqli_fetch_array($query5);
							
							$topicThisQus = $row5['topic'];
		
		
							
							?>

							<div id="topic_select_div<?php echo $question_num?>">
								<select style="width: 42%" id="mySelect<?php echo $question_num?>" name="mySelect<?php echo $question_num?>" class="custom-select">
									<?php  
									$sql9 = "SELECT * FROM course_topics WHERE course_ID = $courseID";
									$query9 = mysqli_query($conn, $sql9);
									$num_topics = mysqli_num_rows($query9);
		 
									if($topicThisQus == "General"){
									?>
									<option value="General" selected>General</option>
									<?php 
									}
									else{
										?>
									<option value="General">General</option>
									<?php
									}
								$topics = [];
								$topics[0] = "General";
								$i = 1;
								while($row9 = mysqli_fetch_array($query9)){
								$topics[$i] = $row9['topic'];
								if($topicThisQus == $topics[$i]){
								?>
									<option value="<?php echo $topics[$i]?>" selected><?php echo $topics[$i] ?></option>


									<?php 
									}
									else{ 
										?>
									<option value="<?php echo $topics[$i]?>"><?php echo $topics[$i] ?></option>
									<?php
									}
							$i++;	
							}
									?>

								</select>

							</div>

							<div id="newTopic_div<?php echo $question_num?>" style="display: none;">

								<input width="40%" class="w3-input w3-border" type="text" name="newTopic<?php echo $question_num?>">

							</div>




						</div>









						<div class="modal-footer">

							<input type="submit" name="ssubmit<?php echo $question_num?>" class="btn btn-primary" value="Submit">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

						</div>
						</form>
					</div>
				</div>


			</div>


			<!--Delete Modal-->
			<div class="modal fade" id="confirmDeleteModal<?php echo $question_num?>" tabindex="-1" caller-id="" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body confirm-delete">
							Are you sure you want to delete this question?
						</div>
						<div class="modal-footer">
							<form method="post">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

								<input type="submit" name="delete<?php echo $question_num?>" class="btn btn-danger" value="Delete">

							</form>
						</div>
					</div>
				</div>
			</div>
			<?php
        
            ?>


			<!-- If an edit is submitted -->
			<?php

if(isset($_POST['ssubmit'.$question_num])){


		  $question = $_POST['question'];
		  $topictype = $_POST['topic'.$question_num];
	
if( $topictype == "selecttopic".$question_num){
	$topic = $_POST['mySelect'.$question_num];
    $sql_q = "UPDATE questions SET title='$question' , topic='$topic' WHERE questionID='$QID'";
    $query_q = mysqli_query($conn, $sql_q);
}
else{
	
	$topic = $_POST['newTopic'.$question_num];
    $sql_q = "UPDATE questions SET title='$question' , topic='$topic' WHERE questionID='$QID'";
    $query_q = mysqli_query($conn, $sql_q);
	
	$sql2 = "INSERT INTO course_topics ( course_ID , topic) VALUES ( $courseID , '$topic' )";
	mysqli_query($conn, $sql2);
	
}
 
	$x = 0;
	$y = 1;
	while( $x < $rows_choiced ){
	
		$ccc = $_POST['c'.$y];
		$sql_ccc = "UPDATE choices SET choiceValue='$ccc' WHERE choiceID='$Array[$x]' ";
		$query_c1 = mysqli_query($conn, $sql_ccc);
		
		 
	
		
		$x=$x+1;
		$y=$y+1;
	}
	
	
	$answer = $_POST['radio'];
				
	    $sql_a = "UPDATE answers SET answerValue='$answer' WHERE questionID='$QID'";
		mysqli_query($conn, $sql_a);
	

		echo "<meta http-equiv='refresh' content='0'>";


}
		
	// <!-- If a deletion is submitted -->	
	if(isset($_POST['delete'.$question_num])){
		$sql_d_q = "DELETE FROM questions WHERE questionID='$QID'";
		mysqli_query($conn, $sql_d_q);
		
		$sql_d_a = "DELETE FROM answers WHERE questionID='$QID'";
		mysqli_query($conn, $sql_d_a);
		
		 
		$x = 0;

		while( $x < $rows_choiced ){
	
			
			$sql_d_c = "DELETE FROM choices WHERE questionID='$QID' ";
			$query = mysqli_query($conn, $sql_d_c);

			$x=$x+1;
			
	}
		
		echo "<meta http-equiv='refresh' content='0'>";
		
	}
}	
 
}
?>




		</div>
	</div>
	</div>
	</div>

	<script>
		ToQuestionBank();

	</script>
	<script>
		<?php for ($i = 1; $i <= $num_myqus; $i++) {?>

		function newTopic<?php echo $i?>() {

			var topic_select_div<?php echo $i?> = document.getElementById("topic_select_div<?php echo $i?>");
			topic_select_div<?php echo $i?>.style.display = "none";

			var new_topic_div<?php echo $i?> = document.getElementById("newTopic_div<?php echo $i?>");
			new_topic_div<?php echo $i?>.style.display = "block";



		}

		function selectTopic<?php echo $i?>() {

			var topic_select_div<?php echo $i?> = document.getElementById("topic_select_div<?php echo $i?>");
			topic_select_div<?php echo $i?>.style.display = "block";

			var new_topic_div<?php echo $i?> = document.getElementById("newTopic_div<?php echo $i?>");
			new_topic_div<?php echo $i?>.style.display = "none";



		}

		<?php }?>

	</script>


</body>



</html>
