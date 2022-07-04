@extends('layouts.sanggar.sanggar-layout')
@section('tittle','Riwayat Reservasi')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datepicker/css/datepicker.css')}}">
@endpush


@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Riwayat Reservasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('sanggar.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Riwayat Reservasi</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="container-fluid">

        <div class="card card-outline card-primary tab-content" id="v-pills-tabContent">
            <div class="col-12" id="accordion">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                    <div class="card-header pl-1">
                        <div class="col-6 mx-0">
                            <h3 class="card-title text-dark">List Data Riwayat Reservasi</h3>
                        </div>
                        <div class="card-tools">
                            <button title="Filter Data" class="btn btn btn-tool">
                                <a data-toggle="collapse" href="#collapseOne">
                                    FILTER
                                    <i class="fas fa-filter"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                </a>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12 col-sm-6 pl-0">
                                <ul class="nav nav-pills" id="filterStatus">
                                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Semua</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Pending</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Proses Tangkil</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Proses Muput</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Selesai</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Batal</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="row">
                                    <div class="col-12  col-sm-4">
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input id="filterTanggal" type='text' class='form-control float-right' placeholder="Pilih tanggal" value="">
                                            <div class="input-group-prepend">
                                                <button class="input-group-text btn" type="button"  id="removeTanggal" >
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input id="filterBulan" type='text' class='form-control float-right' placeholder="Pilih bulan" value="">
                                            <div class="input-group-prepend">
                                                <button class="input-group-text btn" type="button"  id="removeBulan" >
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input id="filterTahun" type='text' class='form-control float-right' placeholder="Pilih tahun" value="">
                                            <div class="input-group-prepend">
                                                <button class="input-group-text btn" type="button"  id="removeTahun" >
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header p-0"></div>

            {{-- Start Data Table Sulinggih --}}
            <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages p-2">
                        <table id="example2" class="table table-bordered table-hover mx-auto table-responsive-sm">
                            <thead >
                                <tr>
                                    <th>No</th>
                                    <th>Penyelenggara </th>
                                    <th>Periode Upacara</th>
                                    <th>Tahapan Reservasi</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataReservasi as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td style="width: 20%">{{$data->Upacaraku->User->Penduduk->nama}}</td>
                                        <td style="width: 20%">{{date('d F Y',strtotime($data->Upacaraku->tanggal_mulai))}} - {{date('d F Y',strtotime($data->Upacaraku->tanggal_selesai))}}</td>
                                        <td>
                                            <label>{{$data->Upacaraku->Upacara->nama_upacara}} | {{$data->Upacaraku->Upacara->kategori_upacara}} </label>
                                            @foreach ($data->DetailReservasi as $dataDetail)
                                                <li >{{$dataDetail->TahapanUpacara->nama_tahapan}}</li>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <div  @if ($data->status == 'pending') class="bg-secondary btn-sm" @elseif ($data->status == 'proses tangkil' || $data->status == 'proses muput') class="bg-primary btn-sm" @elseif ($data->status == 'selesai') class="bg-success btn-sm" @else class="bg-danger btn-sm" @endif  style="border-radius: 5px; width:110px;">{{ucfirst($data->status)}}</div>
                                        </td>
                                        <td>
                                            <a href="{{route('sanggar.manajemen-reservasi.riwayat.detail',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Data Table Sulinggih --}}

        </div>
    </div>
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
@endpush

@push('js')
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('base-template/plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#side-manajemen-reservasi').addClass('menu-open');
            $('#side-manajemen-reservasi-riwayat').addClass('active');

            var table = $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari data....",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                }
            });

            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var filterTanggal = '';
                    var filterBulan = '';
                    var filterTahun = '';
                    var status = ''

                    const dateSplit  = data[2].split(" - ");
                    const dbStatus = data[4];
                    const dbDateStart = moment(dateSplit[0]).format('YYYY-MM-DD');
                    const dbDateEnd = moment(dateSplit[1]).format('YYYY-MM-DD');
                    const dbMonthStart = moment(dateSplit[0]).format('MM-YYYY');
                    const dbMonthEnd = moment(dateSplit[1]).format('MM-YYYY');
                    const dbYearStart = moment(dateSplit[0]).format('YYYY');
                    const dbYearEnd = moment(dateSplit[1]).format('YYYY');

                    if($("#filterTanggal").val() !== ''){
                        filterTanggal = moment($("#filterTanggal").val()).format('YYYY-MM-DD');
                    }
                    if($("#filterBulan").val() !== ''){
                        filterBulan = moment($("#filterBulan").val()).format('MM-YYYY');
                    }
                    if($("#filterTahun").val() !== ''){
                        filterTahun = moment($("#filterTahun").val()).format('YYYY');
                    }
                    if($('#filterStatus li').find('a.active').text() !== ''){
                        status = $('#filterStatus li').find('a.active').text();
                    }

                    if(
                        (moment(filterTanggal).isBetween(dbDateStart, dbDateEnd, undefined, '[]') == true && moment(filterTanggal).isBetween(dbDateStart, dbDateEnd, undefined, '[]') || filterTanggal === '') &&
                        ((filterBulan === dbMonthStart && filterBulan ===  dbMonthEnd) || (filterBulan === '' )) &&
                        ((filterTahun === dbYearStart && filterTahun ===  dbYearEnd) || filterTahun === '') &&
                        ((status === dbStatus) || (status === '') || (status === 'Semua') )
                    ){
                        return true;
                    }else{
                        return false;
                    }
                }
            );

            $('#filterTanggal').daterangepicker({
                "singleDatePicker": true,
                autoUpdateInput: false,
                locale: {
                    format: 'DD MMMM YYYY',
                },
            });

            $("#filterBulan").datepicker({
                format: "MM yyyy",
                viewMode: "months",
                minViewMode: "months"
            });

            $("#filterTahun").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });

            $('#filterTanggal').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD MMMM YYYY'));
                table.draw();
            });

            $('#filterBulan').change(function() {
                table.draw();
            });

            $('#filterTahun').change(function() {
                table.draw();
            });

            $('#removeTanggal').click(function(){
                $('#filterTanggal').val('');
                table.draw();
            });

            $('#removeBulan').click(function(){
                $('#filterBulan').val('');
                table.draw();
            });

            $('#removeTahun').click(function(){
                $('#filterTahun').val('');
                table.draw();
            });

            $('#filterStatus li a').click(function(e) {
                $(".nav-link").removeClass("active");
                $('#side-data-reservasi').addClass('active');
                $(this).addClass("active");
                statusReservasi  = $('#filterStatus li').find('a.active').text();
                table.draw();
            });

        });
    </script>
@endpush

