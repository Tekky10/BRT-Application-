<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/favicon-apple.png') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-4.1.3/css/bootstrap.min.css') }}">


    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/materializeicon/material-icons.css') }}">

    <!-- aniamte CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/animatecss/animate.css') }}">

    <!-- swiper carousel CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/swiper/css/swiper.min.css') }}">

    <!-- daterange CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-daterangepicker-master/daterangepicker.css') }}">

    <!-- footable CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/footable-bootstrap/css/footable.bootstrap.min.css') }}">

    <!-- jvector map CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.css') }}">

    <!-- app CSS -->
    <link id="theme" rel="stylesheet" href="{{ asset('css/purplesidebar.css') }}" type="text/css">

    <script type="text/javascript"
            src="http://maps.google.com/maps/api/js?key=AIzaSyA3I5PIz5DLWYw8Sp3S4HKXLHLsxXbbT9o&sensor=false"></script>
    <script type ="text/javascript" src="{{ asset('js/v3_epoly.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mapscript.js') }}"></script>

    @yield('css')
    <title>{{ config('app.name', 'GoBRT') }}</title>


</head>
<body class="fixed-header sidebar-right-close sidebar-left-close" onload="initialize()">
<!-- page loader -->
<div class="loader justify-content-center pink-gradient">
    <div class="align-self-center text-center">
        <div class="logo-img-loader">
            <img src="{{ asset('img/loader-hole.png') }}" alt="" class="logo-image">
            <img src="{{ asset('img/loader-bg.png') }}" alt="" class="logo-bg-image">
        </div>
        <h2 class="mt-3 font-weight-light">GoBRT<br><small>- P R O J E C T -</small></h2>
        <p class="mt-2 text-white">Loading...</p>
    </div>
</div>
<!-- page loader ends  -->

<div class="wrapper">

    <!-- main header -->
    <header class="main-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-auto px-0">
                    <button class="btn pink-gradient btn-icon" id="left-menu"><i class="material-icons">widgets</i></button>
                    <a href="{{url("/home")}}" class="logo"><img src="{{ asset('img/logo-icon.png') }}" alt=""><span class="text-hide-xs"><b>Go</b>TRI<br><span class="small">- M O B I L E -</span></span>
                    </a>
                    <form class="search-header">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn " type="button"><i class="material-icons">search</i></button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col px-0 text-right">

                    <div class="dropdown d-inline-block text-hide-xs">
                        <a class="btn header-color-secondary btn-icon dropdown-toggle caret-none" href="#" role="button" id="dropdownmessage2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <figure class="avatar avatar-24 vm d-inline-block border"><img src="{{ asset('img/nigeria.png') }}" alt=""></figure>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownmessage2">
                            <div class="dropdown-item">
                                <figure class="avatar avatar-24 mr-2 vm d-inline-block"><img src="{{ asset('img/nigeria.png') }}" alt=""></figure> India
                            </div>

                        </div>
                    </div>


                    <div class="dropdown d-inline-block">
                        <a class="btn header-color-secondary dropdown-toggle username" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <figure class="userpic"><img src="{{ asset('img/user1.png') }}" alt=""></figure>
                            <h5 class="text-hide-xs">
                                <small class="header-color-secondary">Welcome,</small>
                                <span class="header-color-primary">{{ Auth::user()->name }}</span>
                            </h5>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown" aria-labelledby="dropdownMenuLink">
                            <div class="card">
                                <div class="card-body text-center">
                                    <a href="profile.html">
                                        <figure class="avatar avatar-120 mx-auto my-3">
                                            <img src="{{ asset('img/user1.png') }}" alt="">
                                        </figure>
                                        <h5 class="card-title mb-2 header-color-primary">{{ Auth::user()->name }}</h5>
                                        <h6 class="card-subtitle mb-3 header-color-secondary">Nigeria</h6>
                                    </a>

                                </div>
                            </div>

                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item pink-gradient-active" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <div class="row align-items-center">
                                    <div class="col">
                                        Logout
                                    </div>

                                    <div class="col-auto">
                                        <div class="text-danger ml-2"><i class="material-icons vm">exit_to_app</i></div>
                                    </div>
                                </div>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- main header ends -->

    <!-- sidebar left -->
    <div class="sidebar sidebar-left">
        <div class="container has-background-img">
            <figure class="background-img pink-gradient">
                <img src="{{ asset('img/singer-690117_640.jpg') }}" alt="" class="">
            </figure>
            <div class="media w-100 my-3">
                <figure class="avatar avatar-40 rounded-circle align-self-start ">
                    <label class="checkbox-user-check">
                        <input type="checkbox">
                        <i class="material-icons">check</i>
                    </label>
                    <img src="{{ asset('img/user1.png') }}" alt="Generic placeholder image">
                </figure>
                <div class="media-body mx-70">
                    <h5 class="time-title mb-0 text-white">{{ Auth::user()->name }}</h5>
                    <p class="mb-0 text-truncate text-white">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{url("/home")}}" class="nav-link"><i class="material-icons icon">insert_chart_outlined</i> <span>Dashboard</span></a>

            </li>
            <li class="nav-item">
                <a href="{{url("/brteta")}}" class="nav-link dropdwown-toggle"><i class="material-icons icon">timer</i> <span>BRT ETA</span></a>

            </li>

            <li class="nav-item">
                <a href="{{url("/track")}}" class="nav-link dropdwown-toggle"><i class="material-icons icon">directions_bus</i> <span>Track BRT</span></a>

            </li>
            <li class="nav-item">
                <a href="{{url("/search")}}" class="nav-link"><i class="material-icons icon">search</i> <span>Search Schedule</span></a>

            </li>
            <li class="nav-item">
                <a href="{{url("/review")}}" class="nav-link"><i class="material-icons icon">insert_emoticon</i> <span>Review BRT</span></a>

            </li>

        </ul>
    </div>
    <div class="backdrop"></div>
    <!-- sidebar left ends -->




    @yield('content')

