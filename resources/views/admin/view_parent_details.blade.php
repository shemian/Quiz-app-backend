@extends('layouts.master')

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Guardian's Profile</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Guardian Profile</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    <div class="card-body">
                        <img>
                        <h4 class="mb-0 mt-2">{{ $guardian->user->name }}</h4>
                        <p class="text-muted font-14">{{ $guardian->user->role }}</p>


                        <div class="text-start mt-3">

                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">
                                                   {{ $guardian->user->name }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>CentyPlus ID :</strong><span class="ms-2">
                                                    {{ $guardian->user->centy_plus_id  }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Phone Number :</strong><span class="ms-2">
                                                    {{ $guardian->user->phone_number  }}</span></p>
                        </div>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->



            </div> <!-- end col-->

            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <li class="nav-item">
                                <a href="#aboutme" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                    Students
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#timeline" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                    Transactions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                    Settings
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="aboutme">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-nowrap mb-0">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Centy ID</th>
                                            <th>School Name</th>
                                            <th>Education Level</th>
                                            <th>Account Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $student->user->centy_plus_id }}</td>
                                            <td>{{ $student->school_name }} </td>
                                            <td>{{ $student->educationLevel->name }} </td>
                                            @if($student->account_status == 0)
                                            <td><span class="badge badge-danger-lighten">Inactive</span></td>
                                            @elseif($student->account_status == 1)
                                            <td><span class="badge badge-success-lighten">Active</span></td>
                                            @elseif($student->account_status == 2)
                                            <td><span class="badge badge-warning-lighten">Pending</span></td>
                                            @elseif($student->account_status == 3)
                                            <td><span class="badge badge-info-lighten">Suspended</span></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div> <!-- end tab-pane -->
                            <!-- end about me section content -->

                            <div class="tab-pane " id="timeline">
                                <h1>Transactions</h1>

                            </div>
                            <!-- end timeline content-->

                            <div class="tab-pane" id="settings">
                                <form>
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstname" placeholder="Enter first name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lastname" placeholder="Enter last name">
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="userbio" class="form-label">Bio</label>
                                                <textarea class="form-control" id="userbio" rows="4" placeholder="Write something..."></textarea>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="useremail" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                                                <span class="form-text text-muted"><small>If you want to change email please <a href="javascript: void(0);">click</a> here.</small></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="userpassword" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
                                                <span class="form-text text-muted"><small>If you want to change password please <a href="javascript: void(0);">click</a> here.</small></span>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Company Info</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="companyname" class="form-label">Company Name</label>
                                                <input type="text" class="form-control" id="companyname" placeholder="Enter company name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="cwebsite" class="form-label">Website</label>
                                                <input type="text" class="form-control" id="cwebsite" placeholder="Enter website url">
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth me-1"></i> Social</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-fb" class="form-label">Facebook</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="mdi mdi-facebook"></i></span>
                                                    <input type="text" class="form-control" id="social-fb" placeholder="Url">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-tw" class="form-label">Twitter</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>
                                                    <input type="text" class="form-control" id="social-tw" placeholder="Username">
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-insta" class="form-label">Instagram</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="mdi mdi-instagram"></i></span>
                                                    <input type="text" class="form-control" id="social-insta" placeholder="Url">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-lin" class="form-label">Linkedin</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>
                                                    <input type="text" class="form-control" id="social-lin" placeholder="Url">
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-sky" class="form-label">Skype</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="mdi mdi-skype"></i></span>
                                                    <input type="text" class="form-control" id="social-sky" placeholder="@username">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social-gh" class="form-label">Github</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="mdi mdi-github"></i></span>
                                                    <input type="text" class="form-control" id="social-gh" placeholder="Username">
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->

                        </div> <!-- end tab-content -->
                    </div> <!-- end card body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div>
    <!-- container -->

@endsection
