<?php
include "../../connect/connect.php";
$userID = $_SESSION["userID"];
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-md">
	<a class="navbar-brand" href=" /new_Exam/student/course/Home.php">
		<div class="text-center" id="logo" style="font-size: 40px;">
			<i><img src="../../logo.png"></i>
		</div>
	</a>
	<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="collapsibleNavId">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item">
				<a class="nav-link" href="/new_Exam/student/course/Home.php"><i class="fa fa-home"></i><span>Home</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/new_Exam/student/course/course.php"><i class="fa fa-star"></i><span>My Courses</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/new_Exam/student/Course/MyCalander.php"><i class="fa fa-calendar"></i><span>My Calendar</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/new_Exam/student/notifications/notifications.php"><i class="fa fa-bell"></i><span>Notifications</span><span id="eee"></span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="/new_Exam/student/invitations/invitations.php"><i class="fa fa-envelope"></i><span>Invitations</span></a>
			</li>


			<li class="nav-item">
				<a class="nav-link" href="/new_Exam/student/other/contactUs.php"><i class="fa fa-comments"></i><span>Contact Us</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="/new_Exam/student/other/AboutUs.php"><i class="fa fa-users"></i><span>About Us</span></a>
			</li>



		</ul>
		<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#ss" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-user"></i>MyProfile</a>
				<div id="ss" class="dropdown-menu dropdown-menu-right">

					<a class="dropdown-item" href="/new_Exam/student/other/myprofile.php"> My Profile</a>
					<a class="dropdown-item" href="../../index.php">Log out</a>


				</div>
			</li>
		</ul>

	</div>
</nav>


<?php 

	//------------------------------------ This is for Notifications --------------------------------------------------------

	// check if the user wants to get reminders

	$sql = "SELECT receive_type, time_before FROM notificationsettings WHERE userID=$userID ";
	$query = mysqli_query($conn, $sql);
	$rows = mysqli_fetch_array($query);
	$number_of_rows = mysqli_num_rows($query);
	$noteForThisUser = 0; 
	if($number_of_rows > 0){
		
		$receive_type = $rows['receive_type'];
		$time_before = $rows['time_before'];
	}

	else{
		$receive_type = 0;
		$time_before = 24;
	}


