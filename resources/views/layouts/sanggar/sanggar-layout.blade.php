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

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

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
    <!-- jQuery -->
    <script src="{{asset('base-template/plugins/jquery/jquery.min.js')}}"></script>

    @stack('css')

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        @include('layouts.sanggar.navbar-layout')

        @include('layouts.sanggar.sidebar-layout')

        @include('layouts.sanggar.content-layout')

        @include('layouts.sanggar.footer-layout')

    </div>

    <!-- overlayScrollbars -->
    <script src="{{asset('base-template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('base-template/dist/js/adminlte.js')}}"></script>
    <script src="{{asset('base-template\dist\js\sweetalert2.all.min.js')}}"></script>
    <!-- Bootstrabase-template-->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


    @stack('js')

    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyAwDQm7M6h2Jm30yZ2VzyI1uPgW3ZeLfrI",
            authDomain: "e-yajamana.firebaseapp.com",
            projectId: "e-yajamana",
            storageBucket: "e-yajamana.appspot.com",
            messagingSenderId: "521034262423",
            appId: "1:521034262423:web:6c9e5f7fdc80bf77a846d2",
            measurementId: "G-93GDMX9QYD"

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

