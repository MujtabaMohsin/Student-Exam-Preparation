 <?php
include "../../connect/connect.php";

$event_id = $_GET["id"];
$number = $_GET["num"];
echo $event_id;
for ($i = 0; $i < $number; $i++) {  
	if($_POST['action'] == 'call_this'.$i) {
	$sql_d_n = "DELETE FROM reminders WHERE event_id='$event_id'";
	mysqli_query($conn, $sql_d_n);
	}
	
}

?>
