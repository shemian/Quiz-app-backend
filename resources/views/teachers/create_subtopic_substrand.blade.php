@extends('teachers.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
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
    </div>
@endsection
