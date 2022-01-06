@extends('layouts.sulinggih.sulinggih-layout')
@section('tittle','Reservasi Krama Masuk')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush


@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Data Reservasi Krama</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Reservasi</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="card card-primary card-outline tab-content">
        <div class="card-header">
            <div class="row">
                <div class="col-6 my-2">
                    <h3 class="card-title">Filter Reservasi</h3>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-7">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Semua</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Diterima</a></li>
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Pending</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Ditolak</a></li>
                    </ul>
                </div>
            </div>

        </div>

    </div>


    <div class="container-fluid">
        <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
            <div class="card-header my-auto">
                <h3 class="card-title my-auto">Preview List Data Reservasi Krama</h3>
            </div>

            {{-- Start Data Table Sulinggih --}}
            <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages p-2">
                        <table id="example2" class="table table-striped table-hover mx-auto table-responsive-sm">
                            <thead >
                                <tr>
                                    <th>No</th>
                                    <th>Penyelenggara </th>
                                    <th>Jenis Upacara</th>
                                    <th>Tanggal Mulai - Tanggal Selesai</th>
                                    {{-- <th>Lokasi Upacara</th> --}}
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Krama Dalung</td>
                                    <td>Piodalan Ring Pura</td>
                                    <td>14-Desember-2021 - 16-Desember-2021</td>
                                    {{-- <td>Kuta Utara, Dalung</td> --}}
                                    <td>
                                        <div class=" bg-secondary btn-sm text-center" style="border-radius: 5px; width:70px;">Pending</div>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        {{-- <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                        <a onclick="" href="#" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Krama Dalung</td>
                                    <td>Piodalan Ring Pura</td>
                                    <td>14-Desember-2021 - 16-Desember-2021</td>
                                    {{-- <td>Kuta Utara, Dalung</td> --}}
                                    <td>
                                        <div class=" bg-secondary btn-sm text-center" style="border-radius: 5px; width:70px;">Pending</div>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        {{-- <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                        <a onclick="" href="#" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Krama Denpasar</td>
                                    <td>Ngeteg Lingih</td>
                                    <td>14-Desember-2021 - 16-Desember-2021</td>
                                    <td>
                                        <div class=" bg-danger btn-sm text-center" style="border-radius: 5px; width:70px;">Ditolak</div>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        {{-- <a onclick="" href="#" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                        <a onclick="" href="#" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a> --}}
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Penyelenggara </th>
                                    <th>Jenis Upacara</th>
                                    <th>Tanggal Mulai - Tanggal Selesai</th>
                                    {{-- <th>Lokasi Upacara</th> --}}
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </tfoot>
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

    <script>
        $(function () {
            $('#example2').DataTable({
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
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-manajemen-reservasi').addClass('menu-open');
            $('#side-manajemen-reservasi-riwayat').addClass('active');
        });
    </script>


@endpush
