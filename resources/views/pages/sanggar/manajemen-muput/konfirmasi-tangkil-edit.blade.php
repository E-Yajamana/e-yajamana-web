@extends('layouts.sanggar.sanggar-layout')
@section('tittle','Konfirmasi Penguleman Krama')

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
                    <h1>Konfirmasi Penguleman Krama</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('sanggar.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('sanggar.muput-upacara.konfirmasi-tangkil.index')}}">Data Penguleman Krama</a></li>
                        <li class="breadcrumb-item active">Konfirmasi Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            {{-- <div class="callout callout-info container-fluid">
                <h5><i class="fas fa-info"></i> Catatan:</h5>
                Pemuput Upacara dapat melakukan perubahan semua Data Reservasi, baik itu Reservasinya sendiri maupun Reservasi Pemuput Karya lain yang berstatus Proses Tangkil.
            </div> --}}
            <div class="row">
                <!--- DATA DETAIL KRAMA PEMESANAN --->
                <div class="col-12">
                    <div class="card tab-content">
                        <div class="card-header my-auto">
                            <label class="card-title my-auto">Data Krama Pemesan</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="mb-2">Tanggal Tangkil Krama</label>
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input disabled type="text" class="form-control" id="date" name="tanggal_tangkil" placeholder="Enter email" value="{{date('d F Y | H:i ',strtotime($dataReservasi->tanggal_tangkil))}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Nama Krama</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->User->Penduduk->nama}}" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->User->email}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Alamat Krama</label>
                                        <input type="text" class="form-control" id="alamat" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->User->Penduduk->alamat}}" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <input type="text" class="form-control" id="nomor_telepon" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->User->nomor_telepon}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--- DATA DETAIL KRAMA PEMESANAN --->

                <div class="col-12">
                    {{-- ACTION FORM INPUT DATA --}}
                    <form id="formTangkil" action="{{route('sanggar.muput-upacara.konfirmasi-tangkil.update.terima')}}" method="POST" id="postData">
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
                                                <img class="ml-4 profile-user-img img-fluid img-circle" src="{{asset('base-template/dist/img/logo-01.png')}}" alt="User profile picture">
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
                                                    <input type="text" name="data_upacara[0][nama_upacara]" class="form-control @error('data_upacara[0][nama_upacara]') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->nama_upacara}}" readonly>
                                                    @error('data_upacara[0][nama_upacara]')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $errors->first('data_upacara[0][nama_upacara]') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi Upacara</label>
                                                    <textarea readonly class="form-control @error('data_upacara[0][deskripsi_upacara]') is-invalid @enderror" rows="3" name="data_upacara[0][deskripsi_upacara]">{{$dataReservasi->Upacaraku->deskripsi_upacaraku}}</textarea>
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
                                                        <input disabled name="data_upacara[0][daterange]"  id="dateUpacara" type='text' class='form-control float-right' value='{{date('d F Y ',strtotime($dataReservasi->Upacaraku->tanggal_mulai))}}  {{date('d F Y ',strtotime($dataReservasi->Upacaraku->tanggal_selesai))}}'>
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
                                                <label class="card-title my-auto">Semua Data Reservasi Upacara {{$dataReservasi->Upacaraku->nama_upacara}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-lg-4 mt-1" id="">
                                        {{-- <div class="callout callout-info container-fluid mb-4">
                                            <h5><i class="fas fa-info"></i> Catatan:</h5>
                                            <p class=" text-md">Pemuput Upacara dapat melakukan perubahan semua Data Reservasi, baik itu Reservasinya sendiri maupun Reservasi Pemuput Karya lain yang berstatus Proses Tangkil atau Pending.</p>
                                        </div> --}}

                                        {{-- Reservasi Sulinggih --}}
                                        <div class='card shadow mb-4'>
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
                                                                <td style='width: 18%'>{{$data->TahapanUpacara->nama_tahapan}}</td>
                                                                <td class='text-md-center'>
                                                                    <div class='input-group'>
                                                                        <div class='input-group-prepend'>
                                                                            <span class='input-group-text'>
                                                                                <i class='far fa-calendar-alt'></i>
                                                                            </span>
                                                                        </div>
                                                                        <input disabled name='data_user_reservasi[{{$loop->iteration}}][daterange]' id="dateUser-{{$data->id}}" type='text' class='form-control float-right' value=''>
                                                                    </div>
                                                                </td>
                                                                <td style="width: 25%">
                                                                    <div class="form-group">
                                                                        <select name='data_user_reservasi[{{$loop->iteration}}][status]' class="form-control select2bs4" style="width: 100%;" tabindex="-1" aria-hidden="true" id="status-{{$data->id}}">
                                                                        @if ($data->status == 'batal')
                                                                                    <option data-id="{{$data->id}}" @if ($data->status == 'batal') value="batal" selected @else value="batal" @endif>Batal</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input id="text_penolakan-{{$data->id}}" type="hidden" class="alasanPenolakan form-control" readonly name="data_user_reservasi[{{$loop->iteration}}][keterangan]" value="{{$data->keterangan}}" placeholder="Masukan alasan penolakan">
                                                                            </div>
                                                                        @elseif ($data->status == 'pending')
                                                                            <option data-id="{{$data->id}}" @if ($data->status == 'pending') value="pending" selected @else value="pending" @endif >Pending</option>
                                                                        @else
                                                                                    <option data-id="{{$data->id}}" @if ($data->status == 'diterima') value="diterima" selected @else value="diterima" @endif >Setujui</option>
                                                                                    <option data-id="{{$data->id}}" @if ($data->status == 'ditolak') value="ditolak" selected @else value="ditolak" @endif>Tolak</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input id="text_penolakan-{{$data->id}}" type="hidden" class="alasanPenolakan form-control" name="data_user_reservasi[{{$loop->iteration}}][keterangan]" value="" placeholder="Masukan alasan penolakan">
                                                                            </div>
                                                                        @endif
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
                                        {{-- Reservasi Sulinggih --}}

                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-12 my-1 px-4">
                                                <a href="{{route('pemuput-karya.muput-upacara.konfirmasi-tangkil.index')}}" class="btn btn-secondary">Kembali</a>
                                                <button onclick="konfirmasiReservasi()" type="button" class="btn m-1 btn-primary float-right ml-2">Konfimasi</button>
                                                <button onclick="batalTangkil({{$dataReservasi->id}},{{$dataReservasi->Upacaraku->id_krama}})" type="button" class="btn m-1 btn-danger float-right ml-2">Batal</button>
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

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Keterangan</h4>
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

    @include('pages.sanggar.manajemen-muput.modal-pembatalan-tangkil')


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

        //KONFIRMASI TANGKIL
        function konfirmasiReservasi(){
            Swal.fire({
                title: 'Pemberitahuan',
                text : 'Apakah anda ingin mengkonfirmasi penguleman krama tersebut?',
                icon:'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Iya`,
                denyButtonText: `Batal`,
                confirmButtonColor: '#3085d6',
                denyButtonColor : '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#formTangkil").submit();
                }
            })
        }
        //KONFIRMASI TANGKIL


        // DEKLARASI DATA RESERVASI
        let dataUpacara,dataReservasi, tanggalTangkil;
        let jsonDataUpacara = $('#jsonDataUpacara').val();
        let jsonDataReservasi = $('#jsonDataReservasi').val();
        dataUpacara = (JSON.parse(jsonDataUpacara));
        dataReservasi = (JSON.parse(jsonDataReservasi));

        let tanggal_mulai = dataReservasi.upacaraku.tanggal_mulai;
        let tanggal_selesai = dataReservasi.upacaraku.tanggal_selesai;


         // SET UP DATE UPACARA
         $('#dateUpacara').daterangepicker({
            timePicker: true,
            startDate: moment(tanggal_mulai).format('DD MMMM YYYY'),
            endDate:moment(tanggal_selesai).format('DD MMMM YYYY'),
            "minDate": moment(Date ()).format('DD MMMM YYYY'),
            locale: {
                format: 'DD MMMM YYYY',
            },
            drops: "up",
        });
        // SET UP DATE UPACARA

        // SET UP DATE RANGE RESERVASI SULINGGIH
        dataReservasi.detail_reservasi.forEach(data => {
            $('#dateUser-'+data.id).daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                startDate: moment(data.tanggal_mulai).format('DD MMMM YYYY H:mm'),
                endDate:moment(data.tanggal_selesai).format('DD MMMM YYYY H:mm'),
                minDate: moment(tanggal_mulai).format('DD MMMM YYYY H:mm'),
                maxDate: moment(tanggal_selesai).add(23,'hours').add(59,'minutes').format('DD MMMM YYYY H:mm'),
                locale: {
                    format: 'DD MMMM YYYY H:mm',
                },
                drops: "up",
            },function(start, end) {
                startDate = start;
                endDate = end;
            });
        });
        // SET UP DATE RANGE RESERVASI SULINGGIH

        // SET UP DATE RANGE RESERVASI SULINGGIH LAINNYA
        dataUpacara.forEach(data_reservasi =>{
            data_reservasi.detail_reservasi.forEach(data_detail_reservasi => {
                $('#datePemuput-'+data_detail_reservasi.id).daterangepicker({
                    timePicker: true,
                    timePicker24Hour: true,
                    startDate: moment(data_detail_reservasi.tanggal_mulai).format('DD MMMM YYYY H:mm'),
                    endDate:moment(data_detail_reservasi.tanggal_selesai).format('DD MMMM YYYY H:mm'),
                    minDate: moment(tanggal_mulai).format('DD MMMM YYYY H:mm'),
                    maxDate: moment(tanggal_selesai).add(23,'hours').add(59,'minutes').format('DD MMMM YYYY H:mm'),
                    locale: {
                        format: 'DD MMMM YYYY H:mm',
                    },
                    drops: "up",
                },function(start, end) {
                    startDate = start;
                    endDate = end;
                });

                $("#datePemuput-"+data_detail_reservasi.id).change(function () {
                    console.log(endDate)
                    if(startDate.format('DD MMMM YYYY H:mm') != moment(data_detail_reservasi.tanggal_mulai).format('DD MMMM YYYY H:mm') || moment(data_detail_reservasi.tanggal_selesai).format('DD MMMM YYYY H:mm') != endDate.format('DD MMMM YYYY H:mm')){
                        $('#keterangan_penolakan-'+data_detail_reservasi.id).empty();
                        $("#id_detail-" + data_detail_reservasi.id).attr('name','data_detail_reservasi['+data_detail_reservasi.id+'][id]');
                        $("#id_reservasi-" + data_detail_reservasi.id).attr('name','data_detail_reservasi['+data_detail_reservasi.id+'][id_reservasi]');
                        $("#datePemuput-" + data_detail_reservasi.id).attr('name', 'data_detail_reservasi['+data_detail_reservasi.id+'][date]');
                        $('#keterangan_penolakan-'+data_detail_reservasi.id).append("<div class='form-group'><input type='text' class='mt-3 form-control' name='data_detail_reservasi["+data_detail_reservasi.id+"][keterangan]' value='' placeholder='Masukan alasan penolakan'></div>");
                    }else{
                        $("#id_detail-" + data_detail_reservasi.id).attr('name','');
                        $("#reservationtime-" + data_detail_reservasi.id).attr('name','');
                        $('#keterangan_penolakan-'+data_detail_reservasi.id).empty();
                    }

                })

            })
        })

    </script>
