@extends('layouts.admin.admin-layout')
@section('tittle','List Data Akun')

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
                    <h1>Data Akun User E-Yajamana</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Akun User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <h3 class="card-title">Katagori Akun</h3>
                                </div>
                            </div>

                            <div class="nav flex-column nav-pills card-body p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a id="sulinggih-tabs" href="#sulinggih-table" class="nav-link active" data-toggle="pill" role="tab" aria-controls="sulinggih-table" aria-selected="true">
                                            Sulinggih <span class="badge bg-warning float-right">5</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="pemangku-tabs"  href="#pemangku-table" class="nav-link" data-toggle="pill" role="tab" aria-controls="pemangku-table" aria-selected="false">
                                            Pemangku <span class="badge bg-warning float-right">15</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="sanggar-tabs" href="#sanggar-table" class="nav-link" data-toggle="pill" role="tab" aria-controls="sanggar-table" aria-selected="false">
                                            Sanggar <span class="badge bg-warning float-right">2</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="serati-tabs" data-toggle="pill" href="#serati-table" role="tab" aria-controls="serati-table" aria-selected="false">
                                            Serati <span class="badge bg-warning float-right">8</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="krama-tabs" href="#krama-table" class="nav-link" data-toggle="pill" role="tab" aria-controls="krama-table" aria-selected="false">
                                            Krama Bali <span class="badge bg-warning float-right">4</span>
                                        </a>
                                    </li>
                                  </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                            <div class="card-header my-auto">
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="card-title my-auto">Preview List Data Akun</h3>
                                    </div>
                                    <div class="col-6">
                                        <a class="btn btn-primary float-right" href=""><i class="fa fa-plus"></i> Tambah</a>
                                    </div>
                                </div>
                            </div>

                            {{-- Start Data Table Sulinggih --}}
                            <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-sulinggih" class="table table-striped table-hover mx-auto table-responsive-sm">
                                            <thead >
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Sulinggih</th>
                                                    <th>Lokasi Griya</th>
                                                    <th>Nomor Telepon</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Ida Begawan Agre Segening</td>
                                                    <td>Griya Kerebokan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Ida Cri Bhagawan Sabda Murti</td>
                                                    <td>Griya Pemecutan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Ida Bujangga Rsi Adi Guru</td>
                                                    <td>Griya Pemecutan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- End Data Table Sulinggih --}}

                            {{-- Start Data Table Pemangku --}}
                            <div class="tab-pane fade" id="pemangku-table" role="tabpanel" aria-labelledby="pemangku-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-pemangku" class="table table-striped table-hover ">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Pemangku</th>
                                                    <th>Alamat Pemangku</th>
                                                    <th>Nomor Telepon</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>I Wayan Sutama</td>
                                                    <td>Griya Kerebokan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>I Wayan Darma</td>
                                                    <td>Griya Pemecutan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>I Gede Adi Catra</td>
                                                    <td>Griya Pemecutan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- END Data Table Pemangku --}}

                            {{-- Start Data Table Sanggar --}}
                            <div class="tab-pane fade" id="sanggar-table" role="tabpanel" aria-labelledby="sanggar-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-sanggar" class="table table-striped table-hover mx-auto table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Sanggar</th>
                                                    <th>Alamat Sanggar</th>
                                                    <th>Nomor Telepon</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>I Wayan Sutama</td>
                                                    <td>Griya Kerebokan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>I Wayan Darma</td>
                                                    <td>Griya Pemecutan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>I Gede Adi Catra</td>
                                                    <td>Griya Pemecutan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- End Data Table Sanggar --}}

                            {{-- Start Data Table Serati --}}
                            <div class="tab-pane fade" id="serati-table" role="tabpanel" aria-labelledby="serati-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-serati" class="table table-striped table-hover mx-auto table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Serati</th>
                                                    <th>Alamat Serati</th>
                                                    <th>Nomor Telepon</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>I Wayan Sutama</td>
                                                    <td>Griya Kerebokan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>I Wayan Darma</td>
                                                    <td>Griya Pemecutan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>I Gede Adi Catra</td>
                                                    <td>Griya Pemecutan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- END Data Table Sanggar --}}

                            {{-- START Data Table Krama Bali --}}
                            <div class="tab-pane fade" id="krama-table" role="tabpanel" aria-labelledby="krama-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-krama" class="table table-striped table-hover mx-auto table-responsive-sm">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Krama</th>
                                                    <th>Nomor Telepon</th>
                                                    <th>Alamat Krama</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>I Wayan Sutama</td>
                                                    <td>081462756246</td>
                                                    <td>Griya Kerebokan</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>I Wayan Darma</td>
                                                    <td>Griya Pemecutan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>I Gede Adi Catra</td>
                                                    <td>Griya Pemecutan</td>
                                                    <td>081462756246</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- END Data Table Krama Bali --}}

                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script src="{{ asset('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-data-akun').addClass('menu-open');
        });

        $(function () {
            $("#tb-sulinggih").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Akun Sulinggih",
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

            $("#tb-pemangku").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Akun Pemangku",
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

            $("#tb-sanggar").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Akun Sanggar",
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

            $("#tb-serati").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Akun Serati",
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

            $("#tb-krama").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Akun Krama",
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

@endpush
