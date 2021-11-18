@extends('layouts.krama.krama-layout')
@section('tittle','Reservasi')

@push('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/dropzone/min/dropzone.min.css')}}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">


    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>


@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reservasi Pemuput Karya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Upacaraku</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info container-fluid">
                        <h5><i class="fas fa-info"></i> Catatan:</h5>
                        Anda dapat melakukan reservasi pada beberapa tahapan yang tersedia pada suatu upacara.
                    </div>

                    {{-- <div class="bs-stepper">
                        <div class="card card-default">
                            <div class="card-header">
                                <label class="card-title">Form Pencarian Reservasi</label>
                            </div>
                            <div class="card-body p-0">
                                <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                    <div class="step" data-target="#logins-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Pencarian</span>
                                        </button>
                                    </div>

                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Pilih Tahapan</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#next-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="next-part"
                                        id="next-part-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Rangkuman</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bs-stepper-content p-0">

                            <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                <div class="card tab-content">
                                    <!-- /.card-header -->
                                    <div class="card-header">
                                        <div class="card-body box-profile align-content-center">
                                            <div class="text-center">
                                              <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                            </div>
                                            <h3 class="text-center bold mb-0 mt-3 ">Mepandes I Putu Alex</h3>
                                            <p class="text-center mb-1 mt-1">Manusa Yadnya</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card tab-content">
                                    <!-- /.card-header -->
                                    <div class="card-header">
                                        <label class="card-title">Maps Lokasi Pemuput E-Yajamana</label>
                                    </div>
                                    <div class="card-body">
                                        <div id="gmaps" style="height: 450px;"></div>
                                    </div>
                                </div>

                                <div class="card card-outline tab-content">
                                    <div class="card-header">
                                        <label class="card-title">List Pemuput Karya</label>
                                        <div class="ml-4 card-tools float-lg-right">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8"></div>
                                            <div class="col-4 mb-1">
                                                <select class="form-control select2" style="width: 100%;" aria-placeholder="ada">
                                                    <option>Semua</option>
                                                    <option>Terdekat</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="card shadow collapsed-card mt-3">
                                            <div class="card-header">
                                                <div class="user-block">
                                                    <img class="img-circle" src="{{asset('base-template/dist/img/user1-128x128.jpg')}}" alt="User Image">
                                                    <span class="username"><a class="ml-2" href="#">I Wayan Sulinggih Nabe</a></span>
                                                    <span class="description">
                                                        <div class="ml-2 ">
                                                            (Pemangku) - iwayansulinggih@gmail.com
                                                        </div>
                                                    </span>
                                                </div>
                                                <!-- /.user-block -->
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                                <!-- /.card-tools -->
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <div class="callout callout-danger container-fluid">
                                                    <div>
                                                        <p>
                                                            <i class="fas fa-info"></i>
                                                            <strong class="ml-1">
                                                                Tanggal Tangkil :
                                                            </strong>
                                                             Kamis, 11 November 2021
                                                        </p>
                                                    </div>
                                                </div>
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Tahapan</th>
                                                            <th class="text-md-center">Upacara Mulai</th>
                                                            <th class="text-md-center">Upacara Selesai</th>
                                                            <th class="text-md-center">Tindakan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Ngaraga Tirta Suci</td>
                                                            <td class="text-md-center">
                                                                <div>Senin, 8 November 2021</div>
                                                                <div>10.00 WITA</div>
                                                            </td>
                                                            <td class="text-md-center">
                                                                <div>
                                                                    <div>Senin, 8 November 2021</div>
                                                                    <div>13.00 WITA</div>
                                                                </div>
                                                            </td>
                                                            <td class="text-md-center">
                                                                <a href="##" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Maprayascita</td>
                                                            <td class="text-md-center">
                                                                <div>Selasa, 9 November 2021</div>
                                                                <div>10.00 WITA</div>
                                                            </td>
                                                            <td class="text-md-center">
                                                                <div>
                                                                    <div>Selasa, 9 November 2021</div>
                                                                    <div>13.00 WITA</div>
                                                                </div>
                                                            </td>
                                                            <td class="text-md-center">
                                                                <a href="##" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer" style="display: none;">
                                                <button type="button" class="btn btn btn-primary btn-sm float-lg-right" data-toggle="modal" data-target="#modal-default">Detail Reservasi</button>
                                            </div>
                                            <!-- /.card-footer-->
                                        </div>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Form Tambah Upacara</h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="bs-stepper">
                                        <div class="bs-stepper-header" role="tablist">
                                        <!-- your steps here -->
                                            <div class="step" data-target="#logins-part">
                                                <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                                    <span class="bs-stepper-circle">1</span>
                                                    <span class="bs-stepper-label">Jenis Upacara</span>
                                                </button>
                                            </div>

                                            <div class="line"></div>
                                            <div class="step" data-target="#information-part">
                                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">Data Detail</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#next-part">
                                                <button type="button" class="step-trigger" role="tab" aria-controls="next-part"
                                                id="next-part-trigger">
                                                <span class="bs-stepper-circle">3</span>
                                                <span class="bs-stepper-label">Rangkuman</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                                <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                                    <div class="row justify-content-center">
                                                        <div class="col-4" data-category="1" data-sort="white sample">
                                                            <div class="card p-2 shadow cursor" role="button">
                                                                <img src="{{asset('base-template/dist/img/jenis-yadnya/dewa-yadnya.jpg')}}" style="height:200px; object-fit:cover;" alt="white sample"/>
                                                                <button class="btn btn-block btn-primary " style="opacity: 90%" onclick="stepper.next()">DEWA YADNYA</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-4" data-category="1" data-sort="white sample">
                                                            <div class="card p-2 shadow cursor" role="button">
                                                                <img src="{{asset('base-template/dist/img/jenis-yadnya/pitra-yadnya.jpg')}}" style="height:200px; object-fit:cover;" alt="white sample"/>
                                                                <button class="btn btn-block btn-primary" style="opacity: 90%" onclick="stepper.next()">PITRA YADNYA</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-4" data-category="1" data-sort="white sample">
                                                            <div class="card p-2 shadow cursor" role="button">
                                                                <img src="{{asset('base-template/dist/img/jenis-yadnya/rsi-yadnya.jpg')}}" style="height:200px; object-fit:cover;" alt="white sample"/>
                                                                <button class="btn btn-block btn-primary" style="opacity: 90%" onclick="stepper.next()">RSI YADNYA</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-4" data-category="1" data-sort="white sample">
                                                            <div class="card p-2 shadow cursor" role="button">
                                                                <img src="{{asset('base-template/dist/img/jenis-yadnya/manusa-yadnya.jpg')}}" style="height:200px; object-fit:cover;" alt="white sample"/>
                                                                <button class="btn btn-block btn-primary" style="opacity: 90%" onclick="stepper.next()">MANUSA YADNYA</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-4" data-category="1" data-sort="white sample">
                                                            <div class="card p-2 shadow cursor" role="button">
                                                                <img src="{{asset('base-template/dist/img/jenis-yadnya/bhuta-yadnya.jpg')}}" style="height:200px; object-fit:cover;" alt="white sample"/>
                                                                <button class="btn btn-block btn-primary" style="opacity: 90%" onclick="stepper.next()">BHUTA YADNYA</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                                <div class="form-group">
                                                    <label>Jenis Yadnya</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Manusa Yadnya" disabled="">
                                                </div>
                                                <div class="form-group">
                                                    <label >Jenis Upacara</label>
                                                    <select class="form-control select2" style="width: 100%;">
                                                        <option selected="selected">Mepandes</option>
                                                        <option>Alaska</option>
                                                        <option>California</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Upacara</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Upacara" >
                                                </div>
                                                <div class="form-group">
                                                    <label>Kabupaten</label>
                                                    <select class="form-control select2" style="width: 100%;">
                                                        <option selected="selected">Badung</option>
                                                        <option>Alaska</option>
                                                        <option>California</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Kecamatan</label>
                                                            <select class="form-control select2" style="width: 100%;">
                                                                <option selected="selected">Kuta Utara</option>
                                                                <option>Alaska</option>
                                                                <option>California</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Desa</label>
                                                            <select class="form-control select2" style="width: 100%;">
                                                                <option selected="selected">Dalung</option>
                                                                <option>Alaska</option>
                                                                <option>California</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Pemetaan Lokasi Upacara</label>
                                                    <div class="input-group">
                                                        <input name="lat" id="lat" style="margin-left: 5px" type="text" aria-label="First name" class="form-control" placeholder="Lat" readonly="readonly">
                                                        <input name="lng" id="lng" style="margin-left: 5px" type="text" aria-label="Last name" class="form-control" placeholder="Lang" readonly="readonly">
                                                        <button type="button" class="btn btn-default ml-2" data-toggle="modal" data-target="#modal-xl">
                                                            <i class="fas fa-map-marked"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Deskripsi Upacara</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukan Deskripsi Upacara ..."></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Tanggal Mulai - Tanggal Selesai Upacara</label>
                                                    <div class="input-group">
                                                      <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                          <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                      </div>
                                                      <input type="text" class="form-control float-right" id="reservation">
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>


                                                <div class="form-group">
                                                    <button class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                                    <button type="submit" class="btn btn-primary float-sm-right" onclick="stepper.next()">Selanjutnya</button>
                                                </div>
                                            </div>


                                            <div id="next-part" class="content" role="tabpanel" aria-labelledby="next-part-trigger">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Jenis Yadnya</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Manusa Yadnya" disabled="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jenis Upacara</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Manusa Yadnya" disabled="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Upacara</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Manusa Yadnya" disabled="">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Kabupaten</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Mapandes" disabled="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kecamatan</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Manusa Yadnya" disabled="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Desa</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Manusa Yadnya" disabled="">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="row justify-content-center">
                                                                <label for="exampleInputPassword1" class="justify-content-center align-items-center">Pemetaan Lokasi Upacara</label>
                                                            </div>
                                                            <img src="http://127.0.0.1:8000/base-template/dist/img/maps.png" class="img-fluid pad img-thumbnail" alt="Responsive image">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Pemetaan Lokasi Upacara</label>
                                                            <div class="input-group">
                                                                <input name="lat" id="lat" style="margin-left: 5px" type="text" aria-label="First name" class="form-control" placeholder="Lat" readonly="readonly">
                                                                <input name="lng" id="lng" style="margin-left: 5px" type="text" aria-label="Last name" class="form-control" placeholder="Lang" readonly="readonly">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Deskripsi Upacara</label>
                                                            <textarea disabled class="form-control" rows="3" placeholder="Masukan Deskripsi Upacara ..."></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Mulai - Tanggal Selesai Upacara</label>
                                                            <div class="input-group">
                                                              <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                  <i class="far fa-calendar-alt"></i>
                                                                </span>
                                                              </div>
                                                              <input type="text" class="form-control float-right" id="reservation" disabled>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="card tab-content collapsed-card" id="v-pills-tabContent">
                                                    <div class="card-header my-auto">
                                                        <h3 class="card-title my-auto">Rentetan Upacara</h3>
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
                                                            <div class="col-12 col-sm-4">
                                                                <h4 class="text-center mb-3">AWAL</h4>
                                                                <ul>
                                                                    <li>Ngraga Tirta Suci</li>
                                                                    <li>Persiapan Pemangku</li>
                                                                    <li>Matur Pakeling</li>
                                                                    <li>Ngelukat Banten</li>
                                                                    <li>Maprayascita</li>
                                                                    <li>Mablyaka</li>
                                                                    <li>Ngudang Dewa</li>
                                                                    <li>Ngelinggihang Dewa/Batara Ring Purwa Daksina</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-12 col-sm-4">
                                                                <h4 class="text-center mb-3">PUNCAK</h4>
                                                                <ul>
                                                                    <li>Ngaturang Ayaban Ring Batara</li>
                                                                    <li>Ngaturang Banten Suci</li>
                                                                    <li>Puja Astawa ke Luhur</li>
                                                                    <li>Ngelukat Caru</li>
                                                                    <li>Ngayab Caru</li>
                                                                    <li>Ngaturang Pesucian</li>
                                                                    <li>Ngayab ke Sowang-Sowang Pelinggih</li>
                                                                    <li>Matur Sembah</li>
                                                                    <li>Ngaturang Ayaban ke Surya Saksi</li>
                                                                </ul>

                                                            </div>
                                                            <div class="col-12 col-sm-4">
                                                                <h4 class="text-center mb-3">AKHIR</h4>
                                                                <ul>
                                                                    <li>Ngewaliang Linggih Batara Sami</li>
                                                                    <li>Ngaturang Pengaksama Ring Batara Sami</li>
                                                                    <li>Ngeruwak Caru</li>
                                                                    <li>Ngelukat Banten</li>
                                                                    <li>Maprayascita</li>
                                                                    <li>Mablyaka</li>
                                                                    <li>Ngudang Dewa</li>
                                                                    <li>Ngelinggihang Dewa/Batara Ring Purwa Daksina</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <button class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                                    <button type="submit" class="btn btn-primary float-sm-right" onclick="stepper.next()">Simpan</button>
                                                </div>

                                            </div>


                                        </div>






                </div>
            </div>

        </div>
    </section>


@endsection

@push('js')
    <!-- BS-Stepper -->
    <script src="{{asset('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{asset('base-template/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap color picker -->
    <script src="{{asset('base-template/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{asset('base-template/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <!-- dropzonejs -->
    <script src="{{asset('base-template/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('base-template/dist/js/demo.js')}}"></script>

    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function(){
                $('#side-upacara').addClass('menu-open');
                $('#side-kabupaten').addClass('active');

                var mymap = L.map('gmaps').setView([-8.617683234549416, 115.16708493639123], 15);

                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Adalah API Favoritku',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);

        });

        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

    </script>


@endpush
