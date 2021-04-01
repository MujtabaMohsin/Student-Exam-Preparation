
var clicked = null;// stores the last event clicked
var calendarEl;
var calendar;
var eventSources = [// event sources for the calendar
    {
        url: '../UserCalendar/getUserEvents.php',
        method: 'POST',
        extraParams: {
            user_ID: user_ID,
        },
        failure: function() {
            alert('there was an error while fetching user events!');
        },
        color: 'royalblue',
    },
    {
        url: '../CourseCalendar/getCourseEvents.php',
        method: 'POST',
        extraParams: {
            course_ID: course_ID,
        },
        failure: function() {
            alert('there was an error while fetching course events!');
        },
        color: 'green',
    }
];
// add createCalendarSelect option
$("#createCalendarSelect").append(new Option('Personal Calendar', ['user', user_ID]));
$("#createCalendarSelect").append(new Option('Course Calendar', ['course', course_ID]));

document.addEventListener('DOMContentLoaded', function() {
    calendarEl = document.getElementById('calendar');
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

    calendar.render();
});
