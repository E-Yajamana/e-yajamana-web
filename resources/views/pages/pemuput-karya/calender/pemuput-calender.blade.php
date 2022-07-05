@extends('layouts.pemuput-karya.pemuput-karya-layout')
@section('tittle','Reservasi Krama Masuk')

@push('css')

    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/fullcalendar/main.css')}}">
@endpush


@section('content')
    <div class="card card-info card-outline">
        <div class="card-header">
            <label class="card-title"  id="judulKalender">Jadwal Muput </label>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-horizontal-sm list-unstyled">
                <li class="group-item mx-2"><a class="text-secondary text-sm px-1" ><i class="fas fa-circle"></i></a>Pending</li>
                <li class="group-item mx-2"><a class="text-primary  text-sm px-1" ><i class="fas fa-circle"></i></a>Akan Datang</li>
                <li class="group-item mx-2"><a class="text-success  text-sm px-1" ><i class="fas fa-circle"></i></a>Selesai</li>
            </ul>
            <div id='calendar'></div>
        </div>
    </div>



@endsection

@push('js')
    <!-- fullCalendar 2.2.5 -->
    <script src="{{asset('base-template/plugins/fullcalendar/main.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#muput-calendar').addClass('active');
            // $('#side-manajemen-muput-upacara-konfirmasi-muput-upacara').addClass('active');
        });
    </script>

    <script>
        let dataPemuputKarya,dataSanggar,dataUpacaraku;
        let blue,green,grey,yellow;
        blue = '#3c8dbc';
        green = '#00a65a';
        grey = '#808080';
        yellow = '#f39c12';

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

        showJadwal({{Auth::user()->id}},'id_relasi');
    </script>

@endpush
