@extends('layouts.admin.admin-layout')
@section('tittle','Data Kabupaten')


@push('css')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="base-template/plugins/fontawesome-free/css/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="base-template/dist/css/adminlte.min.css">
@endpush

@section('content')

    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Kabupaten</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Kabupaten</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Data Kabupaten Sistem E-Yajamana</h3>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary float-right"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Kabupaten</th>
                                <th>Nama Kabupaten</th>
                                <th>Nama Provinsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>KB01</td>
                                <td>Badung</td>
                                <td>Bali</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>KB01</td>
                                <td>Badung</td>
                                <td>Bali</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>KB01</td>
                                <td>Badung</td>
                                <td>Bali</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>KB01</td>
                                <td>Badung</td>
                                <td>Bali</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode Kabupaten</th>
                                <th>Nama Kabupaten</th>
                                <th>Nama Provinsi</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    <!-- /.content-wrapper -->

@endsection

@push('js')
    <!-- jQuery -->
    <script src="base-template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrabase-template-->
    <script src="base-template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTablbase-template Plugins -->
    <script src="base-template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="base-template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="base-template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="base-template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="base-template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="base-template/plugins/jszip/jszip.min.js"></script>
    <script src="base-template/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="base-template/plugins/pdfmake/vfs_fonts.js"></script>
    <!-- AdminLTEbase-template-->
    <script src="base-template/dist/js/adminlte.min.js"></script>
    <!-- AdminLTEbase-templatedemo purposes -->
    <script src="base-template/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
    $(function () {
        $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });

    </script>
@endpush
