@extends('teachers.master')

@section('content')

    <div class="container">
        <br>
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
    </div>

@endsection
