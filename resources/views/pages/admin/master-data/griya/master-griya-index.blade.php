@extends('layouts.admin.admin-layout')
@section('tittle','Data Lokasi Griya / Puri')

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
                    <h1>Master Data Lokasi Griya & Puri</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Griya & Puri</li>
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
                                    <h3 class="card-title">List Data Griya & Puri</h3>
                                </div>
                                <div class="col-6">
                                    <a title="Tambah Data" class="btn btn-primary float-right" href="{{route('admin.master-data.griya.create')}}"><i class="fa fa-plus"></i> Tambah</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Griya / Puri</th>
                                        <th>Alamat Griya / Puri</th>
                                        <th>Lokasi Desa Dinas</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataGriya as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->nama_griya_rumah}}</td>
                                            <td>{{$data->alamat_griya_rumah}}</td>
                                            <td>{{$data->BanjarDinas->nama_banjar_dinas}}</td>
                                            <td>
                                                <a title="Detail Data" href="{{route('admin.master-data.griya.detail',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                <a title="Ubah Data" href="{{route('admin.master-data.griya.edit',$data->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <a title="Hapus Data" onclick="deleteData({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                            <form id="{{"delete-".$data->id}}" class="d-none" action="{{route('admin.master-data.griya.delete')}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" class="d-none" name="id" value="{{$data->id}}">
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Griya / Puri</th>
                                        <th>Alamat Griya / Puri</th>
                                        <th>Lokasi Desa Dinas</th>
                                        <th>Tindakan</th>
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

    <script type="text/javascript">
        function deleteData(index){
            Swal.fire({
                title: 'Peringatan',
                text : 'Apakah anda yakin akan menghapus Data Griya tersebut?',
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
            $('#side-griya').addClass('active');
        });
    </script>

    <!-- Fungsi Ajax Get Data  -->
    <script language="javascript" type="text/javascript">
        $('#kabupaten').on('change', function() {
            var kabupatenID = $(this).val();
            if(kabupatenID){
                $.ajax({
                       url: '/ajax/kecamatan/'+kabupatenID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(dataKecamatan)
                        {
                            console.log(kabupatenID);
                            console.log(dataKecamatan.data.kecamatans);

                            if(dataKecamatan.data.kecamatans){
                                $('#kecamatan').empty();
                                $('#kecamatan').append('<option value="0" disabled selected>Pilih Kecamatan</option>');
                                $.each(dataKecamatan.data.kecamatans, function(key, data){
                                    $('#kecamatan').append('<option value="'+ data.id_kecamatan +'">' + data.name+ '</option>');
                                });
                            }else{
                                $('#course').empty();
                            }
                        }
                    })
            }else{
                $('#course').empty();
            }
        })

        $('#kecamatan').on('change', function() {
            var kecamatanID = $(this).val();
            if(kecamatanID){
                $.ajax({
                       url: '/ajax/desa/'+kecamatanID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(dataDesa)
                        {
                            console.log(kecamatanID);
                            console.log(dataDesa.data.desas);

                            if(dataDesa.data.desas){
                                $('#desa_dinas').empty();
                                $('#desa_dinas').append('<option value="0" disabled selected>Pilih Desa Dinas</option>');
                                $.each(dataDesa.data.desas, function(key, data){
                                    $('#desa_dinas').append('<option value="'+ data.id_desa +'">' + data.name+ '</option>');
                                });
                            }else{
                                $('#course').empty();
                            }
                        }
                    })
            }else{
                $('#course').empty();
            }
        })
    </script>
    <!-- Fungsi Ajax Get Data  -->


@endpush
