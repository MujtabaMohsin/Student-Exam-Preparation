<?php
    
    include "../../connect/connect.php";
    $dName = $_POST["dName"];
    $ID;
    if(isset($_POST["department"])){
        $code = $_POST["dCode"];

        $sql = "INSERT INTO department(department_Name, department_code) VALUES ('$dName', '$code')";
        $result = mysqli_query($conn, $sql);
        header("location:departments.php");
    }
    elseif(isset($_POST["course"])){
        $name = $_POST["cName"];
        $code = $_POST["Code"];
       
        $sql = "INSERT INTO courses_code(Course_Code, Course_Name, Department_ID) VALUES ('$code', '$name', $dName)";
        $result = mysqli_query($conn, $sql);

        $course_name = $code.' Main Course';
        $desc = "This is ".$code." Main Course";
        $sql = "INSERT INTO courses(course_name, Course_Code, Description) VALUES ('$course_name', '$code', '$desc')";
        $result = mysqli_query($conn, $sql);

        $getCourseIDSQL = "SELECT Course_ID FROM courses ORDER BY Course_ID DESC LIMIT 1 ";
        $result = mysqli_query($conn, $getCourseIDSQL);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $ID = $row['Course_ID'];
        }

        $createCourseCalendarSQL = "INSERT INTO `course_calendars` (`course_ID`, `title`) VALUES ($ID, 'Main calendar')";
        $result = mysqli_query($conn,$createCourseCalendarSQL);





        header("location:courses.php");


    }

?>
