"use strict";

document.addEventListener("DOMContentLoaded", init);

function init() {
    const waiting = document.querySelector('#waiting');

    if (!waiting) {
        return
    }

    document.querySelector("#copy_link").addEventListener("click", copyLink);
    document.getElementById("quiz_url").innerText = window.location;
    loadJoke();
    startTimer();
}

function loadJoke() {
    const url = "/api/joke";

    axios.get(url)
        .then(function (response) {
            document.querySelector("#joke").innerText = response.data.joke;
            document.querySelector("#punchline").innerText = response.data.punchline;
        })
        .catch(function (response) {
            console.error(response);
        })
}

function startTimer() {
    // window.setInterval(getJoke, 30000);
    let count = 0;
    setInterval(function () {
        count += 1;

        document.querySelector('.progress-bar').style = 'width: ' + count + '%';
    }, 80);

    setTimeout(function() {
        document.querySelector('#waiting').classList.add('d-none');
        document.querySelector('#questionlist').classList.remove('d-none');
        document.querySelector('#app').classList.remove('loading');
    }, 10000);
}

function copyLink(e) {
    e.preventDefault();
    const quiz_url = document.getElementById("quiz_url");

    quiz_url.select();
    quiz_url.setSelectionRange(0, 99999);
    document.execCommand("copy");
}
