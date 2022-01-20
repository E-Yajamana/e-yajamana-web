@extends('layouts.admin.admin-layout')
@section('tittle','Data Upacara')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data List Upacara E-Yajamana</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">E-Yajamana</a></li>
                        <li class="breadcrumb-item active">Data Upacara</li>
                     </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Katagori Yadnya</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="nav flex-column nav-pills card-body p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a id="sulinggih-tabs" href="#sulinggih-table" class="nav-link active" data-toggle="pill" role="tab" aria-controls="sulinggih-table" aria-selected="true">
                                            Dewa Yadnya <span class="badge bg-warning float-right">{{count($dataUpacara->where('katagori_upacara','Dewa Yadnya'))}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="pemangku-tabs"  href="#pemangku-table" class="nav-link" data-toggle="pill" role="tab" aria-controls="pemangku-table" aria-selected="false">
                                            Pitra Yadnya <span class="badge bg-warning float-right">{{count($dataUpacara->where('katagori_upacara','Pitra Yadnya'))}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="sanggar-tabs" href="#sanggar-table" class="nav-link" data-toggle="pill" role="tab" aria-controls="sanggar-table" aria-selected="false">
                                            Manusa Yadnya <span class="badge bg-warning float-right">{{count($dataUpacara->where('katagori_upacara','Manusa Yadnya'))}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="serati-tabs" data-toggle="pill" href="#serati-table" role="tab" aria-controls="serati-table" aria-selected="false">
                                            Rsi Yadnya <span class="badge bg-warning float-right">{{count($dataUpacara->where('katagori_upacara','Rsi Yadnya'))}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="krama-tabs" href="#krama-table" class="nav-link" data-toggle="pill" role="tab" aria-controls="krama-table" aria-selected="false">
                                            Bhuta Yadnya <span class="badge bg-warning float-right">{{count($dataUpacara->where('katagori_upacara','Bhuta Yadnya'))}}</span>
                                        </a>
                                    </li>
                                  </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                            <div class="card-header my-auto">
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="card-title my-auto">Preview List Data Upacara</h3>
                                    </div>
                                    <div class="col-6">
                                        <a class="btn btn-primary float-right" href="{{route('admin.master-data.upacara.create')}}"><i class="fa fa-plus"></i> Tambah</a>
                                    </div>
                                </div>
                            </div>

                            {{-- Start Data Table Dewa Yadnya --}}
                            <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-dewa-yadnya" class="table table-striped table-hover mx-auto table-responsive-sm">
                                            <thead >
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Upacara</th>
                                                    <th>Jumlah Tahapan</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataUpacara->where('katagori_upacara','Dewa Yadnya') as $data)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->nama_upacara}}</td>
                                                        <td>{{count($data->TahapanUpacara)}}</td>
                                                        <td>
                                                            <a href="{{route('admin.master-data.upacara.detail',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                            <a href="{{route('admin.master-data.upacara.edit',$data->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                            <a onclick="deleteData({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                            <form id="{{"delete-".$data->id}}" class="d-none" action="{{route('admin.master-data.upacara.delete')}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" class="d-none" name="id" value="{{$data->id}}">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- End Data Table Dewa Yadnya --}}

                            {{-- Start Data Table Pitra Yadnya --}}
                            <div class="tab-pane fade" id="pemangku-table" role="tabpanel" aria-labelledby="pemangku-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-pitra-yadnya" class="table table-striped table-hover ">
                                            <thead >
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Upacara</th>
                                                    <th>Jumlah Tahapan</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataUpacara->where('katagori_upacara','Pitra Yadnya') as $data)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->nama_upacara}}</td>
                                                        <td>{{count($data->TahapanUpacara)}}</td>
                                                        <td>
                                                            <a href="{{route('admin.master-data.upacara.detail',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                            <a href="{{route('admin.master-data.upacara.edit',$data->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                            <a onclick="deleteData({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                            <form id="{{"delete-".$data->id}}" class="d-none" action="{{route('admin.master-data.upacara.delete')}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" class="d-none" name="id" value="{{$data->id}}">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- END Data Table Pitra Yadnya --}}

                            {{-- Start Data Table Manusa Yadnya --}}
                            <div class="tab-pane fade" id="sanggar-table" role="tabpanel" aria-labelledby="sanggar-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-manusa-yadnya" class="table table-striped table-hover mx-auto table-responsive-sm">
                                            <thead >
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Upacara</th>
                                                    <th>Jumlah Tahapan</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataUpacara->where('katagori_upacara','Manusa Yadnya') as $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$data->nama_upacara}}</td>
                                                    <td>{{count($data->TahapanUpacara)}}</td>
                                                    <td>
                                                        <a href="{{route('admin.master-data.upacara.detail',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="{{route('admin.master-data.upacara.edit',$data->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a onclick="deleteData({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                        <form id="{{"delete-".$data->id}}" class="d-none" action="{{route('admin.master-data.upacara.delete')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" class="d-none" name="id" value="{{$data->id}}">
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- End Data Table Manusa Yadnya --}}

                            {{-- Start Data Table Rsi Yadnya --}}
                            <div class="tab-pane fade" id="serati-table" role="tabpanel" aria-labelledby="serati-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-rsi-yadnya" class="table table-striped table-hover mx-auto table-responsive-sm">
                                            <thead >
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Upacara</th>
                                                    <th>Jumlah Tahapan</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataUpacara->where('katagori_upacara','Rsi Yadnya') as $data)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->nama_upacara}}</td>
                                                        <td>{{count($data->TahapanUpacara)}}</td>
                                                        <td>
                                                            <a href="{{route('admin.master-data.upacara.detail',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                            <a href="{{route('admin.master-data.upacara.edit',$data->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                            <a onclick="deleteData({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                        <form id="{{"delete-".$data->id}}" class="d-none" action="{{route('admin.master-data.upacara.delete')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" class="d-none" name="id" value="{{$data->id}}">
                                                        </form>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- END Data Table Rsi Yadnya --}}

                            {{-- START Data Table Bhuta Yadnya --}}
                            <div class="tab-pane fade" id="krama-table" role="tabpanel" aria-labelledby="krama-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-bhuta-yadnya" class="table table-striped table-hover mx-auto table-responsive-sm">
                                            <thead >
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Upacara</th>
                                                    <th>Jumlah Tahapan</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataUpacara->where('katagori_upacara','Bhuta Yadnya') as $data)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->nama_upacara}}</td>
                                                        <td>{{count($data->TahapanUpacara)}}</td>
                                                        <td>
                                                            <a href="{{route('admin.master-data.upacara.detail',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                            <a href="{{route('admin.master-data.upacara.edit',$data->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                            <a onclick="deleteData({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                        <form id="{{"delete-".$data->id}}" class="d-none" action="{{route('admin.master-data.upacara.delete')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" class="d-none" name="id" value="{{$data->id}}">
                                                        </form>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- END Data Table Bhuta Yadnya --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script type="text/javascript">
        function deleteData(index){
            Swal.fire({
                title: 'Peringatan',
                text : 'Apakah anda yakin akan menghapus Data Upacara tersebut?',
                icon:'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Hapus`,
                denyButtonText: `Batal`,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-'+index).submit();
                    } else if (result.isDenied) {

                    }
                })
            }
    </script>


    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-upacara').addClass('active');
        });

        $(function () {
            $("#tb-dewa-yadnya").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Dewa Yadnya",
                    "sSearchPlaceholder": "Cari data....",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#tb-pitra-yadnya").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Pitra Yadnya",
                    "sSearchPlaceholder": "Cari data....",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#tb-manusa-yadnya").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Manusa Yadnya",
                    "sSearchPlaceholder": "Cari data....",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#tb-rsi-yadnya").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Rsi Yadnya",
                    "sSearchPlaceholder": "Cari data....",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#tb-bhuta-yadnya").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Bhuta Yadnya",
                    "sSearchPlaceholder": "Cari data....",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>

    {{-- Library Start --}}
        <script src="{{ asset('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('base-template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

        <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    {{-- Library Start --}}



@endpush
