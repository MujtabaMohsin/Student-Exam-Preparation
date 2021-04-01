<?php session_start();
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Add a Question</title>
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
				<li class="nav-item"><a id="addQuestionLink" class="nav-link active" href="<?php $val = $_GET["id"]; echo "AddQuestionBank.php?id=$val";?>">Add a Question</a></li>
				<li class="nav-item"><a id="editQuestionLink" class="nav-link" href="<?php $val = $_GET["id"]; echo "EditQuestionBank.php?id=$val";?>">Edit My Questions</a></li>
			</ul>

		</div>
		<!-- PHP  -->
		<!-- If form is submitted  -->
		<?php
		
if(isset($_POST['submit'])) {
            
		  $question = $_POST['question'];
		  $c1 = $_POST['c1'];
 		  $c2 = $_POST['c2'];
		  $studentID = $_SESSION["userID"];
		  $courseID =  $_GET["id"];
		  $topic = $_POST['topic'];
	
	  
	if( $topic == "selecttopic"){
		$topic = $_POST['mySelect'];
		$sql = "INSERT INTO questions (title, courseID, studentID, topic) VALUES ('$question', $courseID ,$studentID, '$topic' )";
		mysqli_query($conn, $sql);
		
	}
	else{
		$topic =  $_POST['newTopic'];
		$sql = "INSERT INTO questions (title, courseID, studentID, topic) VALUES ('$question', $courseID ,$studentID, '$topic' )";
		mysqli_query($conn, $sql);

		$sql = "INSERT INTO course_topics ( course_ID , topic) VALUES ( $courseID , '$topic' )";
		mysqli_query($conn, $sql);
		
	}

	
	$sql0 = "SELECT questionID FROM questions ORDER BY questionID DESC LIMIT 1";
	$query0 = mysqli_query($conn, $sql0);
	
	while($row = mysqli_fetch_array($query0)){
		
		$questionID = $row['questionID'];
		
	}
	
	
	
	
	$sql1 = "INSERT INTO choices (questionID, choiceValue) VALUES ($questionID,'$c1')";
	mysqli_query($conn, $sql1);
 
	$sql2 = "INSERT INTO choices (questionID, choiceValue) VALUES ($questionID,'$c2')";
	mysqli_query($conn, $sql2);
	
	if(isset($_POST['c3'])){
		
		 $c3 = $_POST['c3'];
		
		$sql3 = "INSERT INTO choices (questionID, choiceValue) VALUES ($questionID,'$c3')";
		mysqli_query($conn, $sql3);
		
	}
	
		if(isset($_POST['c4'])){
		
		 $c4 = $_POST['c4'];
		
		$sql4 = "INSERT INTO choices (questionID, choiceValue) VALUES ($questionID,'$c4')";
		mysqli_query($conn, $sql4);
		
	}
	
		if(isset($_POST['c5'])){
		
		$c5 = $_POST['c5'];
		
		$sql5 = "INSERT INTO choices (questionID, choiceValue) VALUES ($questionID,'$c5')";
		mysqli_query($conn, $sql5);
		
	}
	
	
	 
		
		$answer = $_POST['radio'];
				
		$sql6 = "INSERT INTO answers (questionID,answerValue) VALUES ('$questionID','$answer')";
		mysqli_query($conn, $sql6);
		
		
		// Refrash after submting 
		echo '<div style="text-align:center;" class="alert alert-success"><strong>Thank you!</strong> your question was submitted successfuly</div>';
		
//		header("location:ViewQuestionBank.php?id=$courseID");
//		die();
			
	}

