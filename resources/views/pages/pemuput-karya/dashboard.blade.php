@extends('layouts.pemuput-karya.pemuput-karya-layout')
@section('tittle','Dashboard')

@push('css')
<!-- fullCalendar -->
<link rel="stylesheet" href="{{asset('base-template/plugins/fullcalendar/main.css')}}">
@endpush


@section('content')

    <div class="container-fluid">
        <!-- COUNT DATA -->
        <div class="row mt-2">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{$countData['countMuput']}}</h3>
                        <p>Jumlah Jadwal Muput</p>
                    </div>
                    <div class="icon">
                        <i class="fa bi-brightness-high-fill nav-icon"></i>
                    </div>
                    <a href="{{route('pemuput-karya.muput-upacara.konfirmasi-muput.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$countData['countTangkil']}}</h3>
                        <p>Jumlah Krama Akan Tangkil</p>
                    </div>
                    <div class="icon">
                        <i class="fa bi-brightness-high-fill nav-icon"></i>
                    </div>
                    <a href="{{route('pemuput-karya.muput-upacara.konfirmasi-tangkil.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$countData['countReservasiMasuk']}}</h3>
                            <p>Jumlah Reservasi Masuk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{route('pemuput-karya.manajemen-reservasi.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$countData['countReservasi']}}</h3>
                        <p>Total Reservasi Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a href="{{route('pemuput-karya.manajemen-reservasi.riwayat.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- COUNT DATA -->


        <!-- BAGIAN 3 DASHBOARD-->
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="card" style="height:724px">
                    <div class="card-header">
                        <label class="card-title"  id="judulKalender">Jadwal Reservasi </label>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-horizontal-sm list-unstyled mb-2">
                            <li class="group-item mx-2"><a class="text-secondary text-sm px-2" ><i class="fas fa-square-full"></i></a>Pending</li>
                            <li class="group-item mx-2"><a class="text-primary  text-sm px-2" ><i class="fas fa-square-full"></i></a>Akan Datang</li>
                            <li class="group-item mx-2"><a class="text-success  text-sm px-2" ><i class="fas fa-square-full"></i></a>Selesai</li>
                        </ul>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card" style="height:724px">
                    <div class="card-header">
                        <label class="card-title"  id="judulKalender"><i class="fas fa-bullhorn mr-2"></i></i>Reservasi Akan Datang </label>
                    </div>
                    <div class="card-body">
                         <!-- Timelime example  -->
                        <div class="row h-100">
                            <div class="col-md-12 mt-3">
                                <div class="@if ($dataJadwal->count() != 0) timeline @else h-100 @endif">
                                    @if($dataJadwal->count() != 0)
                                        <div class="time-label">
                                            <span class="bg-info">{{date('d F Y')}}</span>
                                        </div>
                                    @endif
                                    @forelse ($dataJadwal as $key  => $reservasi)
                                        @if (date('d M Y') === date('d M Y',strtotime($reservasi->tanggal_tangkil)))
                                            <div>
                                                {{-- <i class="fas fa-angle-right "></i> --}}
                                                <i class="fas fa-map-marker-alt bg-success"></i>
                                                <div class="timeline-item">
                                                    <span class="time"></span>
                                                    <h3 class="timeline-header"><a href="#"></a> Kedatangan {{$reservasi->Upacaraku->User->Penduduk->nama}} Tangkil ke Griya || {{date('H:m',strtotime($reservasi->tanggal_tangkil))}} </h3>
                                                    <div class="timeline-body">
                                                        Hallo Pemuput Karya, terdapat jadwal Krama yang akan tangkil ke Griya pada Jam {{date('H:m',strtotime($reservasi->tanggal_tangkil))}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @foreach ($reservasi->DetailReservasi as $detailReservasi)
                                            <div>
                                                <i class="fas fa-angle-right bg-info"></i>
                                                <div class="timeline-item">
                                                    <span class="time"></span>
                                                    <h3 class="timeline-header"><a href="#"></a> Muput {{$detailReservasi->TahapanUpacara->nama_tahapan}}</h3>
                                                    <div class="timeline-body">
                                                        Hallo Pemuput Karya, terdapat jadwal Muput Upacara pada karya {{$reservasi->Upacaraku->nama_upacaraku}} yang dimulai pada jam 09:20 WITA berlangsung di
                                                        {{$reservasi->Upacaraku->alamat_upacaraku}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @empty
                                        <div class="h-100 d-flex justify-content-center align-items-center ">
                                            <div class="media">
                                                <div class="media-body text-center mb-2 ">
                                                    <i class="fa-4x bi-brightness-high-fill text-secondary"></i>
                                                    <div class="d-flex justify-content-center">
                                                        <p class="text-md text-center mt-1 w-75">Tidak ada jadwal muput pada Tanggal {{date('d M Y')}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                    @if($dataJadwal->count() != 0)
                                        <div>
                                            <i class="fas fa-clock bg-gray"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('pemuput-karya.muput-upacara.konfirmasi-muput.index')}}" class="uppercase">Lihat Semua Jadwal Muput</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- BAGIAN 3 DASHBOARD-->

    </div>
@endsection

@push('js')
<!-- ChartJS -->
<script src="{{asset('base-template/plugins/chart.js/Chart.min.js')}}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{asset('base-template/plugins/fullcalendar/main.js')}}"></script>
<script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>

<script>
    $('#side-dashboard').addClass('menu-open');
</script>

<script>
    let dataPemuputKarya,dataSanggar,dataUpacaraku;
    let blue,green,grey,yellow;
    blue = '#3c8dbc';
    green = '#00a65a';
    grey = '#808080';
    yellow = '#f39c12';
    showJadwal({{Auth::user()->id}},'id_relasi');

    // JADWAL PEMUPUT
    function showJadwal(id,tipe)
    {
        $.ajax({
            url: "{{ route('ajax.jadwal-reservasi-pemuput')}}",
            type:'POST',
            data: {
                id:id,
                tipe:tipe,
                "_token":"{{ csrf_token() }}"
            },
            success:function(response){
                var evetArray = []; // DATA KESELURUHAN
                var dataArray = {}; // DATA TANGKIL
                var dataDetailArray = {}; // DATA DETAIL RESERVASI
                $.each(response.data, function(key, dataReservasi){
                    // console.log(data);
                    if(dataReservasi.status == 'pending'){
                        dataArray.backgroundColor  = grey,
                        dataArray.borderColor = grey,
                        dataArray.extendedProps = {
                            status : 'Pending'
                        }
                    }else if(dataReservasi.status == 'proses tangkil'){
                        dataArray.backgroundColor = blue,
                        dataArray.borderColor = blue,
                        dataArray.extendedProps = {
                            status : 'Akan Datang'
                        }
                    }else{
                        dataArray.backgroundColor  = green,
                        dataArray.borderColor = green,
                        dataArray.extendedProps = {
                            status : 'Selesai'
                        }
                    }
                    dataArray.title = "Tangkil Upacara "+dataReservasi.upacaraku.nama_upacara,
                    dataArray.start = dataReservasi.tanggal_tangkil,
                    dataArray.allDay = false
                    evetArray.push({...dataArray});
                    $.each(dataReservasi.detail_reservasi, function(key, dataDetailReservasi){
                        if(dataDetailReservasi.status == 'pending'){
                            dataDetailArray.backgroundColor  = grey,
                            dataDetailArray.borderColor = grey,
                            dataDetailArray.extendedProps = {
                                status : 'Pending'
                            }
                        }else if(dataDetailReservasi.status == 'diterima'){
                            dataDetailArray.backgroundColor  = blue,
                            dataDetailArray.borderColor = blue,
                            dataDetailArray.extendedProps = {
                                status : 'Akan Datang'
                            }
                        }else if(dataDetailReservasi.status == 'selesai'){
                            dataDetailArray.backgroundColor  = green,
                            dataDetailArray.borderColor = green,
                            dataDetailArray.extendedProps = {
                                status : 'Selesai'
                            }
                        }
                        dataDetailArray.title = "Muput Upacara "+dataDetailReservasi.tahapan_upacara.nama_tahapan,
                        dataDetailArray.start = dataDetailReservasi.tanggal_mulai,
                        dataDetailArray.end = dataDetailReservasi.tanggal_selesai,
                        dataDetailArray.allDay = false
                        evetArray.push({...dataDetailArray});
                    })
                });
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    events: evetArray,
                    headerToolbar: {
                        left: 'prev,next,today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    themeSystem : 'bootstrap',
                    height: 600,
                    eventClick: function(info) {
                        // console.log(info.event.extendedProps.status)
                        alertDetail(info.event.title,info.event.start,info.event.end,info.event.extendedProps.status);
                    }

                });
                calendar.render();
            }
        });
    }
    // JADWAL PEMUPUT

    // SHOW JADWAL DETAIL
    function alertDetail(title, start, end, status){
        let mulai = moment(start).format('DD MMMM YYYY | hh:mm A')
        let selesai = moment(end).format('DD MMMM YYYY | hh:mm A')
        // console.log(selesai)
        Swal.fire({
            title: 'Info Detail Jadwal',
            icon:'info',
            html:
                '<p>Berikut ini merupakan informasi detail Jadwal yang terdapat pada .</p>'+
                '<ul class="text-left">'+
                    '<li>Terdapat Jadwal   : '+title+' </li>'+
                    (selesai != 'Invalid date' ? '<li>Waktu Tangkil     : '+mulai+' </li>' : '<li>Tanggal Mulai     : '+mulai+' </li>')+
                    (selesai != 'Invalid date' ? '<li>Tanggal Selesai   : '+selesai+' </li>' : '')+
                    '<li>Status  :  '+status+' </li>'+
                '</ul>'
        })
    }
    // SHOW JADWAL DETAIL
</script>

@endpush
