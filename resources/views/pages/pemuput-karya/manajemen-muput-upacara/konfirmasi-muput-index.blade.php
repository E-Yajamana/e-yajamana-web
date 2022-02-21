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
                    <h1>Data Proses Muput Pemuput Karya</h1>
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

    <div class="container-fluid">
        <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
            <div class="card-header my-auto">
                <h3 class="card-title my-auto">List Data Reservasi Krama</h3>
            </div>

            {{-- Start Data Table Sulinggih --}}
            <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages p-2">
                        <table id="example2" class="table table-bordered table-hover mx-auto table-responsive-sm">
                            <thead >
                                <th>No</th>
                                <th>Nama Upacara</th>
                                <th>Penyelengara</th>
                                <th>Tahapan Reservasi</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                {{-- <th class='d-flex justify-content-center text-center'>Status Reservasi</th> --}}
                                <th>Tindakan</th>
                            </thead>
                            <tbody>
                                @foreach ($dataReservasi as $index => $data )
                                    <tr>
                                        <td rowspan="{{count($data->DetailReservasi)}}">{{$index+1}}</td>
                                        <td rowspan="{{count($data->DetailReservasi)}}">{{$data->Upacaraku->Krama->User->Penduduk->nama}}</td>
                                        <td rowspan="{{count($data->DetailReservasi)}}">{{$data->Upacaraku->Upacara->nama_upacara}}</td>
                                        <td class="pl-4">{{$data->DetailReservasi[0]->TahapanUpacara->nama_tahapan}}</td>
                                        <td>{{date('d M Y | H:i:s',strtotime($data->DetailReservasi[0]->tanggal_mulai))}}</td>
                                        <td>{{date('d M Y | H:i:s',strtotime($data->DetailReservasi[0]->tanggal_selesai))}}</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a onclick="konfirmasiMuput({{$data->DetailReservasi[0]->id}})" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                        </td>
                                    </tr>
                                    @for($i=1; $i < count($data->DetailReservasi); $i++ )
                                        <tr>
                                            <td>{{$data->DetailReservasi[$i]->TahapanUpacara->nama_tahapan}}</td>
                                            <td>{{date('d M Y | H:i:s',strtotime($data->DetailReservasi[$i]->tanggal_mulai))}}</td>
                                            <td>{{date('d M Y | H:i:s',strtotime($data->DetailReservasi[$i]->tanggal_selesai))}}</td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                <a onclick="konfirmasiMuput({{$data->DetailReservasi[$i]->id}})" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                            </td>
                                        </tr>
                                    @endfor
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>No</th>
                                <th>Nama Upacara</th>
                                <th>Penyelengara</th>
                                <th>Tahapan Reservasi</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                {{-- <th class='d-flex justify-content-center text-center'>Status Reservasi</th> --}}
                                <th>Tindakan</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Data Table Sulinggih --}}

        </div>
    </div>

    <!-- MODAL KONFIRMASI TERIMA SEMUA DATA -->
    <div class="modal fade" id="modalKonfirmasi" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Verifikasi Reservasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('pemuput-karya.manajemen-reservasi.all-verifikasi')}}" method="POST" id="konfirmasiData">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input class="d-none" name="id_reservasi" id="idReservasiTerima" value="" type="hidden">
                        <input class="d-none" name="status" value="diterima" type="hidden">
                        <div id="id_tahapan">
                            {{-- Data Tahapan --}}
                        </div>
                        <div class="form-group">
                            <label>Tentukan Tanggal Tangkil:</label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input name="tanggal_tangkil" type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" />
                                <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button onclick="terimaSemua()" type="button" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL KONFIRMASI TERIMA SEMUA DATA -->



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
            $('#side-manajemen-muput-upacara').addClass('menu-open');
            $('#side-manajemen-muput-upacara-konfirmasi-muput-upacara').addClass('active');
        });
    </script>


@endpush

@push('js')
    <script>
        function konfirmasiMuput(id){
            modalKonfirmasi.modal();
        }
    </script>
@endpush
