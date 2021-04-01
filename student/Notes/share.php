<?php
   session_start();
   include "../../connect/connect.php";


    $id = $_GET["id"];
    $courseID;
    $sql = "SELECT * FROM notes WHERE note_ID = $id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $courseID = $row["course_ID"];
        if($row["private"] == 1){
            $sql2 = "UPDATE notes SET private = 0 WHERE note_ID = $id";
            $result2 = mysqli_query($conn, $sql2);

        }
        elseif ($row["private"] == 0){
            $sql2 = "UPDATE notes SET private = 1 WHERE note_ID = $id";
            $result2 = mysqli_query($conn, $sql2);
        }






    }
    header("location:notes.php?id=$courseID");




?>