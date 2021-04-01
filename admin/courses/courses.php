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
				<li class="nav-item"><a id="allQuestionsLink" class="nav-link " href="departments.php" >Departments</a></li>
				<li class="nav-item"><a id="addQuestionLink" class="nav-link active" href="courses.php" >Courses</a></li>
			  </ul>
              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalAddCourse" style="font-size:1.1em;width:20%">Add Course</button>
			</div>

  <div>
        <label for="myInput">Department: </label>
        <select class="form-control validate" id="myInput" name="myInput" style="width:25%;margin-bottom:1%;">
            <option value=" "> All </option>
            <?php
               
               


               $sql1 = "SELECT department_Name, department_ID FROM department ORDER BY department_Name";
               $result1 = mysqli_query($conn,$sql1);
              
               
               if(mysqli_num_rows($result1) > 0){
                   while($row1 = mysqli_fetch_array($result1)){
                       echo '<option value="'.$row1["department_Name"].'">'.$row1["department_Name"].'</option>';

                   }
               }
            ?>
            </select>
      
</div>

    <div class="table-responsive">
        <table class="table  table-hover table-bordered" id="myTable">
        <thead class="thead-light">
            <tr>
            <th>#</th>
            <th>Course Name</th>
            <th>Course Code</th>
            <th>Course Department</th>

            </tr>
        </thead>
        <tbody>
            <?php   
                $count = 1;
                $sql = "SELECT * from courses_code ORDER BY Department_ID, Course_Code ";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                    $sql2 = "SELECT department_Name FROM department WHERE department_ID = $row[Department_ID]";
                    $result2 = mysqli_query($conn, $sql2);
                    if(mysqli_num_rows($result2) > 0){
                        while($row2 = mysqli_fetch_array($result2)){
                       
                        echo '
                        <tr>
                        <td>'.$count.'</td>
                        <td>'.$row["Course_Name"].'</td>
                        <td>'.$row["Course_Code"].'</td>
                        <td>'.$row2["department_Name"].'</td>
                       
                        </tr>

';
                        }
                    }
$count++;

                    }

                }
?>
           
        </tbody>
        </table>
  </div>

  <div class="modal fade" id="modalAddCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
  
  

  <div class="modal-dialog" role="document">


  <form action="add.php" method="post" >
  
  
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Add Course</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body mx-3">
          
          <!-- Course Name -->
        <div class="md-form mb-3">
             <label data-error="wrong" data-success="right" for="cName" >Course Name</label>
              <input maxlength=99" type="text" id="cName" name="cName"class="form-control validate" placeholder="Example: Calculus I" required>
         
        </div>

             <!-- Course Code -->
             <div class="md-form mb-3">
             <label data-error="wrong" data-success="right" for="cName" >Course Code</label>
              <input maxlength="20" type="text" id="Code" name="Code"class="form-control validate" placeholder="Example: MATH101" required>
         
        </div>
          
           <!-- Department -->
           <div class="md-form mb-3">
            <label data-error="wrong" data-success="right" for="dept">Department</label>
            <select class="form-control validate" id="dName" name="dName">
            <?php
               
               


               $sql1 = "SELECT department_Name, department_ID FROM department ORDER BY department_Name";
               $result1 = mysqli_query($conn,$sql1);
              
               
               if(mysqli_num_rows($result1) > 0){
                   while($row1 = mysqli_fetch_array($result1)){
                       echo '<option value="'.$row1[department_ID].'">'.$row1[department_Name].'</option>';

                   }
               }
               $conn->close();
            ?>
            </select>
            
        </div>
        


      </div>
        <!-- SUBMIT -->
      <div class="modal-footer d-flex justify-content-center">
           <button type="button"class="btn btn-primary" style="background-color:red;" data-toggle="modal" data-target="#modalAddCourse">Cancel</button>
         <button type="submit" class="btn btn-primary" name="course">Add </button>
         
      </div>
    </div>
  </div>
  </form>
</div>


</div>








    </div>
    
    <script>
$(document).ready(function(){
 

  $("#myInput").on("change", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


    <script src="../../assets/js/sc.js"></script>
</body>

</html>
