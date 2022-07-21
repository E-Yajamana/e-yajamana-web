@extends('layouts.admin.admin-layout')
@section('tittle','Dashboard')

@push('css')
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
@endpush

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{$countData['countUser']}}</h3>
                            <p>Jumlah User E-Yajamana</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{route('admin.manajemen-akun.data-akun.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$countData['countUpacara']}}</h3>
                            <p>Jumlah Upacara Agama Hindu</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa bi-brightness-high-fill nav-icon"></i>
                        </div>
                        <a href="{{route('admin.master-data.upacara.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$countData['countGriya']}}</h3>
                            <p>Jumlah Data Griya</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <a href="{{route('admin.master-data.griya.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$countData['countReservasiUser']}}</h3>
                            <p>Jumlah Reservasi User</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6">
                <!-- HEADER DONUT CHART -->
                <div class="card card-danger" style="height: 375px">
                    <div class="card-header">
                        <h3 class="card-title">Jenis Upacara Yadnya</h3>
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
                        <canvas id="jenisYadnyaDiagram" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12 col-sm-6">
                <!-- HEADER DONUT CHART -->
                <div class="card card-secondary" style="height: 375px">
                    <div class="card-header">
                        <h3 class="card-title">Jenis User</h3>
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
                        <canvas id="jenisUserDiagram" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>

@endsection

@push('js')
    <!-- ChartJS -->
    <script src="{{asset('base-template/plugins/chart.js/Chart.min.js')}}"></script>
    <script>
        $('#side-dashboard').addClass('menu-open');
        $(function () {

            const arrayDonutChart = {!! json_encode($countJenisYadnya) !!}

            // NAMPILIN DI ID #donutChart
            var donutChartCanvas = $('#jenisYadnyaDiagram').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Dewa Yadnya',
                    'Pitra Yadnya',
                    'Manusa Yadnya',
                    'Rsi Yadnya',
                    'Bhuta Yadnya',
                ],
                datasets: [{
                    data: arrayDonutChart,
                    backgroundColor : ['#f56954', '#00c0ef', '#f39c12', '#3c8dbc', '#d2d6de','#d2d6de'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio : false,
                responsive : true,
            }
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })


            const arrayBarChart = {!! json_encode($countJenisUser) !!}

            var labelBarChart = [];
            var dataBarChart = [];

            $.each(arrayBarChart, function(key, jumlah){
                labelBarChart.push(key)
                dataBarChart.push(jumlah)
            });

            const configBarChart = {
                labels: labelBarChart,
                datasets: [{
                    label: 'Jenis User',
                    data: dataBarChart,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                    ],
                    borderWidth: 1
                }]
            };

            const barChart = new Chart(
                document.getElementById('jenisUserDiagram'),
                {
                    type: 'bar',
                    data: configBarChart,
                    responsive : true,
                    options: {
                        scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                    }
                }
            );
        })

    </script>

@endpush
