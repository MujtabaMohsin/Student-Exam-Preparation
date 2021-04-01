<?php
    session_start();
    include "../../connect/connect.php";


    $userID = $_SESSION["userID"];
    $courseID = $_GET["id"];
    $type = $_POST["addType"];
    $chapter = $_POST["chapter"];
    $section = $_POST["section"];

    $filename = basename($_FILES["note"]["name"]);
    $note = $_FILES['note']['tmp_name']; 
    $file_size = $_FILES['note']['size'];
    $file_type = $_FILES['note']['type'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    $cont=base64_encode(file_get_contents(addslashes($note)));

  

    if($type == "public") $type = 0;    else $type = 1;

    $sql = "INSERT INTO notes(chapter, section, private, user_ID, course_ID, note_name, type, size, data, category) VALUES 
    ($chapter, $section, $type, $userID, $courseID,'$filename', '$file_type', $file_size, '$cont', 2) ";
    $result = mysqli_query($conn, $sql);


    if(!$result)
        echo "Error: ". $sql ."
        ". $conn->error;
       

        header("location:summary.php?id=$courseID");




?>