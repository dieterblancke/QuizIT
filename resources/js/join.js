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

    const join_key = document.querySelector('#join_key').value;
    const url = "/join"

    const request = {
        join_key: join_key
    };

    axios["post"](url, request, {
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        }
    })
        .then(function (response) {
            Swal.fire(
                'Join Quiz',
                response.data.message,
                response.data.status
            )
                .then(function () {
                    window.location = '/quiz/' + join_key;
                })
        })
        .catch(function (json) {
            console.error(json);
        })
}
