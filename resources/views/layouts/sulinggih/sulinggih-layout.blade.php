<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Yajamana | @yield('tittle') </title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style type="text/css">
        body {
            font-family: Nunito !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('base-template/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

    <script src="{{asset('base-template\dist\js\sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('base-template\dist\css\sweetalert2.min.css')}}">
    <link rel="icon" type="image/png" href="{{ asset('base-template/dist/img/logo-01.png') }}">

    @stack('css')

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        @include('layouts.sulinggih.navbar-layout')

        @include('layouts.sulinggih.sidebar-layout')

        @include('layouts.sulinggih.content-layout')

        @include('layouts.sulinggih.footer-layout')

    </div>

    <!-- jQuery -->
    <script src="{{asset('base-template/plugins/jquery/jquery.min.js')}}"></script>

    <!-- overlayScrollbars -->
    <script src="{{asset('base-template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('base-template/dist/js/adminlte.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="{{asset('base-template\dist\js\sweetalert2.all.min.js')}}"></script>

    @stack('js')

    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyAi5-GWTruT_bF15xnbUAGR9c5afq5P_as",
            authDomain: "eyajamana-website.firebaseapp.com",
            // databaseURL: 'https://project-id.firebaseio.com',
            projectId: "eyajamana-website",
            storageBucket: "eyajamana-website.appspot.com",
            messagingSenderId: "980955733639",
            appId: "1:980955733639:web:65b9823c8ff9ff0e0e2222",
            measurementId: "G-XCMZ3MKTZJ"

        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        startFCM();

        function startFCM() {
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function (response) {
                    // console.log(response)
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('notification.save-token')}}",
                        type: 'PATCH',
                        data: {
                            token: response,
                        },
                        dataType: "JSON",
                        success: function (response) {
                            // console.log(response)
                        },
                        error: function (error) {
                            // console.log(error)
                        },
                    });
                    // console.log(response)
                }).catch(function (error) {
                    alert(error);
                });
        }

        messaging.onMessage(function (payload) {
            console.log(payload)
            const title = payload.data.title;
            const options = {
                body: payload.data.body,
                // icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
    </script>

    <script>
        @if(Session::has('status'))
            Swal.fire({
                icon:  @if(Session::has('icon')){!! '"'.Session::get('icon').'"' !!} @else 'question' @endif,
                title: @if(Session::has('title')){!! '"'.Session::get('title').'"' !!} @else 'Oppss...'@endif,
                text: @if(Session::has('message')){!! '"'.Session::get('message').'"' !!} @else 'Oppss...'@endif,
            });
        @endif
    </script>
</body>
</html>

