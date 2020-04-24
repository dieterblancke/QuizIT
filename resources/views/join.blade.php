@extends('layouts.app')

@section('title', "Join")

@section('content')
    <h1>Join quiz</h1>

    <form action="{{route("join")}}" method="POST">
        <div class="form-group">
            <label for="quizid">Quiz ID</label>
            <input type="text" min="0" name="quizid" id="quizid" class="form-control">
        </div>
        <div class="form-group mt-2">
            <input type="submit" value="QuizIN" class="btn btn-primary">
        </div>
    </form>
@endsection
