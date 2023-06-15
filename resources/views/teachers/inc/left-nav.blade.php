 <!-- ========== Left Sidebar Start ========== -->
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
                <a href="{{ route('teacher.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Subjects </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="uil-graph-bar"></i>
                    <span> Subjects </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{ route('get_subjects') }}"  class="side-nav-link">
                                <i class="uil-dollar-sign"></i>
                                <span> Create Subjects </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ isset($educationSystemId) ? route('topics_strands.index', ['educationSystemId' => $educationSystemId, 'educationLevelId' => $educationLevelId, 'subjectId' => $subjectId]) : '#' }}" class="side-nav-link">
                                <i class="uil-chart-line"></i>
                                <span> Create Topics/Strands </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="" class="side-nav-link">
                                <i class="uil-chart-line"></i>
                                <span> Create SubTopics/SubStrands </span>
                            </a>
                        </li>






                    </ul>
                </div>
            </li>



            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="uil-graph-bar"></i>
                    <span> Questions </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{ route('get_questions') }}"  class="side-nav-link">
                                <i class="uil-dollar-sign"></i>
                                <span> View Questions </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('create_question') }}" class="side-nav-link">
                                <i class="uil-chart-line"></i>
                                <span> Create Questions </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="uil-book-open"></i>
                    <span> Notes </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="uil-graph-bar"></i>
                    <span> Reports </span>
                </a>
            </li>



        </ul>



        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
