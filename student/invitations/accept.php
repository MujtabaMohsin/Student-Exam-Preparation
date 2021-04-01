<?php
    session_start();
    include "../../connect/connect.php";

    $ID = $_GET["id"];
    $courseID;
    $sql = "SELECT * FROM invitations WHERE invite_ID = $ID";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0 ){
        $row = mysqli_fetch_array($result);
        $courseID = $row["Course_ID"];
        $addSQL = "INSERT INTO user_courses(Course_ID, User_ID) VALUES ($row[Course_ID], $row[Invitee_ID])";
        $result2 = mysqli_query($conn, $addSQL);

    $updateStsSQL = "UPDATE invitations SET 
    status_ID = 22
    WHERE invite_ID = $ID";
    $result0 = mysqli_query($conn,$updateStsSQL);
    }
    header("location:../course/Course-Homepage.php?id=$courseID");



?>