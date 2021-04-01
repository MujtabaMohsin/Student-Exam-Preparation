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
                    <li class="nav-item"><a id="allQuestionsLink" class="nav-link active" href="<?php $val = $_GET["id"]; echo "discussion-board-my-questions.php?id=$val";?>" >My Questions</a></li> 
                </ul><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalAskQuestion" style="font-size:1.1em;width:20%">Ask Question</button></div>
        </header>
        <div>
            <main class="d-flex flex-column justify-content-between align-items-center align-content-center" id="discussion" >
                <?php
                    $courseID = $_GET["id"];
                    $sql = "SELECT * FROM discussions WHERE user_ID = $_SESSION[userID] AND course_ID = $courseID ORDER BY discussion_ID desc";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            $userSQL = "SELECT * FROM users where User_ID = $row[user_ID]";
                            $result2 = mysqli_query($conn, $userSQL);
                            if(mysqli_num_rows($result2) > 0){
                                $row2 = mysqli_fetch_array($result2);
                                
                                $ansSQL = "SELECT count(*) as count FROM discussions_answers WHERE discussion_ID = $row[discussion_ID]";
                                $result3 = mysqli_query($conn, $ansSQL);
                                if(mysqli_num_rows($result3)> 0){
                                    $row3 = mysqli_fetch_array($result3);
                                

                echo '<a id="discussion_questions" class="child elegent1" href="QuestionDetails.php?id='.$courseID.'&&Did='.$row["discussion_ID"].'" style="text-decoration: none; background-color: #eeeeee; width:807.3px; max-height:150px;  ">
                    <div>
                        <h3>'.$row["Question_title"].'</h3>
                        <p style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"> '.$row["Question"].'</p>
                        <div class="d-flex flex-row justify-content-between align-items-center align-content-center">
                            <p style="color:gray; font-size:12px;">By <b>'.$row2["User_name"].'</b>  on '.$row["date"].'&nbsp;</p>
                            <p style="float:right; ">'.$row3["count"].'  Answers</p>
                    </div>
                        </div>
                </a>';
                                }
                            }
                        }
                    }
                ?>
            </main>
        </div>
    </div>
    
    
    
    
    <div class="modal fade" id="modalAskQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
  
  

    <div class="modal-dialog" role="document">
  
  
    <form action="<?php $val = $_GET["id"]; echo "PostQuestion.php?id=$val";?>" method="post" enctype="multipart/form-data" >
    
    
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Ask a Question</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body mx-3">
            
       
  <!-- Question Title -->
          <div class="md-form mb-3">
          
             <label data-error="wrong" data-success="right" for="titel">Question Title</label>
          <input  type="text" id="title" name="title" class="form-control validate"required>
        

          </div>

 <!-- Question -->
        <div class="md-form">
            <label data-error="wrong" data-success="right" for="question">Question Details</label>
          <textarea type="text" id="question" name="question" class="md-textarea form-control" rows="4" required></textarea>

        </div> 
        
        
        <!-- SUBMIT -->
        <div class="modal-footer d-flex justify-content-center">
             <button type="button"class="btn btn-primary" style="background-color:red;" data-toggle="modal" data-target="#modalAskQuestion">Cancel</button>
           <button type="submit" class="btn btn-primary">Ask</button>
           
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