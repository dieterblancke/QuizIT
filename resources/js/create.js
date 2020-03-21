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

    if (question.length !== 0) {
        let amount = parseInt(document.querySelector("#answerAmount").value) ?? 4;

        if (amount > 7) {
            amount = 7;
        }

        quizQuestions.push({
            "question": question,
            "answers": []
        });

        document.querySelector("#question").value = null;
        document.querySelector("#closeModel").click();
        openAnswersModal(quizQuestions.length - 1, amount);
    }
}

function openAnswersModal(questionId, amount) {
    const steps = [];
    const swalQuestions = [];
    let currentId = 0;

    for (let i = 0; i < amount; i++) {
        steps.push((i + 1) + '');
        swalQuestions.push({
            title: 'Answer ' + (i + 1),
            html: `<input type="checkbox" id="correct${i}">
                   <label for="correct${i}">Is this a correct answer?</label>`,
        });
    }

    Swal.mixin({
        input: 'text',
        confirmButtonText: 'Next &rarr;',
        showCancelButton: true,
        progressSteps: steps,
        preConfirm: function (answer) {
            const correct = document.querySelector("#correct" + currentId).checked;

            quizQuestions[questionId].answers[currentId] = {answer, correct};
            currentId++;
        }
    }).queue(swalQuestions).then((result) => {
        if (result.value) {
            addToTable(quizQuestions[questionId]);
        }
    })
}

function addToTable(obj) {
    const question = obj.question;
    const answers = obj.answers;

    const tbody = document.querySelector("#questions tbody");
    const tr = document.createElement('tr');
    tr.setAttribute('id', 'question_" + quizQuestions.length + "');

    const questionTd = document.createElement('td');
    questionTd.innerText = question;

    const answersTd = document.createElement('td');
    const answerUl = document.createElement('ul');

    for (let i = 0; i < answers.length; i++) {
        const answer = answers[i];
        const li = document.createElement('li');
        const span = document.createElement('span');

        li.setAttribute('data-correct', answer.correct);
        span.innerText = answer.answer;
        li.appendChild(span);
        answerUl.appendChild(li);
    }
    answersTd.appendChild(answerUl);

    const actionsTd = document.createElement('td');
    const actionsDiv = document.createElement('div');
    actionsDiv.className = 'actions';

    const editBtn = document.createElement('a');
    editBtn.className = 'btn btn-primary action action-warning edit';

    const editIcon = document.createElement('i');
    editIcon.className = 'fa fa-pencil';

    editBtn.appendChild(editIcon);
    editBtn.addEventListener('click', editQuestion);

    const deleteBtn = document.createElement('a');
    deleteBtn.className = 'btn btn-primary action action-danger delete';

    const deleteIcon = document.createElement('i');
    deleteIcon.className = 'fa fa-trash';

    deleteBtn.appendChild(deleteIcon);
    deleteBtn.addEventListener('click', deleteQuestion);

    actionsDiv.appendChild(editBtn);
    actionsDiv.appendChild(deleteBtn);
    actionsTd.appendChild(actionsDiv);

    tr.appendChild(questionTd);
    tr.appendChild(answersTd);
    tr.appendChild(actionsTd);
    tbody.appendChild(tr);
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

function editQuestion(e) {
    e.preventDefault();

    console.log(e);
}
