@extends('pages.auth.layout.master')
@section('tittle', 'Login')

@push('css')
    <style>
        @media screen and (max-width:400px){
            #splash{
                display:none;
            }
        }

        #splash{
            object-fit: cover;
            height: 570px;
            opacity: 0.8;
            filter: blur(1px);
        }
    </style>

@endpush

@section('content')
    <div class="container">
        <div class="row p-lg-5 m-2">
                <div id="screen1" class="col-12 col-sm-6 p-0" >
                    <div class="card card-primary m-0">
                        <img id="splash" class="rounded" src="{{asset('base-template/dist/img/login-sulinggih.jpg')}}" alt="Product Image">
                    </div>
                </div>
                <div class="col-12 col-sm-6 p-0">
                    <div class="card card-primary mb-0">
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
                            <form  class="p-2" action="" method="post" id="form">
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
                                    <a href="{{route('auth.register.home')}}" class="text-decoration-none link-primary">DAFTAR DI SINI</a>
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
        </div>
    </div>
@endsection
