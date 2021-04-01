<div class="container mt-3">
  <!-- Include bootstrap Css beforethis point loads -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.css" integrity="sha256-HDFjvqItXdjW7TEM0cjN/9o9CRPkpo5hmGtd6AqN124=" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.css" integrity="sha256-Nt1jjcb7BjpIGL9BEJjnZN9sySJXdYIvyBhMoao3fug=" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap@4.4.2/main.min.css" integrity="sha256-NIDh3N3hofSVGAnBXXxlujR74v6h0qESZfZB4lr8Bi8=" crossorigin="anonymous">
  <script> user_ID=<?php echo $_SESSION['userID'];?>; </script>
  <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.js" integrity="sha256-vKWDsV+KstPI228DJ2y/iAqpZH2xkL2zTIQmF6utWz8=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.js" integrity="sha256-6JivCGoW2sfLWaGwe4RFxtRxMAo5iVJTsxsWnlmyQXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.4.2/main.min.js" integrity="sha256-XFnoZDDpI6fxEXDllfegk/UxTEq0/j8MhCv26cJ9Y0I=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap@4.4.2/main.min.js" integrity="sha256-cZnGBJb4L6wB6Ti/r+UQlCuAfGyaOYPFwkXc3pIPn4Y=" crossorigin="anonymous"></script>
  <script src="../UserCalendar/userCalendar.js" defer></script>
  
  <h2>Calendar</h2>

  <div id='calendar' class="table bg-light table-bordered p-1"></div>
  
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
              <label for="createCalendarSelect">Select</label>
              <select class="form-control custom-select" id="createCalendarSelect" name="calendar" required>
                <option value="">Select a calendar</option>
              </select>
            </div>
            <div class="form-group">
              <label for="createTitleInput">Title:</label>
              <input type="text" class="form-control" id="createTitleInput" name="title">
            </div>
            <div class="form-group">
              <label for="createDescriptionInput">Description:</label>
              <textarea class="form-control" id="createDescriptionInput" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="createStartDateInput">Start Date:</label>
              <input type="date" class="form-control" id="createStartDateInput" name="startDate" value="2020-01-01">
            </div>
            <div class="form-group">
              <label for="createStartTimeInput">Start Time:</label>
              <input type="time" class="form-control" id="createStartTimeInput" name="startTime" value="12:00">
            </div>
            <div class="form-group">
              <label for="createEndDateInput">End Date:</label>
              <input type="date" class="form-control" id="createEndDateInput" name="endDate" value="2020-01-01">
            </div>
            <div class="form-group">
              <label for="createEndTimeInput">End Time:</label>
              <input type="time" class="form-control" id="createEndTimeInput" name="endTime" value="12:00">
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="createAllDayCheck" name="allDay" value="allDay">
              <label class="custom-control-label" for="createAllDayCheck">All Day</label>
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

  <!-- update event Modal -->
  <div class="modal fade text-dark" id="updateEventModal" tabindex="-1" role="dialog" aria-labelledby="updateEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateEventModalLabel">Update event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="event-modal-body">
          <form>
            <div class="form-group">
            <div class="form-group">
              <label for="updateTitleInput">Title:</label>
              <input type="text" class="form-control" id="updateTitleInput" name="title">
            </div>
            <div class="form-group">
              <label for="updateDescriptionInput">Description:</label>
              <textarea class="form-control" id="updateDescriptionInput" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="updateStartDateInput">Start Date:</label>
              <input type="date" class="form-control" id="updateStartDateInput" name="startDate" value="2020-01-01">
            </div>
            <div class="form-group">
              <label for="updateStartTimeInput">Start Time:</label>
              <input type="time" class="form-control" id="updateStartTimeInput" name="startTime" value="12:00">
            </div>
            <div class="form-group">
              <label for="updateEndDateInput">End Date:</label>
              <input type="date" class="form-control" id="updateEndDateInput" name="endDate" value="2020-01-01">
            </div>
            <div class="form-group">
              <label for="updateEndTimeInput">End Time:</label>
              <input type="time" class="form-control" id="updateEndTimeInput" name="endTime" value="12:00">
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="updateAllDayCheck" name="allDay" value="allDay">
              <label class="custom-control-label" for="updateAllDayCheck">All Day</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" data-target="#updateEventModal">Cancel</button>
          <button type="button" class="btn btn-danger" id="deleteEventBtn">Delete</button>
          <button type="button" class="btn btn-primary" id="updateEventBtn">Update Event</button>
        </div>
      </div>
    </div>
  </div>
  <!-- update event Modal End -->
  

  <!-- Include JQuery before this point loads -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="../UserCalendar/userAjax.js"></script>
</div>