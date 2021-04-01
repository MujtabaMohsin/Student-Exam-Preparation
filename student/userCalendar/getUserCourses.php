<?php
    require_once("db.php");
    if(isset($_POST['user_ID'])){
        $query = "SELECT `Course_ID`, `course_name`, `Description` FROM `courses` WHERE `Course_ID` IN (SELECT `Course_ID` FROM `user_courses` WHERE `User_ID` = ? ORDER BY `Course_ID` ASC)";
        $stmt = $conn->prepare($query);
        $user_ID = $_POST['user_ID'];
        $stmt->bind_param("i", $user_ID);

        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows >= 0) {
                $response = array();
                while($row = $result->fetch_assoc()){
                    $response[] = array(
                        'ID' => $row['Course_ID'],
                        'description' => $row['Description'],
                    );
                }
                $stmt->close();
                $conn->close();
                exit(json_encode(array(
                    'status' => true,
                    'courses' => $response,
                )));
            }
            else{
                $stmt->close();
                $conn->close();
                exit(json_encode(array(
                    'status' => false,
                    'message' => 'unable to get user courses._'
                )));
            }
        }
        else{
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => false,
                'message' => 'unable to get user courses.'
            )));
        }
    }
    else{
        $conn->close();
        exit(json_encode(array(
            'status' => false,
            'message' => 'Error no user ID provided.'
        )));
    }
?>