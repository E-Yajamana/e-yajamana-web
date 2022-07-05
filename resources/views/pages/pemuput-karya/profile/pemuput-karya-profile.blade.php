@extends('layouts.pemuput-karya.pemuput-karya-layout')

@section('tittle', 'My Profile')

@push('css')

<!-- daterange picker -->
<link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">

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
        <div class="container-fluid border-bottom">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1>Data Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('krama.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile Krama</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container-fluid px-0">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger text-center" role="alert">
                    <span>Terdapat kesalahan dalam penginputan data. Periksa kembali input data sebelumnya!</span>
                </div>
            @endif
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ asset('base-template/dist/img/logo-01.png') }}" alt="Profile Admin" width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center">{{Auth::user()->Penduduk->nama}}</h3>
                        <p class="text-muted text-center">{{Auth::user()->email}}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="fw-bold">Status</b>
                                <a class="float-right text-decoration-none link-dark">Krama Bali</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Jenis Kelamin</b>
                                <a class="float-right text-decoration-none link-dark">{{Auth::user()->Penduduk->jenis_kelamin}}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Terdaftar Sejak</b>
                                <a class="float-right text-decoration-none link-dark">{{date('d F Y',strtotime(Auth::user()->created_at))}}</a>
                            </li>
                        </ul>
                        <form action="{{route('auth.logout')}}">
                            <button type="submit" class="btn btn-outline-danger btn-block">
                                <b>Logout</b>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- RESERVASI RANGKUMAN -->
                <div class="card collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Rangkuman Reservasi </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                              <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                              <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-people-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Reservasi</p>
                                            <p class="text-lg">{{$rangkumanReservasi['jumlahReservasi']}}</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-person-lines-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Disetujui</p>
                                            <p class="text-lg">{{$rangkumanReservasi['jumlahDisetujui']}}</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-person-plus-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Proses</p>
                                            <p class="text-lg">{{$rangkumanReservasi['jumlahProses']}}</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-person-x-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Ditolak</p>
                                            <p class="text-lg">{{$rangkumanReservasi['jumlahTolak']}}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- RESERVASI RANGKUMAN -->
            </div>

            @livewire('profile')

        </div>
    </div>
@endsection

@push('js')
    <!-- select -->
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#side-pengaturan-akun').addClass('menu-is-opening menu-open');
            $('#side-profile').addClass('active');
        });

        $('#tanggal_lahir').daterangepicker({
            "singleDatePicker": true,
            "maxDate": moment(Date ()).format('DD MMMM YYYY'),
            locale: {
                format: 'DD MMMM YYYY',
            },
        });

        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })

    </script>

    <!-- Maps Pemetaan  -->
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            //--------------START Deklarasi awal seperti icon pembuatan map-------------//
            // var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 9);
            // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            //     attribution: 'Maps E-Yajamana',
            //     maxZoom: 18,
            //     minZoom: 9,
            //     id: 'mapbox/streets-v11',
            //     tileSize: 512,
            //     zoomOffset: -1,
            //     accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            // }).addTo(mymap);

            // document.getElementById("pemetaanTabs").onclick = function () {
            //     // document.getElementById('modal-xl').style.display = 'block';
            //     setTimeout(function() {
            //         mymap.invalidateSize();
            //     }, 100);c1
            // }
            // var curLocation = [0, 0];
            // if (curLocation[0] == 0 && curLocation[1] == 0) {
            //     curLocation = [-8.4517916, 115.1970086];
            // }
            // var marker = new L.marker(curLocation, {
            //     draggable: 'true'
            // });
            // marker.on('dragend', function(event) {
            //     var position = marker.getLatLng();
            //     marker.setLatLng(position, {
            //     draggable: 'true'
            //     }).bindPopup(position).update();
            //     $("#lat").val(position.lat);
            //     $("#lng").val(position.lng).keyup();
            //     $("#view_lat").val(position.lat);
            //     $("#view_lng").val(position.lng);
            // });
            // $("#Latitude, #Longitude").change(function() {
            //     var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
            //     marker.setLatLng(position, {
            //     draggable: 'true'
            //     }).bindPopup(position).update();
            //     mymap.panTo(position);
            // });
            // mymap.addLayer(marker);
        })
    </script>
    <!-- Maps Pemetaan  -->
@endpush