?>

		<br><br>
		<h2>Add a New Question to The Bank</h2>
		<br>
		<form id="MainForm" method="post" action="<?php echo $_SERVER['PHP_SELF']."?id=".$courseID ?>">
			<div class="form-group">
				<label> <b>Question:</b> </label>
				<input type="text" class="form-control" id="question" name="question" required>
			</div>
			<br>


			<label for="email"> <b>Choices:</b> </label>
			<div id="Multible_choices">
				<!-- Group of default radios - option 1 -->
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="defaultGroupExample1" value="c1" name="radio" checked>
					<label class="custom-control-label" for="defaultGroupExample1"><input class="w3-input w3-border" type="text" id="c1" name="c1" required></label>
				</div>

				<br>

				<!-- Group of default radios - option 2 -->
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="defaultGroupExample2" value="c2" name="radio">
					<label class="custom-control-label" for="defaultGroupExample2"><input class="w3-input w3-border" type="text" id="c2" name="c2" required></label>
				</div>

			</div>


			<br>
			<button id="add_field_button"><i class="fa fa-plus"> </i> Add More</button>

			<br><br><br>

			<!-- --------------new divs------------------- -->

			<div class="d-flex justify-content-between align-items-center align-content-center" style="height: 100%;width: 37%;">
				<div onclick="selectTopic()" class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="topic1" value="selecttopic" name="topic" checked>
					<label class="custom-control-label" for="topic1"><b>Select a topic</b>
					</label>
				</div>
				<div onclick="newTopic()" class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="topic2" value="newtopic" name="topic">
					<label class="custom-control-label" for="topic2"><b>Create a new topic</b>
					</label>
				</div>

			</div>

			<br>
			<div id="topic_select_div">
				<select style="width: 22%" id="mySelect" name="mySelect" class="custom-select">
					<?php  
						$sql = "SELECT * FROM course_topics WHERE course_ID = $courseID";
						$query = mysqli_query($conn, $sql);
						$num_topics = mysqli_num_rows($query);
					?>
					<option value="General" selected>General</option>
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

			<div id="newTopic_div" style="display: none;">

				<input width="40%" class="w3-input w3-border" type="text" name="newTopic">

			</div>

			<p id="long_quest"></p>
			<br>


			<button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>


		</form>
	</div>
	</div>
	</div>



	<!-- JQuery -->
	<script>
		$(document).ready(function() {


			var max_fields = 5; //maximum input boxes allowed
			var wrapper = $("#Multible_choices"); //Fields wrapper
			var add_button = $("#add_field_button"); //Add button ID

			var x = 2; //initlal text box count

			//This function is to add a new choice
			$(add_button).click(function(e) {

				e.preventDefault();

				if (x < max_fields) { //max input box allowed

					x++;

					$(wrapper).append('<br><div class="custom-control custom-radio"><input type="radio" value="c' + x + '" class="custom-control-input" id="defaultGroupExample' + x + '" name="radio"><label class="custom-control-label" for="defaultGroupExample' + x + '"><input required class="w3-input w3-border" type="text" name="c' + x + '"></label> <a href="#" class="remove_field"> X</a></div>');



				}
			});


			//This function is to remove a choice
			$(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
				e.preventDefault();
				$(this).parent().remove();
				x--;
			})


			$("#test3").val("Dolly Duck");


		});

	</script>


	</div>
	</div>

	<script>
		ToQuestionBank();

	</script>

	<script>
		function newTopic() {

			var topic_select_div = document.getElementById("topic_select_div");
			topic_select_div.style.display = "none";

			var new_topic_div = document.getElementById("newTopic_div");
			new_topic_div.style.display = "block";



		}

		function selectTopic() {

			var topic_select_div = document.getElementById("topic_select_div");
			topic_select_div.style.display = "block";

			var new_topic_div = document.getElementById("newTopic_div");
			new_topic_div.style.display = "none";



		}

	</script>

	<script>
		$(document).ready(function() {

			$('#MainForm').submit(function(e) {


				// Get the value of the input field with  
				var question = document.getElementById("question").value;

				var c1 = document.getElementById("c1").value;
				var c2 = document.getElementById("c2").value;


				if (250 < question.length || 250 < c1.length || 250 < c2.length) {

					var textQ = "The question or one of the choices text is too long";


					e.preventDefault();


					document.getElementById("long_quest").innerHTML = textQ;
				}





			});
		});

	</script>
</body>

</html>
