
var clicked = null;// stores the last event clicked
var calendarEl;
var calendar;
var eventSources = [{
    url: '../UserCalendar/getUserEvents.php',
    method: 'POST',
    extraParams: {
        user_ID: user_ID,
    },
    failure: function() {
        alert('there was an error while fetching user events!');
    },
    color: 'royalblue',
}];
// add createCalendarSelect option
$("#createCalendarSelect").append(new Option('Personal Calendar', ['user', user_ID]));

document.addEventListener('DOMContentLoaded', function() {

    calendarEl = document.getElementById('calendar');
    $.ajax('../UserCalendar/getUserCourses.php', {
        type: 'POST',
        dataType: "json",
        data: {
            user_ID: user_ID,
        }, // data to submit
        success: function (data, status, xhr) {
            if(data.status){
                // iterator over courses
                for (course of data.courses){
                    // add option to createCalendarSelect
                    $("#createCalendarSelect").append(new Option(course.description, ['course', course.ID]));
                    // add course to event sources
                    eventSources.push({
                        url: '../CourseCalendar/getCourseEvents.php',
                        method: 'POST',
                        extraParams: {
                            course_ID: course.ID,
                        },
                        failure: function() {
                            alert('there was an error while fetching course events!');
                        },
                        color: 'green',
                    });
                }
                // create calendar object
                calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [ 'dayGrid', 'interaction', 'bootstrap', ],
                    themeSystem: 'bootstrap',
                    eventSources: eventSources,
                    dateClick: function(info) {// event when a date is clicked
                        $('#createStartDateInput').val(info.dateStr);
                        $('#createStartTimeInput').val("12:00");
                        $('#createEndDateInput').val(info.dateStr);
                        $('#createEndTimeInput').val("12:00");
                        $('#createEventModal').modal('toggle');
                    },
                    eventClick: function(info) {// event when an event is clicked
                        info.jsEvent.preventDefault();// prevent default action
                        // change the border color
                        info.el.style.borderColor = "red";
                        if (clicked !== null){
                            clicked.el.style.borderColor = clicked.el.style.backgroundColor;
                        }
                        clicked = info;
                        getEventInfo(clicked.event.extendedProps.event_ID, clicked.event.extendedProps.type);// load event update dialog
                        if (info.event.url) {// open url linked to event if set
                            window.open(info.event.url);
                        }
                    },
                });
                
                calendar.render();// render the calendar on screen
            }
            else{
                alert('Error: ' + data.message);
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            alert('Error' + errorMessage);
        },
    });
    
});

// get the users courses and add an eventSourse for each
function getEventSources(){
    // Synchronous calls should not be done with ajax but for now it is fine
    $.ajax('../UserCalendar/getUserCourses.php', {
        type: 'POST',
        dataType: "json",
        async: false, // disable asynchronous execution  
        data: {
            user_ID: user_ID,
        }, // data to submit
        success: function (data, status, xhr) {
            if(data.status){
                for (course of data.courses){
                    eventSources.push({
                        url: '../CourseCalendar/getCourseEvents.php',
                        method: 'POST',
                        extraParams: {
                            course_ID: course,
                        },
                        failure: function() {
                            alert('there was an error while fetching course events!');
                        },
                        color: 'green',
                    });
                }
            }
            else{
                alert('Error: ' + data.message);
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            alert('Error' + errorMessage);
        },
    });
};