if(($number_of_rows>0 && $receive_type==0) || $number_of_rows==0) {
	

	//--------Get time Now and yesterday-------------
	date_default_timezone_set('Asia/Riyadh');
	$dateNow = date('Y-m-d H:i:s', time());
	if($time_before == 24){
		$dateBefore = date("Y-m-d H:i:s", time() - 60 * 60 * 24);
	}
	elseif ($time_before == 48){
		$dateBefore = date("Y-m-d H:i:s", time() - 60 * 60 * 48);
	}
	
	elseif ($time_before == 1){
		$dateBefore = date("Y-m-d H:i:s", time() - 60 * 60 * 1);
	}
	
	
	
	

	//-----------Get event IDs-----------------------
	$sql = "SELECT event_id , event_type FROM reminders WHERE '$dateNow'  between '$dateBefore' and start_time  AND end_time > '$dateNow'   ";
	$query = mysqli_query($conn, $sql);
	$EventsIDs = [];
	$EventsType = [];
	$number_of_rows = mysqli_num_rows($query);
	

	if($number_of_rows>0){

		
	$i = 0;
	while($rows = mysqli_fetch_array($query)){
			$EventsIDs[$i] = $rows['event_id'];
			$EventsType[$i] = $rows['event_type']; 
			$i=$i+1;
		}


	//-------------Get title and desc----------------
		
	$eventTitle = [];
	$eventDesc = [];
	$c_id = [];
	$c_name = [];	
	$new_EventIDs = [];
	$notification = array(array());
	
		
	for ($i = 0; $i < $number_of_rows; $i++) {
		
		if($EventsType[$i] == 'course_events'){
			
			$sql = "SELECT * FROM course_events WHERE event_ID = $EventsIDs[$i]";
			$query = mysqli_query($conn, $sql);
			$rows = mysqli_fetch_array($query);
			$eventTitle[$i] = $rows['title'];
			$eventDesc[$i] = $rows['description'];
			$calnder_id = $rows['calendar_ID'];


			//Get Course ID
			$sql = "SELECT course_ID FROM course_calendars WHERE calendar_ID = $calnder_id";
			$query = mysqli_query($conn, $sql);
			$rows = mysqli_fetch_array($query);
			$c_id[$i] = $rows['course_ID'];

			//Get Course Name 
			$sql = "SELECT Course_Code,course_ID FROM courses WHERE Course_ID = $c_id[$i]";
			$query = mysqli_query($conn, $sql);
			$rows = mysqli_fetch_array($query);
			$c_name[$i] = $rows['Course_Code'];



			//Get the course's users
			$sql = "SELECT User_ID FROM user_courses WHERE Course_ID = $c_id[$i] and User_ID = $userID  ";
			$query = mysqli_query($conn, $sql);
			$number_of_users = mysqli_num_rows($query);

			if($number_of_users == 1){
				$noteForThisUser++;
				$notification[$i][0]= $eventTitle[$i];
				$notification[$i][1]= $c_name[$i];
				$notification[$i][2]= $eventDesc[$i];
				$new_EventIDs[$i] = $EventsIDs[$i];
			 
			}
			
			
			
		}
		
		else if($EventsType[$i] == 'user_events'){
		
		$sql = "SELECT * FROM user_events WHERE event_ID = $EventsIDs[$i]";
		$query = mysqli_query($conn, $sql);
		$rows = mysqli_fetch_array($query);
		$eventTitle[$i] = $rows['title'];
		$eventDesc[$i] = $rows['description'];
		$calnder_id = $rows['calendar_ID'];
		

		//Get Course ID
		$sql = "SELECT user_ID FROM user_calendars WHERE calendar_ID = $calnder_id and user_ID = $userID";
		$query = mysqli_query($conn, $sql);
		$rows = mysqli_fetch_array($query);
		$number_of_users = mysqli_num_rows($query); 
 
		 
		if($number_of_users == 1){
 			$noteForThisUser++;
			$notification[$i][0]= $eventTitle[$i];
			$notification[$i][1]= "";
			$notification[$i][2]= $eventDesc[$i];
			$new_EventIDs[$i] = $EventsIDs[$i];
			 
				}
			
			}

		}

	}
}

	// ----------------------------------Reports---------------------------------

	$reportsForThisUser = 0;

	$sql = "SELECT event_id , event_type FROM reminders WHERE event_type = 'QB' OR event_type = 'QZ' OR event_type = 'FC' ";
	$query = mysqli_query($conn, $sql);
	$reportIDs = [];
	$reportTypes = [];
	$reportTitles = [];
	$reportCourses = [];
	$reportProblems = [];
	$notification2 = array(array());
	$number_of_rows2 = mysqli_num_rows($query);

	if($number_of_rows2>0){
			$i = 0;
			while($rows = mysqli_fetch_array($query)){
				$reportIDs[$i] = $rows['event_id'];
				$reportTypes[$i] = $rows['event_type']; 
				$i=$i+1;
		}
		
	for ($i = 0; $i < $number_of_rows2; $i++) {
		
			if($reportTypes[$i] == "QB"){
				$sql = "SELECT * FROM questions WHERE questionID = $reportIDs[$i] and studentID=$userID";
    			$query = mysqli_query($conn, $sql);
				$rows = mysqli_fetch_array($query);
				
				$number_of_rows3 = mysqli_num_rows($query);
				if($number_of_rows3 == 1){
					 
					$reportTitles[$i] = $rows['title'];
					 
					
					$sql = "SELECT text FROM reports WHERE questionID = $reportIDs[$i]";
    				$query = mysqli_query($conn, $sql);
					$rows2 = mysqli_fetch_array($query);
					$reportProblems[$i] = $rows2['text'];
					
					$notification2[$i][0] = $reportTitles[$i];
					$notification2[$i][1] = $reportProblems[$i];
					
					$reportsForThisUser++;
					
					
				}
			}
 
		
			elseif($reportTypes[$i] == "FC"){
				
				$sql = "SELECT * FROM flashcards WHERE cardID = $reportIDs[$i] and studentID=$userID";
    			$query = mysqli_query($conn, $sql);
				$rows = mysqli_fetch_array($query);
				
				$number_of_rows3 = mysqli_num_rows($query);
				if($number_of_rows3 == 1){
					 
					$reportTitles[$i] = $rows['title'];
					 
					
					$sql = "SELECT text FROM flashcard_reports WHERE cardID = $reportIDs[$i]";
    				$query = mysqli_query($conn, $sql);
					$rows2 = mysqli_fetch_array($query);
					$reportProblems[$i] = $rows2['text'];
					
					$notification2[$i][0] = $reportTitles[$i];
					$notification2[$i][1] = $reportProblems[$i];
					
					$reportsForThisUser++;
					
					
				}
				
			}
		
		
		
		}
		
		
	}
	
	$total = $noteForThisUser+$reportsForThisUser;
 

?>

<script>
	<?php if($total>0 ){ ?>
	document.getElementById('eee').id = "badge";
	document.getElementById('badge').innerHTML = <?php echo $total  ?>;
	<?php } ?>

</script>
