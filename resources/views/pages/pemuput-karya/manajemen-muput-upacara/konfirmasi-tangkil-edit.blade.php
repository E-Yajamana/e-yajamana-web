@extends('layouts.pemuput-karya.pemuput-karya-layout')
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
                Pemuput Upacara dapat merubah semua Tanggal Tahapan dari reservasi krama tersebut.
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
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->Krama->User->Penduduk->nama}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Krama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->Krama->User->Penduduk->alamat}}" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->Krama->User->email}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->Krama->User->nomor_telepon}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    {{-- ACTION FORM INPUT DATA --}}
                    <form action="{{route('pemuput-karya.muput-upacara.konfirmasi-tangkil.update')}}" method="POST" id="postData">
                        @csrf
                        @method('PUT')
                        <input name="id_reservasi" value="{{$dataReservasi->id}}" type="hidden" class="d-none">
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
                                                <h3 class="text-center bold mb-0 ">{{$dataReservasi->Upacaraku->Upacara->nama_upacara}}</h3>
                                                <p class="text-center mb-1">{{$dataReservasi->Upacaraku->Upacara->kategori_upacara}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="hidden" class="d-none" name="data_upacara[0][id]" value="{{$dataReservasi->Upacaraku->id}}">
                                                <div class="form-group">
                                                    <label>Nama Upacara</label>
                                                    <input type="text" name="data_upacara[0][nama_upacara]" class="form-control @error('data_upacara[0][nama_upacara]') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->nama_upacara}}">
                                                    @error('data_upacara[0][nama_upacara]')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $errors->first('data_upacara[0][nama_upacara]') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi Upacara</label>
                                                    <textarea class="form-control @error('data_upacara[0][deskripsi_upacara]') is-invalid @enderror" rows="3" name="data_upacara[0][deskripsi_upacara]">{{$dataReservasi->Upacaraku->deskripsi_upacaraku}}</textarea>
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
                                                        <input name="data_upacara[0][daterange]"  id="reservationtime" type='text' class='form-control float-right' value=''>
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
                                                <label class="card-title my-auto">Reservasi Upacara Lainnya</label>
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
                                                                <th class=''>Status</th>
                                                                <th class="text-center">Detail Keterangan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody >
                                                            @foreach ($dataReservasi->DetailReservasi as $data)
                                                                <input value="{{$data->id}}" type="hidden" class="d-none" name="data_user_reservasi[{{$loop->iteration}}][id]">
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td  style='width: 14%'>{{$data->TahapanUpacara->nama_tahapan}}</td>
                                                                    <td class='text-md-center'>
                                                                        <div class='input-group'>
                                                                            <div class='input-group-prepend'>
                                                                                <span class='input-group-text'>
                                                                                    <i class='far fa-calendar-alt'></i>
                                                                                </span>
                                                                            </div>
                                                                            <input name='data_user_reservasi[{{$loop->iteration}}][daterange]' id="reservationtime-{{$data->id}}" type='text' class='form-control float-right' value=''>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="form-group">
                                                                            <select name='data_user_reservasi[{{$loop->iteration}}][status]' class="form-control select2bs4" style="width: 100%;" tabindex="-1" aria-hidden="true" id="status">
                                                                                <option data-id="{{$data->id}}"  @if ($data->status == 'pending') value="pending" selected @else value="pending" @endif >Pending</option>
                                                                                <option data-id="{{$data->id}}" @if ($data->status == 'diterima') value="diterima" selected @else value="diterima" @endif >Setujui</option>
                                                                                <option data-id="{{$data->id}}" @if ($data->status == 'ditolak') value="ditolak" selected @else value="ditolak" @endif>Tolak</option>
                                                                            </select>
                                                                        </div>
                                                                        <input id="text_penolakan-{{$data->id}}" type="hidden" class="form-control" name="data_user_reservasi[{{$loop->iteration}}][keterangan]" value="" placeholder="Masukan alasan penolakan" >
                                                                    </td>
                                                                    <td class="text-center" style='width: 10%'>
                                                                        <a onclick="getKeterangan({{$data->id}})" class="btn btn-secondary btn-sm" ><i class="fas fa-ellipsis-h"></i></a>
                                                                    </td>
                                                                </tr>
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
    <input id="jsonDataUpacara" type="hidden" value='@json($dataUpacara)'>
    <input id="jsonDataReservasi" type="hidden" value='@json($dataReservasi)'>
    @foreach ($dataUpacara as $data)
        <input id="nama-pemuput-karya-{{$data->id_relasi}}" value="{{$data->Relasi->getRelasi()->nama}}" type="hidden" class="d-none">
    @endforeach

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Transaksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Timelime example  -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="timeline" id="timeline">
                                {{-- <div>
                                    <i class="fas fa-user bg-blue"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">Made Rismawan</a><p class="m-0 mt-1">22 Januari 2021</p></h3>

                                        <div class="timeline-body">
                                           Update your reservasi : karena oitu menrutu saya kuranga
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div> --}}
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->


@endsection

{{-- LIBRARY IMPORT --}}
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

            $('#mySelect2').select2('data');

            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        });
    </script>
