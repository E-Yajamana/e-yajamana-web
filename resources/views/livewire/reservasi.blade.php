@section('tittle','Tambah Reservasi')

@push('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/fullcalendar/main.css')}}">
@endpush

<div class="container-fluid">
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
                            <img class="profile-user-img img-fluid img-circle" src="{{route('image.profile.user',$pemuput['id'])}}" alt="User profile picture">
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
                    <div class="card-body">
                        <form class="px-2">
                            <div class="form-group">
                                <label>Pilih Upacara Krama <span class="text-danger">*</span></label>
                                <select wire:model="selectUpacara" name="id_upacara" class="form-control select2bs4 @error('id_upacara') is-invalid @enderror" style="width: 100%;">
                                    <option value="0" disabled selected>Pilih Upacara Krama</option>
                                    @foreach ($upacarakus as $key => $upacaraku)
                                        <option value="{{$upacaraku->id}}">{{$upacaraku->nama_upacara}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mulai - Tanggal Selesai Upacara {{$selectUpacara}} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input disabled id="daterange" name="daterange" type="text" class="form-control float-right">
                                </div>
                            </div>
                            <div class="card-header"></div>

                            <div class="row justify-content-center mt-4">
                                <div class="col-12 col-sm-6">
                                    <h4 class="text-center mb-3"> Awal </h4>
                                    {{-- @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','awal') as $data)
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
                                    @endforeach --}}
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h4 class="text-center mb-3"> Puncak </h4>
                                    {{-- @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','puncak') as $data)
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
                                    @endforeach --}}
                                </div>

                                <div class="col-12 col-sm-6 ">
                                    <h4 class="text-center mb-3"> Akhir </h4>
                                    {{-- @foreach ($dataUpacaraku->Upacara->TahapanUpacara->where('status_tahapan','akhir') as $data)
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
                                    @endforeach --}}
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn btn-primary btn-sm float-lg-right center">Buat Reservasi</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('js')
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- daterangepicker -->
    <!-- fullCalendar 2.2.5 -->
    <script src="{{asset('base-template/plugins/fullcalendar/main.js')}}"></script>
@endpush

