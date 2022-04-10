@extends('pages.auth.layout.master')
@section('tittle','Login Akun')

@section('content')

    <div class="container p-lg-4">
        <div class="card card-primary p-lg-2">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{asset('base-template/dist/img/logo-01.png') }}" alt="sipandu logo" width="100" height="100">
                <p class="login-box-msg mb-0 pb-0 px-0 fw-bold h4 mt-2 mb-1"> Selamat Datang di Sistem</p>
                <a href="" class="text-decoration-none h2 fw-bold mb-2">E-Yajamana</a>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <p class=" fs-6 bold">Pilihlah jenis akun yang akan digunakanan :</p>
                </div>

                <div class="row justify-content-center p-2">
                    <div class="col-12 col-sm-4" data-category="1" data-sort="white sample">
                        <a style="text-decoration: none;" href="{{route('krama.dashboard')}}">
                            <div class="card p-2 shadow cursor" role="button">
                                <label class="text-center m-0 p-1 text-dark">KRAMA BALI</label>
                                <img src="{{asset('base-template/dist/img/jenis-user/kramabali.jpg')}}" style="height:190px; object-fit:cover; opacity : 0.9 " alt="white sample"/>
                            </div>
                        </a>
                    </div>
                    @if (Auth::user()->PemuputKarya != null && Auth::user()->Role()->where('nama_role','Pemuput_karya')->exists())
                        @if (Auth::user()->PemuputKarya->status_konfirmasi_akun == 'disetujui')
                            <div class="col-12 col-sm-4" data-category="1" data-sort="white sample">
                                <a style="text-decoration: none;" href="{{route('pemuput-karya.dashboard')}}">
                                    <div class="card p-2 shadow cursor" role="button">
                                        <label class="text-center m-0 p-1 text-dark">@if (Auth::user()->PemuputKarya->tipe == 'sulinggih') SULINGGIH @else PEMANGKU @endif </label>
                                        <img @if (Auth::user()->PemuputKarya->tipe == 'sulinggih') src="{{asset('base-template/dist/img/jenis-user/sulinggih.jpg')}}" @else  src="{{asset('base-template/dist/img/jenis-user/pemangku.jpg')}}" @endif style="height:190px; object-fit:cover; opacity : 0.9" alt="white sample"/>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endif

                    @if (Auth::user()->Sanggar->where('status_konfirmasi_akun','disetujui')->count() != 0 )
                        <div class="col-12 col-sm-4" data-category="1" data-sort="white sample">
                            <a style="text-decoration: none;" onclick="showModal()">
                                <div class="card p-2 shadow cursor" role="button">
                                    <label class="text-center m-0 p-1 text-dark">SANGGAR</label>
                                    <img src="{{asset('base-template/dist/img/jenis-user/sanggar.jpg')}}" style="height:190px; object-fit:cover; opacity : 0.9" alt="white sample"/>
                                </div>
                            </a>
                        </div>
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="card-body box-profile align-content-center">
                                            <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                            </div>
                                            <h3 class="text-center bold mb-0 mt-3">Pilih Akun Sanggar</h3>
                                            <p class="text-center mb-1 mt-1">Anda dapat Mengelola Reservasi Sebagai Sanggar :</p>
                                        </div>
                                    </div>
                                    <div class="modal-body" id="dataSulinggih">
                                        @foreach (Auth::user()->Sanggar->where('status_konfirmasi_akun','disetujui') as $data)
                                            <form action="{{route('sanggar.session')}}" method="POST">
                                                @csrf
                                                <input value="{{$data->id}}" type="hidden" class="d-none" name="id">
                                                <div class="card shadow collapsed-card mt-3">
                                                    <div class="card-header">
                                                        <div class="user-block">
                                                            <img class="img-circle" src="{{route("get-image.profile.pemuput-karya")}}/2" alt="User Image">
                                                            <span class="username"><button class="ml-2 p-0 btn btn-link" type="submit"> {{$data->nama_sanggar}}</button></span>
                                                            <span class="description">
                                                                <div class="ml-2"> {{$data->alamat_sanggar}}</div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->Serati != null || Auth::user()->Serati != "")
                        <div class="col-12 col-sm-4" data-category="1" data-sort="white sample">
                            <a style="text-decoration: none;" href="{{route('auth.register.form.akun','serati')}}">
                                <div class="card p-2 shadow cursor" role="button">
                                    <label class="text-center m-0 p-1 text-dark">SERATI</label>
                                    <img src="{{asset('base-template/dist/img/jenis-user/serati.jpg')}}" style="height:190px; object-fit:cover; opacity : 0.9" alt="white sample"/>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center mt-2 p-0">
                <a class="nav-link link-dark">E-Yajamana 2021 | All Right Reserved &copy </a>
            </div>
        </div>
    </div>
@endsection
@push('js')

<script>
    function showModal(){
        $("#myModal").modal();
    }
</script>

@endpush





