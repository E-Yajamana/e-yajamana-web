@extends('layouts.krama.krama-layout')
@section('tittle','Data Detail Upacaraku')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Data Upacaraku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">List Upacaraku</a></li>
                    <li class="breadcrumb-item active">Buat Upacaraku</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-danger container-fluid">
                        <h5><i class="fas fa-info"></i> Catatan:</h5>
                        Anda tidak dapat menghapus upacara saat sudah reservasi yang disetujui.
                    </div>

                    <div class="card tab-content">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <div class="card-body box-profile align-content-center">
                                <div class="text-center">
                                  <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                                </div>
                                <h3 class="text-center bold mb-0 ">Mepandes I Putu Alex</h3>
                                <p class="text-center mb-1">Manusa Yadnya</p>
                                <div class="d-flex justify-content-center">
                                    <div class="bg-info btn-sm text-center" style="border-radius: 5px; width:100px;">In Progress</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
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
                        </div>
                    </div>

                    <div class="card tab-content" id="v-pills-tabContent">
                        <div class="card-header my-auto">
                            <label class="card-title my-auto">Rentetan Upacara</label>
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

                    <div class="card tab-content">
                        <div class="card-header my-auto">
                            <label class="card-title my-auto">Reservasi Upacara</label>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="card collapsed-card">
                                <div class="card-header" aria-expanded="false">
                                    <div class="user-block">
                                        <img class="img-circle mt-1" src="{{asset('base-template/dist/img/user1-128x128.jpg')}}" alt="User Image">
                                        <span class="username"><a href="#">Sulinggih I Wayan Nabe</a></span>
                                        <span class="description">
                                            <div class="bg-danger btn-sm text-center p-1 mt-1" style="border-radius: 5px; width:90px;">Menunggu</div>
                                        </span>
                                    </div>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-caret-down float-lg-right"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: none;">
                                  Start creating your amazing application!
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer" style="display: none;">
                                  Footer
                                </div>
                                <!-- /.card-footer-->
                            </div>

                            <div class="card collapsed-card">
                                <div class="card-header" aria-expanded="false">
                                    <div class="row">
                                        <div class="col-1">
                                            <img class="direct-chat-img" src="{{asset('base-template/dist/img/user1-128x128.jpg')}}"  alt="Message User Image">
                                        </div>
                                        <div class="col-10">
                                            Sulinggih I Wayan Nabe
                                            <div class="bg-danger btn-sm text-center" style="border-radius: 5px; width:90px;">Menunggu</div>
                                        </div>
                                        <div class="col-1">
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                    <i class="fas fa-caret-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body" style="display: none;">
                                  Start creating your amazing application!
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer" style="display: none;">
                                  Footer
                                </div>
                                <!-- /.card-footer-->
                            </div>

                            <div class="card collapsed-card">
                                <div class="card-header" aria-expanded="false">
                                  <h3 class="card-title">Title</h3>
                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-caret-down"></i>
                                    </button>
                                  </div>
                                </div>
                                <div class="card-body" style="display: none;">
                                  Start creating your amazing application!
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer" style="display: none;">
                                  Footer
                                </div>
                                <!-- /.card-footer-->
                            </div>

                        </div>

                    </div>

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    <!-- /.container-fluid -->
    </section>




@endsection



@push('js')

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-upacara').addClass('menu-open');
            $('#side-kabupaten').addClass('active');
        });
    </script>

@endpush
