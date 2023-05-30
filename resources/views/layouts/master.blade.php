<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Quiz App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
       
        <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}" type="text/css" id="light-style">
        <link rel="stylesheet" href="{{ asset('assets/css/app-dark.min.css') }}" type="text/css" id="dark-style">
        

    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="wrapper">
            <!-- Left Sidebar Start  -->
            @include('layouts.inc.left-navbar')
            <!-- Left Sidebar End -->


            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    @include('layouts.inc.navbar')
                    <!-- end Topbar -->
                    
                    <!-- Start Content-->
                    @yield('content')
                    

                </div>

                @include('layouts.inc.footer')
           

            </div>



        </div>
        
        @include('layouts.inc.right-navbar')

        <div class="rightbar-overlay"></div>

        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
       

        <!-- Apex js -->
        
        <script src="{{ asset('assets/js/vendor/apexcharts.min.js') }}"></script>

        <!-- Todo js -->
        <script src="{{ asset('assets/js/ui/component.todo.js') }}"></script>

        <!-- demo app -->
        <script src="{{ asset('assets/js/pages/demo.dashboard-crm.js') }}"></script>
        <!-- end demo js-->
        
    
        
        
    </body>
</html>