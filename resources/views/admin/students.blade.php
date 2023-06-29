@extends('layouts.master')

@section('content')


<div class="container-fluid">                    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Centy Plus</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Students</a></li>
                    </ol>
                </div>
                <br>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Scrollable modal -->



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Manage Customers </h4>

                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                Preview
                            </a>
                        </li>
                    </ul> <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Account Number</th>
                                        <th>School Name</th>
                                        <th>Credit</th>
                                        <th>Account Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->account_number }}</td>
                                    <td>{{ $student->school_name }}</td>
                                    <td>{{ $student->credit }}</td>
                                    <td>
                                        @if($student->account_status == 1){
                                    Active
                                    }@elseif($student->account_status == 2){
                                    Pending
                                    }@elseif($student->account_status == 3){
                                  Suspended
                                    @endif
                                    </td>
                                    <td>
                                        <a href="" title="View"><i class="mdi mdi-eye"></i></a>

                                    </td>
                                </tr>
                                @endforeach

                                <tbody>

                                </tbody>
                            </table>
                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
</div> <!-- container -->

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
