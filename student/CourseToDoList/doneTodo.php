<?php
    require_once('./db.php');
    if(isset($_POST['Todo_ID'])&&isset($_POST['done'])){
        $query = "UPDATE `course_todo` SET `complete` = ? WHERE `todo_ID` = ?";
        $stmt = $conn->prepare($query);
        $Todo_ID = (int) $_POST['Todo_ID'];
        $done = filter_var($_POST['done'], FILTER_VALIDATE_BOOLEAN);
        $stmt->bind_param("ii", $done, $Todo_ID);
        
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            exit(json_encode(
                array(
                    'status' => true,
                    'message' => "Todo $Todo_ID done status was changed successfully",
                )
            ));
        }
        else{
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => false,
                'message' => "Unable to change Todo $Todo_ID done status.",
            )));
        }
    }
    else{
        $conn->close();
        exit(json_encode(array(
            'status' => false,
            'message' => "No Todo ID or done status was given",
        )));
    }
?>