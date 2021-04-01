function ToHome() {
	var active2 = document.getElementsByClassName("active2");


	active2[0].classList.add("hidden2");
	active2[0].classList.remove("active2");

	var target = document.getElementById("homepage");
	target.classList.add("active2");
	target.classList.remove("hidden2");



	var active = document.getElementsByClassName("active");


	active[1].classList.remove("active");

	var target = document.getElementById("homeLink");
	target.classList.add("active");

}


function ToQuiz() {
	var active2 = document.getElementsByClassName("active2");


	active2[0].classList.add("hidden2");
	active2[0].classList.remove("active2");

	var target = document.getElementById("quizzes");
	target.classList.add("active2");
	target.classList.remove("hidden2");



	var active = document.getElementsByClassName("active");


	active[1].classList.remove("active");

	var target = document.getElementById("quizLink");
	target.classList.add("active");

}

function ToCalender() {
	var active2 = document.getElementsByClassName("active2");


	active2[0].classList.add("hidden2");
	active2[0].classList.remove("active2");

	var target = document.getElementById("Calender");
	target.classList.add("active2");
	target.classList.remove("hidden2");



	var active = document.getElementsByClassName("active");


	active[1].classList.remove("active");

	var target = document.getElementById("calenderLink");
	target.classList.add("active");

}



function ToAllQuestions() {
	var active2 = document.getElementsByClassName("active3");


	active2[0].classList.add("hidden3");
	active2[0].classList.remove("active3");

	var target = document.getElementById("allQuestions");
	target.classList.add("active3");
	target.classList.remove("hidden3");



	var active = document.getElementsByClassName("active");


	active[2].classList.remove("active");

	var target = document.getElementById("allQuestionsLink");
	target.classList.add("active");

}

function ToAddQuestion() {
	var active2 = document.getElementsByClassName("active3");


	active2[0].classList.add("hidden3");
	active2[0].classList.remove("active3");

	var target = document.getElementById("addQuestion");
	target.classList.add("active3");
	target.classList.remove("hidden3");



	var active = document.getElementsByClassName("active");


	active[2].classList.remove("active");

	var target = document.getElementById("addQuestionLink");
	target.classList.add("active");

}

function ToEditQuestion() {
	var active2 = document.getElementsByClassName("active3");


	active2[0].classList.add("hidden3");
	active2[0].classList.remove("active3");

	var target = document.getElementById("editQuestion");
	target.classList.add("active3");
	target.classList.remove("hidden3");



	var active = document.getElementsByClassName("active");


	active[2].classList.remove("active");

	var target = document.getElementById("editQuestionLink");
	target.classList.add("active");

}
