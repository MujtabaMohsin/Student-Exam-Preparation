<?php
    session_start();
    require_once("connect/connect.php");
    // Clear message variable
    if(isset($_SESSION['signInMessage'])){unset($_SESSION['signInMessage']);}

    if(isset($_POST['signInEmail'])&&isset($_POST['signInPassword'])){
        // store values in variables
        $email = $_POST['signInEmail'];
        $pwd = $_POST['signInPassword'];

        // get user data with matching email
        $query = "SELECT `User_ID`, `User_email`, `password`, `hash` , `student`, `status` FROM `users` WHERE `User_email` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            // if user exists
            if($result->num_rows == 1){
                while($row = $result->fetch_assoc()){
                    if($row['hash'] == ""){// hash is not stored
                        if($pwd == $row['password']){// correct password
                            // store password as hash
                            $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
                            $userID = $row['User_ID'];
							$student = $row['student'];
                            $query = "UPDATE `users` SET `hash` = ? WHERE `User_ID` = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("si", $pwd_hash, $userID);
                            $stmt->execute();

                            $stmt->close();
                            $conn->close();
                            $_SESSION["userID"] = $row["User_ID"];
						 if($row["student"] == 1 && $row["status"] == 1){
								 header("location:student/Course/Course.php");
							}
                           			 elseif($row["student"] == 0 && $row["status"] == 1){
								header("location:admin/notifications/notifications.php");
                            }
                            else   {
                                header("location:index.php");
                            }
                           
                        }
                        else{// incorrect password
                            $stmt->close();
                            $conn->close();
                            $_SESSION['signInMessage'] = "Incorrect password pw";
                            header("location:index.php");
                        }
                    }
                    else{// hash is stored
                        if(password_verify($pwd, $row['hash'])){// correct password
                            $stmt->close();
                            $conn->close();
                            $_SESSION["userID"] = $row["User_ID"];
                             if($row["student"] == 1 && $row["status"] == 1){
								 header("location:student/Course/Course.php");
							}
                            elseif($row["student"] == 0 && $row["status"] == 1){
								header("location:admin/notifications/notifications.php");
                            }
                            else   {
                                header("location:index.php");
                            }
                        }
                        else{// incorrect password
                            $stmt->close();
                            $conn->close();
                            $_SESSION['signInMessage'] = "Incorrect password hs";
                            header("location:index.php");
                        }
                    }
                }
            }
            else{
                $stmt->close();
                $conn->close();
                $_SESSION['signInMessage'] = "User does not exist";
                header("location:index.php");
            }
        }
        else{
            $stmt->close();
            $conn->close();
            $_SESSION['signInMessage'] = "Server Error";
            header("location:index.php");
        }
    }
    else{
        $conn->close();
        $_SESSION['signInMessage'] = "missing input fields";
        header("location:index.php");
    }
?>
