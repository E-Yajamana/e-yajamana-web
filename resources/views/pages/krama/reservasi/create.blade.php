@extends('layouts.krama.krama-layout')
@section('tittle','Reservasi')

@push('css')
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">


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
                    <li class="breadcrumb-item active">Reservasi</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="callout callout-info container-fluid">
                    <h5><i class="fas fa-info"></i> Catatan:</h5>
                    Anda dapat melakukan reservasi pada beberapa tahapan yang tersedia pada suatu upacara.
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Form Pencarian Reservasi</h3>
                </div>
                <div class="card-body p-0">
                    <div class="bs-stepper">
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
                        {{-- <div class="bs-stepper-content">
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


                        </div> --}}
                    </div>
                </div>
            </div>


            {{-- <div class="bs-stepper-content p-0">
                <div class="card">
                    <div class="card-header">
                        <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                            </div>
                            <h3 class="text-center bold mb-0 ">Mepandes I Putu Alex</h3>
                            <p class="text-center mb-1">Manusa Yadnya</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <label for="exampleInputPassword1" class="justify-content-center align-items-center">Pemetaan Lokasi Upacara</label>
                            </div>
                            <p class="text-center">Menampilkan Marker Lokasi Pemuput Karya Berada</p>

                            <img src="http://127.0.0.1:8000/base-template/dist/img/maps.png" class="img-fluid pad img-thumbnail" alt="Responsive image" style="object-fit: cover">
                        </div>
                    </div>
                </div>
                <div class="card tab-content card-primary card-outline">
                    <div class="card-header my-auto">

                        <label class="card-title my-auto">List Pemuput Upacara</label>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="card shadow collapsed-card">
                            <div class="card-header" aria-expanded="false">
                                <div class="user-block">
                                    <img class="img-circle mt-1" src="http://127.0.0.1:8000/base-template/dist/img/user1-128x128.jpg" alt="User Image">
                                    <span class="username"><a class="ml-2" href="#">Sulinggih I Wayan Nabe</a></span>
                                    <span class="description">
                                        <div class="bg-danger btn-sm text-center p-1 mt-1 ml-2" style="border-radius: 5px; width:90px; ">Ditolak</div>
                                    </span>
                                </div>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-caret-down float-lg-right"></i>
                                    </button>
                                </div>
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


                        <div class="card card-widget shadow collapsed-card">
                            <div class="card-header">
                                <div class="user-block">
                                    <img class="img-circle mt-1 mr-2" src="http://127.0.0.1:8000/base-template/dist/img/user1-128x128.jpg" alt="User Image">
                                    <span class="username">
                                        <a class="ml-1" href="#">Sulinggih I Nengah Suparwa</a>
                                    </span>
                                    <span class="description">
                                        <div class="bg-info btn-sm text-center p-1 mt-1 ml-1" style="border-radius: 5px; width:90px;">Menunggu</div>
                                    </span>
                                </div>
                                <!-- /.user-block -->
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-caret-down float-lg-right"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="callout callout-danger container-fluid">
                                    <div>
                                        <p>
                                            <i class="fas fa-info"></i>
                                            <strong class="ml-1">
                                                Tanggal Tangkil :
                                            </strong>
                                                Tanggal Tangkil Belum ditentukan
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
                            <!-- /.card-footer -->
                            <div class="card-footer">
                                <button type="button" class="btn btn btn-primary btn-sm float-lg-right" data-toggle="modal" data-target="#modal-default">Detail Reservasi</button>
                            </div>
                            <!-- /.card-footer -->
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn btn-primary btn-sm float-lg-right center" data-toggle="modal" data-target="#modal-default">Tambah Reservasi</button>
                    </div>
                </div>
            </div> --}}


        </div>
    </div>


@endsection

@push('js')
    <!-- BS-Stepper -->
    <script src="{{asset('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>


    <script type="text/javascript">

        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

    </script>

@endpush
