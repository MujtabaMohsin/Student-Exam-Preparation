<?php
    require_once('./db.php');
    $query = "SELECT * FROM `course_todo` WHERE `course_ID` = ? ORDER BY `complete` ASC";
    $stmt = $conn->prepare($query);
    $course_ID = $_POST['course_ID'];
    $stmt->bind_param("i", $course_ID);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if($result->num_rows >= 0) {
            $response = array();
            while($row = $result->fetch_assoc()) {
                $response[] = array(
                    'Todo_ID' => $row['todo_ID'],
                    'content' => $row['content'],
                    'done' => $row['complete'],
                    'dateTime' => $row['dateTime'],
                );
            }
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => true,
                'results' => $response,
            )));
        }
        else{
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => false,
                'message' => "Unable to find any Todos",
            )));
        }
        
    }
    else{
        $stmt->close();
        $conn->close();
        exit(json_encode(array(
            'status' => false,
            'message' => "Server Error",
        )));
    }
?>