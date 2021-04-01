
var dataTable;

$(document).ready(function () {
    $("#addToDoBtn").on('click', function () {
        $("#dialogToDOContent").val("")
        $("#dialogToDoDate").val("")
        $("#dialogToDoTime").val("")
        $("#updateToDODialog").modal('show');
    });

    loadData(0, 10);

});

function loadData(start, limit) {
    $.ajax({
        url: "../UserToDoList/ajax.php",
        method: "POST",
        dataType: "text",
        data: {
            key: 'loadData',
            start: start,
            limit: limit,
        },
        success: function (response) {
            if(response != "reachedMax") {
                $("tbody").append(response);
                start += limit;
                loadData(start, limit);
            }
            else {
                dataTable = $("#toDoTable").DataTable({
                    "columns": [
                        { "width": "5%" },
                        { "width": "55%",  },
                        { "width": "10%",  },
                        { "width": "10%",  },
                        { "width": "20%",  "orderable": false },
                    ]
                });
            }
        },
        error: function (jqXHR, textStatus, errorMessage) {
            alert("Error" + errorMessage);
        },
    });
}

function ToDoManage(key) {
    // Input field values
    var toDoContent = $("#dialogToDOContent");
    var toDoDate = $("#dialogToDoDate");
    var toDoTime = $("#dialogToDoTime");

    // Input field check validity bools
    var checkContentField = isNotEmpty(toDoContent);
    var checkDateField = isNotEmpty(toDoDate);
    var checkTimeField = isNotEmpty(toDoTime);
    
    if(checkContentField && checkDateField && checkTimeField) {
        $.ajax({
            url: "../UserToDoList/ajax.php",
            method: "POST",
            dataType: "text",
            data: {
                key: key,
                content: toDoContent.val(),
                date: toDoDate.val(),
                time: toDoTime.val(),
            },
            success: function (response) {
                alert(response);
            },
            error: function (jqXHR, textStatus, errorMessage) {
                alert("Error" + errorMessage);
            },
        });
    }

}

function addToDo() {
    // Input field values
    var toDoContent = $("#newToDOContent");
    var toDoDate = $("#newToDoDate");
    var toDoTime = $("#newToDoTime");

    // Input field check validity bools
    var checkContentField = isNotEmpty(toDoContent);
    var checkDateField = isNotEmpty(toDoDate);
    var checkTimeField = isNotEmpty(toDoTime);

    if(checkContentField && checkDateField && checkTimeField) {
        $.ajax({
            url: "../UserToDoList/addToDo.php",
            method: "POST",
            dataType: "json",
            data: {
                user_ID: user_ID,
                content: toDoContent.val(),
                date: toDoDate.val(),
                time: toDoTime.val(),
            },
            success: function (response) {
                if(response.status) {
                    console.log(response.newToDo);
                    newRow = dataTable.row.add([
                        `<div class='custom-control custom-checkbox'>
                        <input type='checkbox' class='custom-control-input' id='TodoCheck${response.newToDo.todo_ID}' onchange='doneTodo(${response.newToDo.todo_ID}, this)'>
                        <label class='custom-control-label' for='TodoCheck${response.newToDo.todo_ID}'></label>
                        </div>`,
                        response.newToDo.content,
                        response.newToDo.date,
                        response.newToDo.time,
                        `<input type="button" onclick="editToDo(${response.newToDo.todo_ID})" value="Edit" class="btn btn-secondary mb-1">
                        <input type="button" onclick="deleteToDo(${response.newToDo.todo_ID})" value="Delete" class="btn btn-danger mb-1">`,
                    ]).draw().node();
                    newRow.setAttribute('id', `toDoID${response.newToDo.todo_ID}`);
                }
                else {
                    console.log(response.message);
                }
            },
            error: function (jqXHR, textStatus, errorMessage) {
                alert("Error" + errorMessage);
            },
        });
    }

}

function isNotEmpty(caller) {
    if(caller.val() == '' || caller.is(':invalid')) {
        caller.addClass('is-invalid');
        return false;
    }
    else {
        caller.removeClass('is-invalid');
        return true;
    }
}

function editToDo(todo_ID) {
    $.ajax({
        url: "../UserToDoList/ajax.php",
        method: "POST",
        dataType: "json",
        data: {
            key: "getToDoData",
            todo_ID: todo_ID,
        },
        success: function (response) {
            $("#dialogToDOContent").val(response.content)
            $("#dialogToDoDate").val(response.date)
            $("#dialogToDoTime").val(response.time)
            $("#dialogUpdateBtn").attr('onclick', `updateToDo(${todo_ID});`)
            $("#updateToDODialog").modal('show');
        },
        error: function (jqXHR, textStatus, errorMessage) {
            alert("Error" + errorMessage);
        },
    });
}

function updateToDo(todo_ID) {
    updatedContent = $("#dialogToDOContent").val();
    updatedDate = $("#dialogToDoDate").val();
    updatedTime = $("#dialogToDoTime").val();

    $.ajax({
        url: "../UserToDoList/updateToDo.php",
        method: "POST",
        dataType: "json",
        data: {
            user_ID: user_ID,
            todo_ID: todo_ID,
            content: updatedContent,
            date: updatedDate,
            time: updatedTime,
        },
        success: function (response) {
            if(response.status) {
                dataTable.row($("#toDoID"+todo_ID)).remove()
                newRow = dataTable.row.add([
                    `<div class='custom-control custom-checkbox'>
                    <input type='checkbox' class='custom-control-input' id='TodoCheck${todo_ID}' onchange='doneTodo(${todo_ID}, this)'}>
                    <label class='custom-control-label' for='TodoCheck${todo_ID}'></label>
                    </div>`,
                    updatedContent,
                    updatedDate,
                    updatedTime,
                    `<input type="button" onclick="editToDo(${todo_ID})" value="Edit" class="btn btn-secondary mb-1">
                    <input type="button" onclick="deleteToDo(${todo_ID})" value="Delete" class="btn btn-danger mb-1">`,
                ]).draw().node();
                newRow.setAttribute('id', `toDoID${todo_ID}`);
                $("#updateToDODialog").modal('hide');
            }
            else {
                alert(response.message);
            }
        },
        error: function (jqXHR, textStatus, errorMessage) {
            alert("Error" + errorMessage);
        },
    });
}

function deleteToDo(todo_ID) {
    $.ajax({
        url: "../UserToDoList/deleteToDo.php",
        method: "POST",
        dataType: "json",
        data: {
            todo_ID: todo_ID,
        },
        success: function (response) {
            if(response.status) {
                dataTable.row($("#toDoID"+todo_ID)).remove().draw();
            }
            else {
                alert(response.message);
            }
        },
        error: function (jqXHR, textStatus, errorMessage) {
            alert("Error" + errorMessage);
        },
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