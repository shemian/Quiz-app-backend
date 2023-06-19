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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Subjects</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Topics</a></li>
                        </ol>
                    </div>
                    <br>
                    <a class="btn btn-primary" href="{{ route('get_subjects') }}">
                        Back to  Subjects
                    </a>


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
                                    Back to Subjects
                                </a>
                            </li>
                        </ul> <!-- end nav-->
                        <div class="row">

                            <div class="col-md-6 offset-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <br>
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
                                        <h4 class="card-title">Add Topic/Strand</h4>
                                        <form method="POST" action="{{ route('store_topics_and_strands') }}">
                                            @csrf

                                            <input type="hidden" name="education_system_id" value="{{ ($educationSystemId) }}">
                                            <input type="hidden" name="education_level_id" value="{{ ($educationLevelId) }}">
                                            <input type="hidden" name="subject_id" value="{{ ($subjectId) }}">

                                            <div class="form-group">
                                                <label for="education_system_id">Education System</label>
                                                <span class="form-control">{{ $educationSystemId ? App\Models\EducationSystem::find($educationSystemId)->name : '' }}</span>
                                            </div>

                                            <div class="form-group">
                                                <label for="education_level_id">Education Level</label>
                                                <span class="form-control">{{ $educationLevelId ? App\Models\EducationLevel::find($educationLevelId)->name : '' }}</span>
                                            </div>

                                            <div class="form-group">
                                                <label for="subject_id">Subject</label>
                                                <span class="form-control">{{ $subjectId ? App\Models\Subject::find($subjectId)->name : '' }}</span>
                                            </div>


                                            <div class="form-group">
                                                <label for="topic_strand">Topic/Strand</label>
                                                <input type="text" class="form-control @error('topic_strand') is-invalid @enderror" id="topic_strand" name="topic_strand">
                                                @error('topic_strand')
                                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                                @enderror
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Topics/Strands</h4>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Education System</th>
                                                <th>Education Level</th>
                                                <th>Subject</th>
                                                <th>Topics</th>
                                                <th>No Sub-Topics/Sub-Strands</th>
                                                <th>Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($topicStrands as $topicStrand)
                                                <tr>
                                                    <td>{{ $topicStrand->subject->educationSystem->name }}</td>
                                                    <td>{{ $topicStrand->subject->educationLevel->name }}</td>
                                                    <td>{{ $topicStrand->subject->name }}</td>
                                                    <td>{{ $topicStrand->topic_strand }}</td>
                                                    <td>0</td>
                                                    <td>
                                                        <a href="{{ route('createSubtopicSubStrand', ['topicStrand' => $topicStrand->id]) }}" title="SubTopicStrand">
                                                            <i class="mdi mdi-book-edit-outline"></i> Add Sub-topic/sub-strand
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div><!-- end row-->
    </div>

@endsection
