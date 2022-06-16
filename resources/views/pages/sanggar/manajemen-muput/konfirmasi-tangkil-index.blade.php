@extends('layouts.sanggar.sanggar-layout')
@section('tittle','Data Penguleman Krama')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('countTangkil')
    {{-- {{$dataReservasi->where('tanggal')}}
    <span class="badge badge-primary right">{{count($count)}}</span> --}}
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Penguleman Krama</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('pemuput-karya.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Penguleman Krama</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="container-fluid">
        <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
            <div class="card-header my-auto">
                <h3 class="card-title my-auto">List Data Kedatangan Krama </h3>
            </div>

            {{-- Start Data Table Sulinggih --}}
            <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages p-2">
                        <table id="example2" class="table table-bordered table-hover mx-auto table-responsive-sm">
                            <thead >
                                <tr>
                                    <th>No</th>
                                    <th>Nama Krama </th>
                                    <th>Lokasi Upacara</th>
                                    <th>Batas Waktu Penguleman</th>
                                    <th>Tahapan Reservasi</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataReservasi as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td style="width: 13%">
                                            {{$data->Upacaraku->User->Penduduk->nama}}
                                        </td>
                                        <td style="width: 18%"> {{$data->Upacaraku->alamat_upacaraku}}</td>
                                        <td>{{date('d F Y | H:i ',strtotime($data->tanggal_tangkil))}}</td>
                                        <td>
                                            <label>{{$data->Upacaraku->Upacara->kategori_upacara}} | {{$data->Upacaraku->Upacara->nama_upacara}}</label>
                                            @foreach ($data->DetailReservasi as $dataDetail)
                                                <li>{{$dataDetail->TahapanUpacara->nama_tahapan}}</li>
                                            @endforeach
                                        </td>
                                        <td style="width: 15%">
                                            {{-- <a title="Detail Data" href="{{route('pemuput-karya.muput-upacara.konfirmasi-tangkil.detail',$data->id)}}" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a> --}}
                                            <a title="Edit Data"  href="{{route('sanggar.muput-upacara.konfirmasi-tangkil.edit',$data->id)}}"  class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a title="Konfirmasi Tangkil" href="{{route('sanggar.muput-upacara.konfirmasi-tangkil.edit',$data->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Krama </th>
                                    <th>Lokasi Upacara</th>
                                    <th>Batas Waktu Penguleman</th>
                                    <th>Tahapan Reservasi</th>
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

    <!-- daterangepicker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>

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
            $('#side-manajemen-muput-upacara').addClass('menu-open');
            $('#side-manajemen-muput-upacara-konfirmasi-tangkil').addClass('active');
        });
    </script>
@endpush

{{-- @push('js')
    <script type="text/javascript">
        function cekTanggalTangkil(tanggal_tangkil){
            Swal.fire({
                icon: 'info',
                title: 'Pemberitahuan',
                text: 'Anda baru dapat mengakses fitur tersebut pada tanggal '+moment(tanggal_tangkil).format('DD MMMM YYYY') ,
            });
        }
    </script>
@endpush --}}