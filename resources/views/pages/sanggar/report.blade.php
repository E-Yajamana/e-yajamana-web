@extends('layouts.sanggar.sanggar-layout')
@section('tittle','Laporan Transaksi')

@push('css')

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('base-template/plugins/datepicker/css/datepicker.css')}}">


@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid border-bottom">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan Transaksi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('krama.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<div class=" container-fluid">
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <label for="inputEmail3" class="m-0 pt-1">Grafik Reservasi Tahun</label>
                                <div class="input-group date col-2 w-25" id="reservationdatetime" data-target-input="nearest">
                                    <input id="dateTahunGrafik" type='text' style="width: 50px" class='form-control form-control-sm d-flex float-right align-self-end align-items-end w-25' placeholder="Pilih tahun" value="2022">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <label class=" m-0 pt-1">Jenis Yadnya yang paling banyak diReservasi</label>
                </div>
                <div class="card-body">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="card">
                <div class="col-12" id="accordion">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header pl-1">
                            <div class="col-6 mx-0">
                                <h3 class="card-title text-dark">Transaksi Reservasi</h3>
                            </div>
                            <div class="card-tools">
                                <button title="Filter Data" class="btn btn btn-tool">
                                    <a data-toggle="collapse" href="#collapseOne">
                                        FILTER
                                        <i class="fas fa-filter"></i>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-12 col-sm-6 pl-0">
                                    <ul class="nav nav-pills" id="filterStatus">
                                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Semua</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Pending</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Diterima</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Selesai</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Ditolak</a></li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="row">
                                        <div class="col-12  col-sm-4">
                                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                <input id="filterTanggal" type='text' class='form-control float-right' placeholder="Pilih tanggal" value="">
                                                <div class="input-group-prepend">
                                                    <button class="input-group-text btn" type="button"  id="removeTanggal" >
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                <input id="filterBulan" type='text' class='form-control float-right' placeholder="Pilih bulan" value="">
                                                <div class="input-group-prepend">
                                                    <button class="input-group-text btn" type="button"  id="removeBulan" >
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                <input id="filterTahun" type='text' class='form-control float-right' placeholder="Pilih tahun" value="">
                                                <div class="input-group-prepend">
                                                    <button class="input-group-text btn" type="button"  id="removeTahun" >
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header p-0"></div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover mx-auto table-responsive-sm">
                        <thead >
                            <tr>
                                <th>No</th>
                                <th>Penyelenggara</th>
                                <th>Nama Tahapan </th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailReservasis as $detailReservasi)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$detailReservasi->Reservasi->Upacaraku->User->Penduduk->nama}}</td>
                                    <td style="width: 20%">{{$detailReservasi->TahapanUpacara->nama_tahapan}}</td>
                                    <td >{{date('d F Y',strtotime($detailReservasi->tanggal_mulai))}} </td>
                                    <td >{{date('d F Y',strtotime($detailReservasi->tanggal_selesai))}}</td>
                                    <td class="text-center">
                                        <div  @if ($detailReservasi->status == 'pending') class="bg-secondary btn-sm" @elseif ($detailReservasi->status == 'diterima' ) class="bg-primary btn-sm" @elseif ($detailReservasi->status == 'selesai') class="bg-success btn-sm" @else class="bg-danger btn-sm" @endif  style="border-radius: 5px; width:110px;">{{ucfirst($detailReservasi->status)}}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('base-template/plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endpush


{{-- FILTER DATATABEL --}}
@push('js')
    <script>
        $('#side-report').addClass('menu-open');

        var table = $('#example2').DataTable({
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

        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {

                var filterTanggal = '';
                var filterBulan = '';
                var filterTahun = '';
                var status = ''

                const dbStatus = data[5];
                const dbDateStart = moment(data[3]).format('YYYY-MM-DD');
                const dbDateEnd = moment(data[4]).format('YYYY-MM-DD');
                const dbMonthStart = moment(data[3]).format('MM-YYYY');
                const dbMonthEnd = moment(data[4]).format('MM-YYYY');
                const dbYearStart = moment(data[3]).format('YYYY');
                const dbYearEnd = moment(data[4]).format('YYYY');

                if($("#filterTanggal").val() !== ''){
                    filterTanggal = moment($("#filterTanggal").val()).format('YYYY-MM-DD');
                }
                if($("#filterBulan").val() !== ''){
                    filterBulan = moment($("#filterBulan").val()).format('MM-YYYY');
                }
                if($("#filterTahun").val() !== ''){
                    filterTahun = moment($("#filterTahun").val()).format('YYYY');
                }
                if($('#filterStatus li').find('a.active').text() !== ''){
                    status = $('#filterStatus li').find('a.active').text();
                }

                if(
                    (moment(filterTanggal).isBetween(dbDateStart, dbDateEnd, undefined, '[]') == true && moment(filterTanggal).isBetween(dbDateStart, dbDateEnd, undefined, '[]') || filterTanggal === '') &&
                    ((filterBulan === dbMonthStart && filterBulan ===  dbMonthEnd) || (filterBulan === '' )) &&
                    ((filterTahun === dbYearStart && filterTahun ===  dbYearEnd) || filterTahun === '') &&
                    ((status === dbStatus) || (status === '') || (status === 'Semua') )
                ){
                    return true;
                }else{
                    return false;
                }
            }
        );

        $('#filterTanggal').daterangepicker({
            "singleDatePicker": true,
            autoUpdateInput: false,
            locale: {
                format: 'DD MMMM YYYY',
            },
        });

        $("#filterBulan").datepicker({
            format: "MM yyyy",
            viewMode: "months",
            minViewMode: "months"
        });

        $("#filterTahun").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });

        $('#filterTanggal').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD MMMM YYYY'));
            table.draw();
        });

        $('#filterBulan').change(function() {
            table.draw();
        });

        $('#filterTahun').change(function() {
            table.draw();
        });

        $('#removeTanggal').click(function(){
            $('#filterTanggal').val('');
            table.draw();
        });

        $('#removeBulan').click(function(){
            $('#filterBulan').val('');
            table.draw();
        });

        $('#removeTahun').click(function(){
            $('#filterTahun').val('');
            table.draw();
        });

        $('#filterStatus li a').click(function(e) {
            $(".nav-link").removeClass("active");
            $('#side-data-reservasi').addClass('active');
            $(this).addClass("active");
            statusReservasi  = $('#filterStatus li').find('a.active').text();
            table.draw();
        });
    </script>
