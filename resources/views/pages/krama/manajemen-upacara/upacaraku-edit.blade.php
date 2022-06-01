@extends('layouts.krama.krama-layout')
@section('tittle','Ubah Upacara')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">


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
                    <h1>Ubah Upacara</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('krama.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('krama.manajemen-upacara.upacaraku.index')}}">Data Upacara</a></li>
                        <li class="breadcrumb-item active">Ubah Upacara</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if ($dataUpacaraku->reservasi_count != 0)
                        <div class="callout callout-danger container-fluid">
                            <h5><i class="fas fa-info"></i> Catatan:</h5>
                            Anda tidak dapat kembali merubah data <strong>Jenis Yadnya, Jenis Upacara, dan Tanggal Mulai - Selesai Upacara</strong> , dikarenakan sudah terdapat reservasi yang Sedang Berlangsung / Selesai.
                        </div>
                    @endif
                    <form action="{{route('krama.manajemen-upacara.upacaraku.update')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input name="id_upacaraku" value="{{$dataUpacaraku->id}}" type="hidden" class="d-none">
                        <div class="card">
                            <div class="card-header my-auto">
                                <label class="card-title my-auto">Form Ubah Upacara Krama</label>
                            </div>
                            <div class="card-body p-4">
                                <div class="form-group">
                                    <label>Jenis Yadnya <span class="text-danger">*</span></label>
                                    <select  @if ($dataUpacaraku->status == 'berlangsung') disabled @endif id="jenis_yadnya" class="form-control select2bs4 @error('jenis_yadnya') is-invalid @enderror" style="width: 100%;">
                                        <option value="0" >Pilih Jenis Yadnya</option>
                                        <option @if ($dataUpacaraku->Upacara->kategori_upacara == 'Manusa Yadnya') selected @endif value="Manusa Yadnya" >Manusa Yadnya</option>
                                        <option @if ($dataUpacaraku->Upacara->kategori_upacara == 'Dewa Yadnya') selected @endif value="Dewa Yadnya" >Dewa Yadnya</option>
                                        <option @if ($dataUpacaraku->Upacara->kategori_upacara == 'Pitra Yadnya') selected @endif value="Pitra Yadnya" >Pitra Yadnya</option>
                                        <option @if ($dataUpacaraku->Upacara->kategori_upacara == 'Rsi Yadnya') selected @endif value="Rsi Yadnya" >Rsi Yadnya</option>
                                        <option @if ($dataUpacaraku->Upacara->kategori_upacara == 'Bhuta Yadnya') selected @endif value="Bhuta Yadnya" >Bhuta Yadnya</option>
                                    </select>
                                    @error('jenis_yadnya')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('jenis_yadnya') }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Jenis Upacara <span class="text-danger">*</span></label>
                                        <select @if ($dataUpacaraku->status == 'berlangsung') disabled @endif  id="jenisupacara" name="id_upacara" class="form-control select2bs4 @error('id_upacara') is-invalid @enderror" style="width: 100%;">
                                            <option value="0" disabled selected>Pilih Jenis Upacara</option>
                                        </select>
                                        @error('id_upacara')
                                            <div class="invalid-feedback text-start">
                                                {{$errors->first('id_upacara') }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <input @if ($dataUpacaraku->status == 'berlangsung') disabled @endif name="status" value="{{$dataUpacaraku->status}}" type="hidden" class="d-none">
                                <div class="form-group">
                                    <label>Tanggal Mulai - Tanggal Selesai Upacara <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input  name="daterange" id="reservationtime" type='text' class='form-control float-right'>
                                        @error('daterange')
                                            <div class="invalid-feedback text-start">
                                                {{ $errors->first('daterange') }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Upacaraku <span class="text-danger">*</span></label>
                                    <input @if ($dataUpacaraku->status == 'berlangsung') disabled @endif   type="text" name="nama_upacara" class="form-control @error('nama_upacara') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Upacaraku" value="{{$dataUpacaraku->nama_upacara}}">
                                    @error('nama_upacara')
                                        <div class="invalid-feedback text-start">
                                            {{ $errors->first('nama_upacara') }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Upacara</label>
                                    <textarea @if ($dataUpacaraku->status == 'berlangsung') disabled @endif   name="deskripsi_upacaraku" class="form-control  @error('deskripsi_upacaraku') is-invalid @enderror" rows="3" placeholder="Masukan Deskripsi Upacara Krama">{{$dataUpacaraku->deskripsi_upacaraku}}</textarea>
                                    @error('deskripsi_upacaraku')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('deskripsi_upacaraku') }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row mb-0">
                                    <div class="col-12 col-sm-6 p-3">
                                        <div class="form-group">
                                            <div id="gmaps" style="height: 480px;border: 2px"></div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="lat" id="lat" type="text" aria-label="First name" class="form-control mr-1 @error('lat') is-invalid @enderror" placeholder="Lat" value="{{old('lat')}}" readonly="readonly">
                                            @error('lat')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('lat') }}
                                                </div>
                                            @enderror
                                            <input name="lng" id="lng" type="text" aria-label="Last name" class="form-control ml" placeholder="Lang  @error('lng') is-invalid @enderror" value="{{old('lat')}}" readonly="readonly">
                                            @error('lng')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('lng') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- PENGGUNAAN LOKASI --}}
                                    <div class="col-12 col-sm-6 p-3">
                                        <div class="form-group">
                                            <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                                            <select @if ($dataUpacaraku->status == 'berlangsung') disabled @endif   name="kabupaten" id="kabupaten" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;" value="{{old('kabupaten')}}">
                                                <option value="0" disabled selected>Pilih Kabupaten</option>
                                                @foreach ($dataKabupaten as $data)
                                                    @if ($dataUpacaraku->BanjarDinas->DesaDinas->Kecamatan->Kabupaten->id == $data->id)
                                                        <option selected value="{{$data->id}}">{{$data->name}}</option>
                                                    @else
                                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            {{-- <p class="m-1">(Pilih Provinsi terlebih dahulu)</p> --}}
                                            @error('kabupaten')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('kabupaten') }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Kecamatan <span class="text-danger">*</span></label>
                                            <select @if ($dataUpacaraku->status == 'berlangsung') disabled @endif  id="kecamatan" class="form-control select2bs4 @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                                @foreach ($dataKecamatan->where('kabupaten_id',$dataUpacaraku->BanjarDinas->DesaDinas->Kecamatan->Kabupaten->id) as $data)
                                                    @if ($data->id == $dataUpacaraku->BanjarDinas->DesaDinas->Kecamatan->id)
                                                        <option selected value="{{$data->id}}">{{$data->name}}</option>
                                                    @else
                                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <p class="m-1 text-sm">(Pilih Kabupaten terlebih dahulu)</p>
                                            @error('kecamatan')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('kecamatan') }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Desa Dinas<span class="text-danger">*</span></label>
                                            <select @if ($dataUpacaraku->status == 'berlangsung') disabled @endif  id="desa_dinas" name="id_desa" class="form-control select2bs4 @error('id_desa') is-invalid @enderror" style="width: 100%;">
                                                <option value="0" disabled selected>Pilih Desa Dinas</option>
                                                @foreach ($dataDesa->where('kecamatan_id',$dataUpacaraku->BanjarDinas->DesaDinas->Kecamatan->id) as $data)
                                                    @if ($data->id == $dataUpacaraku->BanjarDinas->DesaDinas->id)
                                                        <option selected value="{{$data->id}}">{{$data->name}}</option>
                                                    @else
                                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                                    @endif
                                                @endforeach
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
                                            <select @if ($dataUpacaraku->status == 'berlangsung') disabled @endif  id="id_banjar_dinas" name="id_banjar_dinas" class="form-control select2bs4 @error('id_banjar_dinas') is-invalid @enderror" style="width: 100%;">
                                                <option value="0" disabled selected>Pilih Banjar Dinas</option>
                                                @foreach ($dataBanjarDinas->where('id',$dataUpacaraku->BanjarDinas->id) as $data)
                                                    @if ($data->id == $dataUpacaraku->BanjarDinas->id)
                                                        <option selected value="{{$data->id}}">{{$data->nama_banjar_dinas}}</option>
                                                    @else
                                                        <option value="{{$data->id}}">{{$data->nama_banjar_dinas}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <p class="m-1 text-sm">(Pilih Desa Dinas terlebih dahulu)</p>
                                            @error('id_banjar_dinas')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('id_banjar_dinas') }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-0">
                                            <label>Alamat Upacara <span class="text-danger">*</span></label>
                                            <textarea @if ($dataUpacaraku->status == 'berlangsung') disabled @endif  name="alamat_upacaraku" class="form-control  @error('alamat_upacaraku') is-invalid @enderror" rows="3" placeholder="Masukan Alamat Lengkap Griya">{{$dataUpacaraku->alamat_upacaraku}}</textarea>
                                            @error('alamat_upacaraku')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('alamat_upacaraku') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- PENGGUNAAN LOKASI --}}
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12 my-1">
                                        <a href="{{route('krama.manajemen-upacara.upacaraku.index')}}" class="btn btn-secondary">Kembali</a>
                                        @if ($dataUpacaraku->status == 'pending')
                                            <button type="submit" class="btn m-1 btn-primary float-right ml-2">Simpan Perubahan</button>
                                            <button onclick="deleteUpacara({{$dataUpacaraku->id}},{{{$dataUpacaraku->reservasi_count}}})" class="btn m-1 btn-danger float-right ml-2">Batalkan Upacara</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <input id="article" type="hidden" value='@json($dataUpacaraku)'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('pages.krama.manajemen-upacara.modal-pembatalan-upacara')

