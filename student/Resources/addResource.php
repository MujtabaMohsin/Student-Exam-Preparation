<?php
    session_start();
    include "../../connect/connect.php";

    $userID = $_SESSION["userID"];
    $courseID = $_GET["id"];
    $title = $_POST["title"];
    $type = $_POST["type"];
    $from =  $_POST["from"];
    $chapter = $_POST["chapter"];


    $private = $_POST["addType"];
    if($private == "public") $private = 0;    else $private = 1;

    if($from == "link"){
        $link = $_POST["Link"];

        $sql = "INSERT INTO resources(resource_title, type, private, Chapter, Link, From_Link, user_ID, course_ID) VALUES('$title', '$type', $private, $chapter, '$link', 1, $userID, $courseID)";
        $result = mysqli_query($conn, $sql);
      
    }

    else{
        $filename = basename($_FILES["img"]["name"]);
        $img = $_FILES['img']['tmp_name']; 
        $file_size = $_FILES['img']['size'];
        $file_type = $_FILES['img']['type'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $cont=base64_encode(file_get_contents(addslashes($img)));
        $sql = "INSERT INTO resources(resource_title, type, private, Chapter ,Data, name, From_Link, user_ID, course_ID) VALUES('$title', '$type', $private, $chapter, '$cont', '$filename',0, $userID, $courseID)";
        $result = mysqli_query($conn, $sql);    


    }



    header("location:resources.php?id=$courseID");

    ?>