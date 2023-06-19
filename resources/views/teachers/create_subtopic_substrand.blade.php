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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Subtopics</a></li>
                        </ol>
                    </div>
                    <br>
                    <a class="btn btn-primary" href="{{ route('get_subjects') }}">
                        Back to  Topics/Strands
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
{{--                                <a href="#education" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">--}}
{{--                                    Back to Subjects--}}
{{--                                </a>--}}
                            </li>
                        </ul> <!-- end nav-->
                        <div class="row">

                            <div class="col-md-6 offset-md-3">
                                <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add Sub-topic/Sub-strand</h4>
                                    <form action="{{ route('storeSubtopicSubStrand', ['topicStrand' => $topicStrand]) }}" method="POST">
                                        @csrf

                                        <div class="row mb-3">
                                            <label for="topic_name" class="col-md-4 col-form-label text-md-end">{{ __('Topic Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="topic_name" value="{{ $topicStrand->topic_strand }}" type="text" class="form-control @error('topic_name') is-invalid @enderror" name="topic_name"  readonly >

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Subtopic Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required >

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Create Subtopic/Substrand') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>


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
