@extends('layouts.krama.krama-layout')
@section('tittle','Reservasi')

@push('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/dropzone/min/dropzone.min.css')}}">


    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reservasi Pemuput Karya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">E-Yajamana</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$dataUpacaraku->nama_upacara}}</a></li>
                        <li class="breadcrumb-item active">Tambah Reservasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info container-fluid">
                        <h5><i class="fas fa-info"></i> Catatan:</h5>
                        Anda dapat melakukan reservasi pada beberapa tahapan yang tersedia pada suatu upacara.
                    </div>

                    <div class="bs-stepper">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Form Pencarian Reservasi</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                    <!-- your steps here -->
                                        <div class="step" data-target="#logins-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                                <span class="bs-stepper-circle">1</span>
                                                <span class="bs-stepper-label">Pencarian</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step active" data-target="#information-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                                <span class="bs-stepper-circle">2</span>
                                                <span class="bs-stepper-label">Pilih Tahapan</span>
                                            </button>
                                        </div>

                                        <div class="line"></div>
                                        <div class="step" data-target="#next-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="next-part"
                                            id="next-part-trigger">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Rangkuman</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="bs-stepper-content p-0">
                            <!-- TAHAPAN AWAL -->
                                <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                    <div class="card tab-content">
                                        <!-- /.card-header -->
                                        <div class="card-header">
                                            <div class="card-body box-profile align-content-center">
                                                <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                                </div>
                                                <h3 class="text-center bold mb-0 mt-3 ">{{$dataUpacaraku->nama_upacara}}</h3>
                                                <p class="text-center mb-1 mt-1">{{$dataUpacaraku->Upacara->kategori_upacara}}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card tab-content">
                                        <!-- /.card-header -->
                                        <div class="card-header">
                                            <label class="card-title">Maps Lokasi Pemuput E-Yajamana</label>
                                        </div>
                                        <div class="card-body">
                                            <div id="gmaps" style="height: 450px;"></div>
                                        </div>
                                    </div>
                                    {{-- <div class="card-footer">
                                        <button type="button" class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                        <button type="button" class="btn btn btn-primary btn-sm float-lg-right center" data-toggle="modal" data-target="#modal-default"   onclick="stepper.next()">Selanjutnya</button>
                                    </div> --}}
                                </div>
                            <!-- TAHAPAN AWAL -->

                            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                <form action="{{route('krama.manajemen-reservasi.store')}}" method="POST">
                                    @csrf
                                    <div class="card card-default col-12">
                                        <div class="row">
                                            <div class="col-12 col-sm-4">
                                                <div class="card tab-content mb-0 m-4">
                                                    <!-- /.card-header -->
                                                    <div class="card-header">
                                                        <div class="card-body box-profile align-content-center">
                                                            <div class="text-center">
                                                            <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                                            </div>
                                                            <h3 id="dua_nama_sulinggih" class="text-center bold mb-0 mt-3 ">Sulinggih Sumerta</h3>
                                                            <p id="dua_email_sulinggih" class="text-center mb-1 mt-1">sumerta@gmail.com</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 d-flex align-items-center">
                                                <div class="col-12 text-center">
                                                    <i class="fas fa-chevron-right"></i>
                                                    <i class="fas fa-chevron-right"></i>
                                                    <i class="fas fa-chevron-right"></i>
                                                    <i class="fas fa-chevron-right"></i>
                                                    <i class="fas fa-chevron-right"></i>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="card tab-content mb-0 m-4">
                                                    <!-- /.card-header -->
                                                    <div class="card-header">
                                                        <div class="card-body box-profile align-content-center">
                                                            <div class="text-center">
                                                            <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                                            </div>
                                                            <h3 class="text-center bold mb-0 mt-3 ">{{$dataUpacaraku->nama_upacara}}</h3>
                                                            <p class="text-center mb-1 mt-1">{{$dataUpacaraku->Upacara->kategori_upacara}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card tab-content card-primary card-outline">
                                        <div class="card-header my-auto">
                                            <label class="card-title my-auto">Rentetan Upacara</label>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-sm-4">
                                                    <h4 class="text-center mb-3"> Awal </h4>
                                                    @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','awal') as $data)
                                                        <div id="card{{$data->id}}" class="card shadow collapsed-card mb-3">
                                                            <div class="card-header" aria-expanded="false">
                                                                <!-- checkbox -->
                                                                <div  class="icheck-primary d-inline ml-2">
                                                                    <input onclick="showDate({{$data->id}})" type="checkbox" name="id[]" value="{{$data->id}}" id="check{{$data->id}}">
                                                                    <label class="form-check-label ml-3" for="todoCheck1">{{$data->nama_tahapan}}</label>
                                                                </div>
                                                            </div>
                                                            <div id="body{{$data->id}}" class="card-body ml-3" style="display: none;">
                                                                <div class="callout callout-danger container-fluid">
                                                                    <div>
                                                                        <p><i class="fas fa-info"></i>
                                                                            <strong class="ml-1"> Informasi : </strong>
                                                                            Harap di isi Jadwal Rentetan Upacara
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="inputDate-{{$data->id}}">
                                                                    {{-- <label>Tanggal/Waktu Mulai - Selesai Rentetan Upacara :</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="far fa-calendar-alt"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input name="daterange[]" type="text" class="form-control float-right" id="reservation{{$data->id}}">
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-12 col-sm-4">
                                                    <h4 class="text-center mb-3"> Puncak </h4>
                                                    @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','puncak') as $data)
                                                        <div class="card shadow collapsed-card mb-3">
                                                            <div class="card-header" aria-expanded="false">
                                                                <!-- checkbox -->
                                                                <div  class="icheck-primary d-inline ml-2">
                                                                    <input type="checkbox" value="" name="id[]" id="todoCheck1">
                                                                    <label class="form-check-label ml-3" for="todoCheck1" >{{$data->nama_tahapan}}</label>
                                                                </div>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                                        <i class="fas fa-caret-down float-lg-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body ml-3" style="display: none;">
                                                                <div class="callout callout-danger container-fluid">
                                                                    <div>
                                                                        <p>
                                                                            <i class="fas fa-info"></i>
                                                                            <strong class="ml-1"> Informasi : </strong>
                                                                            Harap di isi Jadwal Rentetan Upacara
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Tanggal/Waktu Mulai - Selesai Rentetan Upacara :</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="far fa-calendar-alt"></i>
                                                                            </span>
                                                                        </div>
                                                                    <input type="text" name="daterange[]" class="form-control float-right" id="reservation{{$data->id}}">
                                                                    </div>
                                                                    <!-- /.input group -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-12 col-sm-4">
                                                    <h4 class="text-center mb-3"> Akhir </h4>
                                                    @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','akhir') as $data)
                                                        <div class="card shadow collapsed-card mb-3">
                                                            <div class="card-header" aria-expanded="false">
                                                                <!-- checkbox -->
                                                                <div  class="icheck-primary d-inline ml-2">
                                                                    <input type="checkbox" value="" name="id[]" id="todoCheck1">
                                                                    <label class="form-check-label ml-3" for="todoCheck1">{{$data->nama_tahapan}}</label>
                                                                </div>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                                        <i class="fas fa-caret-down float-lg-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body ml-3" style="display: none;">
                                                                <div class="callout callout-danger container-fluid">
                                                                    <div>
                                                                        <p>
                                                                            <i class="fas fa-info"></i>
                                                                            <strong class="ml-1"> Informasi : </strong>
                                                                            Harap di isi Jadwal Rentetan Upacara
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Tanggal/Waktu Mulai - Selesai Rentetan Upacara :</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="far fa-calendar-alt"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input id="reservation{{$data->id}}" type="text" name="daterange[]"  class="form-control float-right">
                                                                    </div>
                                                                    <!-- /.input group -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="button" class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                            <button type="submit" class="btn btn btn-primary btn-sm float-lg-right center" onclick="stepper.next()">Selanjutnya</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div id="next-part" class="content" role="tabpanel" aria-labelledby="next-part-trigger">
                                <div class="card card-default">
                                    <div class="card-body box-profile align-content-center">
                                        <div class="text-center">
                                          <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                        </div>
                                        <h3 class="text-center bold mb-0 mt-3">Mepandes I Putu Alex</h3>
                                        <p class="text-center mb-1 mt-1">Manusa Yadnya</p>
                                    </div>
                                </div>

                                <div class="card card-default">
                                    <div class="card-header">
                                        <label class="card-title">Pemuput Upacara</label>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body box-profile align-content-center">
                                        <div class="text-center mb-2">
                                            <img class="profile-user-img img-fluid img-circle"  src="http://127.0.0.1:8000/base-template/dist/img/user2-160x160.jpg" alt="User profile picture">
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Nama Pemuput Upacara</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Manusa Yadnya" disabled="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nomer Handphone</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Manusa Yadnya" disabled="">
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Manusa Yadnya" disabled="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Manusa Yadnya" disabled="">
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="card card-default">
                                    <div class="card-header">
                                        <label class="card-title">Rententan Upacara yang di Reservasi</label>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card shadow mb-3">
                                            <div class="card-header" aria-expanded="false">
                                                <label class="form-check-label ml-3" for="todoCheck1">
                                                    <strong> Ngraga Tirta Suci</strong>
                                                </label>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                        <i class="fas fa-caret-down float-lg-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body ml-3">
                                                <div class="form-group">
                                                    <p>Tanggal/Waktu Mulai - Selesai Rentetan Upacara :</p>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                      <input disabled type="text" class="form-control float-right" id="reservation">
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card shadow mb-3">
                                            <div class="card-header" aria-expanded="false">
                                                <label class="form-check-label ml-3" for="todoCheck1">
                                                    <strong> Ngraga Tirta Suci</strong>
                                                </label>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                        <i class="fas fa-caret-down float-lg-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body ml-3">
                                                <div class="form-group">
                                                    <p>Tanggal/Waktu Mulai - Selesai Rentetan Upacara :</p>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                      <input disabled type="text" class="form-control float-right" id="reservation2">
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card shadow mb-3">
                                            <div class="card-header" aria-expanded="false">
                                                <label class="form-check-label ml-3" for="todoCheck1">
                                                    <strong> Ngraga Tirta Suci</strong>
                                                </label>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                        <i class="fas fa-caret-down float-lg-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body ml-3">
                                                <div class="form-group">
                                                    <p>Tanggal/Waktu Mulai - Selesai Rentetan Upacara :</p>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                      <input disabled type="text" class="form-control float-right" id="reservation3">
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                        <button type="button" class="btn btn btn-primary btn-sm float-lg-right center" data-toggle="modal" data-target="#modal-default"   onclick="stepper.next()">Buat Reservasi</button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- MODAL DETAIL POPUP USER -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="card-body box-profile align-content-center">
                        <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                        </div>
                        <h3 class="text-center bold mb-0 mt-3" id="nama_griya"></h3>
                        <p class="text-center mb-1 mt-1" id="alamat"></p>
                    </div>
                </div>
                <div class="modal-body" id="dataSulinggih">
                    {{-- <div class="card shadow collapsed-card mt-3">
                        <div class="card-header">
                            <div class="user-block">
                                <img class="img-circle" src="{{asset('base-template/dist/img/user1-128x128.jpg')}}" alt="User Image">
                                <span class="username"><a class="ml-2" href="#">I Wayan Sulinggih Nabe</a></span>
                                <span class="description">
                                    <div class="ml-2 ">
                                        (Pemangku) - iwayansulinggih@gmail.com
                                    </div>
                                </span>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-7 d-flex justify-content-center align-items-center mb-2">
                                    <span style="font-size:80%" >Tanggal Diksha   :</span>
                                </div>
                                <div class="col-5">
                                    <span style="font-size:80%" >12 Jul 2021</span>
                                </div>
                                <div class="col-7 d-flex justify-content-center align-items-center mb-2">
                                    <span style="font-size:80%" >Nomor Telepon :</span>
                                </div>
                                <div class="col-5">
                                    <span style="font-size:80%" >08124625324</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="display: none;">
                            <button type="button" class="btn btn btn-primary btn-sm float-lg-right" data-toggle="modal" data-target="#modal-default">Reservasi</button>
                        </div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('js')
    <!-- BS-Stepper -->
    <script src="{{asset('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{asset('base-template/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap color picker -->
    <script src="{{asset('base-template/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{asset('base-template/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <!-- dropzonejs -->
    <script src="{{asset('base-template/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('base-template/dist/js/demo.js')}}"></script>

    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>

    <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>
@endpush

@push('js')


    <script>


    </script>

    <script type="text/javascript">
        let dataPemuputKarya;
        function getPemuput(id,nama,tlpn,alamat,gender,tgldiksha){
            $("#myModal").modal('hide');
            let idSulinggih = id;
            stepper.next()
        };

        function showDate(id) {
            var checkBox = document.getElementById("check"+id);
            var text = document.getElementById("body"+id);
            if (checkBox.checked == true){
                text.style.display = "block";
                $("#card"+id).removeClass("collapsed-card");
                $("#inputDate-"+id).append("<label>Tanggal/Waktu Mulai - Selesai Rentetan Upacara :</label><div class='input-group'><div class='input-group-prepend'><span class='input-group-text'><i class='far fa-calendar-alt'></i></span></div><input name='daterange[]' type='text' class='form-control float-right' id='reservation"+id+"'></div>");
                $('#reservation'+id).daterangepicker();
            } else {
                $("#inputDate-"+id).empty();
                $("#card"+id).addClass("collapsed-card");
                text.style.display = "none";
            }
        }

        $(document).ready(function(){
            $('#side-reservasi').addClass('menu-open');
            $('#side-tambah-reservasi').addClass('active');

            let mymap = L.map('gmaps').setView([-8.5108504, 115.1005634], 10);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Adalah API Favoritku',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);

            function createMarkerSanggar(lat,lng,namaSanggar){
                var icMarker = L.icon({
                    iconUrl: "{{asset('base-template/dist/img/marker/sanggar.png')}}",
                    iconSize: [36, 40],
                    iconAnchor: [8 , 40],
                    popupAnchor: [12, -28],
                });

                var marker = new L.marker([lat, lng],{
                    icon: icMarker,
                }).bindPopup().addTo(mymap);

                var namaSanggar = namaSanggar;
                marker.bindPopup(namaSanggar);
                marker.on('click', function() {
                    marker.openPopup();
                    $("#myModal").modal();
                });
            }

            function createMarkerPemuputKarya(lat,lng,namaGriya,alamat,dataSulinggih){
                var icMarker = L.icon({
                    iconUrl: "{{asset('base-template/dist/img/marker/griya.png')}}",
                    iconSize: [36, 40],
                    iconAnchor: [8 , 40],
                    popupAnchor: [12, -28],
                });

                var marker = new L.marker([lat, lng],{
                    icon: icMarker,
                }).bindPopup().addTo(mymap);

                var data = namaGriya
                marker.bindPopup(data);
                marker.on('click', function() {
                    marker.openPopup();
                    $("#myModal").modal();
                    $("#nama_griya").html(namaGriya);
                    $("#alamat").html("Lokasi : "+alamat);
                    $("#dataSulinggih").empty();
                    dataSulinggih.forEach(data =>{
                        var mydate = new Date(data.tanggal_diksha);
                        console.log(data);
                        console.log(data);
                        var str = mydate.toString("d-MMM-yyyy");
                        $("#dataSulinggih").append("<div class='card shadow collapsed-card mt-3'><div class='card-header'><div class='user-block'><img class='img-circle' src='{{asset('base-template/dist/img/user1-128x128.jpg')}}' alt='User Image'><span class='username'><a class='ml-2' href='#'> "+data.nama_sulinggih+"</a></span><span class='description'><div class='ml-2 '> "+data.user.email+"</div></span></div><div class='card-tools'><button type='button' class='btn btn-tool' data-card-widget='collapse'><i class='fas fa-plus'></i></button></div></div><div class='card-body'><div class='row '><div class='col-7 d-flex justify-content-center align-items-center mb-2'><span style='font-size:80%' >Tanggal Diksha   :</span></div><div class='col-5'><span style='font-size:80%' >"+str+" </span></div><div class='col-7 d-flex justify-content-center align-items-center mb-2'><span style='font-size:80%' >Nomor Telepon :</span></div><div class='col-5'><span style='font-size:80%' > "+data.user.nomor_telepon+"</span></div></div></div><div class='card-footer' style='display: none;'><button type='button' class='btn btn btn-primary btn-sm float-lg-right' data-toggle='modal' onclick=\"getPemuput("+data.id+",'"+data.nama_sulinggih+"','"+data.user.nomor_telepon+"','"+alamat+"','"+data.jenis_kelamin+"','"+data.tanggal_diksha+"')\">Reservasi</button></div></div>");
                    });
                });
            }


            let dataSanggar = {!! json_encode($dataSanggar) !!}
            dataPemuputKarya = {!! json_encode($dataPemuputKarya) !!}
            let dataUpacaraku = {!! json_encode($dataUpacaraku) !!}
            // console.log(dataUpacaraku.upacara.tahapan_upacara);
            // console.log(dataPemuputKarya.sulinggih);
            // console.log(dataSanggar);

            dataPemuputKarya.forEach(element => {
                createMarkerPemuputKarya(element.lat,element.lng,element.nama_griya_rumah,element.alamat_griya_rumah,element.sulinggih);
            });

            dataSanggar.forEach(element => {
                createMarkerSanggar(element.lat,element.lng,element.nama_sanggar);
            });

            // dataUpacaraku.upacara.tahapan_upacara.forEach(element => {
            //     $('#reservation'+element.id).daterangepicker();
            // });


        });

        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

    </script>

    <script>
        $(function () {
            //Date range picker
            // let dataUpacaraku = {!! json_encode($dataUpacaraku) !!}
            // console.log(dataUpacaraku.upacar);
            $('.form-control float-right').daterangepicker();
            $('#reservation').daterangepicker();
            // $('#reservation3').daterangepicker();
        });
    </script>


@endpush
