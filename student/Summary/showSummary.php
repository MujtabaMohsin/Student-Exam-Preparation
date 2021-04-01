<?php 
    session_start();
    include "database_connection.php";
    $courseID = $_GET["id"];
    $type = $_POST["visabilty1"][0];
    $chapter = 0;
    $section = 0;
    $first = true;
    $user_ID = $_SESSION["userID"];
    
    if($type == "All Notes") $type = 0;    else $type = 1;
    

    if(isset($_POST["action"])){
        $query = "SELECT * FROM notes WHERE course_ID = $courseID AND category = 2";
        
        
        if($type == 0){
            $query .= " AND private = 0
			 order by chapter, section
			";
        }
        if($type == 1){
            $query .= " AND  user_ID = $user_ID
            order by chapter, section
           ";
        }
        

    $statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
    $output = '';
    $acc1 = 1;
    $chapterEnterd = false;
    if($total_row > 0)
	{
		foreach($result as $row)
		{

            if($chapter != $row["chapter"] && $chapterEnterd){
                $chapterEnterd = false; 
               echo '</div>
                      </div>
                      </div>
                     
                      
              
                      
              
                        ';
            }


            if($chapter != $row["chapter"]){
                $chapter = $row["chapter"];
                 $chapterEnterd = true;
                 $chapterChanged = true;
                echo' <div class="card" style="width: 985.981px;">
                        <div class="card-header active" role="tab">
                            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-2 .item-'.$acc1.'" href="#accordion-2 .item-'.$acc1.'">Chapter '.$row["chapter"].'</a></h5>
                        </div>
                        <div class="collapse item-'.$acc1.'" role="tabpanel" data-parent="#accordion-2">
                            <div class="card-body">
                            
                     ';


                    



                $acc1++;
            }
            
            if($row["user_ID"] == $user_ID && $type == 1){
                echo'
                             <ul style="padding-left: 20px; list-style: none;">
                            <li style="margin-top:4px; padding-bottom: 15px; border-bottom: 1px solid lightgray"><a href="download.php?id='.urlencode($row["note_ID"]).'" target="_blank">'.$row["note_name"].'</a> 
                            <button class="btn btn-danger" style="font-size:14px;float:right; margin-left:1%" onclick="window.location=\'delete.php?id='.$row["note_ID"].'\'">Delete</button>
                           ';
                           if($row["private"] == 1)
                            echo '
                            <button class="btn btn-primary" style="font-size:14px;float:right;width:9%" onclick="window.location=\'share.php?id='.$row["note_ID"].'\'">Share</button>
                            ';
                            else
                            echo' 
                            <button class="btn btn-secondary"  style="font-size:14px;float:right; width:9%" onclick="window.location=\'share.php?id='.$row["note_ID"].'\'">Unshare</button>
            ';
              echo' 
                            </li>
                            
                              </ul>';
                }
                        else
                        echo'
                        <ul style="margin-top:4px;padding-left: 20px; list-style: none;">
                        <li style=" padding-bottom: 10px; border-bottom: 1px solid lightgray"><a href="download.php?id='.urlencode($row["note_ID"]).'" target="_blank">'.$row["note_name"].'</a> 
                         </li>
                        
                    </ul>';
            
            
                    }
                }
            }    
        else
            {
                $output = '<h3>No Data Found</h3>';
            }
            echo $output;

            

            ?>