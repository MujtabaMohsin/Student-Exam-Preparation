<?php
   include "../../connect/connect.php";

    $id = $_GET["id"];

   
                     $query = "SELECT * FROM notes WHERE Note_ID = $id";
                     
				     $result = mysqli_query($conn,$query) or die('Error, query failed');
                     if(mysqli_num_rows($result) > 0){
                     $row = mysqli_fetch_array($result);
                     $id = $row["note_ID"];
                     $file = $row["note_name"];
                     $type = $row["type"];
                     $content  = $row["data"];
                     $size = $row["size"];
				 				   //echo $id . $file . $type . $size;
                                    //echo 'sampath';
                                    $content = base64_decode(stripslashes($content));
				     header("Content-length: $size");
				     header("Content-type: $type");
                     header("Content-Disposition: attachment; filename=$file");
                     
                     ob_clean();
                     
				     flush();
		                     
                     echo $content;
                     
                     mysqli_close($conn);
                     
				     exit;
                     }
    ?>
