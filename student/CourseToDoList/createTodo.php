<?php
    require_once('./db.php');
    if(isset($_POST['newTodo'])){
        $query = "INSERT INTO `course_todo` (`course_ID`, `content`) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $course_ID = $_POST['course_ID'];
        $newTodo = $_POST['newTodo'];
        $stmt->bind_param("is", $course_ID, $newTodo);
        
        if ($stmt->execute()) {
            $insert_ID = $stmt->insert_id;
            $stmt->close();
            $conn->close();
            echo json_encode(
                array(
                    'status' => true,
                    'Todo_ID' => $insert_ID,
                    'content' => $newTodo,
                    'message' => "Todo created successfully",
                )
            );
        }
        else{
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => false,
                'message' => "Unable to create Todo",
            )));
        }
    }
    else{
        $conn->close();
        exit(json_encode(array(
            'status' => false,
            'message' => "No course Id or new Todo was given",
        )));
    }
?>