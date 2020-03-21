@extends('layouts.app')

@section('title', "Create")

@section('content')
    <h1>Create your quiz</h1>
    <h2>Your questions and answers</h2>
    <table id="questions">
        <tr>
            <th>Question</th>
            <th>Answers</th>
            <th>Actions</th>
        </tr>
    </table>

    <h2>Add question</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch Question Maker
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
                            <label for="answers">Answers:<small>(The first answer is the correct one)</small></label>
                            <textarea id="answers" class="form-control"
                                      placeholder="Seperate your answers using an ENTER"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="submitQuestion" type="submit" class="btn btn-primary" value="Save question">
                        <button id="closeModel" type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
