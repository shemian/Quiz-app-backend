@extends('teachers.master')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Centy Plus</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Questions</a></li>
                    </ol>
                </div>
                <br>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add Questions
                </button>

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

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('store_questions')}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="subject_id" class="col-md-4 col-form-label text-md-end">{{ __('Subject') }}</label>

                            <div class="col-md-6">
                                <select id="subject_id" name="subject_id" class="form-control @error('subject_id') is-invalid @enderror">
                                    <option value="">Select a Subject</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>

                                @error('subject_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subtopic" class="col-md-4 col-form-label text-md-end">{{ __('Subtopic') }}</label>

                            <div class="col-md-6">
                                <input id="subtopic" type="text" class="form-control @error('subtopic') is-invalid @enderror" name="subtopic" required>

                                @error('subtopic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="question" class="col-md-4 col-form-label text-md-end">{{ __('Question') }}</label>

                            <div class="col-md-6">
                                <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" required>

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
                                <input id="option1" type="text" class="form-control @error('option1') is-invalid @enderror" name="option1" required>

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
                                <input id="option2" type="text" class="form-control @error('option2') is-invalid @enderror" name="option2" required>

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
                                <input id="option3" type="text" class="form-control @error('option3') is-invalid @enderror" name="option3" required>

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
                                <input id="option4" type="text" class="form-control @error('option4') is-invalid @enderror" name="option4" required>

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
                                <select id="answer" name="answer" class="form-control @error('answer') is-invalid @enderror">
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
                            <label for="marks" class="col-md-4 col-form-label text-md-end">{{ __('Marks') }}</label>

                            <div class="col-md-6">
                                <input id="marks" type="number" class="form-control @error('marks') is-invalid @enderror" name="marks" required>

                                @error('marks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
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
                                        <th>Name</th>
                                        <th>Topic</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($questions as $question)
                                        <tr>
                                            <td>{{ $question->subject->name }}</td>
                                            <td>{{ $question->subtopic }}</td>
                                            <td>{{ $question->question }}</td>
                                            <td>{{ $question->{$question->answer} }}</td>
                                            <td>{{ $question->marks }}</td>
                                            <td>
                                                <a href="" title="View"><i class="mdi mdi-eye"></i></a>
                                                <a href="" title="Edit"><i class="mdi mdi-book-edit-outline"></i></a>
                                                <a href="#" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this question?')) { document.getElementById('delete-form-{{ $question->id }}').submit(); }" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                                <form id="delete-form-{{ $question->id }}" action="" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
    @if(Session::has('formData'))
        <script>
            // Restore form data from session
            var formData = {!! json_encode(Session::get('formData')) !!};
            Object.keys(formData).forEach(function(key) {
                document.getElementById(key).value = formData[key];
            });
        </script>
    @endif
@endsection
