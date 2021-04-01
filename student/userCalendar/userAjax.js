
$("#createEventBtn").click(function () {
    if($("#createCalendarSelect").is(':invalid')) {
        alert('please select a calendar');
        return;
    }
    calendarInfo = $("#createCalendarSelect").val().split(',');
    var url;
    var data;
    if(calendarInfo[0] === "user") {// calendar selected is a user calendar
        url = '../UserCalendar/createUserEvent.php';
        data = {
            user_ID: calendarInfo[1],
            title: $('#createTitleInput').val(),
            description: $('#createDescriptionInput').val(),
            startDate: $('#createStartDateInput').val(),
            startTime: $('#createStartTimeInput').val(),
            endDate: $('#createEndDateInput').val(),
            endTime: $('#createEndTimeInput').val(),
            timeZoneOffset: new Date().getTimezoneOffset(),
            allDay: $('#createAllDayCheck').is(':checked'),
        };
    }
    else if(calendarInfo[0] === "course") {// calendar selected is a course calendar
        url = '../CourseCalendar/createCourseEvent.php';
        data = {
            course_ID: calendarInfo[1],
            title: $('#createTitleInput').val(),
            description: $('#createDescriptionInput').val(),
            startDate: $('#createStartDateInput').val(),
            startTime: $('#createStartTimeInput').val(),
            endDate: $('#createEndDateInput').val(),
            endTime: $('#createEndTimeInput').val(),
            timeZoneOffset: new Date().getTimezoneOffset(),
            allDay: $('#createAllDayCheck').is(':checked'),
        };
    }
    else{
        alert('invalid calendar selected');
        return;
    }

    $.ajax(url, {
        type: 'POST',
        dataType: "json",
        data: data,
        success: function (response) {
            if(response.status) {
                calendar.refetchEvents();// refresh calendar
                // clear input feilds
                $('#createCalendarSelect').val("");
                $('#createTitleInput').val("");
                $('#createDescriptionInput').val("");
                $('#createStartDateInput').val("");
                $('#createStartTimeInput').val("");
                $('#createEndDateInput').val("");
                $('#createEndTimeInput').val("");
                $('#createAllDayCheck').prop('checked', false);
                // hide dialog box
                $('#createEventModal').modal('hide');
            }
            else {
                alert("Error: " + response.message);
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            alert('Error' + errorMessage);
        },
        });
});

function getEventInfo(eventID, eventType) {
    var url;
    if(eventType === 'user_events'){
        url = '../UserCalendar/getUserEventInfo.php';
    }
    else if(eventType === 'course_events'){
        url = '../CourseCalendar/getCourseEventInfo.php';
    }
    else{
        alert("Error: Invalid event type");
        return;
    }
    $.ajax({
        type: "POST",
        url: url,
        data: {
            event_ID: eventID,
        },
        dataType: "json",
        success: function (response) {
            if(response.status) {
                // set data in input feilds
                var eventInfo = response.data;
                // initialize start and end into Date objects to convert from UTC to local
                var startDateTime =  new Date(response.data.start + " UTC");
                var endDateTime =  new Date(response.data.end + " UTC");
                // dateTime formaters to properly format date and time for input fields
                dateFormat = new Intl.DateTimeFormat(['en-CA'],  {year: 'numeric', month: 'numeric', day: 'numeric'});
                timeFormat = new Intl.DateTimeFormat(['en-CA'],  {hour12: false, hour: 'numeric', minute: 'numeric', second: 'numeric'});

                // testing lines remove later
                console.log(startDateTime);
                console.log(endDateTime);
                console.log(dateFormat.format(startDateTime) + "  " + timeFormat.format(startDateTime));
                console.log(dateFormat.format(endDateTime) + "  " + timeFormat.format(endDateTime));

                $('#updateTitleInput').val(eventInfo.title);
                $('#updateDescriptionInput').val(eventInfo.description);
                $('#updateStartDateInput').val(dateFormat.format(startDateTime));
                $('#updateStartTimeInput').val(timeFormat.format(startDateTime));
                $('#updateEndDateInput').val(dateFormat.format(endDateTime));
                $('#updateEndTimeInput').val(timeFormat.format(endDateTime));
                var ischecked = eventInfo.allDay == 1 ? true : false
                $('#updateAllDayCheck').prop('checked', ischecked);
                // set function of update button
                $("#updateEventBtn").attr('onclick', `updateEvent(${response.data.event_ID}, '${eventType}');`)
                $("#deleteEventBtn").attr('onclick', `deleteEvent(${response.data.event_ID}, '${eventType}');`)
                // show dialog box
                $('#updateEventModal').modal('show');
            }
            else {
                alert("Error: " + response.message);
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            alert('Error' + errorMessage);
        },
    });
}

function updateEvent(eventID, eventType) {
    var url;
    if(eventType === 'user_events'){
        url = '../UserCalendar/updateUserEvent.php';
    }
    else if(eventType === 'course_events'){
        url = '../CourseCalendar/updateCourseEvent.php';
    }
    else{
        alert("Error: Invalid event type");
        return;
    }
    $.ajax({
        type: "POST",
        url: url,
        data: {
            event_ID: eventID,
            title: $('#updateTitleInput').val(),
            description: $('#updateDescriptionInput').val(),
            startDate: $('#updateStartDateInput').val(),
            startTime: $('#updateStartTimeInput').val(),
            endDate: $('#updateEndDateInput').val(),
            endTime: $('#updateEndTimeInput').val(),
            timeZoneOffset: new Date().getTimezoneOffset(),
            allDay: $('#updateAllDayCheck').is(':checked'),
        },
        dataType: "json",
        success: function (response) {
            if(response.status) {
                calendar.refetchEvents();// refresh calendar
                $('#updateEventModal').modal('hide');// hide dialog box
                // clear input feilds
                $('#updateTitleInput').val("");
                $('#updateDescriptionInput').val("");
                $('#updateStartDateInput').val("");
                $('#updateStartTimeInput').val("");
                $('#updateEndDateInput').val("");
                $('#updateEndTimeInput').val("");
                $('#updateAllDayCheck').prop('checked', false);
            }
            else {
                calendar.refetchEvents();// refresh calendar
                alert("Error: " + response.message);// display error message
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            alert('Error' + errorMessage);
        },
    });

}

function deleteEvent(eventID, eventType) {
    var url;
    if(eventType === 'user_events'){
        url = '../UserCalendar/deleteUserEvent.php';
    }
    else if(eventType === 'course_events'){
        url = '../CourseCalendar/deleteCourseEvent.php';
    }
    else{
        alert("Error: Invalid event type");
        return;
    }
    $.ajax(url, {
        type: 'POST',
        data: {
            eventID: eventID,
        },
        dataType: "json",
        success: function (response) {
            if(response.status) {
                calendar.refetchEvents();// refresh calendar
                $('#updateEventModal').modal('hide');// hide dialog box
                // clear input feilds
                $('#updateTitleInput').val("");
                $('#updateDescriptionInput').val("");
                $('#updateStartDateInput').val("");
                $('#updateStartTimeInput').val("");
                $('#updateEndDateInput').val("");
                $('#updateEndTimeInput').val("");
                $('#updateAllDayCheck').prop('checked', false);
            }
            else {
                calendar.refetchEvents();// refresh calendar
                alert("Error: " + response.message);// display error message
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            alert('Error' + errorMessage);
        },
    });
}
