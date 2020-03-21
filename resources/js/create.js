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

        let toAdd = "<tr>" +
            "<td>" + question + "</td>" +
            "<td>" +
            "<ul>";
        for (let i = 0; i < answerArray.length; i++) {
            toAdd += "<li>" + answerArray[i] + "</li>";
        }
        toAdd += "</ul>" +
            "</td>";

        const questionJSON = {
            "question": question,
            "answers": answerArray
        };

        quizQuestions.push(questionJSON);

        table.innerHTML += toAdd;
        document.querySelector("#question").value = null;
        answers.value = null;

        document.querySelector("#closeModel").click();
    }
}

function submitQuiz(e) {
    e.preventDefault();
    let url = "/api/quizits/create";

    fetch(url, {
        method: "POST",
        body: JSON.stringify(quizQuestions)
    })
        .then(function (response) {
            return response.json();
        })
        .then(console.log)
        .catch(console.error)
}
