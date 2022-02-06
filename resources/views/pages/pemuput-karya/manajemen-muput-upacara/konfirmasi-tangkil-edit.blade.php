@extends('layouts.sulinggih.sulinggih-layout')
@section('tittle','Reservasi Krama Masuk')

@push('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">

    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

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
        <div class="container-fluid border-bottom mt-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Reservasi Masuk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Data Reservasi</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="callout callout-info container-fluid">
                <h5><i class="fas fa-info"></i> Catatan:</h5>
                Pemuput Upacara dapat merubah semua tanggal tahapan dari upacara krama tersebut.
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card tab-content">
                        <div class="card-header my-auto">
                            <label class="card-title my-auto">Data Krama Pemesan</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Nama Krama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Krama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value=">nomor_telepon}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    {{-- ACTION FORM INPUT DATA --}}
                    <form action="{{route('pemuput-karya.muput-upacara.konfirmasi-tangkil.update')}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="card tab-content">
                                    <!-- /.card-header -->
                                    <div class="card-header">
                                        <div class="card-tools ">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="card-body box-profile align-content-center">
                                            <div class="text-center">
                                                <img class="ml-4 profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                                <h3 class="text-center bold mb-0 ">{{$dataUpacara->Upacara->nama_upacara}}</h3>
                                                <p class="text-center mb-1">{{$dataUpacara->Upacara->kategori_upacara}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Nama Upacara</label>
                                                    <input type="text" name="data_upacara[0][nama_upacara]" class="form-control @error('data_upacara[0][nama_upacara]') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataUpacara->nama_upacara}}">
                                                    @error('data_upacara[0][nama_upacara]')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $errors->first('data_upacara[0][nama_upacara]') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi Upacara</label>
                                                    <textarea class="form-control @error('data_upacara[0][deskripsi_upacara]') is-invalid @enderror" rows="3" name="data_upacara[0][deskripsi_upacara]">{{$dataUpacara->deskripsi_upacaraku}}</textarea>
                                                    @error('data_upacara[0][deskripsi_upacara]')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $errors->first('data_upacara[0][deskripsi_upacara]') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Mulai - Tanggal Selesai Upacara</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input name="data_upacara[0][daterange]" id="reservationtime" type='text' class='form-control float-right' value=''>
                                                        @error('data_upacara[0][daterange]')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $errors->first('data_upacara[0][daterange]') }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="card tab-content" id="v-pills-tabContent">
                                    <div class="card-header my-auto">
                                        <label class="card-title my-auto">Lokasi Upacara</label>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div id="gmaps" style="height: 466px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header my-auto">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="card-title my-auto">Reservasi Upakara Lainnya</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-lg-4 mt-1" id="">
                                        <div id="dataReservasiSulinggih">
                                            <div class='card shadow mb-4 '>
                                                <div class='card-body'>
                                                    <table  class='table'>
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Tahapan</th>
                                                                <th class='text-md-center'>Waktu Mulai - Selesai</th>
                                                                <th class='text-md-center'>Keterangan</th>
                                                                <th class='text-md-center'>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody >
                                                            @foreach ($dataUpacara->Reservasi->where('id_relasi',Auth::user()->Sulinggih->id) as $data)
                                                                @foreach ($data->DetailReservasi as $dataReservasi)
                                                                    <tr>
                                                                        <td>{{$loop->iteration}}</td>
                                                                        <td  style='width: 25%'>{{$dataReservasi->TahapanUpacara->nama_tahapan}}</td>
                                                                        <td class='text-md-center'>
                                                                            <div class='input-group'>
                                                                                <div class='input-group-prepend'>
                                                                                    <span class='input-group-text'>
                                                                                        <i class='far fa-calendar-alt'></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input name='reservasi[]' id="reservationtime-{{$dataReservasi->id}}" type='text' class='form-control float-right' value=''>
                                                                            </div>
                                                                        </td>
                                                                        <td class='d-flex justify-content-center'>
                                                                            {{Str::limit('The quick brown fox jumps over the lazy dog', 15)}}
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <select name="status[]" class="form-control select2bs4" style="width: 100%;" tabindex="-1" aria-hidden="true" id="status">
                                                                                    <option data-id="{{$dataReservasi->id}}"  @if ($dataReservasi->status == 'pending') value="pending" selected @else value="pending" @endif >Pending</option>
                                                                                    <option data-id="{{$dataReservasi->id}}" @if ($dataReservasi->status == 'diterima') value="diterima" selected @else value="diterima" @endif >Setujui</option>
                                                                                    <option data-id="{{$dataReservasi->id}}" @if ($dataReservasi->status == 'ditolak') value="ditolak" selected @else value="ditolak" @endif>Tolak</option>
                                                                                </select>
                                                                            </div>
                                                                            <input value="{{$dataReservasi->id}}" type="hidden" class="d-none" name="id_tahapan_sulinggih[]">
                                                                            <input id="text_penolakan-{{$dataReservasi->id}}" type="hidden" class="form-control" name="alasan_penolakan_sulinggih[]" value="" placeholder="Masukan alasan penolakan" >
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="showDataReservasi">

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-12 my-1">
                                                <a href="{{route('pemuput-karya.muput-upacara.konfirmasi-tangkil.index')}}" class="btn btn-secondary">Kembali</a>
                                                <button type="submit" class="btn m-1 btn-primary float-right ml-2">Konfimasi Tangkil</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- ACTION FORM INPUT DATA --}}
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <!-- Bootstrabase-template-->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTablbase-template Plugins -->
    <script src="{{asset('base-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <!-- jQuery -->
    <script src="{{asset('base-template/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <!-- jquery-validation -->
    <script src="{{asset('base-template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/jquery-validation/additional-methods.min.js')}}"></script>
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
            $('#side-manajemen-muput-upacara').addClass('menu-open');
            $('#side-manajemen-muput-upacara-konfirmasi-tangkil').addClass('active');
        });
    </script>

    <!-- Fungsi Form Input  -->
    <script type="text/javascript">

        $('#mySelect2').select2('data');

        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
    <!-- Fungsi Form Input  -->

    <script>
        $(document).ready(function(){
            $('#side-upacara').addClass('menu-open');
            $('#side-kabupaten').addClass('active');

            var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 10);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Adalah API Favoritku',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);

            var marker = new L.marker([dataUpacara.lat,dataUpacara.lng ]).bindPopup(dataUpacara.alamat_upacaraku).addTo(mymap);
            marker.on('click', function() {
                marker.openPopup();
            });
        });
    </script>