@endsection

@push('js')
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/dist/js/pages/ajax-get-wilayah.js')}}"></script>

    <!-- daterangepicker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>

    <!-- Bootstrabase-template-->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-upacara').addClass('menu-open');
            $('#side-data-upacara').addClass('active');
        });

    </script>

@endpush

@push('js')
    <script type="text/javascript">
        let article = $('#article').val();
        let parseData = (JSON.parse(article));
        console.log(parseData);

        $('#reservationtime').daterangepicker({
            "autoApply": true,
            "minDate": moment(Date ()).add(1, 'D').format('DD MMMM YYYY'),
            "maxDate": moment(Date ()).add(2, 'Y').format('DD MMMM YYYY'),
            startDate: moment(parseData.tanggal_mulai).format('DD MMMM YYYY'),
            endDate:moment(parseData.tanggal_selesai).format('DD MMMM YYYY'),
            disabled: true,
            locale: {
                format: 'DD MMMM YYYY',
            },
            drops: "up",
        });


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

           var curLocation = [parseData.lat, parseData.lng];
           $("#lat").val(parseData.lat);
            $("#lng").val(parseData.lng);

           if (curLocation[0] == 0 && curLocation[1] == 0) {
               curLocation = [-8.4517916, 115.1970086];
           }

           if(parseData.reservasi_count == 0){
                var marker = new L.marker(curLocation, {
                    draggable: 'true'
                });
           }else{
                var marker = new L.marker(curLocation);
           }


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


        // CONFIG SET UP DATA JENIS UPACARA DAN YADNYA
        $.ajax({
            url: "{{route('ajax.get.jenis-yadnya')}}"+"/"+parseData.upacara.kategori_upacara,
            type: "GET",
            data : {"_token":"{{ csrf_token() }}"},
            dataType: "json",
            success:function(dataYadnya)
            {
                console.log(dataYadnya)
                if(dataYadnya.data){
                    $('#jenisupacara').empty();
                    $('#jenisupacara').append('<option value="0" disabled selected>Pilih Jenis Upacara</option>');
                    $.each(dataYadnya.data, function(key, data){
                        if(parseData.id_upacara == data.id){
                            $('#jenisupacara').append('<option selected value="'+ data.id +'">' + data.nama_upacara+ '</option>');
                        }else{
                            $('#jenisupacara').append('<option value="'+ data.id +'">' + data.nama_upacara+ '</option>');
                        }
                    });
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $('#jenisupacara').empty();
            }
        })


        $('#jenis_yadnya').on('change', function () {
            let jenisYadnya = $(this).val();
            $.ajax({
                url: "{{route('ajax.get.jenis-yadnya')}}"+"/"+jenisYadnya,
                type: "GET",
                data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(dataYadnya)
                {
                    if(dataYadnya.data.length != 0){
                        $('#jenisupacara').empty();
                        $('#jenisupacara').append('<option value="0" disabled selected>Pilih Jenis Upacara</option>');
                        $.each(dataYadnya.data, function(key, data){
                            $('#jenisupacara').append('<option value="'+ data.id +'">' + data.nama_upacara+ '</option>');
                        });
                    }else{
                        $('#jenisupacara').append('<option value="0" disabled selected>Belum terdapat data upacara pada sistem</option>');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $('#jenisupacara').empty();
                }
            })
        })
        // CONFIG SET UP DATA JENIS UPACARA DAN YADNYA

    </script>
@endpush
