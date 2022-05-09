@extends('layouts.krama.krama-layout')
@section('tittle','Data Upacara')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Upacara Krama</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('krama.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Upacara</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline tab-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title">Filter Upacara</h3>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-primary float-right" type="button" href="{{route('krama.manajemen-upacara.upacaraku.create')}}"> <i class="fa fa-plus"></i> Tambah Upacara</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <ul class="nav nav-pills" id="filterStatus" >
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab">Semua</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab">Pending</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab">Berlangsung</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab">Selesai</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab">Batal</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-5">
                                    <select id="filterJenisYadnya" class="form-control select2bs4" style="width: 100%;" aria-placeholder="ada">
                                        <option value="Semua">Jenis Yadnya</option>
                                        <option value="Dewa Yadnya">Dewa Yadnya</option>
                                        <option value="Pitra Yadnya">Pitra Yadnya</option>
                                        <option value="Manusa Yadnya">Manusa Yadnya</option>
                                        <option value="Rsi Yadnya">Rsi Yadnya</option>
                                        <option value="Bhuta Yadnya">Bhuta Yadnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                        <div class="card-header my-auto">
                            <h3 class="card-title my-auto">List Data Upacara</h3>
                        </div>

                        <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                            <div class="card-body p-0">
                                <div class="table-responsive mailbox-messages p-2">
                                    <table id="example2" class="table mx-auto table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Upacara</th>
                                                <th>Jenis Upacara</th>
                                                <th>Status Upacara</th>
                                                <th>Tanggal Upacara</th>
                                                <th style="width: 15%" class="text-center">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataUpacara">
                                            @foreach ($dataUpacaraku as $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$data->nama_upacara}}</td>
                                                    <td>{{$data->Upacara->kategori_upacara}}</td>
                                                    <td class="d-flex text-center">
                                                        <span @if ($data->status == 'pending') class="bg-secondary btn-sm" @elseif ($data->status == 'berlangsung') class="bg-primary btn-sm" @elseif ($data->status == 'selesai') class="bg-success btn-sm" @else class="bg-danger btn-sm" @endif style="border-radius: 5px; width:100px;">{{Str::ucfirst($data->status)}}</span>
                                                    </td>
                                                    <td>{{date('d F Y',strtotime($data->tanggal_mulai))}} - {{date('d F Y',strtotime($data->tanggal_selesai))}} </td>
                                                    <td class="text-center">
                                                        <a title="Detail Upacara" href="{{route('krama.manajemen-upacara.upacaraku.detail',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        @if ($data->status == 'pending')
                                                            <a title="Ubah Upacara" href="{{route('krama.manajemen-upacara.upacaraku.edit',$data->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                            <button title="Batal Upacara" onclick="deleteUpacara({{$data->id}},{{{$data->reservasi_count}}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Upacara</th>
                                                <th>Jenis Upacara</th>
                                                <th>Status Upacara</th>
                                                <th>Tanggal Upacara</th>
                                                <th style="width: 15%" class="text-center">Tindakan</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    @include('pages.krama.manajemen-upacara.modal-pembatalan-upacara')

@endsection

@push('js')
    <!-- DataTablbase-template Plugins -->
    <script src="{{asset('base-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>

    <!-- SCRIPT FILTERING DATATABLES -->
    <script type="text/javascript">
        var jenisYadnya,statusUpacara,dataUpacara;
        statusUpacara = "Semua"

        $(document).ready(function(){
            $('#side-upacara').addClass('menu-open');
            $('#side-data-upacara').addClass('active');
        });

        var table = $('#example2').DataTable({
            "ordering": false,
            "searching": true,
            "order": [[ 1, 'asc' ]],
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

        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();


        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                jenisYadnya =  $('#filterJenisYadnya').find(":selected").val();
                var test  = $('#filterStatus li').find('a.active').text();

                var jenisUpacaraData = data[2];
                var statusData = data[3];

                console.log(test)
                // console.log(statusData)

                if((jenisYadnya == "Semua"  && statusUpacara == null  ) || (jenisYadnya == "Semua" && statusUpacara == statusData ) || (statusUpacara == "Semua" && jenisUpacaraData == jenisYadnya) || (statusUpacara == "Semua" && jenisYadnya == "Semua")){
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
            $(this).addClass("active");
            statusUpacara  = $('#filterStatus li').find('a.active').text();
            table.draw();

        });

    </script>
    <!-- SCRIPT FILTERING DATATABLES -->
@endpush

