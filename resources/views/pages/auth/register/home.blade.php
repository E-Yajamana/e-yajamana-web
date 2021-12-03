@extends('pages.auth.layout.master')
@section('tittle','Login')

@section('content')

    <div class="container p-lg-4">
        <div class="card card-primary p-lg-2">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('base-template/dist/img/logo-01.png') }}" alt="sipandu logo" width="100" height="100">
                <p class="login-box-msg mb-0 pb-0 px-0 fw-bold h6 mt-2 mb-1"> Selamat Datang di Pendaftaran Akun</p>
                <a href="" class="text-decoration-none h3 fw-bold mb-2">E-Yajamana</a>
            </div>
            <div class="card-body">
                <p class="text-center pb-2 fs-6">Pilihlah jenis akun yang akan digunakanan :</p>
                <div class="row justify-content-center p-2">
                    <div class="col-12 col-sm-3" data-category="1" data-sort="white sample">
                        <div class="card p-2 shadow cursor" role="button">
                            <img src="{{asset('base-template/dist/img/jenis-user/kramabali.jpg')}}" style="height:200px; object-fit:cover; opacity : 0.9 " alt="white sample"/>
                            <button class="btn btn-block btn-primary " style="opacity:80%" onclick="stepper.next()">KRAMA BALI</button>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3" data-category="1" data-sort="white sample">
                        <div class="card p-2 shadow cursor" role="button">
                            <img src="{{asset('base-template/dist/img/jenis-user/sulinggih.jpg')}}" style="height:200px; object-fit:cover; opacity : 0.9" alt="white sample"/>
                            <button class="btn btn-block btn-primary" style="opacity:80%" onclick="stepper.next()">SANG SULINGGIH</button>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3" data-category="1" data-sort="white sample">
                        <div class="card p-2 shadow cursor" role="button">
                            <img src="{{asset('base-template/dist/img/jenis-user/sanggar.jpg')}}" style="height:200px; object-fit:cover; opacity : 0.9" alt="white sample"/>
                            <button class="btn btn-block btn-primary" style="opacity:80%" onclick="stepper.next()">SANGGAR BALI</button>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3" data-category="1" data-sort="white sample">
                        <div class="card p-2 shadow cursor" role="button">
                            <img src="{{asset('base-template/dist/img/jenis-user/serati.jpg')}}" style="height:200px; object-fit:cover; opacity : 0.9" alt="white sample"/>
                            <button class="btn btn-block btn-primary" style="opacity:80%" onclick="stepper.next()">SERATI</button>
                        </div>
                    </div>
                </div>


            </div>
            <div class="text-center mt-4 mb-2">
                <a class="nav-link link-dark">E-Yajamana 2021 | All Right Reserved &copy </a>
            </div>
        </div>
    </div>

@endsection
