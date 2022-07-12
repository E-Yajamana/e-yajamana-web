@extends('layouts.admin.admin-layout')
@section('tittle','Data Service Sanggar')

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
                    <h1>Master Data Service Sanggar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Service Sanggar</li>
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
                                    <label class="card-title my-auto">Daftar Service Sanggar</label>
                                </div>
                                <div class="col-6">
                                    <a onclick="create()" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Tambah</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Service</th>
                                        <th>Deskripsi Service</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td >{{$service->nama_service}}</td>
                                            <td style="width: 45%">{{Str::of($service->deskripsi_service)->limit(180);}}</td>
                                            <td>
                                                <a onclick="edit({{$service->id}},'{{$service->nama_service}}','{{$service->deskripsi_service}}')" title="Ubah Data" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <a onclick="deleteData({{$service->id}})" title="Hapus Data" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="modalForm" action="{{route('admin.master-data.service-sanggar.store-or-update')}}" method="POST">
                                @csrf
                                <input id="id" type="hidden" class="d-none" value="" name="id">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Service<span class="text-danger">*</span></label>
                                    <input type="text" id="nama_service" name="nama_service" class="form-control @error('nama_service') is-invalid @enderror" placeholder="Masukan Nama Service" >
                                    @error('nama_service')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('nama_service') }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Service <span class="text-danger">*</span></label>
                                    <textarea id="deskripsi_service" name="deskripsi_service"  class="form-control @error('deskripsi_service') is-invalid @enderror" rows="3" placeholder="Masukan deskripsi_service Service" ></textarea>
                                    @error('deskripsi_service')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('deskripsi_service') }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" id="btn">Buat Service</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <form id="formDelete" action="{{route('admin.master-data.service-sanggar.delete')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" class="d-none" id="idDelete" name="id" value="">
            </form>

        </div>
    </section>
    <!-- /.content -->
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
            var tabel = $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
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

            $('#side-master-data').addClass('menu-open');
            $('#side-service').addClass('active');

        });
    </script>
@endpush

@push('js')

<script>
    function create()
    {
        $('#btn').text('Buat Service');
        $('#exampleModalLabel').text('Form Tambah Service Sanggar');
        $('#exampleModal').modal('show');
    }


    function edit(id,nama,deskirpsi)
    {
        $('#btn').text('Ubah Service');
        $('#exampleModalLabel').text('Form Ubah Service Sanggar');

        $('#id').val(id);
        $('#nama_service').val(nama);
        $('#deskripsi_service').val(deskirpsi);
        $('#exampleModal').modal('show');
    }

    function deleteData(id)
    {
        Swal.fire({
            title: 'Peringatan',
            text : 'Apakah anda yakin akan menghapus Data Service Sanggar tersebut?',
            icon:'warning',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Hapus`,
            denyButtonText: `Batal`,
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#idDelete').val(id);
                $('#formDelete').submit();
            }
        })
    }

    @if ($errors->first('nama_service') || $errors->first('deskripsi_service'))
        setTimeout(function (){
            $('#exampleModal').modal('show');
        }, 2000);
    @endif
</script>

@endpush

