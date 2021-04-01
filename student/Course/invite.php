<?php
    session_start();
    include "../../connect/connect.php";

    $invitee = $_POST["email"];
    $inviterID = $_SESSION["userID"];
    $inviteeID;
    $courseID = $_GET["id"];

    $inviteeIDSQL = "SELECT User_ID FROM users where User_email = '$invitee'";
    $result = mysqli_query($conn, $inviteeIDSQL);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $inviteeID = $row["User_ID"];
        
        $inviteSQL = "INSERT INTO invitations(inviter_ID, Invitee_ID, Course_ID, status_ID) VALUES ($inviterID, $inviteeID, $courseID,21)";
        $result = mysqli_query($conn, $inviteSQL);
    } 

    

    header("location:Course-Homepage.php?id=$courseID");





?>
