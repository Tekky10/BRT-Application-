<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">

    <!-- favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/favicon-apple.png') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-4.1.3/css/bootstrap.min.css') }}">

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/materializeicon/material-icons.css') }}">

    <!-- aniamte CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/animatecss/animate.css') }}">

    <!-- swiper slider CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/swiper/css/swiper.min.css') }}">

    <!-- app CSS -->
    <link id="theme" rel="stylesheet" href="{{ asset('css/purplesidebar.css') }}" type="text/css">

    <title>GoTRI  - Mobile</title>
</head>
<!-- We have added other header footer referances are commented you can still use these element if you want it to be in page -->
<!-- body class="fixed-header sidebar-right-close sidebar-left-close" -->
<body class="fixed-header sidebar-right-close sidebar-left-close">
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

<div class="wrapper h-100  h-sm-auto justify-content-center pink-gradient">
    <!-- main header -->
<!-- header class="main-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-auto pl-0">
                    <button class="btn pink-gradient btn-icon" id="left-menu"><i class="material-icons">widgets</i></button>
                    <a href="index.html" class="logo"><img src="{{ asset('img/logo-icon.png') }}" alt=""><span class="text-hide-xs"><b>Go</b>TRI</span></a>
                </div>
                <div class="col-auto ml-auto">
                    <button class="btn btn-link text-hide-md header-color-secondary font-small px-0" type="button"><i class="material-icons">text_format</i></button>
                    <button class="btn btn-link text-hide-md header-color-secondary font-big px-0 mr-3" type="button"><i class="material-icons">text_format</i></button>
                    <a href="signup1.html" class="btn pink-gradient btn-sm rounded d-inline-block" ><i class="material-icons">person</i> Sign Up</a>
                </div>
            </div>
        </div>
    </header -->
    <!-- main header ends -->

    <!-- sidebar left -->

    <div class="backdrop"></div>
    <!-- sidebar left ends -->



    <!-- content page -->
<!-- div class="carosel swiper-location-carousel bg-dark background-img position-fixed">
        <div data-pagination='{"el": ".swiper-pagination"}' data-space-between="0" data-slides-per-view="1" class="swiper-container swiper-init swiper-signin h-100">
            <div class="swiper-pagination"></div>
            <div class="swiper-wrapper">
                <div class="swiper-slide text-center ">
                    <div class="background-img"><img src="{{ asset('img/banner.png') }}" alt="" class="w-auto"></div>
                </div>
                <div class="swiper-slide text-center">
                    <div class="background-img"><img src="{{ asset('img/banner2.png') }}" alt="" class="w-auto"></div>
                </div>
            </div>
        </div>
    </div -->
    <div class="container h-100  h-sm-auto align-items-center ">
        <div class="row align-items-center h-100  h-sm-auto">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto text-center">
                <h2 class="font-weight-light mb-3 text-white mt-3">Go<span class="font-weight-normal">BRT</span></h2>
                <h5 class="font-weight-light mb-5 text-white text-center">Welcome back,<br>Please sign in to your account.</h5>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="card mb-2">
                        <div class="card-body p-0">

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <label for="name" class="sr-only">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control text-center form-control-lg border-0 @error('name') is-invalid @enderror" placeholder="Your Name" value="{{ old('name') }}"  required="" autofocus="">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <hr class="my-0">
                        <label for="email" class="sr-only">Email address</label>
                        <input type="email" id="email" name="email" class="form-control text-center form-control-lg border-0 @error('email') is-invalid @enderror" placeholder="Email address" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <hr class="my-0">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" type="password" name="password" class="form-control text-center form-control-lg border-0 @error('password') is-invalid @enderror" placeholder="Password" required="">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <hr class="my-0">
                        <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" name="password_confirmation" class="form-control text-center form-control-lg border-0 @error('password_confirmation') is-invalid @enderror" placeholder="Password" required="">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <!--
                    <small class="form-text text-white text-center">This is basic html demo page. Click on Sign in button and you will be redirected to dashbaord admin page.</small>
                    -->

                    <div class="my-4 row">
                        <div class="col-12  text-center">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck111" checked>
                                <label class="custom-control-label text-white" for="customCheck111">Accept our <a href="">Terms and Conditions</a>.</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success success-gradient">
                            {{ __('Register') }}
                        </button>

                    </div>
                </form>
                <br>
                <div class="text-center mb-4">


                        <a class="text-white" href="{{ route('login') }}">
                            Already have an account?
                        </a>

                </div>

            </div>
        </div>
    </div>
    <!-- content page ends -->

</div>
<!-- footer class="border-top">
    <div class="row">
        <div class="col-12 col-sm-6 text-white">This template is designed by <b>maxartkiller</b> with <span class="text-danger">❤</span></div>
        <div class="col-12 col-sm-6 text-right text-white"><a href="" class="text-white">Privacy Policy</a> | <a href="" class="text-white">Terms of use</a></div>
    </div>
</footer -->




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-4.1.3/js/bootstrap.min.js') }}"></script>

<!-- Cookie jquery file -->
<script src="{{ asset('vendor/cookie/jquery.cookie.js') }}"></script>

<!-- swiper slider jquery file -->
<script src="{{ asset('vendor/swiper/js/swiper.min.js') }}"></script>

<!-- Application main common jquery file -->
<script src="{{ asset('js/main.js') }}"></script>

<!-- page specific script -->
<script>
    'use strict';
    var mySwiper = new Swiper('.swiper-signin', {
        slidesPerView: 1,
        spaceBetween: 0,
        autoplay: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        }
    });

</script>
</body>

</html>


