<?php session_start(); 
 ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Flash Cards</title>
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
	<link rel="stylesheet" href="favorite/icons/css/all.css" rel="stylesheet">
	<!--load icons -->
</head>

<body>

	<?php 
include_once "../../page/header.php";
include_once "../../page/Left_List.php";
require_once "favorite/functions.php";	
$courseID = $_GET["id"];
$userID = $_SESSION["userID"];
?>


	<!-- This is the main div -->
	<div class="container" style="width:80%">
		<div>

			<ul class="nav nav-tabs " style="width: auto;height: 100%;">
				<li class="nav-item"><a id="allCardsLink" class="nav-link active" href="<?php echo "ViewFlashCards.php?id=$courseID";?>">View All Cards</a></li>
				<li class="nav-item"><a id="addCardLink" class="nav-link " href="<?php  echo "AddFlashCard.php?id=$courseID";?>">Add a Card</a></li>
				<li class="nav-item"><a id="editCardLink" class="nav-link" href="<?php echo "EditFlashCards.php?id=$courseID";?>">Edit My Cards</a></li>
			</ul>

		</div>
		<!-- Main Div for the page -->
		<div id="questions_div" class="w-100">

			<br>
			<h2 style="text-align:center;">View All Flash Cards</h2>
			<br>


			<!------------------------------ Select Topic ---------------------------------------------->
			<div class="float-right">
				<select id="mySelect" onchange="openTopic()" class="custom-select">
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

			<!-- Main tab where the three choices -->
			<div style="width: 22.9%" class="tab_fc">
				<button class="tablinks_fc active" onclick="openType(event, 'Public_cards_')" id="defaultOpen">Public</button>
				<button class="tablinks_fc" onclick="openType(event, 'private_cards_')">Private</button>
				<button class="tablinks_fc" onclick="openType(event, 'favorite_cards_')">Favorite</button>
			</div>

			<br>

			<!------------------------------ Select Topic ---------------------------------------------->

			<?php for ($i = 0; $i <= $num_topics; $i++) { ?>

			<!-- ------------------- tab-1 Public  ------------------- -->

			<div id="Public_cards_<?php echo $topics[$i] ?>" class="aa">
				<br>
				<?php

				$courseID = $_GET["id"];
				$card_num = 0;	

				// fetch data 
				if($i == 0){
					$sql_public = "SELECT * FROM flashcards WHERE courseID = $courseID AND type = '0'";
					$query_public = mysqli_query($conn, $sql_public);
				}
				else{
					$sql_public = "SELECT * FROM flashcards WHERE courseID = $courseID AND type = '0' and topic ='$topics[$i]' ";
					$query_public = mysqli_query($conn, $sql_public);	
					
				}
					

				// fetch rows 
				$publicRows = mysqli_num_rows($query_public);

				// if there are no cards 
				if($publicRows == 0){
												?>
				<div style="text-align:center;">
					<?php
        echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-secondary'>There is no flashcards available now</span><br><br>";
				?>
				</div>
				<?php

				}
 
				// fetch card by card
				while($publicRows = mysqli_fetch_array($query_public)){
				 $card_num=$card_num+1;	
				 // test if the card is favorite
				 $is_favorite = is_favorite($conn, $publicRows['cardID'],$userID);
				?>

				<!-- main div for each card -->
				<div id="question_card_view" class="question_card card col-md-3" data-toggle="modal" data-target="#exampleModal<?php echo $card_num?><?php echo $i?>">
					<div class="card-body">
						<div class="card-header">
							<!-- print the number of the card -->
							<?php echo "<b>Card $card_num</b>"; ?>
						</div>

						<!-- print title of the card -->
						<ul class="list-group list-group-flush">
							<li class="list-group-item"><?php echo $publicRows['title'];?></li>
						</ul>
					</div>
				</div>





				<!-- Modal for each card -->
				<div style="text-align:center;" class="modal fade" id="exampleModal<?php echo $card_num?><?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered " role="document">
						<div style=" width: 1060px;" class="modal-content">
							<div class="modal-header">
								<!-- print title of the card -->
								<h5 class="modal-title" id="exampleModalLabel"><?php echo $publicRows['title'];?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<!-- print content of the card -->
								<h6>
									<label>
										<p><?php echo $publicRows['Content'];?></p>
									</label>
								</h6>

							</div>
							<div style="margin: auto;" class="modal-footer">

								<button id="<?php echo "favorite-" . $publicRows['cardID']; ?>" type="button" class="btn btn-secondary favorite-button" style="<?php if($is_favorite){ echo "color:yellow"; }?>">
									<i class="fas fa-star fa-lg"></i></button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

							</div>
							<a style="font-size: 12px;" href="" data-toggle="modal" data-target="#reportModal<?php echo $card_num?><?php echo $i?>" data-dismiss="modal">Report a problem</a>
							<br>
						</div>
					</div>
				</div>


				<!--Report Modal-->
				<div class="modal fade" id="reportModal<?php echo $card_num?><?php echo $i?>" tabindex="-1" caller-id="" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-body confirm-delete">
								<form id="report_form" method="post">
									Describe shortly the problem in this Quiz:
									<br><br>
									<input style="width: 90%" type="text" name="report_txt<?php echo $card_num?><?php echo $i?>" id="report_txt<?php echo $card_num?><?php echo $i?>">
							</div>
							<div class="modal-footer" style="margin: auto;">



								<input type="submit" id="report<?php echo $card_num?><?php echo $i?>" name="report<?php echo $card_num?><?php echo $i?>" class="btn btn-primary" value="Report">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- If a report is submitted -->
				<?php
		 
		if(isset($_POST['report'.$card_num .$i])){
			$reporterID = $_SESSION["userID"];
			 $carddid = $publicRows['cardID'];
			$report_txt = $_POST['report_txt'.$card_num .$i];	
		 
			$sql_r = "INSERT INTO flashcard_reports (cardID, text, reporterID) VALUES ('$carddid','$report_txt',$reporterID)";
			mysqli_query($conn, $sql_r);	
			
			$sql = "INSERT INTO reminders (	event_type, event_ID, start_time, end_time) VALUE ('FC','$carddid','0','0')";
			mysqli_query($conn, $sql);	

			  echo "<meta http-equiv='refresh' content='0'>";

			}
		
		
 	
		?>

				<?php
        }
            ?>

			</div>



			<!-- ------------------- tab-2 Private  ------------------- -->

			<div id="private_cards_<?php echo $topics[$i] ?>" class="aa">
				<br>
				<?php

				$courseID = $_GET["id"];
				$card_num = 0;	

				// fetch data 
				$sql_private = "SELECT * FROM flashcards WHERE courseID = $courseID AND type = '1' And StudentID='$userID'";
				$query_private = mysqli_query($conn, $sql_private);
														 
				if($i == 0){
					$sql_private = "SELECT * FROM flashcards WHERE courseID = $courseID AND type = '1' And StudentID='$userID'";
					$query_private = mysqli_query($conn, $sql_private);
				}
				else{
					$sql_private = "SELECT * FROM flashcards WHERE courseID = $courseID AND type = '1' And StudentID='$userID' and topic ='$topics[$i]'";
					$query_private = mysqli_query($conn, $sql_private);		 
					
				}										 

				$privateRows = mysqli_num_rows($query_private);

				// if there are no cards 
				if($privateRows == 0){
							?>
				<div style="text-align:center;">
					<?php
        echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-secondary'>There is no flashcards available now</span><br><br>";
				?>
				</div>
				<?php

				}

				// fetch card card
				while($privateRows = mysqli_fetch_array($query_private)){
				 $card_num=$card_num+1;	
				 $cardID = $privateRows['cardID'];	
				  $is_favorite = is_favorite($conn, $privateRows['cardID'],$userID);	
				?>

				<!-- main div for each card -->
				<div id="question_card_view" class="question_card card col-md-3" data-toggle="modal" data-target="#exampleModal2<?php echo $card_num?><?php echo $i?>">
					<div class="card-body">
						<div class="card-header">

							<?php echo "<b>Card $card_num</b>"; ?>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item"><?php echo $privateRows['title'];?></li>
						</ul>
					</div>
				</div>





				<!-- Modal for each card -->
				<div style="text-align:center;" class="modal fade" id="exampleModal2<?php echo $card_num?><?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered " role="document">
						<div style="width: 650px; margin: ;" class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel2"><?php echo $privateRows['title'];?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div style="text-align:center;" class="modal-body">

								<h6>
									<label>
										<p><?php echo $privateRows['Content'];?></p>
									</label>
								</h6>

							</div>
							<div style="margin: auto;" class="modal-footer">
								<button id="<?php echo "favorite-" . $privateRows['cardID']; ?>" type="button" class="btn btn-secondary favorite-button" style="<?php if($is_favorite){ echo "color:yellow"; }?>">
									<i class="fas fa-star fa-lg"></i></button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

							</div>

						</div>
					</div>

				</div>


				<?php
        }
            ?>

			</div>


			<!-- ------------------- tab-3 favorite  ------------------- -->


			<div id="favorite_cards_<?php echo $topics[$i] ?>" class="aa">
				<br>
				<?php

				$courseID = $_GET["id"];
				$card_num = 0;	

				// fetch data 
				if($i == 0){										 
				$sql_favorite = "SELECT * FROM users_favorite WHERE courseID = $courseID AND StudentID='$userID'";
				$query_favorite = mysqli_query($conn, $sql_favorite);
				}
				else{
				$sql_favorite = "SELECT * FROM users_favorite WHERE courseID = $courseID AND StudentID='$userID' ";
				$query_favorite = mysqli_query($conn, $sql_favorite);	
					
				}
				

				$favoriteRows = mysqli_num_rows($query_favorite);
				
				

				// if there are no cards 
				if($favoriteRows == 0){
												?>
				<div style="text-align:center;">
					<?php
        echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-secondary'>There is no flashcards available now</span><br><br>";
				?>
				</div>
				<?php

				}
				


				// fetch card card
				while($favoriteRow = mysqli_fetch_array($query_favorite)){
					
				 $cardID = $favoriteRow['card_id'];	
				 $card_num=$card_num+1;	
				 $cardID = $favoriteRow['card_id'];	
				  $is_favorite = is_favorite($conn, $favoriteRow['card_id'],$userID);	
					
									
				$sql_favorite_t1 = "SELECT * FROM flashcards WHERE cardID = $cardID ";
				$query_favorite_t1 = mysqli_query($conn, $sql_favorite_t1);
					
				$favoriteRow_t1 = mysqli_fetch_array($query_favorite_t1);
				?>

				<!-- main div for each card -->
				<div id="question_card_view" class="question_card card col-md-3" data-toggle="modal" data-target="#exampleModal3<?php echo $card_num?><?php echo $i?>">
					<div class="card-body">
						<div class="card-header">

							<?php echo "<b>Card $card_num</b>"; ?>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item"><?php echo $favoriteRow_t1['title'];?></li>
						</ul>
					</div>
				</div>





				<!-- Modal for each card -->
				<div style="text-align:center;" class="modal fade" id="exampleModal3<?php echo $card_num?><?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered " role="document">
						<div style="width: 650px; margin: ;" class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel2"><?php echo $favoriteRow_t1['title'];?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div style="text-align:center;" class="modal-body">

								<h6>
									<label>
										<p><?php echo $favoriteRow_t1['Content'];?></p>
									</label>
								</h6>

							</div>
							<div style="margin: auto;" class="modal-footer">
								<button id="<?php echo "favorite-" . $favoriteRow_t1['cardID']; ?>" type="button" class="btn btn-secondary favorite-button" style="<?php if($is_favorite){ echo "color:yellow"; }?>">
									<i class="fas fa-star fa-lg"></i></button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

							</div>

						</div>
					</div>

				</div>


				<?php
        }
            ?>

			</div>
			<?php
        }
            ?>

			<script>
				//----------------------------------------------------------------------------------------------------------

				var last_click = "Public_cards_";

				function openType(evt, typeName) {

					var i, tablinks_fc;
					var elems = document.getElementsByClassName('aa');
					for (i = 0; i <= elems.length; i++) {

						elems[i].style.display = "none";
						var topic_sel = document.getElementById("mySelect").value;
						var divv = typeName + topic_sel;

						var zz = document.getElementById(divv);
						zz.style.display = "block";
						tablinks_fc = document.getElementsByClassName("tablinks_fc");
						for (j = 0; j < tablinks_fc.length; j++) {
							tablinks_fc[j].className = tablinks_fc[j].className.replace(" active", "");

						}

						evt.currentTarget.className += " active";
						last_click = typeName;


					}



				}


				function openTopic() {

					var i;
					var elems = document.getElementsByClassName('aa');
					for (i = 0; i <= elems.length; i++) {

						elems[i].style.display = "none";


						var topic_sel = document.getElementById("mySelect").value;
						var divv = last_click + topic_sel;

						var zz = document.getElementById(divv);
						zz.style.display = "block";

					}






				}

				// --------------------------------------------------------------------------------------------


				//				function openType(evt, typeName) {
				//					var i, tabcontent_fc, tablinks_fc;
				//					tabcontent_fc = document.getElementsByClassName("tabcontent_fc");
				//					for (i = 0; i < tabcontent_fc.length; i++) {
				//						tabcontent_fc[i].style.display = "none";
				//					}
				//					tablinks_fc = document.getElementsByClassName("tablinks_fc");
				//					for (i = 0; i < tablinks_fc.length; i++) {
				//						tablinks_fc[i].className = tablinks_fc[i].className.replace(" active", "");
				//					}
				//					document.getElementById(typeName).style.display = "block";
				//					evt.currentTarget.className += " active";
				//				}
				//
				// Get the element with id="defaultOpen" and click on it
				document.getElementById("defaultOpen").click();


				/*******************************************************************************/
				/* Ajax*/

				function favorite() {
					var button = this;
					var id = this.id;
					var xhr = new XMLHttpRequest();
					xhr.open('POST', 'favorite/favorite.php', true);
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
					xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
					xhr.onreadystatechange = function() {
						if (xhr.readyState == 4 && xhr.status == 200) {
							var result = xhr.responseText;
							if (result == 'favorite') {
								button.style.color = "yellow";
							} else if (result == 'unfavorite') {
								button.style.color = "white";
							}
						}
					};
					xhr.send("card_id=" + id + "&student_id=<?php echo $userID ?>&courseID=<?php echo $courseID ?>");
				}
				var buttons = document.getElementsByClassName("favorite-button");
				for (i = 0; i < buttons.length; i++) {
					buttons.item(i).addEventListener("click", favorite);
				}

			</script>







		</div>
	</div>
	</div>
	</div>


	<script>
		ToFlashCards();

	</script>

</body>

</html>
