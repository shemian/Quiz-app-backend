<div class="leftside-menu">

    <!-- LOGO -->
    <a href="" class="logo text-center logo-light" style="font-size: 29px; font-weight: bold;">
        Centy<span>Plus</span>
    </a>


    <!-- LOGO -->
    <a href="" class="logo text-center logo-dark">
        Centy<span>Plus</span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>


            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('get_customers') }}" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Customers </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('get_teachers') }}" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Teachers </span>
                </a>
            </li>


            <li class="side-nav-item">
                <a href="{{ route('view_students') }}" class="side-nav-link">
                    <i class="uil-user"></i>
                    <span> Students </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="uil-book-open"></i>
                    <span> Lessons </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#"class="side-nav-link">
                    <i class="uil-comment"></i>
                    <span> SMS </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="uil-dollar-sign"></i>
                    <span> Transactions </span>
                </a>
            </li>



            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="uil-graph-bar"></i>
                    <span> Statistics </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <i class="uil-dollar-sign"></i>
                                <span> Transactions </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <i class="uil-chart-line"></i>
                                <span> Students Report </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEducation" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="uil-graph-bar"></i>
                    <span> Education </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEducation">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{ route('get_education_system') }}" class="side-nav-link">
                                <i class="uil-dollar-sign"></i>
                                <span> Education System </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('get_education_level') }}" class="side-nav-link">
                                <i class="uil-chart-line"></i>
                                <span> Education Level </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="uil-bright"></i>
                    <span> Settings </span>
                </a>
            </li>

        </ul>

        <!-- <div class="clearfix"></div> -->

    </div>
    <!-- Sidebar -left -->

</div>
