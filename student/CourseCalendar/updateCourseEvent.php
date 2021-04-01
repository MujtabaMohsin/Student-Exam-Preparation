<?php
    require_once('./db.php');

    // check if all parametes have been provided
    $checkParameters = isset($_POST['event_ID']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['startDate']) && isset($_POST['startTime']) && isset($_POST['endDate']) && isset($_POST['endTime']) && isset($_POST['timeZoneOffset']) && isset($_POST['allDay']);

    if($checkParameters) {
        // escape parameters and store in variables
        $event_ID = (int) $conn->real_escape_string($_POST['event_ID']);
        $title = $conn->real_escape_string($_POST['title']);
        $description = $conn->real_escape_string($_POST['description']);
        $startDate = $conn->real_escape_string($_POST['startDate']);
        $startTime = $conn->real_escape_string($_POST['startTime']);
        $endDate = $conn->real_escape_string($_POST['endDate']);
        $endTime = $conn->real_escape_string($_POST['endTime']);
        $timeZoneOffset = (int) $conn->real_escape_string($_POST['timeZoneOffset']);
        $allDay = filter_var($conn->real_escape_string($_POST['allDay']), FILTER_VALIDATE_BOOLEAN);

        // convert to time UTC
        $startTimeUTC = time_zone_to_UTC($startTime, $timeZoneOffset);
        $endTimeUTC = time_zone_to_UTC($endTime, $timeZoneOffset);

        // merge date and time
        $startDateTime = $startDate." ".$startTimeUTC;
        $endDateTime = $endDate." ".$endTimeUTC;

        // prepare SQL statement
        $query = "UPDATE `course_events` SET `title` = ?, `description` = ?, `start` = ?, `end` = ?, `allDay` = ? WHERE `event_ID` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssii", $title, $description, $startDateTime, $endDateTime, $allDay, $event_ID);

        // execute SQL statment
        if($stmt->execute()) {
            // update the events reminder
            $query = "UPDATE `reminders` SET `start_time` = ?, `end_time` = ? WHERE `event_ID` = ? AND `event_type` = 'course_events'";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssi", $startDateTime, $endDateTime, $event_ID);
            if($stmt->execute()) {// handle insertion errors later (TM)
                $stmt->close();
                $conn->close();
                exit(json_encode(array(
                    'status' => true,
                    'message' => "Event and reminder updated successfully"
                )));
            }
            else {
                $stmt->close();
                $conn->close();
                exit(json_encode(array(
                    'status' => true,
                    'message' => "Event updated successfully, reminder not so much"
                )));
            }
        }
        else {
            $stmt->close();
            $conn->close();
            exit(json_encode(array(
                'status' => false,
                'message' => "Unable to update event"
            )));
        }

    }
    else {
        $conn->close();
        exit(json_encode(array(
            'status' => false,
            'message' => "A parameter is missing"
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
        // append leading 0 if needed
        $newHours = $newHours < 10 ? "0" . $newHours : $newHours;
        $newMinutes = $newMinutes < 10 ? "0" . $newMinutes : $newMinutes;

        return $newHours . ":" . $newMinutes;
    }
?>