<!-- AJAX PEMROSEAN  -->
@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // AJAX UPDATE PASSWORD USER
        $("#btnPassword").click(function(){
            let passwordOld = $('#password_lama').val();
            let newPassword = $('#password').val();
            let newPasswordConfirmation = $('#password_confirmation').val();

            $.ajax({
                url: "{{ route('profile.password.update')}}",
                type:'PUT',
                data: {
                    password_lama : passwordOld,
                    password : newPassword,
                    password_confirmation: newPasswordConfirmation,
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
                    });
                    $.each(response.field, function(prefix,val){
                        console.log(val);
                        $('#'+val).text('');
                        $('#'+val).val('');
                        $('#'+val).removeClass('is-invalid')
                    });
                },
                error: function(response, error){
                    $('#password_lama').val('');
                    $('#password').val('');
                    $('#password_confirmation').val('');

                    Swal.fire({
                        icon: response.responseJSON.icon,
                        title: response.responseJSON.title,
                        text: response.responseJSON.message
                    });
                    $.each(response.responseJSON.data, function(prefix, val){
                        $('#'+prefix+'_error').text(val[0]);
                        $('#'+prefix).addClass('is-invalid')
                    });
                }
            });

        });
        // AJAX UPDATE PASSWORD USER

        // AJAX UPDATE AKUN
        $("#btnAkun").click(function(){
            let email = $("#email").val()
            let nomor_telepon = $("#nomor_telepon").val()

            $.ajax({
                url: "{{ route('profile.akun.update')}}",
                type:'PUT',
                data: {
                    email : email,
                    nomor_telepon : nomor_telepon,
                    "_method":"PUT",
                    "_token":"{{ csrf_token() }}"
                },
                success:function(response){
                    console.log(response)
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    });
                    $.each(response.field, function(prefix,val){
                        console.log(val);
                        $('#'+val+'_error').text('');
                        $('#'+val).removeClass('is-invalid')
                    });
                },
                error: function(response, error){
                    console.log(response)

                    Swal.fire({
                        icon: response.responseJSON.icon,
                        title: response.responseJSON.title,
                        text: response.responseJSON.message
                    });
                    $.each(response.responseJSON.data, function(prefix, val){
                        $('#'+prefix+'_error').text(val[0]);
                        $('#'+prefix).addClass('is-invalid')
                    });
                }
            });

        });
        // AJAX UPDATE AKUN

        // DATA DIRI AJAX UPDATE
        $("#btnDataDiri").click(function(){
            var nik = $("#nik").val();
            var nama = $("#nama").val();
            var nama_alias = $("#nama_alias").val();
            var gelar_depan = $("#gelar_depan").val();
            var gelar_belakang = $("#gelar_belakang").val();
            var tempat_lahir = $("#tempat_lahir").val();
            var tanggal_lahir = $("#tanggal_lahir").val();
            var jenis_kelamin = $("#jenis_kelamin").val();
            var golongan_darah = $("#golongan_darah").val();
            var agama = $("#agama").val();
            var status_perkawinan = $("#status_perkawinan").val();
            var pendidikan = $("#pendidikan").val();
            var profesi = $("#profesi").val();

            console.log(jenis_kelamin)

            $.ajax({
                url: "{{ route('profile.data-diri.update')}}",
                type:'PUT',
                data: {
                    profesi_id : profesi ,
                    pendidikan_id : pendidikan,
                    agama : agama,
                    nama : nama,
                    nama_alias :  nama_alias,
                    gelar_depan : gelar_depan,
                    gelar_belakang : gelar_belakang ,
                    tempat_lahir : tempat_lahir ,
                    tanggal_lahir : tanggal_lahir ,
                    jenis_kelamin : jenis_kelamin,
                    golongan_darah : golongan_darah,
                    status_perkawinan : status_perkawinan ,
                    "_method":"PUT",
                    "_token":"{{ csrf_token() }}"
                },
                success:function(response){
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    });
                    $(".data-diri").removeClass("is-invalid");
                    $("div.data-diri").text('');
                },
                error: function(response, error){
                    console.log(response)
                    $.each(response.responseJSON.data, function(prefix, val){
                        $('#'+prefix+'_error').text(val[0]);
                        $('#'+prefix).addClass('is-invalid')
                    });
                    Swal.fire({
                        icon: response.responseJSON.icon,
                        title: response.responseJSON.title,
                        text: response.responseJSON.message
                    });
                }
            });
        });
        // DATA DIRI AJAX UPDATE

    </script>
@endpush



