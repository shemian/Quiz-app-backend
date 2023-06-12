@extends('students.master')

@section('content')
    <div class="container">
        <h1>Subject: {{ $subject->name }}</h1>
        

        <form method="POST" action="{{ route('questions.submit', $subject->id) }}">
            @csrf
            @foreach ($questions as $question)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question {{ $loop->iteration }}</h5>
                        <p class="card-text">{{ $question->question }}</p>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer[{{ $question->id }}]" id="option1_{{ $question->id }}" value="option1">
                            <label class="form-check-label" for="option1_{{ $question->id }}">{{ $question->option1 }}</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer[{{ $question->id }}]" id="option2_{{ $question->id }}" value="option2">
                            <label class="form-check-label" for="option2_{{ $question->id }}">{{ $question->option2 }}</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer[{{ $question->id }}]" id="option3_{{ $question->id }}" value="option3">
                            <label class="form-check-label" for="option3_{{ $question->id }}">{{ $question->option3 }}</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer[{{ $question->id }}]" id="option4_{{ $question->id }}" value="option4">
                            <label class="form-check-label" for="option4_{{ $question->id }}">{{ $question->option4 }}</label>
                        </div>
                    </div>
                </div>
                <br>
            @endforeach
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
