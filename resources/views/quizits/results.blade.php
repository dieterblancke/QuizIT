@extends('layouts.app')

@section('title', "Join - Quizit")

@section('css')
    <link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"/>

    <style>
        .form-inline {
            display: block;
        }
    </style>
@endsection

@section('content')
    <h1 class="text-center">Results for {{ $quizit->name }}</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Username</th>
            <th>Score</th>
            <th>Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quizit->results as $result)
            <tr>
                <td>{{ $result->username }}</td>
                <td>{{ $result->score . ' / ' . $result->total }}</td>
                <td>{{ $result->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        window.$(document).ready( function () {
            window.$('table').DataTable();
        } );
    </script>
@endsection
