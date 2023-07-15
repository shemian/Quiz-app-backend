@extends('students.master')

@section('content')
    <div class="container">
        <h1>View Results</h1>
        <h2>Subject: {{ $exam->name }}</h2>
        <p>Marks Obtained: {{ $result->marks_obtained }}</p>

        <h3>Correctly Answered Questions</h3>
        <p>{{ $result->yes_ans }}</p>

        <h3>Incorrectly Answered Questions</h3>
        <p>{{ $result->no_ans }}</p>

    </div>

@endsection
