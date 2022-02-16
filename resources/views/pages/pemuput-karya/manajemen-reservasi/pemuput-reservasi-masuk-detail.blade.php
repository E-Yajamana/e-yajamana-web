@extends('layouts.sulinggih.sulinggih-layout')
@section('tittle','Reservasi Krama Masuk')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

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
                    <li class="breadcrumb-item"><a href="#">Data Reservasi Masuk</a></li>
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
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->Krama->User->Penduduk->nama}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Krama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataReservasi->Upacaraku->Krama->User->Penduduk->alamat}}" disabled>
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
                                    <input class="d-none" name="id_reservasi" id="idReservasi" value="{{$dataReservasi->id}}" type="hidden">
                                    <input class="d-none" name="status_reservasi" id="statusReservasi" value="{{$dataReservasi->id}}" type="hidden">
                                    <table id="" class="table table-bordered table-hover mx-auto table-responsive-sm">
                                        <thead >
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Tahapan</th>
                                                <th>Waktu Mulai Tahapan</th>
                                                <th>Waktu Selesai Tahapan</th>
                                                <th>Tentukan Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataReservasi->DetailReservasi as $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$data->TahapanUpacara->nama_tahapan}}</td>
                                                    <td>{{date('d-M-Y : h:i',strtotime($data->tanggal_mulai))}}</td>
                                                    <td>{{date('d-M-Y : h:i',strtotime($data->tanggal_selesai))}}</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select name="status[]" class="form-control select2bs4" style="width: 100%;" tabindex="-1" aria-hidden="true" id="status">
                                                                <option data-id="{{$data->id}}" @if ($data->status == 'pending') value="pending" selected @else value="pending" @endif >Pending</option>
                                                                <option data-id="{{$data->id}}" @if ($data->status == 'diterima') value="diterima" selected @else value="diterima" @endif >Setujui</option>
                                                                <option data-id="{{$data->id}}" @if ($data->status == 'ditolak') value="ditolak" selected @else value="ditolak" @endif>Tolak</option>
                                                            </select>
                                                        </div>
                                                        <input value="{{$data->id}}" type="hidden" class="d-none" name="id_tahapan[]">
                                                        <input id="text_penolakan-{{$data->id}}" type="hidden" class="form-control" name="alasan_penolakan[]" value="" placeholder="Masukan alasan penolakan" >
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Tahapan</th>
                                                <th>Waktu Mulai Tahapan</th>
                                                <th>Waktu Selesai Tahapan</th>
                                                <th>Tentukan Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
                                                <div class="modal-body">
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
                                                    <button onclick="inputData()" type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>

    <!-- Bootstrabase-template-->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>


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
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
        $('#reservationdatetime').datetimepicker({
            icons: {
            time: 'far fa-clock'
            }
        });
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
        // DEKLARASI DATA RESERVASI
        let data_reservasi;
        let dataDatabase=[];
        data_reservasi = {!! json_encode($dataReservasi) !!}
        $.each(data_reservasi.detail_reservasi, function(key, data){
            dataDatabase.push(data.status);
        });
        // DEKLARASI DATA RESERVASI
        function inputData(){
            $("#inputdata")[0].submit();
        }
        // VALIDASI SEDERHANA DARI PENENTUAN STATUS TAHAPAN
        function validasiInputStatus(data){
            // console.log(data);
            if(JSON.stringify(data)==JSON.stringify(dataDatabase)){
                Swal.fire({
                    icon:  'warning',
                    title: 'Warning',
                    text: 'Tidak terdapat perubahan apapun yang dilakukan !',
                });
            }else if(data.indexOf("diterima") !== -1){
                if(data_reservasi.tanggal_tangkil == null){
                    $("#modalKonfirmasi").modal();
                    $("#statusReservasi").val('proses tangkil');
                }else{
                    $("#statusReservasi").val('proses tangkil');
                    $("#inputdata")[0].submit();
                }
            }else if(data.indexOf("ditolak") !== -1){
                if(data.every((val,u,arr)=>val === arr[0]) == true){
                    $("#statusReservasi").val('batal');
                    $("#inputdata")[0].submit();
                }else{
                    $("#statusReservasi").val('pending');
                    $("#inputdata")[0].submit();
                }
            }else if (data.indexOf("pending") !== -1){
                if(data.every((val,u,arr)=>val === arr[0]) == true){
                    $("#statusReservasi").val('pending');
                    $("#inputdata")[0].submit();
                }
            }
        };
        // VALIDASI SEDERHANA DARI PENENTUAN STATUS TAHAPAN

        // ADD FUNCTION VALIDASI ALASAN PENOLAKAN
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    let status=[];
                    $('select[name="status[]"] option:selected').each(function() {
                        status.push($(this).val());
                    });
                    console.log(status)
                    validasiInputStatus(status);
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
        // ADD FUNCTION VALIDASI ALASAN PENOLAKAN

        // FUNGSI GET DATA ALASAN DIDATABASE
        getAlasanPenolakan();
        function getAlasanPenolakan(){
            console.log(data_reservasi)
            $.each(data_reservasi.detail_reservasi, function(key, data){
                if(data.keterangan != null){
                    var text = document.getElementById("text_penolakan-"+data.id);
                    text.type = "text";
                    text.value = data.keterangan;
                }else{
                    var text = document.getElementById("text_penolakan-"+data.id);
                    text.type = "hidden";
                    text.value = "";
                }

            });
        }
        // FUNGSI GET DATA ALASAN DIDATABASE

        // ADD FUNCTION ADD KOLOM ALASAN RESERVASI
        $('select').change(function(){
            var id = $(this).find(':selected').data('id');
            console.log(id);
            var jenis = $(this).find(':selected').val();
            var text = document.getElementById("text_penolakan-"+id);
            if(jenis=='ditolak'){
                getAlasanPenolakan();
                text.type = "text";
            }else{
                text.type = "hidden";
                text.value = "";
            }
        });
        // ADD FUNCTION ADD KOLOM ALASAN RESERVASI
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
