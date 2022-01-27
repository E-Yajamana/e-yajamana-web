@extends('layouts.sulinggih.sulinggih-layout')
@section('tittle','Reservasi Krama Masuk')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <div class="col-12">
                    <div class="card tab-content">
                        <div class="card-header my-auto">
                            <label class="card-title my-auto">Data Krama Pemesan</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Nama Krama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->Krama->nama_krama}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Krama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->Krama->alamat_krama}}" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->Krama->User->email}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->Krama->User->nomor_telepon}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                    <h3 class="text-center bold mb-0 ">{{$dataReservasi->Upacaraku->nama_upacara}}</h3>
                                    <p class="text-center mb-1">{{$dataReservasi->Upacaraku->Upacara->kategori_upacara}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Jenis Upacara</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->Upacara->nama_upacara}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Upacara</label>
                                        <textarea disabled class="form-control" rows="3" placeholder="Masukan Deskripsi Upacara ...">{{$dataReservasi->Upacaraku->deskripsi_upacaraku}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai - Tanggal Selesai Upacara</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="reservation" disabled value="{{date('d-M-Y',strtotime($dataReservasi->Upacaraku->tanggal_mulai))}} - {{date('d-M-Y',strtotime($dataReservasi->Upacaraku->tanggal_selesai))}}">
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


                <div class="col-12">
                    <div class="card tab-content">
                        <div class="card-header my-auto">
                            <label class="card-title my-auto">Tahapan yang Direservasi</label>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mailbox-messages p-2">
                                <form action="{{route('pemuput-karya.manajemen-reservasi.verifikasi')}}" method="POST" id="inputdata">
                                    @csrf
                                    @method('put')
                                    <table id="" class="table table-bordered table-hover mx-auto table-responsive-sm">
                                        <thead >
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Tahapan</th>
                                                <th>Tanggal Mulai - Selesai</th>
                                                <th>Waktu Mulai - Selesai</th>
                                                <th>Tentukan Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataReservasi->DetailReservasi as $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <input type="hidden" class="d-none" name="id_tahapan" value="{{$data->id}}">
                                                    <td>{{$data->TahapanUpacara->nama_tahapan}}</td>
                                                    <td>{{date('d-M-Y',strtotime($data->tanggal_mulai))}} - {{date('d-M-Y',strtotime($data->tanggal_selesai))}}</td>
                                                    <td>{{date('h:i:s',strtotime($data->tanggal_mulai))}} - {{date('h:i:s',strtotime($data->tanggal_selesai))}}</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select name="status[] " class="form-control select2bs4" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                                <option data-id="{{$data->id}}" @if ($data->status == 'pending') value="pending" selected @endif value="pending">Pending</option>
                                                                <option data-id="{{$data->id}}" @if ($data->status == 'diterima') value="diterima" selected @endif value="diterima">Terima Tahapan</option>
                                                                <option data-id="{{$data->id}}" @if ($data->status == 'ditolak') value="ditolak" selected @endif value="ditolak">Tolak Tahapan</option>
                                                            </select>
                                                        </div>
                                                        <input value="{{$data->id}}" type="hidden" class="d-none" name="id[]">
                                                        <input id="text_penolakan-{{$data->id}}" type="hidden" class="form-control" name="alasan_penolakan[]" value="" placeholder="Masukan alasan penolakan" >
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Tahapan</th>
                                                <th>Tanggal Mulai - Selesai</th>
                                                <th>Waktu Mulai - Selesai</th>
                                                <th>Tentukan Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12 my-2">
                                            <a href="{{route('pemuput-karya.manajemen-reservasi.index')}}" class="btn btn-secondary">Kembali</a>
                                            <button type="submit" class="btn btn-primary float-right ml-2">Simpan Data</button>
                                            <div class="btn btn-secondary m-1 float-right " align-self="end">Setujui Semua</div>
                                            <div class="btn btn-danger m-1 float-right " align-self="end">Tolak Semua</div>
                                        </div>
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
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <!-- jquery-validation -->
    <script src="{{asset('base-template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/jquery-validation/additional-methods.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-manajemen-reservasi').addClass('menu-open');
            $('#side-manajemen-reservasi-index').addClass('active');
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


    <!-- Fungsi Form Input  -->
    <script type="text/javascript">
        $('#mySelect2').select2('data');

        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
    <!-- Fungsi Form Input  -->
@endpush

@push('js')

    <script type="text/javascript">

         $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    $("#inputdata")[0].submit();
                }
            });
            $('#inputdata').validate({
                rules: {
                'alasan_penolakan[]': {
                    required: true
                },
                },
                messages: {
                'alasan_penolakan[]': {
                    required: "Tanggal reservasi wajib diisi",
                },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
        // ADD FUNCTION VALIDATE FORM INPUT
        $('select').change(function(){
            var id = $(this).find(':selected').data('id');
            var jenis = $(this).find(':selected').val();
            var text = document.getElementById("text_penolakan-"+id);
            if(jenis=='ditolak'){
                text.type = "text";
            }else{
                text.type = "hidden";
            }
        });

    </script>


    <script type="text/javascript">
        let dataReservasi;

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

            dataReservasi = {!! json_encode($dataReservasi) !!}

            var marker = new L.marker([dataReservasi.upacaraku.lat,dataReservasi.upacaraku.lng ]).bindPopup(dataReservasi.upacaraku.alamat_upacaraku).addTo(mymap);
            marker.on('click', function() {
                marker.openPopup();
            });

        });
    </script>


@endpush


