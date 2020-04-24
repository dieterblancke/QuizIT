"use strict"

document.addEventListener("DOMContentLoaded", init)

function init() {
    const waiting = document.querySelector('#waiting');

    if (!waiting) {
        return
    }

    document.querySelector("#copy_link").addEventListener("click", copyLink);
    document.getElementById("quiz_url").innerText = window.location;
    getJoke();
    startTimer();
}

function getJoke() {
    const url = "/api/joke";

    axios["get"](url)
        .then(function (response) {
            document.querySelector("#joke").innerText = response.data.joke;
            document.querySelector("#punchline").innerText = response.data.punchline;
        })
        .catch(function (response) {
            console.error(response);
        })
}

function startTimer() {
    const intervalID = window.setInterval(getJoke, 30000);
}

function copyLink(e) {
    e.preventDefault();
    const quiz_url = document.getElementById("quiz_url");

    quiz_url.select();
    quiz_url.setSelectionRange(0, 99999);
    document.execCommand("copy");
}
