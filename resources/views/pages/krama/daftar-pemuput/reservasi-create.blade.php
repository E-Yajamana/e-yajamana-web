@extends('layouts.krama.krama-layout')
@section('tittle','Tambah Reservasi')

@push('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/fullcalendar/main.css')}}">
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Reservasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('krama.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah Reservasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row px-2">
            <div class="col-md-12">
            <!-- Profile Image -->
                <div class="card card-info card-outline">
                    <div class="card-header box-profile m-2">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="@if ($pemuput['tipe'] === "sanggar" ) {{route('image.profile.sanggar',$pemuput['id'])}} @else {{route('image.profile.user',$pemuput['id'])}} @endif" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center mb-0">{{$pemuput['nama']}}</h3>
                        <p class="text-muted text-center mb-0">
                            @if ($pemuput['tipe'] === "sanggar" )
                                Sanggar
                            @else
                                {{ucfirst($pemuput['tipe'])}}
                            @endif
                        </p>
                    </div>
                    <div class="card-body ">
                        <ul class="list-group list-group-horizontal-sm list-unstyled">
                            <li class="group-item mx-2"><a class="text-secondary text-sm px-1" ><i class="fas fa-square"></i></a>Pending</li>
                            <li class="group-item mx-2"><a class="text-primary  text-sm px-1" ><i class="fas fa-square"></i></a>Akan Datang</li>
                            <li class="group-item mx-2"><a class="text-success  text-sm px-1" ><i class="fas fa-square"></i></a>Selesai</li>
                        </ul>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <form action="{{route('krama.manajemen-reservasi.store')}}" method="POST">
                        @csrf
                        <input name="id_relasi" class="d-none" type="hidden" value="{{$pemuput['id']}}">
                        <input name="id_upacaraku" id="id_upacaraku" class="d-none" type="hidden" >
                        <input name="tipe" class="d-none" type="hidden" value="@if($pemuput['tipe'] === "sanggar" )sanggar @else pemuput_karya @endif">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Pilih Upacara Krama <span class="text-danger">*</span></label>
                                <select  id="id_upacara" name="id_upacara" class="form-control select2bs4 @error('id_upacara') is-invalid @enderror" style="width: 100%;">
                                    <option value="-1" selected>Pilih Upacara Krama</option>
                                    @foreach ($upacarakus as $key => $upacaraku)
                                        <option value="{{$key}}">{{$upacaraku->nama_upacara}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mulai - Tanggal Selesai Upacara <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input id="dateUpacara" disabled id="daterange" name="daterange" type="text" class="form-control float-right">
                                </div>
                            </div>
                            <div style="display: none;" id="tahapan">
                                <div class="card-header"></div>
                                <div class="row justify-content-center mt-4" id="tahapan">
                                    <div class="col-12 col-sm-6">
                                        <h4 class="text-center mb-3"> Awal </h4>
                                        <div id="awal"></div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <h4 class="text-center mb-3"> Puncak </h4>
                                        <div id="puncak"></div>
                                    </div>

                                    <div class="col-12 col-sm-6 ">
                                        <h4 class="text-center mb-3"> Akhir </h4>
                                        <div id="akhir"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn btn-primary btn-sm float-lg-right center">Buat Reservasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{asset('base-template/plugins/fullcalendar/main.js')}}"></script>

    <script>
        const upacarakus = {!! json_encode($upacarakus) !!};

        $("#id_upacara").change(function () {
            if(this.value == "-1"){
                $("#tahapan").hide();
                $("#awal").empty();
                $("#puncak").empty();
                $("#akhir").empty();
                $("#dateUpacara").val("");
            }else{
                const upacaraku = upacarakus[this.value];
                $("#id_upacaraku").val(upacaraku.id);
                $("#tahapan").show();
                $("#awal").empty();
                $("#puncak").empty();
                $("#akhir").empty();
                $("#dateUpacara").val(moment(upacaraku.tanggal_mulai).format('DD MMMM YYYY')+" - "+moment(upacaraku.tanggal_selesai).format('DD MMMM YYYY'));
                $.each(upacaraku.upacara.tahapan_upacara, function(key, tahapan_upacara){
                    $("#"+tahapan_upacara.status_tahapan).append(
                        '<div id="card-'+tahapan_upacara.id+'" class="card shadow collapsed-card mb-3">'+
                        '<div class="card-header" aria-expanded="false"><div  class="icheck-primary d-inline ml-2">'+
                        "<input onclick=\"showDateTahapan("+tahapan_upacara.id+",'"+upacaraku.tanggal_mulai+"','"+upacaraku.tanggal_selesai+"')\" type='checkbox' name='data_detail["+tahapan_upacara.id+"][idTahapan]' value='"+tahapan_upacara.id+"' id='check-"+tahapan_upacara.id+"'>"+
                        '<label class="form-check-label ml-3" for="todoCheck1">'+tahapan_upacara.nama_tahapan+'</label></div></div>'+
                        '<div id="body-'+tahapan_upacara.id+'" class="card-body ml-3" style="display: none;">'+
                        '<div class="callout callout-danger container-fluid"><div><p><i class="fas fa-info"></i><strong class="ml-1"> Informasi : </strong>Harap di isi Jadwal Rentetan Upacara</p></div></div>'+
                        '<div class="form-group" id="inputDate-'+tahapan_upacara.id+'"></div></div></div>'
                    );
                });
            }
        });

        function showDateTahapan(id,tanggal_mulai,tanggal_selesai) {
            var checkBox = document.getElementById("check-"+id);
            var text = document.getElementById("body-"+id);
            if (checkBox.checked == true){
                text.style.display = "block";
                $("#card-"+id).removeClass("collapsed-card");
                $("#inputDate-"+id).append( "<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'><i class='far fa-clock'></i></span></div> <input name='data_detail["+id+"][tanggal]' id='reservationtime"+id+"' type='text' class='form-control float-right' value=''></div>");
                $('#reservationtime'+id).daterangepicker({
                    autoUpdateInput: true,
                    timePicker: true,
                    timePicker24Hour: true,
                    "startDate": moment(tanggal_mulai).format('DD MMM YYYY'),
                    "endDate":  moment(tanggal_selesai).format('DD MMM YYYY'),
                    minDate: moment(tanggal_mulai).format('DD MMM YYYY'),
                    maxDate: moment(tanggal_selesai).add(23,'hours').add(59,'minutes').format('DD MMM YYYY H:mm'),
                    time: {
                        enabled: true
                    },
                    locale: {
                        format: 'DD MMM YYYY H:mm',
                        cancelLabel: 'Clear'
                    },
                    drops: "up",
                })
            }else {
                $("#inputDate-"+id).empty();
                $("#card-"+id).addClass("collapsed-card");
                text.style.display = "none";
            }
        }

    </script>
@endpush