@endpush


@push('js')
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        const labels = [
            'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember',
        ];

        const dataLine = {
            labels: labels,
            datasets: [{
                label: 'Reservasi Muput Upacara',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: {!! json_encode($reportMonth)!!},
            }]
        };

        const configLineChart = {
            type: 'line',
            data: dataLine,
            responsive : true,
            options: {}
        };

        const lineChart = new Chart(
            document.getElementById('myChart'),
            configLineChart
        );

        $("#dateTahunGrafik").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });


        $('#dateTahunGrafik').change(function() {
            const tahun = this.value;
            const id = {{Auth::user()->id}}
            const testings = [
                'Risamwan','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember',
            ];
            $.ajax({
                url: "{{ route('ajax.report.linechart')}}",
                type:'POST',
                data: {
                    id:id,
                    tahun:tahun,
                    tipe:'id_relasi',
                    "_token":"{{ csrf_token() }}"
                },
                success:function(response){
                    lineChart.config.data.datasets[0].data = response.data;
                    lineChart.update();
                }
            });
        });
    </script>

    <script>
        const arrayBarChart = {!! json_encode($reportJenisYadnya) !!}

        var labelBarChart = [];
        var dataBarChart = [];

        $.each(arrayBarChart, function(key, jumlah){
            labelBarChart.push(key)
            dataBarChart.push(jumlah)
        });

        const configBarChart = {
            labels: labelBarChart,
            datasets: [{
                label: 'Jenis Yadnya',
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
            document.getElementById('barChart'),
            {
                type: 'bar',
                data: configBarChart,
                responsive : true,
                options: {
                }
            }
        );
    </script>

@endpush
