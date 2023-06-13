@extends('students.master')

@section('content')
    <div class="container">
        <h1>Subject: {{ $subject->name }}</h1>

        <form method="POST" action="{{ route('questions.submit', $subject->id) }}">
            @csrf
            @foreach ($questions as $key => $question)
                <div class="card {{ $key > 0 ? 'd-none' : '' }}" id="question{{ $key }}">
                    <div class="card-body">
                        <h5 class="card-title">Question {{ $key + 1 }}</h5>
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

                        @if ($errors->has('answer.'.$question->id))
                            <span class="text-danger">{{ $errors->first('answer.'.$question->id) }}</span>
                        @endif
                    </div>
                </div>
                <br>
            @endforeach

            <button type="button" class="btn btn-primary" id="nextButton">Next</button>
            <button type="submit" class="btn btn-primary d-none" id="submitButton">Submit</button>
        </form>
    </div>

    <script>
        const questions = {!! json_encode($questions->pluck('id')->toArray()) !!};
        let currentQuestion = 0;
        const nextButton = document.getElementById('nextButton');
        const submitButton = document.getElementById('submitButton');
        const questionElements = document.querySelectorAll('.card');

        nextButton.addEventListener('click', () => {
            const currentAnswer = document.querySelector(`input[name="answer[${questions[currentQuestion]}]"]:checked`);

            if (currentAnswer) {
                currentQuestion++;
                showQuestion(currentQuestion);

                if (currentQuestion === questions.length - 1) {
                    nextButton.classList.add('d-none');
                    submitButton.classList.remove('d-none');
                }
            } else {
                const errorElement = document.createElement('span');
                errorElement.className = 'text-danger';
                errorElement.innerText = 'Please select an answer.';
                const currentCard = document.getElementById(`question${currentQuestion}`);
                currentCard.appendChild(errorElement);
            }
        });

        function showQuestion(index) {
            questionElements.forEach((element, i) => {
                if (i === index) {
                    element.classList.remove('d-none');
                } else {
                    element.classList.add('d-none');
                }
            });
        }
    </script>
@endsection
