<?php
    session_start();
    include "../../connect/connect.php";

    $userID = $_SESSION["userID"];
    $courseID = $_GET["id"];
    $title = $_POST["title"];
    $question = $_POST["question"];

    $sql = "INSERT INTO discussions(Question_title, Question, course_ID, user_ID) VALUES ('$title', \"$question\", $courseID, $userID)";
    $result = mysqli_query($conn, $sql);

    echo '<script>

    window.history.back();
  
  </script>';
   


?>
