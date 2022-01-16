@extends('pages.auth.layout.master')
@section('tittle','Register Akun Sulinggih')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

@endpush

@section('content')
    <div class="container justify-content-center pt-4">
        <div class="card card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('base-template/dist/img/logo-01.png') }}" alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h4 fw-bold mb-1">E-Yajamana</a>
                <p class="mt-1 fs-5 mb-1">Form Pendaftaran Akun Krama Bali </p>
                <p class="text-center mb-2">Silahkan lengkapi data di bawah ini</p>

            </div>
            <div class="card-body">
                <form action="{{route('auth.register.akun.krama.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input hidden value="{{$role}}" name="role">
                    <div class="row px-lg-4">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nama Walaka<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama" autocomplete="off" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan Nama lengkap">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('nama')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('nama') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Sulinggih<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama" autocomplete="off" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan Nama lengkap">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('nama')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('nama') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Pasangan<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama" autocomplete="off" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan Nama lengkap">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('nama')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('nama') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <label>Nabe <span class="text-danger">*</span></label>
                                    <select id="nabe" name="pendidikan" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;">
                                        <option value="0" disabled selected>Pilih Nabe Sulinggih</option>
                                        <option value="0">wayan Nabe ni</option>
                                        <option value="">
                                            <button id="addDataGriya" class="btn btn-light"> <i class="fa fa-plus"></i> Tambah Data Nabe</button>
                                        </option>
                                    </select>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('tempat_lahir') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Diksha <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="date" name="tanggal_lahir" id="tangalLahir" name="nama" autocomplete="off" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" placeholder="dd-mm-yyyy" placeholder="dd-mm-yyyy" value=""min="1997-01-01" max="2030-12-31">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('tanggal_lahir') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <label>Pendidikan <span class="text-danger">*</span></label>
                                    <select id="pendidikan" name="pendidikan" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;">
                                        <option value="0" disabled selected>Pilih Pendidikan Terakhir</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA/SMK">SMA/SMK</option>
                                        <option value="SARJANA">SARJANA</option>
                                        <option value="MAGISTER">MAGISTER</option>
                                        <option value="Doktor">DOKTOR</option>
                                    </select>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('tempat_lahir') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pekerjaan<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama" autocomplete="off" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan Nama lengkap">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('nama')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('nama') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <label>Lokasi Griya <span class="text-danger">*</span></label>
                                    <select id="12313asdsa" name="tempat_lahir" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;">
                                        <option value="0" disabled selected>Pilih Lokasi Tempat Lahir</option>
                                        <option value="0" >Griya Anan Tangke</option>
                                        {{-- @foreach ($dataKabupaten as $data)
                                            <option value="{{$data->name}}">{{$data->name}}</option>
                                        @endforeach --}}
                                        <option value="">
                                            <i class="fa fa-plus"></i>
                                            <button id="addDataGriya" class="btn btn-light">  Tambah Data Griya Baru...</button>
                                        </option>
                                    </select>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('tempat_lahir') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>E-Mail <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="email" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan E-Mail">
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

                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password">
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
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Masukan Kembali Password">
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

                            <div class="form-group">
                                <label>Nomor HP <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="number" name="nomor_telepon" autocomplete="off" class="form-control @error('nomor_telepon') is-invalid @enderror" value="{{ old('nomor_telepon') }}" placeholder="Masukan Nomor HP">
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
                                <div class="input-group mb-3">
                                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                                    <select id="tempat_lahir" name="tempat_lahir" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;">
                                        <option value="0" disabled selected>Pilih Lokasi Tempat Lahir</option>
                                        @foreach ($dataKabupaten as $data)
                                            <option value="{{$data->name}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('tempat_lahir') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="date" name="tanggal_lahir" id="tangalLahir" name="nama" autocomplete="off" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" placeholder="dd-mm-yyyy" placeholder="dd-mm-yyyy" value=""min="1997-01-01" max="2030-12-31">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('tanggal_lahir') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <select name="jenis_kelamin" class="form-control select2bs4  @error('jenis_kelamin') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                        <option disabled selected value="Bali">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki">Laki-Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('jenis_kelamin') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Lampiran SK Kesulinggihan</label>
                                <div class="input-group mb-2">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('foto_upacara') is-invalid @enderror" name="foto_upacara" id="customFile">
                                        <label class="custom-file-label " for="customFile">Foto Kegiatan Upacara</label>
                                    </div>
                                </div>
                                @error('foto_upacara')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('foto_upacara') }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                    </div>
                    <div class="row d-flex justify-content-end mt-1 p-lg-4">
                        <div class="col-5 col-sm-8">
                            <p> Sudah memiliki akun? Klik
                                <a href="{{route('auth.login')}}" class="text-decoration-none link-primary">di sini</a>
                            </p>
                        </div>
                        <div class="col-7 col-sm-4">
                            <button type="submit" class="btn btn-primary btn-block">Daftarkan Akun</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="text-center my-2">
                <a href="" class="nav-link link-dark">E-Yajamana 2021 | All Right Reserved &copy </a>
            </div>
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
                    <div id="gmaps" style="height: 600px"></div>
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
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>

    <script>
        $(document).ready(function() {
            document.getElementById("modalMap").onclick = function () {
                alert('risamwan');
            }
        });
    </script>

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
            // use below if you have a model
            // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

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
    <!-- Maps Pemetaan  -->

    <!-- Fungsi Form Input  -->
    <script type="text/javascript">
        $('#mySelect2').select2('data');

        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-upacara').addClass('active');
        });

        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $(function () {
            bsCustomFileInput.init();
        });

    </script>
    <!-- Fungsi Form Input  -->

@endpush
