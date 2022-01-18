@extends('pages.auth.layout.master')
@section('tittle','Register AkunKrama')

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
                <form action="{{route('auth.register.akun.krama')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row px-lg-4">
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
                                    @error('kondisi')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('kondisi') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nomor HP <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="number" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan Nomor HP">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone-alt"></span>
                                        </div>
                                    </div>
                                    @error('kondisi')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('kondisi') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama" autocomplete="off" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan Nama lengkap">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('kondisi')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('kondisi') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                                    <select id="tempat_lahir" name="tempat_lahir" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;">
                                        <option value="0" disabled selected>Pilih Lokasi Tempat Lahir</option>
                                        @php
                                            $kabupaten = old('tempat_lahir')
                                        @endphp
                                        @foreach ($dataKabupaten as $data)
                                            @if ($kabupaten == $data->name)
                                                <option value="{{$data->name}}" selected>{{$data->name}}</option>
                                            @else
                                                <option value="{{$data->name}}">{{$data->name}}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                    @error('kondisi')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('kondisi') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="date" name="nama" autocomplete="off" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan Nama lengkap">
                                    @error('kondisi')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('kondisi') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <select name="jenis_kelamin" value="{{ old('jenis_kelamin') }}"  class="form-control select2bs4 @error('jenis_kelamin') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                        <option disabled selected value="Bali">Pilih Jenis Kelamin</option>
                                        @php
                                            $genre = old('jenis_kelamin')
                                        @endphp
                                        <option @if ($genre=='laki-laki') selected @endif value="laki-laki">Laki-Laki</option>
                                        <option @if ($genre=='perempuan') selected @endif value="perempuan">Perempuan</option>
                                    </select>
                                    @error('kondisi')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('kondisi') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Masukan Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @error('kondisi')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('kondisi') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Masukan Kembali Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @error('kondisi')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('kondisi') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Provinsi <span class="text-danger">*</span></label>
                                <select disabled name="penerbit" class="form-control select2bs4  @error('penerbit') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                    <option disabled selected value="Bali">BALI</option>
                                </select>
                                @error('penerbit')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('penerbit') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                                <select id="kabupaten" name="kabupaten" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;">
                                    <option value="0" disabled selected>Pilih Kabupaten</option>
                                    @php
                                        $kabupaten = old('kabupaten')
                                    @endphp
                                    @foreach ($dataKabupaten->where('id_provinsi',51) as $data)
                                        @if ($kabupaten == $data->id_kabupaten)
                                            <option value="{{$data->id_kabupaten}}" selected>{{$data->name}}</option>
                                        @else
                                            <option value="{{$data->id_kabupaten}}">{{$data->name}}</option>
                                        @endif
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
                                    <select id="kecamatan" name="kecamatan" class="form-control select2bs4 @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                        <option value="0" disabled selected>Pilih Kecamatan</option>
                                    </select>
                                    @error('kecamatan')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('kecamatan') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Desa Dinas<span class="text-danger">*</span></label>
                                <select id="desa_dinas" name="desa_dinas" class="form-control select2bs4 @error('desa_dinas') is-invalid @enderror" style="width: 100%;">
                                    <option value="0" disabled selected>Pilih Desa Dinas</option>
                                </select>
                                @error('desa_dinas')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('desa_dinas') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Desa Adat <span class="text-danger">*</span></label>
                                <select id="desa_adat" name="desa_adat" class="form-control select2bs4 @error('desa_adat') is-invalid @enderror" style="width: 100%;">
                                    <option value="0" disabled selected>Pilih Desa Adat</option>
                                    @php
                                        $desaadat = old('desa_adat')
                                    @endphp
                                    @foreach ($dataDesaAdat as $data)
                                        @if ($desaadat == $data->desadat_id)
                                            <option selected value="{{$data->desadat_id}}" selected>{{$data->desadat_nama}}</option>
                                        @else
                                            <option value="{{$data->desadat_id}}">{{$data->desadat_nama}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('desa_adat')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('desa_adat') }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" placeholder="Masukan Deskripsi Buku">{{old('alamat')}}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('deskripsi_buku') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Pemetaan Lokasi Upacara</label>
                                <div class="input-group mb-3">
                                    <input name="lat" id="lat" type="text" aria-label="First name" class="form-control mr-1 @error('lat') is-invalid @enderror" placeholder="Lat" value="{{old('lat')}}" readonly="readonly">
                                    @error('lat')
                                        <div class="invalid-feedback text-start">
                                            {{ $errors->first('deskripsi_buku') }}
                                        </div>
                                    @enderror
                                    <input name="lng" id="lng" type="text" aria-label="Last name" class="form-control ml1" placeholder="Lang  @error('lng') is-invalid @enderror" value="{{old('lat')}}" readonly="readonly">
                                    @error('lng')
                                        <div class="invalid-feedback text-start">
                                            {{ $errors->first('deskripsi_buku') }}
                                        </div>
                                    @enderror
                                    <button type="button" class="btn btn-default ml-2" data-toggle="modal" id="modalMap" data-target="#modal-xl">
                                        <i class="fas fa-map-marked"></i>
                                    </button>
                                </div>
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
            <div class="text-center my-4">
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
    <script>

    </script>

    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

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
