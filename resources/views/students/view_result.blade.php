@extends('students.master')

@section('content')
    <div class="container">
        <h1>View Results</h1>
        <h2>Subject: {{ $subject->name }}</h2>
        <p>Marks Obtained: {{ $result->marks_obtained }}</p>

        <h3>Correctly Answered Questions</h3>
        @if(count($answersDetails['correct']) > 0)
            <ul>
                @foreach($answersDetails['correct'] as $question)
                    <li>
                        <strong>{{ $question->question }}</strong><br>
                        Your Answer: {{ $question->{$question->answer} }}<br>
                        Value: {{ $question->value }}
                        <span class="text-success">Correct!</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No questions answered correctly.</p>
        @endif

        <h3>Incorrectly Answered Questions</h3>
        @if(count($answersDetails['incorrect']) > 0)
            <ul>
                @foreach($answersDetails['incorrect'] as $answer)
                    <li>
                        <strong>{{ $answer['question']->question }}</strong><br>
                        Your Answer: {{ $answer['question']->selectedAnswer }}<br>
                        Correct Answer: {{ $answer['correctAnswer'] }}<br>
                        Value: {{ $answer['question']->value }}
                        <span class="text-danger">Incorrect!</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No questions answered incorrectly.</p>
        @endif
    </div>
@endsection
