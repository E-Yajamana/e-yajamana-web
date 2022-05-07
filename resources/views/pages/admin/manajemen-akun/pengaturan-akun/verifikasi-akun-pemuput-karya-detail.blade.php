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
                    <h4>Verifikasi Akun @if ($dataPemuput->tipe == 'sulinggih') Sulinggih @else Pemangku @endif</h4>
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div @if ($dataPemuput->tipe == 'sulinggih') class="col-12 col-md-6" @endif class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Akun User</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataPemuput->User->email}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nomor Telepon</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataPemuput->User->nomor_telepon}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mendaftar Pada Tanggal</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="{{date('d F Y',strtotime($dataPemuput->User->created_at))}}">
                            </div>
                        </div>
                    </div>
                </div>
                @if ($dataPemuput->tipe == 'sulinggih')
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">SK Sulinggih</h3>
                            </div>
                            <div class="card-body">
                                <div class="mt-1">
                                    <img style="width: 100%;height: 255px" src="{{route('image.sk-pemuput',$dataPemuput->AtributPemuput->id)}}" class="img-fluid pad img-thumbnail"  alt="Responsive image">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">@if ($dataPemuput->tipe == 'sulinggih') Lokasi Griya @else Lokasi Tinggal Pemangku @endif</h3>
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
                                <label for="exampleInputEmail1">@if ($dataPemuput->tipe == 'sulinggih') Nama Griya @else Nama Rumah @endif</label>
                                <input disabled type="text" name="nama_griya" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Griya" value="{{$dataPemuput->GriyaRumah->nama_griya_rumah}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Desa Dinas</label>
                                <input disabled type="text" name="nama_griya" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Griya" value="{{$dataPemuput->GriyaRumah->BanjarDinas->nama_banjar_dinas}}">
                            </div>
                            <div class="form-group">
                                <label>@if ($dataPemuput->tipe == 'sulinggih') Alamat Lengkap Griya @else Alamat Lengkap @endif <span class="text-danger">*</span></label>
                                <textarea disabled name="alamat_griya" class="form-control" rows="5" placeholder="Masukan Alamat Lengkap Griya" >{{$dataPemuput->GriyaRumah->alamat_griya_rumah}}, Desa {{Str::ucfirst(Str::lower($dataPemuput->GriyaRumah->BanjarDinas->DesaDinas->name))}}, Kecamatan {{Str::ucfirst(Str::lower($dataPemuput->GriyaRumah->BanjarDinas->DesaDinas->Kecamatan->name))}}, Kabupaten {{Str::ucfirst(Str::lower($dataPemuput->GriyaRumah->BanjarDinas->DesaDinas->Kecamatan->Kabupaten->name))}}, Provinsi {{Str::ucfirst(Str::lower($dataPemuput->GriyaRumah->BanjarDinas->DesaDinas->Kecamatan->Kabupaten->Provinsi->name))}} </textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">@if ($dataPemuput->tipe == 'sulinggih') Data Sulinggih @else  Data Pemangku @endif</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NIK</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataPemuput->User->Penduduk->nik}}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Induk Krama</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataPemuput->User->Penduduk->nomor_induk_krama}}" disabled>
                            </div>
                        </div>
                        <div class="col-12  @if($dataPemuput->tipe != 'sulinggih') col-md-6 @endif">
                            <div class="form-group">
                                <label for="exampleInputEmail1">@if($dataPemuput->tipe != 'sulinggih') Nama Pemangku @else  Nama Sulinggih @endif </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataPemuput->nama_pemuput}}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> @if ($dataPemuput->tipe == 'sulinggih') Tanggal Diksha @else Tanggal Mawinten @endif </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{date('d F Y',strtotime($dataPemuput->AtributPemuput->tanggal_diksha))}}" disabled>
                            </div>
                        </div>
                        @if ($dataPemuput->tipe == 'sulinggih')
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Nabe</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" @if(!empty($dataPemuput->AtributPemuput->Nabe)) value="{{$dataPemuput->AtributPemuput->Nabe->nama_pemuput}}" @else value="Belum Terdaftar Pada Sistem" @endif disabled>
                                </div>
                            </div>
                        @endif
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">@if ($dataPemuput->User->Penduduk->jenis_kelamin == 'laki-laki') Nama Istri @else Nama Suami @endif</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama Pasangan" @if(!empty($dataPemuput->Pasangan)) value="{{$dataPemuput->Pasangan->nama_pemuput}}" @else value="Belum Terdaftar Pada Sistem" @endif disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Nama Walaka </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Panggilan" value="{{$dataPemuput->User->Penduduk->nama_asli}}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Jenis Kelamin</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataPemuput->User->Penduduk->jenis_kelamin}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tempat/Tanggal Lahir</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataPemuput->User->Penduduk->tempat_lahir}}, {{date('d F Y',strtotime($dataPemuput->User->Penduduk->tanggal_lahir))}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pendidikan</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pendidikan" disabled value="{{$dataPemuput->User->Penduduk->Pendidikan->jenjang_pendidikan}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Pekerjaan</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="{{$dataPemuput->User->Penduduk->Profesi->profesi}}">
                            </div>

                        </div>
                    </div>

                </div>
                <div class="card-footer mt-2">
                    <div class="float-lg-left">
                        <a href="{{route('admin.manajemen-akun.verifikasi.index')}}" class="btn btn-secondary btn-sm">Kembali</a>
                    </div>
                    <div class="float-lg-right">
                        <button onclick="terimaPemuput({{$dataPemuput->id}})" type="button" class="btn btn-primary btn-sm ">Setujui</button>
                        <button onclick="tolakPemuput({{$dataPemuput->id}})" class="btn btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">Tolak</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <input id="dataGriya" type="hidden" class="d-none" value='@json($dataPemuput->GriyaRumah)'>
    @include('pages.admin.manajemen-akun.pengaturan-akun.modal-konfirmasi-akun')
@endsection

@push('js')
    <!-- Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script type="text/javascript">
        let jsonDataGriya = $('#dataGriya').val();
        let dataGriya = JSON.parse(jsonDataGriya)

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
            var marker = new L.marker([dataGriya.lat,dataGriya.lng ]);
            mymap.addLayer(marker);
        });

        $(document).ready(function(){
            $('#side-pengaturan-akun').addClass('menu-open');
            $('#side-konfirmasi-sulinggih').addClass('active');
        });
    </script>

@endpush
