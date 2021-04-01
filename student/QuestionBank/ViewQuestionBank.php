<?php session_start(); 
 ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Question Bank</title>
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
	<div class="container">
		<div>

			<ul class="nav nav-tabs " style="width: auto;height: 100%;">
				<li class="nav-item"><a id="allQuestionsLink" class="nav-link active" href="<?php $val = $_GET["id"]; echo "ViewQuestionBank.php?id=$val";?>">View All Questions</a></li>
				<li class="nav-item"><a id="addQuestionLink" class="nav-link " href="<?php $val = $_GET["id"]; echo "AddQuestionBank.php?id=$val";?>">Add a Question</a></li>
				<li class="nav-item"><a id="editQuestionLink" class="nav-link" href="<?php $val = $_GET["id"]; echo "EditQuestionBank.php?id=$val";?>">Edit My Questions</a></li>
			</ul>

		</div>
		<!-- Main Div for the page -->
		<div id="questions_div" class="w-100">

			<br>
			<h2 style="text-align:center;">View All Question Bank</h2>
			<br>

			<!------------------------------ Select Topic ---------------------------------------------->
			<div class="float-right">
				<select id="mySelect" onchange="openType()" class="custom-select">
					<?php  
						$sql = "SELECT * FROM course_topics WHERE course_ID = $courseID";
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
			<br> <br><br>

			<!------------------------------ Select Topic ---------------------------------------------->

			<!-- Fetching data from database -->
			<?php
			 
	$courseID = $_GET["id"];
		
	

		
	for ($i = 0; $i <= $num_topics; $i++) {
		
		$question_num = 0;
			if($i == 0){
				$sql = "SELECT * FROM questions WHERE courseID = $courseID";
				$query = mysqli_query($conn, $sql);
			}
		
			else{
				$sql = "SELECT * FROM questions WHERE courseID = $courseID and topic= '$topics[$i]'";
				$query = mysqli_query($conn, $sql);
			}


    		$rows = mysqli_num_rows($query);
			?>

			<?php 
			if($rows == 0){?>
			<?php if($i != 0){ ?>
			<div style="display: none;" id="<?php echo $topics[$i] ?>" class="aa">
				<?php } else{ ?>
				<div id="<?php echo $topics[$i] ?>" class="aa">
					<?php } ?>
					<?php
     		   		?>
					<div style="text-align:center;">
						<?php
        echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-secondary'>There is no questions available now</span><br><br>";
				?>
					</div>
					<?php

    		
		
				?>
				</div>

				<?php }
		else { ?>
				<?php if($i != 0){ ?>
				<div style="display: none;" id="<?php echo $topics[$i] ?>" class="aa">
					<?php } 
			  	else{ ?>
					<div id="<?php echo $topics[$i] ?>" class="aa">
						<?php } ?>
						<?php
			while($row = mysqli_fetch_array($query)){
			 $question_num=$question_num+1;	
			 $QID = $row['questionID'];	
				?>

						<div style=" min-height: 177px;" id="question_card_view" class="question_card card col-md-3" data-toggle="modal" data-target="#exampleModal<?php echo $question_num?><?php echo $i?>">
							<div class="card-body">
								<div class="card-header">

									<?php echo "<b>Question $question_num</b>"; ?>
								</div>
								<ul class="list-group list-group-flush">
									<li class="list-group-item"><?php echo $row['title'];?></li>
								</ul>
							</div>

						</div>




						<!-- Modal for each card -->
						<div style="text-align:center;" class="modal fade" id="exampleModal<?php echo $question_num?><?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div style="width: 650px; margin: ;" class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"><?php echo $row['title'];?></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form>

											<?php 
		
							$sql2 = "SELECT choiceValue FROM choices WHERE questionID=$QID ";
							$query2 = mysqli_query($conn, $sql2);

							$rows = mysqli_num_rows($query2);
		
							$choice_num = 0;

							while($row = mysqli_fetch_array($query2)){
							$choice_num=$choice_num+1;

					?>
											<div class="radio" id="choices">
												<label style="font-size: 24px;"><input type="radio" class="Q<?php echo $question_num?><?php echo $i?>" name="optradio" value="c<?php echo $choice_num;?>"> <?php echo $row['choiceValue'];?></label>
											</div>

											<?php 	
							
								}
							
							?>

										</form>
										<!--------------- check if the answer is coorect or not and show the result-------------- -->

										<?php
						
							$sql3 = "SELECT answerValue FROM answers WHERE questionID=$QID ";
							$query3 = mysqli_query($conn, $sql3);

							while($row = mysqli_fetch_array($query3)){
								
								$corect_answer = $row['answerValue'];
							}
		

						?>


									</div>


									<p><i id="sign<?php echo $question_num?><?php echo $i?>" aria-hidden="true"></i><strong id="result<?php echo $question_num?><?php echo $i?>"></strong></p>



									<div style="margin: auto;" class="modal-footer">
										<button type="button" id="submit_answer<?php echo $question_num?><?php echo $i?>" class="btn btn-primary">Submit</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

									</div>
									<a style="font-size: 12px;" href="" data-toggle="modal" data-target="#reportModal<?php echo $question_num?><?php echo $i?>" data-dismiss="modal">Report a problem</a>
									<br>

								</div>

							</div>



							<!---------------------- check if the answer is coorect or not and show the result------------------ -->
							<script>
								$(document).ready(function() {

									$("#submit_answer<?php echo $question_num?><?php echo $i?>").click(function() {

										var corect_answer = '<?php echo $corect_answer;?>';
										var selValue = $(".Q<?php echo $question_num?><?php echo $i?>:checked").val();

										if (corect_answer == selValue) {

											$("#result<?php echo $question_num?><?php echo $i?>").text(" Correct!");
											$("#result<?php echo $question_num?><?php echo $i?>").css('color', 'ForestGreen');
											$("#sign<?php echo $question_num?><?php echo $i?>").removeClass("fa fa-times").addClass("fa fa-check");

											$("#sign<?php echo $question_num?><?php echo $i?>").css('color', 'ForestGreen');



										} else {

											$("#result<?php echo $question_num?><?php echo $i?>").text(" Incorrect!");
											$("#result<?php echo $question_num?><?php echo $i?>").css('color', 'red');

											$("#sign<?php echo $question_num?><?php echo $i?>").removeClass("fa fa-check").addClass("fa fa-times ");
											$("#sign<?php echo $question_num?><?php echo $i?>").css('color', 'red');


										}




									});

								});

								ToQuestionBank();

							</script>
						</div>


						<!--Report Modal-->
						<div class="modal fade" id="reportModal<?php echo $question_num?><?php echo $i?>" tabindex="-1" caller-id="" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-body confirm-delete">
										<form id="report_form" method="post">
											Describe shortly the problem in this question:
											<br><br>
											<input style="width: 90%" type="text" name="report_txt<?php echo $question_num?><?php echo $i?>" id="report_txt<?php echo $question_num?><?php echo $i?>">
									</div>
									<div class="modal-footer" style="margin: auto;">



										<input type="submit" id="report<?php echo $question_num?><?php echo $i?>" name="report<?php echo $question_num?><?php echo $i?>" class="btn btn-primary" value="Report">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- If a report is submitted -->
						<?php
		
		if(isset($_POST['report'.$question_num .$i ])){
			 
			$reporterID = $_SESSION["userID"];
			$report_txt = $_POST['report_txt'.$question_num .$i];	
			$sql_r = "INSERT INTO reports (questionID, text, reporterID) VALUES ('$QID','$report_txt',$reporterID)";
			mysqli_query($conn, $sql_r);	
			
				
 

			$sql = "INSERT INTO reminders (	event_type, event_ID, start_time, end_time) VALUE ('QB','$QID','0','0')";
			mysqli_query($conn, $sql);	

			echo "<meta http-equiv='refresh' content='0'>";
			 
		}
		
		
 	
		?>


						<?php
        }
            ?>

					</div>

					<?php } ?>

					<?php
        }
            ?>




				</div>
			</div>
		</div>

		<script>
			function openType() {


				var elems = document.getElementsByClassName('aa');
				for (i = 0; i <= elems.length; i++) {

					elems[i].style.display = "none";
					var zz = document.getElementById("mySelect").value;
					var zz2 = document.getElementById(zz);
					zz2.style.display = "block";

				}



			}

			// Get the element with id="defaultOpen" and click on it
			//document.getElementById("defaultOpen").click();

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
			ToQuestionBank();

		</script>


</body>

</html>
