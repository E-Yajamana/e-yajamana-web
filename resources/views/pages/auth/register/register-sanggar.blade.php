@extends('pages.auth.layout.master')
@section('tittle','Register Akun Pemangku')

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
                <p class="mt-1 fs-5 mb-1">Form Pendaftaran Akun Sanggar </p>
                <p class="text-center mb-2">Silahkan lengkapi data di bawah ini..</p>
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
                            <span class="bs-stepper-label">Data Sanggar</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <form method="POST" action="{{route('auth.register.akun.sanggar.store')}}" enctype="multipart/form-data" id="formRegister">
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
                                        <button onclick="submitData()" type="button" class="btn btn-primary float-sm-right">Selanjutnya</button>
                                    </div>
                                </div>
                            </div>
                            <!-- STEPPER 2 DATA USER -->

                            <!-- STEPPER 3 DATA SULINGGIH -->
                            <div id="next-part" class="content" role="tabpanel" aria-labelledby="next-part-trigger">
                                <div class="container p-1 mt-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Nama Sanggar <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="nama_sanggar" name="nama_sanggar" autocomplete="off" class="form-control @error('nama_sanggar') is-invalid @enderror" value="{{ old('nama_sanggar') }}" placeholder="Masukan Nama Sanggar">
                                                    @error('nama_sanggar')
                                                        <div class="invalid-feedback text-start">
                                                            {{$errors->first('nama_sanggar') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Logo Sanggar</label>
                                                <div class="input-group mb-2">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="profile" id="customFile" value="{{old('profile')}}">
                                                        <label class="custom-file-label " for="customFile">@if (old('profile')!= null) {{old('profile')}} @endif Logo Sanggar</label>
                                                    </div>
                                                </div>
                                                @error('file')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $errors->first('file') }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Lampiran SK Tanda Usaha <span class="text-danger">*</span></label>
                                                <div class="input-group mb-2">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="customFile" value="{{old('file')}}">
                                                        <label class="custom-file-label " for="customFile">@if (old('file')!= null) {{old('file')}} @endif Foto SK Tanda Usaha</label>
                                                    </div>
                                                </div>
                                                @error('file')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $errors->first('file') }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat Lengkap Sanggar <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="alamat_sanggar" name="alamat_sanggar" autocomplete="off" class="form-control @error('alamat_sanggar') is-invalid @enderror" value="{{ old('alamat_sanggar') }}" placeholder="Masukan Alamat Lengkap Sanggar">
                                                    @error('alamat_sanggar')
                                                        <div class="invalid-feedback text-start">{{$errors->first('alamat_sanggar') }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Provinsi <span class="text-danger">*</span></label>
                                                <select name="provinsi" id="provinsi" class=" select2bs4 provinsi @error('provinsi') is-invalid @enderror" style="width: 100%;" value="{{old('provinsi')}}">
                                                    <option value="0" disabled selected>BALI</option>
                                                </select>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row">
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
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group"><label>Pemetaan Lokasi Sanggar<span class="text-danger">*</span></label>
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
            console.log(data)
            if(data != ''){
                $('#nomor_telepon').val(data.user.nomor_telepon);
                $('#email').val(data.user.email);
            }else{
                $('#nomor_telepon').val('');
                $('#email').val('');
            }

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
                    if(response.role.includes(3)){
                        Swal.fire({
                            icon: 'warning',
                            title: 'Pemberitahuan',
                            text: 'Anda tidak dapat mendaftar kembali, sistem mendeteksi anda sudah mempunyai akun dengan email : '+ response.data.user.email,
                            footer:  '<a href="{{route('auth.login')}}">Halaman Login Sistem...!!</a>'
                        });
                    }else{
                        if (response.data.user != null) {
                            setDataAkun(response.data,true)
                            $("#id_user").val(response.data.user.id)
                        }else{
                            $("#id_penduduk").val(response.data.id)
                            $("#id_user").val('')
                            setDataAkun('',false)
                        }
                        $("#nama_walaka").prop('disabled', true);
                        $('#nama_walaka').val(response.data.nama_alias);
                        $('#buttonFormNIK').empty();
                        $('#buttonFormNIK').append('<button id="submitToRangkuman" onclick="stepper.next()" type="button" class="btn btn-primary float-sm-right">Selanjutnya</button>')
                        Swal.fire({
                            icon: response.icon,
                            title: response.title,
                            text: response.message,
                        });
                    }
                },
                error: function(response, error){
                    console.log(response)
                    $('#buttonFormNIK').empty()
                    console.log(response.responseJSON.link)
                    Swal.fire({
                        icon: response.responseJSON.icon,
                        title: response.responseJSON.title,
                        text: response.responseJSON.message,
                        footer: response.responseJSON.footer
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
        // VALIDASI FORM 2
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
        // VALIDASI FORM 2

        // VALIDASI FORM 3
        function submitData(){
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
        // VALIDASI FORM 3

    </script>
@endpush
{{-- VALIDASI FORM INPUT --}}





