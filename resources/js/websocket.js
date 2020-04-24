import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.channel('quizits')
    .listen('QuizitStartEvent', (e) => {
        console.log(e);
    })
    .listen('QuizitTickEvent', (e) => {
        console.log(e);
    })
    .listen('QuizitFinishEvent', (e) => {
        console.log(e);
    });
