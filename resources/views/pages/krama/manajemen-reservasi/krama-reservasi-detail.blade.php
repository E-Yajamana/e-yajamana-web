@extends('layouts.krama.krama-layout')
@section('tittle','Data Upacaraku')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Reservasi Upacara {{$dataReservasi->Upacaraku->nama_upacara}} </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Reservasi</a></li>
                        <li class="breadcrumb-item active">Detail Reservasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class=" container-fluid">
        <div class="card tab-content">
            <!-- /.card-header -->
            <div class="card-header">
                <div class="card-body box-profile align-content-center">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle" src="{{route('get-image.profile.pemuput-karya',$dataReservasi->Relasi->id)}}" alt="User profile picture">
                    </div>
                    <h3 class="text-center bold mb-0 ">{{$dataReservasi->Relasi->getRelasi($dataReservasi->tipe)->nama}}</h3>
                    <p class="text-center">Tanggal Upacara : {{date('d F Y',strtotime($dataReservasi->Upacaraku->tanggal_mulai))}} - {{date('d F Y',strtotime($dataReservasi->Upacaraku->tanggal_selesai))}}</p>
                    <div class="d-flex justify-content-center mt-2 text-center" id="view_status">
                        <div @if ($dataReservasi->status  == 'pending') class="bg-secondary btn-sm" @elseif ($dataReservasi->status == 'proses tangkil' || $dataReservasi->status == 'proses muput') class="bg-primary btn-sm" @elseif ($dataReservasi->status == 'selesai') class="bg-success btn-sm" @else class="bg-danger btn-sm" @endif style="border-radius: 5px; width:110px;">{{Str::ucfirst($dataReservasi->status)}}</div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class='col-6'>
                        <div class='form-group'>
                            <label>Nama @if ($dataReservasi == 'sanggar') Sanggar @else Panggilan @endif</label>
                            <input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='{{$dataReservasi->Relasi->Penduduk->nama}}' disabled=''>
                        </div>
                        <div class='form-group'>
                            <label>Nomer Handphone</label>
                            <input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='{{$dataReservasi->Relasi->nomor_telepon}}' disabled=''>
                        </div>
                    </div>
                    <div class='col-6'>
                        <div class='form-group'>
                            <label>Alamat Lengkap</label>
                            <input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='{{$dataReservasi->Relasi->Penduduk->alamat}}' disabled=''>
                        </div>
                        <div class='form-group'>
                            <label>Email</label>
                            <input type='text' class='form-control' id='exampleInputEmail1' placeholder='Enter email' value='{{$dataReservasi->Relasi->email}}' disabled=''>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card tab-content">
            <div class="card-header">
                <label>Tahapan yang direservasi</label>

            </div>
            <div class="card-body">
                <div class="table-responsive mailbox-messages p-2">
                    <table id="" class="table table-bordered table-hover mx-auto table-responsive-sm">
                        <thead >
                            <tr>
                                <th>No</th>
                                <th>Nama Tahapan</th>
                                <th>Waktu Mulai Tahapan</th>
                                <th>Waktu Selesai Tahapan</th>
                                <th class="text-center">Status</th>
                                @if ($dataReservasi->status == 'pending' || $dataReservasi->status == 'proses tangkil')
                                    <th id="action" class="text-center">Tindakan</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="dataView">
                            @foreach ($dataReservasi->DetailReservasi as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->TahapanUpacara->nama_tahapan}}</td>
                                    <td>{{date('d F Y',strtotime($data->tanggal_mulai))}}</td>
                                    <td>{{date('d F Y',strtotime($data->tanggal_selesai))}}</td>
                                    <td class="d-flex justify-content-center text-center">
                                        <span @if ($data->status == 'pending') class="bg-secondary btn-sm" @elseif ($data->status == 'diterima') class="bg-primary btn-sm" @elseif ($data->status == 'selesai') class="bg-success btn-sm"  @elseif ($data->status == 'ditolak' || $data->status == 'batal' ) class="bg-danger btn-sm" @else class="bg-info btn-sm" @endif style="border-radius: 5px; width:110px;">{{Str::ucfirst($data->status)}}</span>
                                    </td>
                                    @if ($dataReservasi->status == 'pending' || $dataReservasi->status == 'proses tangkil')
                                        @if ($data->status == 'pending' || $data->status == 'diterima')
                                            <td class="text-center">
                                                <a onclick="updateData({{$data->id}},{{$data->TahapanUpacara->id}},'{{$data->TahapanUpacara->nama_tahapan}}','{{$data->tanggal_mulai}}','{{$data->tanggal_selesai}}','{{$data->status}}')" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <button onclick="batalReservasi({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                                            </td>
                                        @else
                                            <td class="text-center"></td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12 my-2">
                    <a href="{{route('krama.manajemen-reservasi.index')}}" class="btn btn-secondary">Kembali</a>
                    @if ($dataReservasi->status == 'pending' || $dataReservasi->status == 'proses tangkil')
                        <button id="addTahapanReservasi" onclick="modalAdd()" type="button" class="btn btn-primary float-right" align-self="end">Tambah Reservasi</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" class="d-none" id="tanggal_mulai" value="{{$dataReservasi->Upacaraku->tanggal_mulai}}">
    <input type="hidden" class="d-none" id="tangagl_selesai" value="{{$dataReservasi->Upacaraku->tanggal_selesai}}">

    {{-- modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Reservasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addData" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="d-none" value="{{$dataReservasi->id}}" id="id_reservasi">
                        <input type="hidden" class="d-none" value="" id="id_detail_reservasi">
                        <input type="hidden" class="d-none" value="" id="status_reservasi">
                        <input id="status" type="hidden" class="d-none">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Upacara</label>
                            <input disabled id="nama_tahapan" type="text" name="nama_tahapan" class="form-control @error('nama_tahapan') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Tahapan" value="{{$dataReservasi->Upacaraku->Upacara->nama_upacara}}">
                            <div class="text-sm text-danger text-start nama_tahapan_error" id="nama_tahapan_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Mulai - Selesai Upacara</label>
                            <input disabled id="nama_tahapan" type="text" name="nama_tahapan" class="form-control @error('nama_tahapan') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Tahapan" value="{{date('d M Y',strtotime($dataReservasi->Upacaraku->tanggal_mulai))}} - {{date('d M Y',strtotime($dataReservasi->Upacaraku->tanggal_selesai))}}">
                            <div class="text-sm text-danger text-start nama_tahapan_error" id="nama_tahapan_error"></div>
                        </div>
                        <div class="form-group">
                            <label>Tahapan Upacara <span class="text-danger">*</span></label>
                            <select id="id_tahapan_upacara" name="id_tahapan_upacara" class="select2bs4 form-control  @error('status') is-invalid @enderror" style="width: 100%;">
                                 <option disabled selected>Pilih Tahapan Upacara</option>
                            </select>
                            <div class="text-sm text-danger text-start id_tahapan_upacara_error" id="id_tahapan_upacara_error"></div>
                        </div>
                        <div class="form-group mb-4">
                            <label>Waktu Mulai - Selesai <span class="text-danger">*</span></label>
                            <div class='input-group'>
                                <div class='input-group-prepend'><span class='input-group-text'><i class='far fa-calendar'></i></span></div>
                                <input name='daterange' id='reservationtime' type='text' class='form-control float-right' value=''>
                            </div>
                            <div class="text-sm text-danger text-start daterange_error" id="daterange_error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button id="createData" type="button" class="btn btn-primary">Tambah Reservasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal --}}
    <input type="hidden" id="tanggalMulai" value="{{$dataReservasi->Upacaraku->tanggal_mulai}}" class="d-none">
    <input type="hidden" id="tanggalSelesai" value="{{$dataReservasi->Upacaraku->tanggal_selesai}}" class="d-none">

@endsection

@push('js')
    <!-- jquery-validation -->
    <script src="{{asset('base-template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <!-- InputMask -->
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-reservasi').addClass('menu-open');
            $('#side-data-reservasi').addClass('active');
        });

        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-upacara').addClass('active');
        });

        $('#mySelect2').select2('data');

        $('.select2').select2()

        //Initialize Select2 Elementss
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $(function () {
            bsCustomFileInput.init();
        });

        let tanggalMulai = $('#tanggalMulai').val();
        let tanggalSelesai = $('#tanggalSelesai').val();
        console.log(tanggalMulai)

        $('#reservationtime').daterangepicker({
            autoUpdateInput: true,
            timePicker: true,
            "startDate": moment(tanggalMulai).format('DD MMMM YYYY'),
            "endDate":  moment(tanggalSelesai).format('DD MMMM YYYY'),
            minDate: moment(tanggalMulai).format('DD MMMM YYYY'),
            maxDate: moment(tanggalSelesai).format('DD MMMM YYYY'),
            locale: {
                format: 'DD MMMM YYYY hh:mm A',
                cancelLabel: 'Clear'
            },
            drops: "up",
        })

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>
@endpush

