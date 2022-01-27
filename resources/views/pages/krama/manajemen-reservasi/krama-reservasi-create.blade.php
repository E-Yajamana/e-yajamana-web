@extends('layouts.krama.krama-layout')
@section('tittle','Reservasi')

@push('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/dropzone/min/dropzone.min.css')}}">


    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

@endpush




@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reservasi Pemuput Karya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">E-Yajamana</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$dataUpacaraku->nama_upacara}}</a></li>
                        <li class="breadcrumb-item active">Tambah Reservasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info container-fluid">
                        <h5><i class="fas fa-info"></i> Catatan:</h5>
                        Anda dapat melakukan reservasi pada beberapa tahapan yang tersedia pada suatu upacara.
                    </div>

                    <div class="bs-stepper">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Form Pencarian Reservasi</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                    <!-- your steps here -->
                                        <div class="step" data-target="#logins-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                                <span class="bs-stepper-circle">1</span>
                                                <span class="bs-stepper-label">Pencarian</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#information-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                                <span class="bs-stepper-circle">2</span>
                                                <span class="bs-stepper-label">Pilih Tahapan</span>
                                            </button>
                                        </div>

                                        <div class="line"></div>
                                        <div class="step" data-target="#next-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="next-part"
                                            id="next-part-trigger">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Rangkuman</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="bs-stepper-content p-0">
                            <!-- TAHAPAN AWAL -->
                                <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                    <div class="card tab-content">
                                        <!-- /.card-header -->
                                        <div class="card-header">
                                            <div class="card-body box-profile align-content-center">
                                                <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                                </div>
                                                <h3 class="text-center bold mb-0 mt-3 ">{{$dataUpacaraku->nama_upacara}}</h3>
                                                <p class="text-center mb-1 mt-1">{{$dataUpacaraku->Upacara->kategori_upacara}}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card tab-content">
                                        <!-- /.card-header -->
                                        <div class="card-header">
                                            <label class="card-title">Maps Lokasi Pemuput E-Yajamana</label>
                                        </div>
                                        <div class="card-body">
                                            <div id="gmaps" style="height: 450px;"></div>
                                        </div>
                                    </div>
                                </div>
                            <!-- TAHAPAN AWAL -->

                            <!-- TAHAPAN FORM DATA -->
                                <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                    <form id="formInput">
                                        <div class="card card-default col-12">
                                            <div class="row">
                                                <div class="col-12 col-sm-4">
                                                    <div class="card tab-content mb-0 m-4">
                                                        <!-- /.card-header -->
                                                        <div class="card-header">
                                                            <div class="card-body box-profile align-content-center">
                                                                <div class="text-center">
                                                                <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                                                </div>
                                                                <h3 id="in_nama_sulinggih" class="text-center bold mb-0 mt-3 "></h3>
                                                                <p id="in_email_sulinggih" class="text-center mb-1 mt-1"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4 d-flex align-items-center">
                                                    <div class="col-12 text-center">
                                                        <i class="fas fa-chevron-right"></i>
                                                        <i class="fas fa-chevron-right"></i>
                                                        <i class="fas fa-chevron-right"></i>
                                                        <i class="fas fa-chevron-right"></i>
                                                        <i class="fas fa-chevron-right"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="card tab-content mb-0 m-4">
                                                        <!-- /.card-header -->
                                                        <div class="card-header">
                                                            <div class="card-body box-profile align-content-center">
                                                                <div class="text-center">
                                                                <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                                                </div>
                                                                <h3 class="text-center bold mb-0 mt-3 ">{{$dataUpacaraku->nama_upacara}}</h3>
                                                                <p class="text-center mb-1 mt-1">{{$dataUpacaraku->Upacara->kategori_upacara}}</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card tab-content card-primary card-outline">
                                            <div class="card-header my-auto">
                                                <label class="card-title my-auto">Rentetan Upacara</label>
                                            </div>
                                            <div class="card-body">
                                                <div class="row justify-content-center">
                                                    <div class="col-12 col-sm-6">
                                                        <h4 class="text-center mb-3"> Awal </h4>
                                                        @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','awal') as $data)
                                                            <div id="card{{$data->id}}" class="card shadow collapsed-card mb-3">
                                                                <div class="card-header" aria-expanded="false">
                                                                    <!-- checkbox -->
                                                                    <div  class="icheck-primary d-inline ml-2">
                                                                        <input onclick="showDateTahapan({{$data->id}})" type="checkbox" name="id[]" value="{{$data->id}}" id="check{{$data->id}}">
                                                                        <input value="{{$data->nama_tahapan}}" name="nama_tahapan[]" type="hidden" class="d-none">
                                                                        <label class="form-check-label ml-3" for="todoCheck1">{{$data->nama_tahapan}}</label>
                                                                    </div>
                                                                </div>
                                                                <div id="body{{$data->id}}" class="card-body ml-3" style="display: none;">
                                                                    <div class="callout callout-danger container-fluid">
                                                                        <div>
                                                                            <p><i class="fas fa-info"></i>
                                                                                <strong class="ml-1"> Informasi : </strong>
                                                                                Harap di isi Jadwal Rentetan Upacara
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" id="inputDate-{{$data->id}}">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <h4 class="text-center mb-3"> Puncak </h4>
                                                        @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','puncak') as $data)
                                                            <div id="card{{$data->id}}" class="card shadow collapsed-card mb-3">
                                                                <div class="card-header" aria-expanded="false">
                                                                    <!-- checkbox -->
                                                                    <div  class="icheck-primary d-inline ml-2">
                                                                        <input onclick="showDateTahapan({{$data->id}})" type="checkbox" name="id[]" value="{{$data->id}}" id="check{{$data->id}}">
                                                                        <input value="{{$data->nama_tahapan}}" name="nama_tahapan[]" type="hidden" class="d-none">
                                                                        <label class="form-check-label ml-3" for="todoCheck1" >{{$data->nama_tahapan}}</label>
                                                                    </div>
                                                                    <div class="card-tools">
                                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                                            <i class="fas fa-caret-down float-lg-right"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div id="body{{$data->id}}" class="card-body mx-3" style="display: none;">
                                                                    <div class="callout callout-danger container-fluid">
                                                                        <div>
                                                                            <p>
                                                                                <i class="fas fa-info"></i>
                                                                                <strong class="ml-1"> Informasi : </strong>
                                                                                Harap di isi Jadwal Rentetan Upacara
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" id="inputDate-{{$data->id}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="col-12 col-sm-6 ">
                                                        <h4 class="text-center mb-3"> Akhir </h4>
                                                        @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','akhir') as $data)
                                                            <div id="card{{$data->id}}" class="card shadow collapsed-card mb-3">
                                                                <div class="card-header" aria-expanded="false">
                                                                    <!-- checkbox -->
                                                                    <div  class="icheck-primary d-inline ml-2">
                                                                        <input onclick="showDateTahapan({{$data->id}})" type="checkbox" name="id[]" value="{{$data->id}}" id="check{{$data->id}}">
                                                                        <input value="{{$data->nama_tahapan}}" name="nama_tahapan[]" type="hidden" class="d-none">
                                                                        <label class="form-check-label ml-3" for="todoCheck1">{{$data->nama_tahapan}}</label>
                                                                    </div>
                                                                    <div class="card-tools">
                                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                                            <i class="fas fa-caret-down float-lg-right"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div id="body{{$data->id}}" class="card-body" style="display: none;">
                                                                    <div class="callout callout-danger container-fluid">
                                                                        <div>
                                                                            <p>
                                                                                <i class="fas fa-info"></i>
                                                                                <strong class="ml-1"> Informasi : </strong>
                                                                                Harap di isi Jadwal Rentetan Upacara
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" id="inputDate-{{$data->id}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                            <button type="submit" class="btn btn btn-primary btn-sm float-lg-right center">Selanjutnya</button>
                                        </div>
                                    </form>
                                </div>
                            <!-- TAHAPAN FORM DATA -->

                            <!-- RANGKUMAN VIEW -->
                                <div id="next-part" class="content" role="tabpanel" aria-labelledby="next-part-trigger">
                                    <form action="{{route('krama.manajemen-reservasi.store')}}" method="POST">
                                        @csrf
                                        <input name="id_upacaraku" value="{{$dataUpacaraku->id}}" type="hidden" class="d-none">
                                        <div class="card card-default">
                                            <div class="card-body box-profile align-content-center">
                                                <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                                </div>
                                                <h3 class="text-center bold mb-0 mt-3">{{$dataUpacaraku->nama_upacara}}</h3>
                                                <p class="text-center mb-1 mt-1">{{$dataUpacaraku->Upacara->kategori_upacara}}</p>
                                            </div>
                                        </div>
                                        <div class="card card-default" id="dataPemuput">
                                            {{-- Data Pemuput --}}
                                        </div>
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <label class="card-title">Rententan Upacara yang di Reservasi</label>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body" id="listTahapanReservasi">
                                                {{-- Data List Reservasi  --}}
                                            </div>
                                            <div class="card-footer">
                                                <button type="button" class="btn btn-primary" onclick="backToReservasi()">Sebelumnya</button>
                                                <button type="submit" class="btn btn btn-primary btn-sm float-lg-right center">Buat Reservasi</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <!-- RANGKUMAN VIEW -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- MODAL DETAIL POPUP USER -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="card-body box-profile align-content-center">
                        <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                        </div>
                        <h3 class="text-center bold mb-0 mt-3" id="nama_griya"></h3>
                        <p class="text-center mb-1 mt-1" id="alamat"></p>
                    </div>
                </div>
                <div class="modal-body" id="dataSulinggih">
                    {{-- Data Sulinggih --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <!-- BS-Stepper -->
    <script src="{{asset('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{asset('base-template/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('base-template/dist/js/demo.js')}}"></script>

    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>

    <!-- jquery-validation -->
    <script src="{{asset('base-template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/jquery-validation/additional-methods.min.js')}}"></script>

    <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        $('#side-reservasi').addClass('menu-open');



    </script>
@endpush

@push('js')
    {{-- VALIDATE FORM --}}
    <script type="text/javascript">

        // ADD FUNCTION VALIDATE DATE RANGE
        jQuery.validator.addMethod("daterange", function(value, element){
            const dateNew  = value.split(" - ");
            const startDate = moment(new Date(dateNew[0]));
            const endDate = moment(new Date(dateNew[1]));
            if(startDate._isValid == true && endDate._isValid == true ){
                return true;
            }else{
                return false;
            }
        }, "Masukan tanggal dan waktu dengan benar!");
        // ADD FUNCTION VALIDATE DATE RANGE


        // ADD FUNCTION VALIDATE FORM INPUT
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    stepper.next()
                    setDataToRangkuman();
                }
            });
            $('#formInput').validate({
                rules: {
                'daterange[]': {
                    required: true,
                    daterange: true,
                },
                },
                messages: {
                'daterange[]': {
                    required: "Tanggal reservasi wajib diisi",
                    date: "Masukan tanggal dengan benar"
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

        //  BACK FUNCTION FORM
        function backToReservasi(){
            $("#listTahapanReservasi").empty();
            stepper.previous();
        }
        //  BACK FUNCTION FORM

        //  SET DATA TO RANGKUMAN
        function setDataToRangkuman(){
            var dateRange =  document.getElementsByName('daterange[]');
            var id_tahapan =  document.getElementsByName('id[]');
            var namaTahapan =  document.getElementsByName('nama_tahapan[]');
            for (var i = 0; i < dateRange.length; i++) {
                console.log(dateRange[i].value);
                $("#listTahapanReservasi").append(" <div class='card shadow mb-3'><div class='card-header' aria-expanded='false'><label class='form-check-label ml-3' for='todoCheck1'><strong> '"+namaTahapan[i].value+"'</strong></label><input type='hidden' class='d-none' name='data_detail["+i+"][idTahapan]' value='"+id_tahapan[i].value+"'><input type='hidden' class='d-none' name='data_detail["+i+"][tanggal]' value='"+dateRange[i].value+"'><div class='card-tools'><button type='button' class='btn btn-tool' data-card-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fas fa-caret-down float-lg-right'></i></button></div></div><div class='card-body ml-3'><div class='form-group'><p>Tanggal/Waktu Mulai - Selesai Rentetan Upacara :</p><div class='input-group'><div class='input-group-prepend'><span class='input-group-text'><i class='far fa-calendar-alt'></i></span></div><input disabled type='text' class='form-control float-right' value='"+dateRange[i].value+"'></div></div></div></div>");
            }
        }
        //  SET DATA TO RANGKUMAN

    </script>
    {{-- VALIDATE FORM --}}

    <script type="text/javascript">
        let dataPemuputKarya,dataSanggar,dataUpacaraku;

        // FUNCTION GET DATA PEMUPUT YANG DIPILIH
        function getPemuput(id,nama,tlpn,alamat,gender,tgldiksha,email){
            $("#myModal").modal('hide');
            stepper.next()
            $("#in_nama_sulinggih").html(nama);
            $("#in_email_sulinggih").html(email);
            $("#dataPemuput").append("<div class='card-header'><label class='card-title'>Pemuput Upacara</label><div class='card-tools'><button type='button' class='btn btn-tool' data-card-widget='collapse' title='Collapse'><i class='fas fa-plus'></i></button></div></div><div class='card-body box-profile align-content-center'><div class='text-center mb-2'><img class='profile-user-img img-fluid img-circle'  src='{{route('get-image.upacara',1)}}' alt='User profile picture'></div><div class='row mt-3'><div class='col-6'><input value='"+id+"' type='hidden' name='id_relasi' class='d-none'><input value='sulinggih_pemangku' name='tipe' type='hidden' class='d-none'><div class='form-group'><label>Nama Pemuput Upacara</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+nama+"' disabled=''></div><div class='form-group'><label>Nomer Handphone</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+tlpn+"' disabled=''></div><div class='form-group'><label>Email</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+email+"' disabled=''></div></div><div class='col-6'><div class='form-group'><label>Tanggal diDiksha</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+tgldiksha+"' disabled=''></div><div class='form-group'><label>Jenis Kelamin</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+gender+"' disabled=''></div><div class='form-group'><label>Alamat Lengkap Pemuput</label><input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='"+alamat+"' disabled></div></div></div></div>");
        };
        // FUNCTION GET DATA PEMUPUT YANG DIPILIH

        // FUNCTION KETIKA ADD RESERVASI
        function showDateTahapan(id) {
            var checkBox = document.getElementById("check"+id);
            var text = document.getElementById("body"+id);
            if (checkBox.checked == true){
                text.style.display = "block";
                $("#card"+id).removeClass("collapsed-card");
                $("#inputDate-"+id).append( "<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'><i class='far fa-clock'></i></span></div> <input name='daterange[]' id='reservationtime"+id+"' type='text' class='form-control float-right' value=''></div>");

                $('#reservationtime'+id).daterangepicker({
                    autoUpdateInput: false,
                    timePicker: true,
                    locale: {
                        format: 'MM/DD/YYYY hh:mm A',
                        cancelLabel: 'Clear'
                    },
                    drops: "up",
                })
                $('#reservationtime'+id).on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY hh:mm A') + ' - ' + picker.endDate.format('MM/DD/YYYY hh:mm A'));
                });
            }else {
                $("#inputDate-"+id).empty();
                $("#card"+id).addClass("collapsed-card");
                text.style.display = "none";
            }
        }
        // FUNCTION KETIKA ADD RESERVASI

        // FUNCTION TO VIEW MAPS AND MARKER
        $(document).ready(function(){

            let mymap = L.map('gmaps').setView([-8.5108504, 115.1005634], 10);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'E-Yajamana',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);

            // START INISIALISASI DATA
            dataSanggar = {!! json_encode($dataSanggar) !!}
            dataPemuputKarya = {!! json_encode($dataPemuputKarya) !!}
            dataUpacaraku = {!! json_encode($dataUpacaraku) !!}

            dataPemuputKarya.forEach(element => {
                createMarkerPemuputKarya(element.lat,element.lng,element.nama_griya_rumah,element.alamat_griya_rumah,element.sulinggih);
            });

            dataSanggar.forEach(element => {
                createMarkerSanggar(element.lat,element.lng,element.nama_sanggar);
            });
            // END INISIALISASI DATA


            //  FUNCTION CREATE MAREKER SANGGAR
            function createMarkerSanggar(lat,lng,namaSanggar){
                var icMarker = L.icon({
                    iconUrl: "{{asset('base-template/dist/img/marker/sanggar.png')}}",
                    iconSize: [36, 40],
                    iconAnchor: [8 , 40],
                    popupAnchor: [12, -28],
                });

                var marker = new L.marker([lat, lng],{
                    icon: icMarker,
                }).bindPopup(namaSanggar).addTo(mymap);

                marker.on('click', function() {
                    marker.openPopup();
                    $("#myModal").modal();
                });
            }

            //  FUNCTION CREATE MAREKER PEMUPUT-KARYA
            function createMarkerPemuputKarya(lat,lng,namaGriya,alamat,dataSulinggih){
                var icMarker = L.icon({
                    iconUrl: "{{asset('base-template/dist/img/marker/griya.png')}}",
                    iconSize: [36, 40],
                    iconAnchor: [8 , 40],
                    popupAnchor: [12, -28],
                });

                var marker = new L.marker([lat, lng],{
                    icon: icMarker,
                }).bindPopup(namaGriya).addTo(mymap);

                marker.on('click', function() {
                    marker.openPopup();
                    $("#myModal").modal();
                    // SET VALUE GRIYA
                    $("#nama_griya").html(namaGriya);
                    $("#alamat").html("Lokasi : "+alamat);
                    $("#dataSulinggih").empty();
                    // SET MODAL DATA SULINGGIH DAN PEMUPUT KARYA
                    dataSulinggih.forEach(data =>{
                        var fdate = new Date(data.tanggal_diksha)
                        var tanggal_tangkil = fdate.getDate().toString()+"-"+(fdate.getMonth()+1)+"-"+fdate.getFullYear()
                        $("#dataSulinggih").append("<div class='card shadow collapsed-card mt-3'><div class='card-header'><div class='user-block'><img class='img-circle' src='{{asset('base-template/dist/img/user1-128x128.jpg')}}' alt='User Image'><span class='username'><a class='ml-2' href='#'> "+data.nama_sulinggih+"</a></span><span class='description'><div class='ml-2 '> "+data.user.email+"</div></span></div><div class='card-tools'><button type='button' class='btn btn-tool' data-card-widget='collapse'><i class='fas fa-plus'></i></button></div></div><div class='card-body'><div class='row '><div class='col-7 d-flex justify-content-center align-items-center mb-2'><span style='font-size:80%' >Tanggal Diksha   :</span></div><div class='col-5'><span style='font-size:80%' > "+tanggal_tangkil+"</span></div><div class='col-7 d-flex justify-content-center align-items-center mb-2'><span style='font-size:80%' >Nomor Telepon :</span></div><div class='col-5'><span style='font-size:80%' > "+data.user.nomor_telepon+"</span></div></div></div><div class='card-footer' style='display: none;'><button type='button' class='btn btn btn-primary btn-sm float-lg-right' data-toggle='modal' onclick=\"getPemuput("+data.id+",'"+data.nama_sulinggih+"','"+data.user.nomor_telepon+"','"+alamat+"','"+data.jenis_kelamin+"','"+data.tanggal_diksha+"','"+data.user.email+"')\">Reservasi</button></div></div>");
                    });
                });
            }

        });
        // FUNCTION TO VIEW MAPS AND MARKER

    </script>

@endpush
