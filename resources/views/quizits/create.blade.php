@extends('layouts.app')

@section('title', "Create")

@section('content')
    <h1>Create your quiz</h1>
    <div class="form-group">
        <label for="name">Quizit Name</label>
        <input type="text" class="form-control" id="name" name="name" />
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <h2>Questions & Answers</h2>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Create new question
        </button>
    </div>
    <table class="table table-bordered" id="questions">
        <thead>
        <tr>
            <th>Question</th>
            <th>Answers</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <button type="button" class="btn btn-primary" id="submitQuiz">
        Submit quiz
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="questionForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Question</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="question">Question:</label>
                            <input class="form-control" type="text" id="question"/>
                        </div>
                        <div class="form-group">
                            <label for="answerAmount">Amount of answers:</label>
                            <input class="form-control" type="number" id="answerAmount"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="closeModel" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input id="submitQuestion" type="submit" class="btn btn-primary" value="Next ->">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
