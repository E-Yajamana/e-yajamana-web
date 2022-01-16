@extends('layouts.admin.admin-layout')
@section('tittle','Tambah Data Upacara')

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

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Lokasi Griya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Griya</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{route('admin.master-data.griya.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                        <div class="card-header my-auto">
                            <h3 class="card-title my-auto">Form Tambah Data Upacara</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Griya <span class="text-danger">*</span></label>
                                <input type="text" name="nama_griya" class="form-control @error('nama_griya') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Griya">
                                @error('nama_griya')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('nama_griya') }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label>Provinsi <span class="text-danger">*</span></label>
                                <select disabled class="form-control select2bs4  @error('penerbit') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                    <option disabled selected value="Bali">BALI</option>
                                </select>
                                @error('penerbit')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('penerbit') }}
                                    </div>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                                <select id="kabupaten" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;">
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
                            <div class="form-group">
                                <label>Alamat Lengkap Griya <span class="text-danger">*</span></label>
                                <textarea name="alamat_griya" class="form-control  @error('alamat_griya') is-invalid @enderror" rows="3" placeholder="Masukan Alamat Lengkap Griya" value="{{ old('alamat_griya') }}" ></textarea>
                                @error('alamat_griya')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('alamat_griya') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Pemetaan Lokasi Griya</label>
                                <div class="input-group mb-3">
                                    <input name="lat" id="lat" type="text" aria-label="First name" class="form-control mr-1 @error('lat') is-invalid @enderror" placeholder="Lat" readonly="readonly">
                                    @error('lat')
                                        <div class="invalid-feedback text-start">
                                            {{ $errors->first('lat') }}
                                        </div>
                                    @enderror
                                    <input name="lng" id="lng" type="text" aria-label="Last name" class="form-control ml1" placeholder="Lang  @error('lng') is-invalid @enderror" readonly="readonly">
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
                                <div id="button-remove" class="row justify-content-end mt-lg-4">
                                    <button type="submit" class=" mx-1 btn btn-primary">Simpan Data Griya</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

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

    <!-- Fungsi Boostrap & Library  -->
    <script type="text/javascript">
        $('#mySelect2').select2('data');

        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-griya').addClass('active');
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
    <!-- Fungsi Boostrap & Library  -->

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

@endpush
