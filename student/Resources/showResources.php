<?php 
    session_start();
    include "database_connection.php";
    $courseID = $_GET["id"];
    $type = $_POST["visabilty"][0];
    $chapter = -1;
    $section = 0;
    $first = true;
    $output = '';
    $user_ID = $_SESSION["userID"];
    if($type == "All Notes") $type = 0;    else $type = 1;
    

    if(isset($_POST["action"])){
        $query = "SELECT * FROM resources WHERE course_ID = $courseID ";
        
        
        if($type == 0){
            $query .= " AND private = 0
			 
            ";
            
            if(isset($_POST["type"]))
            {
                $brand_filter = implode("','", $_POST["type"]);
                $query .= "
                 AND type IN('".$brand_filter."') 
                ";
                
            }
              
                

        }
        if($type == 1){
            $query .= " AND user_ID = $user_ID
            
           ";
           	if(isset($_POST["type"]))
               {
                   $brand_filter = implode("','", $_POST["type"]);
                   $query .= "
                    AND type IN('".$brand_filter."') 
                   ";
               }
        }
        
    $query.= "order by Chapter";
    $statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
    $acc1 = 1;
    $chapterEnterd = false;
    if($total_row > 0)
	{
		foreach($result as $row)
		{

            if($chapter != $row["Chapter"] && $chapterEnterd){
                $chapterEnterd = false; 
                $output.= '
               <tbody>
               </table>
                    </div>
                      </div>
                      </div>
                      </div>
                      
                      
              
                      
              
                        ';
            }


            if($chapter != $row["Chapter"]){
                $chapter = $row["Chapter"];
                 $chapterEnterd = true;
                 $chapterChanged = true;
                 $output.=' <div class="card" style="width: 985.981px;">
                        <div class="card-header active" role="tab">';


                        if($chapter == 0)
                         $output .= '<h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-'.$acc1.'" href="#accordion-1 .item-'.$acc1.'">General</a></h5>';
                       else
                       $output .= '<h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-'.$acc1.'" href="#accordion-1 .item-'.$acc1.'">Chapter '.$chapter.'</a></h5>';

                       
                       $output.=' </div>
                        <div class="collapse item-'.$acc1.'" role="tabpanel" data-parent="#accordion-1">
                            <div class="card-body">
                            <div class="table-responsive">
                 <table class="table" style="table-layout: fixed;">
                                        <thead>
                                            <tr>
                                                ';
                                        if($type == 1 ){
                                            $output .='
                                                <th style="width:35%">Description</th>
                                                <th style="width:35%">Link</th>
                                                <th style="width:10%">Type</th>
                                                <th>Action</th>';
                                        }
                                        else $output .='
                                            <th style="width:40%">Description</th>
                                            <th style="width:45%">Link</th>
                                            <th>Type</th>';
                                            
                                            $output .='    </tr>
                                        </thead>
                                        <tbody>
                     ';


                    



                $acc1++;
            }
            

    if($row["user_ID"] == $user_ID && $type == 1){
        $output.='  <tr>
        <td>'.$row["resource_title"].'</td>';
       
        if($row["From_Link"] == 1){
            $output.=' <td style=" text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" >
               <a href=" '.$row["Link"].'" target="_blank">'.$row["Link"].'</a>
               </td>';
        }

        else{
            $output .= ' <td style=" text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" >
                <a href="download.php?id='.urlencode($row["resource_ID"]).'" target="_blank">'.$row["name"].'</a></td>';
        }
        $output.=' <td >'.$row["type"].'</td>
        
        <td>   ';
        
        if($row["private"] == 1)
        $output .= '
        <button class="btn btn-primary"  style="font-size:14px;" onclick="window.location=\'share.php?id='.$row["resource_ID"].'\'">Share</button>
        ';
        else
        $output .=' 
        <button class="btn btn-secondary"  style="font-size:14px;" onclick="window.location=\'share.php?id='.$row["resource_ID"].'\'" >Unshare</button>
';
        
        $output .='<button class="btn btn-danger" style="font-size:14px; margin-left:1%;margin-right:1%" onclick="window.location=\'delete.php?id='.$row["resource_ID"].'\'">Delete</button>
        </td>
        
        
        
        </tr>
        


        ';

        }





        else{
            $output.='  <tr>
            <td > '.$row["resource_title"].' </td>';
            if($row["From_Link"] == 1){
               $output.=' <td style=" text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" >
               <a href=" '.$row["Link"].'" target="_blank">'.$row["Link"].'</a>
               </td>';
           
            }
            else{
                $output .= ' <td style=" text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" >
                <a href="download.php?id='.urlencode($row["resource_ID"]).'" target="_blank">'.$row["name"].'</a></td>';

            } 
           $output.=' <td >'.$row["type"].'</td>
            </tr>';
        }
    
}    
    }
       
}
else
            {
                $output = '<h3>No Data Found</h3>';
            }
            echo $output;
            ?>
