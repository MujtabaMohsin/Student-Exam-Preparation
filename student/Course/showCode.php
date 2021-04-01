<?php
include "../../connect/connect.php";
    if(isset($_POST["query"])){
        $output = array();
        $code = array();
        $name = array();
        $DID = $_POST["query"];
        $query = "SELECT * from courses_code where Department_ID =".$_POST["query"]."";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                array_push($code, $row["Course_Code"]);
                array_push($name, $row["Course_Name"]);



            }
        
        }
        array_push($output, $code, $name);
        echo json_encode($output);
    }

    $conn->close();
?>
