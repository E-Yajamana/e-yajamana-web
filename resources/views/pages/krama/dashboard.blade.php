@extends('layouts.krama.krama-layout')
@section('tittle','Dashboard')

@push('css')

<!-- fullCalendar -->
<link rel="stylesheet" href="{{asset('base-template/plugins/fullcalendar/main.css')}}">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>

@endpush

@section('content')
    <div class="container-fluid">
        {{-- @include('template') --}}

        <!-- COUNT DATA -->
        <div class="row mt-2">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{$countData['countUpacara']}}</h3>
                        <p>Jumlah Jenis Upacara</p>
                    </div>
                    <div class="icon">
                        <i class="fa bi-brightness-high-fill nav-icon"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$countData['countPemuputKarya']}}</h3>
                        <p>Jumlah Pemuput Karya</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$countData['countUpacaraKrama']}}</h3>
                        <p>Jumlah Upacara Krama</p>
                    </div>
                    <div class="icon">
                        <i class="fa bi-brightness-high-fill nav-icon"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$countData['countReservasi']}}</h3>
                        <p>Jumlah Reservasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a href="{{route('krama.manajemen-reservasi.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- COUNT DATA -->

        <!-- BAGIAN 2 DASHBOARD-->
        <div class="row">
            <div class="col-12 col-sm-6">
                <!-- HEADER DONUT CHART -->
                <div class="card card-danger" style="height: 375px">
                    <div class="card-header">
                        <h3 class="card-title">Jenis Yadnya</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <!-- LIST UPACARA KRAMA-->
            <div class="col-12 col-sm-6">
                <div class="card" style="height: 375px">
                    <div class="card-header">
                        <h3 class="card-title">Upacara Krama</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <!-- /.card-header -->
                        @if (count($dataUpacaraKrama) != 0)
                            <ul class="products-list product-list-in-card pl-2 pr-2 direct-chat-messages">
                                <!-- /.item -->
                                @foreach ($dataUpacaraKrama as $data)
                                    <li class="item ">
                                        <div class="ml-3 product-info">
                                            <a href="{{route('krama.manajemen-upacara.upacaraku.detail',$data->id)}}" class="product-title description ">{{$data->Upacara->kategori_upacara}} | {{Str::limit($data->nama_upacara, 25, $end='.......')}}
                                                <span class="badge badge-secondary float-right">{{Str::ucfirst($data->status)}}</span>
                                            </a>
                                            <div class="div">
                                                <span class="product">
                                                    {{$data->deskripsi_upacaraku}} yang akan diselenggarakan pada   Tanggal {{date('d F Y',strtotime($data->tanggal_mulai))}} samapi dengan Tanggal {{date('d F Y',strtotime($data->tanggal_selesai))}}
                                                </span>
                                            </div>
                                        </div>
                                    </li>

                                @endforeach
                            </ul>
                        @else
                            <div class="h-100 d-flex justify-content-center align-items-center ">
                                <div class="media">
                                    <div class="media-body text-center mb-2 ">
                                        <i class="fa-4x bi-brightness-high-fill text-secondary"></i>
                                        <div class="d-flex justify-content-center">
                                            <p class="text-md text-center mt-1 w-75">Belum ada Upacara yang dibuat..</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('krama.manajemen-upacara.upacaraku.index')}}" class="uppercase">Lihat Semua Upacara Krama</a>
                    </div>
                </div>
            </div>
            <!-- LIST UPACARA KRAMA-->
        </div>
        <!-- BAGIAN 2 DASHBOARD-->

        <!-- BAGIAN 3 DASHBOARD-->
        <div class="row">
            <div class="col-12 col-sm-7">
                <div class="card" style="height:724px">
                    <div class="card-header">
                        <label class="card-title"  id="judulKalender">Kalender Reservasi </label>
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
            <div class="col-12 col-sm-5">
                <div class="card" style="height:724px">
                    <div class="card-header">
                        <label class="card-title"  id="judulKalender"><i class="fas fa-bullhorn mr-2"></i></i>Reservasi Hari ini </label>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
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
                                    @forelse ($dataJadwal as $upacaraku)
                                        @foreach ($upacaraku->Reservasi as $reservasi)
                                            @if (date('d M Y') === date('d M Y',strtotime($reservasi->tanggal_tangkil)))
                                                <div>
                                                    <i class="fas fa-map-marker-alt bg-success"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fas fa-clock"></i>{{date('H:m',strtotime($reservasi->tanggal_tangkil))}}</span>
                                                        <h3 class="timeline-header"><a href="#">Tangkil Griya {{$reservasi->Relasi->PemuputKarya->GriyaRumah->nama_griya_rumah}} | </a> {{$upacaraku->nama_upacara}}</h3>
                                                        <div class="timeline-body">
                                                            Halo Krama, terdapat jadwal Tangkil pada Jam {{date('H:m',strtotime($reservasi->tanggal_tangkil))}} ke {{$reservasi->Relasi->PemuputKarya->GriyaRumah->nama_griya_rumah}} untuk memastikan Reservasi yang anda lakukan.
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @foreach ( $reservasi->DetailReservasi as $detailReservasi )
                                                <div>
                                                    <i class="fas fa-user bg-primary"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fas fa-clock"></i>{{date('H:m',strtotime($detailReservasi->tanggal_mulai))}} </span>
                                                        <h3 class="timeline-header"><a href="#">{{$reservasi->getRelasi()->nama}} | </a> {{$detailReservasi->TahapanUpacara->nama_tahapan}}</h3>
                                                        <div class="timeline-body">
                                                            {{$reservasi->getRelasi()->nama}} akan melakukan muput upacara pada karya {{$upacaraku->nama_upacara}} yang berlangsung di
                                                            {{$upacaraku->alamat_upacaraku}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    @empty
                                        <div class="h-100 d-flex justify-content-center align-items-center ">
                                            <div class="media">
                                                <div class="media-body text-center mb-2 ">
                                                    <i class="fa-4x bi-brightness-high-fill text-secondary"></i>
                                                    <div class="d-flex justify-content-center">
                                                        <p class="text-md text-center mt-1 w-75">Belum terdapat reservasi pada Tanggal {{date('d M Y')}} </p>
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
                        {{-- <div class="h-100 d-flex justify-content-center align-items-center ">
                            <div class="media">
                                <div class="media-body text-center mb-2 ">
                                    <i class="fa-6x fas fa-calendar-alt text-secondary"></i>
                                    <div class="d-flex justify-content-center mt-3">
                                        <p class="text-lg text-center mt-1 w-75">Belum terdapat Reservasi..</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('krama.manajemen-reservasi.index')}}" class="uppercase">Lihat Semua Reservasi Krama</a>
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
<!-- date-range-picker -->
<script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>

<script>
    $(function () {
        // NAMPILIN DI ID #donutChart
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Dewa Yadnya',
                'Pitra Yadnya',
                'Manusa Yadnya',
                'Rsi Yadnya',
                'Bhuta Yadnya',
            ],
            datasets: [{
                data: [2,4,3,2,5],
                backgroundColor : ['#f56954', '#00c0ef', '#f39c12', '#3c8dbc', '#d2d6de'],
            }]
        }
        var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
        }
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    })

</script>

@endpush

@push('js')
<script>
    const idUser = {{Auth::user()->id}}
    const blue = '#3c8dbc';
    const green = '#00a65a';
    const grey = '#808080';
    const yellow = '#f39c12';

    showJadwal(idUser)

    // JADWAL PEMUPUT
    function showJadwal(id)
    {
        $.ajax({
            url: "{{route('ajax.jadwal-reservasi-krama')}}"+"/"+id,
            type:'GET',
            success:function(response){
                var evetArray = []; // DATA KESELURUHAN
                var dataArray = {}; // DATA TANGKIL
                var dataDetailArray = {}; // DATA DETAIL RESERVASI
                $.each(response.data, function(key, dataUpacara){
                    $.each(dataUpacara.reservasi, function(key, dataReservasi){
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
                        dataArray.title = "Tangkil Upacara "+dataUpacara.nama_upacara,
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

