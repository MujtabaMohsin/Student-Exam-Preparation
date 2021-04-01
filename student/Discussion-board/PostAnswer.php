<?php
    session_start();
    include "../../connect/connect.php";

    $userID = $_SESSION["userID"];
    $discussionID = $_GET["id"];
    $answer = $_POST["answer"];
    $ansCount;

    $sql = "INSERT INTO discussions_answers(answer, discussion_ID , user_ID) VALUES (\"$answer\", $discussionID, $userID)";
    $result = mysqli_query($conn, $sql);

    $sqlAnsNo = "SELECT No_of_ans FROM discussions WHERE discussion_ID = $discussionID";
    $result = mysqli_query($conn, $sqlAnsNo);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $ansCount = $row["No_of_ans"] + 1;
    }

    $sqlUpdate = "UPDATE discussions SET No_of_ans = $ansCount WHERE discussion_ID = $discussionID";
    $result = mysqli_query($conn,$sqlUpdate);

    echo '<script>

  window.history.back();

</script>';
?>
