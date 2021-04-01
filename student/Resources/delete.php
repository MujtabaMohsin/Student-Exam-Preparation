<?php
session_start();
include "../../connect/connect.php";

$val = $_GET['id'];
$sql = "DELETE FROM resources where resource_ID = $val";
if (mysqli_query($conn, $sql)) {
    echo '<script>

  window.history.back();

</script>';
}
    
?>