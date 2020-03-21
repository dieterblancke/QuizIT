@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-content-center justify-content-between mb-2">
            <h1>My Quizits</h1>

            <div>
                <a href="{{ route('quizits.create') }}" class="btn btn-primary">Create new QuizIT</a>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th class="text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($quizits as $quizit)
                <tr>
                    <td>{{ $quizit->name }}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
