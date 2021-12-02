<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/sipandu-logo.ico') }}">
    <title>E-Yajamana | Login</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{url('base-template/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/dist/css/adminlte.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 300;
        }
    </style>

</head>
<body class="hold-transition login-page">


    <div class="login-box">
        <div class="card car card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('base-template/dist/img/logo-01.png') }}" alt="sipandu logo" width="100" height="100">
                <p class="login-box-msg mb-0 pb-0 px-0 fw-bold h6 mt-2 mb-1"> Selamat Datang di Sistem</p>
                <a href="" class="text-decoration-none h4 fw-bold m-2">E-Yajamana</a>
            </div>
            <div class="card-body">
                <p class="text-center pb-2 fs-6">Silakan Login untuk masuk ke sistem</p>
                @if (session('message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('message')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form  action="" method="post" id="form">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-block float-lg-right mb-4 mt-2">Masuk</button>
                </form>
                <div class="text-center mt-1">
                    <p class="mb-1">
                        Belum memiliki akun ?
                        <a href="#" class="text-decoration-none link-primary">DAFTAR DI SINI</a>
                    </p>
                    <p class="mb-1">
                        Lupa password ?
                        <a href="#" class="text-decoration-none link-primary">PULIHKAN DI SINI</a>
                    </p>
                </div>

            </div>
            <div class="text-center mt-4 mb-2">
                <a class="nav-link link-dark">E-Yajamana 2021 | All Right Reserved &copy </a>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{url('base-template/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('base-template/dist/js/adminlte.js')}}"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
