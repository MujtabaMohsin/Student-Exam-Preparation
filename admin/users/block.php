<?php
   session_start();
   include "../../connect/connect.php";


    $id = $_GET["id"];
    $courseID;
    $sql = "SELECT * FROM users WHERE User_ID = $id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        
        if($row["status"] == 1){
            $sql2 = "UPDATE users SET status = 0 WHERE User_ID = $id";
            $result2 = mysqli_query($conn, $sql2);

        }
        elseif ($row["status"] == 0){
            $sql2 = "UPDATE users SET status = 1 WHERE User_ID = $id";
            $result2 = mysqli_query($conn, $sql2);
        }






    }
    header("location:students.php");




?>
