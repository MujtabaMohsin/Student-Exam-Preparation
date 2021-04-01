<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Craete course</title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">
	<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
	<link rel="stylesheet" href="assets/fonts/ionicons.min.css">
	<link rel="stylesheet" href="assets/fonts/material-icons.min.css">
	<link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
	<link rel="stylesheet" href="assets/css/-Login-form-Page-BS4-.css">
	<link rel="stylesheet" href="assets/css/styles.css">

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


?>

	<div class="content">
		<br>
		<h1 style="text-align:center;">INVITATIONS</h1>
		<div class="container parent">


			<?php 
                include "../../connect/connect.php";
   

            $ID = $_SESSION["userID"];
            $user;
            $course;
            $sql = "SELECT * FROM invitations WHERE Invitee_ID = $ID AND status_ID = 21";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                   

                    echo '<div class="d-flex flex-row child2" style="background-color: #a6e8dc;">';
                    
                    $courseSQL = "SELECT * FROM courses WHERE Course_ID = $row[Course_ID]";
                    $result1 = mysqli_query($conn, $courseSQL);
                    if(mysqli_num_rows($result1) > 0){
                        $row1 = mysqli_fetch_array($result1);
                        echo '<div class="col-5 d-flex justify-content-center align-items-center" style="margin-right: 0px;"><span>'.$row1["Course_Code"].'</span></div>';
                 
                    }

                    $userSQL = "SELECT * FROM users WHERE User_ID = $row[inviter_ID]";
                    $result2 = mysqli_query($conn, $userSQL);
                    if(mysqli_num_rows($result2) > 0){
                        $row2 = mysqli_fetch_array($result2);
                        echo ' <div class="col-5 d-flex flex-row justify-content-center align-items-center"><span>'.$row2["User_name"].' -  '.$row2["User_email"].'&nbsp;</span></div>';
                    }

                 
                    
                  echo'<div class="col d-flex flex-row justify-content-around align-items-center">
                    <button class="btn btn-primary bg-success actBtn" type="button" onclick="window.location=\'accept.php?id='.$row["invite_ID"].'\'"><i class="fa fa-check"></i></button>
                    <button class="btn btn-primary bg-danger actBtn" type="button" onclick="window.location=\'reject.php?id='.$row["invite_ID"].'\'"><i class="fa fa-remove"></i></button>
                  </div>
              </div>';
                    


                }
            }
            

            ?>
		</div>
	</div>
	</div>
	</div>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/sc.js"></script>

	<script>
		$(document).ready(function() {

			var active = document.getElementsByClassName("active");
			console.log(active[0]);

			active[0].classList.remove("active");

			var target = document.getElementById("invitations");
			target.classList.add("active");

		});

	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
