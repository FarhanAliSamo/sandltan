<!DOCTYPE html>
<html lang="en">


<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sandltan | Admin Pannel</title>
<link rel="shortcut icon" type="image/png" href="{{asset('assets/images/favicon.png')}}">

<link href="/assets/admin/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/admin/vendor/datatables/responsive/responsive.css" rel="stylesheet" type="text/css"/>
<link href="/assets/adminvendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css"/>



<link href="/assets/admin/vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css" rel="stylesheet"
    type="text/css" />
<link href="/assets/admin/vendor/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />



<link href="/assets/admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css" rel="stylesheet"
    type="text/css" />
<link href="/assets/admin/css/style.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('style')


</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    {{-- <div id="preloader">
        <div class="loader">
            <div class="dots">
                <div class="dot mainDot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>

        </div>
    </div>
     --}}
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper" class="wallet-open active">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index-2.html" class="brand-logo">
                {{-- <svg class="logo-abbr" xmlns="http://www.w3.org/2000/svg" width="62.074" height="65.771"
                    viewBox="0 0 62.074 65.771">
                    <g id="search_11_" data-name="search (11)" transform="translate(12.731 12.199)">
                        <rect class="rect-primary-rect" id="Rectangle_1" data-name="Rectangle 1" width="60"
                            height="60" rx="30" transform="translate(-10.657 -12.199)" fill="#f73a0b" />
                        <path id="Path_2001" data-name="Path 2001"
                            d="M32.7,5.18a17.687,17.687,0,0,0-25.8,24.176l-19.8,21.76a1.145,1.145,0,0,0,0,1.62,1.142,1.142,0,0,0,.81.336,1.142,1.142,0,0,0,.81-.336l19.8-21.76a17.687,17.687,0,0,0,29.357-13.29A17.57,17.57,0,0,0,32.7,5.18Zm-1.62,23.392A15.395,15.395,0,0,1,9.312,6.8,15.395,15.395,0,1,1,31.083,28.572Zm0,0"
                            transform="translate(1 0)" fill="#fff" stroke="#fff" stroke-width="1" />
                        <path id="Path_2002" data-name="Path 2002"
                            d="M192.859,115.547a4.523,4.523,0,0,0,.7-2.415v-2.284a4.55,4.55,0,0,0-9.1,0v2.284a4.523,4.523,0,0,0,.7,2.415,4.954,4.954,0,0,0-3.708,4.788v1.623a2.4,2.4,0,0,0,2.4,2.4h10.323a2.4,2.4,0,0,0,2.4-2.4v-1.623a4.954,4.954,0,0,0-3.708-4.788Zm-6.114-4.7a2.259,2.259,0,0,1,4.518,0v2.284a2.259,2.259,0,1,1-4.518,0Zm7.53,11.111a.11.11,0,0,1-.11.11H183.843a.11.11,0,0,1-.11-.11v-1.623a2.656,2.656,0,0,1,2.653-2.653h5.237a2.656,2.656,0,0,1,2.653,2.653Zm0,0"
                            transform="translate(-168.591 -98.178)" fill="#fff" stroke="#fff" stroke-width="1" />
                    </g>
                </svg>
                <svg class="brand-title" xmlns="http://www.w3.org/2000/svg" width="134.01" height="48.365"
                    viewBox="0 0 134.01 48.365">
                    <g id="Group_38" data-name="Group 38" transform="translate(-133.99 -40.635)">
                        <text id="Job_Admin_Dashboard" data-name="Job Admin Dashboard" transform="translate(134 85)"
                            fill="#787878" font-size="12" font-family="Poppins-Light, Poppins" font-weight="300">
                            <tspan x="0" y="0">Job Admin Dashboard</tspan>
                        </text>
                        <path id="Path_1948" data-name="Path 1948"
                            d="M.36,6.616a1.661,1.661,0,0,0,1.094-.422,1.287,1.287,0,0,0,.5-1.016V-11.738H7.52L7.551,5.271A8.16,8.16,0,0,1,6.91,8.789a4.074,4.074,0,0,1-2.2,1.985,11.542,11.542,0,0,1-4.346.657ZM17.651,9.68A7.316,7.316,0,0,1,13.7,8.617a7.008,7.008,0,0,1-2.626-2.97,9.786,9.786,0,0,1-.922-4.315,9.276,9.276,0,0,1,.907-4.174,6.935,6.935,0,0,1,2.6-2.877,7.438,7.438,0,0,1,4-1.047,7.607,7.607,0,0,1,4.018,1.032,6.8,6.8,0,0,1,2.611,2.861,9.349,9.349,0,0,1,.907,4.205,9.759,9.759,0,0,1-.922,4.33,6.993,6.993,0,0,1-2.642,2.955A7.4,7.4,0,0,1,17.651,9.68Zm0-4.565a1.753,1.753,0,0,0,1.438-.954,5.2,5.2,0,0,0,.625-2.83,4.8,4.8,0,0,0-.594-2.626,1.73,1.73,0,0,0-1.47-.907,1.694,1.694,0,0,0-1.454.907,4.908,4.908,0,0,0-.578,2.626,5.309,5.309,0,0,0,.61,2.83A1.718,1.718,0,0,0,17.651,5.115Zm17.478,4.6q-2.345,0-5.972-.375L27.75,9.18V-12.238h5.44V-6.11q.25-.094.844-.3a6.64,6.64,0,0,1,1.079-.281,6.807,6.807,0,0,1,1.079-.078,5.75,5.75,0,0,1,4.737,1.939q1.579,1.939,1.579,6.285,0,4.377-1.767,6.316T35.129,9.711Zm-.594-4.878a2.3,2.3,0,0,0,1.876-.719A4.131,4.131,0,0,0,37,1.551Q37-1.92,34.754-1.92q-.719,0-1.563.063v6.6A10.43,10.43,0,0,0,34.535,4.834ZM45.134-6.36h5.44V9.274h-5.44Zm.031-6.222h5.44V-7.36h-5.44ZM59.611,9.68a5.9,5.9,0,0,1-4.909-2q-1.595-2-1.595-6.222a12.451,12.451,0,0,1,.844-5.143A4.635,4.635,0,0,1,56.3-6.125a9.87,9.87,0,0,1,3.846-.641,13.2,13.2,0,0,1,2.095.188q1.157.188,3.033.625L65.145-1.7q-2.908-.219-3.627-.219a4.459,4.459,0,0,0-1.845.3,1.565,1.565,0,0,0-.844.985,6.976,6.976,0,0,0-.219,2A7.45,7.45,0,0,0,58.845,3.5a1.625,1.625,0,0,0,.86,1.032,4.362,4.362,0,0,0,1.813.3l3.6-.219L65.27,8.9A27.641,27.641,0,0,1,59.611,9.68Zm8.473-21.918h5.44V-.325l1.032-.406L76.714-6.36H82.78L79.4,1.207,83,9.274H76.9L74.744,3.958l-1.219.406V9.274h-5.44Z"
                            transform="translate(133.63 53.217)" fill="#464646" />
                    </g>
                </svg> --}}
                <img src="{{asset('assets/images/sandltan_logo_transparent.png')}}" class="logo_header" alt="">
                {{-- <h3 style="text-align: center" class="text-primary">Sandltan</h3> --}}


            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

        <!--**********************************
            Nav header end
        ***********************************-->



        <!--**********************************
 Header start
