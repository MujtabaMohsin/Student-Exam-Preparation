<div class='container mt-3'>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  
  <script> user_ID=<?php echo $_SESSION['userID'];?>; </script>

  <div class="container-fluid mt-3" >
        <div class="row">
            <div class="col">

                <table id="toDoTable" class="table bg-light table-hover table-bordered mt-2">
                    <thead>
                        <tr class="">
                            <td class=""></td>
                            <td class=""><input type="text" class="form-control" placeholder="To Do" id="newToDOContent"></td>
                            <td class=""><input type="date" class="form-control" placeholder="Date" id="newToDoDate"></td>
                            <td class=""><input type="time" class="form-control" placeholder="Time" id="newToDoTime"></td>
                            <td class=""><input type="button" onclick="addToDo();" class="btn btn-success btn-block" value="Add"></td>
                        </tr>
                        <tr class="">
                            <td class=""><i class="fas fa-check fa-2x"></i></td>
                            <td class="">To Do</td>
                            <td class="">Date</td>
                            <td class="">Time</td>
                            <td class="">Buttons</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>

        <!-- dialogBox for updating ToDo item -->
        <div id="updateToDODialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">New ToDo</h2>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="dialogToDOContent">To Do</label>
                            <input type="text" class="form-control" placeholder="To Do" id="dialogToDOContent">
                        </div>
                        <div class="form-group">
                            <label for="dialogToDoDate">Date</label>
                            <input type="date" class="form-control" placeholder="Date" id="dialogToDoDate">
                        </div>
                        <div class="form-group">
                            <label for="dialogToDoTime">Time</label>
                            <input type="time" class="form-control" placeholder="Time" id="dialogToDoTime">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" onclick="" class="btn btn-success" value="Update" id="dialogUpdateBtn">
                    </div>
                </div>
            </div>
        </div>

    </div>

  <!-- Include JQuery before this point loads -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="../UserToDoList/script.js" type="text/javascript"></script>
</div>
