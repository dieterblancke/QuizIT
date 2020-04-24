@extends('layouts.quizLayout')

@section('title', "Quiz")

@section('style')
    <style>
        body, #app {
            width: 100%;
            height: 100%;

            animation: colorchange 15s infinite; /* animation-name followed by duration in seconds*/
            /* you could also use milliseconds (ms) or something like 2.5s */
            -webkit-animation: colorchange 15s infinite; /* Chrome and Safari */
        }

        @keyframes colorchange {
            0% {
                background: pink;
            }
            25% {
                background: yellow;
            }
            50% {
                background: lightblue;
            }
            75% {
                background: lightgreen;
            }
            100% {
                background: pink;
            }
        }

        @-webkit-keyframes colorchange {
            0% {
                background: pink;
            }
            25% {
                background: yellow;
            }
            50% {
                background: lightblue;
            }
            75% {
                background: lightgreen;
            }
            100% {
                background: pink;
            }
        }

        textarea {
            position: absolute;
            left: -10000px;
            opacity: 0;
        }

    </style>
@endsection

@section('content')
    <section class="card text-center w-25 p-5" id="waiting">
        <h1 id="joke"></h1>
        <h2 id="punchline"></h2>
        <button id="copy_link" class="btn btn-primary mt-2" type="button">Copy Quiz Link</button>
        <textarea id="quiz_url">Test</textarea>
    </section>
@endsection

