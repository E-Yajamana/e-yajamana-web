@extends('layouts.pemuput-karya.pemuput-karya-layout')
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
                    <h1>Jadwal Muput Upacara </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('pemuput-karya.dashboard')}}">E-Yajamana</a></li>
                        <li class="breadcrumb-item active">Data Muput Upacara</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="container-fluid">
        <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
            <div class="card-header my-auto">
                <h3 class="card-title my-auto">List Data Muput Upacara Krama</h3>
            </div>

            {{-- Start Data Table Sulinggih --}}
            <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages p-2">
                        <table id="example2" class="table mx-auto table-responsive-sm">
                            <thead >
                                <th>No</th>
                                <th>Penyelengara</th>
                                <th>Alamat</th>
                                <th>Tahapan Reservasi</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Tindakan</th>
                            </thead>
                            <tbody>
                                @foreach ($dataReservasi as $index => $data )
                                    <tr>
                                        <td rowspan="{{count($data->DetailReservasi)}}">{{$index+1}}</td>
                                        <td style="width: 15%"  rowspan="{{count($data->DetailReservasi)}}">{{$data->Upacaraku->User->Penduduk->nama}}</td>
                                        <td style="width: 18%" rowspan="{{count($data->DetailReservasi)}}">{{$data->Upacaraku->alamat_upacaraku}}</td>
                                        <td class="pl-4">{{$data->DetailReservasi[0]->TahapanUpacara->nama_tahapan}}</td>
                                        <td>{{date('d F Y | H:m',strtotime($data->DetailReservasi[0]->tanggal_mulai))}}</td>
                                        <td>{{date('d F Y | H:m',strtotime($data->DetailReservasi[0]->tanggal_selesai))}}</td>
                                        <td>
                                            <a href="{{route('pemuput-karya.muput-upacara.konfirmasi-muput.detail',$data->DetailReservasi[0]->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a onclick="konfirmasiMuput({{$data->DetailReservasi[0]->id}})" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                        </td>
                                    </tr>
                                    @for($i=1; $i < count($data->DetailReservasi); $i++ )
                                        <tr>
                                            <td>{{$data->DetailReservasi[$i]->TahapanUpacara->nama_tahapan}}</td>
                                            <td>{{date('d F Y | H:m',strtotime($data->DetailReservasi[$i]->tanggal_mulai))}}</td>
                                            <td>{{date('d F Y | H:m',strtotime($data->DetailReservasi[$i]->tanggal_selesai))}}</td>
                                            <td>
                                                <a href="{{route('pemuput-karya.muput-upacara.konfirmasi-muput.detail',$data->DetailReservasi[$i]->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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
                                <th>Tindakan</th>
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
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

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
        $(function () {
            bsCustomFileInput.init();
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
            Swal.fire({
                title: 'Pemberitahuan',
                text : 'Apakah anda ingin mengkonfirmasi tahapan reservasi tersebut?',
                icon:'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Terima`,
                denyButtonText: `Batal`,
                confirmButtonColor: '#3085d6',
                denyButtonColor : '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#idDetailReservasi").val(id);
                    $("#modalKonfirmasi").modal();
                }
            })
        }
    </script>
@endpush
