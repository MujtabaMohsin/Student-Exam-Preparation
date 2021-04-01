<?php
    require_once('./db.php');
    if(isset($_POST['Todo_ID'])){
        $query = "DELETE FROM `course_todo` WHERE `todo_ID` = ?";
        $stmt = $conn->prepare($query);
        $Todo_ID = (int) $_POST['Todo_ID'];
        $stmt->bind_param("i", $Todo_ID);
        
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            exit(json_encode(
                array(
                    'status' => true,
                    'message' => "Todo $Todo_ID was Deleted successfully",
                )
            ));
        }
        else{
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => false,
                'message' => "Unable to Delete Todo $Todo_ID",
            )));
        }
    }
    else{
        $conn->close();
        exit(json_encode(array(
            'status' => false,
            'message' => "No Todo ID was given",
        )));
    }
?>