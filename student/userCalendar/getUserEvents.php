<?php
    require_once("getCalendarID.php");
    require_once("db.php");
    // $string = print_r($_POST, true);
    // file_put_contents('getdata.txt', $string, FILE_APPEND);

    if(isset($calendar_ID)){
        $sql = "SELECT `event_ID`, `title`, `description`, `start`, `end`, `allDay` FROM `user_events` WHERE `calendar_ID` = {$calendar_ID} AND `start` >= '{$_POST['start']}' AND `end` <= '{$_POST['end']}'";
        // echo $sql.'<br>';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $response = array();
            while($row = $result->fetch_assoc()) {
                if($row['allDay'] === "1"){
                    $response[] = array(
                        'event_ID' => $row['event_ID'],
                        'type' => "user_events",
                        'title' => $row['title'],
                        'description' => $row['description'],
                        'start' => $row['start']."+00:00",
                        'end' => $row['end']."+00:00",
                        'allDay' => True,
                    );
                }
                else{
                    $response[] = array(
                        'event_ID' => $row['event_ID'],
                        'type' => "user_events",
                        'title' => $row['title'],
                        'description' => $row['description'],
                        'start' => $row['start']."+00:00",
                        'end' => $row['end']."+00:00",
                        'allDay' => False,
                    );
                }
            }
            echo json_encode($response);
        } else {
            echo json_encode(array());
        }
        $conn->close();
    }
    else{
        echo '<h1> No calender ID was provided </h1>';
    }
?>