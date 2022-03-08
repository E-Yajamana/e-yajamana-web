@extends('layouts.krama.krama-layout')
@section('tittle','Data Upacaraku')

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
                    <h1>List Data Reservasi</h1>
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline tab-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title">Filter Reservasi</h3>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-primary float-right" type="button" onclick="addReservasi()"> <i class="fa fa-plus"></i> Tambah Reservasi</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Semua</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Pending</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Proses Tangkil</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Proses Muput</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Selesai</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Batal</a></li>
                                    </ul>
                                </div>
                                <div class="col-4">
                                    <select class="form-control select2" style="width: 100%;" aria-placeholder="ada">
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

                    <div class="card tab-content" id="v-pills-tabContent">
                        {{-- Start Data Table Sulinggih --}}
                        <div class="card-header my-auto">
                            <h3 class="card-title my-auto">List Data Upacara</h3>
                        </div>
                        <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                            <div class="card-body p-0">
                                <div class="table-responsive mailbox-messages p-2">
                                    <table id="example2" class="table mx-auto table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Upacara</th>
                                                <th>Pemuput Upacara</th>
                                                <th class='d-flex justify-content-center text-center'>Status Reservasi</th>
                                                <th>Tahapan Reservasi</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataReservasi as $index => $data)
                                                <tr>
                                                    <td rowspan="{{count($data->Reservasi)}}">{{$index+1}}</td>
                                                    <td style="width: 18%" rowspan="{{count($data->Reservasi)}}">{{$data->nama_upacara}}</td>
                                                    <td style="width: 18%" class="pl-4">
                                                        @if ($data->Reservasi[0]->Relasi->Sulinggih != null)
                                                            {{$data->Reservasi[0]->Relasi->Sulinggih->nama_sulinggih}}</td>
                                                        @else
                                                            {{$data->Reservasi[0]->Relasi->Sanggar->nama_sanggar}}</td>
                                                        @endif
                                                    <td class='d-flex justify-content-center text-center'>
                                                        <span @if ($data->Reservasi[0]->status == 'pending') class="bg-secondary btn-sm" @elseif ($data->Reservasi[0]->status == 'proses tangkil' || $data->Reservasi[0]->status == 'proses muput') class="bg-primary btn-sm" @elseif ($data->Reservasi[0]->status == 'selesai') class="bg-success btn-sm" @else class="bg-danger btn-sm" @endif style="border-radius: 5px; width:110px;">{{Str::ucfirst($data->Reservasi[0]->status)}}</span>
                                                    </td>
                                                    <td>
                                                        @foreach ($data->Reservasi[0]->DetailReservasi as $dataDetailReservasi)
                                                            <li>{{$dataDetailReservasi->TahapanUpacara->nama_tahapan}} | {{strtoupper($dataDetailReservasi->status)}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <a href="{{route('krama.manajemen-reservasi.detail',$data->Reservasi[0]->id)}}" class="btn btn-info btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @if ($data->Reservasi[0]->status == 'pending' || $data->Reservasi[0]->status == 'proses tangkil')
                                                            <button onclick="batalReservasi({{$data->Reservasi[0]->id}})" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                            <form id="{{"batal-".$data->Reservasi[0]->id}}" class="d-none" action="{{route('krama.manajemen-reservasi.delete')}}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" class="d-none" value="{{$data->Reservasi[0]->id}}" name="id">
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @for($i=1; $i < count($data->Reservasi); $i++ )
                                                    <tr>
                                                        <td>
                                                            @if ($data->Reservasi[$i]->Relasi->Sulinggih != null)
                                                                {{$data->Reservasi[$i]->Relasi->Sulinggih->nama_sulinggih}}</td>
                                                            @else
                                                                {{$data->Reservasi[$i]->Relasi->Sanggar->nama_sanggar}}</td>
                                                            @endif
                                                        </td>
                                                        <td class='d-flex justify-content-center text-center'>
                                                            <span @if ($data->Reservasi[$i]->status  == 'pending') class="bg-secondary btn-sm" @elseif ($data->Reservasi[$i]->status == 'proses tangkil' || $data->Reservasi[$i]->status == 'proses muput') class="bg-primary btn-sm" @elseif ($data->Reservasi[$i]->status == 'selesai') class="bg-success btn-sm" @else class="bg-danger btn-sm" @endif style="border-radius: 5px; width:110px;">{{Str::ucfirst($data->Reservasi[$i]->status)}}</span>
                                                        </td>
                                                        <td>
                                                            @foreach ($data->Reservasi[$i]->DetailReservasi as $dataDetailReservasi)
                                                                <li>{{$dataDetailReservasi->TahapanUpacara->nama_tahapan}} | {{strtoupper($dataDetailReservasi->status)}}</li>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <a href="{{route('krama.manajemen-reservasi.detail',$data->Reservasi[$i]->id)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                            @if ($data->Reservasi[$i]->status == 'pending' || $data->Reservasi[$i]->status == 'proses tangkil')
                                                                <a onclick="batalReservasi({{$data->Reservasi[$i]->id}})" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                                                <form id="{{"batal-".$data->Reservasi[$i]->id}}" class="d-none" action="{{route('krama.manajemen-reservasi.delete')}}" method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" class="d-none" value="{{$data->Reservasi[$i]->id}}" name="id">
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Upakara</th>
                                                <th>Pemuput Upakara</th>
                                                <th>Status Reservasi</th>
                                                <th>Tahapan Reservasi</th>
                                                <th>Tindakan</th>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-reservasi').addClass('menu-open');
            $('#side-data-reservasi').addClass('active');
        });
    </script>

@endpush

@push('js')
    <script>
        function batalReservasi(id){
            Swal.fire({
                title: 'Peringatan',
                text : 'Apakah anda yakin akan membatalkan reservasi?',
                icon:'warning',
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: `Batal`,
                denyButtonText: `Cancel`,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#batal-'+id).submit();
                } else if (result.isDenied) {

                }
            })
        }
    </script>
@endpush
