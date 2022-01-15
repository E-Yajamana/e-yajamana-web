@extends('layouts.admin.admin-layout')
@section('tittle','Detail Verify')

@push('css')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('base-template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('base-template/plugins/toastr/toastr.min.css')}}">
@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Verifikasi Akun Sulinggih</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Verifikasi Sulinggih</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- SELECT2 EXAMPLE -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Data Detail Permintaan Verifikasi Akun</h3>
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
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSulinggih->nama_walaka}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tempat/Tanggal Lahir</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataSulinggih->nama_sulinggih}}, {{date('d-M-Y',strtotime($dataSulinggih->tanggal_lahir))}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pendidikan</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="{{$dataSulinggih->pendidikan}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="'card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Sulinggih</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSulinggih->nama_sulinggih}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Istri</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{$dataSulinggih->nama_istri}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Pekerjaan Walaka</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="{{$dataSulinggih->nama_istri}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row justify-content-center">
                        <label for="exampleInputPassword1" class="justify-content-center align-items-center">SK-Kesulinggihan:</label>
                    </div>
                    <img src="{{asset('base-template/dist/img/photo2.png')}}" class="img-fluid pad img-thumbnail" alt="Responsive image" style="width: 100%">
                </div>
                <div class="mt-4">
                    <div class="float-lg-left">
                        <button type="submit" class="btn btn-success btn-sm">Kembali</button>
                    </div>
                    <div class="float-lg-right">
                        <button type="submit" class="btn btn-success btn-sm ">Setujui</button>
                        <button type="button" class="btn btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">Tolak dengan alasan</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

        <!-- /.modal-content -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Penolakan Akun</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    </form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label" placeholder="Masukan keterangan penolakan akun.....">Keterangan Penolakan</label>
                                <textarea class="form-control" rows="3"  id="message-text"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                            <button type="button" class="btn btn-danger" >Kirim</button>
                        </div>
                    <form>
                </div>
            </div>
        </div>



    </section>



@endsection

@push('js')

    <!-- Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-pengaturan-akun').addClass('menu-open');
            $('#side-konfirmasi-sulinggih').addClass('active');
        });

    </script>

@endpush
