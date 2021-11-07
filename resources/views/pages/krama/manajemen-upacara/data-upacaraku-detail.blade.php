@extends('layouts.krama.krama-layout')
@section('tittle','Data Detail Upacaraku')

@push('css')

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
                            <table class="table table-hover">
                                <tbody>
                                  <tr data-widget="expandable-table" aria-expanded="true">
                                    <td>
                                        219
                                        <i class="expandable-table-caret fas fa-caret-right fa-fw float-lg-right"></i>
                                    </td>
                                  </tr>
                                  <tr class="expandable-body">
                                    <td>
                                      <div class="p-0" style="">
                                        <table class="table table-hover">
                                          <tbody>
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                              <td>
                                                <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                219-1
                                              </td>
                                            </tr>
                                            <tr class="expandable-body d-none">
                                              <td>
                                                <div class="p-0" style="display: none;">
                                                  <table class="table table-hover">
                                                    <tbody>
                                                      <tr>
                                                        <td>219-1-1</td>
                                                      </tr>
                                                      <tr>
                                                        <td>219-1-2</td>
                                                      </tr>
                                                      <tr>
                                                        <td>219-1-3</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
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
