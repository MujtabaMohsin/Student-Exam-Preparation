<?php
    require_once("getCalendarID.php");
    require_once("db.php");

    // testing line (append POST data in a file)
    // $string = print_r($_POST, true);
    // file_put_contents('createEventData.txt', $string, FILE_APPEND);
    
    if(isset($calendar_ID)) {
        $newStartTime = time_zone_to_UTC($_POST['startTime'], $_POST['timeZoneOffset']);
        $newEndTime = time_zone_to_UTC($_POST['endTime'], $_POST['timeZoneOffset']);


    $query = "INSERT INTO `course_events` (`calendar_ID`, `title`, `description`, `start`, `end`, `allDay`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $startDateTime = $_POST['startDate']." ".$newStartTime;
    $endDateTime = $_POST['endDate']." ".$newEndTime;
    $allDay = filter_var($_POST['allDay'], FILTER_VALIDATE_BOOLEAN);
    $stmt->bind_param("issssi", $calendar_ID, $title, $description, $startDateTime, $endDateTime, $allDay);
    
    if ($stmt->execute()) {
        // create a reminder for the event
        $query = "INSERT INTO `reminders` (`event_type`, `event_ID`, `start_time`, `end_time`) VALUES ('course_events', ?, ?, ?)";
        $eventID = $stmt->insert_id;
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $eventID, $startDateTime, $endDateTime);
        $stmt->execute();// handle insertion errors later (TM)


            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => true,
                'message' => 'event created successfully',
            )));
        }
        else{
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => false,
                'message' => 'unable to create event',
            )));
        }
    }
    else {
        $conn->close();
        exit(json_encode(array(
            'status' => false,
            'message' => 'Unable to find calendar',
        )));
    }

    // Function to convert given time from given time zone to UTC
    function time_zone_to_UTC(string $time, int $offset)
    {
        list($hours, $minutes) = explode(":", $time);
        $hours = (int) $hours;
        $minutes = (int) $minutes;
        $totalTimeMin = ($hours * 60) + $minutes;
        $adjustedTime = $totalTimeMin + $offset;
        if($adjustedTime < 0){
            $adjustedTime += 1440;
        }
        elseif($adjustedTime >= 1440){
            $adjustedTime -= 1440;
        }
        $newHours = (int) ($adjustedTime/60);
        $newMinutes = $adjustedTime%60;
        if($newHours < 10){
            return "0" . $newHours . ":" . $newMinutes;
        }
        else{
            return $newHours . ":" . $newMinutes;
        }
    }
?>