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

        <table id="quizits" class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Join key</th>
                <th class="text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($quizits as $quizit)
                <tr data-quizit-id="{{ $quizit->id }}">
                    <td>{{ $quizit->name }}</td>
                    <td>{{ $quizit->key ?? '' }}</td>
                    <td>
                        <div class="actions">
                            <a class="btn btn-primary action {{ $quizit->active ? 'action-danger stop' : 'action-success start' }}">
                                <i class="fa fa-{{ $quizit->active ? 'stop' : 'play' }}"
                                   style="font-size: 1.4rem"></i>
                            </a>
                            <a class="btn btn-primary action action-info" href="{{ route('quizits.results', $quizit->id) }}">
                                <i class="fa fa-bar-chart"></i>
                            </a>
                            <a class="btn btn-primary action action-warning edit" href="{{ route('quizits.edit', [$quizit->id]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-primary action action-danger delete" data-quizit-id="{{ $quizit->id }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <article>
            <h2>Caption</h2>

            <p>
                <i class="fa fa-play"></i>
                Activate your quiz
            </p>
            <p>
                <i class="fa fa-stop"></i>
                Deactivate your quiz
            </p>
            <p>
                <i class="fa fa-bar-chart"></i>
                See the results for your quiz
            </p>
            <p>
                <i class="fa fa-pencil"></i>
                Edit your quiz
            </p>
            <p>
                <i class="fa fa-trash"></i>
                Remove a quiz
            </p>
        </article>
    </div>
@endsection
