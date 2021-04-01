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
				<a class="nav-link" href="/new_Exam/admin/home/dashboard.php"><i class="fa fa-home"></i><span>Home</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/new_Exam/admin/courses/courses.php"><i class="fa fa-star"></i><span> Courses</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="/new_Exam/admin/users/students.php"><i class="fa fa-users"></i><span> Users</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/new_Exam/admin/notifications/notifications.php"><i class="fa fa-bell"></i><span>Notifications</span><span id="eee"></span></a>
			</li>




		</ul>
		<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-user"></i>MyProfile</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
					<a class="dropdown-item" href="/new_Exam/logout.php">
						<i class="icon-logout"></i>
						<span>Logout</span>
					</a>
				</div>
			</li>
		</ul>

	</div>
</nav>


<?php 

	//------------------------------------ This is for Notifications --------------------------------------------------------

 

 
	// ----------------------------------Admin Reports---------------------------------

	$reportsForThisUser = 0;

	$sql = "SELECT event_id , event_type , msg FROM reminders WHERE event_type = 'QB'  OR event_type = 'FC' OR event_type = 'CU' ";
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
				$contactUs[$i] = $rows['msg'];
				$i=$i+1;
		}
		
 
		
	for ($i = 0; $i < $number_of_rows2; $i++) {
		
			if($reportTypes[$i] == "QB"){
				$sql = "SELECT * FROM questions WHERE questionID = $reportIDs[$i]";
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
				 
				$sql = "SELECT * FROM flashcards WHERE cardID = $reportIDs[$i] ";
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
		
			elseif($reportTypes[$i] == "CU"){
				
				$sql4 = "SELECT User_name FROM users WHERE User_ID = '$reportIDs[$i]' ";
    			$query4 = mysqli_query($conn, $sql4);
				$rows4 = mysqli_fetch_array($query4);
				
				$number_of_rows4 = mysqli_num_rows($query4);
				if($number_of_rows4 == 1){
					 
					$reportTitles[$i] = $rows4['User_name'];
					$reportProblems[$i] = "";
			 
					
					$notification2[$i][0] = $reportTitles[$i];
					$notification2[$i][1] = $contactUs[$i];
					
					$reportsForThisUser++;
					
					
				}
				
			}
		
		
		
		}
		
		
	}
	
	$total = $reportsForThisUser;

 
	 
 
 

?>

<script>
	<?php if($total>0 ){ ?>
	document.getElementById('eee').id = "badge";
	document.getElementById('badge').innerHTML = <?php echo $total  ?>;
	<?php } ?>

</script>