@endpush
{{-- LIBRARY IMPORT --}}

@push('js')
    <script type="text/javascript">
        // DEKLARASI DATA RESERVASI
        let dataUpacara,dataReservasi, tanggalTangkil;
        let jsonDataUpacara = $('#jsonDataUpacara').val();
        let jsonDataReservasi = $('#jsonDataReservasi').val();
        dataUpacara = (JSON.parse(jsonDataUpacara));
        dataReservasi = (JSON.parse(jsonDataReservasi));
        console.log(dataUpacara)

        var date  = $("#reservationtime").val();
        const parameterDate  = date.split(" - ");
        console.log(date)


        // SET UP DATERANGE
        function setDataRangeTahapan(id,start,end){
            var startDate;
            var endDate;

            $('#reservationtime-'+id).daterangepicker({
                timePicker: true,
                startDate: moment(start).format('DD MMMM YYYY hh:mm A'),
                endDate:moment(end).format('DD MMMM YYYY hh:mm A'),
                locale: {
                    format: 'DD MMMM YYYY hh:mm A',
                },
                drops: "up",
            },function(start, end) {
                startDate = start;
                endDate = end;
            });

            $("#reservationtime-"+id).change(function () {
                console.log(startDate.format('DD MMMM YYYY hh:mm A') + ' - ' + endDate.format('DD MMMM YYYY hh:mm A'));
                console.log(moment(start).format('DD MMMM YYYY hh:mm A'))
                if(startDate.format('DD MMMM YYYY hh:mm A') != moment(start).format('DD MMMM YYYY hh:mm A') || moment(end).format('DD MMMM YYYY hh:mm A') != endDate.format('DD MMMM YYYY hh:mm A')){
                    $('#keterangan_penolakan-'+id).empty();
                    $("#id_detail-" + id).attr('name','id_detail_reservasi[]' );
                    $("#reservationtime-" + id).attr('name', 'daterange[]');
                    $('#keterangan_penolakan-'+id).append("<input type='text' class='mt-3 form-control' name='alasan_penolakan_sulinggih[]' value='' placeholder='Masukan alasan penolakan'>");
                }else{
                    $("#id_detail-" + id).attr('name','' );
                    $("#reservationtime-" + id).attr('name', '');
                    $('#keterangan_penolakan-'+id).empty();
                }

            })

        }
        // SET UP DATERANGE

        // RESERVASI SULINGGIH LAIN CALENDER
        dataUpacara.forEach(element => {
            var i = 0;
            (element.tanggal_tangkil != null ? tanggalTangkil = moment(element.tanggal_tangkil).format('DD MMMM YYYY hh:mm A') :  tanggalTangkil = "Belum ditentukan");
            var namaPemuput = $('#nama-pemuput-karya-'+element.id_relasi).val();
            $("#showDataReservasi").append("<div class='card shadow mb-4 card-info card-outline '><div class='card-header' aria-expanded='false'><div class='user-block'><img class='img-circle' src='{{route('get-image.profile.pemuput-karya')}}/"+element.id_relasi+"' alt='User Image'><span class='username'><a class='ml-2' href='#'>"+namaPemuput+"</a> | "+element.status.toUpperCase()+"</span><span class='description'><label class='ml-2'>Tanggal Tangkil : "+ tanggalTangkil+" </label></span></div></div><div class='card-body'><table  class='table'><thead><tr><th>No</th><th>Nama Tahapan</th><th class='text-md-center'>Waktu Mulai - Selesai</th><th class='text-md-center'>Status</th></tr></thead><tbody id='data-"+element.id+"'></tbody>" );
            element.detail_reservasi.forEach(data => {
                i++
                $("#data-"+element.id).append(
                    "<tr><td>"+i+"</td><td style='width: 30%'>"+data.tahapan_upacara.nama_tahapan+"</td>"+
                    "<td class='text-md-center'><div class='input-group'><div class='input-group-prepend'><span class='input-group-text'><i class='far fa-calendar-alt'></i></span></div><input type='hidden' class='d-none' id='id_detail-"+data.id+"' value='"+data.id+"'><input id='reservationtime-"+data.id+"' type='text' class='form-control float-right' value=''></div> <div id='keterangan_penolakan-"+data.id+"'> </div></td>"+
                    "<td class='d-flex justify-content-center text-center'>"+
                    (data.status == 'pending' ? '<div class="bg-secondary btn-sm text-center"' : '')+
                    (data.status == 'diterima' ? '<div class="bg-primary btn-sm text-center"' : '')+
                    (data.status == 'ditolak' ? '<div class="bg-danger btn-sm text-center"' : '')+
                    (data.status == 'selesai' ? '<div class="bg-success btn-sm text-center"' : '')+
                    (data.status == 'batal' ? '<div class="bg-danger btn-sm text-center"' : '')+
                    "style='border-radius: 5px; width:80px;'>"+data.status.toUpperCase()+"</div></td></tr></table></div></div>");
                setDataRangeTahapan(data.id,data.tanggal_mulai,data.tanggal_selesai);
            })
        });
        // RESERVASI SULINGGIH LAIN CALENDER

    </script>
