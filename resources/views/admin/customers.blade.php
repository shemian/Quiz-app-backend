@extends('layouts.master')

@section('content')


<div class="container-fluid">                    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Centy Plus</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Teachers</a></li>
                    </ol>
                </div>
                <br>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add a Teacher
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
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Wallet Balance</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->user->name }}</td>
                                    <td>{{ $customer->user->email }}</td>
                                    <td>{{ $customer->phone_number }}</td>
                                    <td>{{ $customer->credit }}</td>
                                    <td>{{ $customer->user->role }}</td>
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
