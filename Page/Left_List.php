<?php $val = $_GET["id"];?>
<div class="container-fluid p-0">
	<div class="row w-100 m-0 xx">
		<div class="col-1.5 p-0">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">


				<a class="nav-link active" id="homepageTab" href="/new_Exam/student/course/Course-Homepage.php?id=<?php echo $val?>">Homepage</a>


				<a class="nav-link" id="questionBankTab" href="/new_Exam/student/QuestionBank/ViewQuestionBank.php?id=<?php echo $val?>">Question Bank</a>

				<a class="nav-link" id="quizzesTab" href="/new_Exam/student/Quizzes/ViewQuizzes.php?id=<?php echo $val?>">Quizzes</a>

				<a class="nav-link" id="flashcardsTab" href="/new_Exam/student/Flash_Cards/ViewFlashCards.php?id=<?php echo $val?>">Flashcards</a>

				<a class="nav-link" id="notesTab" href="/new_Exam/student/notes/notes.php?id=<?php echo $val?>">Notes</a>

				<a class="nav-link" id="summaryTab" href="/new_Exam/student/summary/summary.php?id=<?php echo $val?>">Summeries</a>

				<a class="nav-link" id="resourcesTab" href="/new_Exam/student/resources/resources.php?id=<?php echo $val?>">Resources</a>

				<a class="nav-link" id="discussionTab" href="/new_Exam/student/Discussion-board/discussion-board.php?id=<?php echo $val?>">Discussion Board</a>

				<a class="nav-link" id="calendarTab" href="/new_Exam/student/CourseCalendar/?id=<?php echo $val?>">Calendar</a>

				<a class="nav-link" id="ToDoTab" href="/new_Exam/student/CourseToDoList/?id=<?php echo $val?>">To Do List</a>




			</div>
		</div>