</div>
    <footer class="border-top text-center">
        <div class="row">
            <div class="col-12">This project is designed by <b> Emmanuel Sounyo Tekena</b></div>
            <!--<div class="col-12"><a href="" class="content-color-secondary">Privacy Policy</a> | <a href="" class="content-color-secondary">Terms of use</a></div>-->
        </div>
    </footer>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.1.3/js/bootstrap.min.js') }}"></script>

    <!-- Cookie jquery file -->
    <script src="{{ asset('vendor/cookie/jquery.cookie.js') }}"></script>

    <!-- sparklines chart jquery file -->
    <script src="{{ asset('vendor/sparklines/jquery.sparkline.min.js') }}"></script>

    <!-- Circular progress gauge jquery file -->
    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>

    <!-- Swiper carousel jquery file -->
    <script src="{{ asset('vendor/swiper/js/swiper.min.js') }}"></script>

    <!-- Chart js jquery file -->
    <script src="{{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chartjs/utils.js') }}"></script>

<!-- Footable jquery file -->
<script src="{{ asset('vendor/footable-bootstrap/js/footable.min.js') }}"></script>

    <!-- datepicker jquery file -->
    <script src="{{ asset('vendor/bootstrap-daterangepicker-master/moment.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-daterangepicker-master/daterangepicker.js') }}"></script>

    <!-- jVector map jquery file -->
    <script src="{{ asset('vendor/jquery-jvectormap/jquery-jvectormap.js') }}"></script>
    <script src="{{ asset('vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- circular progress file -->
    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>

<!-- jquery toast message file -->
<script src="{{ asset('vendor/jquery-toast-plugin-master/dist/jquery.toast.min.js') }}"></script>

    <!-- Application main common jquery file -->
    <script src="{{ asset('js/main.js') }}"></script>

@yield('js')
    <!-- page specific script -->
</body>
</html>
