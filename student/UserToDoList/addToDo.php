<?php
    session_start();
    require_once('./db.php');

    if(isset($_POST['user_ID'])) {

        if(isset($_POST['content']) && isset($_POST['date']) && isset($_POST['time'])) {
            // escape strings(avoid DB injection) and store in variables
            $user_ID = $conn->real_escape_string($_POST['user_ID']);
            $content = $conn->real_escape_string($_POST['content']);
            $date = $conn->real_escape_string($_POST['date']);
            $time = $conn->real_escape_string($_POST['time']);
            $dateTime = $date. " " .$time;
            
            $query = "INSERT INTO `user_todo` (`user_ID`, `content`, `dateTime`) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iss", $user_ID, $content, $dateTime);
            if($stmt->execute()) {
                $todo_ID = $stmt->insert_id;
                $newToDo = array(
                    'todo_ID' => $todo_ID,
                    'content' => $content,
                    'date' => $date,
                    'time'=> $time,
                );
                $stmt->close();
                $conn->close();
                exit(json_encode(array(
                    'status' => true,
                    'message' => "ToDo added successfully",
                    'newToDo' => $newToDo,
                )));
            }
            else {
                $stmt->close();
                $conn->close();
                exit(json_encode(array(
                    'status' => false,
                    'message' => "unable to add ToDo",
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