@endpush

{{-- DATA UPACARA --}}
@push('js')
    <script>
        // SET UP DATE UPACARA
        $('#reservationtime').daterangepicker({
            timePicker: true,
            startDate: moment(dataReservasi.upacaraku.tanggal_mulai).format('DD MMMM YYYY'),
            endDate:moment(dataReservasi.upacaraku.tanggal_selesai).format('DD MMMM YYYY'),
            locale: {
                format: 'DD MMMM YYYY',
            },
            drops: "up",
        });
        // SET UP DATE UPACARA

        // SET UP DATE RANGE RESERVASI SULINGGIH
        dataReservasi.detail_reservasi.forEach(data => {
            $('#reservationtime-'+data.id).daterangepicker({
                timePicker: true,
                startDate: moment(data.tanggal_mulai).format('DD MMMM YYYY hh:mm A'),
                endDate:moment(data.tanggal_selesai).format('DD MMMM YYYY hh:mm A'),
                locale: {
                    format: 'DD MMMM YYYY hh:mm A',
                },
                drops: "up",
            },function(start, end) {
                startDate = start;
                endDate = end;
            });
        });
        // SET UP DATE RANGE RESERVASI SULINGGIH

        // SET UP MAPS
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

            var marker = new L.marker([dataReservasi.upacaraku.lat,dataReservasi.upacaraku.lng ]).bindPopup(dataReservasi.upacaraku.alamat_upacaraku).addTo(mymap);
            marker.on('click', function() {
                marker.openPopup();
            });
        });
        // SET UP MAPS

        // FUNGSI GET DATA ALASAN DIDATABASE (**)
        getAlasanPenolakan();
        function getAlasanPenolakan(){
            $.each(dataReservasi.detail_reservasi, function(key, data){
                key++
                if(data.keterangan != null){
                    var text = document.getElementById("text_penolakan-"+data.id);
                    var jenis = $('select[name="data_user_reservasi['+key+'][status]"]').val();
                    console.log(jenis)
                    if(jenis=='ditolak'){
                        text.type = "text";
                        text.value = data.keterangan;
                    }
                }
            });
        }
        // FUNGSI GET DATA ALASAN DIDATABASE (**)

        // ADD FUNCTION ADD KOLOM ALASAN RESERVASI (**)
        $('select').change(function(){
            var id = $(this).find(':selected').data('id');
            var jenis = $(this).find(':selected').val();
            var text = document.getElementById("text_penolakan-"+id);
            if(jenis=='ditolak'){
                text.type = "text";
                getAlasanPenolakan();
                 $(".form-control").each(function () {
                    $(this).rules('add', {
                        required: true
                    });
                });
            }else{
                text.type = "hidden";
                text.value = "";
            }
        });
        // ADD FUNCTION ADD KOLOM ALASAN RESERVASI (**)

    </script>
@endpush
{{-- DATA UPACARA --}}

@push('js')
    <script>
        function getKeterangan(id){
            $.ajax({
                url: "{{route('ajax.get.keterangan-reservasi')}}"+"/"+id,
                type: "GET",
                dataType: "json",
                success:function(response)
                {
                    if(response.data.length != 0){
                        $('#timeline').empty();
                        $.each(response.data, function(key, data){
                            let tanggal;
                            console.log(response.data.length);
                            tanggal = moment(data.created_at).format('DD MMMM YYYY hh:mm A');
                            $('#timeline').append(
                                "<div><i class='fas fa-user bg-blue'></i><div class='timeline-item'>"+
                                "<h3 class='timeline-header'><a href='#'>"+data.relasi.sulinggih.nama_sulinggih+"</a> <p class='m-0 mt-1'>"+tanggal+"</p></h3>"+
                                "<div class='timeline-body'> Perubahan Reservasi : "+data.keterangan+" </div></div></div>"+
                                (key == response.data.length-1 ?  "<div><i class='fas fa-calendar-plus bg-green'></i><div class='timeline-item'><h3 class='timeline-header no-border'><a href='#'>"+dataReservasi.upacaraku.krama.user.penduduk.nama+"</a> Membuat Upacara <p class='m-0 mt-1'>"+moment(dataReservasi.upacaraku.created_at).format('DD MMMM YYYY hh:mm A')+"</p></h3></div></div>" : "")+
                                (key == response.data.length-1 ? "<div><i class='fas fa-clock bg-gray'></i></div>" : "")

                            );
                        });
                    }else{
                        $('#timeline').empty();
                        $('#timeline').append("<div><i class='fas fa-calendar-plus bg-green'></i><div class='timeline-item'><h3 class='timeline-header no-border'><a href='#'>"+dataReservasi.upacaraku.krama.user.penduduk.nama+"</a> Membuat Upacara <p class='m-0 mt-1'>"+moment(dataReservasi.upacaraku.created_at).format('DD MMMM YYYY hh:mm A')+"</p></h3></div></div><div><i class='fas fa-clock bg-gray'></i></div>");
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $('#jenisupacara').empty();
                }
            })

            $("#modal-default").modal();
        }
    </script>

@endpush




