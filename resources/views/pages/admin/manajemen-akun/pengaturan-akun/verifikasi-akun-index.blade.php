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
                    <h1>Konfirmasi Akun</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"> Data Verifikasi</li>
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
                                <div class="row">
                                    <h3 class="card-title">Kategori Akun</h3>
                                </div>
                            </div>

                            <div class="nav flex-column nav-pills card-body p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a id="sulinggih-tabs" href="#sulinggih-table" class="nav-link active" data-toggle="pill" role="tab" aria-controls="sulinggih-table" aria-selected="true">
                                            Sulinggih <span class="badge bg-warning float-right">{{count($dataSulinggih)}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="pemangku-tabs"  href="#pemangku-table" class="nav-link" data-toggle="pill" role="tab" aria-controls="pemangku-table" aria-selected="false">
                                            Pemangku <span class="badge bg-warning float-right">{{count($dataPemangku)}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="sanggar-tabs" href="#sanggar-table" class="nav-link" data-toggle="pill" role="tab" aria-controls="sanggar-table" aria-selected="false">
                                            Sanggar <span class="badge bg-warning float-right">{{count($dataSanggar)}}</span>
                                        </a>
                                    </li>
                                  </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                            <div class="card-header my- auto">
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="card-title my-auto">List Akun Belum Terverifikasi</h3>
                                    </div>
                                </div>
                            </div>

                            {{-- SULINGGIH --}}
                            <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-sulinggih" class="table table-hover mx-auto table-responsive-sm">
                                            <thead >
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Sulinggih</th>
                                                    <th>Lokasi Griya</th>
                                                    <th>Tanggal Mendaftar</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataSulinggih as $data)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->nama_pemuput}}</td>
                                                        <td>{{$data->GriyaRumah->nama_griya_rumah}}</td>
                                                        <td>{{date('d F Y',strtotime($data->created_at))}}</td>
                                                        <td>
                                                            <a title="Detail Data" href="{{route('admin.manajemen-akun.verifikasi.detail.pemuput-karya',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                            <a title="Terima Akun" onclick="terimaPemuput({{$data->id}})" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                                            <a title="Tolak Akun" onclick="tolakPemuput({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Sulinggih</th>
                                                    <th>Lokasi Griya</th>
                                                    <th>Tanggal Mendaftar</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- SULINGGIH --}}

                            {{-- PEMANGKU --}}
                            <div class="tab-pane fade" id="pemangku-table" role="tabpanel" aria-labelledby="pemangku-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-pemangku" class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Pemangku</th>
                                                    <th>Nomor Telepon</th>
                                                    <th>Tanggal Mendaftar</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataPemangku as $data)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->nama_pemuput}}</td>
                                                        <td>{{$data->User->nomor_telepon}}</td>
                                                        <td>{{date('d F Y',strtotime($data->created_at))}}</td>
                                                        <td>
                                                            <a title="Detail Data" href="{{route('admin.manajemen-akun.verifikasi.detail.pemuput-karya',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                            <a title="Terima Akun" onclick="terimaPemuput({{$data->id}})" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                                            <a title="Tolak Akun" onclick="tolakPemuput({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Pemangku</th>
                                                    <th>Nomor Telepon</th>
                                                    <th>Tanggal Mendaftar</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- PEMANGKU --}}

                            {{-- SANGGAR --}}
                            <div class="tab-pane fade" id="sanggar-table" role="tabpanel" aria-labelledby="sanggar-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-sanggar" class="table table-hover mx-auto table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Sanggar</th>
                                                    <th>Alamat Sanggar</th>
                                                    <th>Tanggal Mendaftar</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataSanggar as $data)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->nama_sanggar}}</td>
                                                        <td>{{$data->alamat_sanggar}}</td>
                                                        <td>{{date('d F Y',strtotime($data->created_at))}}</td>
                                                        <td>
                                                            <a title="Detail Data" href="{{route('admin.manajemen-akun.verifikasi.detail.sanggar',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                            <a title="Terima Akun" onclick="terimaSanggar({{$data->id}})" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                                            <a title="Tolak Akun" onclick="tolakSanggar({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- SANGGAR --}}


                            {{-- SERATI --}}
                            {{-- <div class="tab-pane fade" id="serati-table" role="tabpanel" aria-labelledby="serati-tabs">
                                <div class="card-body p-0">
                                    <div class="table-responsive mailbox-messages p-2">
                                        <table id="tb-serati" class="table table-hover mx-auto table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Walaka</th>
                                                    <th>Nama Serati</th>
                                                    <th>Tanggal Mendaftar</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataSerati as $data)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->User->Penduduk->nama}}</td>
                                                        <td>{{$data->nama_serati}}</td>
                                                        <td>{{date('d F Y',strtotime($data->created_at))}}</td>
                                                        <td>
                                                            <a title="Detail Data" href="{{route('admin.manajemen-akun.verifikasi.detail.serati',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                            <a title="Terima Akun" onclick="terimaSerati({{$data->id}})" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                                            <a title="Tolak Akun" onclick="tolakSerati({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- SERATI --}}

                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>

    @include('pages.admin.manajemen-akun.pengaturan-akun.modal-konfirmasi-pemuput')
    @include('pages.admin.manajemen-akun.pengaturan-akun.modal-konfirmasi-sanggar')
    @include('pages.admin.manajemen-akun.pengaturan-akun.modal-konfirmasi-serati')


@endsection

@push('js')
    <!-- Library Template yang digunkanan -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-pengaturan-akun').addClass('menu-open');
            $('#side-konfirmasi-sulinggih').addClass('active');
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
        });
    </script>
    <!-- Library Template yang digunkanan -->
        <script src="{{ asset('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('base-template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
     <!-- Library Template yang digunkanan -->

@endpush


