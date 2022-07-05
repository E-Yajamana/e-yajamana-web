@extends('layouts.pemuput-karya.pemuput-karya-layout')
@section('tittle','Data Detail Muput Upacara')

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
        <div class="container-fluid border-bottom mt-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Tahapan Reservasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('pemuput-karya.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('pemuput-karya.muput-upacara.konfirmasi-muput.index')}}">Data Muput Upacara</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-12">
            <div class="card tab-content">
                <section class="px-3">
                    <div class="card-header my-auto">
                        <label class="card-title my-auto">Data Tahapan Reservasi</label>
                    </div>
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama Tahapan</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataDetailReservasi->TahapanUpacara->nama_tahapan}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Mulai - Tanggal Selesai</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservation" disabled value="{{date('d F Y  h:i A',strtotime($dataDetailReservasi->tanggal_mulai))}} - {{date('d F Y  h:i A   ',strtotime($dataDetailReservasi->tanggal_selesai))}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="card-header"></div>
                <div class="card-body mt-4">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="card tab-content">
                                <!-- /.card-header -->
                                <div class="card-header">
                                    <div class="card-body box-profile align-content-center">
                                        <div class="text-center">
                                            <img class=" profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                            <h3 class="text-center bold mb-0 ">{{$dataDetailReservasi->Reservasi->Upacaraku->Upacara->nama_upacara}}</h3>
                                            <p class="text-center mb-1">{{$dataDetailReservasi->Reservasi->Upacaraku->Upacara->kategori_upacara}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Nama Upacara</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataDetailReservasi->Reservasi->Upacaraku->nama_upacara}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi Upacara</label>
                                                <textarea disabled class="form-control" rows="3" placeholder="Masukan Deskripsi Upacara ...">{{$dataDetailReservasi->Reservasi->Upacaraku->deskripsi_upacaraku}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Mulai - Tanggal Selesai Upacara</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" id="reservation" disabled value="{{date('d-M-Y',strtotime($dataDetailReservasi->Reservasi->Upacaraku->tanggal_mulai))}} - {{date('d-M-Y',strtotime($dataDetailReservasi->Reservasi->Upacaraku->tanggal_selesai))}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="card tab-content" id="v-pills-tabContent">
                                <div class="card-header my-auto">
                                    <label class="card-title my-auto">Lokasi Upacara</label>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div id="gmaps" style="height: 464px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group px-1">
                        <label>Alamat Upacaraku</label>
                        <textarea disabled class="form-control" rows="3" placeholder="Masukan Deskripsi Upacara ...">{{$dataDetailReservasi->Reservasi->Upacaraku->alamat_upacaraku}}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-12">
                        <a href="{{route('pemuput-karya.muput-upacara.konfirmasi-muput.index')}}" class="btn btn-secondary">Kembali</a>
                        <button onclick="konfirmasiMuput({{$dataDetailReservasi->id}},{{$dataDetailReservasi->Reservasi->id_upacaraku}})" type="button" class="btn btn-primary float-right ml-2 m-1">Konfirmasi Muput</button>
                        <button onclick="batalMuput({{$dataDetailReservasi->id}},{{$dataDetailReservasi->Reservasi->id_upacaraku}})" type="button" class="btn btn-danger float-right ml-2 m-1">Batal Muput</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <input id='lat' value="{{$dataDetailReservasi->Reservasi->Upacaraku->lat}}" type="hidden">
    <input id='alamat' value="{{$dataDetailReservasi->Reservasi->Upacaraku->alamat_upacaraku}}" type="hidden">
    <input id='lng' value="{{$dataDetailReservasi->Reservasi->Upacaraku->lng}}" type="hidden">

    @include('pages.pemuput-karya.manajemen-muput-upacara.modal-konfirmasi-muput')

@endsection

@push('js')

    <script>
        $('#side-manajemen-muput-upacara').addClass('menu-open');
        $('#side-manajemen-muput-upacara-konfirmasi-muput-upacara').addClass('active');

        $(document).ready(function(){
            $('#side-upacara').addClass('menu-open');
            $('#side-kabupaten').addClass('active');
            var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 10);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Adalah API Favoritku',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);
            var lat = $("#lat").val();
            var lng = $("#lng").val();
            var alamat = $("#alamat").val();

            var marker = new L.marker([lat,lng ]).bindPopup(alamat).addTo(mymap);
            marker.on('click', function() {
                marker.openPopup();
            });
        });
        // VIEW MARKER MAPS (**)

    </script>

@endpush
