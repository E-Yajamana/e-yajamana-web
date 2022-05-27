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
                    <h4>Verifikasi Akun Sanggar</h4>
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
            <div class="row" >
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pemilik Sanggar</h3>
                        </div>
                        <div class="card-body">
                            <div class="row m-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSanggar->User[0]->email}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataSanggar->User[0]->nomor_telepon}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mendaftar Pada Tanggal</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="{{date('d F Y',strtotime($dataSanggar->created_at))}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NIK</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSanggar->User[0]->Penduduk->nik}}" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor Induk Krama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="@if(!empty($$dataSanggar->User[0]->Penduduk->nomor_induk_krama)){{$dataSanggar->User[0]->Penduduk->nomor_induk_krama}} @else Nomor Induk Krama Belum Terdata @endif " disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{ucfirst($dataSanggar->User[0]->Penduduk->nama)}}" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Sanggar</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{ucfirst($dataSanggar->nama_sanggar)}}" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Jenis Kelamin</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{ucfirst($dataSanggar->User[0]->Penduduk->jenis_kelamin)}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tempat/Tanggal Lahir</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataSanggar->User[0]->Penduduk->tempat_lahir}}, {{date('d F Y',strtotime($dataSanggar->User[0]->Penduduk->tanggal_lahir))}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pendidikan</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pendidikan" disabled value="{{$dataSanggar->User[0]->Penduduk->Pendidikan->jenjang_pendidikan}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Pekerjaan</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="{{$dataSanggar->User[0]->Penduduk->Profesi->profesi}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"> Lokasi Sanggar</h3>
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
                                <textarea disabled name="alamat_griya" class="form-control" rows="5" placeholder="Masukan Alamat Lengkap Griya" >{{$dataSanggar->alamat_sanggar}}, Desa {{Str::ucfirst(Str::lower($dataSanggar->DesaDinas->name))}}, Kecamatan {{Str::ucfirst(Str::lower($dataSanggar->DesaDinas->Kecamatan->name))}}, Kabupaten {{Str::ucfirst(Str::lower($dataSanggar->DesaDinas->Kecamatan->Kabupaten->name))}}, Provinsi {{Str::ucfirst(Str::lower($dataSanggar->DesaDinas->Kecamatan->Kabupaten->Provinsi->name))}}</textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <div class="row">
                        <div class="col-6 ">
                            <a href="{{route('admin.manajemen-akun.verifikasi.index')}}" class="btn btn-secondary btn-sm">Kembali</a>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse ">
                            <button onclick="terimaSanggar({{$dataSanggar->id}})" type="button" class="btn btn-primary btn-sm ">Setujui</button>
                            <button onclick="tolakSanggar({{$dataSanggar->id}})" class="mr-2 btn btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">Tolak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <input id="lat" type="hidden" class="d-none" value="{{$dataSanggar->lat}}">
    <input id="lng" type="hidden" class="d-none" value="{{$dataSanggar->lng}}">

    @include('pages.admin.manajemen-akun.pengaturan-akun.modal-konfirmasi-sanggar')
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
            var marker = new L.marker([lat,lng]);
            mymap.addLayer(marker);
        });

        $(document).ready(function(){
            $('#side-pengaturan-akun').addClass('menu-open');
            $('#side-konfirmasi-sulinggih').addClass('active');
        });
    </script>

@endpush
