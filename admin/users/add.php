<?php
    include "../../connect/connect.php";
    
    $name = $_POST["aName"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(User_name, User_email, password, hash, student) VALUES ('$name', '$email', '$pwd', '$pwd_hash', 0)";
    
    $result = mysqli_query($conn, $sql);

        header("location:admins.php");

?>

