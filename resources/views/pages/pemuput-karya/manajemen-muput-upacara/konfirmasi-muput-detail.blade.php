@extends('layouts.sulinggih.sulinggih-layout')
@section('tittle','Reservasi Krama Masuk')

@push('css')
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
                    <h1>Detail Reservasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Konfirmasi Muput</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row p-2">
            <div class="col-12 col-sm-6">
                <div class="card tab-content">
                    <!-- /.card-header -->
                    <div class="card-header">
                        <div class="card-tools ">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="card-body box-profile align-content-center">
                            <div class="text-center">
                                <img class="ml-4 profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                <h3 class="text-center bold mb-0 ">{{$dataDetailReservasi->Reservasi->Upacaraku->nama_upacara}}</h3>
                                <p class="text-center mb-1">{{$dataDetailReservasi->Reservasi->Upacaraku->Upacara->kategori_upacara}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Jenis Upacara</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataDetailReservasi->Reservasi->Upacaraku->Upacara->nama_upacara}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Upacara</label>
                                    <textarea disabled class="form-control" rows="3" placeholder="Masukan Deskripsi Upacara ...">{{$dataDetailReservasi->Reservasi->Upacaraku->deskripsi_upacaraku}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Mulai - Tanggal Selesai Upacara</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservation" disabled value="{{date('d-M-Y',strtotime($dataDetailReservasi->Reservasi->Upacaraku->tanggal_mulai))}} - {{date('d-M-Y',strtotime($dataDetailReservasi->Reservasi->Upacaraku->tanggal_selesai))}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card tab-content" id="v-pills-tabContent">
                    <div class="card-header my-auto">
                        <label class="card-title my-auto">Lokasi Upacara</label>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div id="gmaps" style="height: 464px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="card tab-content">
                <div class="card-header my-auto">
                    <label class="card-title my-auto">Data Reservasi</label>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Tahapan</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataDetailReservasi->TahapanUpacara->nama_tahapan}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mulai - Tanggal Selesai Reservasi</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="reservation" disabled value="{{date('d-M-Y H:i',strtotime($dataDetailReservasi->tanggal_mulai))}} - {{date('d-M-Y H:i   ',strtotime($dataDetailReservasi->tanggal_selesai))}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-12 my-2">
                        <a href="{{route('pemuput-karya.muput-upacara.konfirmasi-muput.index')}}" class="btn btn-secondary">Kembali</a>
                        <button onclick="konfirmasiMuput({{$dataDetailReservasi->id}})" type="button" class="btn btn-primary float-right ml-2 m-1">Konfirmasi Muput</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <input id='lat' value="{{$dataDetailReservasi->Reservasi->Upacaraku->lat}}" type="hidden">
    <input id='alamat' value="{{$dataDetailReservasi->Reservasi->Upacaraku->alamat_upacaraku}}" type="hidden">
    <input id='lng' value="{{$dataDetailReservasi->Reservasi->Upacaraku->lng}}" type="hidden">

    <!-- MODAL KONFIRMASI TERIMA SEMUA DATA -->
    <div class="modal fade" id="modalKonfirmasi" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Konfirmasi Muput Upacara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('pemuput-karya.muput-upacara.konfirmasi-muput.update')}}" method="POST" id="konfirmasiData" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input class="d-none" name="id_detail_reservasi" id="idDetailReservasi" value="" type="hidden">
                        <div class="form-group">
                            <label>Foto Bukti Muput Upacara</label>
                            <div class="input-group mb-2">
                                <div class="custom-file">
                                    <input type="file" id="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="customFile" value="{{old('file')}}" >
                                    <label class="custom-file-label " for="customFile">Masukan Foto Bukti Muput Upacara</label>
                                </div>
                            </div>
                            <div class="text-sm text-danger text-start file_error" id="file_error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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

    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $('#side-manajemen-muput-upacara').addClass('menu-open');
        $('#side-manajemen-muput-upacara-konfirmasi-muput-upacara').addClass('active');

        $(function () {
            bsCustomFileInput.init();
        });
        // VIEW MARKER MAPS (**)
        $(document).ready(function(){
            $('#side-upacara').addClass('menu-open');
            $('#side-kabupaten').addClass('active');
            var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 10);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Adalah API Favoritku',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);
            var lat = $("#lat").val();
            var lng = $("#lng").val();
            var alamat = $("#alamat").val();

            var marker = new L.marker([lat,lng ]).bindPopup(alamat).addTo(mymap);
            marker.on('click', function() {
                marker.openPopup();
            });
        });
        // VIEW MARKER MAPS (**)

    </script>

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
