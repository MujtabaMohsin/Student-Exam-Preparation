<?php
    require_once("db.php");
    
    // testing line (append POST data in a file)
    // $string = print_r($_POST, true);
    // file_put_contents('deleteEventData.txt', $string, FILE_APPEND);
    if(isset($_POST['eventID'])) {
        $query = "DELETE FROM `course_events` WHERE `event_ID` = ?";
        $stmt = $conn->prepare($query);
        $eventID = (int) $_POST['eventID'];
        $stmt->bind_param("i", $eventID);

        if ($stmt->execute()) {
            // Delete the events reminder if it exists
            $query = "DELETE FROM `reminders` WHERE (`event_type` = 'course_events' AND `event_ID` = ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $eventID);
            $stmt->execute();// handle insertion errors later (TM)

            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => true,
                'message' => "Event deleted successfully"
            )));
        }
        else{
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => false,
                'message' => "Unable to delete event"
            )));
        }
    }
    else {
        $conn->close();
        exit(json_encode(array(
            'status' => false,
            'message' => "No event ID was given"
        )));
    }
?>