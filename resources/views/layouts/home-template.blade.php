<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Backoffice - {{ $pageTitle ?? 'Untitled Page' }}</title>
    <link rel="stylesheet" href=" {{ asset('assets/css/dm.css') }} ">
    <!-- Favicon -->
    <link rel="shortcut icon" href=" {{ asset('assets/images/favicon.ico') }} " />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href=" {{ asset('assets/css/typography.css') }} ">
    <!-- Style CSS -->
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href=" {{ asset('assets/css/responsive.css') }} ">


</head>

<body>
    <!-- loader Start -->
    <div id="loading">

    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

        @include('partials.sidebar')
        @include('partials.header')

        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            @yield('content')
        </div>
    </div>
    <!-- Wrapper END -->
    <!-- Footer -->
    <footer class="bg-white iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    Copyright 2020 <a href="{{ url('/') }}">DMBackOffice</a> All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src=" {{ asset('assets/js/jquery.min.js') }} "></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
    <!-- Countdown JavaScript -->
    <script src="{{ asset('assets/js/countdown.min.js') }}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{ asset('assets/js/apexcharts.js') }} "></script>
    <!-- Slick JavaScript -->
    <script src=" {{ asset('assets/js/slick.min.js') }} "></script>
    <!-- Select2 JavaScript -->
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('assets/js/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/lottie.js') }}"></script>
    <!-- core JavaScript -->
    <script src="{{ asset('assets/js/core.js') }}"></script>
    <!-- charts JavaScript -->
    <script src="{{ asset('assets/js/charts.js') }}"></script>
    <!-- animated JavaScript -->
    <script src="{{ asset('assets/js/animated.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('assets/js/chart-custom.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="{{ asset('assets/js/dm.js') }}"></script>

    @yield('script')
</body>

</html>
