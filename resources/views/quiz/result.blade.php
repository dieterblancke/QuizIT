@extends('layouts.app')

@section('title', "Join")

@section('content')
    <h1 class="text-center">Your Results</h1>

    <h3 class="mb-5 text-center">
        <strong>Score:</strong> {{ $score }}
    </h3>

    <ul class="questions list-unstyled">
        @foreach($results as $result)
            <li>
                <h2>{{ $result->question->question }}</h2>

                @foreach($result->answers as $answer)
                    <div class="form-group px-2 "
                         @if($answer->correct) style="background: mediumseagreen;" @elseif(!$answer->correct && $result->givenAnswer === $answer->answer) style="background: rgba(205,92,92,0.82);" @endif>
                        <input type="{{ $result->question->getCorrectAnswerCount() > 1 ? 'checkbox' : 'radio' }}"
                               @if($answer->correct) checked @endif
                               disabled/>
                        <label class="mt-2">{{ $answer->answer }}
                            @if($result->givenAnswer === $answer->answer) <strong>YOUR ANSWER</strong> @endif
                        </label>
                    </div>
                @endforeach
            </li>
        @endforeach
    </ul>
@endsection
