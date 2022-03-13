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
        <!-- COUNT DATA -->
        <div class="row mt-2">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>2</h3>
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
                        <h3>2</h3>
                        <p>Jumlah Pemuput Karya</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>4</h3>
                        <p>Jumlah Upacara Krama</p>
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
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>4</h3>
                        <p>Jumlah Reservasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- COUNT DATA -->

        <div class="row">
            <div class="col-12 col-sm-8">
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

            <div class="col-12 col-sm-4">
                <div class="card" style="height: 375px">
                    <div class="card-header">
                        <h3 class="card-title">Upacara Krama</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <!-- /.card-header -->

                        {{-- <ul class="products-list product-list-in-card pl-2 pr-2">
                            <!-- /.item -->
                            <li class="item">
                                <div class="ml-3 product-info">
                                    <a href="#" class="product-title ">Dewa Yadnya | Upacarar Rismawan
                                        <span class="badge badge-secondary float-right">PENDING</span>
                                    </a>
                                    <span class="product-description">
                                        Atma Wedana adalah upacara yadnya yang bertujuan untuk menyucikan sang atma pitara setelah prosesi ngaben atau sawa wedana selesai yang dilaksanakan dengan upacara Nyekah atau Mamukur.
                                    </span>
                                </div>
                            </li>
                            <li class="item">
                                <div class="ml-3 product-info">
                                    <a href="#" class="product-title ">Dewa Yadnya | Upacarar Rismawan
                                        <span class="badge badge-secondary float-right">PENDING</span>
                                    </a>
                                    <span class="product-description">
                                        Atma Wedana .
                                    </span>
                                </div>
                            </li>
                        </ul> --}}
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

                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="uppercase">Lihat Semua Upacara Krama</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="card" style="height:683px">
                    <div class="card-header">
                        <label class="card-title"  id="judulKalender">Jadwal Muput </label>
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
                <div class="card" style="height:683px">
                    <div class="card-header">
                        <label class="card-title"  id="judulKalender"><i class="fas fa-bullhorn mr-2"></i></i>Reservasi Akan Datang </label>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                         <!-- Timelime example  -->
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                {{-- <div class="timeline">
                                    <div class="time-label">
                                        <span class="bg-info">3 Jan. 2014</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-user bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                            <h3 class="timeline-header"><a href="#">Ida Pedande | </a> Muput upacara Mepandes</h3>
                                            <div class="timeline-body">
                                                Ida pedande muput upacara pada karya potong gigi yang dimulai pada jam 09:20 WITA berlangsung di
                                                Perumahan Cemara Giri Graha
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-clock bg-gray"></i>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="h-100 d-flex justify-content-center align-items-center ">
                            <div class="media">
                                <div class="media-body text-center mb-2 ">
                                    <i class="fa-6x fas fa-calendar-alt text-secondary"></i>
                                    <div class="d-flex justify-content-center mt-3">
                                        <p class="text-lg text-center mt-1 w-75">Belum terdapat Reservasi..</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="uppercase">Lihat Semua Reservasi Krama</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <label class="card-title"  id="judulKalender">Posisi Krama</label>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="gmaps" style="height: 450px"></div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="uppercase">Lihat Detail Pemetaan</a>
                    </div>
                </div>
            </div>
        </div>


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

<!-- Maps Pemetaan  -->
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        //--------------START Deklarasi awal seperti icon pembuatan map-------------//
       var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 10);
       L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
           attribution: 'Maps E-Yajamana',
           maxZoom: 18,
           minZoom: 9,
           id: 'mapbox/streets-v11',
           tileSize: 512,
           zoomOffset: -1,
           accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
       }).addTo(mymap);

       var curLocation = [0, 0];
       if (curLocation[0] == 0 && curLocation[1] == 0) {
           curLocation = [-8.4517916, 115.1970086];
       }
       var marker = new L.marker(curLocation, {
           draggable: 'true'
       });
   })
</script>
<!-- Maps Pemetaan  -->

<script>
    $(function () {

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            events: [{
                title: 'All Day Event',
                start: new Date(),
                backgroundColor: '#808080 ', //red
                borderColor: '#808080 ', //red
                allDay: true
            }],
            headerToolbar: {
                left: 'prev,next,today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem : 'bootstrap',
            height: 560,
            eventClick: function(info) {
                // console.log(info.event.extendedProps.status)
                alertDetail(info.event.title,info.event.start,info.event.end,info.event.extendedProps.status);
            }

        });
        calendar.render();

        // NAMPILIN DI ID #donutChart
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
        labels: [
            'Dewa Yadnya',
            'Pitra Serangkai',
            'Manusa Yadnyas',
            'Rsi Yadnya',
            'Bhuta Yadnya',
        ],
        datasets: [
            {
            data: [
                2,
                3
            ],
            backgroundColor : ['#f56954', '#00c0ef', '#f39c12', '#3c8dbc', '#d2d6de'],
            }
        ]
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

    $('#side-dashboard').addClass('menu-open');
</script>

@endpush
