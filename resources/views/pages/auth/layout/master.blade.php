<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('base-template/dist/img/logo-01.png') }}">
    <title>E-Yajamana | @yield('tittle')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('base-template/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

    <script src="{{asset('base-template\dist\js\sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('base-template\dist\css\sweetalert2.min.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style type="text/css">
        body {
            font-family: Nunito !important;
        }
    </style>
    @stack('css')


</head>

<body class="login-page m-3">
    @yield('content')
</body>


<!-- jQuery -->
<script src="{{url('base-template/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

@stack('js')

<script src="{{asset('base-template\dist\js\sweetalert2.all.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('base-template/dist/js/adminlte.js')}}"></script>

<script>
    @if(Session::has('status'))
        Swal.fire({
            icon:  @if(Session::has('icon')){!! '"'.Session::get('icon').'"' !!} @else 'question' @endif,
            title: @if(Session::has('title')){!! '"'.Session::get('title').'"' !!} @else 'Oppss...'@endif,
            text: @if(Session::has('message')){!! '"'.Session::get('message').'"' !!} @else 'Oppss...'@endif,
        });
    @endif
</script>

</html>
