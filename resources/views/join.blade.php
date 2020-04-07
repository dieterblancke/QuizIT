@extends('layouts.app')

@section('title', "Join")

@section('content')
    <h1>Join quiz</h1>
    <h2>Supply<br />QuizID</h2>

    <form action="{{route("join")}}" method="POST" class="row">
        <div class="col-6">
            <input type="text" min="0" name="QuizID" id="QuizID">
        </div>
        <div class="col-6">
            <input type="submit" value="QuizIN" class="btn btn-secondary">
        </div>
    </form>
@endsection
