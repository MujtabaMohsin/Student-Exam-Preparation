<?php
    require_once('db.php');

    // $string = print_r($_POST, true);
    // file_put_contents('data.txt', $string, FILE_APPEND);

    if(isset($_POST['key'])) {

        if($_POST['key'] == "loadData") {
            $start = $conn->real_escape_string($_POST['start']);
            $limit = $conn->real_escape_string($_POST['limit']);

            $query = "SELECT `todo_ID`, `content`, `complete`, `dateTime` FROM `user_todo` LIMIT ?, ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $start, $limit);
            if($stmt->execute()) {
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                    $response = "";
                    while($row = $result->fetch_assoc()) {
                        $dateTime = explode(" ", $row['dateTime']);
                        $Checked = $row['complete'] == 1? "checked" : "";
                        $response .= '
                        <tr id="toDoID'.$row['todo_ID'].'" class="">
                            <td class=""><div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="TodoCheck'.$row['todo_ID'].'" onchange="doneTodo('.$row['todo_ID'].', this)"'.$Checked.'>
                                <label class="custom-control-label" for="TodoCheck'.$row['todo_ID'].'"></label>
                            </div></td>
                            <td class="">'.$row['content'].'</td>
                            <td class="">'.$dateTime[0].'</td>
                            <td class="">'.$dateTime[1].'</td>
                            <td class="">
                                <input type="button" onclick="editToDo('.$row['todo_ID'].')" value="Edit" class="btn btn-secondary mb-1">
                                <input type="button" onclick="deleteToDo('.$row['todo_ID'].')" value="Delete" class="btn btn-danger mb-1">
                            </td>
                        </tr>
                        ';
                    }
                    exit($response);
                }
                exit("reachedMax");
            }

        }

        if($_POST['key'] == "getToDoData") {
            $todo_ID = $conn->real_escape_string($_POST['todo_ID']);

            $query = "SELECT `content`, `dateTime` FROM `user_todo` WHERE `todo_ID` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $todo_ID);
            if($stmt->execute()) {
                $response;
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()) {
                    $dateTime = explode(" ", $row['dateTime']);
                    $response = array(
                        'content' => $row['content'],
                        'date' => $dateTime[0],
                        'time' => $dateTime[1],
                    );
                }
                exit(json_encode($response));
            }
        }

        $content = $conn->real_escape_string($_POST['content']);
        $date = $conn->real_escape_string($_POST['date']);
        $time = $conn->real_escape_string($_POST['time']);
        $dateTime = $date. " " .$time;

        if($_POST['key'] == "addNew") {
            $query = "INSERT INTO `user_todo` (`user_ID`, `content`, `dateTime`) VALUES (1, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $content, $dateTime);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            exit('To Do added succssfully');
        }
    }
?>