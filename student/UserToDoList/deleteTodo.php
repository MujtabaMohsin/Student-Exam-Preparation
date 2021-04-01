<?php
    session_start();
    require_once('./db.php');

    if(isset($_POST['todo_ID'])) {
        $todo_ID = (int) $conn->real_escape_string($_POST['todo_ID']);

        $query = "DELETE FROM `user_todo` WHERE `todo_ID` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $todo_ID);
        if($stmt->execute()) {
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => true,
                'message' => "ToDo deleted successfully",
            )));
        }
        else {
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => false,
                'message' => "Failed to delete ToDo",
            )));
        }
    }
    else {
        $conn->close();
        exit(json_encode(array(
            'status' => false,
            'message' => "no todo ID was provided",
        )));
    }
?>