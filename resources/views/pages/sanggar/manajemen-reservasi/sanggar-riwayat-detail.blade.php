@extends('layouts.sanggar.sanggar-layout')
@section('tittle','Detail Riwayat Reservasi')

@push('css')
     <!-- DataTables -->
     <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
     <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom mt-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Riwayat Reservasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('sanggar.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('sanggar.manajemen-reservasi.riwayat.index')}}">Data Riwayat Reservasi</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header my-auto">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Status Reservasi :</label>
                                <input type="text" name="data_upacara[0][nama_upacara]" class="form-control @error('data_upacara[0][nama_upacara]') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email" disabled value="@if($dataReservasi->status == 'proses tangkil')Proses Penguleman @else{{ucfirst($dataReservasi->status)}}@endif">
                                @error('data_upacara[0][nama_upacara]')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('data_upacara[0][nama_upacara]') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Mengajukan Reservasi pada Tanggal :</label>
                                <input type="text" name="data_upacara[0][nama_upacara]" class="form-control @error('data_upacara[0][nama_upacara]') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{date('d M Y, H:m',strtotime($dataReservasi->created_at))}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="align-content-center">
                                @if ($dataReservasi->status == 'batal' || $dataReservasi->status == 'ditolak' )
                                    <div class="d-flex justify-content-center text-center">
                                        <strong> Alasan Pembatalan </strong>: {{$dataReservasi->keterangan}}
                                    </div>
                                @endif
                                @isset($dataReservasi->rating)
                                    @isset($dataReservasi->keterangan_rating)
                                        <div class="justify-content-center w-50 mx-auto text-center">
                                            <strong> Review </strong> :  {{$dataReservasi->keterangan_rating}}
                                        </div>
                                    @endisset
                                    <div class="text-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $dataReservasi->rating)
                                                <i class="fas fa-star text-warning "></i>
                                            @else
                                                <i class="fas fa-star "></i>
                                            @endif
                                        @endfor
                                    </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class='card'>
                                <div class='card-body'>
                                    <table class='table-responsive-sm table' id="example2">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Tahapan</th>
                                                <th class="text-center">Waktu Mulai - Waktu Selesai</th>
                                                <th class='text-center'>Status</th>
                                                @if ($dataReservasi->status == 'proses muput' || $dataReservasi->status == 'selesai')
                                                    <th class="text-center">Bukti Muput</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach ($dataReservasi->DetailReservasi as $data)
                                                 <tr>
                                                    <td style='width: 7%'>{{$loop->iteration}}</td>
                                                    <td style='width: 18%'>{{$data->TahapanUpacara->nama_tahapan}}</td>
                                                    <td class="text-center">
                                                        {{date('d M Y',strtotime($dataReservasi->Upacaraku->tanggal_mulai))}} - {{date('d M Y',strtotime($dataReservasi->Upacaraku->tanggal_selesai))}}
                                                        <p>{{date('H:m',strtotime($dataReservasi->Upacaraku->tanggal_mulai))}} - {{date('H:m',strtotime($dataReservasi->Upacaraku->tanggal_selesai))}}</p>
                                                    </td>
                                                    <td class="d-flex justify-content-center text-center">
                                                        <div  @if ($data->status == 'pending') class="bg-secondary btn-sm" @elseif ($data->status == 'diterima') class=" bg-primary btn-sm" @elseif ($data->status == 'selesai') class="bg-success btn-sm" @else class="bg-danger btn-sm" @endif  style="border-radius: 5px; width:110px;">{{ucfirst($data->status)}}</div>
                                                    </td>
                                                    @if ($dataReservasi->status == 'proses muput' || $dataReservasi->status == 'selesai')
                                                        @if ($data->Gambar()->count() != 0)
                                                            <td class="text-center">
                                                                <a data-toggle="modal" data-target="#exampleModal-{{$data->id}}" class="btn btn-secondary btn-sm" ><i class="fas fa-eye"></i></a>
                                                            </td>
                                                            <div class="modal fade" id="exampleModal-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div id="carouselExampleIndicators{{$data->id}}" class="carousel slide" data-ride="carousel">
                                                                            <ol class="carousel-indicators">
                                                                                @foreach ($data->Gambar as $key=>$gambar)
                                                                                    <li data-target="#carouselExampleIndicators{{$data->id}}" data-slide-to="{{$key}}" @if($key == 0) class="active" @endif ></li>
                                                                                @endforeach
                                                                            </ol>
                                                                            <div class="carousel-inner">
                                                                                @foreach ($data->Gambar as $key=>$gambar)
                                                                                    <div class="carousel-item @if ($key == 0) active @endif">
                                                                                        <img class="d-block w-100" src="{{route('image.bukti-upacara',$gambar->id)}}" >
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            <a class="carousel-control-prev" href="#carouselExampleIndicators{{$data->id}}" role="button" data-slide="prev">
                                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                <span class="sr-only">Sebelumnya</span>
                                                                            </a>
                                                                            <a class="carousel-control-next" href="#carouselExampleIndicators{{$data->id}}" role="button" data-slide="next">
                                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                <span class="sr-only">Selanjutnya</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <td class="text-center">
                                                                <a onclick="noHaveImage()" class="btn btn-secondary btn-sm" ><i class="fas fa-eye"></i></a>
                                                            </td>
                                                        @endif
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mt-2">
                            <div class="card tab-content">
                                <!-- /.card-header -->
                                <div class="card-header">
                                    <div class="card-body box-profile align-content-center">
                                        <div class="text-center">
                                            <img class="ml-4 profile-user-img img-fluid img-circle" src="{{asset('base-template/dist/img/logo-01.png')}}" alt="User profile picture">
                                            <h3 class="text-center bold mb-0 ">{{$dataReservasi->Upacaraku->Upacara->nama_upacara}}</h3>
                                            <p class="text-center mb-1">{{$dataReservasi->Upacaraku->Upacara->kategori_upacara}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" class="d-none" name="data_upacara[0][id]" value="{{$dataReservasi->Upacaraku->id}}">
                                            <div class="form-group">
                                                <label>Nama Upacara</label>
                                                <input type="text" name="data_upacara[0][nama_upacara]" class="form-control @error('data_upacara[0][nama_upacara]') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email" disabled   value="{{$dataReservasi->Upacaraku->nama_upacara}}">
                                                @error('data_upacara[0][nama_upacara]')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $errors->first('data_upacara[0][nama_upacara]') }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi Upacara</label>
                                                <textarea  disabled class="form-control @error('data_upacara[0][deskripsi_upacara]') is-invalid @enderror" rows="3" name="data_upacara[0][deskripsi_upacara]">{{$dataReservasi->Upacaraku->deskripsi_upacaraku}}</textarea>
                                                @error('data_upacara[0][deskripsi_upacara]')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $errors->first('data_upacara[0][deskripsi_upacara]') }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Mulai - Tanggal Selesai Upacara</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input  disabled name="data_upacara[0][daterange]"  id="dateUpacara" type='text' class='form-control float-right' value='{{date('d M Y ',strtotime($dataReservasi->Upacaraku->tanggal_mulai))}} - {{date('d M Y ',strtotime($dataReservasi->Upacaraku->tanggal_selesai))}}'>
                                                    @error('data_upacara[0][daterange]')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $errors->first('data_upacara[0][daterange]') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mt-2">
                            <div class="card tab-content" id="v-pills-tabContent">
                                <div class="card-header my-auto">
                                    <label class="card-title my-auto">Lokasi Upacara</label>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div id="gmaps" style="height: 466px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card tab-content">
                <div class="card-header my-auto">
                    <label class="card-title my-auto">Data Krama</label>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="mb-2">Tanggal Tangkil Krama</label>
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input disabled type="text" class="form-control" id="date" name="tanggal_tangkil" placeholder="Enter email" value="{{date('d M Y | H:m ',strtotime($dataReservasi->created_at))}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nama Krama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->User->Penduduk->nama}}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->User->email}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Alamat Krama</label>
                                <input type="text" class="form-control" id="alamat" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->User->Penduduk->alamat}}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" class="form-control" id="nomor_telepon" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->User->nomor_telepon}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 my-1 px-2">
                            <a href="{{route('sanggar.manajemen-reservasi.riwayat.index')}}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <input id="upacaraku" type="hidden" class="d-none" value='@json($dataReservasi->Upacaraku)'>

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
            $('.carousel').carousel();

            var getUpacaraku = $('#upacaraku').val();
            const dataUpacaraku = JSON.parse(getUpacaraku);

            $('#side-manajemen-reservasi').addClass('menu-open');
            $('#side-manajemen-reservasi-riwayat').addClass('active');

            $('#example2').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
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

            var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 9);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Adalah API Favoritku',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);

            var marker = new L.marker([dataUpacaraku.lat,dataUpacaraku.lng]).bindPopup(dataUpacaraku.alamat_upacaraku).addTo(mymap);
            marker.on('click', function() {
                marker.openPopup();
            });

        });
    </script>
@endpush

@push('js')
    <script>
        function noHaveImage()
        {
            Swal.fire({
                icon: 'info',
                title: 'Pemberitahuan',
                text: 'Tidak terdapat data Bukti Muput Upacara pada Tahapan tersebut.',
            });
        }
    </script>
@endpush







