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
                        <form method="POST" action="{{ route('store_eduaction_system_level_subjects')}}">
                            @csrf
                            <div class="tab-content">
                            <div class="tab-pane show active" id="education">
                                <div class="row mb-3">
                                    <label for="education_system_id" class="col-md-4 col-form-label text-md-end">{{ __('Education System') }}</label>

                                    <div class="col-md-6">
                                        <select id="education_system_id" name="education_system_id" class="form-control @error('education_system_id') is-invalid @enderror">
                                            <option value="">Select an Education System</option>
                                            @foreach($education_systems as $education_system)
                                                <option value="{{ $education_system->id }}">{{ $education_system->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('education_system_id')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="education_level_id" class="col-md-4 col-form-label text-md-end">{{ __('Education Level') }}</label>

                                    <div class="col-md-6">
                                        <select id="education_level_id" name="education_level_id" class="form-control @error('education_level_id') is-invalid @enderror">
                                            <option value="">Select an Education Level</option>
                                            <!-- This options will be dynamically populated based on the selected education system -->
                                        </select>

                                        @error('education_level_id')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                </div>

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

                            </div> <!-- end preview-->
                        </div> <!-- end tab-content-->

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Create Question</button>
                            </div>
                        </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>

    </div> <!-- container -->


@endsection

@section('scripts')


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
