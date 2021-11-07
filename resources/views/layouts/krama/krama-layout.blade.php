<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Yajamana | @yield('tittle') </title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <style type="text/css">
        body {
            font-family: Nunito !important;
        }
    </style>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('base-template/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">


    @stack('css')

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        @include('layouts.krama.navbar-layout')

        @include('layouts.krama.sidebar-layout')

        @include('layouts.krama.content-layout')

        @include('layouts.krama.footer-layout')

    </div>

    <!-- jQuery -->
    <script src="{{asset('base-template/plugins/jquery/jquery.min.js')}}"></script>

    <!-- overlayScrollbars -->
    <script src="{{asset('base-template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('base-template/dist/js/adminlte.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    @stack('js')

</body>
</html>

