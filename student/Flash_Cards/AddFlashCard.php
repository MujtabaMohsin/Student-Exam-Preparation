<?php session_start();
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Add a Flash Card</title>
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
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>


</head>

<body>
	<?php 
include_once "../../page/header.php";
include_once "../../page/Left_List.php";
 $courseID =  $_GET["id"];

?>
	<!-- This is the main div -->
	<div class="container" style="width:80%">
		<div>

			<ul class="nav nav-tabs " style="width: auto;height: 100%;">
				<li class="nav-item"><a id="allCardsLink" class="nav-link " href="<?php echo "ViewFlashCards.php?id=$courseID";?>">View All Cards</a></li>
				<li class="nav-item"><a id="addCardLink" class="nav-link active" href="<?php  echo "AddFlashCard.php?id=$courseID";?>">Add a Card</a></li>
				<li class="nav-item"><a id="editCardLink" class="nav-link" href="<?php echo "EditFlashCards.php?id=$courseID";?>">Edit My Cards</a></li>
			</ul>

		</div>
		<!-- PHP  -->
		<!-- If form is submitted  -->
		<?php
		
if(isset($_POST['submit'])) {
            
		  $title = $_POST['title'];
		  $content = $_POST['editor'];
		  $studentID = $_SESSION["userID"];
		  $courseID =  $_GET["id"];
		  $type = $_POST['radio_type'];
		$topic = $_POST['topic'];
	
 
	
		if( $topic == "selecttopic"){
			$topic = $_POST['mySelect'];
			$sql = "INSERT INTO flashcards (courseID,title,Content,StudentID,type,topic) VALUES ('$courseID', '$title' ,'$content','$studentID','$type' , '$topic')";
			mysqli_query($conn, $sql);
		
	}
	else{
		$topic =  $_POST['newTopic'];
		$sql = "INSERT INTO flashcards (courseID,title,Content,StudentID,type,topic) VALUES ('$courseID', '$title' ,'$content','$studentID','$type' , '$topic')";
		mysqli_query($conn, $sql);

		$sql = "INSERT INTO course_topics ( course_ID , topic) VALUES ( $courseID , '$topic' )";
		mysqli_query($conn, $sql);
		
	}
	
 
	
		// Refrash after submting 
				echo '<div style="text-align:center;" class="alert alert-success"><strong>Thank you!</strong> your flashcard was submitted successfuly</div>';
		
		 
		 
	}

?>

		<br><br>
		<h2 style="text-align:center;">Add a New Flash Card</h2>
		<br>
		<form id="MainForm" method="post" action="<?php echo $_SERVER['PHP_SELF']."?id=".$courseID ?>">
			<div class="form-group">
				<label> <b>Title:</b> </label>
				<input type="text" class="form-control" id="title" name="title" required>
			</div>
			<br>

			<div class="form-group">
				<label> <b>Content:</b> </label>
				<textarea class="ckeditor" name="editor" name="content" rows="3" placeholder="Briefly describe the quiz" required></textarea>
			</div>


			<label> <b>Type:</b> </label>
			<div class="d-flex justify-content-between align-items-center align-content-center" style="height: 100%;width: 17%;">
				<div class="form-check ">
					<input class="form-check-input visabilty" type="radio" id="formCheck-1" checked name="radio_type" value="0"><label class="form-check-label" for="formCheck-1">Public</label>
				</div>
				<div class="form-check ">
					<input class="form-check-input visabilty" type="radio" id="formCheck-2" name="radio_type" value="1">
					<label class="form-check-label" for="formCheck-2">Private</label>
				</div>
			</div>
			<br><br>
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
			<br><br>

			<button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
			<br><br>

		</form>
	</div>
	</div>
	</div>



	<!-- JQuery -->
	<script>
		$(document).ready(function() {




		});

	</script>


	</div>
	</div>
	</div>
	</div>
	<script>
		ToFlashCards();

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


				var c1 = document.getElementById("title").value;



				if (250 < c1.length) {

					var textQ = "The title is too long";


					e.preventDefault();


					document.getElementById("long_quest").innerHTML = textQ;
				}





			});
		});

	</script>

</body>

</html>
