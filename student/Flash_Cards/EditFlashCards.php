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
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>





</head>

<body>
	<?php 
include_once "../../page/header.php";
include_once "../../page/Left_List.php";
$courseID = $_GET["id"];
$userID = $_SESSION["userID"];
?>
	<!-- This is the main div -->
	<div class="container" style="width:80%">
		<div>

			<ul class="nav nav-tabs " style="width: auto;height: 100%;">
				<li class="nav-item"><a id="allCardsLink" class="nav-link " href="<?php echo "ViewFlashCards.php?id=$courseID";?>">View All Cards</a></li>
				<li class="nav-item"><a id="addCardLink" class="nav-link " href="<?php  echo "AddFlashCard.php?id=$courseID";?>">Add a Card</a></li>
				<li class="nav-item"><a id="editCardLink" class="nav-link active" href="<?php echo "EditFlashCards.php?id=$courseID";?>">Edit My Cards</a></li>
			</ul>

		</div>
		<!-- Main Div for the page -->
		<div id="questions_div">

			<br>
			<h2 style="text-align:center;">Edit My Flash Cards</h2>
			<br>

			<!-- Fetching data from database -->
			<?php
	
		
	$card_num = 0;	
 
    $courseID = $_GET["id"];
    $studentID = $_SESSION["userID"];
   

    $sql = "SELECT * FROM flashcards WHERE courseID = $courseID AND studentID = $studentID";
    $query = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($query);
	$num_cards = $rows;
    if($rows == 0){
       		?>
			<div style="text-align:center;">
				<?php
        echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-secondary'>There is no flashcards available now</span><br><br>";
				?>
			</div>
			<?php

    }
		
	
		
