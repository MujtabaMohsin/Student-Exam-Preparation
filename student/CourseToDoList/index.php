<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>To Do List</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">
    <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../../assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="../../assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="../../assets/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script> const course_ID=<?php echo $_GET['id']; ?>; </script>
</head>

<body>

  <?php include_once "../../page/header.php";?>
  <?php include_once "../../page/Left_List.php";?>
  <div class='container mt-3 ml-0 col-8'>
    <h2>To Do List</h2>
    <table id="TodosTable" class="table bg-light text-center table-bordered">
      <thead id="TodosHeader">
        <tr class="d-flex">
          <th class="col-1" scope="col">Done</th>
          <th class="col-8" scope="col">Content</th>
          <th class="col-3" scope="col">Buttons</th>
        </tr>
      </thead>
      <tbody id="TodosBody" >
        <tr class="d-flex" id="newTodoRow">
          <th class="col-1" scope="row"></th>
          <td class="col-8"><input type="text" class="form-control" placeholder="New Todo" id="newTodoInput"></td>
          <td class="col-3"><button type="button" class="btn btn-primary" id="createTodoBtn" onclick='createTodo(user_ID);'>Create Item</button></td>
        </tr>
      </tbody>
    </table>

    <!-- Include JQuery before this point loads -->
    <script src="./ajax.js"></script>
    <script>loadTodos(course_ID);</script>
  </div>
  <script>
    
      var active = document.getElementsByClassName("active"); 


      active[0].classList.remove("active"); 

      var target = document.getElementById("ToDoTab");
      target.classList.add("active");

  </script>

</body>

</html>