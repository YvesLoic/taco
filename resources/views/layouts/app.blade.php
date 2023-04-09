<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/typography.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body class="@yield('body_class')">

<div id="wrapper">
    @yield('content')
</div>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.appear.js')}}"></script>
<script src="{{asset('assets/js/countdown.min.js')}}"></script>
<script src="{{asset('assets/js/waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/wow.min.js')}}"></script>
<script src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/js/smooth-scrollbar.js')}}"></script>
<script src="{{asset('assets/js/lottie.js')}}"></script>
<script src="{{asset('assets/js/chart-custom.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
@yield('scripts')
</body>
</html>
