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
                    <h1>Detail Sanggar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.manajemen-akun.data-akun.index')}}">Data Akun</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                                <img class="profile-user-img img-fluid img-circle" src="{{route('image.profile.sanggar',$dataSanggar->id)}}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center mb-0 mt-2">{{$dataSanggar->nama_sanggar}}</h3>
                            <p class="text-muted text-center mb-0">{{ucfirst('Sanggar')}}</p>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pemilik Sanggar</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pengelola Sanggar</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSanggar->User[0]->Penduduk->nama}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataSanggar->User[0]->nomor_telepon}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Alamat Sanggar</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="{{$dataSanggar->alamat_sanggar}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="mt-1">
                                        <label for="exampleInputEmail1">SK tanda usaha</label>
                                        <img style="width: 100%;height: 210px" src="{{route('image.sk-sanggar',$dataSanggar->id)}}" class="img-fluid pad img-thumbnail"  alt="Responsive image">
                                    </div>
                                </div>
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
