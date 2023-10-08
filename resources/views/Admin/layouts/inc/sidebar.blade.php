<!-- ========== App Menu ========== -->

<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('admin.index')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{get_file(setting()->logo_header)}}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{get_file(setting()->logo_header)}}" alt="" height="40">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('admin.index')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{get_file(setting()->logo_header)}}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{get_file(setting()->logo_header)}}" alt="" height="40">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.index')}}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li> <!-- end Dashboard Menu -->



                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('admins.index')}}">
                            <i class="fa fa-user-secret"></i> <span data-key="t-dashboards">Admins</span>
                        </a>
                    </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('consulting_setting.index')}}">
                        <i class="fa fa-handshake"></i> <span data-key="t-dashboards">Online Consulting Setting</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('online_consulting.index')}}">
                        <i class="fa fa-handshake"></i> <span data-key="t-dashboards">Online Consulting</span>
                    </a>
                </li> <!-- end Dashboard Menu -->




                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('sliders.index')}}">
                        <i class="fa fa-camera"></i> <span data-key="t-dashboards">Sliders</span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('about_us.index')}}">
                        <i class="fa fa-info"></i> <span data-key="t-dashboards">About Us </span>
                    </a>
                </li> <!-- end Dashboard Menu -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('faq_questions.index')}}">
                        <i class="fa fa-question-circle"></i> <span data-key="t-dashboards">Faq Questions</span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('reviews.index')}}">
                        <i class="fa fa-star"></i> <span data-key="t-dashboards">Review</span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('patients.index')}}">
                        <i class="fa fa-medkit"></i> <span data-key="t-dashboards">Patients Videos</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('authors.index')}}">
                        <i class="fa fa-user"></i> <span data-key="t-dashboards">Author</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('blogCategories.index')}}">
                        <i class="fa fa-list"></i> <span data-key="t-dashboards">Blog Category</span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('blogs.index')}}">
                        <i class="fa fa-blog"></i> <span data-key="t-dashboards">Blogs </span>
                    </a>
                </li> <!-- end Dashboard Menu -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('serviceCategories.index')}}">
                        <i class="fa fa-list"></i> <span data-key="t-dashboards">Service Categories </span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('services.index')}}">
                        <i class="fa fa-wrench"></i> <span data-key="t-dashboards">Services </span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('categoryMembers.index')}}">
                        <i class="fa fa-list"></i> <span data-key="t-dashboards">Our Team Categories </span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('members.index')}}">
                        <i class="fa fa-user-doctor"></i> <span data-key="t-dashboards">Our Teams </span>
                    </a>
                </li> <!-- end Dashboard Menu -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('galleries.index')}}">
                        <i class="fa fa-camera"></i> <span data-key="t-dashboards">Galleries </span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('partners.index')}}">
                        <i class="fa fa-handshake"></i> <span data-key="t-dashboards">Partners </span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('contacts.index')}}">
                        <i class="fa fa-envelope"></i> <span data-key="t-dashboards">Quotes </span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('settings.index')}}">
                        <i class="fa fa-cog"></i> <span data-key="t-dashboards">Settings </span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('dental_tourism.index')}}">
                        <i class="fa fa-tooth"></i> <span data-key="t-dashboards">Dental Tourism </span>
                    </a>
                </li> <!-- end Dashboard Menu -->



            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->


<div class="vertical-overlay"></div>