@endpush

{{-- DATA UPACARA --}}
@push('js')
    <script>
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
                        var jenis = $('select[name="status['+key+']"').val();
                        text.type = "text";
                        text.value = data.keterangan;
                    }
                });
            }
        // FUNGSI GET DATA ALASAN DIDATABASE (**)


        // ADD FUNCTION ADD KOLOM ALASAN RESERVASI (**)
        $('select').change(function(){
            var id = $(this).find(':selected').data('id');
            if(id != undefined){
                var jenis = $(this).find(':selected').val();
                var text = document.getElementById("text_penolakan-"+id);
                if(jenis=='ditolak' || jenis=='batal' ){
                    text.type = "text";
                    getAlasanPenolakan();
                }else{
                    text.type = "hidden";
                    text.value = "";
                }
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
                            tanggal = moment(data.created_at).format('DD MMMM YYYY H:mm');
                            $('#timeline').append(
                                "<div><i class='fas fa-user bg-blue'></i><div class='timeline-item'>"+
                                "<h3 class='timeline-header'><a href='#'>"+data.relasi.sulinggih.nama_sulinggih+"</a> <p class='m-0 mt-1'>"+tanggal+"</p></h3>"+
                                "<div class='timeline-body'> Perubahan Reservasi : "+data.keterangan+" </div></div></div>"+
                                (key == response.data.length-1 ?  "<div><i class='fas fa-calendar-plus bg-green'></i><div class='timeline-item'><h3 class='timeline-header no-border'><a href='#'>"+dataReservasi.upacaraku.user.penduduk.nama+"</a> Membuat Upacara <p class='m-0 mt-1'>"+moment(dataReservasi.upacaraku.created_at).format('DD MMMM YYYY H:mm')+"</p></h3></div></div>" : "")+
                                (key == response.data.length-1 ? "<div><i class='fas fa-clock bg-gray'></i></div>" : "")

                            );
                        });
                    }else{
                        $('#timeline').empty();
                        $('#timeline').append("<div><i class='fas fa-calendar-plus bg-green'></i><div class='timeline-item'><h3 class='timeline-header no-border'><a href='#'>"+dataReservasi.upacaraku.user.penduduk.nama+"</a> Membuat Upacara <p class='m-0 mt-1'>"+moment(dataReservasi.upacaraku.created_at).format('DD MMMM YYYY H:mm')+"</p></h3></div></div><div><i class='fas fa-clock bg-gray'></i></div>");
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

{{-- VALIDASI --}}
@push('js')

    <script src="{{asset('base-template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/jquery-validation/additional-methods.min.js')}}"></script>

    <script>
        // ADD FUNCTION VALIDATE FORM INPUT
        // $(function () {
        //     $.validator.setDefaults({
        //         submitHandler: function () {
        //             // stepper.next()
        //             // setDataToRangkuman();
        //                 console.log(tanggal_mulai)
        //         }
        //     });
        //     $('#postData').validate({
        //         rules: {
        //         'data_user_reservasi[0][daterange]': {
        //             required: true,
        //             validationDate:true
        //         },
        //         },
        //         messages: {
        //         'data_user_reservasi[0][daterange]': {
        //             required: "Tanggal reservasi wajib diisi",
        //             date: "Masukan tanggal dengan benar",
        //             validationDate : "Tanggal yang anda masukan tidak sesuai dengan tanggal upacara"
        //         },
        //         },
        //         errorElement: 'span',
        //         errorPlacement: function (error, element) {
        //             error.addClass('invalid-feedback');
        //             element.closest('.form-group').append(error);
        //         },
        //         highlight: function (element, errorClass, validClass) {
        //             $(element).addClass('is-invalid');
        //         },
        //         unhighlight: function (element, errorClass, validClass) {
        //             $(element).removeClass('is-invalid');
        //         }
        //     });
        // });
        // ADD FUNCTION VALIDATE FORM INPUT

        // ADD FUNCTION VALIDATE DATE RANGE
        jQuery.validator.addMethod("validationDate", function(value, element){
            // var tanggal_mulai = moment(dataUpacara.tanggal_mulai).format('YYYY-MM-DD')
            // var tanggal_selesai = moment(dataUpacara.tanggal_selesai).format('YYYY-MM-DD')

            // moment(tanggal_awal).isBetween(tanggal_mulai, tanggal_selesai, undefined, '[]');

            const dateNew  = value.split(" - ");
            var tanggal_awal = moment(dateNew[0]).format('YYYY-MM-DD');
            var tanggal_akhir = moment(dateNew[1]).format('YYYY-MM-DD');
            if(moment(tanggal_awal).isBetween(tanggal_mulai, tanggal_selesai, undefined, '[]') == true && moment(tanggal_akhir).isBetween(tanggal_mulai, tanggal_selesai, undefined, '[]') ){
                return true;
            }else{
                return false;
            }
        }, "Masukan tanggal dan waktu dengan benar!");
        // ADD FUNCTION VALIDATE DATE RANGE
    </script>

@endpush
{{-- VALIDASI --}}



