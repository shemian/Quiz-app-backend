@extends('students.master')

@section('content')
    <div class="container">
        <h1>Subject: {{ $exam->subject->name }}</h1>

        @if ($questions->isEmpty())
            <p>No questions available for this exam.</p>
        @else
            <form method="POST" action="{{ route('questions.submit', $exam->id) }}">
                @csrf
                <input type="hidden" name="exam_id" value="{{ $exam->id }}">

                @foreach ($questions as $key => $question)
                    <div class="card {{ $key > 0 ? 'd-none' : '' }}" id="question{{ $key }}">
                        <div class="card-body">
                            <h5 class="card-title">Question {{ $key + 1 }}</h5>
                            @if ($question->image)
                                <img src="{{ $question->image }}" alt="Question Image" class="question-image">
                            @endif
                            <p class="card-text">{{ $question->question }}</p>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer[{{ $question->id }}]" id="option1_{{ $question->id }}" value="option1" {{ old('answer.'.$question->id) === 'option1' ? 'checked' : '' }}>
                                <label class="form-check-label {{ $resultDetails[$question->id]['selectedAnswer'] === 'option1' ? ($resultDetails[$question->id] === 'correct' ? 'text-success' : 'text-danger') : '' }}" for="option1_{{ $question->id }}">{{ $question->option1 }}</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer[{{ $question->id }}]" id="option2_{{ $question->id }}" value="option2" {{ old('answer.'.$question->id) === 'option2' ? 'checked' : '' }}>
                                <label class="form-check-label {{ $resultDetails[$question->id]['selectedAnswer'] === 'option2' ? ($resultDetails[$question->id] === 'correct' ? 'text-success' : 'text-danger') : '' }}" for="option2_{{ $question->id }}">{{ $question->option2 }}</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer[{{ $question->id }}]" id="option3_{{ $question->id }}" value="option3" {{ old('answer.'.$question->id) === 'option3' ? 'checked' : '' }}>
                                <label class="form-check-label {{ $resultDetails[$question->id]['selectedAnswer'] === 'option3' ? ($resultDetails[$question->id] === 'correct' ? 'text-success' : 'text-danger') : '' }}" for="option3_{{ $question->id }}">{{ $question->option3 }}</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer[{{ $question->id }}]" id="option4_{{ $question->id }}" value="option4" {{ old('answer.'.$question->id) === 'option4' ? 'checked' : '' }}>
                                <label class="form-check-label {{ $resultDetails[$question->id]['selectedAnswer'] === 'option4' ? ($resultDetails[$question->id] === 'correct' ? 'text-success' : 'text-danger') : '' }}" for="option4_{{ $question->id }}">{{ $question->option4 }}</label>
                            </div>

                            @if ($resultDetails[$question->id] === 'incorrect')
                                <div class="text-danger">
                                    <small>Incorrect. The correct answer is: {{ $question->answer }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                    <br>
                @endforeach

                @if ($questions->count() === 1)
                    <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                @else
                    <button type="button" class="btn btn-primary" id="previousButton" style="display: none;">Previous</button>
                    <button type="button" class="btn btn-primary" id="nextButton">Next</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                @endif
            </form>
        @endif
    </div>

    <script>
        const questions = {!! json_encode($questions->pluck('id')->toArray()) !!};
        const resultDetails = {!! json_encode($resultDetails) !!};
        let currentQuestion = 0;
        const previousButton = document.getElementById('previousButton');
        const nextButton = document.getElementById('nextButton');
        const submitButton = document.getElementById('submitButton');
        const questionElements = document.querySelectorAll('.card');

        // Show the appropriate buttons based on the current question index
        function showButtons() {
            previousButton.style.display = currentQuestion === 0 ? 'none' : 'inline-block';
            nextButton.style.display = currentQuestion < questions.length - 1 ? 'inline-block' : 'none';
            submitButton.style.display = currentQuestion === questions.length - 1 ? 'inline-block' : 'none';
        }

        // Show the current question and update the buttons
        function showQuestion(index) {
            questionElements.forEach((element, i) => {
                if (i === index) {
                    element.classList.remove('d-none');
                } else {
                    element.classList.add('d-none');
                }
            });

            currentQuestion = index;
            showButtons();
        }

        // Event listener for the next button
        nextButton.addEventListener('click', () => {
            const currentAnswer = document.querySelector(`input[name="answer[${questions[currentQuestion]}]"]:checked`);

            if (currentAnswer) {
                if (currentQuestion < questions.length - 1) {
                    currentQuestion++;
                    showQuestion(currentQuestion);
                } else {
                    submitButton.parentElement.submit();
                }
            } else {
                const errorElement = document.createElement('span');
                errorElement.className = 'text-danger';
                errorElement.innerText = 'Please select an answer.';
                const currentCard = document.getElementById(`question${currentQuestion}`);
                currentCard.appendChild(errorElement);
            }
        });

        // Event listener for the previous button
        previousButton.addEventListener('click', () => {
            currentQuestion--;
            showQuestion(currentQuestion);
        });

        // Initialize the first question and buttons
        showQuestion(0);
    </script>

@endsection
