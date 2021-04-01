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
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>


    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
<?php 
include_once "../header.php";


?>
   
    <div class="content">
    <div style="margin-bottom:1%;" class="d-flex flex-row justify-content-between align-items-center align-content-center">
              
			  <ul class="nav nav-tabs " style="width: 80%;height: 100%;">
				<li class="nav-item"><a id="allQuestionsLink" class="nav-link active" href="admins.php" >Admins</a></li>
				<li class="nav-item"><a id="addQuestionLink" class="nav-link " href="students.php" >Students</a></li>
			  </ul>
              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalAddAdmin" style="font-size:1.1em;width:20%">Add Admin</button>
			</div>

    <div class="table-responsive">
        <table class="table  table-hover table-bordered">
        <thead class="thead-light">
            <tr>
            <th>#</th>
            <th>Admin Name</th>
            <th>Admin Email</th>

            </tr>
        </thead>
        <tbody>
            <?php   
                $count = 1;
                $sql = "SELECT * from users WHERE student = 0 ORDER BY User_name";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
        
                       
                        echo '
                        <tr>
                        <td>'.$count.'</td>
                        <td>'.$row["User_name"].'</td>
                        <td>'.$row["User_email"].'</td>
                       
                        </tr>

';
                   
$count++;

                    }

                }
?>
           
        </tbody>
        </table>
  </div>

  <div class="modal fade" id="modalAddAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
  
  

  <div class="modal-dialog" role="document">


  <form action="add.php" method="post" >
  
  
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Add Admin</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body mx-3">
          
          <!-- Admin Name -->
        <div class="md-form mb-3">
             <label data-error="wrong" data-success="right" for="cName" >Admin Name</label>
              <input maxlength="30" type="text" id="aName" name="aName"class="form-control validate"  required>
         
        </div>

             <!-- Admin Email -->
             <div class="md-form mb-3">
             <label data-error="wrong" data-success="right" for="cName" >Admin Email</label>
              <input type="email" id="email" name="email"class="form-control validate"  required>
         
        </div>
              <!-- Admin Password -->
              <div class="md-form mb-3">
             <label data-error="wrong" data-success="right" for="cName" >Admin Password</label>
              <input type="password" id="pwd" name="pwd" class="form-control validate"  required>
         
        </div>
        
        


      </div>
        <!-- SUBMIT -->
      <div class="modal-footer d-flex justify-content-center">
           <button type="button"class="btn btn-primary" style="background-color:red;" data-toggle="modal" data-target="#modalAddAdmin">Cancel</button>
         <button type="submit" class="btn btn-primary" name="course">Add </button>
         
      </div>
    </div>
  </div>
  </form>
</div>


</div>








    </div>
    
    <script src="../../assets/js/sc.js"></script>
</body>

</html>