@extends('layouts.krama.krama-layout')
@section('tittle','Tambah Reservasi')

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

    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/fullcalendar/main.css')}}">

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
                    <h1>Tambah Reservasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('krama.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('krama.manajemen-upacara.upacaraku.detail',$dataUpacaraku->id)}}">{{$dataUpacaraku->nama_upacara}}</a></li>
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
                        <div class="" id="datatesting"></div>
                    </div>

                    <div class="bs-stepper">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
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
                                        <div class="step" data-target="#information-part">
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
                                    {{-- <div class="card tab-content">
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
                                    </div> --}}

                                    <div class="card tab-content">
                                        <!-- /.card-header -->
                                        <div class="card-header">
                                            <label class="card-title">Maps Lokasi Pemuput E-Yajamana</label>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#filterMarker">
                                                    <i class="fas fa-filter"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="gmaps" style="height: 450px;"></div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="filterMarker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Filter Marker</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Kabupaten/Kota </label>
                                                        <select name="kabupaten" id="kabupaten" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;" value="{{old('kabupaten')}}">
                                                            <option value="0" selected>Pilih Kabupaten</option>
                                                            @foreach ($dataKabupaten as $data)
                                                                <option value="{{$data->id}}">{{$data->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group"><label>Kecamatan </label>
                                                        <select id="kecamatan" class="form-control select2bs4" style="width: 100%;">
                                                            <option value="0" selected>Pilih Kecamatan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Desa Dinas</label>
                                                        <select id="desa_dinas" name="id_desa" class="form-control select2bs4 " style="width: 100%;">
                                                            <option value="0" selected>Pilih Desa Dinas</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Banjar Dinas </label>
                                                        <select id="id_banjar_dinas" name="id_banjar_dinas" class="form-control select2bs4 " style="width: 100%;">
                                                            <option value="0" selected>Pilih Banjar Dinas</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tipe Pemuput </label>
                                                        <select id="tipe_pemuput" name="tipe_pemuput" class="form-control select2bs4 " style="width: 100%;">
                                                            <option value="0" selected>Pilih Tipe Pemuput</option>
                                                            <option value="sulinggih">Pemuput Karya (Sulinggih/ Pemangku)</option>
                                                            <option value="sanggar">Sanggar</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                          <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                          <label class="custom-control-label" for="customSwitch1">Favorit Pemuput</label>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="d-none" id="val_fav" value="0">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button id="searchFilter" type="button" class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- TAHAPAN AWAL -->


                            <!-- TAHAPAN FORM DATA -->
                                <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                    <form id="formInput">
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
                                                                <h3 id="in_nama_sulinggih" class="text-center bold mb-0 mt-3 "></h3>
                                                                <p id="in_email_sulinggih" class="text-center mb-1 mt-1"></p>
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
                                        <div class="card card-info card-outline">
                                            <div class="card-header">
                                                <label class="card-title"  id="judulKalender">Jadwal Muput </label>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-horizontal-sm list-unstyled">
                                                    <li class="group-item mx-2"><a class="text-secondary text-sm px-1" ><i class="fas fa-circle"></i></a>Pending</li>
                                                    <li class="group-item mx-2"><a class="text-primary  text-sm px-1" ><i class="fas fa-circle"></i></a>Akan Datang</li>
                                                    <li class="group-item mx-2"><a class="text-success  text-sm px-1" ><i class="fas fa-circle"></i></a>Selesai</li>
                                                </ul>
                                                <div id='calendar'></div>
                                            </div>
                                        </div>

                                        <div class="card tab-content ">
                                            <div class="card-header my-auto">
                                                <label class="card-title my-auto">Rentetan Upacara | Periode {{date('d F Y',strtotime($dataUpacaraku->tanggal_mulai))}} - {{date('d F Y',strtotime($dataUpacaraku->tanggal_selesai))}} </label>
                                            </div>
                                            <div class="card-body">
                                                <div class="row justify-content-center">
                                                    <div class="col-12 col-sm-6">
                                                        <h4 class="text-center mb-3"> Awal </h4>
                                                        @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','awal') as $data)
                                                            <div id="card{{$data->id}}" class="card shadow collapsed-card mb-3">
                                                                <div class="card-header" aria-expanded="false">
                                                                    <!-- checkbox -->
                                                                    <div  class="icheck-primary d-inline ml-2">
                                                                        <input onclick="showDateTahapan({{$data->id}})" type="checkbox" name="id[]" value="{{$data->id}}" id="check{{$data->id}}">
                                                                        <input value="{{$data->nama_tahapan}}" name="nama_tahapan[]" type="hidden" class="d-none">
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

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <h4 class="text-center mb-3"> Puncak </h4>
                                                        @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','puncak') as $data)
                                                            <div id="card{{$data->id}}" class="card shadow collapsed-card mb-3">
                                                                <div class="card-header" aria-expanded="false">
                                                                    <!-- checkbox -->
                                                                    <div  class="icheck-primary d-inline ml-2">
                                                                        <input onclick="showDateTahapan({{$data->id}})" type="checkbox" name="id[]" value="{{$data->id}}" id="check{{$data->id}}">
                                                                        <input value="{{$data->nama_tahapan}}" name="nama_tahapan[]" type="hidden" class="d-none">
                                                                        <label class="form-check-label ml-3" for="todoCheck1" >{{$data->nama_tahapan}}</label>
                                                                    </div>
                                                                    <div class="card-tools">
                                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                                            <i class="fas fa-caret-down float-lg-right"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div id="body{{$data->id}}" class="card-body mx-3" style="display: none;">
                                                                    <div class="callout callout-danger container-fluid">
                                                                        <div>
                                                                            <p>
                                                                                <i class="fas fa-info"></i>
                                                                                <strong class="ml-1"> Informasi : </strong>
                                                                                Harap di isi Jadwal Rentetan Upacara
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" id="inputDate-{{$data->id}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="col-12 col-sm-6 ">
                                                        <h4 class="text-center mb-3"> Akhir </h4>
                                                        @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','akhir') as $data)
                                                            <div id="card{{$data->id}}" class="card shadow collapsed-card mb-3">
                                                                <div class="card-header" aria-expanded="false">
                                                                    <!-- checkbox -->
                                                                    <div  class="icheck-primary d-inline ml-2">
                                                                        <input onclick="showDateTahapan({{$data->id}})" type="checkbox" name="id[]" value="{{$data->id}}" id="check{{$data->id}}">
                                                                        <input value="{{$data->nama_tahapan}}" name="nama_tahapan[]" type="hidden" class="d-none">
                                                                        <label class="form-check-label ml-3" for="todoCheck1">{{$data->nama_tahapan}}</label>
                                                                    </div>
                                                                    <div class="card-tools">
                                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                                            <i class="fas fa-caret-down float-lg-right"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div id="body{{$data->id}}" class="card-body" style="display: none;">
                                                                    <div class="callout callout-danger container-fluid">
                                                                        <div>
                                                                            <p>
                                                                                <i class="fas fa-info"></i>
                                                                                <strong class="ml-1"> Informasi : </strong>
                                                                                Harap di isi Jadwal Rentetan Upacara
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" id="inputDate-{{$data->id}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="button" class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                                <button type="submit" class="btn btn btn-primary btn-sm float-lg-right center">Selanjutnya</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            <!-- TAHAPAN FORM DATA -->

                            <!-- RANGKUMAN VIEW -->
                                <div id="next-part" class="content" role="tabpanel" aria-labelledby="next-part-trigger">
                                    <form action="{{route('krama.manajemen-reservasi.store')}}" method="POST">
                                        @csrf
                                        <input name="id_upacaraku" value="{{$dataUpacaraku->id}}" type="hidden" class="d-none">
                                        <div class="card card-default">
                                            <div class="card-body box-profile align-content-center">
                                                <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                                </div>
                                                <h3 class="text-center bold mb-0 mt-3">{{$dataUpacaraku->nama_upacara}}</h3>
                                                <p class="text-center mb-1 mt-1">{{$dataUpacaraku->Upacara->kategori_upacara}}</p>
                                            </div>
                                        </div>
                                        <div class="card card-default" id="dataPemuput">
                                            {{-- Data Pemuput --}}
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
                                            <div class="card-body" id="listTahapanReservasi">
                                                {{-- Data List Reservasi  --}}
                                            </div>
                                            <div class="card-footer">
                                                <button type="button" class="btn btn-primary" onclick="backToReservasi()">Sebelumnya</button>
                                                <button type="submit" class="btn btn btn-primary btn-sm float-lg-right center">Buat Reservasi</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <!-- RANGKUMAN VIEW -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <input value='@json($dataUpacaraku)' id="dataUpacaraku" type="hidden">
    <input value='@json($dataSanggar)' id="dataSanggar" type="hidden">
    <input value='@json($dataPemuputKarya)' id="dataJSONPemuput" type="hidden">

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
                    {{-- Data Sulinggih --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <!-- BS-Stepper -->
    <script src="{{asset('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <script src="{{asset('base-template/dist/js/pages/ajax-get-wilayah-filter.js')}}"></script>


    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{asset('base-template/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('base-template/dist/js/demo.js')}}"></script>

    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>

    <!-- jquery-validation -->
    <script src="{{asset('base-template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/jquery-validation/additional-methods.min.js')}}"></script>

    <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{asset('base-template/plugins/fullcalendar/main.js')}}"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        $('#side-reservasi').addClass('menu-open');
        $('#side-tambah-reservasi').addClass('active');
        $('#customSwitch1').on('change', function(){
            if ($(this).is(':checked')) {
                $('#val_fav').val(1);
            }
            else {
                $('#val_fav').val(0);
            }
        })


    </script>
@endpush

@push('js')

    {{-- VALIDATE FORM --}}
    <script type="text/javascript">
        let data = $('#dataUpacaraku').val();
        let namaPemuput,jenisPemuput;
        let dataUpacara = JSON.parse(data)

        // ADD FUNCTION VALIDATE DATE RANGE
        jQuery.validator.addMethod("daterange", function(value, element){
            const dateNew  = value.split(" - ");
            const startDate = moment(new Date(dateNew[0]));
            const endDate = moment(new Date(dateNew[1]));
            if(startDate._isValid == true && endDate._isValid == true ){
                return true;
            }else{
                return false;
            }
        }, "Masukan tanggal dan waktu dengan benar!");
        // ADD FUNCTION VALIDATE DATE RANGE

        // ADD FUNCTION VALIDATE DATE RANGE
        jQuery.validator.addMethod("validationDate", function(value, element){
            var tanggal_mulai = moment(dataUpacara.tanggal_mulai).format('YYYY-MM-DD')
            var tanggal_selesai = moment(dataUpacara.tanggal_selesai).format('YYYY-MM-DD')

            moment(tanggal_awal).isBetween(tanggal_mulai, tanggal_selesai, undefined, '[]');

            const dateNew  = value.split(" - ");
            var tanggal_awal = moment(dateNew[0]).format('YYYY-MM-DD');
            var tanggal_akhir = moment(dateNew[1]).format('YYYY-MM-DD');
            if(moment(tanggal_awal).isBetween(tanggal_mulai, tanggal_selesai, undefined, '[]') == true && moment(tanggal_akhir).isBetween(tanggal_mulai, tanggal_selesai, undefined, '[]') ){
                return true;
            }else{
                return false;
            }
        }, "Masukan tanggal dan waktu dengan benar!");
        // ADD FUNCTION VALIDATE DATE RANGE

        // ADD FUNCTION VALIDATE FORM INPUT
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    stepper.next()
                    setDataToRangkuman();
                }
            });
            $('#formInput').validate({
                rules: {
                'daterange[]': {
                    required: true,
                    daterange: true,
                    validationDate:true
                },
                },
                messages: {
                'daterange[]': {
                    required: "Tanggal reservasi wajib diisi",
                    date: "Masukan tanggal dengan benar",
                    validationDate : "Tanggal yang anda masukan tidak sesuai dengan tanggal upacara"
                },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
        // ADD FUNCTION VALIDATE FORM INPUT

        //  BACK FUNCTION FORM
        function backToReservasi(){
            $("#listTahapanReservasi").empty();
            stepper.previous();
        }
        //  BACK FUNCTION FORM

        //  SET DATA TO RANGKUMAN
        function setDataToRangkuman(){
            var dateRange =  document.getElementsByName('daterange[]');
            var id_tahapan =  document.getElementsByName('id[]');
            var namaTahapan =  document.getElementsByName('nama_tahapan[]');
            for (var i = 0; i < dateRange.length; i++) {
                console.log(dateRange[i].value);
                $("#listTahapanReservasi").append(" <div class='card shadow mb-3'><div class='card-header' aria-expanded='false'><label class='form-check-label ml-3' for='todoCheck1'><strong> '"+namaTahapan[i].value+"'</strong></label><input type='hidden' class='d-none' name='data_detail["+i+"][idTahapan]' value='"+id_tahapan[i].value+"'><input type='hidden' class='d-none' name='data_detail["+i+"][tanggal]' value='"+dateRange[i].value+"'><div class='card-tools'><button type='button' class='btn btn-tool' data-card-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fas fa-caret-down float-lg-right'></i></button></div></div><div class='card-body ml-3'><div class='form-group'><p>Tanggal/Waktu Mulai - Selesai Rentetan Upacara :</p><div class='input-group'><div class='input-group-prepend'><span class='input-group-text'><i class='far fa-calendar-alt'></i></span></div><input disabled type='text' class='form-control float-right' value='"+dateRange[i].value+"'></div></div></div></div>");
            }
        }
        //  SET DATA TO RANGKUMAN

    </script>
    {{-- VALIDATE FORM --}}

    <script type="text/javascript">
        let dataPemuputKarya,dataSanggar,dataUpacaraku;
        let blue,green,grey,yellow;

        blue = '#3c8dbc';
        green = '#00a65a';
        grey = '#808080';
        yellow = '#f39c12';


        // FUNCTION GET DATA JADWAL SULINGGIH
        function showJadwal(id){
            $.ajax({
                url: "{{route('ajax.get.data-tangkil')}}"+"/"+id,
                type: "GET",
                dataType: "json",
                success:function(dataTangkil){
                    // console.log(dataTangkil.data);
                    var evetArray = [];
                    var dataArray = {};
                    var dataDetailArray = {};
                    $.each(dataTangkil.data, function(key, dataReservasi){
                        // console.log(data);
                        if(dataReservasi.status != 'proses tangkil'){
                            dataArray.backgroundColor  = green,
                            dataArray.borderColor = green,
                            dataArray.extendedProps = {
                                status : 'Selesai'
                            }
                        }else{
                            dataArray.backgroundColor = blue,
                            dataArray.borderColor = blue,
                            dataArray.extendedProps = {
                                status : 'Akan Datang'
                            }
                        }
                        dataArray.title = "Tangkil Upacara "+dataReservasi.upacaraku.nama_upacara,
                        dataArray.start = dataReservasi.tanggal_tangkil,
                        dataArray.allDay = false
                        evetArray.push({...dataArray});
                        $.each(dataReservasi.detail_reservasi, function(key, dataDetailReservasi){
                            if(dataDetailReservasi.status == 'pending'){
                                dataDetailArray.backgroundColor  = grey, //Success (green)
                                dataDetailArray.borderColor = grey,
                                dataDetailArray.extendedProps = {
                                    status : 'Pending'
                                }
                            }else if(dataDetailReservasi.status == 'diterima'){
                                dataDetailArray.backgroundColor  = blue,
                                dataDetailArray.borderColor = blue,
                                dataDetailArray.extendedProps = {
                                    status : 'Akan Datang'
                                }
                            }else if(dataDetailReservasi.status == 'selesai'){
                                dataDetailArray.backgroundColor  = green,
                                dataDetailArray.borderColor = green,
                                dataDetailArray.extendedProps = {
                                    status : 'Selesai'
                                }
                            }else{
                                dataDetailArray.backgroundColor = blue,
                                dataDetailArray.borderColor = blue,
                                dataDetailArray.extendedProps = {
                                    status : 'Akan Datang'
                                }
                            }
                            dataDetailArray.title = "Muput Upacara "+dataDetailReservasi.tahapan_upacara.nama_tahapan,
                            dataDetailArray.start = dataDetailReservasi.tanggal_mulai,
                            dataDetailArray.end = dataDetailReservasi.tanggal_selesai,
                            dataDetailArray.allDay = false
                            evetArray.push({...dataDetailArray});
                        })
                    });
                    // console.log(evetArray)

                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        events: evetArray,
                        headerToolbar: {
                            left: 'prev,next,today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        themeSystem : 'bootstrap',
                        height: 600,
                        eventClick: function(info) {
                            // console.log(info.event.extendedProps.status)
                            alertDetail(info.event.title,info.event.start,info.event.end,info.event.extendedProps.status);
                        }

                    });
                    calendar.render();
                }
            })
        }
        // FUNCTION GET DATA JADWAL SULINGGIH

        // FUNCTION SHOW DATA SWEETALERT
        function alertDetail(title, start, end, status){
            let mulai = moment(start).format('DD MMMM YYYY | hh:mm A')
            let selesai = moment(end).format('DD MMMM YYYY | hh:mm A')
            // console.log(selesai)
            Swal.fire({
                title: 'Info Detail Jadwal',
                icon:'info',
                html:
                    '<p>Berikut ini merupakan informasi detail Jadwal yang terdapat pada '+jenisPemuput+' '+namaPemuput+'.</p>'+
                    '<ul class="text-left">'+
                        '<li>Terdapat Jadwal   : '+title+' </li>'+
                        (selesai != 'Invalid date' ? '<li>Waktu Tangkil     : '+mulai+' </li>' : '<li>Tanggal Mulai     : '+mulai+' </li>')+
                        (selesai != 'Invalid date' ? '<li>Tanggal Selesai   : '+selesai+' </li>' : '')+
                        '<li>Status  :  '+status+' </li>'+
                    '</ul>'
            })
        }
        // FUNCTION SHOW DATA SWEETALERT


        function getSanggar(id,id_user,nama_sanggar,nama_pengelola,email,nomor_telepon,alamat){
            $("#myModal").modal('hide');
            namaPemuput = nama_sanggar;
            showJadwal(id_user)
            $("#judulKalender").text('Jadwal Acara '+nama_sanggar);
            $("#in_nama_sulinggih").html(nama_sanggar);
            $("#in_email_sulinggih").html(email);
            $("#dataPemuput").empty();
            stepper.next();
            $("#dataPemuput").append("<div class='card-header'><label class='card-title'>Pemuput Upacara</label><div class='card-tools'><button type='button' class='btn btn-tool' data-card-widget='collapse' title='Collapse'><i class='fas fa-plus'></i></button></div></div><div class='card-body box-profile align-content-center'><div class='text-center mb-2'><img class='profile-user-img img-fluid img-circle'  src='{{route('image.profile.sanggar')}}/"+id+"' alt='Logo Sanggar'></div><div class='row mt-3'><div class='col-6'><input value='"+id+"' type='hidden' name='id_relasi' class='d-none'><input value='sanggar' name='tipe' type='hidden' class='d-none'><div class='form-group'><label>Nama Sanggar</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+nama_sanggar+"' disabled=''></div><div class='form-group'><label>Nomer Handphone</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+nomor_telepon+"' disabled=''></div></div><div class='col-6'><div class='form-group'><label>Pengelola Sanggar</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+nama_pengelola+"' disabled=''></div><div class='form-group'><label>Email</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+email+"' disabled=''></div></div><div class='col-12'><div class='form-group'><label>Alamat Lengkap Pemuput</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+alamat+"' disabled></div></div></div></div>");
        }

        // FUNCTION GET DATA PEMUPUT YANG DIPILIH
        function getPemuput(id,id_user,nama,tlpn,alamat,namaWalaka,tgldiksha,email){
            namaPemuput = nama;
            jenisPemuput = 'Pemuput Karya'
            console.log(id)
            $("#myModal").modal('hide');
            $("#dataPemuput").empty();
            $("#judulKalender").text('Jadwal Muput '+nama);
            stepper.next()
            showJadwal(id_user)
            $("#in_nama_sulinggih").html(nama);
            $("#in_email_sulinggih").html(email);
            $("#dataPemuput").append("<div class='card-header'><label class='card-title'>Pemuput Upacara</label><div class='card-tools'><button type='button' class='btn btn-tool' data-card-widget='collapse' title='Collapse'><i class='fas fa-plus'></i></button></div></div><div class='card-body box-profile align-content-center'><div class='text-center mb-2'><img class='profile-user-img img-fluid img-circle'  src='{{route('image.profile.user')}}/"+id_user+"' alt='User profile picture'></div><div class='row mt-3'><div class='col-6'><input value='"+id_user+"' type='hidden' name='id_relasi' class='d-none'><input value='pemuput_karya' name='tipe' type='hidden' class='d-none'><div class='form-group'><label>Nama Panggilan</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+namaWalaka+"' disabled=''></div><div class='form-group'><label>Nomer Handphone</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+tlpn+"' disabled=''></div><div class='form-group'><label>Email</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+email+"' disabled=''></div></div><div class='col-6'><div class='form-group'><label>Nama Sulinggih</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+nama+"' disabled=''></div><div class='form-group'><label>Tanggal diDiksha</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+moment(tgldiksha).format('D-MMM-Y')+"' disabled=''></div><div class='form-group'><label>Alamat Lengkap Pemuput</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+alamat+"' disabled></div></div></div></div>");
        };
        // FUNCTION GET DATA PEMUPUT YANG DIPILIH

        // FUNCTION KETIKA ADD RESERVASI
        function showDateTahapan(id) {
            var checkBox = document.getElementById("check"+id);
            var text = document.getElementById("body"+id);
            if (checkBox.checked == true){
                text.style.display = "block";
                $("#card"+id).removeClass("collapsed-card");
                $("#inputDate-"+id).append( "<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'><i class='far fa-clock'></i></span></div> <input name='daterange[]' id='reservationtime"+id+"' type='text' class='form-control float-right' value=''></div>");
                moment(dataUpacara.tanggal_selesai).format('YYYY-MM-DD')
                $('#reservationtime'+id).daterangepicker({
                    autoUpdateInput: true,
                    timePicker: true,
                    timePicker24Hour: true,
                    "startDate": moment(dataUpacara.tanggal_mulai).format('DD MMMM YYYY'),
                    "endDate":  moment(dataUpacara.tanggal_selesai).format('DD MMMM YYYY'),
                    minDate: moment(dataUpacara.tanggal_mulai).format('DD MMMM YYYY'),
                    maxDate: moment(dataUpacara.tanggal_selesai).add(23,'hours').add(59,'minutes').format('DD MMMM YYYY H:mm'),
                    time: {
                        enabled: true
                    },
                    locale: {
                        format: 'DD MMMM YYYY H:mm',
                        cancelLabel: 'Clear'
                    },
                    drops: "up",
                })
            }else {
                $("#inputDate-"+id).empty();
                $("#card"+id).addClass("collapsed-card");
                text.style.display = "none";
            }
        }
        // FUNCTION KETIKA ADD RESERVASI
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const favoritPemuput = [];
        const favoritSanggar = [];
        const griyaHaveFavorit = [];

        function addFavorit(id,id_griya,tipe,button)
        {
            $(button).find("i").addClass("text-danger")
            $(button).attr("onclick","removeFavorit("+id+","+id_griya+",'"+tipe+"',this)");
            tipe == 'id_pemuput_karya' ? favoritPemuput.push(id) : favoritSanggar.push(id);
            $.ajax({
                url: "{{ route('ajax.set-favorit')}}",
                type:'POST',
                data: {
                    id:id,
                    tipe:tipe,
                    "_token":"{{ csrf_token() }}"
                },
                success:function(response){
                    griyaHaveFavorit.push(id_griya)
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                },
                error: function(response, error){
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                }
            });

        }

        function removeDuplicateArray(array,value)
        {
            const index = array.indexOf(value);
            if (index > -1) {
                array.splice(index, 1);
            }
            return array;
        }


        function removeFavorit(id,id_griya,tipe,button)
        {
            console.log(id_griya)
            $(button).find("i").removeClass("text-danger");
            $(button).attr("onclick","addFavorit("+id+","+id_griya+",'"+tipe+"',this)");
            tipe == 'id_pemuput_karya' ? data = favoritPemuput : data = favoritSanggar;
            favoritPemuput == removeDuplicateArray(data,id)
            $.ajax({
                url: "{{ route('ajax.set-favorit')}}",
                type:'POST',
                data: {
                    id:id,
                    tipe:tipe,
                    "_token":"{{ csrf_token() }}"
                },
                success:function(response){
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                },
                error: function(response, error){
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                }
            });
            griyaHaveFavorit == removeDuplicateArray(griyaHaveFavorit,id_griya)
        }


        // FUNCTION TO VIEW MAPS AND MARKER
        $(document).ready(function(){

            let mymap = L.map('gmaps').setView([-8.5108504, 115.1005634], 10);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'E-Yajamana',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);

            // START INISIALISASI DATA
                dataJsonSanggar = $('#dataSanggar').val();
                dataSanggar = JSON.parse(dataJsonSanggar)
                dataJsonPemuput = $('#dataJSONPemuput').val();
                dataPemuputKarya = JSON.parse(dataJsonPemuput);
                dataPemuputKarya.forEach(element => {
                    element.pemuput_karya.forEach(data =>{
                        if(data.favorit_user.length != 0){
                            favoritPemuput.push(data.id);
                        }
                        if(favoritPemuput.includes(data.id)){
                            griyaHaveFavorit.push(data.id_griya)
                        }
                    });
                })


                function createMarkerPemuput(kabupaten,kecamatan,desa_dinas,id_banjar_dinas,favorit,dataPemuputKarya)
                {
                    var icMarker = L.icon({
                        iconUrl: "{{asset('base-template/dist/img/marker/griya.png')}}",
                        iconSize: [36, 40],
                        iconAnchor: [8 , 40],
                        popupAnchor: [12, -28],
                    });
                    markerPemuput = [];
                    dataPemuputKarya.forEach(element => {

                        marker = new L.marker([element.lat, element.lng],{
                            icon: icMarker,
                        });
                        marker.on('click', function() {
                            marker.openPopup();
                            $("#myModal").modal();
                            // SET VALUE GRIYA
                            $("#nama_griya").html(element.nama_griya_rumah);
                            $("#alamat").html("Lokasi : "+element.alamat_griya_rumah);
                            $("#dataSulinggih").empty();
                            // SET MODAL DATA SULINGGIH DAN PEMUPUT KARYA
                            let i =0;
                            element.pemuput_karya.forEach(data =>{
                                if(favorit == 1 ){
                                    if(favoritPemuput.includes(data.id)){
                                        appendDataPemuput(data, i++);
                                    }
                                }else{
                                    appendDataPemuput(data, i++);
                                }
                            });
                        });

                        let dataKabupaten = element.banjar_dinas.desa_dinas.kecamatan.kabupaten.id
                        let dataKecamatan = element.banjar_dinas.desa_dinas.kecamatan.id
                        let dataDesa = element.banjar_dinas.desa_dinas.id
                        let dataBanjar = element.id_banjar_dinas

                        if((kabupaten == 0 || kabupaten == dataKabupaten ) &&  (kecamatan == 0 || kecamatan == dataKecamatan ) && (desa_dinas == 0 || desa_dinas == dataDesa ) && (id_banjar_dinas == 0 || id_banjar_dinas == dataBanjar ) ){
                            if(favorit == 1 ){
                                if(griyaHaveFavorit.includes(element.id)){
                                    markerPemuput.push(marker);
                                }
                            }else{
                                markerPemuput.push(marker);
                            }
                        }else if(kabupaten == 0 && kecamatan == 0 && desa_dinas == 0 && id_banjar_dinas == 0  && favorit == 0 && tipe == 0){
                            markerPemuput.push(marker);
                        }

                    })
                    pemuputMarker = L.layerGroup(markerPemuput);
                    mymap.addLayer(pemuputMarker)
                }

                function appendDataPemuput(data,key)
                {
                    console.log(data)
                    var tanggal_diksha = moment(data.tanggal_diksha).format('DD MMMM YYYY')
                    $("#dataSulinggih").append(
                    '<div class="col-12" id="accordion">'+'<div class="card">'+'<div class="card-header">'+
                    '<a class="d-block w-100" data-toggle="collapse" href="#collapseOne'+data.user.id+''+key+'">'+"<div class='user-block'>"+
                    "<img class='img-circle mt-1' src='{{route('image.profile.user')}}/"+data.user.id+"' alt='User Image' style='height: 48px; width:  48px'>"+
                    "<span class='username'><div class='btn btn-link p-0 ml-3' >"+data.nama_pemuput+"</div></span>"+
                    "<span class='description'><div class='ml-3 '>"+data.user.email+" | <i class='fas fa-star text-warning'></i> 5</div></span>"+
                    "<span class='description'> <div class='ml-3 '>Muput Upacara "+data.user.reservasi_count+"</div> </span>"+
                    "</div>"+"</a>"+"<div class='card-tools'>"+
                    (data.favorit_user.length != 0  || favoritPemuput.includes(data.id) ? "<button title='Tambahkan ke Favorit' onclick=\"removeFavorit("+data.id+","+data.id_griya+",  'id_pemuput_karya',this)\" type='button' class='btn btn-tool float-lg-right pt-3'><i id='favorit' class='fas fa-heart fa-sm text-danger'></i></button>" : "<button title='Tambahkan ke Favorit' onclick=\"addFavorit("+data.id+","+data.id_griya+",'id_pemuput_karya',this)\" type='button' class='btn btn-tool float-lg-right pt-3'><i id='favorit' class='fas fa-heart fa-sm'></i></button>")+
                    "</div>"+"</div>"+
                    '<div id="collapseOne'+data.user.id+''+key+'" class="collapse" data-parent="#accordion">'+
                    '<div class="card-body">'+"<div class='row d-flex justify-content-center px-3'>"+'<div class="col-6">'+'<div class=" align-items-center">'+
                    '<p class="text-xs mb-0"> <strong>Tanggal Diksha :</strong> '+tanggal_diksha+'</p>'+
                    (data.user.penduduk.nama_alias == null || data.user.penduduk.nama_alias == '' ? '<p class="text-xs mb-0"> <strong> Nama Walaka : </strong>Belum Terdata</p>' : '<p class="text-xs mb-0"> <strong> Nama Walaka : </strong> '+data.user.penduduk.nama_alias +' </p>' )+
                    '<p class="text-xs mb-0 d-flex"> <strong> Nomor Telepon :</strong> '+data.user.nomor_telepon+'</p>'+
                    '</div>'+"</div>"+'<div class="col-6">'+'<div class=" align-items-center">'+
                    '<p class="text-xs mb-0"> <strong> Tipe : </strong>'+data.tipe+'</p>'+
                    (data.atribut_pemuput.nabe == 0 || data.atribut_pemuput.nabe == null ? '<p class="text-xs mb-0 d-flex"> <strong> Nama Nabe : </strong>Belum Terdata</p>' : '<p class="text-xs mb-0 "> <strong> Nama Nabe : </strong> </p><p class="text-xs m-0"> '+data.atribut_pemuput.nabe.nama_pemuput +'</p>' )+
                    '<p class="text-xs mb-0"> <strong> Jenis Kelamin : </strong>'+data.user.penduduk.jenis_kelamin+'</p>'+
                    '</div>'+'</div>'+'</div>'+'</div>'+"<div class='card-footer'>"+
                    "<button type='button' class='btn btn btn-primary btn-sm float-lg-right' data-toggle='modal' onclick=\"getPemuput("+data.id+","+data.id_user+",'"+data.nama_pemuput+"','"+data.user.nomor_telepon+"','"+alamat+"','"+data.user.penduduk.nama_alias+"','"+tanggal_diksha+"','"+data.user.email+"')\">Reservasi</button>"+
                    "</div>"+'</div>'+'</div>'+'</div>'
                    );

                }




                $("#searchFilter").click(function() {
                    $('#filterMarker').modal('hide');
                    let val_kabupaten = $('#kabupaten').val();
                    let val_kecamatan = $('#kecamatan').val();
                    let val_desa_dinas = $('#desa_dinas').val();
                    let val_id_banjar_dinas = $('#id_banjar_dinas').val();
                    let val_tipe = $('#tipe_pemuput').val();
                    let val_favorit = $('#val_fav').val();
                    switch(val_tipe){
                        case "sulinggih":
                            mymap.removeLayer(pemuputMarker);
                            createMarkerPemuput(val_kabupaten,val_kecamatan,val_desa_dinas,val_id_banjar_dinas,val_favorit,dataPemuputKarya);
                            break;
                        case "sanggar":
                            mymap.removeLayer(pemuputMarker);
                            break;
                        default:
                            mymap.removeLayer(pemuputMarker);
                            createMarkerPemuput(val_kabupaten,val_kecamatan,val_desa_dinas,val_id_banjar_dinas,val_favorit,dataPemuputKarya);
                    }
                });

                createMarkerPemuput(0,0,0,0,0,dataPemuputKarya);


                // dataSanggar.forEach(element => {
                //     createMarkerSanggar(element);
                // });
            // END INISIALISASI DATA


            //  FUNCTION CREATE MAREKER SANGGAR
            function createMarkerSanggar(data){
                console.log(data)
                var icMarker = L.icon({
                    iconUrl: "{{asset('base-template/dist/img/marker/sanggar.png')}}",
                    iconSize: [36, 40],
                    iconAnchor: [8 , 40],
                    popupAnchor: [12, -28],
                });

                var marker = new L.marker([data.lat, data.lng],{
                    icon: icMarker,
                }).bindPopup(data.nama_sanggar).addTo(mymap);

                marker.on('click', function() {
                    marker.openPopup();
                    $("#myModal").modal();
                    $("#nama_griya").html(data.nama_sanggar);
                    $("#alamat").html("Lokasi : "+data.alamat_sanggar);
                    $("#dataSulinggih").empty();
                    $("#dataSulinggih").append("<div class='card shadow collapsed-card mt-3'><div class='card-header'><div class='user-block'><img class='img-circle' src='{{route('image.profile.user')}}/"+data.user[0].id+"' alt='User Image'><span class='username'><a class='ml-2' href='#'> "+data.nama_sanggar+"</a></span><span class='description'><div class='ml-2 '> "+data.user[0].email+"</div></span></div><div class='card-tools'><button type='button' class='btn btn-tool' data-card-widget='collapse'><i class='fas fa-plus'></i></button></div></div><div class='card-body'><div class='row '><div class='col-7 d-flex justify-content-center align-items-center mb-2'><span style='font-size:80%' >Pengelola Sanggar   :</span></div><div class='col-5'><span style='font-size:80%' > "+data.user[0].penduduk.nama+"</span></div><div class='col-7 d-flex justify-content-center align-items-center mb-2'><span style='font-size:80%' >Nomor Telepon :</span></div><div class='col-5'><span style='font-size:80%' > "+data.user[0].nomor_telepon+"</span></div></div></div><div class='card-footer' style='display: none;'><button type='button' class='btn btn btn-primary btn-sm float-lg-right' data-toggle='modal' onclick=\"getSanggar("+data.id+","+data.id_user+",'"+data.nama_sanggar+"','"+data.user[0].penduduk.nama+"','"+data.user[0].email+"','"+data.user[0].nomor_telepon+"','"+data.alamat_sanggar+"')\">Reservasi</button></div></div>");
                });
            }
            // //  END FUNCTION CREATE MAREKER SANGGAR


            // //  FUNCTION CREATE MAREKER PEMUPUT-KARYA
            function createMarkerPemuputKarya(lat,lng,namaGriya,alamat,dataSulinggih){
                var icMarker = L.icon({
                    iconUrl: "{{asset('base-template/dist/img/marker/griya.png')}}",
                    iconSize: [36, 40],
                    iconAnchor: [8 , 40],
                    popupAnchor: [12, -28],
                });

                var marker = new L.marker([lat, lng],{
                    icon: icMarker,
                }).bindPopup(namaGriya).addTo(mymap);

                marker.on('click', function() {
                    marker.openPopup();
                    $("#myModal").modal();
                    // SET VALUE GRIYA
                    $("#nama_griya").html(namaGriya);
                    $("#alamat").html("Lokasi : "+alamat);
                    $("#dataSulinggih").empty();
                    // SET MODAL DATA SULINGGIH DAN PEMUPUT KARYA
                    dataSulinggih.forEach(data =>{
                        var tanggal_diksha = moment(data.tanggal_diksha).format('DD MMMM YYYY')
                        $("#dataSulinggih").append("<div class='card shadow collapsed-card mt-3'><div class='card-header'><div class='user-block'><img class='img-circle' src='{{route('image.profile.user')}}/"+data.id_user+"' alt='User Image'><span class='username'><a class='ml-2' href='#'> "+data.nama_pemuput+"</a></span><span class='description'><div class='ml-2 '> "+data.user.email+"</div></span></div><div class='card-tools'><button type='button' class='btn btn-tool' data-card-widget='collapse'><i class='fas fa-plus'></i></button></div></div><div class='card-body'><div class='row '><div class='col-7 d-flex justify-content-center align-items-center mb-2'><span style='font-size:80%' >Tanggal Diksha   :</span></div><div class='col-5'><span style='font-size:80%' > "+tanggal_diksha+"</span></div><div class='col-7 d-flex justify-content-center align-items-center mb-2'><span style='font-size:80%' >Nomor Telepon :</span></div><div class='col-5'><span style='font-size:80%' > "+data.user.nomor_telepon+"</span></div></div></div><div class='card-footer' style='display: none;'><button type='button' class='btn btn btn-primary btn-sm float-lg-right' data-toggle='modal' onclick=\"getPemuput("+data.id+","+data.id_user+",'"+data.nama_pemuput+"','"+data.user.nomor_telepon+"','"+alamat+"','"+data.user.penduduk.nama_alias+"','"+tanggal_diksha+"','"+data.user.email+"')\">Reservasi</button></div></div>");
                    });
                });
            }
            //  END CREATE MAREKER PEMUPUT-KARYA

            // $( "#gaskantest" ).click(function() {
            //     mymap.refresh();
            // });


        });
        // FUNCTION TO VIEW MAPS AND MARKER




    </script>

@endpush
