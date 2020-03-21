"use strict";

let quizQuestions = [];

document.addEventListener('DOMContentLoaded', init);

function init() {
    document.querySelector("#questionForm").addEventListener("submit", createQuestion);
    document.querySelector("#submitQuiz").addEventListener("click", submitQuiz);
}

function createQuestion(e) {
    e.preventDefault();

    let question = document.querySelector("#question").value;
    let answers = document.querySelector("#answers");

    if (question.length !== 0 && answers.value.length !== 0) {
        let table = document.querySelector("#questions");
        let answerArray = answers.value.split("\n");

        let toAdd = "<tr id='question_" + quizQuestions.length + "'>" +
            "<td>" + question + "</td>" +
            "<td>" +
            "<ul>";
        for (let i = 0; i < answerArray.length; i++) {
            toAdd += "<li>" + answerArray[i] + "</li>";
        }
        toAdd += "</ul>" +
            "<td><a id='question_" + quizQuestions.length + "' class='btn btn-primary'>Delete question</a></td></td>";

        const questionJSON = {
            "question": question,
            "answers": answerArray
        };

        table.innerHTML += toAdd;
        document.querySelector("#question_" + quizQuestions.length).addEventListener("click", deleteQuestion)

        quizQuestions.push(questionJSON);

        document.querySelector("#question").value = null;
        answers.value = null;

        document.querySelector("#closeModel").click();
    }
}

function submitQuiz(e) {
    e.preventDefault();
    let url = "/quizits/create";

    axios.post(url, quizQuestions, {
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        }
    })
        .then(function (json) {
            console.log(json);
            Swal.fire(
                'QuizIN',
                'Your quiz was saved',
                'success'
            );
        })
        .catch(function (json) {
            console.error(json);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        })
}

function deleteQuestion(e) {
    e.preventDefault();

    console.log(e);
}
