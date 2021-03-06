"use strict";

let quizitId;
let quizQuestions = [];
let mode = "create";
let currentEditIndex = undefined;

document.addEventListener('DOMContentLoaded', init);

function init() {
    const questionsTable = document.querySelector('#questions');

    if (!questionsTable) {
        return;
    }
    if (questionsTable.hasAttribute('data-quizit-id')) {
        // this means that this is the edit form
        quizitId = questionsTable.getAttribute('data-quizit-id');
        mode = "edit";

        loadExistingQuestions();
    }

    document.querySelector("#questionForm").addEventListener("submit", createQuestion);
    document.querySelector("#submitQuiz").addEventListener("click", submitQuiz);
}

function loadExistingQuestions() {
    const questionRows = document.querySelectorAll('#questions tbody tr');

    for (let i = 0; i < questionRows.length; i++) {
        const quizQuestion = {};
        const questionRow = questionRows[i];
        quizQuestion['question'] = questionRow.querySelector('.question').innerText;
        quizQuestion['answers'] = [];

        const answersUl = questionRow.querySelectorAll('.answers li');
        for (let j = 0; j < answersUl.length; j++) {
            const answerLi = answersUl[j];
            const answer = answerLi.querySelector('span').innerText;
            const correct = answerLi.getAttribute('data-correct') === 'true';

            quizQuestion['answers'].push({answer, correct})
        }

        quizQuestions.push(quizQuestion);

        questionRow.querySelector('.edit').addEventListener('click', editQuestion);
        questionRow.querySelector('.delete').addEventListener('click', deleteQuestion);
    }
}

function createQuestion(e) {
    e.preventDefault();
    let question = document.querySelector("#question").value;

    if (question.length !== 0) {
        let amount = parseInt(document.querySelector("#answerAmount").value) ?? 4;

        if (amount < 1) {
            amount = 1;
        }
        if (amount > 7) {
            amount = 7;
        }

        quizQuestions.push({
            "question": question,
            "answers": []
        });

        document.querySelector("#question").value = null;
        document.querySelector("#closeModel").click();
        openAnswersModal(
            currentEditIndex !== undefined ? currentEditIndex : quizQuestions.length - 1,
            amount
        );
        currentEditIndex = undefined;
    }
}

function openAnswersModal(questionId, amount) {
    const steps = [];
    const swalQuestions = [];
    let currentId = 0;

    for (let i = 0; i < amount; i++) {
        const currentAnswer =
            quizQuestions[questionId].answers.length > 0 && quizQuestions[questionId].answers.length > i
                ? quizQuestions[questionId].answers[i]
                : undefined;

        const questionData = {
            title: 'Answer ' + (i + 1),
            html: `<input type="checkbox" id="correct${i}" ${currentAnswer && currentAnswer.correct ? "checked" : ""}>
                   <label for="correct${i}">Is this a correct answer?</label>`,
        };

        if (currentAnswer) {
            questionData['inputValue'] = currentAnswer.answer;
        }

        steps.push((i + 1) + '');
        swalQuestions.push(questionData);
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
            loadTable();
        }
    })
}

function loadTable() {
    $("#questions tbody").empty();

    for (let i = 0; i < quizQuestions.length; i++) {
        addToTable(quizQuestions[i]);
    }
}

function addToTable(obj) {
    const question = obj.question;
    const answers = obj.answers;

    const tbody = document.querySelector("#questions tbody");
    const tr = document.createElement('tr');
    tr.setAttribute('data-row-index', quizQuestions.length + '');

    const questionTd = document.createElement('td');
    questionTd.classList.add("question");
    questionTd.innerText = question;

    const answersTd = document.createElement('td');
    answersTd.classList.add("answers");
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
    let url = mode === "create" ? "/quizits/create" : "/quizits/update/" + quizitId;

    const request = {
        name: document.querySelector('#name').value,
        questions: quizQuestions,
    };

    axios[mode === "create" ? "post" : "put"](url, request, {
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        }
    })
        .then(function (response) {
            Swal.fire(
                'QuizIN',
                response.data.message,
                response.data.status,
            ).then(function () {
                if (response.data.status === 'success') {
                    window.location = '/quizits/';
                }
            });
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

    Swal.fire({
        icon: 'question',
        title: 'QuestionOUT',
        text: 'Are you sure you want to remove this question?',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        showCancelButton: true,
    }).then(function (result) {
        if (result.value) {
            const tr = e.target.closest('tr');
            const index = parseInt(tr.getAttribute('data-row-index'));

            quizQuestions.splice(index, 1);
            tr.parentElement.removeChild(tr);
        }
    });
}

function editQuestion(e) {
    e.preventDefault();

    const tr = e.target.closest('tr');
    const index = parseInt(tr.getAttribute('data-row-index'));

    document.querySelector("#question").value = tr.querySelector('.question').innerText;
    document.querySelector("#answerAmount").value = quizQuestions[index].answers.length;

    document.querySelector("#create-question-button").click();
    currentEditIndex = index;
}
