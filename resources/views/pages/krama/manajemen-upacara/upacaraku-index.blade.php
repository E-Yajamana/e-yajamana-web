@extends('layouts.krama.krama-layout')
@section('tittle','Data Upacaraku')

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
                    <h1>List Data Upacaraku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Upacaraku</li>
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
                                    <h3 class="card-title">Filter Upacaraku</h3>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-primary float-right" type="button" href="{{route('krama.manajemen-upacara.upacaraku.create')}}"> <i class="fa fa-plus"></i> Tambah Upacaraku</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Semua</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Pending</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Proses Muput Upacara</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Selesai</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Batal</a></li>
                                    </ul>
                                </div>
                                <div class="col-5">
                                    <select class="form-control select2bs4" style="width: 100%;" aria-placeholder="ada">
                                        <option >Jenis Yadnya</option>
                                        <option>Dewa Yadnya</option>
                                        <option>Pitra Yadnya</option>
                                        <option>Manusa Yadnya</option>
                                        <option>Rsi Yadnya</option>
                                        <option>Bhuta Yadnya</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.card -->

                    <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                        {{-- Start Data Table Sulinggih --}}
                        <div class="card-header my-auto">
                            <h3 class="card-title my-auto">List Data Upacara</h3>
                        </div>

                        <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                            <div class="card-body p-0">
                                <div class="table-responsive mailbox-messages p-2">
                                    <table id="example2" class="table table-striped table-hover mx-auto table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Upacara</th>
                                                <th>Jenis Upacara</th>
                                                <th>Status Upacara</th>
                                                <th>Tanggal Upacara</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataUpacaraku as $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$data->nama_upacara}}</td>
                                                    <td>{{$data->Upacara->kategori_upacara}}</td>
                                                    <td>
                                                        <span @if ($data->status == 'pending') class="bg-secondary btn-sm" @elseif ($data->status == 'selesai') class="bg-success btn-sm" @elseif ($data->status == 'proses muput' OR  $data->status == 'proses tangkil') class="bg-info btn-sm"
                                                        @else class="bg-danger btn-sm"
                                                        @endif style="border-radius: 5px; width:70px;">{{$data->status}}</span>
                                                    </td>
                                                    <td>{{date('d-M-Y',strtotime($data->tanggal_mulai))}} - {{date('d-M-Y',strtotime($data->tanggal_selesai))}} </td>
                                                    <td>
                                                        <a href="{{route('krama.manajemen-upacara.upacaraku.detail',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
                                                <th>Action</th>
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
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <!-- Page specific script -->
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
            $('#side-upacara').addClass('menu-open');
            $('#side-kabupaten').addClass('active');

            $('#mySelect2').select2('data');
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>

@endpush
