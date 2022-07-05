@extends('layouts.admin.admin-layout')

@section('tittle','Data Akun')

@push('css')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Akun Krama Bali</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Akun User</a></li>
                        <li class="breadcrumb-item active">Detail Akun User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-6">
                <!-- Profile Image -->
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile m-2">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{route('get-image.profile.pemuput-karya',$dataSanggar->User->id)}}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center mb-0 mt-2">{{$dataSanggar->User->Penduduk->nama}}</h3>
                            <p class="text-muted text-center mb-0">{{ucfirst($dataSanggar->User->role)}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Akun User</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSanggar->User->email}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nomor Telepon</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataSanggar->User->nomor_telepon}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mendaftar Pada Tanggal</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="{{date('d F Y',strtotime($dataSanggar->User->created_at))}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">SK Tanda Usaha Sanggar</h3>
                        </div>
                        <div class="card-body">
                            <div class="mt-1">
                                <img style="width: 100%;height: 255px" src="{{route('get-image.tahapan-upacara',12)}}" class="img-fluid pad img-thumbnail"  alt="Responsive image">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Data Krama Bali</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Pengelola Sanggar</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSanggar->User->Penduduk->nama}}" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Sanggar</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSanggar->nama_sanggar}}" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mt-2" id="gmaps" style="height: 330px;"></div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mt-4">
                                        <textarea disabled name="alamat_griya" class="form-control  @error('alamat_griya') is-invalid @enderror" rows="4" placeholder="Masukan Alamat Lengkap Griya" >{{$dataSanggar->alamat_sanggar}} </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-2">
                            <div class="float-lg-left">
                                <a href="{{route('admin.manajemen-akun.data-akun.index')}}" class="btn btn-secondary btn-sm">Kembali</a>
                            </div>
                            <div class="float-lg-right">
                                <button onclick="verifikasiPemuputKarya({{$dataSanggar->id}})" type="button" class="btn btn-danger btn-sm  mx-1">Hapus Data</button>
                                <button class="btn btn btn-primary btn-sm mx-1" data-toggle="modal" data-target="#modal-default">Edit Data</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <input id="dataLokasi" type="hidden" class="d-none" value='@json($dataSanggar)'>

@endsection

@push('js')
    <script type="text/javascript">
        let jsonDataSanggar = $('#dataLokasi').val();
        let dataSanggar = JSON.parse(jsonDataSanggar)

        $(document).ready(function(){
            var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 9);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Adalah API Favoritku',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);

            var marker = new L.marker([dataSanggar.lat,dataSanggar.lng ]);
            mymap.addLayer(marker);
        });

        $(document).ready(function(){
            $('#side-data-akun').addClass('menu-open');
        });

    </script>
@endpush
