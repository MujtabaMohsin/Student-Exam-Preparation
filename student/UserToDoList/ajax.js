var response;
function createTodo(user_ID){
    $.ajax('../UserToDoList/createTodo.php', {
        type: 'POST',
        dataType: "json",
        data: { user_ID: user_ID, newTodo: $("#newTodoInput").val(), }, // data to submit
        success: function (data, status, xhr) {
            response = data;
            if(data.status){
                $("#newTodoInput").val("");
                $(`#TodosBody tr`).eq(0).after(`<tr class='d-flex' id='Todo${data.Todo_ID}'>
                    <th class='col-1' scope='row'>
                    <div class='custom-control custom-checkbox'>
                        <input type='checkbox' class='custom-control-input' id='TodoCheck${data.Todo_ID}' onchange='doneTodo(${data.Todo_ID}, this)'>
                        <label class='custom-control-label' for='TodoCheck${data.Todo_ID}'></label>
                    </div>
                    </th>
                    <td class='col-8'>${data.content}</td>
                    <td class='col-3'>
                        <button type='button' class='btn btn-secondary' id='editTodo${data.Todo_ID}Btn'>Edit</button>
                        <button type='button' class='btn btn-danger' id='deleteTodo${data.Todo_ID}Btn' onclick='deleteTodo(${data.Todo_ID});'>Delete</button>
                    </td>
                </tr>`);
            }
            else{
                alert("Error: unable to create Todo\n"+ data.message);
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            alert('Error' + errorMessage);
        }
    });
}


function deleteTodo(Todo_ID){
    $.ajax('../UserToDoList/deleteTodo.php', {
        type: 'POST',
        dataType: "json",
        data: { Todo_ID: Todo_ID, }, // data to submit
        success: function (data, status, xhr) {
            response = data;
            if(data.status){
                $(`#Todo${Todo_ID}`).remove()
                // alert("Message: " + data.message);
            }
            else{
                alert("Error: unable to delete Todo\n"+ data.message);
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            alert('Error' + errorMessage);
        }
    });
}


function loadTodos(user_ID){
    $.ajax('../UserToDoList/loadTodo.php', {
        type: 'POST',
        dataType: "json",
        data: { user_ID: user_ID, }, // data to submit
        success: function (data, status, xhr) {
            response = data;
            if(data.status){
                $('#TodosBody tr').remove();
                $('#TodosBody').append(`<tr class="d-flex" id="newTodoRow">
                    <th class="col-1" scope="row"></th>
                    <td class="col-8"><input type="text" class="form-control" placeholder="New Todo" id="newTodoInput"></td>
                    <td class="col-3"><button type="button" class="btn btn-primary" id="createTodoBtn" onclick='createTodo(user_ID);'>Create Todo</button></td>
                </tr>`);
                for(Todo of data.results){
                    $('#TodosBody').append(`<tr class='d-flex' id='Todo${Todo.Todo_ID}'>
                        <th class='col-1' scope='row'>
                        <div class='custom-control custom-checkbox'>
                            <input type='checkbox' class='custom-control-input' id='TodoCheck${Todo.Todo_ID}' onchange='doneTodo(${Todo.Todo_ID}, this)' ${Todo.done ? 'checked' : ''}>
                            <label class='custom-control-label' for='TodoCheck${Todo.Todo_ID}'></label>
                        </div>
                        </th>
                        <td class='col-8'>${Todo.content}</td>
                        <td class='col-3'>
                            <button type='button' class='btn btn-secondary' id='editTodo${Todo.Todo_ID}Btn'>Edit</button>
                            <button type='button' class='btn btn-danger' id='deleteTodo${Todo.Todo_ID}Btn' onclick='deleteTodo(${Todo.Todo_ID});'>Delete</button>
                        </td>
                    </tr>`);
                }
            }
            else{
                alert("Error: unable to load Todos\n"+ data.message);
            }
            
        },
        error: function (jqXhr, textStatus, errorMessage) {
            alert('Error' + errorMessage);
        }
    });
}


function doneTodo(Todo_ID, self){
    $.ajax('../UserToDoList/doneTodo.php', {
        type: 'POST',
        dataType: "json",
        data: { Todo_ID: Todo_ID, done: self.checked,  }, // data to submit
        success: function (data, status, xhr) {
            response = data;
            if(data.status){
                // alert("Message: " + data.message);
            }
            else{
                self.checked = !self.checked;
                alert("Error: unable to change Todo done status\n"+ data.message);
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            alert('Error' + errorMessage);
        }
    });
}