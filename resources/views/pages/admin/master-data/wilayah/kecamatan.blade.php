@extends('layouts.admin.admin-layout')
@section('tittle','Data Kecamatan')

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
                    <h1>Data Kecamatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Kecamatan</li>
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
                                    <h3 class="card-title">Data Kecamatan Sistem E-Yajamana</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kecamatan</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Nama Kabupaten</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($dataKecamatan as $data)
                                        @foreach ($data->Kecamatan as $index =>$kecamatan)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$kecamatan->id}}</td>
                                                <td>{{$kecamatan->name}}</td>
                                                <td>{{$data->name}}</td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kecamatan</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Nama Kabupaten</th>
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

    <!-- /.modal-content -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kecamatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                </form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select class="form-control select2" style="width: 100%;">
                              <option selected="selected">Bali</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Badung</option>
                                <option >Denpasar</option>
                                <option >Gianyar</option>
                                <option >Buleleng</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Kecamatan</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukan Kode Kecamatan">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Kecamatan</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Kecamatan">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <button type="button" class="btn btn-primary" >Simpan</button>
                    </div>
                <form>
            </div>
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

    <!-- Page specific script -->
    <script>

        $(function () {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
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
            $('#side-master-data').addClass('menu-open');
            $('#side-kecamatan').addClass('active');
        });
    </script>

@endpush
