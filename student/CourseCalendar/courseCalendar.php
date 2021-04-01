<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.css" integrity="sha256-HDFjvqItXdjW7TEM0cjN/9o9CRPkpo5hmGtd6AqN124=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.css" integrity="sha256-Nt1jjcb7BjpIGL9BEJjnZN9sySJXdYIvyBhMoao3fug=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap@4.4.2/main.min.css" integrity="sha256-NIDh3N3hofSVGAnBXXxlujR74v6h0qESZfZB4lr8Bi8=" crossorigin="anonymous">
    <script> const course_ID=<?php echo $_GET['id']; ?>; </script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.js" integrity="sha256-vKWDsV+KstPI228DJ2y/iAqpZH2xkL2zTIQmF6utWz8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.js" integrity="sha256-6JivCGoW2sfLWaGwe4RFxtRxMAo5iVJTsxsWnlmyQXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.4.2/main.min.js" integrity="sha256-XFnoZDDpI6fxEXDllfegk/UxTEq0/j8MhCv26cJ9Y0I=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap@4.4.2/main.min.js" integrity="sha256-cZnGBJb4L6wB6Ti/r+UQlCuAfGyaOYPFwkXc3pIPn4Y=" crossorigin="anonymous"></script>
    <script src="./courseCalendar.js" defer></script>

  </head>
  <body class="container mt-3 bg-dark text-light" >

    <div id='calendar' class="table-dark"></div>
    
    <!-- create new event Modal -->
    <div class="modal fade text-dark" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createEventModalLabel">Create new event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="event-modal-body">
            <form>
              <div class="form-group">
                <label for="titleInput">Title:</label>
                <input type="text" class="form-control" id="titleInput" name="title">
              </div>
              <div class="form-group">
                <label for="descriptionInput">Description:</label>
                <textarea class="form-control" id="descriptionInput" name="description" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="startDateInput">Start Date:</label>
                <input type="date" class="form-control" id="startDateInput" name="startDate" value="2020-01-01">
              </div>
              <div class="form-group">
                <label for="startTimeInput">Start Time:</label>
                <input type="time" class="form-control" id="startTimeInput" name="startTime" value="12:00">
              </div>
              <div class="form-group">
                <label for="endDateInput">End Date:</label>
                <input type="date" class="form-control" id="endDateInput" name="endDate" value="2020-01-01">
              </div>
              <div class="form-group">
                <label for="endTimeInput">End Time:</label>
                <input type="time" class="form-control" id="endTimeInput" name="endTime" value="12:00">
              </div>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="allDayCheck" name="allDay" value="allDay">
                <label class="custom-control-label" for="allDayCheck">All Day</label>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-target="#createEventModal">Cancel</button>
            <button type="button" class="btn btn-primary" id="createEventBtn">Create Event</button>
          </div>
        </div>
      </div>
    </div>
    <!-- create new event Modal End -->

    <!-- Event details Modal -->
    <div class="modal fade text-dark" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eventDetailsTitle">event Title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="event-modal-body">
            <h6>Description</h6>
            <p id="eventDetailsDescription"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-target="#eventDetailsModal">Cancel</button>
            <button type="button" class="btn btn-danger" id="deleteEventBtn">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Event details Modal End -->
    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="./courseAjax.js"></script>
  </body>
</html>