if($rows > 0){
    while($row = mysqli_fetch_array($query)){
	 $card_num=$card_num+1;	
	 $cardID = $row['cardID'];	 
    ?>

			<div id="question_card_edit" class="question_card card col-md-3">
				<div class="card-body">
					<form method="post">
						<div class="card-header">

							<?php echo "<b>Card $card_num</b>"; ?>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item"><?php echo $row['title'];?></li>

						</ul>
						<button style="padding: 3px 4px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#eexampleModal<?php echo $card_num?>">Edit</button>
						<button style="padding: 3px 4px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?php echo $card_num?>">Delete</button>
				</div>

				<br>

			</div>




			<!-- Modal for each card -->
			<div class="modal fade" id="eexampleModal<?php echo $card_num?>" tabindex="-1" role="dialog" aria-labelledby="eexampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<br>
						<label style="text-align: left; margin-left: 30px; "> <b>Title:</b></label>
						<div class="modal-header">



							<input name="title" id="title_edit_flash" type="text" value="<?php echo $row['title'];?>" required>

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>



						<!-- body -->
						<div class="modal-body">

							<div class="form-group">
								<label style=" margin-right: 94%; "> <b>Content:</b> </label>
								<textarea class="ckeditor" name="editor" name="content" rows="3" placeholder="Briefly describe the quiz" required><?php echo $row['Content']; ?></textarea>
							</div>


							<label style="  margin-right: 94%; "><b>Type:</b> </label>
							<div class="d-flex justify-content-between align-items-center align-content-center" style="height: 100%;width: 24%;">

								<?php  
								if($row['type'] == 0){ ?>
								<div class="form-check ">
									<input class="form-check-input visabilty" type="radio" id="formCheck-1" checked name="radio_type" value="0"><label class="form-check-label" for="formCheck-1">Public </label>
								</div>
								<?php } else{ ?>

								<div class="form-check ">
									<input class="form-check-input visabilty" type="radio" id="formCheck-1" name="radio_type" value="0"><label class="form-check-label" for="formCheck-1">Public </label>
								</div>
								<?php	} ?>


								<?php if($row['type'] == 0){ ?>
								<div class="form-check ">
									<input class="form-check-input visabilty" type="radio" id="formCheck-2" name="radio_type" value="1"><label class="form-check-label" for="formCheck-2">Private </label>
								</div>
								<?php } else{ ?>

								<div class="form-check ">
									<input class="form-check-input visabilty" type="radio" id="formCheck-2" checked name="radio_type" value="1"><label class="form-check-label" for="formCheck-2">Private </label>
								</div>
								<?php	} ?>

							</div>
							<br>

							<!-- --------------new divs------------------- -->

							<div class="d-flex justify-content-between align-items-center align-content-center" style="height: 100%;width: 54%; margin-right: 20px;">
								<div onclick="selectTopic<?php echo $card_num?>()" class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="topic1<?php echo $card_num?>" value="selecttopic<?php echo $card_num?>" name="topic<?php echo $card_num?>" checked>
									<label class="custom-control-label" for="topic1<?php echo $card_num?>"><b>Select a topic</b>
									</label>
								</div>
								<div onclick="newTopic<?php echo $card_num?>()" class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="topic2<?php echo $card_num?>" value="newtopic<?php echo $card_num?>" name="topic<?php echo $card_num?>">
									<label class="custom-control-label" for="topic2<?php echo $card_num?>"><b>Create a new topic</b>
									</label>
								</div>

							</div>

							<br>

							<?php 
							
							$sql5 = "SELECT topic FROM flashcards WHERE cardID=$cardID ";
							$query5 = mysqli_query($conn, $sql5);

							$row5 = mysqli_fetch_array($query5);
							
							$topicThisQus = $row5['topic'];
		
		
							
							?>

							<div id="topic_select_div<?php echo $card_num?>">
								<select style="width: 42%" id="mySelect<?php echo $card_num?>" name="mySelect<?php echo $card_num?>" class="custom-select">
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

							<div id="newTopic_div<?php echo $card_num?>" style="display: none;">

								<input width="40%" class="w3-input w3-border" type="text" name="newTopic<?php echo $card_num?>">

							</div>


						</div>
						<div class="modal-footer">

							<input type="submit" name="ssubmit<?php echo $card_num?>" class="btn btn-primary" value="submit">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

						</div>
						</form>
					</div>
				</div>


			</div>


			<!--Delete Modal-->
			<div class="modal fade" id="confirmDeleteModal<?php echo $card_num?>" tabindex="-1" caller-id="" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body confirm-delete">
							Are you sure you want to delete this question?
						</div>
						<div class="modal-footer">
							<form method="post">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

								<input type="submit" name="delete<?php echo $card_num?>" class="btn btn-danger" value="Delete">

							</form>
						</div>
					</div>
				</div>
			</div>
			<?php
        
            ?>


			<!-- If an edit is submitted -->
			<?php

if(isset($_POST['ssubmit'.$card_num])){

	
 
		$title = $_POST['title'];
	    $content = $_POST['editor'];
		
	    $type = $_POST['radio_type'];
		$topictype = $_POST['topic'.$card_num];
	
		
if( $topictype == "selecttopic".$card_num){
	$topic = $_POST['mySelect'.$card_num];
   
	$sql_q = "UPDATE flashcards SET title='$title' , Content='$content' , type='$type' , topic='$topic'  WHERE cardID='$cardID'";
		$query_q = mysqli_query($conn, $sql_q);
}
	
	else{
	
	$topic = $_POST['newTopic'.$card_num];
		$sql_q = "UPDATE flashcards SET title='$title' , Content='$content' , type='$type' , topic='$topic'  WHERE cardID='$cardID'";
		$query_q = mysqli_query($conn, $sql_q);
	
	$sql2 = "INSERT INTO course_topics ( course_ID , topic) VALUES ( $courseID , '$topic' )";
	mysqli_query($conn, $sql2);
	
}
  		 
		 
 
 		//reload page
		echo "<meta http-equiv='refresh' content='0'>";


}
		
	// <!-- If a deletion is submitted -->	
	if(isset($_POST['delete'.$card_num])){
		$sql_d_q = "DELETE FROM flashcards WHERE cardID='$cardID'";
		mysqli_query($conn, $sql_d_q);
		
 
		//reload page
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
		ToFlashCards();

	</script>

	<script>
		<?php for ($i = 1; $i <= $num_cards; $i++) {?>

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
