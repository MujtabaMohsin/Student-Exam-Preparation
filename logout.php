<?php
    session_start();
    unset($_SESSION["userID"]);
    header("location:index.php");
?>