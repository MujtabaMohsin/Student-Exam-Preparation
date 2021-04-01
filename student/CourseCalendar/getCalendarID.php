<?php
    require_once("db.php");

    if(isset($_POST['course_ID'])){
        $query = "SELECT `calendar_ID` FROM `course_calendars` WHERE `course_ID` = ?";
        $paramID = (int) $_POST['course_ID'];
    }
    elseif(isset($_POST['user_ID'])){
        $query = "SELECT `calendar_ID` from `user_calendars` WHERE `user_ID` = ?";
        $paramID = (int) $_POST['user_ID'];
    }
    else{
        $conn->close();
        exit("Error no user or course ID provided.");
    }
    $calendar_ID;
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $paramID);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows === 0) {
            $stmt->close();
            $conn->close();
            exit('No calendars found');
        }
        if($result->num_rows > 1) {
            $stmt->close();
            $conn->close();
            exit('more than one calendars found');
        }
        $response = array();
        while($row = $result->fetch_assoc()) {
            $calendar_ID = $row['calendar_ID'];
        }
    }
    else{
        echo "Server Error";
    }
    $stmt->close();
?>