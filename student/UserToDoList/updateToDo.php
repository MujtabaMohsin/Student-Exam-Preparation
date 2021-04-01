<?php
    session_start();
    require_once('./db.php');

    if(isset($_POST['user_ID'])) {

        if(isset($_POST['todo_ID']) && isset($_POST['content']) && isset($_POST['date']) && isset($_POST['time'])) {
            // escape strings(avoid DB injection) and store in variables
            $todo_ID = $conn->real_escape_string($_POST['todo_ID']);
            $content = $conn->real_escape_string($_POST['content']);
            $date = $conn->real_escape_string($_POST['date']);
            $time = $conn->real_escape_string($_POST['time']);
            $dateTime = $date. " " .$time;

            $query = "UPDATE `user_todo` SET `content` = ?, `dateTime` = ? WHERE `todo_ID` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssi", $content, $dateTime, $todo_ID);
            if($stmt->execute()) {
                $stmt->close();
                $conn->close();
                exit(json_encode(array(
                    'status' => true,
                    'message' => "ToDo updated successfully",
                )));
            }
            else {
                $stmt->close();
                $conn->close();
                exit(json_encode(array(
                    'status' => false,
                    'message' => "ToDo failed to updated",
                )));
            }
            
        }
        else {
            $conn->close();
            exit(json_encode(array(
                'status' => false,
                'message' => "a parameter is missing",
            )));
        }
    }
    else {
        $conn->close();
        exit(json_encode(array(
            'status' => false,
            'message' => "no user ID was provided",
        )));
    }
?>