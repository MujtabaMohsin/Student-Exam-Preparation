<?php
    session_start();
    require_once("connect/connect.php");
    // Clear message variable
    if(isset($_SESSION['signUpMessage'])){unset($_SESSION['signUpMessage']);}

    if(isset($_POST['signUpName'])&&isset($_POST['signUpEmail'])&&isset($_POST['signUpPassword'])){
        // store values in variables
        $name = $_POST['signUpName'];
        $email = $_POST['signUpEmail'];
        $pwd = $_POST['signUpPassword'];
        $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);// create password hash
        
        // check if email is taken
        $query = "SELECT `User_email` FROM `users` WHERE `User_email` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if($result->num_rows != 0){
                $stmt->close();
                $conn->close();
                $_SESSION['signUpMessage'] = "email already taken";
                header("location:index.php");
            }
        }
        else{
            $stmt->close();
            $conn->close();
            $_SESSION['signUpMessage'] = "Server Error";
            header("location:index.php");
        }

        // create new user
        $query = "INSERT INTO `users` (`User_name`, `User_email`, `password`, `hash`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $name, $email, $pwd, $pwd_hash);
        if ($stmt->execute()) {
            // create user calendar
            $user_ID = $stmt->insert_id;
            $calendar_title = $name."'s Calendar";
            $calendar_desc = '';
            $query = "INSERT INTO `user_calendars` (`user_ID`, `title`, `description`) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iss", $user_ID, $calendar_title, $calendar_desc);
            $stmt->execute();
            // send to home page
            $_SESSION['userID'] = $user_ID;
            header("location:student/Course/Course.php");
        }
        else{
            $stmt->close();
            $conn->close();
            $_SESSION['signUpMessage'] = "Server Error";
            header("location:index.php");
        }
    }
    else{
        $conn->close();
        $_SESSION['signUpMessage'] = "missing input fields";
        header("location:index.php");
    }
    // $conn
?>