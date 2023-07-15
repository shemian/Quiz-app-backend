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

        @if ($result->no_ans > 0)
            <h4>Incorrect Answer Details</h4>
            @foreach (json_decode($result->result_json, true)['answers'] as $answer)
                @if (isset($answer['correct_answer']) && $answer['answer'] !== $answer['correct_answer'])
                    <p>Question: {{ $answer['question'] }}</p>
                    <p>Correct Answer: {{ $answer['correct_answer'] }}</p>
                    <p>Your Answer: {{ $answer['answer'] }}</p>
                @endif
            @endforeach
        @else
            <p>No questions answered incorrectly.</p>
        @endif
    </div>

@endsection
