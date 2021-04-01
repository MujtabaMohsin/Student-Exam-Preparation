
<?php
   
   include "../../connect/connect.php";

    $id = $_GET["id"];

                     $query = "SELECT * FROM resources WHERE resource_ID = $id";
                     
				     $result = mysqli_query($conn,$query) or die('Error, query failed');
                     if(mysqli_num_rows($result) > 0){
                     $row = mysqli_fetch_array($result);
                     $id = $row["resource_ID"];
                     $file = $row["name"];
                     // $type = $row["type"];
                      $content  = $row["Data"];
                     // $size = $row["size"];
				 				   //echo $id . $file . $type . $size;
                                    //echo 'sampath';
                 $content = base64_decode(stripslashes($content));
				   //   header("Content-length: $size");
				   //   header("Content-type: $type");
                 header("Content-Disposition: attachment; filename=$file");




                 
                                       /*  echo  '<object name="'.$file.'" data="data:'.$type.';base64,<?php echo '.$content.' ?>" type="'.$type.'" style="height:200px;width:60%"></object>';
*/

// header("Content-type: $type");
// header("Content-Disposition: inline; filename=$file");
// header('Content-Transfer-Encoding: binary');
// header('Accept-Ranges: bytes');
// @readfile("data:$type;base64,$content");


                     ob_clean();
                  

				     flush();
                  
                     echo $content;

                     mysqli_close($conn);
                     
                     exit;
                     


                     }
    ?>

   