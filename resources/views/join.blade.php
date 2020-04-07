@extends('layouts.app')

@section('title', "Join")

@section('content')
    <h1>Join quiz</h1>

    <form action="{{route("join")}}" method="POST" class="row">
        <div class="col-6">
            <label for="quizid">Quiz ID</label>
            <input type="text" min="0" name="quizid" id="quizid" class="form-control">
        </div>
        <div class="col-6">
            <input type="submit" value="QuizIN" class="btn btn-secondary">
        </div>
    </form>
@endsection
