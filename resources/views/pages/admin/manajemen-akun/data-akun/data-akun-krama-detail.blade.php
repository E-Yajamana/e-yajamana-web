@extends('layouts.admin.admin-layout')

@section('tittle','Data Detail Akun Krama')

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
                <div class="col-md-12">
                <!-- Profile Image -->
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile m-2">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{route('get-image.profile.pemuput-karya',$dataKrama->User->id)}}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center mb-0 mt-2">{{$dataKrama->User->Penduduk->nama}}</h3>
                            <p class="text-muted text-center mb-0">Krama Bali</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Akun User</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataKrama->User->email}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nomor Telepon</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataKrama->User->nomor_telepon}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mendaftar Pada Tanggal</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="{{date('d F Y',strtotime($dataKrama->User->created_at))}}">
                            </div>
                        </div>
                    </div>

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
                                        <label for="exampleInputEmail1">NIK</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataKrama->User->Penduduk->nik}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Krama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataKrama->User->Penduduk->nama}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pendidikan" disabled value="{{$dataKrama->User->Penduduk->jenis_kelamin}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pendidikan</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pendidikan" disabled value="{{$dataKrama->User->Penduduk->Pendidikan->jenjang_pendidikan}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor Induk Krama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataKrama->User->Penduduk->nomor_induk_krama}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tempat/Tanggal Lahir</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataKrama->User->Penduduk->tempat_lahir}}, {{date('d F Y',strtotime($dataKrama->User->Penduduk->tanggal_lahir))}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Golongan Darah</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pendidikan" disabled value="{{$dataKrama->User->Penduduk->golongan_darah}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Pekerjaan</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="{{$dataKrama->User->Penduduk->Profesi->profesi}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mt-2" id="gmaps" style="height: 330px;"></div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mt-4">
                                        <textarea disabled name="alamat_griya" class="form-control  @error('alamat_griya') is-invalid @enderror" rows="4" placeholder="Masukan Alamat Lengkap Griya" >{{$dataKrama->User->Penduduk->alamat}} </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-2">
                            <div class="float-lg-left">
                                <a href="{{route('admin.manajemen-akun.data-akun.index')}}" class="btn btn-secondary btn-sm">Kembali</a>
                            </div>
                            <div class="float-lg-right">
                                <button onclick="verifikasiPemuputKarya({{$dataKrama->id}})" type="button" class="btn btn-danger btn-sm  mx-1">Hapus Data</button>
                                <button class="btn btn btn-primary btn-sm mx-1" data-toggle="modal" data-target="#modal-default">Edit Data</button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <input id="dataLokasi" type="hidden" class="d-none" value='@json($dataKrama)'>




@endsection

@push('js')
    <script type="text/javascript">
        let jsonDataKrama = $('#dataLokasi').val();
        let dataKrama = JSON.parse(jsonDataKrama)

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

            var marker = new L.marker([dataKrama.lat,dataKrama.lng ]);
            mymap.addLayer(marker);
        });

        $(document).ready(function(){
            $('#side-data-akun').addClass('menu-open');
        });

    </script>
@endpush
