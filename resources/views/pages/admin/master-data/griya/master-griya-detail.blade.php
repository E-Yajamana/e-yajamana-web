@extends('layouts.admin.admin-layout')
@section('tittle','Detail Data Griya')

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
                    <h1>Detail Data Lokasi Griya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.master-data.griya.index')}}">Data Griya</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid mt-lg-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card card-outline tab-content" id="v-pills-tabContent">
                        <div class="card-header my-auto">
                            <label class="card-title my-auto">Data Detail Griya</label>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Griya</label>
                                <input disabled type="text" name="nama_griya" class="form-control @error('nama_griya') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Griya" value="{{$dataGriya->nama_griya_rumah}}">
                                @error('nama_griya')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('nama_griya') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Desa Adat</label>
                                <input disabled type="text" name="nama_griya" class="form-control @error('nama_griya') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Griya" value="{{$dataGriya->DesaAdat->desadat_nama}}">
                                @error('nama_griya')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('nama_griya') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat Lengkap Griya <span class="text-danger">*</span></label>
                                <textarea disabled name="alamat_griya" class="form-control  @error('alamat_griya') is-invalid @enderror" rows="5" placeholder="Masukan Alamat Lengkap Griya" >{{$dataGriya->alamat_griya_rumah}}, Desa {{Str::ucfirst(Str::lower($dataGriya->Desa->name))}}, Kecamatan {{Str::ucfirst(Str::lower($dataGriya->Desa->Kecamatan->name))}}, Kabupaten {{Str::ucfirst(Str::lower($dataGriya->Desa->Kecamatan->Kabupaten->name))}}, Provinsi {{Str::ucfirst(Str::lower($dataGriya->Desa->Kecamatan->Kabupaten->Provinsi->name))}} </textarea>
                                @error('alamat_griya')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('alamat_griya') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mt-lg-5 mb-2">
                                <a href="{{route('admin.master-data.griya.index')}}" class="btn btn-secondary">Kembali</a>
                                <a href="{{route('admin.master-data.griya.edit',$dataGriya->id)}}" class="btn btn-primary float-sm-right">Edit Data</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="card tab-content" id="v-pills-tabContent">
                        <div class="card-header my-auto">
                            <label class="card-title my-auto">Pemetaan Lokasi Griya</label>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div id="gmaps" style="height: 425px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')

    <script>
        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-griya').addClass('active');
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 10);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Adalah API Favoritku',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);

            // var curLocation = [$dataGriya->lat, $dataGriya->lng];
            var marker = new L.marker([<?=$dataGriya->lat ?>, <?=$dataGriya->lng ?>]);
            mymap.addLayer(marker);
        });
    </script>

@endpush
