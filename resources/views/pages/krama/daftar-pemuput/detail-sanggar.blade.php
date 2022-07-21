@extends('layouts.krama.krama-layout')
@section('tittle','Detail Sanggar')

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
                    <h1>Detail Sanggar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('krama.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('krama.daftar-pemuput')}}">Daftar Sanggar</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <!-- Profile Image -->
                <div class="card card-info card-outline">
                    <div class="card-body pb-2 box-profile m-2">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{route('image.profile.sanggar',$sanggar->id)}}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center mb-0">{{$sanggar->nama_sanggar}}</h3>
                        <div class="row justify-content-center">
                            <span class=" text-center bg-success btn-sm text-xs m-1" style="border-radius: 5px; width:100px;" >APPROVE</span>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
     {{-- BAGIAN BIODATA --}}
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Lokasi Sanggar</h3>
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
                <div class="col-12 col-md-6">
                    <div class="mt-2" id="gmaps" style="height: 330px;"></div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Banjar Dinas</label>
                        <input disabled type="text" name="nama_griya" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Griya" value="{{$sanggar->BanjarDinas->nama_banjar_dinas}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Desa Adat</label>
                        <input disabled type="text" name="nama_griya" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Griya" value="{{$sanggar->BanjarDinas->DesaAdat->desadat_nama}}">
                    </div>
                    <div class="form-group">
                        <label>Alamat Lengkap Sanggar<span class="text-danger">*</span></label>
                        <textarea disabled name="alamat_griya" class="form-control" rows="5" placeholder="Masukan Alamat Lengkap Griya" >{{$sanggar->alamat_sanggar}}, Desa {{Str::ucfirst(Str::lower($sanggar->BanjarDinas->DesaDinas->name))}}, Kecamatan {{Str::ucfirst(Str::lower($sanggar->BanjarDinas->DesaDinas->Kecamatan->name))}}, Kabupaten {{Str::ucfirst(Str::lower($sanggar->BanjarDinas->DesaDinas->Kecamatan->Kabupaten->name))}}, Provinsi {{Str::ucfirst(Str::lower($sanggar->BanjarDinas->DesaDinas->Kecamatan->Kabupaten->Provinsi->name))}} </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Sanggar</h3>
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
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pengelola Sanggar</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$sanggar->User[0]->Penduduk->nama}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nomor Telepon</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$sanggar->User[0]->nomor_telepon}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Layanan Sanggar</label>
                        <textarea rows="4" class="form-control" disabled placeholder="Keahlian Sanggar">@foreach ($sanggar->Service as $service){{$service->nama_service}},  @endforeach </textarea>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="mt-1">
                        <label for="exampleInputEmail1">SK tanda usaha</label>
                        <img style="width: 100%;height: 275px" src="{{route('image.sk-sanggar',$sanggar->id)}}" class="img-fluid pad img-thumbnail"  alt="Responsive image">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer mt-2">
            <div class="float-lg-left">
                <a href="{{route('krama.daftar-pemuput')}}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
            <div class="float-lg-right">
                <button  type="button" class="btn btn-primary btn-sm ">Reservasi</button>
            </div>
        </div>
    </div>

    {{-- BAGIAN BIODATA --}}
    <input id="dataLokasi" type="hidden" class="d-none" value='@json($sanggar)'>


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
