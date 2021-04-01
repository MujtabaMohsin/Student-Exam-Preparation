<?php
    session_start();
    include "../../connect/connect.php";

    $ID = $_GET["id"];

    $sql = "SELECT * FROM invitations WHERE invite_ID = $ID";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0 ){
        $row = mysqli_fetch_array($result);
    

    $updateStsSQL = "UPDATE invitations SET 
    status_ID = 23
    WHERE invite_ID = $ID";
    $result0 = mysqli_query($conn,$updateStsSQL);
    }
    header("location:invitations.php");


?>