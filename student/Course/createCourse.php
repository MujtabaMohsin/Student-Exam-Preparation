<?php
    session_start();
    include "../../connect/connect.php";


    $code = $_POST['code'];
    $desc = $_POST['desc'];
    $name = $_POST["cName"];
    $ID;
    $userID = $_SESSION["userID"];
    $createCourseSQL = "INSERT INTO courses(Course_Code, course_name,Description) VALUES ('$code', '$name','$desc')";
    $result = mysqli_query($conn,$createCourseSQL);
    
    $getCourseIDSQL = "SELECT Course_ID FROM courses ORDER BY Course_ID DESC LIMIT 1 ";
    $result = mysqli_query($conn, $getCourseIDSQL);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $ID = $row['Course_ID'];
    }

    $addUserToCourseSQL = "INSERT INTO user_courses(Course_ID, User_ID) VALUES($ID ,$userID)";
    $result = mysqli_query($conn,$addUserToCourseSQL);
    
    // Create a calendar for the new course
    $createCourseCalendarSQL = "INSERT INTO `course_calendars` (`course_ID`, `title`) VALUES ($ID, 'Main calendar')";
    $result = mysqli_query($conn,$createCourseCalendarSQL);


    header("location:Course-Homepage.php?id=$ID");

    $conn ->close();
?>
