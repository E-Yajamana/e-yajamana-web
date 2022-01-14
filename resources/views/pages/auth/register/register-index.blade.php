@extends('pages.auth.layout.master')
@section('tittle','Login')

@section('content')

    <div class="container p-lg-4">
        <div class="card card-primary p-lg-2">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{asset('base-template/dist/img/logo-01.png') }}" alt="sipandu logo" width="100" height="100">
                <p class="login-box-msg mb-0 pb-0 px-0 fw-bold h4 mt-2 mb-1"> Selamat Datang di Pendaftaran Akun</p>
                <a href="" class="text-decoration-none h2 fw-bold mb-2">E-Yajamana</a>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <p class="pb-2  fs-6 bold">Pilihlah jenis akun yang akan digunakanan :</p>
                </div>

                <div class="row justify-content-center p-2">
                    <div class="col-12 col-sm-4" data-category="1" data-sort="white sample">
                        <a style="text-decoration: none;" href="{{route('auth.register.form.akun','krama')}}">
                            <div class="card p-2 shadow cursor" role="button">
                                <label class="text-center m-0 p-1 text-dark">KRAMA BALI</label>
                                <img src="{{asset('base-template/dist/img/jenis-user/kramabali.jpg')}}" style="height:190px; object-fit:cover; opacity : 0.9 " alt="white sample"/>
                                {{-- <button class="btn btn-outline-primary " style="opacity:80%" onclick="stepper.next()">KRAMA BALI</button> --}}
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-4" data-category="1" data-sort="white sample">
                        <a style="text-decoration: none;" href="{{route('auth.register.form.akun','sulinggih')}}">
                            <div class="card p-2 shadow cursor" role="button">
                                <label class="text-center m-0 p-1 text-dark">SULINGGIH</label>
                                <img src="{{asset('base-template/dist/img/jenis-user/sulinggih.jpg')}}" style="height:190px; object-fit:cover; opacity : 0.9" alt="white sample"/>
                                {{-- <button class="btn btn-outline-primary" style="opacity:80%" onclick="stepper.next()">SANG SULINGGIH</button> --}}
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-4" data-category="1" data-sort="white sample">
                        <a style="text-decoration: none;" href="{{route('auth.register.form.akun','sanggar')}}">
                            <div class="card p-2 shadow cursor" role="button">
                                <label class="text-center m-0 p-1 text-dark">SANGGAR</label>
                                <img src="{{asset('base-template/dist/img/jenis-user/sanggar.jpg')}}" style="height:190px; object-fit:cover; opacity : 0.9" alt="white sample"/>
                                {{-- <button class="btn btn-outline-primary" style="opacity:80%" onclick="stepper.next()">SANGGAR BALI</button> --}}
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-4" data-category="1" data-sort="white sample">
                        <a style="text-decoration: none;" href="{{route('auth.register.form.akun','pemangku')}}">
                            <div class="card p-2 shadow cursor" role="button">
                                <label class="text-center m-0 p-1 text-dark">PEMANGKU</label>
                                <img src="{{asset('base-template/dist/img/jenis-user/pemangku.jpg')}}" style="height:190px; object-fit:cover; opacity : 0.9" alt="white sample"/>
                                {{-- <button class="btn btn-outline-primary" style="opacity:80%" onclick="stepper.next()">SERATI</button> --}}
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-4" data-category="1" data-sort="white sample">
                        <a style="text-decoration: none;" href="{{route('auth.register.form.akun','serati')}}">
                            <div class="card p-2 shadow cursor" role="button">
                                <label class="text-center m-0 p-1 text-dark">SERATI</label>
                                <img src="{{asset('base-template/dist/img/jenis-user/serati.jpg')}}" style="height:190px; object-fit:cover; opacity : 0.9" alt="white sample"/>
                                {{-- <button class="btn btn-outline-primary" style="opacity:80%" onclick="stepper.next()">SERATI</button> --}}
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-2 mb-2">
                <a class="nav-link link-dark">E-Yajamana 2021 | All Right Reserved &copy </a>
            </div>
        </div>
    </div>

@endsection
