@extends('teachers.master')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Teacher</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Questions</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">PostQuestions</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Post Questions</h4>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Select2</h4>

                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#education" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                    Set up Education
                                </a>
                            </li>
                        </ul> <!-- end nav-->

                        <form method="POST" action="{{route('store_questions')}}">
                            @csrf

                            <div class="form-group">
                                <label for="education_system">Education System</label>
                                <select id="education_system" name="education_system_id" class="form-control">
                                    <option value="">Select Education System</option>
                                    @foreach($education_systems as $education_system)
                                        <option value="{{ $education_system->id }}">{{ $education_system->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="education_level">Education Level</label>
                                <select id="education_level" name="education_level_id" class="form-control">
                                    <option value="">Select Education Level</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select id="subject" name="subject_id" class="form-control">
                                    <option value="">Select Subject</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="topic">Topic</label>
                                <select id="topic" name="topic_id" class="form-control">
                                    <option value="">Select Topic</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subtopic">Subtopic</label>
                                <select id="subtopic" name="subtopic_id" class="form-control">
                                    <option value="">Select Subtopic</option>
                                </select>
                            </div>

                            <div id="question-container">
                                <!-- Dynamic question form container -->
                            </div>
                            <br>

                            <div class="row mb-0">
                                <div class="col-md-4 offset-md-4">
                                    <button type="button" class="btn btn-primary mr-2" id="add-question-btn">Add Question</button>
                                    <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                                </div>
                            </div>

                        </form>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div><!-- end row-->
    </div> <!-- container -->
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to update the question count
        function updateQuestionCount() {
            var questionCount = $('.question-form').length;
            $('.question-count').text(questionCount);
        }

        // Function to add a new question form
        function addQuestionForm() {
            var questionCount = $('.question-form').length + 1;

            var questionForm = `
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Question Card</h5>
      <hr>
      <div class="form-group question-form">
        <label for="question_${questionCount}">Question ${questionCount}</label>
        <div class="row mb-3">
          <label for="question" class="col-md-4 col-form-label text-md-end">Question ${questionCount}</label>
          <div class="col-md-6">
            <input id="question_${questionCount}" type="text" class="form-control @error('questions') is-invalid @enderror" name="questions[]" required>
            @error('questions')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label for="option1" class="col-md-4 col-form-label text-md-end">{{ __('Option 1') }}</label>
          <div class="col-md-6">
            <input id="option1_${questionCount}" type="text" class="form-control @error('option1') is-invalid @enderror" name="option1[]" required>
            @error('option1')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label for="option2" class="col-md-4 col-form-label text-md-end">{{ __('Option 2') }}</label>
          <div class="col-md-6">
            <input id="option2_${questionCount}" type="text" class="form-control @error('option2') is-invalid @enderror" name="option2[]" required>
            @error('option2')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label for="option3" class="col-md-4 col-form-label text-md-end">{{ __('Option 3') }}</label>
          <div class="col-md-6">
            <input id="option3_${questionCount}" type="text" class="form-control @error('option3') is-invalid @enderror" name="option3[]" required>
            @error('option3')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label for="option4" class="col-md-4 col-form-label text-md-end">{{ __('Option 4') }}</label>
          <div class="col-md-6">
            <input id="option4_${questionCount}" type="text" class="form-control @error('option4') is-invalid @enderror" name="option4[]" required>
            @error('option4')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label for="answer" class="col-md-4 col-form-label text-md-end">{{ __('Correct Answer') }}</label>
          <div class="col-md-6">
            <select id="answer_${questionCount}" name="answer[]" class="form-control @error('answer') is-invalid @enderror">
              <option value="">Select Correct Answer</option>
              <option value="option1">Option 1</option>
              <option value="option2">Option 2</option>
              <option value="option3">Option 3</option>
              <option value="option4">Option 4</option>
            </select>
            @error('answer')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>
          <div class="col-md-6">

            <input id="image_${questionCount}" type="file" class="form-control-file" name="image">

          </div>
        </div>

        <div>
          <button type="button" class="btn btn-danger mr-2 remove-question-btn">Remove</button>
        </div>
      </div>
    </div>
  </div>
</div>`;



            $('#question-container').append(questionForm);

            // Update the question count
            updateQuestionCount();
        }

        // Event delegation for the "Add Question" button click
        $('#add-question-btn').click(function () {
            addQuestionForm();
        });

        // Event delegation for the "Remove" button click
        $(document).on('click', '.remove-question-btn', function () {
            $(this).closest('.form-group').prev('hr').remove(); // Remove the previous <hr> element
            $(this).closest('.form-group').remove(); // Remove the question form group

            // Update the question count
            updateQuestionCount();
        });
    </script>
    <script>
        $(document).ready(function () {
            // Populate education levels based on education system selection
            $('#education_system').on('change', function () {
                var educationSystemId = $(this).val();

                $.ajax({
                    url: '/teacher/get-education-levels',
                    type: 'GET',
                    data: {educationSystemId: educationSystemId},
                    success: function (data) {
                        var options = '<option value="">Select Education Level</option>';

                        $.each(data.educationLevels, function (key, educationLevel) {
                            options += '<option value="' + educationLevel.id + '">' + educationLevel.name + '</option>';
                        });

                        $('#education_level').html(options);
                    }
                });
            });

            // Populate subjects based on education system and education level selection
            $('#education_level').on('change', function () {
                var educationSystemId = $('#education_system').val();
                var educationLevelId = $(this).val();

                $.ajax({
                    url: '/teacher/get-subjects',
                    type: 'GET',
                    data: {
                        educationSystemId: educationSystemId,
                        educationLevelId: educationLevelId
                    },
                    success: function (data) {
                        var options = '<option value="">Select Subject</option>';

                        $.each(data.subjects, function (key, subject) {
                            options += '<option value="' + subject.id + '">' + subject.name + '</option>';
                        });

                        $('#subject').html(options);
                    }
                });
            });

            // Populate topics based on subject selection
            $('#subject').on('change', function () {
                var subjectId = $(this).val();

                $.ajax({
                    url: '/teacher/get-topics',
                    type: 'GET',
                    data: {subjectId: subjectId},
                    success: function (data) {
                        var options = '<option value="">Select Topic</option>';
                        $.each(data.topics, function (key, topic) {
                            options += '<option value="' + topic.id + '">' + topic.topic_strand + '</option>';
                        });
                        $('#topic').html(options);
                    }
                });
            });

            // Populate subtopics based on topic selection
            $('#topic').on('change', function () {
                var topicId = $(this).val();

                $.ajax({
                    url: '/teacher/get-subtopics',
                    type: 'GET',
                    data: {topicId: topicId},
                    success: function (data) {
                        var options = '<option value="">Select Subtopic</option>';

                        $.each(data.subtopics, function (key, subtopic) {
                            options += '<option value="' + subtopic.id + '">' + subtopic.name + '</option>';
                        });

                        $('#subtopic').html(options);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // When the education system dropdown value changes
            $('#education_system_id').on('change', function() {
                var educationSystemId = $(this).val();

                // Make an AJAX request to fetch the education levels for the selected education system
                $.ajax({
                    url: '{{ route('getEducationLevels') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        education_system_id: educationSystemId
                    },
                    success: function(response) {
                        var options = '<option value="">Select an Education Level</option>';

                        // Populate the education levels dropdown with the retrieved options
                        for (var i = 0; i < response.length; i++) {
                            options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                        }

                        $('#education_level_id').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Function to handle next button click on the wizard form
            function next() {
                var currentTab = $('.tab-pane.active');
                var nextTab = currentTab.next('.tab-pane');

                if (nextTab.length > 0) {
                    currentTab.removeClass('active');
                    nextTab.addClass('active');
                }
            }

            // Function to handle previous button click on the wizard form
            function previous() {
                var currentTab = $('.tab-pane.active');
                var prevTab = currentTab.prev('.tab-pane');

                if (prevTab.length > 0) {
                    currentTab.removeClass('active');
                    prevTab.addClass('active');
                }
            }
        });
    </script>




@endsection