@endpush

@push('js')
    <script type="text/javascript">
        let dataUpacara,tanggalTangkil ;
        let idUser = {{ (Auth::user()->Sulinggih->id) }}
        dataUpacara = {!! json_encode($dataUpacara) !!}
        // console.log(dataUpacara)

        $('#reservationtime').daterangepicker({
            timePicker: true,
            startDate: moment(dataUpacara.tanggal_mulai).format('DD/MM/YYYY hh:mm A'),
            endDate:moment(dataUpacara.tanggal_selesai).format('DD/MM/YYYY hh:mm A'),
            locale: {
                format: 'DD/MM/YYYY hh:mm A',
            },
            drops: "up",
        });

        // SET UP DATERANGE
        function setDataRangeTahapan(id,start,end){
            $('#reservationtime-'+id).daterangepicker({
                timePicker: true,
                startDate: moment(start).format('DD/MM/YYYY hh:mm A'),
                endDate:moment(end).format('DD/MM/YYYY hh:mm A'),
                locale: {
                    format: 'DD/MM/YYYY hh:mm A',
                },
                drops: "up",
            });
        }
        // SET UP DATERANGE

        // SET UP CALENDER
        dataUpacara.reservasi.forEach(element => {
            if(element.tanggal_tangkil == null){
                tanggalTangkil = 'Tanggal Tangkil belum ditentukan'
            }else{
                tanggalTangkil = moment(element.tanggal_tangkil).format('DD-MM-YYYY | hh:mm');
            }
            if(idUser == element.id_relasi ){
                element.detail_reservasi.forEach(data => {
                    setDataRangeTahapan(data.id,data.tanggal_mulai,data.tanggal_selesai);
                })
            }else{
                var i = 0;
                $("#showDataReservasi").append("<div class='card shadow mb-4 card-info card-outline '><div class='card-header' aria-expanded='false'><div class='user-block'><img class='img-circle' src='{{asset('base-template/dist/img/user1-128x128.jpg')}}' alt='User Image'><span class='username'><a class='ml-2' href='#'>"+element.sulinggih.nama_sulinggih+"</a> | "+element.status.toUpperCase()+"</span><span class='description'><label class='ml-2'>Tanggal Tangkil : "+ tanggalTangkil+" </label></span></div></div><div class='card-body'><table  class='table'><thead><tr><th>No</th><th>Nama Tahapan</th><th class='text-md-center'>Waktu Mulai - Selesai</th><th class='text-md-center'>Status</th></tr></thead><tbody id='data-"+element.id+"'></tbody>" );
                element.detail_reservasi.forEach(data => {
                    i++
                    $("#data-"+element.id).append("<tr><td>"+i+"</td><td style='width: 40%'>"+data.tahapan_upacara.nama_tahapan+"</td><td class='text-md-center'><div class='input-group'><div class='input-group-prepend'><span class='input-group-text'><i class='far fa-calendar-alt'></i></span></div><input name='daterange[]' id='reservationtime-"+data.id+"' type='text' class='form-control float-right' value=''></div> <div id='keterangan_penolakan'> </div></td><td class='d-flex justify-content-center'><div class='bg-info btn-sm text-center' style='border-radius: 5px; width:80px;'>"+data.status+"</div></td></tr></table></div></div>");
                    // <input id='text_penolakan-{{$dataReservasi->id}}' type='text' class='mt-3 form-control' name='alasan_penolakan_sulinggih[]' value='' placeholder='Masukan alasan penolakan' >
                    setDataRangeTahapan(data.id,data.tanggal_mulai,data.tanggal_selesai);
                })
            }
        });
        // SET UP CALENDER

        /// FUNGSI GET DATA ALASAN DIDATABASE
        getAlasanPenolakan();
        function getAlasanPenolakan(){
            $.each(dataUpacara.reservasi, function(key, data){
                if(data.id_relasi == idUser){
                    $.each(data.detail_reservasi, function(key, dataDetailReservasi){
                        console.log(dataDetailReservasi)
                        if(dataDetailReservasi.keterangan != null){
                            var text = document.getElementById("text_penolakan-"+dataDetailReservasi.id);
                            text.type = "text";
                            text.value = dataDetailReservasi.keterangan;
                        }else{
                            var text = document.getElementById("text_penolakan-"+dataDetailReservasi.id);
                            text.type = "hidden";
                            text.value = "";
                        }
                    });
                }
            })

        }

        // ADD FUNCTION ADD KOLOM ALASAN RESERVASI
        $('select').change(function(){
            var id = $(this).find(':selected').data('id');
            var jenis = $(this).find(':selected').val();
            var text = document.getElementById("text_penolakan-"+id);
            if(jenis=='ditolak'){
                getAlasanPenolakan();
                text.type = "text";
            }else{
                text.type = "hidden";
                text.value = "";
            }
        });
        // ADD FUNCTION ADD KOLOM ALASAN RESERVASI

        // ADD FUNCTION ADD KOLOM ALASAN RESERVASI
        $('select').change(function(){
            var id = $(this).find(':selected').data('id');
            var jenis = $(this).find(':selected').val();
            var text = document.getElementById("text_penolakan-"+id);
            if(jenis=='ditolak'){
                getAlasanPenolakan();
                text.type = "text";
            }else{
                text.type = "hidden";
                text.value = "";
            }
        });
        // ADD FUNCTION ADD KOLOM ALASAN RESERVASI

    </script>
@endpush


