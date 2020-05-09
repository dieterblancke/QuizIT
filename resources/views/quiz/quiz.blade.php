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

        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
@endsection

@section('content')
    <section class="card text-center w-25 p-5" id="waiting">
        <h1 id="joke"></h1>
        <h2 id="punchline"></h2>
        <button id="copy_link" class="btn btn-primary mt-2" type="button">Copy Quiz Link</button>
        <textarea id="quiz_url"></textarea>

        <div class="progress mt-5">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 0"
                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </section>

    <section class="container shadow-lg card p-3 my-5 d-none" id="questionlist">
        <h1 class="text-center">{{ $quizit->name }}</h1>
        <form action="{{ route('quiz.submit', $quizit->id) }}" method="POST">
            @csrf
            <ul class="questions list-unstyled">
                @foreach($quizit->questions as $question)
                    <li>
                        <h2>{{ $question->question }}</h2>

                        @foreach($question->answers as $answer)
                            <div class="form-group">
                                <input type="{{ $question->getCorrectAnswerCount() > 1 ? 'checkbox' : 'radio' }}"
                                       id="answer_{{ $answer->id }}"
                                       name="question_{{ $question->id }}"
                                       value="{{ $answer->id }}"
                                       @if ($question->getCorrectAnswerCount() <= 1 && $loop->first) required @endif />
                                <label for="answer_{{ $answer->id }}">{{ $answer->answer }}</label>
                            </div>
                        @endforeach

                        @if(!$loop->last)
                            <hr/>
                        @endif
                    </li>
                @endforeach
            </ul>

            <input type="submit" class="btn btn-primary" value="Submit your answers"/>
        </form>
    </section>
@endsection

