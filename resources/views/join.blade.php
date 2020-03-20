@extends('layouts.app')

@section('title', "Join")

@section('content')
    <h1>Join quiz</h1>
    <h2>Supply<br />QuizID</h2>

    <form action="{{route("join")}}" method="POST">
        <input type="number" min="0" name="QuizID" id="QuizID">
        <input type="submit" value="QuizIN">
    </form>
@endsection
