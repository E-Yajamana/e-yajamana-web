@extends('layouts.admin.admin-layout')
@section('tittle','Detail Verifikasi')

@push('css')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/toastr/toastr.min.css')}}">

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
                    <h4>Verifikasi Akun Serati</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.manajemen-akun.verifikasi.index')}}">Data Verifikasi</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Akun User</h3>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"> Lokasi Serati</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mt-2" id="gmaps" style="height: 330px;"></div>
                            <div class="form-group mt-4">
                                <textarea disabled name="alamat_griya" class="form-control" rows="5" placeholder="Masukan Alamat Lengkap Griya" >{{$dataSerati->User->Penduduk->alamat}} </textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"> Data Serati</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NIK</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSerati->User->Penduduk->nik}}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Induk Krama</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSerati->User->Penduduk->nomor_induk_krama}}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSerati->User->Penduduk->nama}}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Serati</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSerati->nama_serati}}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Jenis Kelamin</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataSerati->User->Penduduk->jenis_kelamin}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tempat/Tanggal Lahir</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataSerati->User->Penduduk->tempat_lahir}}, {{date('d F Y',strtotime($dataSerati->User->Penduduk->tanggal_lahir))}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pendidikan</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pendidikan" disabled value="{{$dataSerati->User->Penduduk->Pendidikan->jenjang_pendidikan}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Pekerjaan</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="{{$dataSerati->User->Penduduk->Profesi->profesi}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer mt-2">
                    <div class="row">
                        <div class="col-6 ">
                            <a href="{{route('admin.manajemen-akun.verifikasi.index')}}" class="btn btn-secondary btn-sm">Kembali</a>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse ">
                            <button onclick="terimaSerati({{$dataSerati->id}})" type="button" class="btn btn-primary btn-sm ">Setujui</button>
                            <button onclick="tolakSerati({{$dataSerati->id}})" class="mr-2 btn btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">Tolak</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <input id="lat" type="hidden" class="d-none" value="{{$dataSerati->User->lat}}">
    <input id="lng" type="hidden" class="d-none" value="{{$dataSerati->User->lng}}">

    @include('pages.admin.manajemen-akun.pengaturan-akun.modal-konfirmasi-serati')
@endsection


@push('js')
    <!-- Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script type="text/javascript">
        let lat = $('#lat').val();
        let lng = $('#lng').val();


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
            var marker = new L.marker([lat,lng ]);
            mymap.addLayer(marker);
        });

        $(document).ready(function(){
            $('#side-pengaturan-akun').addClass('menu-open');
            $('#side-konfirmasi-sulinggih').addClass('active');
        });
    </script>

@endpush
