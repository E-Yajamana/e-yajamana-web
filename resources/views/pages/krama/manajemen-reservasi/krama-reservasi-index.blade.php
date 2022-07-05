@extends('layouts.krama.krama-layout')
@section('tittle','Data Reservasi')

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
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Data Reservasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('krama.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Reservasi</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline tab-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title">Filter Reservasi</h3>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-primary float-right" type="button" onclick="addReservasi()"> <i class="fa fa-plus"></i> Tambah Reservasi</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <ul class="nav nav-pills" id="filterStatus">
                                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Semua</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Pending</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Proses Tangkil</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Proses Muput</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Selesai</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Batal</a></li>
                                    </ul>
                                </div>
                                <div class="col-4">
                                    <select id="filterJenisYadnya" class="form-control select2" style="width: 100%;" aria-placeholder="ada">
                                        <option value="Yadnya" >Jenis Yadnya</option>
                                        <option value="Dewa">Dewa Yadnya</option>
                                        <option value="Pitra">Pitra Yadnya</option>
                                        <option value="Manusa">Manusa Yadnya</option>
                                        <option value="Rsi">Rsi Yadnya</option>
                                        <option value="Bhuta">Bhuta Yadnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="card tab-content" id="v-pills-tabContent">
                        <!-- Main content -->
                        <div class="card-header my-auto">
                            <h3 class="card-title my-auto">List Data Reservasi</h3>
                        </div>
                        <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                            <div class="card-body p-0">
                                <div class="table-responsive mailbox-messages p-2">
                                    <table id="curriculum-students-dataTable" class="table mx-auto table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Upacara</th>
                                                <th>Pemuput Upacara</th>
                                                <th class='d-flex justify-content-center text-center'>Status Reservasi</th>
                                                <th>Tahapan Reservasi</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <input type="hidden" class="d-none" id="data" value='@json($data)'>

    @include('pages.krama.manajemen-reservasi.modal-batal-reservasi')

@endsection

@push('js')

<script type="text/javascript">
    var jenisYadnya,statusReservasi,dataUpacara;
    statusReservasi = "Semua"
    var model = $("#data").val()
    const dataReservasi = JSON.parse(model);

    $(document).ready(function(){
        $('#side-reservasi').addClass('menu-open');
        $('#side-data-reservasi').addClass('active');
    });

    var table = $('#curriculum-students-dataTable').DataTable({
        "aaData": dataReservasi,
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
            "emptyTable": "Tidak Terdapat Data Reservasi",
            "sSearchPlaceholder": "Cari data....",
            "infoEmpty": "Menampilkan 0 Data",
            "lengthMenu":     "Show _MENU_ ",
            "infoFiltered": "(dari _MAX_ data)",
        },
        rowsGroup: [0,1],
        "aoColumns": [
            {
                "data": "No",
                sDefaultContent: ""
            },
            {
                "data": "NamaUpacara",
                sDefaultContent: ""
            },
            {
                "data": "PemuputUpacara",
                sDefaultContent: ""
            },
            {
                "data": "statusReservasi",
                sDefaultContent: ""
            },
            {
                "data": "tahapanReservasi",
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
            jenisYadnya =  $('#filterJenisYadnya').find(":selected").val();

            var jenisUpacaraData = data[4];
            var statusData = data[3];
            // console.log(statusData)

            if((statusReservasi == "Semua" && jenisUpacaraData.includes(jenisYadnya)) || (statusReservasi == statusData && jenisUpacaraData.includes(jenisYadnya)) ){
                return true;
            }

            return false;
        }
    );

    $('#filterJenisYadnya').change( function() {
        statusUpacara = "Semua"
        table.draw();
    });

    $('#filterStatus li a').click(function(e) {
        $(".nav-link").removeClass("active");
        $('#side-data-reservasi').addClass('active');
        $(this).addClass("active");
        statusReservasi  = $('#filterStatus li').find('a.active').text();
        table.draw();

    });

</script>
@endpush
