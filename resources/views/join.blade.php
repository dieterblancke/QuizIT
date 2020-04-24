@extends('layouts.app')

@section('title', "Join")

@section('content')
    <h1>Join quiz</h1>

    <form id="join" action="{{route("join")}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="join_key">Quiz ID</label>
            <input type="text" min="0" name="join_key" id="join_key" class="form-control">
        </div>
        <div class="form-group mt-2">
            <input type="submit" value="QuizIN" class="btn btn-primary">
        </div>
    </form>
@endsection
