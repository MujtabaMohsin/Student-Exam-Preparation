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
				<li class="nav-item"><a id="allQuestionsLink" class="nav-link " href="admins.php" >Admins</a></li>
				<li class="nav-item"><a id="addQuestionLink" class="nav-link active" href="students.php" >Students</a></li>
			  </ul>
			</div>

    <div class="table-responsive">
        <table class="table  table-hover table-bordered">
        <thead class="thead-light">
            <tr>
            <th>#</th>
            <th>Admin Name</th>
            <th>Admin Email</th>
            <th>Action</th>

            </tr>
        </thead>
        <tbody>
        <?php   
                $count = 1;
                $sql = "SELECT * from users WHERE student = 1 ORDER BY User_name";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){

                       
                        echo '
                        <tr>
                        <td>'.$count.'</td>
                        <td>'.$row["User_name"].'</td>
                        <td>'.$row["User_email"].'</td>
                        <td style="text-align:center">
                        ';

                        if($row["status"] == 1){
                        echo'<button class="btn btn-danger"  style="font-size:14px;width:50%" onclick="window.location=\'block.php?id='.$row["User_ID"].'\'">Block</button>
                            ';
                    }
                    else{
                        echo'<button class="btn btn-success"  style="font-size:14px;width:50%" onclick="window.location=\'block.php?id='.$row["User_ID"].'\'" >Unblock</button>

';
                    }

                      echo'  </td>
                       
                        </tr>

';
                   
$count++;

                    }

                }
?>
  
           
        </tbody>
        </table>
  </div>

  








    </div>
    
    <script src="../../assets/js/sc.js"></script>
</body>

</html>