<?php
session_start();
   
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>discussion</title>
    

    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">
    <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../../assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="../../assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="../../assets/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

<?php 
include_once "../../page/header.php";
include_once "../../page/Left_List.php";
?>

    <div class="d-flex flex-column" style="width:85%">
        <header >
            <div class="d-flex flex-row justify-content-between align-items-center align-content-center">
                <ul class="nav nav-tabs" style="width:80%">
                <li class="nav-item " ><a id="allQuestionsLink" class="nav-link " href="<?php $val = $_GET["id"]; echo "discussion-board.php?id=$val";?>" >View All Questions</a></li> 
                    <li class="nav-item"><a id="allQuestionsLink" class="nav-link" href="<?php $val = $_GET["id"]; echo "discussion-board-my-questions.php?id=$val";?>" >My Questions</a></li> 
                </ul><button class="btn btn-dark" type="button" data-toggle="modal" data-target="#modalAnsQuestion" style="font-size:1.1em;width:20%">Answer</button></div>
        </header>
        <div>
            <main class="d-flex flex-column justify-content-between align-items-center align-content-center" id="discussion" >
                <?php
                    $id = $_GET["id"];
                    $Did = $_GET["Did"];
                    $count;
                    $sql = "SELECT * FROM discussions WHERE discussion_ID = $Did";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            $userSQL = "SELECT * FROM users where User_ID = $row[user_ID]";
                            $result2 = mysqli_query($conn, $userSQL);
                            if(mysqli_num_rows($result2) > 0){
                                $row2 = mysqli_fetch_array($result2);
                                

                                echo '<a id="discussion_questions" class="child elegent1"  style="text-decoration: none; background-color: #eeeeee; width:807.3px;   ">
                                <div>
                                    <h3>'.$row["Question_title"].'</h3>
                                    <p > '.$row["Question"].'</p>
                                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center">
                                        <p style="color:gray; font-size:12px;" >By <b>'.$row2["User_name"].'</b>  on '.$row["date"].'&nbsp;</p>
                                        
                                        <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#modalAnsQuestion" style="font-size:1.1em;width:20%">Answer</button>
                                </div>
                                    </div>
                            </a>';
                            echo'  <div>
                            <br>
                            <h5 style="float:left; width:807.3px;">'.$row["No_of_ans"].' Answers</h5>
                        </div> ';
            
                                $ansSQL = "SELECT *  FROM discussions_answers WHERE discussion_ID = $row[discussion_ID] ORDER BY answer_ID desc";
                                $result3 = mysqli_query($conn, $ansSQL);
                                if(mysqli_num_rows($result3)> 0){
                                  while($row3 = mysqli_fetch_array($result3)){
                                    $userSQL = "SELECT * FROM users where User_ID = $row3[user_ID]";
                                    $result2 = mysqli_query($conn, $userSQL);
                                    if(mysqli_num_rows($result2) > 0){
                                         $row2 = mysqli_fetch_array($result2);
                                    echo '<a id="discussion_questions" class="child elegent1"  style="text-decoration: none; background-color: #eeeeee; width:807.3px;   ">
                                         <div>
                                            
                                            <p  > '.$row3["answer"].'</p>
                                            <div class="d-flex flex-row justify-content-end align-items-center align-content-end">
                                                <p style="color:gray; font-size:12px;">By <b>'.$row2["User_name"].'</b>  on '.$row["date"].'</p>
                                                
                                                
                                               
                                        </div>
                                    
                                            </div>
                                    </a>';
                                    }

                                  }
                                }
                            }
                        }
                    }
                   
                   


               

                





                ?>
                 
            </main>
        </div>
    </div>
    
    
    
    
    <div class="modal fade" id="modalAnsQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
  
  

    <div class="modal-dialog" role="document">
  
  
    <form action="<?php $val = $_GET["Did"]; echo "PostAnswer.php?id=$val";?>" method="post" enctype="multipart/form-data" >
    
    
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Post an Asnwer</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body mx-3">
            
       
  
 <!-- Question -->
        <div class="md-form">
            <label data-error="wrong" data-success="right" for="answer">Your Answer</label>
          <textarea type="text" id="answer" name="answer" class="md-textarea form-control" rows="6" required></textarea>

        </div> 
        
        
        <!-- SUBMIT -->
        <div class="modal-footer d-flex justify-content-center">
             <button type="button"class="btn btn-primary" style="background-color:red;" data-toggle="modal" data-target="#modalAnsQuestion">Cancel</button>
           <button type="submit" class="btn btn-dark">Post</button>
           
        </div>
      </div>
    </div>
    </form>
</div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/js/sc2.js"></script>




    <script>
         $(document).ready(function(){    
                ToDiscussion();


         });
</script>
</body>

</html>