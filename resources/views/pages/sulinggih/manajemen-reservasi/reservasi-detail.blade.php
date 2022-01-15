@extends('layouts.sulinggih.sulinggih-layout')
@section('tittle','Reservasi Krama Masuk')

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
                    <h1>Detail Reservasi Masuk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('sulinggih.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Data Reservasi</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="callout callout-info container-fluid">
                <h5><i class="fas fa-info"></i> Catatan:</h5>
                Harap mengisi Tanggal Tangkil setelah menerima reservasi.
            </div>
            <div class="row">
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
                                    <h3 class="text-center bold mb-0 ">Mepandes I Putu Alex</h3>
                                    <p class="text-center mb-1">Manusa Yadnya</p>
                                </div>

                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Jenis Upacara</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Manusa Yadnya" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Upacara</label>
                                        <textarea disabled class="form-control" rows="3" placeholder="Masukan Deskripsi Upacara ..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai - Tanggal Selesai Upacara</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="reservation" disabled value="12 December 2021 - 4 januari 2021">
                                        </div>
                                        <!-- /.input group -->
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

                <div class="col-12">
                    <div class="card tab-content">
                        <div class="card-header my-auto">
                            <label class="card-title my-auto">Tahapan yang Direservasi</label>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mailbox-messages p-2">
                                <form>
                                    <table id="" class="table table-bordered table-hover mx-auto table-responsive-sm">
                                        <thead >
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Tahapan</th>
                                                <th>Tanggal Mulai - Selesai</th>
                                                <th>Waktu Mulai - Selesai</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Piodalan Ring Pura</td>
                                                <td>12-December-2021  14-December-2021</td>
                                                <td>08.30 - 12.00</td>
                                                <td>
                                                    <div class="form-group" data-select2-id="29">
                                                        <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true">
                                                            <option selected="selected" data-select2-id="19">Tentukan Status</option>
                                                            <option data-select2-id="32">Terima</option>
                                                            <option data-select2-id="33">Tolak</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Piodalan Ring Pura</td>
                                                <td>12-December-2021  14-December-2021</td>
                                                <td>08.30 - 12.00</td>
                                                <td>
                                                    <div class="form-group" data-select2-id="29">
                                                        <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true">
                                                            <option selected="selected" data-select2-id="19">Tentukan Status</option>
                                                            <option data-select2-id="32">Terima</option>
                                                            <option data-select2-id="33">Tolak</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Tahapan</th>
                                                <th>Tanggal Mulai - Selesai</th>
                                                <th>Waktu Mulai - Selesai</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="d-flex flex-row-reverse">
                                        <div class="btn btn-primary m-1">Submit</div>
                                        <div class="btn btn-secondary m-1">Setujui Semua</div>
                                        <div class="btn btn-danger m-1">Tolak Semua</div>
                                    </div>


                                </form>


                            </div>
                        </div>

                    </div>
                </div>


            </div>



        </div>


    </section>




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
            $('#side-manajemen-reservasi').addClass('menu-open');
            $('#side-manajemen-reservasi-index').addClass('active');
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-upacara').addClass('menu-open');
            $('#side-kabupaten').addClass('active');

            var mymap = L.map('gmaps').setView([-8.617683234549416, 115.16708493639123], 15);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Adalah API Favoritku',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);

        });
    </script>

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

@endpush
