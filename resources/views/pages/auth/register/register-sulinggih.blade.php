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
                <form action="{{route('auth.register.akun.sulinggih.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row px-lg-4">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nama Walaka<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama_walaka" autocomplete="off" class="form-control @error('nama_walaka') is-invalid @enderror" value="{{ old('nama_walaka') }}" placeholder="Masukan Nama Walaka">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('nama_walaka')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('nama_walaka') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Sulinggih<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama_sulinggih" autocomplete="off" class="form-control @error('nama_sulinggih') is-invalid @enderror" value="{{ old('nama_sulinggih') }}" placeholder="Masukan Nama Sulinggih">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('nama_sulinggih')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('nama_sulinggih') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Pasangan<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama_pasangan" autocomplete="off" class="form-control @error('nama_pasangan') is-invalid @enderror" value="{{ old('nama_pasangan') }}" placeholder="Masukan Nama Pasangan">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('nama_pasangan')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('nama_pasangan') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nabe</label>
                                <div class="input-group mb-3">
                                    <select name="nabe" class="form-control select2bs4  @error('nabe') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                        <option disabled selected value="Bali">Pilih Nabe Sulinggih</option>
                                        @foreach ($dataSulinggih as $data)
                                            <option value="{{$data->id}}">{{$data->nama_sulinggih}}</option>
                                        @endforeach
                                        <option value="0">Nabe Belum Terdaftar diSistem</option>
                                    </select>
                                    @error('nabe')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('nabe') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Diksha <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="date" name="tanggal_diksha" id="tangalLahir" autocomplete="off" class="form-control @error('tanggal_diksha') is-invalid @enderror" value="{{ old('tanggal_diksha') }}" placeholder="dd-mm-yyyy" placeholder="dd-mm-yyyy" value=""min="1997-01-01" max="2030-12-31">
                                    @error('tanggal_diksha')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('tanggal_diksha') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <label>Pendidikan <span class="text-danger">*</span></label>
                                    <select id="pendidikan" name="pendidikan" class="form-control select2bs4 kabupaten @error('pendidikan') is-invalid @enderror" style="width: 100%;">
                                        @php
                                            $pendidikan = old('pendidikan')
                                        @endphp
                                        <option value="0" disabled selected>Pilih Pendidikan Terakhir</option>
                                        <option @if ($pendidikan=='SD') selected @endif value="SD">SD</option>
                                        <option @if ($pendidikan=='SMP') selected @endif value="SMP">SMP</option>
                                        <option @if ($pendidikan=='SMA/SMK') selected @endif value="SMA/SMK">SMA/SMK</option>
                                        <option @if ($pendidikan=='SARJANA') selected @endif value="SARJANA">SARJANA</option>
                                        <option @if ($pendidikan=='MAGISTER') selected @endif value="MAGISTER">MAGISTER</option>
                                        <option @if ($pendidikan=='Doktor') selected @endif value="Doktor">DOKTOR</option>
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
                                    <input type="text" name="pekerjaan" autocomplete="off" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}" placeholder="Masukan Pekerjaan Sulinggih">
                                    @error('pekerjaan')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('pekerjaan') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <label>Lokasi Griya <span class="text-danger">*</span></label>
                                    <select id="lokasiGriya" name="lokasi_griya" class="form-control select2bs4 kabupaten @error('lokasi_griya') is-invalid @enderror" style="width: 100%;">
                                    </select>
                                    <div class="text-start h6 ml-2 mt-1">
                                        <p><a type="button" data-toggle="modal" data-target="#exampleModal" class="">Tambah Lokasi Griya</a></p>
                                    </div>
                                    @error('lokasi_griya')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('lokasi_griya') }}
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
                                    <select id="tempat_lahir" name="tempat_lahir" class="form-control select2bs4 kabupaten @error('tempat_lahir') is-invalid @enderror" style="width: 100%;">
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
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" name="nama" autocomplete="off" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" placeholder="dd-mm-yyyy" placeholder="dd-mm-yyyy" value=""min="1997-01-01" max="2030-12-31">
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
                                    <select name="jenis_kelamin" value="{{ old('jenis_kelamin') }}"  class="form-control select2bs4 @error('jenis_kelamin') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                        <option disabled selected value="Bali">Pilih Jenis Kelamin</option>
                                        @php
                                            $genre = old('jenis_kelamin')
                                        @endphp
                                        <option @if ($genre=='laki-laki') selected @endif value="laki-laki">Laki-Laki</option>
                                        <option @if ($genre=='perempuan') selected @endif value="perempuan">Perempuan</option>
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
                                        <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="customFile">
                                        <label class="custom-file-label " for="customFile">Foto Kegiatan Upacara</label>
                                    </div>
                                </div>
                                @error('file')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('file') }}
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
                            <button type="submit" class="btn btn-primary btn-block">Buat Akun</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="text-center my-2">
                <a href="" class="nav-link link-dark">E-Yajamana 2021 | All Right Reserved &copy </a>
            </div>
        </div>
    </div>

    {{--  MODAL ADD GRIYA BARU--}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Lokasi Griya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Griya <span class="text-danger">*</span></label>
                            <input id="nama_griya" type="text" name="nama_griya" class="form-control @error('nama_griya') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Griya" value="{{old('nama_griya')}}">
                            @error('nama_griya')
                                <div class="invalid-feedback text-start">
                                    {{ $errors->first('nama_griya') }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                                    <select name="kabupaten" id="kabupaten" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;" value="{{old('kabupaten')}}">
                                        <option value="0" disabled selected>Pilih Kabupaten</option>
                                        @foreach ($dataKabupaten->where('id_provinsi',51) as $data)
                                            <option value="{{$data->id_kabupaten}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('kabupaten')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('kabupaten') }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Kecamatan <span class="text-danger">*</span></label>
                                        <select id="kecamatan" class="form-control select2bs4 @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                            <option value="0" disabled selected>Pilih Kecamatan</option>
                                        </select>
                                        @error('kecamatan')
                                            <div class="invalid-feedback text-start">
                                                {{$errors->first('kecamatan') }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Desa Dinas<span class="text-danger">*</span></label>
                                    <select id="desa_dinas" name="id_desa" class="form-control select2bs4 @error('id_desa') is-invalid @enderror" style="width: 100%;">
                                        <option value="0" disabled selected>Pilih Desa Dinas</option>
                                    </select>
                                    @error('id_desa')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('id_desa') }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Desa Adat <span class="text-danger">*</span></label>
                                    <select id="id_desa_adat" name="id_desa_adat" class="form-control select2bs4 @error('id_desa_adat') is-invalid @enderror" style="width: 100%;">
                                        <option value="0" disabled selected>Pilih Desa Adat</option>
                                        @foreach ($dataDesaAdat as $data)
                                            <option value="{{$data->desadat_id}}">{{$data->desadat_nama}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_desa_adat')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('desa_adat') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat Lengkap Griya <span class="text-danger">*</span></label>
                            <textarea name="alamat_griya" id="alamat_griya" class="form-control  @error('alamat_griya') is-invalid @enderror" rows="3" placeholder="Masukan Alamat Lengkap Griya" value="{{ old('alamat_griya') }}" ></textarea>
                            @error('alamat_griya')
                                <div class="invalid-feedback text-start">
                                    {{$errors->first('alamat_griya') }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Pemetaan Lokasi Griya</label>
                            <div class="input-group mb-3">
                                <input name="lat" id="lat" type="text" aria-label="First name" class="form-control mr-1 @error('lat') is-invalid @enderror" placeholder="Lat" readonly="readonly" value="{{old('lat')}}">
                                @error('lat')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('lat') }}
                                    </div>
                                @enderror
                                <input name="lng" id="lng" type="text" aria-label="Last name" class="form-control ml1" placeholder="Lang  @error('lng') is-invalid @enderror" readonly="readonly" value="{{old('lng')}}">
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" onclick="addDataGriya()" data-dismiss="modal" class="btn btn-primary">Send message</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="modal-xl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pemetaan Maps E-Yajamana</h4>
                    <button type="button" style="" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="gmaps" style="height: 350px;"></div>
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

    <script type="text/javascript">

        function addDataGriya()
        {
            let nama_griya = $('#nama_griya').val();
            let id_desa = $('#desa_dinas').val();
            let id_desa_adat = $('#id_desa_adat').val();
            let alamat_griya = $('#alamat_griya').val();
            let lat = $('#lat').val();
            let lng = $('#lng').val();

            $.ajax({
                type:'POST',
                url:"{{ route('ajax.post') }}",
                data:{
                    nama_griya:nama_griya,
                    id_desa:id_desa,
                    id_desa_adat:id_desa_adat,
                    alamat_griya:alamat_griya,
                    lat:lat,
                    lng:lng,
                    "_token":"{{ csrf_token() }}"
                },
                success:function(response){
                    console.log(response);

                    $('#lokasiGriya').append('<option value="'+response.data.id +'">' + response.data.nama_griya_rumah+ '</option>');
                }
            });
        }

        $.ajax({
            type:'GET',
            url:"{{ route('ajax.get') }}",
            dataType : "json",
            success : function(response) {
                console.log(response);
                $('#lokasiGriya').empty();
                $('#lokasiGriya').append('<option value="0" disabled selected>Pilih Lokasi Griya</option>');
                $.each(response.data, function(key, data){
                    $('#lokasiGriya').append('<option value="'+ data.id +'">' + data.nama_griya_rumah+ '</option>');
                })
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

    <!-- Fungsi Ajax Get Data  -->
    <script language="javascript" type="text/javascript">
        $('#kabupaten').on('change', function() {
            var kabupatenID = $(this).val();
            if(kabupatenID){
                $.ajax({
                       url: '/ajax/kecamatan/'+kabupatenID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(dataKecamatan)
                        {
                            console.log(kabupatenID);
                            console.log(dataKecamatan.data.kecamatans);

                            if(dataKecamatan.data.kecamatans){
                                $('#kecamatan').empty();
                                $('#kecamatan').append('<option value="0" disabled selected>Pilih Kecamatan</option>');
                                $.each(dataKecamatan.data.kecamatans, function(key, data){
                                    $('#kecamatan').append('<option value="'+ data.id_kecamatan +'">' + data.name+ '</option>');
                                });
                            }else{
                                $('#course').empty();
                            }
                        }
                    })
            }else{
                $('#course').empty();
            }
        })

        $('#kecamatan').on('change', function() {
            var kecamatanID = $(this).val();
            if(kecamatanID){
                $.ajax({
                       url: '/ajax/desa/'+kecamatanID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(dataDesa)
                        {
                            console.log(kecamatanID);
                            console.log(dataDesa.data.desas);

                            if(dataDesa.data.desas){
                                $('#desa_dinas').empty();
                                $('#desa_dinas').append('<option value="0" disabled selected>Pilih Desa Dinas</option>');
                                $.each(dataDesa.data.desas, function(key, data){
                                    $('#desa_dinas').append('<option value="'+ data.id_desa +'">' + data.name+ '</option>');
                                });
                            }else{
                                $('#course').empty();
                            }
                        }
                    })
            }else{
                $('#course').empty();
            }
        })
    </script>
    <!-- Fungsi Ajax Get Data  -->

@endpush
