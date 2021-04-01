<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Craete course</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">
    <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../../assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="../../assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="../../assets/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
<?php 
include_once "../../page/header.php";


?>
   
    <div class="content">
        <h1>Dashboard</h1>

        <div id="calendarContainer">
            <?php include("../UserCalendar/userCalendar.php")?>
        </div>
        <div id="toDoListContainer">
            <?php include("../UserToDoList/userTodo.php")?>
        </div>
    </div>
    
    <script src="../../assets/js/sc.js"></script>
</body>

</html>