***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                Dashboard
                            </div>

                        </div>
                        <ul class="navbar-nav header-right">

                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell dlab-theme-mode p-0" href="javascript:void(0);">
                                    <i id="icon-light" class="fas fa-sun"></i>
                                    <i id="icon-dark" class="fas fa-moon"></i>

                                </a>
                            </li>

                            {{-- <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="javascript:void(0);" role="button"
                                    data-bs-toggle="dropdown">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <g data-name="Layer 2" transform="translate(-2 -2)">
                                            <path id="Path_20" data-name="Path 20"
                                                d="M22.571,15.8V13.066a8.5,8.5,0,0,0-7.714-8.455V2.857a.857.857,0,0,0-1.714,0V4.611a8.5,8.5,0,0,0-7.714,8.455V15.8A4.293,4.293,0,0,0,2,20a2.574,2.574,0,0,0,2.571,2.571H9.8a4.286,4.286,0,0,0,8.4,0h5.23A2.574,2.574,0,0,0,26,20,4.293,4.293,0,0,0,22.571,15.8ZM7.143,13.066a6.789,6.789,0,0,1,6.78-6.78h.154a6.789,6.789,0,0,1,6.78,6.78v2.649H7.143ZM14,24.286a2.567,2.567,0,0,1-2.413-1.714h4.827A2.567,2.567,0,0,1,14,24.286Zm9.429-3.429H4.571A.858.858,0,0,1,3.714,20a2.574,2.574,0,0,1,2.571-2.571H21.714A2.574,2.574,0,0,1,24.286,20a.858.858,0,0,1-.857.857Z" />
                                        </g>
                                    </svg>
                                    <span class="badge light text-white bg-primary rounded-circle">4</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div id="DZ_W_Notification1" class="widget-media dlab-scroll p-3"
                                        style="height:380px;">
                                        <ul class="timeline">
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media me-2">
                                                        <img alt="image" width="50"
                                                            src="/assets/admin/images/avatar/1.jpg">
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Dr sultads Send you Photo</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media me-2 media-info">
                                                        KG
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Resport created successfully</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media me-2 media-success">
                                                        <i class="fa fa-home"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Reminder : Treatment Time!</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media me-2">
                                                        <img alt="image" width="50"
                                                            src="/assets/admin/images/avatar/1.jpg">
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Dr sultads Send you Photo</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media me-2 media-danger">
                                                        KG
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Resport created successfully</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media me-2 media-primary">
                                                        <i class="fa fa-home"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Reminder : Treatment Time!</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="all-notification" href="javascript:void(0);">See all notifications <i
                                            class="ti-arrow-end"></i></a>
                                </div>
                            </li>
 --}}


                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button"
                                    data-bs-toggle="dropdown">
                                    <img src="/assets/admin/images/profile/pic1.jpg" width="20" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    {{-- <a href="app-profile.html" class="dropdown-item ai-icon">
                                        <svg id="icon-user2" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ms-2">Profile </span>
                                    </a> --}}
                                    {{-- <a href="email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox1" xmlns="http://www.w3.org/2000/svg" class="text-success"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                            </path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span class="ms-2">Inbox </span>
                                    </a> --}}
                                    <a  href="javascript:void(0);" onclick="logout();" class="dropdown-item ai-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12">
                                            </line>
                                        </svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>


        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <div class="dropdown header-profile2 ">
                    <a class="nav-link " href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                        <div class="header-info2 d-flex align-items-center">
                            <img src="/assets/admin/images/profile/pic1.jpg" alt="">
                            <div class="d-flex align-items-center sidebar-info">
                                <div>
                                    <span class="font-w400 d-block">{{Auth::user()->name}}</span>
                                    <small class="text-end font-w400">Superadmin</small>
                                </div>
                                <i class="fas fa-chevron-down"></i>
                            </div>

                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        {{-- <a href="app-profile.html" class="dropdown-item ai-icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span class="ms-2">Profile </span>
                        </a> --}}
                        {{-- <a href="email-inbox.html" class="dropdown-item ai-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <span class="ms-2">Inbox </span>
                        </a> --}}
                        <a  href="javascript:void(0);" onclick="logout();" class="dropdown-item ai-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span class="ms-2">Logout </span>
                        </a>
                    </div>
                </div>
                <ul class="metismenu" id="menu">
                    {{-- <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-025-dashboard"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index-2.html">Dashboard Light</a></li>
                            <li><a href="index-3.html">Dashboard Dark</a></li>
                            <li><a href="jobs-page.html">Jobs</a></li>
                            <li><a href="application-page.html">Application</a></li>
                            <li><a href="my-profile.html">Profile</a></li>
                            <li><a href="statistics-page.html">Statistics</a></li>
                            <li><a href="companies.html">Companies</a></li>
                        </ul>

                    </li> --}}
                    {{-- <li>

                        <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-093-waving"></i>
                            <span class="nav-text">Jobs</span>
                        </a>

                        <ul aria-expanded="false">
                            <li><a href="{{url('jobs')}}">Jobs</a></li>
                            <li><a href="{{url('industries')}}">Industries</a></li>
                            <li><a href="{{url('job_types')}}">Job Types</a></li>
                            <li><a href="{{url('job_seniorities')}}">Seniorities</a></li>
                            <li><a href="{{url('job_experiences')}}">Experiences</a></li>
                        </ul>

                    </li> --}}

                    <li><a href="{{route('admin.users.index')}}" ><i class="fa-solid fa-user"></i><span class="nav-text">Users</span></a></li>

                    <li><a href="{{route('admin.users.questions')}}" ><i class="fa-solid fa-user"></i><span class="nav-text">User Questions</span></a></li>




                </ul>

            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->



        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body ">
            @yield('main_content')
        </div>



        <!--**********************************
            Content body end
        ***********************************-->
        <form id="company-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>






        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Job Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Company Name</label>
                                <input type="text" class="form-control solid" placeholder="Name"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Position</label>
                                <input type="text" class="form-control solid" placeholder="Name"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Job Category</label>
                                <select class="default-select wide form-control solid">
                                    <option selected>Choose...</option>
                                    <option>QA Analyst</option>
                                    <option>IT Manager</option>
                                    <option>Systems Analyst</option>
                                </select>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Job Type</label>
                                <select class="default-select wide form-control solid">
                                    <option selected>Choose...</option>
                                    <option>Part-Time</option>
                                    <option>Full-Time</option>
                                    <option>Freelancer</option>
                                </select>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">No. of Vancancy</label>
                                <input type="text" class="form-control solid" placeholder="Name"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Select Experience</label>
                                <select class="default-select wide form-control solid">
                                    <option selected>1 yr</option>
                                    <option>2 Yr</option>
                                    <option>3 Yr</option>
                                    <option>4 Yr</option>
                                </select>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Posted Date</label>
                                <div class="input-hasicon">
                                    <input name="datepicker" class="form-control solid bt-datepicker">
                                    <div class="icon"><i class="far fa-calendar"></i></div>
                                </div>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Last Date To Apply</label>
                                <div class="input-hasicon">
                                    <input name="datepicker" class="form-control solid bt-datepicker">
                                    <div class="icon"><i class="far fa-calendar"></i></div>
                                </div>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Close Date</label>
                                <div class="input-hasicon">
                                    <input name="datepicker" class="form-control solid bt-datepicker">
                                    <div class="icon"><i class="far fa-calendar"></i></div>
                                </div>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Select Gender:</label>
                                <select class="default-select wide form-control solid">
                                    <option selected>Choose...</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Salary Form</label>
                                <input type="text" class="form-control solid" placeholder="$"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Salary To</label>
                                <input type="text" class="form-control solid" placeholder="$"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Enter City:</label>
                                <input type="text" class="form-control solid" placeholder="City"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Enter State:</label>
                                <input type="text" class="form-control solid" placeholder="State"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Enter Counter:</label>
                                <input type="text" class="form-control solid" placeholder="State"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Enter Education Level:</label>
                                <input type="text" class="form-control solid" placeholder="Education Level"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-12 mb-4">
                                <label class="form-label required">Description:</label>
                                <textarea class="form-control solid" rows="5" aria-label="With textarea"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>



        <!--**********************************
   Footer start
  ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://venturequeue.com/"
                        target="_blank">venturequeue</a> 2025</p>
            </div>
        </div>

    </div>
    <script>
        var asset_base_url = 'index.html';
    </script>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--***********************************-->



    <!--**********************************
  Modal
 ***********************************-->
    <!--**********************************
        Scripts
    ***********************************-->


    <script src="/assets/admin/vendor/global/global.min.js" type="text/javascript"></script>
    <script src="/assets/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/assets/admin/vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/assets/admin/vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/assets/admin/vendor/apexchart/apexchart.js" type="text/javascript"></script>
    <script src="/assets/admin/vendor/chartjs/chart.bundle.min.js" type="text/javascript"></script>
    <script src="/assets/admin/vendor/peity/jquery.peity.min.js" type="text/javascript"></script>
    <script src="/assets/admin/js/dashboard/dashboard-1.js" type="text/javascript"></script>
    <script src="/assets/admin/vendor/owl-carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="/assets/admin/vendor/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="/assets/admin/vendor/datatables/responsive/responsive.js" type="text/javascript"></script>
    <script src="/assets/admin/js/plugins-init/datatables.init.js" type="text/javascript"></script>
    <script src="/assets/admin/js/custom.min.js" type="text/javascript"></script>
    <script src="/assets/admin/js/dlabnav-init.js" type="text/javascript"></script>
    <script src="/assets/admin/js/demo.js" type="text/javascript"></script>
    {{-- <script src="/assets/admin/js/styleSwitcher.js" type="text/javascript"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function logout() {
        event.preventDefault();
        document.getElementById('company-logout-form').submit();
    }


    </script>

    @yield('script')


</body>

</html>
