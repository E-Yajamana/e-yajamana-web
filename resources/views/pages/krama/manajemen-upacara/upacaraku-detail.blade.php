@extends('layouts.krama.krama-layout')
@section('tittle','Data Detail Upacaraku')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    <!-- embedd library jquery -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Data Upacara</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('krama.manajemen-upacara.upacaraku.index')}}">Data Upacara</a></li>
                    <li class="breadcrumb-item active">Detail Upacara</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-danger container-fluid">
                        <h5><i class="fas fa-info"></i> Catatan:</h5>
                        Anda tidak dapat menghapus upacara saat sudah ada reservasi yang berstatus proses muput.
                    </div>

                    <div class="card tab-content">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <div class="card-body box-profile align-content-center">
                                <div class="text-center">
                                  <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                </div>
                                <h3 class="text-center bold mb-0 ">{{$dataUpacaraku->Upacara->nama_upacara}}</h3>
                                <p class="text-center mb-1">{{$dataUpacaraku->Upacara->kategori_upacara}}</p>
                                <div class="d-flex justify-content-center">
                                    <div class="bg-info btn-sm text-center" style="border-radius: 5px; width:120px;">{{Str::ucfirst($dataUpacaraku->status)}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nama Upacara</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataUpacaraku->nama_upacara}}" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai - Tanggal Selesai Upacara</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="far fa-calendar-alt"></i>
                                            </span>
                                          </div>
                                          <input value="{{date('d-M-Y',strtotime($dataUpacaraku->tanggal_mulai))}} - {{date('d-M-Y',strtotime($dataUpacaraku->tanggal_selesai))}}" type="text" class="form-control float-right" id="reservation" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Upacara</label>
                                        <textarea disabled name="alamat_griya" class="form-control  @error('alamat_griya') is-invalid @enderror" rows="3" placeholder="Masukan Alamat Lengkap Griya">{{$dataUpacaraku->deskripsi_upacaraku}}</textarea>
                                        @error('alamat_griya')
                                            <div class="invalid-feedback text-start">
                                                {{$errors->first('alamat_griya') }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card-header p-0 mt-2 mb-2">
                                        <div class="row justify-content-center">
                                            <label for="exampleInputPassword1" class="justify-content-center align-items-center">
                                                Pemetaan Lokasi Upacara</label>
                                        </div>
                                    </div>
                                    <div class="card-body p-0 ">
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div id="gmaps" style="height: 320px;"></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Banjar Dinas</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataUpacaraku->BanjarDinas->nama_banjar_dinas}}" disabled="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Desa Dinas</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{Str::ucfirst( Str::lower($dataUpacaraku->BanjarDinas->DesaDinas->name))}}" disabled="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Lengkap Upacara</label>
                                                    <textarea disabled name="alamat_griya" class="form-control  @error('alamat_griya') is-invalid @enderror" rows="4" placeholder="Masukan Alamat Lengkap Griya">{{$dataUpacaraku->alamat_upacaraku}}, Desa {{Str::ucfirst(Str::lower($dataUpacaraku->BanjarDinas->DesaDinas->name))}}, Kecamatan {{Str::ucfirst(Str::lower($dataUpacaraku->BanjarDinas->DesaDinas->Kecamatan->name))}}, Kabupaten {{Str::ucfirst(Str::lower($dataUpacaraku->BanjarDinas->DesaDinas->Kecamatan->Kabupaten->name))}}, Provinsi {{Str::ucfirst(Str::lower($dataUpacaraku->BanjarDinas->DesaDinas->Kecamatan->Kabupaten->Provinsi->name))}} </textarea>

                                                    @error('alamat_griya')
                                                        <div class="invalid-feedback text-start">
                                                            {{$errors->first('alamat_griya') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card tab-content" id="v-pills-tabContent">
                        <div class="card-header my-auto">
                            <label class="card-title my-auto">Rentetan Upacara</label>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <h4 class="text-center mb-3">AWAL</h4>
                                    <ul>
                                        @if ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','awal')->count() == 0)
                                            <li >Data Tahapan Tidak ditemukan</li>
                                        @else
                                            @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','awal') as $data)
                                                <li >{{$data->nama_tahapan}}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <h4 class="text-center mb-3">PUNCAK</h4>
                                    <ul>
                                        @if ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','puncak')->count() == 0)
                                            <li >Data Tahapan Tidak ditemukan</li>
                                        @else
                                            @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','puncak') as $data)
                                                <li >{{$data->nama_tahapan}}</li>
                                            @endforeach
                                        @endif
                                    </ul>

                                </div>
                                <div class="col-12 col-sm-4">
                                    <h4 class="text-center mb-3">AKHIR</h4>
                                    <ul>
                                        @if ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','akhir')->count() == 0)
                                            <li >Data Tahapan Tidak ditemukan</li>
                                        @else
                                            @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','akhir') as $data)
                                                <li >{{$data->nama_tahapan}}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header my-auto">
                            <div class="row">
                                <div class="col-6">
                                    <label class="card-title my-auto">Reservasi Upacara</label>
                                </div>
                                <div class="col-6">
                                    <a class="btn-sm btn-primary float-right" href="{{route('krama.manajemen-reservasi.create',$dataUpacaraku->id)}}"><i class="fa fa-plus"></i> Buat Reservasi</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($dataUpacaraku->Reservasi->count() == 0)
                                <div class=" px-lg-3 row align-items-center justify-content-center">
                                    <div class="callout callout-info container-fluid">
                                        <h5><i class="fas fa-info"></i> Pemberitahuan:</h5>
                                        Belum terdapat dara reservasi pada upacara ini !
                                    </div>
                                </div>
                            @else
                                @foreach ($dataUpacaraku->Reservasi as $data)
                                    <div class="card shadow collapsed-card">
                                        <div class="card-header" aria-expanded="false">
                                            <div class="user-block">
                                                <img class="img-circle mt-1" src="{{asset('base-template/dist/img/user1-128x128.jpg')}}" alt="User Image">
                                                <span class="username"><a class="ml-2" href="#">{{$data->Sulinggih->nama_sulinggih}}</a></span>
                                                <span class="description">
                                                    <div @if ($data->status == 'pending') class="bg-secondary btn-sm text-center p-1 mt-1 ml-2" @elseif ($data->status == 'proses tangkil' || $data->status == 'proses muput')  class="bg-info btn-sm text-center p-1 mt-1 ml-2" @elseif ($data->status == 'batal') class="bg-danger btn-sm text-center p-1 mt-1 ml-2"  @elseif ($data->status == 'selesai') class="bg-success btn-sm text-center p-1 mt-1 ml-2" @else class="bg-info btn-sm text-center p-1 mt-1 ml-2"  @endif style="border-radius: 5px; width:120px; ">{{ucfirst($data->status)}}</div>
                                                </span>
                                            </div>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                    <i class="fas fa-caret-down float-lg-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body" style="display: none;">
                                            {{-- START VIEW TANGGAL TANGKIL --}}
                                            @if ($data->tanggal_tangkil != null)
                                                <div class="callout callout-danger container-fluid">
                                                    <div>
                                                        <p>
                                                            <i class="fas fa-info"></i>
                                                            <strong class="ml-1">Tanggal Tangkil :</strong>
                                                            {{$data->tanggal_tangkil}}
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="callout callout-danger container-fluid">
                                                    <div>
                                                        <p>
                                                            <i class="fas fa-info"></i>
                                                            <strong class="ml-1">Tanggal Tangkil :</strong>
                                                            Belum ditentukan
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- END VIEW TANGGAL TANGKIL --}}

                                            <table id="example2" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Tahapan</th>
                                                        <th class="text-md-center">Upacara Mulai</th>
                                                        <th class="text-md-center">Upacara Selesai</th>
                                                        <th class="text-md-center">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data->DetailReservasi as $data)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$data->TahapanUpacara->nama_tahapan}}</td>
                                                            <td class="text-md-center">
                                                                <div>{{date('d-M-Y - h:i:s',strtotime($data->tanggal_mulai))}}</div>
                                                            </td>
                                                            <td class="text-md-center">
                                                                <div>{{date('d-M-Y h:i:s',strtotime($data->tanggal_selesai))}}</div>
                                                            </td>
                                                            <td class="d-flex justify-content-center">
                                                                <div class="bg-secondary btn-sm text-center" style="border-radius: 5px; width:80px; ">{{$data->status}}</div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {{-- <!-- /.card-body -->
                                        <div class="card-footer" style="display: none;">
                                            <button type="button" class="btn btn btn-infox btn-sm float-lg-right" data-toggle="modal" data-target="#modal-default">Detail Reservasi</button>
                                        </div>
                                        <!-- /.card-footer--> --}}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 my-1">
                                    <a href="{{route('krama.manajemen-upacara.upacaraku.index')}}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn m-1 btn-danger float-right ml-2">Hapus Upacaraku</button>
                                    <button type="submit" class="btn m-1 btn-info float-right ml-2">Edit Data Upacaraku</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    <!-- /.container-fluid -->
    </section>

@endsection


@push('js')

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
            var marker = new L.marker([<?= $dataUpacaraku->lat ?>, <?=$dataUpacaraku->lng ?>]);
            mymap.addLayer(marker);

            $('#side-upacara').addClass('menu-open');
            $('#side-data-upacara').addClass('active');
        });
    </script>

    <!-- Bootstrabase-template-->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTablbase-template Plugins -->
    <script src="{{asset('base-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <!-- jQuery -->
    <script src="{{asset('base-template/plugins/jquery/jquery.min.js')}}"></script>


@endpush
