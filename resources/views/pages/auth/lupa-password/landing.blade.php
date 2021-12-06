@extends('pages.auth.layout.master')

@section('tittle','Lupa Password')

@section('content')

    <div class="container p-lg-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 p-4">
                <div class="card card-primary">
                    <div class="card-header bg-white text-center">
                        <img class="rounded mx-auto d-block" src="{{asset('base-template/dist/img/logo-01.png') }}" alt="E-Yajamana" width="100" height="100">
                        <a href="" class="text-decoration-none h3 fw-bold">E-Yajamana</a>
                        <p class="login-box-msg mb-0 pb-0 px-0 pb-3 fw-bold mt-1">Pengubahan Kata Sandi</p>
                    </div>
                    <div class="card-body p-2">
                        <div class="text-center p-lg-3">
                            <p class="m-0">
                                Masukan E-Mail yang telah terhubung
                            </p>
                            <p class="m-0">
                                dengan akun E-Yajamana anda
                            </p>
                        </div>
                        <form action="#" method="POST" class="px-4 mb-2">
                            @csrf
                            <div class="col-md">
                                <div class="form-group mb-">
                                    <label>E-Mail</label>
                                    <div class="input-group">
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan E-mail">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end p-0">
                                    <button type="submit" class="btn btn-outline-primary btn-sm btn-block">Kirim Kode OTP</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="text-center my-xl-3 mt-lg-3 p-3">
                        <a href="" class="nav-link link-dark">E-Yajamana 2021 | All Right Reserved &copy </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
