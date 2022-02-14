@extends('layouts.krama.krama-layout')
@section('tittle','Data Upacaraku')

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
                    <h1>Tambah Upacaraku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">List Upacaraku</a></li>
                    <li class="breadcrumb-item active">Buat Upacaraku</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Upacara</h3>
                </div>
                <div class="card-body p-0">
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                        <!-- your steps here -->
                            <div class="step" data-target="#logins-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Jenis Upacara</span>
                                </button>
                            </div>

                            <div class="line"></div>
                            <div class="step" data-target="#information-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Data Detail</span>
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
                        <div class="bs-stepper-content">
                            <!-- STEPPER 1 PILIH YADNYA -->
                            <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                <div class="row justify-content-center">
                                    <div class="col-4" data-category="1" data-sort="white sample">
                                        <div class="card p-2 shadow cursor" role="button">
                                            <img src="{{asset('base-template/dist/img/jenis-yadnya/dewa-yadnya.jpg')}}" style="height:200px; object-fit:cover;" alt="white sample"/>
                                            <button id="dewaYadnya" value="Dewa Yadnya" class="btn btn-block btn-primary " type="button" style="opacity: 90%" onclick="stepper.next()">DEWA YADNYA</button>
                                        </div>
                                    </div>
                                    <div class="col-4" data-category="1" data-sort="white sample">
                                        <div class="card p-2 shadow cursor" role="button">
                                            <img src="{{asset('base-template/dist/img/jenis-yadnya/pitra-yadnya.jpg')}}" style="height:200px; object-fit:cover;" alt="white sample"/>
                                            <button id="pitraYadnya" value="Pitra Yadnya" class="btn btn-block btn-primary" type="button" style="opacity: 90%" onclick="stepper.next()">PITRA YADNYA</button>
                                        </div>
                                    </div>
                                    <div class="col-4" data-category="1" data-sort="white sample">
                                        <div class="card p-2 shadow cursor" role="button">
                                            <img src="{{asset('base-template/dist/img/jenis-yadnya/rsi-yadnya.jpg')}}" style="height:200px; object-fit:cover;" alt="white sample"/>
                                            <button id="rsiYadnya" value="Rsi Yadnya" class="btn btn-block btn-primary" type="button" style="opacity: 90%" onclick="stepper.next()">RSI YADNYA</button>
                                        </div>
                                    </div>
                                    <div class="col-4" data-category="1" data-sort="white sample">
                                        <div class="card p-2 shadow cursor" role="button">
                                            <img src="{{asset('base-template/dist/img/jenis-yadnya/manusa-yadnya.jpg')}}" style="height:200px; object-fit:cover;" alt="white sample"/>
                                            <button id="manusaYadnya" value="Manusa Yadnya" class="btn btn-block btn-primary" type="button" style="opacity: 90%" onclick="stepper.next()">MANUSA YADNYA</button>
                                        </div>
                                    </div>
                                    <div class="col-4" data-category="1" data-sort="white sample">
                                        <div class="card p-2 shadow cursor" role="button">
                                            <img src="{{asset('base-template/dist/img/jenis-yadnya/bhuta-yadnya.jpg')}}" style="height:200px; object-fit:cover;" alt="white sample"/>
                                            <button id="bhutaYadnya" value="Bhuta Yadnya" class="btn btn-block btn-primary"  type="button" style="opacity: 90%" onclick="stepper.next()">BHUTA YADNYA</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- STEPPER 1 PILIH YADNYA -->

                            <!-- STEPPER 2 INPUT DATA FORM -->
                            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                <form id="submitData" action="{{route('krama.manajemen-upacara.upacaraku.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jenis Yadnya <span class="text-danger">*</span></label>
                                        <input disabled id="jenis_yadnya" type="text" name="jenis_yadnya" novalidate class="needs-validation form-control @error('jenis_yadnya') is-invalid @enderror" id="exampleInputEmail1" value="">
                                        @error('jenis_yadnya')
                                            <div class="invalid-feedback text-start">
                                                {{ $errors->first('jenis_yadnya') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Jenis Upacara <span class="text-danger">*</span></label>
                                            <select id="jenis_upacara" name="id_upacara" class="form-control select2bs4 @error('id_upacara') is-invalid @enderror" style="width: 100%;">
                                                <option value="0" disabled selected>Pilih Jenis Upacara</option>
                                            </select>
                                            @error('id_upacara')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('id_upacara') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Upacara <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="nama_upacara" name="nama_upacara" autocomplete="off" class="form-control @error('nama_upacara') is-invalid @enderror" value="{{ old('nama_upacara') }}" placeholder="Masukan Nama Upacara">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                            @error('nama_upacara')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('nama_upacara') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai - Tanggal Selesai Upacara <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                            </div>
                                            <input id="daterange" name="daterange" type="text" class="form-control float-right @error('daterange') is-invalid @enderror">
                                            @error('daterange')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('desc') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- AJAX LOKASI SEARCH  -->
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                                                <select name="kabupaten" id="kabupaten" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;" value="{{old('kabupaten')}}">
                                                    <option value="0" disabled selected>Pilih Kabupaten</option>
                                                    @php
                                                        $kabupaten = old('kabupaten')
                                                    @endphp
                                                    @foreach ($dataKabupaten as $data)
                                                        @if ($kabupaten == $data->id)
                                                            <option value="{{$data->id}}" selected>{{$data->name}}</option>
                                                        @else
                                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <p class="m-1 text-sm">(Pilih List Kabupaten Bali)</p>
                                                @error('kabupaten')
                                                    <div class="invalid-feedback text-start">
                                                        {{$errors->first('kabupaten') }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Kecamatan <span class="text-danger">*</span></label>
                                                    <select id="kecamatan" name="kecamatan" class="form-control select2bs4 @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                                        <option value="0" disabled selected>Pilih Kecamatan</option>
                                                    </select>
                                                    <p class="m-1 text-sm">(Pilih Kabupaten terlebih dahulu )</p>
                                                    @error('kecamatan')
                                                        <div class="invalid-feedback text-start">
                                                            {{$errors->first('kecamatan') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Desa Dinas<span class="text-danger">*</span></label>
                                                <select id="desa_dinas" name="id_desa" class="form-control select2bs4 @error('id_desa') is-invalid @enderror" style="width: 100%;">
                                                    <option value="0" disabled selected>Pilih Desa Dinas</option>
                                                </select>
                                                <p class="m-1 text-sm">(Pilih Kecamatan terlebih dahulu)</p>
                                                @error('id_desa')
                                                    <div class="invalid-feedback text-start">
                                                        {{$errors->first('id_desa') }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Banjar Dinas <span class="text-danger">*</span></label>
                                                <select id="id_banjar_dinas" name="id_banjar_dinas" class="form-control select2bs4 @error('id_banjar_dinas') is-invalid @enderror" style="width: 100%;">
                                                    <option value="0" disabled selected>Pilih Banjar Dinas</option>
                                                </select>
                                                <p class="m-1 text-sm">(Pilih Desa Dinas terlebih dahulu)</p>
                                                @error('id_banjar_dinas')
                                                    <div class="invalid-feedback text-start">
                                                        {{$errors->first('id_banjar_dinas') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- AJAX LOKASI SEARCH  -->

                                    <div class="form-group">
                                        <label>Alamat Lengkap Lokasi Upacara <span class="text-danger">*</span></label>
                                        <textarea id="alamat" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" rows="3" placeholder="Masukan Alamat Lengkap Lokasi Upacara">{{old('lokasi')}}</textarea>
                                        @error('lokasi')
                                            <div class="invalid-feedback text-start">
                                                {{ $errors->first('lokasi') }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Form Pemetaan Lokasi Upacara --}}
                                    <div class="form-group">
                                        <label>Pemetaan Lokasi Upacara <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input name="lat" id="lat" type="text" aria-label="First name" class="form-control mr-1 @error('lat') is-invalid @enderror" placeholder="Lat" value="{{old('lat')}}" readonly="readonly">
                                            @error('lat')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('lat') }}
                                                </div>
                                            @enderror
                                            <input name="lng" id="lng" type="text" aria-label="Last name" class="form-control ml1" placeholder="Lang  @error('lng') is-invalid @enderror" value="{{old('lat')}}" readonly="readonly">
                                            @error('lng')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('lng') }}
                                                </div>
                                            @enderror
                                            <button type="button" class="btn btn-default ml-2" data-toggle="modal" id="modalMap" data-target="#modal-xl">
                                                <i class="fas fa-map-marked"></i>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- Form Pemetaan Lokasi Upacara --}}

                                    <div class="form-group">
                                        <label>Deskripsi Upacara </label>
                                        <textarea  id="deskripsi" name="deskripsi_upacara" class="form-control" rows="3" placeholder="Masukan Deskripsi Upacara"></textarea>
                                        @error('deskripsi_upacara')
                                            <div class="invalid-feedback text-start">
                                                {{ $errors->first('deskripsi_upacara') }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                        <button id="submitToRangkuman" type="button" class="btn btn-primary float-sm-right">Selanjutnya</button>
                                    </div>
                                </form>
                            </div>
                            <!-- STEPPER 2 INPUT DATA FORM -->

                            <!-- STEPPER 3 RANGKUMAN DATA -->
                            <div id="next-part" class="content" role="tabpanel" aria-labelledby="next-part-trigger">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Yadnya </label>
                                    <input disabled id="view_jenis_yadnya" type="text" name="jenis_yadnya" class="form-control @error('jenis_yadnya') is-invalid @enderror" id="exampleInputEmail1" value="">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Jenis Upacara </label>
                                        <input disabled type="text" id="view_jenis_upacara" autocomplete="off" class="form-control"  placeholder="Masukan Nama Upacara">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Upacara </label>
                                    <div class="input-group mb-3">
                                        <input disabled type="text" id="view_nama_upacara" autocomplete="off" class="form-control " placeholder="Masukan Nama Upacara">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Mulai - Tanggal Selesai Upacara</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                        </div>
                                        <input disabled readonly="readonly" name="view_rangedate" type="text" class="form-control float-right" id="view_daterange">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                {{-- Mengambil Data Lokasi --}}
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Kabupaten/Kota </label>
                                            <input disabled type="text" id="view_kabupaten" autocomplete="off" class="form-control" value="{{ old('nama_upacara') }}" placeholder="Masukan Nama Upacara">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Kecamatan </label>
                                                <input disabled type="text" id="view_kecamatan" autocomplete="off" class="form-control" placeholder="Masukan Nama Upacara">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Desa Dinas</label>
                                            <input disabled type="text" id="view_desa" name="nama_upacara" autocomplete="off" class="form-control" placeholder="Masukan Nama Upacara">
                                        </div>
                                        <div class="form-group">
                                            <label>Desa Adat </label>
                                            <input disabled type="text" id="view_desa_adat" name="nama_upacara" autocomplete="off" class="form-control" placeholder="Masukan Nama Upacara">
                                        </div>
                                    </div>
                                </div>
                                {{-- Mengambil Data Lokasi --}}

                                <div class="form-group">
                                    <label>Alamat Lengkap Lokasi Upacara</label>
                                    <textarea disabled id="view_alamat" class="form-control" rows="3" placeholder="Masukan Alamat Lengkap Lokasi Upacara"></textarea>
                                </div>

                                {{-- Form Pemetaan Lokasi Upacara --}}
                                <div class="form-group">
                                    <label>Pemetaan Lokasi Upacara</label>
                                    <div class="input-group mb-3">
                                        <input id="view_lat" name="lat" type="text" aria-label="First name" class="form-control mr-1" placeholder="Lat" readonly="readonly">
                                        <input id="view_lng" name="lng" type="text" aria-label="Last name" class="form-control ml1" placeholder="Lang " readonly="readonly">
                                        <button type="button" class="btn btn-default ml-2" data-toggle="modal" id="modalMap">
                                            <i class="fas fa-map-marked"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Upacara</label>
                                    <textarea disabled readonly="readonly" id="view_desc" name="desc" class="form-control @error('desc') is-invalid @enderror" rows="3" placeholder="Masukan Deskripsi Upacara">{{old('desc')}}</textarea>
                                </div>

                                <div class="card tab-content" id="v-pills-tabContent">
                                    <div class="card-header my-auto">
                                        <h3 class="card-title my-auto">Rentetan Upacara</h3>
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
                                        <div class="row px-lg-5">
                                            <div class="col-12 col-sm-4">
                                                <h4 class="text-center mb-3">AWAL</h4>
                                                <ul id="awal"></ul>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <h4 class="text-center mb-3">PUNCAK</h4>
                                                <ul id="puncak"></ul>

                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <h4 class="text-center mb-3">AKHIR</h4>
                                                <ul id="akhir"> </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer my-2">
                                        <button type="button" class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                        <button type="button" id="submit" class="btn btn-primary float-sm-right" >Simpan</button>
                                    </div>
                                </div>
                            </div>
                            <!-- STEPPER 3 RANGKUMAN DATA -->

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
          <!-- /.card -->
        </div>
    </div>

    <div class="modal fade " id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pemetaan Maps E-Yajamana</h4>
                    <button type="button" style="" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="gmaps" style="height: 500px"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary">Simpan Pemetaan Lokasi</button>
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
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{asset('base-template/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

    <!-- jquery-validation -->
    <script src="{{asset('base-template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/jquery-validation/additional-methods.min.js')}}"></script>

    <!-- dropzonejs -->
    <script src="{{asset('base-template/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('base-template/dist/js/demo.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- ajax-get-wilayah -->
    <script src="{{asset('base-template/dist/js/pages/ajax-get-wilayah.js')}}"></script>

    <!-- Set Up Library -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-upacara').addClass('menu-open');
            $('#side-tambah-upacara').addClass('active');
        });

        $('#daterange').daterangepicker({
            locale: {
                format: 'DD MMMM YYYY',
            },
            drops: "up",
        });

        $('#mySelect2').select2('data');
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
    </script>
@endpush

@push('js')

    <script language="javascript" type="text/javascript">
        let jenis_upacara,nama_upacara,kabupaten,kecamatan,desa_dinas,desa_adat,alamat,deskripsi,daterange;


        // VALIDASI FORM INPUT DATA
        $('#submitData').validate({
            rules: {
                id_upacara: {
                    required: true,
                    number: true
                },
                nama_upacara: {
                    required: true,
                    minlength: 3
                },
                daterange: {
                    required: true,
                },
                kabupaten: {
                    required: true,
                    number: true
                },
                kecamatan: {
                    required: true,
                    number: true
                },
                id_desa: {
                    required: true,
                    number: true
                },
                id_banjar_dinas: {
                    required: true,
                    number: true
                },
                lokasi: {
                    required: true,
                    minlength: 3
                },
                lng: {
                    required: true,
                    number: true
                },
                deskripsi_upacara: {
                    required: true,
                },
            },
            messages: {
                nama_upacara: {
                    required: "Nama Upacara Wajib diisi",
                    minlength: "Nama Upacara minimal berjumlah 3 karakter"
                },
                id_upacara: {
                    required: "Jenis Upacara Wajib diisi",
                    number: "Format Jenis Upacara haru benar!"
                },
                daterange: {
                    required: "Tanggal Mulai - Selesai Upacara Wajib diisi",
                },
                kabupaten: {
                    required: "Kolom Kabupaten Wajib diisi",
                    number: "Format Kolom Kabupaten haru benar!"
                },
                kecamatan: {
                    required: "Kolom Kecamatan Wajib diisi",
                    number: "Format Kolom Kecamatan haru benar!"
                },
                id_desa: {
                    required: "Kolom Desa Dinas Wajib diisi",
                    number: "Format Kolom Desa Dinas haru benar!"
                },
                id_banjar_dinas: {
                    required: "Kolom Banjar Dinas Wajib diisi",
                    number: "Format Kolom Banjar Dinas haru benar!"
                },
                lokasi: {
                    required: "Alamat Lengkap Wajib diisi",
                    minlength: "Alamat Lengkap minimal berjumlah 3 karakter"
                },
                lng: {
                    required: "Pemetaan Lokasi Upakara Wajib diisi!",
                },
                deskripsi_upacara: {
                    required: "Deskripsi Upacara Wajib diisi",
                    minlength: "Deskripsi Upacara minimal berjumlah 3 karakter"
                },

            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('ml-1 invalid-feedback text-start');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });


        $('#submit').click(function(){
            $('#submitData').submit();
        })

        $('#submitToRangkuman').click(function(){
            var form = $("#submitData");
            if(form.valid()==true){
                stepper.next();
                setDataToRangkuman();
            }

        });

        function setDataToRangkuman()
        {
            // stepper.next();
            // AJAX GET DATA TAHAPAN TO RANGKUMAN
            var jenisUpacara = $("#jenis_upacara").val()
            if(jenisUpacara){
                $.ajax({
                    url: "{{route('ajax.get.tahapan-upacara')}}"+"/"+jenisUpacara,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(datatahapan)
                    {
                        console.log(datatahapan.data);
                        $('#awal').empty();
                        $('#puncak').empty();
                        $('#akhir').empty();
                        $.each(datatahapan.data, function(key, data){
                            $('#'+data.status_tahapan).append('<li>'+data.nama_tahapan+'</li>');
                        });
                    }
                })
            }else{
                $('#awal').empty();
                $('#puncak').empty();
                $('#akhir').empty();
            }

            // GET DATA IN FORM
            jenis_upacara = $("#jenis_upacara option:selected").text()
            nama_upacara = $("#nama_upacara").val()
            kabupaten = $("#kabupaten option:selected").text()
            kecamatan = $("#kecamatan option:selected").text()
            desa_dinas = $("#desa_dinas option:selected").text()
            desa_adat = $("#desa_adat option:selected").text()
            alamat = $("#alamat").val()
            deskripsi = $("#deskripsi").val()
            daterange = $("#daterange").val()
            // SET STEPPER TO RANGKUMAN
            $("#view_jenis_yadnya").val(jenisYadnya)
            $("#view_jenis_upacara").val(jenis_upacara)
            $("#view_nama_upacara").val(nama_upacara)
            $("#view_daterange").val(daterange)
            $("#view_kabupaten").val(kabupaten)
            $("#view_kecamatan").val(kecamatan)
            $("#view_desa").val(desa_dinas)
            $("#view_desa_adat").val(desa_adat)
            $("#view_alamat").val(alamat)
            $("#view_desc").val(deskripsi)
        }
    </script>


    <!-- Get Data Jenis Yadnya -->
    <script>
        let jenisYadnya;
        function getJenisYadnya(jenisYadnya){
            $.ajax({
                url: "{{route('ajax.get.jenis-yadnya')}}"+"/"+jenisYadnya,
                type: "GET",
                data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(dataYadnya)
                {
                    console.log(dataYadnya.data);
                    if(dataYadnya.data){
                        $('#jenis_upacara').empty();
                        $('#jenis_upacara').append('<option value="0" disabled selected>Pilih Jenis Upacara</option>');
                        $.each(dataYadnya.data, function(key, data){
                            $('#jenis_upacara').append('<option value="'+ data.id +'">' + data.nama_upacara+ '</option>');
                            jenis_upacara = data.nama_upacara;
                        });
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $('#jenis_upacara').empty();
                }
            })
        }
        $('#dewaYadnya').click(function(){
            jenisYadnya =  $("#dewaYadnya").val();
            $("#jenis_yadnya").val(jenisYadnya);
            getJenisYadnya(jenisYadnya);
        })
        $('#pitraYadnya').click(function(){
            jenisYadnya =  $("#pitraYadnya").val();
            $("#jenis_yadnya").val(jenisYadnya);
            getJenisYadnya(jenisYadnya);
        })
        $('#rsiYadnya').click(function(){
            jenisYadnya =  $("#rsiYadnya").val();
            $("#jenis_yadnya").val(jenisYadnya);
            getJenisYadnya(jenisYadnya);
        })
        $('#manusaYadnya').click(function(){
            jenisYadnya =  $("#manusaYadnya").val();
            $("#jenis_yadnya").val(jenisYadnya);
            getJenisYadnya(jenisYadnya);
        })
        $('#bhutaYadnya').click(function(){
            jenisYadnya =  $("#bhutaYadnya").val();
            $("#jenis_yadnya").val(jenisYadnya);
            getJenisYadnya(jenisYadnya);
        })
    </script>
    <!-- Get Data Jenis Yadnya -->

    <!-- Maps Pemetaan  -->
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            //--------------START Deklarasi awal seperti icon pembuatan map-------------//
           var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 10);
           L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
               attribution: 'Maps E-Yajamana',
               maxZoom: 18,
               minZoom: 9,
               id: 'mapbox/streets-v11',
               tileSize: 512,
               zoomOffset: -1,
               accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
           }).addTo(mymap);
           document.getElementById("modalMap").onclick = function () {
               document.getElementById('modal-xl').style.display = 'block';
               setTimeout(function() {
                   mymap.invalidateSize();
               }, 100);
           }
           var curLocation = [0, 0];
           if (curLocation[0] == 0 && curLocation[1] == 0) {
               curLocation = [-8.4517916, 115.1970086];
           }
           var marker = new L.marker(curLocation, {
               draggable: 'true'
           });
           marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                marker.setLatLng(position, {
                draggable: 'true'
                }).bindPopup(position).update();
                $("#lat").val(position.lat);
                $("#lng").val(position.lng).keyup();
                $("#view_lat").val(position.lat);
                $("#view_lng").val(position.lng);
           });
           $("#Latitude, #Longitude").change(function() {
               var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
               marker.setLatLng(position, {
               draggable: 'true'
               }).bindPopup(position).update();
               mymap.panTo(position);
           });
           mymap.addLayer(marker);
       })
    </script>
    <!-- Maps Pemetaan  -->
@endpush
