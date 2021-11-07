@extends('layouts.admin.admin-layout')

@section('tittle','Data Akun')

@push('css')

@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Akun</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Data Akun User</li>
                    <li class="breadcrumb-item active">Detail Akun User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile ">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{asset('base-template/dist/img/user4-128x128.jpg')}}" alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center">I Wayan Sutama</h3>

                  <p class="text-muted text-center">Sulinggih</p>

                </div>
                <!-- /.card-body -->
              </div>

            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
          <!-- SELECT2 EXAMPLE -->
            <div class="card card-default ">
                <div class="card-header">
                <h3 class="card-title">Data Detail Akun</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Walaka</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="I Wayan Sutama" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tempat/Tanggal Lahir</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="Denpasar, 31 Desember 1950">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pendidikan</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="SMA">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Diksha</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="SMA">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Lokasi Griya</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="SMA">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="'card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Sulinggih</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Ida Begawan Agre Segening" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nama Istri</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" value="Ida Pedanda Istri Stiti Yogi" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Pekerjaan Walaka</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="Petani">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nabe Suliniggih</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="SMA">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="SMA">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-default collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">SK Kesulinggihan</h3>
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
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <label for="exampleInputPassword1" class="justify-content-center align-items-center">SK-Kesulinggihan:</label>
                                    </div>
                                    <img src="{{asset('base-template/dist/img/photo2.png')}}" class="img-fluid pad img-thumbnail" alt="Responsive image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-default collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Pemetaan Lokasi Sulinggih</h3>
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
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <label for="exampleInputPassword1" class="justify-content-center align-items-center">Pemetaan Lokasi Sulinggih</label>
                                    </div>
                                    <img  src="{{asset('base-template/dist/img/maps.png')}}" class="img-fluid pad img-thumbnail" alt="Responsive image">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="container-fluid mt-2">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <a href="#" class="btn btn-secondary">Kembali</a>
                        <input type="submit" value="Delete" class="btn btn-danger float-right ml-2">
                        <input type="submit" value="Edit Data" class="btn btn-success float-right mr-2">
                    </div>
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->
    </section>









@endsection

@push('js')


    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-data-akun').addClass('menu-open');
        });
    </script>

@endpush
