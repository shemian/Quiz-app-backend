@extends('teachers.master')

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Centy Plus</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Teacher</a></li>
                            <li class="breadcrumb-item active">Exam Questions</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Exam Questions</h4>
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
            <div class="col-xl-3 col-lg-5">
                <div class="card text-center">
                    <div class="card-body">
                        <img>
                        <h4 class="mb-0 mt-2">{{ $exam->name }}</h4>
                        <p class="text-muted font-14">{{  $exam->subject->name }}</p>


                        <div class="text-start mt-3">

                            <p class="text-muted mb-2 font-13"><strong>Exam Name:</strong> <span class="ms-2">
                                                   {{ $exam->name }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Education System :</strong><span class="ms-2">
                                                    {{ $exam->subject->educationSystem->name  }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Education Level :</strong><span class="ms-2">
                                                    {{  $exam->subject->educationLevel->name  }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Subject :</strong><span class="ms-2">
                                                    {{  $exam->subject->name  }}</span></p>
                        </div>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->



            </div> <!-- end col-->

            <div class="col-xl-9 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Manage Question</h4>

                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                    Preview
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="buttons-table-preview">
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($questions as $question)
                                        <tr>
                                            <td>{{ $question->question }}</td>
                                            <td>{{ $question->answer }}</td>
                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal_{{ $question->id }}" title="Edit"><i class="mdi mdi-book-edit-outline"></i></a>

                                                <a href="#"  title="Delete" onclick="event.preventDefault(); deleteStudent('{{ route('delete_question', $question->id) }}');">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </a>

                                                <form id="delete-form" method="POST" action="{{ route('delete_question', $question->id) }}" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal_{{ $question->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Question</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form id="editForm_{{ $question->id }}" method="POST" action="{{ route('update_questions', $question->id) }}" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="exam_id" value="{{ $exam->id }}">


                                                                <div class="row mb-3">
                                                                    <label for="Belongs To Education Level" class="col-md-4 col-form-label text-md-end">{{ __('Belongs To Eduction Level') }}</label>
                                                                    <div class="col-md-6">
                                                                        <select id="education_level_id"  name="education_level_id" class="form-control"></select>
                                                                        @error('education_level_id')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="topic" class="col-md-4 col-form-label text-md-end">{{ __('Topic') }}</label>
                                                                    <div class="col-md-6">
                                                                        <select id="topic_id" name="topic_id" class="form-control"></select>
                                                                        @error('topic')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="subtopic" class="col-md-4 col-form-label text-md-end">{{ __('Subtopic') }}</label>
                                                                    <div class="col-md-6">
                                                                        <select id="subtopic_id" name="subtopic_id" class="form-control">
                                                                            <option value="">Select Subtopic</option>
                                                                        </select>
                                                                        @error('subtopic_id')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="question" class="col-md-4 col-form-label text-md-end">Question</label>
                                                                    <div class="col-md-6">
                                                                        <input id="question" type="text" value="{{ $question->question }}" class="form-control @error('question') is-invalid @enderror" name="question"  required>
                                                                        @error('question')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="option1" class="col-md-4 col-form-label text-md-end">{{ __('Option 1') }}</label>
                                                                    <div class="col-md-6">
                                                                        <input id="option1_${questionCount}" value="{{ $question->option1 }}" type="text" class="form-control @error('option1') is-invalid @enderror" name="option1[]" required>
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
                                                                        <input id="option2_${questionCount}" value="{{ $question->option2 }}" type="text" class="form-control @error('option2') is-invalid @enderror" name="option2[]" required>
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
                                                                        <input id="option3_${questionCount}" value="{{ $question->option3 }}" type="text" class="form-control @error('option3') is-invalid @enderror" name="option3[]" required>
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
                                                                        <input id="option4_${questionCount}" value="{{ $question->option4 }}" type="text" class="form-control @error('option4') is-invalid @enderror" name="option4[]" required>
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
                                                                        <select id="answer_${questionCount}" name="answer[]" value="{{ $question->answer }}" class="form-control @error('answer') is-invalid @enderror">
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

                                                                        <input id="image_${questionCount}" type="file" class="form-control-file" name="image_${questionCount}">

                                                                    </div>
                                                                </div>


                                                                <div class="row mb-0">
                                                                    <div class="col-md-6 offset-md-4">
                                                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div>
    <!-- container -->

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- third party js -->
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.select.min.js') }}"></script>

    <script>
        function deleteStudent(deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the deletion by submitting the form
                    document.getElementById('delete-form').action = deleteUrl;
                    document.getElementById('delete-form').submit();
                }
            });
        }
        $(document).ready(function () {
            // Topic List
            let topicList = [];
            let educationLevels = [];
            const exam = @json($exam);
            let selectedQuestion = 0;

            $.ajax({
                url: `/teacher/get-topics/${exam.subject_id}`,
                type: 'GET',
                success: function (data) {
                    console.log('topics'+data);
                    let topicOptions = '';

                    $.each(data?.topicStrands, function (key, topic) {
                        topicOptions += `<option value="${topic.id}">${topic.name}</option>`;
                    });

                    // Assuming you have a select element with id="topics" where you want to populate the topics
                    $("#topics").append(topicOptions);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText); // Log any error response to the console
                }
            });

            $.ajax({
                url: '/teacher/get-education-levels',
                type: 'GET',
                data: {educationSystemId: exam.subject.education_system_id},
                success: function (data) {
                    let options = '';
                    $.each(data?.educationLevels, function (key, educationLevel) {
                        options += `<option value="${educationLevel.id}">${exam.subject.name} ${educationLevel.name}</option>`;

                    });
                    $("#education_level_id").append(options);
                }
            });

            $.ajax({
                url: `/teacher/get-topics/${exam.subject_id}`,
                type: 'GET',
                success: function (data) {
                    let topicOptions = '';

                    $.each(data?.topicStrands, function (key, topic) {
                        topicOptions += `<option value="${topic.id}">${topic.topic_strand}</option>`;
                    });

                    // Assuming you have a select element with id="topics" where you want to populate the topics
                    $("#topic_id").append(topicOptions);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText); // Log any error response to the console
                }
            });

            $(document).on('change', '#topic_id', function (e) {
                e.preventDefault();
                var selectedTopicId = $(this).val();

                console.log("selectedTopic", selectedTopicId);

                if (selectedTopicId !== '') {
                    $.ajax({
                        url: '/teacher/get-subtopics',
                        type: 'GET',
                        data: { topicId: selectedTopicId },
                        success: function (data) {
                            console.log("subtopics", data)
                            var options = '<option value="">Select Subtopic</option>';

                            $.each(data.subtopics, function (key, subtopic) {
                                options += '<option value="' + subtopic.id + '">' + subtopic.name + '</option>';
                            });

                            $('#subtopic_id').html(options);
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText); // Log any error response to the console
                        }
                    });
                } else {
                    // Clear the subtopic select if no topic is selected
                    $('#subtopic').html('<option value="">Select Subtopic</option>');
                }
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
            // $('#subject').on('change', function () {
            //     var subjectId = $(this).val();
            // });

            // Populate subtopics based on topic selection
            $(document).on('change', '[id^=question] #topic', function () {
                var topicId = $(this).val();
                var questionCount = $(this).attr("class").split(" ")[0].split("_")[1];
                populateSubtopics(questionCount, topicId);
            });

            // Function to update the question count
            function updateQuestionCount() {
                var questionCount = $('.question-form').length;
                $('.question-count').text(questionCount);
            }

            // Function to add a new question form
            function addQuestionForm() {
                var questionCount = $('.question-form').length + 1;

                var options = '<option value="">Select Topic</option>';
                $.each(topicList, function (key, topic) {
                    options += '<option value="' + topic.id + '">' + topic.topic_strand + '</option>';
                });


                var education_level_options = '<option value="">Select Education Level</option>';

                $.each(educationLevels, function (key, educationLevel) {
                    education_level_options += '<option value="' + educationLevel.id + '">' + educationLevel.name + '</option>';
                });

                $('#education_level').html(education_level_options);

                var questionForm = `
                <div class="card form-group question-form" id="question_${questionCount}">
                    <div class="card-body">
                        <h5 class="card-title">Question Card</h5>
                        <hr>
                        <label for="question_${questionCount}">Question ${questionCount}</label>

                             <div class="row mb-3">-
                                <label for="Belongs To Education Level" class="col-md-4 col-form-label text-md-end">{{ __('Belongs To Eduction Level') }}</label>
                                <div class="col-md-6">
                                    <select id="education_level_id"  name="education_level_id[]" class="topicq_${questionCount} form-control" >
                                        ${education_level_options}
                                    </select>
                                    @error('education_level_id')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                </div>
             </div>


<div class="row mb-3">
<label for="topic" class="col-md-4 col-form-label text-md-end">{{ __('Topic') }}</label>
                                <div class="col-md-6">
                                    <select id="topic" name="topic_id" class="topicq_${questionCount} form-control">
                                        ${options}
                                    </select>
                                    @error('topic')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                </div>
             </div>

           <div class="row mb-3">
               <label for="subtopic" class="col-md-4 col-form-label text-md-end">{{ __('Subtopic') }}</label>
                                <div class="col-md-6">
                                    <select id="subtopic" name="subtopic_id" class="form-control">
                                        <option value="">Select Subtopic</option>
                                    </select>
                                    @error('subtopic')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                </div>
            </div>


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

            <input id="image_${questionCount}" type="file" class="form-control-file" name="image_${questionCount}">

          </div>
        </div>

        <div>
          <button type="button" class="btn btn-danger mr-2 remove-question-btn">Remove</button>
        </div>

        </div>
    </div>
</div>`;

                $('#question-container').append(questionForm);
                var newQuestionForm = $('.card').last().find('.question-form');
                // var topicDropdown = newQuestionForm.find('#topic');
                //
                // // Attach event handler to topic dropdown for dynamic population of subtopics
                // topicDropdown.on('change', function () {
                //     populateSubtopics($(this));
                // });
                // populateSubtopics(topicDropdown);
            }

            // $('#topic').on('change', function () {
            //     populateSubtopics();
            // });

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


        });
    </script>
@endsection
