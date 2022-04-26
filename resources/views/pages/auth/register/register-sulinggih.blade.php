@extends('pages.auth.layout.master')
@section('tittle','Register Akun Sulinggih')

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

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
@endpush

@section('content')

    <div class="container d-flex justify-content-center pt-4">
        <div class="card card-primary w-75">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('base-template/dist/img/logo-01.png') }}" alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h4 fw-bold mb-1">E-Yajamana</a>
                <p class="mt-1 fs-5 mb-1">Form Pendaftaran Akun Sulinggih </p>
                <p class="text-center mb-2">Silahkan lengkapi data di bawah ini</p>
            </div>
            <div class="card-body">
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                        <div class="step" data-target="#logins-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">NIK</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#information-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Data User</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#next-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="next-part"
                            id="next-part-trigger">
                            <span class="bs-stepper-circle">3</span>
                            <span class="bs-stepper-label">Data Sulinggih</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <form method="POST" action="{{route('auth.register.akun.sulinggih.store')}}" enctype="multipart/form-data" id="formRegister">
                            @csrf
                            <input value="" name="id_user"  id="id_user" type="hidden" class="d-none"  value="{{ old('id_user') }}">
                            <input id="id_penduduk" name="id_penduduk" type="hidden" class="d-none" value="{{ old('id_penduduk') }}" >
                            <!-- STEPPER 1 PILIH YADNYA -->
                            <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                <div class="divider"></div>
                                <div class="container p-1 mt-2">
                                    <div class="form-group">
                                        <label>NIK <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" oninput='if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' maxlength='16' id="nik" name="nik" autocomplete="off" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="Masukan NIK">
                                            <div class="input-group-append">
                                                <button onclick="cekNIK()" type="button" class="btn btn-sm btn-default">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <p class="m-1 text-sm">(Apabila NIK tidak ditemukan, Lakukan Pendataan terlebih dahulu <a href="">disini)</a></p>
                                    </div>
                                    <div class="form-group mt-lg-4 mb-0" id="buttonFormNIK">
                                    </div>
                                </div>
                            </div>
                            <!-- STEPPER 1 PILIH YADNYA -->

                            <!-- STEPPER 2 DATA USER -->
                            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                <div class="container p-1 mt-2">
                                    <div class="form-group">
                                        <label>Nomor Telepon <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" oninput='if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' maxlength='14' id="nomor_telepon" name="nomor_telepon" autocomplete="off" class="form-control @error('nomor_telepon') is-invalid @enderror" value="{{ old('nomor_telepon') }}" placeholder="Masukan Nomor Telepon">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone-alt"></span>
                                                </div>
                                            </div>
                                            @error('nomor_telepon')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('nomor_telepon') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="email" id="email" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan E-mail">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('email') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="akunPassword" class="">
                                        <div class="form-group">
                                            <label>Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password" id="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Masukan Password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback text-start">
                                                        {{$errors->first('password') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Konfirmasi Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Masukan Konfirmasi Password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback text-start">
                                                        {{$errors->first('password_confirmation') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-lg-4 mb-0">
                                        <button type="button" class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                        <button onclick="step3()" type="button" class="btn btn-primary float-sm-right">Selanjutnya</button>
                                    </div>
                                </div>
                            </div>
                            <!-- STEPPER 2 DATA USER -->

                            <!-- STEPPER 3 DATA SULINGGIH -->
                            <div id="next-part" class="content" role="tabpanel" aria-labelledby="next-part-trigger">
                                <div class="container p-1 mt-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Nama Walaka <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="nama_walaka" name="nama_walaka" autocomplete="off" class="form-control @error('nama_walaka') is-invalid @enderror" value="{{ old('nama_walaka') }}" placeholder="Masukan Nama Walaka">
                                                    @error('nama_walaka')
                                                        <div class="invalid-feedback text-start">
                                                            {{$errors->first('nama_walaka') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Nama Sulinggih <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="nama_pemuput" name="nama_pemuput" autocomplete="off" class="form-control @error('nama_pemuput') is-invalid @enderror" value="{{ old('nama_pemuput') }}" placeholder="Masukan Nama Sulinggih">
                                                    @error('nama_pemuput')
                                                        <div class="invalid-feedback text-start">
                                                            {{$errors->first('nama_pemuput') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="rowPasangan">
                                        <div class="form-group col-12" id="formPasangan">
                                            <label>Pasangan Sulinggih <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select name="id_pasangan" id="pasangan" class=" select2bs4 pasangan @error('id_pasangan') is-invalid @enderror" style="width: 100%;" value="{{old('pasangan')}}">
                                                    <option value="0" disabled selected>Pilih Pasangan Sulinggih</option>
                                                    <option value="0" >Pasangan belum terdaftar pada sistem</option>
                                                    @foreach ($dataSulinggih as $data)
                                                        <option value="{{$data->id}}" >{{$data->nama_pemuput}}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_pasangan')
                                                    <div class="invalid-feedback text-start">
                                                        {{$errors->first('id_pasangan') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="" id="atributPemuput">
                                        <div class="row" id="rowNabe">
                                            <div class="form-group  col-12" id="formNabe">
                                                <label>Nabe <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="id_nabe" id="nabe" class="select2bs4 nabe @error('id_nabe') is-invalid @enderror" style="width: 100%;" value="{{old('id_nabe')}}">
                                                        <option value="0" disabled selected>Pilih Nabe</option>
                                                        <option value="0" >Nabe belum terdaftar pada sistem</option>
                                                        @foreach ($dataSulinggih as $data)
                                                            <option value="{{$data->id}}" >{{$data->nama_pemuput}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_nabe')
                                                        <div class="invalid-feedback text-start">
                                                            {{$errors->first('id_nabe') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Diksa <span class="text-danger">*</span></label>
                                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input name="tanggal_diksha" id="demo" type='text' class='form-control float-right' value="{{old('tanggal_diksha')}}">
                                                @error('tanggal_diksha')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $errors->first('tanggal_diksha') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lampiran SK Kesulinggihan <span class="text-danger">*</span></label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="customFile" value="{{old('file')}}">
                                                    <label class="custom-file-label " for="customFile">@if (old('file')!= null) {{old('file')}} @endif Foto SK Kesulinggihan</label>
                                                </div>
                                            </div>
                                            @error('file')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('file') }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi Griya <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select name="id_griya" id="lokasi_griya" class="select2bs4 lokasi_griya @error('id_griya') is-invalid @enderror" style="width: 100%;" value="{{old('id_griya')}}">
                                                    <option value="0" disabled selected>Pilih Lokasi Griya</option>
                                                    <option value="">Input Lokasi Griya Lainnya..</option>
                                                    @foreach ($dataGriya as $data)
                                                        <option value="{{$data->id}}" >{{$data->nama_griya_rumah}}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_griya')
                                                    <div class="invalid-feedback text-start">
                                                        {{$errors->first('id_griya') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div id="formGriya"  @if (old('nama_griya') != null) class="" @else class="d-none"  @endif >
                                        <div class="card-header"></div>
                                        <div class="card-body px-0">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Nama Griya <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" id="nama_griya" name="nama_griya" autocomplete="off" class="form-control @error('nama_griya') is-invalid @enderror" value="{{ old('nama_griya') }}" placeholder="Masukan Nama Griya">
                                                            @error('nama_griya')
                                                                <div class="invalid-feedback text-start">{{$errors->first('nama_griya') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Alamat Lengkap Griya <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" id="alamat_griya" name="alamat_griya" autocomplete="off" class="form-control @error('alamat_griya') is-invalid @enderror" value="{{ old('alamat_griya') }}" placeholder="Masukan Alamat Lengkap Griya">
                                                            @error('alamat_griya')
                                                                <div class="invalid-feedback text-start">{{$errors->first('alamat_griya') }} </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                                                        <select name="kabupaten" id="kabupaten" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;" value="{{old('kabupaten')}}">
                                                            <option value="0" disabled selected>Pilih Kabupaten</option>
                                                            @foreach ($dataKabupaten as $data)
                                                                <option value="{{$data->id}}">{{$data->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('kabupaten')
                                                        <div class="invalid-feedback text-start">{{$errors->first('kabupaten') }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group"><label>Kecamatan <span class="text-danger">*</span></label>
                                                        <select id="kecamatan" class="form-control select2bs4 @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                                            <option value="0" disabled selected>Pilih Kecamatan</option>
                                                        </select>
                                                        <p class="m-1 text-xs">(Pilih Kabupaten terlebih dahulu)</p>
                                                        @error('kecamatan')
                                                            <div class="invalid-feedback text-start">{{$errors->first('kecamatan') }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Desa Dinas<span class="text-danger">*</span></label>
                                                        <select id="desa_dinas" name="id_desa" class="form-control select2bs4 @error('id_desa') is-invalid @enderror" style="width: 100%;">
                                                            <option value="0" disabled selected>Pilih Desa Dinas</option>
                                                        </select>
                                                        <p class="m-1 text-xs">(Pilih Kecamatan terlebih dahulu)</p>
                                                        @error('id_desa')
                                                            <div class="invalid-feedback text-start">{{$errors->first('id_desa') }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Banjar Dinas <span class="text-danger">*</span></label>
                                                        <select id="id_banjar_dinas" name="id_banjar_dinas" class="form-control select2bs4 @error('id_banjar_dinas') is-invalid @enderror" style="width: 100%;">
                                                            <option value="0" disabled selected>Pilih Banjar Dinas</option>
                                                        </select>
                                                        <p class="m-1 text-xs">(Pilih Desa Dinas terlebih dahulu)</p>
                                                        @error('id_banjar_dinas')
                                                            <div class="invalid-feedback text-start">{{$errors->first('id_banjar_dinas') }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group"><label>Pemetaan Lokasi Griya <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input readonly="readonly" type="text" id="lat" name="lat" autocomplete="off" class="form-control col-6 @error('lat') is-invalid @enderror" value="{{ old('lat') }}" placeholder="Latitude">
                                                            <input readonly="readonly" type="text" id="lng" name="lng" autocomplete="off" class="form-control col-6 @error('lng') is-invalid @enderror" value="{{ old('lng') }}" placeholder="Longtitude">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" id="modalMap" data-target="#modal-xl"><i class="fa fa-map-marked"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 mt-4">
                                        <button type="button" class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                        <button type="submit" class="btn btn-primary float-sm-right">Buat Akun</button>
                                    </div>
                                </div>
                            </div>
                            <!-- STEPPER 3 DATA SULINGGIH -->
                        </form>
                    </div>
                </div>

            </div>
            <div class="card-footer text-center">
                <a href="" class="nav-link link-dark">E-Yajamana 2021 | All Right Reserved © </a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-xl">
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
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Simpan Pemetaan Lokasi</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- BS-Stepper -->
    <script src="{{asset('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>

    <!-- jquery-validation -->
    <script src="{{asset('base-template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/jquery-validation/additional-methods.min.js')}}"></script>

    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script src="{{asset('base-template/dist/js/pages/ajax-get-wilayah.js')}}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        $(function () {
            bsCustomFileInput.init();
        });

        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#demo').daterangepicker({
            "singleDatePicker": true,
            "drops": "up",
            "minDate": "01 January 1800",
            "maxDate": moment(Date ()).format('DD MMMM YYYY'),
            locale: {
                format: 'DD MMMM YYYY',
            },
        });

    </script>

@endpush

@push('js')
    <script>
        function setDataAkun(data,status){
            console.log(status)
            $('#nomor_telepon').val(data.nomor_telepon);
            $('#email').val(data.email);
            $("#email").prop('disabled', status);
            $("#nomor_telepon").prop('disabled', status);
            $("#password").prop('disabled', status);
            $("#password_confirmation").prop('disabled', status);
            if(status != true){
                $("#akunPassword").empty()
                $("#akunPassword").append(
                   '<div class="form-group"><label>Password <span class="text-danger">*</span></label><div class="input-group"><input type="password" id="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Masukan Password"> <div class="input-group-append"><div class="input-group-text"> <span class="fas fa-lock"></span></div></div>@error('password')<div class="invalid-feedback text-start"> {{$errors->first('password') }} </div>@enderror </div></div><div class="form-group"><label>Konfirmasi Password <span class="text-danger">*</span></label><div class="input-group"> <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Masukan Konfirmasi Password"><div class="input-group-append"><div class="input-group-text"> <span class="fas fa-lock"></span></div> </div>@error('password_confirmation') <div class="invalid-feedback text-start">{{$errors->first('password_confirmation') }} </div>@enderror</div></div>'
                );
            }else{
                $("#akunPassword").empty();
            }
        }
        // FUNGSI CEK NIK PADA SISTEM
        function cekNIK(){
            let nik = $("#nik").val();
            if(nik == ''){
                nik = 0
            }
            $.ajax({
                url: '{{route('ajax.get.data-penduduk')}}/' + nik,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.data.user != null) {
                        setDataAkun(response.data.user,true)
                        $("#id_user").val(response.data.user.id)
                    }else{
                        $("#id_penduduk").val(response.data.id)
                        setDataAkun('',false)
                    }
                    $('#buttonFormNIK').empty();
                    $('#buttonFormNIK').append('<button id="submitToRangkuman" onclick="stepper.next()" type="button" class="btn btn-primary float-sm-right">Selanjutnya</button>')
                    Swal.fire({
                        icon: response.icon,
                        title: response.title,
                        text: response.message,
                    });
                },
                error: function(response, error){
                    console.log(response)
                    $('#buttonFormNIK').empty()
                    Swal.fire({
                        icon: response.responseJSON.icon,
                        title: response.responseJSON.title,
                        text: response.responseJSON.message,
                        // footer:'<a href="'+response.responseJSON.footer+'">Lakukan Pendataan telebih dahulu disini</a>'
                    })
                }
            })
        }
        // FUNGSI CEK NIK PADA SISTEM

        // KEYUP FORM INPUT NIK
        $('#nik').on('keyup', function () {
            $('#buttonFormNIK').empty()
        })
        // KEYUP FORM INPUT NIK

        $("#lokasi_griya").on('change',function(){
            var value = $(this).val();
            console.log(pasangan)
            if(value == null || value == ""){
                $("#formGriya").removeClass('d-none')
            }else{
                $("#formGriya").addClass('d-none');
                $("#nama_griya").val();
                $("#id_banjar_dinas").val();
            }
        })

        $("#pasangan").on('change',function(){
            var value = $(this).val();
            console.log(value)
            if(value != 0 || value == ""){
                $("#atributPemuput").addClass('d-none');
            }else{
                $("#atributPemuput").removeClass('d-none');
            }
        })




    </script>
@endpush

{{-- SET UP FORM INPUT REGISTER --}}
@push('js')
    <script>
        $(document).ready(function() {
            //--------------START Deklarasi awal seperti icon pembuatan map-------------//
            var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 9);

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
                }, 10);
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
@endpush
{{-- SET UP FORM INPUT REGISTER --}}

{{-- VALIDASI FORM INPUT --}}
@push('js')
    <script>
        // VALIDASI FORM INPUT DATA
        $('#formRegister').validate({
            rules: {
                email: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 3
                },
                password_confirmation: {
                    required: true,
                    minlength: 3
                },
                nomor_telepon: {
                    required: true,
                    minlength: 12
                },
            },
            messages: {
                email: {
                    required: "Email Wajib diisi",
                },
                password: {
                    required: "Password Wajib diisi",
                    minlength: "Password minimal diisi dengan 3 karakter"
                },
                nomor_telepon: {
                    required: "Nomor Telepon Wajib diisi",
                    minlength:"Nomor Telepon minimal diisi dengan 12 karakter"
                },
                password_confirmation: {
                    required: "Password Konfirmasi Wajib diisi",
                    minlength:"Password Konfirmasi minimal diisi dengan 3 karakter"
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
        // VALIDASI FORM INPUT DATA

        function step3(){
            var form = $("#formRegister");
            if(form.valid()==true){
                stepper.next();
                $(".form-control").each(function () {
                    $(this).rules('add', {
                        required: true,
                        messages: {
                            required: "Kolom Wajib diisi"
                        }
                    });
                });
            }
        }
    </script>
@endpush
{{-- VALIDASI FORM INPUT --}}





