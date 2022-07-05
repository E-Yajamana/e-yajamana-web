@extends('layouts.pemuput-karya.pemuput-karya-layout')
@section('tittle','Data Muput Upacara')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">

    <!-- DataTablbase-template Plugins -->
    <script src="{{asset('base-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>

    <script src="{{asset('base-template/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('dataTables.rowsGroup.js')}}"></script>

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datepicker/css/datepicker.css')}}">
@endpush



@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jadwal Muput Upacara </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('pemuput-karya.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Muput Upacara</li>
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
                            <h3 class="card-title text-dark">List Data Muput Upacara Krama</h3>
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

            <div class="card-body p-1">
                <div class="table-responsive-sm table p-1">
                    <table id="curriculum-students-dataTable" class="table mx-auto table-responsive-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Penyelengara</th>
                                <th>Alamat</th>
                                <th>Tahapan Reservasi</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('pages.pemuput-karya.manajemen-muput-upacara.modal-konfirmasi-muput')

@endsection

@push('js')
<script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('base-template/plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#side-manajemen-muput-upacara').addClass('menu-open');
        $('#side-manajemen-muput-upacara-konfirmasi-muput-upacara').addClass('active');

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
    });
</script>

@endpush

@push('js')

    <script>
        $(document).ready(function () {

            const data = {!! json_encode($data) !!}
            var table = $('#curriculum-students-dataTable').DataTable({
                "aaData": data,
                "ordering": false,
                "searching": true,
                "order": [[ 1, 'asc' ]],
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Akun Sulinggih",
                    "sSearchPlaceholder": "Cari data....",
                    "infoEmpty": "Menampilkan 0 Data",
                    "lengthMenu":     "Show _MENU_ ",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                rowsGroup: [0,1,2],
                "aoColumns": [
                    {
                        "data": "No",
                        sDefaultContent: ""
                    },
                    {
                        "data": "Penyelengara",
                        sDefaultContent: ""
                    },
                    {
                        "data": "Alamat",
                        sDefaultContent: ""
                    },
                    {
                        "data": "tahapanReservasi",
                        sDefaultContent: ""
                    },
                    {
                        "data": "waktuMulai",
                        sDefaultContent: ""
                    },
                    {
                        "data": "waktuSelesai",
                        sDefaultContent: ""
                    },
                    {
                        "data": "tindakan",
                        sDefaultContent: ""
                    },
                ]
            });

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            }).draw();


            $.fn.DataTable.ext.search.push(
                function( settings, data, dataIndex ) {

                    var filterTanggal = '';
                    var filterBulan = '';
                    var filterTahun = '';

                    const dbDateStart = moment(data[4],'DD MMM YYYY | H:m').format('YYYY-MM-DD');
                    const dbDateEnd = moment(data[5],'DD MMM YYYY | H:m').format('YYYY-MM-DD');
                    const dbMonthStart = moment(data[4],'DD MMM YYYY | H:m').format('MM-YYYY');
                    const dbMonthEnd = moment(data[5],'DD MMM YYYY | H:m').format('MM-YYYY');
                    const dbYearStart = moment(data[4],'DD MMM YYYY | H:m').format('YYYY');
                    const dbYearEnd = moment(data[5],'DD MMM YYYY | H:m').format('YYYY');

                    if($("#filterTanggal").val() !== ''){
                        filterTanggal = moment($("#filterTanggal").val()).format('YYYY-MM-DD');
                    }
                    if($("#filterBulan").val() !== ''){
                        filterBulan = moment($("#filterBulan").val()).format('MM-YYYY');
                    }
                    if($("#filterTahun").val() !== ''){
                        filterTahun = moment($("#filterTahun").val()).format('YYYY');
                    }

                    if(
                        (moment(filterTanggal).isBetween(dbDateStart, dbDateEnd, undefined, '[]') == true && moment(filterTanggal).isBetween(dbDateStart, dbDateEnd, undefined, '[]') || filterTanggal === '') &&
                        ((filterBulan === dbMonthStart && filterBulan ===  dbMonthEnd) || (filterBulan === '' )) &&
                        ((filterTahun === dbYearStart && filterTahun ===  dbYearEnd) || filterTahun === '')
                    ){
                        return true;
                    }else{
                        return false;
                    }

                }
            );


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
        })
    </script>
@endpush