@push('js')
    <script type="text/javascript">

        getDataTahapanReservasi()

        function modalAdd (){
            getDataTahapanReservasi()
            $("#exampleModal").modal();
            $('#status').val('add');
        }

        // EDIT DATA RESERVASI
        function updateData(idDetail,id,nama,start,end,status){
            console.log(status)
            $(".update-data").remove()
            $('#reservationtime').daterangepicker({
                timePicker: true,
                minDate: moment(tanggalMulai).format('DD MMMM YYYY'),
                maxDate: moment(tanggalSelesai).format('DD MMMM YYYY'),
                startDate: moment(start).format('DD MMMM YYYY hh:mm A'),
                endDate:moment(end).format('DD MMMM YYYY hh:mm A'),
                locale: {
                    format: 'DD MMMM YYYY hh:mm A',
                },
                drops: "up",
            });
            $("#id_tahapan_upacara").append('<option class="update-data" selected value="'+id+'">'+nama+'</option>');
            $('#id_detail_reservasi').val(idDetail);
            $('#status_reservasi').val(status);
            $('#status').val('update');
            $('#createData').text('Update Data');
            $("#exampleModal").modal();
        }
        // EDIT DATA RESERVASI

        // FINAL PENENTUAN DATA UPDATE OR STORE DATA
        $('#createData').click(function(){
            var form = $("#addData");
            let status = $("#status").val()
            if(form.valid()==true){
                if(status == 'update'){
                    ajaxEditData()
                }else{
                    ajaxPostData();
                }
            }
        });
        // FINAL PENENTUAN DATA UPDATE OR STORE DATA

        // VALIDATOR FORM INPUT ADD MODAL
        $('#addData').validate({
            rules: {
                'daterange': {
                    required: true,
                    validationDate:true
                },
            },
            messages: {
                'daterange': {
                    required: "Tanggal reservasi wajib diisi",
                    validationDate : "Tanggal yang anda masukan tidak sesuai dengan tanggal upacara"
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
        // VALIDATOR FORM INPUT MODAL

        // ADD FUNCTION VALIDATE DATE RANGE
        jQuery.validator.addMethod("validationDate", function(value, element){
            let start = $("#tanggal_mulai").val()
            let end = $("#tangagl_selesai").val()
            var tanggal_mulai = moment(start).format('YYYY-MM-DD')
            var tanggal_selesai = moment(end).format('YYYY-MM-DD')

            moment(tanggal_awal).isBetween(tanggal_mulai, tanggal_selesai, undefined, '[]');

            const dateNew  = value.split(" - ");
            var tanggal_awal = moment(dateNew[0]).format('YYYY-MM-DD');
            var tanggal_akhir = moment(dateNew[1]).format('YYYY-MM-DD');
            if(moment(tanggal_awal).isBetween(tanggal_mulai, tanggal_selesai, undefined, '[]') == true && moment(tanggal_akhir).isBetween(tanggal_mulai, tanggal_selesai, undefined, '[]') ){
                return true;
            }else{
                return false;
            }
        }, "Masukan tanggal dan waktu dengan benar!");
        // ADD FUNCTION VALIDATE DATE RANGE

        // FUNGSI GET DATA TAHAPAN RESERVASI FOR INPUT RESERVASI
        function getDataTahapanReservasi(){
            let idReservasi = $("#id_reservasi").val();
            $.ajax({
                url: "{{route('ajax.get.tahapan-reservasi')}}/" + idReservasi,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.data != 0) {
                        $('#id_tahapan_upacara').empty();
                        $('#id_tahapan_upacara').append('<option value="0" disabled selected>Pilihlah Tahapan Upacara</option>');
                        $.each(response.data, function (key, data) {
                            $('#id_tahapan_upacara').append('<option value="' + data.id + '">' + data.nama_tahapan + '</option>');
                        });
                    }else {
                        $('#id_tahapan_upacara').empty();
                        $('#id_tahapan_upacara').append('<option value="0" disabled selected>Semua data tahapan sudah direservasi!</option>');
                    }
                }
            })
        }
        // FUNGSI GET DATA TAHAPAN RESERVASI FOR INPUT RESERVASI
    </script>
@endpush

{{-- ajax crud transaksi --}}
@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // FUNGSI EDIT DATA RESERVASI
        function ajaxEditData(id){
            let id_reservasi = $('#id_reservasi').val();
            let id_detail_reservasi = $('#id_detail_reservasi').val();
            let id_tahapan_upacara = $('#id_tahapan_upacara').val();
            let daterange = $('#reservationtime').val();
            let status = $('#status_reservasi').val();

            console.log(status)
            $.ajax({
                url: "{{ route('krama.manajemen-reservasi.ajax.update')}}",
                type:'PUT',
                data: {
                    id_reservasi : id_reservasi,
                    id_detail_reservasi:id_detail_reservasi,
                    id_tahapan_upacara:id_tahapan_upacara,
                    daterange:daterange,
                    status:status,
                    "_method":"PUT",
                    "_token":"{{ csrf_token() }}"
                },
                beforeSend:function(){
                    $(document).find('div.invalid-feedback').text('');
                },
                success:function(response){
                    console.log(response)
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                    $('#addData')[0].reset();
                    $("#exampleModal").modal('hide');
                    $("#dataView").empty();
                    $.each(response.data, function(key, data){
                        appendData(key,data.tahapan_upacara.nama_tahapan,data.tanggal_mulai,data.tanggal_selesai,data.status,data.id,data.tahapan_upacara.id ,data.reservasi.status)
                    });
                },
                error: function(response, error){
                    console.log(response);
                    $.each(response.responseJSON.error, function(prefix, val){
                        $('#'+prefix+'_error').text(val[0]);
                    });
                }
            });
        }
        // FUNGSI EDIT DATA RESERVASI

        // FUNGSI DELETE DATA RESERVASI
        function ajaxDeleteData(id){
            let id_reservasi = $('#id_reservasi').val();

            $.ajax({
                url: "{{ route('krama.manajemen-reservasi.ajax.delete')}}",
                type:'PUT',
                data: {
                    id_reservasi:id_reservasi,
                    id_detail_reservasi:id,
                    "_method":"PUT",
                    "_token":"{{ csrf_token() }}"
                },
                beforeSend:function(){
                    $(document).find('div.invalid-feedback').text('');
                },
                success:function(response){
                    console.log(response)
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                    $('#addData')[0].reset();
                    $("#dataView").empty();
                    $.each(response.data, function(key, data){
                        console.log(data)
                        appendData(key,data.tahapan_upacara.nama_tahapan,data.tanggal_mulai,data.tanggal_selesai,data.status,data.id,data.tahapan_upacara.id ,data.reservasi.status)
                    });
                },
                error: function(response, error){
                    console.log(response);
                    $.each(response.responseJSON.error, function(prefix, val){
                        $('#'+prefix+'_error').text(val[0]);
                    });
                }
            });
        }
        // FUNGSI DELETE DATA RESERVASI

        // FUNGSI ADD DATA RESERVASI BARU
        function ajaxPostData(){
            let id_reservasi = $('#id_reservasi').val();
            let id_tahapan_upacara = $('#id_tahapan_upacara').val();
            let daterange = $('#reservationtime').val();

            $.ajax({
                url: "{{ route('krama.manajemen-reservasi.ajax.store')}}",
                type:'POST',
                data: {
                    id_reservasi:id_reservasi,
                    id_tahapan_upacara:id_tahapan_upacara,
                    daterange:daterange,
                    "_token":"{{ csrf_token() }}"
                },
                beforeSend:function(){
                    $(document).find('div.invalid-feedback').text('');
                },
                success:function(response){
                    console.log(response)
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                    $('#addData')[0].reset();
                    $("#exampleModal").modal('hide');
                    $("#dataView").empty();
                    $.each(response.data, function(key, data){
                        appendData(key,data.tahapan_upacara.nama_tahapan,data.tanggal_mulai,data.tanggal_selesai,data.status,data.id,data.tahapan_upacara.id ,data.reservasi.status)
                    });
                },
                error: function(response, error){
                    console.log(response);
                    $.each(response.responseJSON.error, function(prefix, val){
                        $('#'+prefix+'_error').text(val[0]);
                    });
                }
            });
        }
        // FUNGSI ADD DATA RESERVASI BARU

        function capitalizeFirstLetter(string){
            return string.charAt(0).toUpperCase() + string.slice(1);
        }


        // FUNGSI APPEND DATA
        function appendData(no,nama_tahapan, tanggal_mulai ,tanggal_selesai, status,id_detail, id_tahapan_upacara, status_reservasi){
            no++
            if(status_reservasi == 'batal'){
                $("#view_status").empty();
                $('#action').remove();
                $('#addTahapanReservasi').remove();
                $("#view_status").append('<div class="bg-danger btn-sm" style="border-radius: 5px; width:100px;">Batal</div>');
            }

            $("#dataView").append(
                '<tr>'+
                '<td>'+no+'</td>'+
                '<td>'+nama_tahapan+'</td>'+
                '<td>'+moment(tanggal_mulai).format('DD MMMM YYYY')+'</td>'+
                '<td>'+moment(tanggal_selesai).format('DD MMMM YYYY')+'</td>'+
                '<td class="d-flex justify-content-center text-center"><span '+
                (status == 'pending' ? 'class="bg-secondary btn-sm"' : '')+
                (status == 'diterima' ? 'class="bg-primary btn-sm"' : '')+
                (status == 'ditolak' ? 'class="bg-danger btn-sm"' : '')+
                (status == 'selesai' ? 'class="bg-success btn-sm"' : '')+
                (status == 'batal' ? 'class="bg-danger btn-sm"' : '')+
                'style="border-radius: 5px; width:110px;">'+capitalizeFirstLetter(status)+'</span>'+
                '</td>'+
                (status == 'pending' || status == 'proses tangkil' ? "<td class='text-center'> <a onclick=\"updateData("+id_detail+","+id_tahapan_upacara+",'"+nama_tahapan+"','"+tanggal_mulai+"','"+tanggal_selesai+"','"+status+"')\" class='btn btn-primary btn-sm mx-1'><i class='fas fa-edit'></i></a>" : "" )+
                (status == 'batal' ? "<td class='text-center'></td>" : "" )+
                (status == 'pending' || status == 'proses tangkil'  ? '<button onclick="batalReservasi('+id_detail+')" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></td>' : '')+
                '</tr>'
            );
        }
        // FUNGSI APPEND DATA
    </script>

@endpush
{{-- ajax crud transaksi --}}

@push('js')
    <script>
        function batalReservasi(id){
            Swal.fire({
                title: 'Peringatan',
                text : 'Apakah anda yakin akan membatalkan tahapan reservasi tersebut?',
                icon:'warning',
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: `Batal`,
                denyButtonText: `Cancel`,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    ajaxDeleteData(id);
                } else if (result.isDenied) {

                }
            })
        }
    </script>
@endpush



