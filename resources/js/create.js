"use strict";

let quizQuestions = [];

document.addEventListener('DOMContentLoaded', init);

function init() {
    document.querySelector("#questionForm").addEventListener("submit", createQuestion);
    document.querySelector("#submitQuiz").addEventListener("click", submitQuiz);
}

function createQuestion(e) {
    e.preventDefault();

    let question = document.querySelector("#question");
    let answers = document.querySelector("#answers");

    if (question.value.length !== 0 && answers.value.length !== 0) {
        let questionValue = question.value;
        let table = document.querySelector("#questions");
        let answerArray = answers.value.split("\n");

        let toAdd = "<tr>" +
            "<td>" + questionValue + "</td>" +
            "<td>" +
            "<ul>";
        for (let i = 0; i < answerArray.length; i++) {
            toAdd += "<li>" + answerArray[i] + "</li>";
        }
        toAdd += "</ul>" +
            "</td>";

        let question = {
            "question": questionValue,
            "answers": answerArray
        };

        quizQuestions.push(question);

        table.innerHTML += toAdd;
        question.value = null;
        answers.value = null;

        document.querySelector("#closeModel").click();
    }
}

function submitQuiz(e) {
    e.preventDefault();

    console.log(quizQuestions);
}

