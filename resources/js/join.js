"use strict";

document.addEventListener('DOMContentLoaded', init);

function init() {
    const joinForm = document.querySelector('#join');

    if (!joinForm) {
        return;
    }

    document.querySelector('#join').addEventListener("submit", joinQuiz)
}

function joinQuiz(e) {
    e.preventDefault();

    const quizID = document.querySelector('#quizID').value;
    const url = "/join"

    const request = {
        quizID: quizID
    };

    axios["post"](url, request, {
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        }
    })
        .then(function (response) {
            Swal.fire(
                'Join Quis',
                response.data.message,
                response.data.status
            )
        })
        .catch(function (json) {
            console.error(json);
        })
}
