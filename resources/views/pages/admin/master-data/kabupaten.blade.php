@extends('layouts.admin.admin-layout')
@section('tittle','Data Kabupaten')

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
                    <h1>Data Kabupaten</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Kabupaten</li>
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
                                    <h3 class="card-title">Data Kabupaten Sistem E-Yajamana</h3>
                                </div>
                                {{-- <div class="col-6">
                                    <button class="btn btn-primary float-right" type="button"  data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</button>
                                </div> --}}
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
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
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
                                        <td>2</td>
                                        <td>KB02</td>
                                        <td>Denpasar</td>
                                        <td>Bali</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>KB03</td>
                                        <td>Gianyar</td>
                                        <td>Bali</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr> --}}
                                    {{-- {{ $i=0}} --}}
                                    @foreach ($result['kabupaten'] as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data['id']}}</td>
                                        <td>{{$data['name']}}</td>
                                        <td>{{$result['name']}}</td>
                                    </tr>

                                        {{-- {{$i+=$i++}} --}}
                                    @endforeach
                                    {{-- <tr>
                                        <td>4</td>
                                        <td>KB04</td>
                                        <td>Buleleng</td>
                                        <td>Bali</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr> --}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kabupaten</th>
                                        <th>Nama Kabupaten</th>
                                        <th>Nama Provinsi</th>
                                        {{-- <th>Action</th> --}}
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
                    <h4 class="modal-title">Tambah Kabupaten</h4>
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
                            <label for="exampleInputEmail1">Kode Kabupaten</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukan Kode Kabupaten">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Kabupaten</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Kabupaten">
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
            $('#side-kabupaten').addClass('active');
        });
    </script>

@endpush
