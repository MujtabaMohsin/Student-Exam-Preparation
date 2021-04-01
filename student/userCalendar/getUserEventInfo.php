<?php
    require_once('./db.php');

    if(isset($_POST['event_ID'])) {
        $query = "SELECT * FROM `user_events` WHERE `event_ID` = ?";
        $stmt = $conn->prepare($query);
        $event_ID = (int) $conn->real_escape_string($_POST['event_ID']);
        $stmt->bind_param("i", $event_ID);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if($result->num_rows == 1) {
                $response = array();
                while($row = $result->fetch_assoc()){
                    $response = array(
                        'event_ID' => $row['event_ID'],
                        'calendar_ID' => $row['calendar_ID'],
                        'title' => $row['title'],
                        'description' => $row['description'],
                        'start' => $row['start'],
                        'end' => $row['end'],
                        'allDay' => $row['allDay'],
                    );
                }
                $stmt->close();
                $conn->close();
                exit(json_encode(array(
                    'status' => true,
                    'data' => $response,
                )));
            }
            else if($result->num_rows == 0) {
                $stmt->close();
                $conn->close();
                exit(json_encode(array(
                    'status' => false,
                    'message' => 'Event not found',
                )));
            }
            else {
                $stmt->close();
                $conn->close();
                exit(json_encode(array(
                    'status' => false,
                    'message' => 'Event not found +',
                )));
            }
        }
        else {
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => false,
                'message' => 'Unable to get event',
            )));
        }

    }
    else {
        $conn->close();
        exit(json_encode(array(
            'status' => false,
            'message' => 'No event ID was given',
        )));
    }
?>