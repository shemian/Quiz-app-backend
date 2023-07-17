@extends('layouts.master')

@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Customers</h5>
                            <h3 class="my-2 py-1">{{ $customerCount }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 3.27%</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="campaign-sent-chart" data-colors="#727cf5"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Students</h5>
                            <h3 class="my-2 py-1">{{ $studentCount  }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 5.38%</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="new-leads-chart" data-colors="#0acf97"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals">Teachers</h5>
                            <h3 class="my-2 py-1">{{ $teacherCount  }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="deals-chart" data-colors="#727cf5"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Booked Revenue">Revenue</h5>
                            <h3 class="my-2 py-1">ksh {{ $organization_revenue }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 11.7%</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="booked-revenue-chart" data-colors="#0acf97"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Today</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last Week</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                        </div>
                    </div>

                    <h4 class="header-title mb-1">SMS</h4>

                    <div id="dash-campaigns-chart" class="apex-charts" data-colors="#ffbc00,#727cf5,#0acf97"></div>

                    <div class="row text-center mt-2">
                        <div class="col-md-4">
                            <i class="mdi mdi-send widget-icon rounded-circle bg-light-lighten text-muted"></i>
                            <h3 class="fw-normal mt-3">
                                <span>6,510</span>
                            </h3>
                            <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Total Sent</p>
                        </div>
                        <div class="col-md-4">
                            <i class="mdi mdi-flag-variant widget-icon rounded-circle bg-light-lighten text-muted"></i>
                            <h3 class="fw-normal mt-3">
                                <span>3,487</span>
                            </h3>
                            <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Delivered</p>
                        </div>
                        <div class="col-md-4">
                            <i class="mdi mdi-email-open widget-icon rounded-circle bg-light-lighten text-muted"></i>
                            <h3 class="fw-normal mt-3">
                                <span>1,568</span>
                            </h3>
                            <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> Pending</p>
                        </div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Today</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last Week</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                        </div>
                    </div>

                    <h4 class="header-title mb-3">Revenue</h4>

                    <div class="chart-content-bg">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <p class="text-muted mb-0 mt-3">Escrow Balance</p>
                                <h2 class="fw-normal mb-3">
                                    <span>ksh {{ $totalCentyBalance }}</span>
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-0 mt-3">Student's Balance</p>
                                <h2 class="fw-normal mb-3">
                                    <span>ksh {{ $totalWalletBalance }}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div dir="ltr">
                        <div id="dash-revenue-chart" class="apex-charts" data-colors="#0acf97,#fa5c7c"></div>
                    </div>

                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->


    <div class="row">
        <div class="col-xl-6 col-lg-">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-3">Top Performing Students</h4>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Students</th>
                                    <th>Centys</th>
                                    <th>Tasks</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Jeremy Young</h5>
                                        <span class="text-muted font-13">Grade 2, St Martin's School</span>
                                    </td>
                                    <td>187</td>
                                    <td>49</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Thomas Krueger</h5>
                                        <span class="text-muted font-13">Grade 4, St Martin's School</span>
                                    </td>
                                    <td>235</td>
                                    <td>83</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Pete Burdine</h5>
                                        <span class="text-muted font-13">Form 1, Lenana School</span>
                                    </td>
                                    <td>365</td>
                                    <td>62</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Mary Nelson</h5>
                                        <span class="text-muted font-13">Grade 3, Lenana School</span>
                                    </td>
                                    <td>753</td>
                                    <td>258</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Kevin Grove</h5>
                                        <span class="text-muted font-13">Grade 12, BareBurn School</span>
                                    </td>
                                    <td>458</td>
                                    <td>73</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end col-->

        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-4">Recent Clients</h4>
                    @foreach ($latestCustomers as $customer)
                    <div class="d-flex align-items-start">
                        <img class="me-3 rounded-circle" src="{{ asset('assets/images/users/avatar-2.jpg') }}" width="40" alt="Generic placeholder image">
                        <div class="w-100 overflow-hidden">
                            <h5 class="mt-0 mb-1">{{ $customer->user->name }}</h5>
                            <span class="font-13">{{ $customer->user->email }}</span>
                        </div>
                    </div>
                    @endforeach


                    <div class="d-flex align-items-start mt-3">
                        <img class="me-3 rounded-circle" src="{{ asset('assets/images/users/avatar-4.jpg') }}" width="40" alt="Generic placeholder image">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-success-lighten float-end">Won lead</span>
                            <h5 class="mt-0 mb-1">Bryan J. Luellen</h5>
                            <span class="font-13">bryuellen@dayrep.com</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mt-3">
                        <img class="me-3 rounded-circle" src="{{ asset('assets/images/users/avatar-5.jpg') }}" width="40" alt="Generic placeholder image">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-warning-lighten float-end">Cold lead</span>
                            <h5 class="mt-0 mb-1">Kathryn S. Collier</h5>
                            <span class="font-13">collier@jourrapide.com</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mt-3">
                        <img class="me-3 rounded-circle" src="{{ asset('assets/images/users/avatar-1.jpg') }}" width="40" alt="Generic placeholder image">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-warning-lighten float-end">Cold lead</span>
                            <h5 class="mt-0 mb-1">Timothy Kauper</h5>
                            <span class="font-13">thykauper@rhyta.com</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mt-3">
                        <img class="me-3 rounded-circle" src="{{ asset('assets/images/users/avatar-6.jpg') }}" width="40" alt="Generic placeholder image">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-success-lighten float-end">Won lead</span>
                            <h5 class="mt-0 mb-1">Zara Raws</h5>
                            <span class="font-13">austin@dayrep.com</span>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

    </div>
    <!-- end row-->

</div>

@endsection
