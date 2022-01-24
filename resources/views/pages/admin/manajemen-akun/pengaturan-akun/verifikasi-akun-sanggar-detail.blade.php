@extends('layouts.admin.admin-layout')
@section('tittle','Detail Verify')

@push('css')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('base-template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('base-template/plugins/toastr/toastr.min.css')}}">
  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>

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
                    <h4>Verifikasi Akun Sanggar</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Verifikasi Sanggar</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Akun User</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSanggar->User->email}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nomor Telepon</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataSanggar->User->nomor_telepon}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mendaftar Pada Tanggal</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="{{date('d-M-Y',strtotime($dataSanggar->User->created_at))}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">SK Tanda Usaha</h3>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <img style="width: 100%;height: 258px" src="{{route('get-image.tahapan-upacara',12)}}" class="img-fluid pad img-thumbnail"  alt="Responsive image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Lokasi Sanggar</h3>
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
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mt-2" id="gmaps" style="height: 330px;"></div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Sanggar</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSanggar->User->email}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pengelola</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataSanggar->nama_pengelola}}" disabled>
                            </div>
                            <div class="form-group">
                                <label> Alamat Lengkap Sanggar <span class="text-danger">*</span></label>
                                <textarea disabled name="alamat_griya" class="form-control" rows="5" placeholder="Masukan Alamat Lengkap Griya" >{{$dataSanggar->alamat_sanggar}}, Desa {{Str::ucfirst(Str::lower($dataSanggar->Desa->name))}}, Kecamatan {{Str::ucfirst(Str::lower($dataSanggar->Desa->Kecamatan->name))}}, Kabupaten {{Str::ucfirst(Str::lower($dataSanggar->Desa->Kecamatan->Kabupaten->name))}}, Provinsi {{Str::ucfirst(Str::lower($dataSanggar->Desa->Kecamatan->Kabupaten->Provinsi->name))}} </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="float-lg-left">
                            <a href="{{route('admin.manajemen-akun.verifikasi.index')}}" class="btn btn-secondary btn-sm">Kembali</a>
                        </div>
                        <div class="float-lg-right">
                            <button onclick="verifikasiPemuputKarya({{$dataSanggar->id}})" type="button" class="btn btn-primary btn-sm ">Setujui</button>
                            <button class="btn btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">Tolak</button>
                        </div>
                    </div>
                </div>
            </div>
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
                        <form action="{{route('admin.manajemen-akun.verifikasi.sanggar.tolak')}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{$dataSanggar->id}}">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label" placeholder="Masukan keterangan penolakan akun.....">Keterangan Penolakan</label>
                                    <textarea class="form-control" rows="3"  id="message-text" name="text_penolakan"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger" >Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <form id="{{"updateSanggar-".$dataSanggar->id}}" class="d-none"  action="{{route('admin.manajemen-akun.verifikasi.sanggar')}}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$dataSanggar->id}}">
    </form>


@endsection

@push('js') 

    <script>
        // TERIMA VERIFIKASI PEMUPUT KARYA
        function verifikasiPemuputKarya(index)
        {
            Swal.fire({
                title: 'Verifikasi',
                text : 'Apakah anda yakin akan mengkonfirmasi akun sanggar tersebut?',
                icon:'question',
                showDenyButton: true,
                showCancelButton: false,
                denyButtonText: `Tidak`,
                confirmButtonText: `iya`,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#updateSanggar-'+index).submit();
                    } else if (result.isDenied) {

                    }
                })
        }
        // TERIMA VERIFIKASI PEMUPUT KARYA

    </script>

    <!-- Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-pengaturan-akun').addClass('menu-open');
            $('#side-konfirmasi-sulinggih').addClass('active');
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 10);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Adalah API Favoritku',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);

            // var curLocation = [$dataGriya->lat, $dataGriya->lng];
            var marker = new L.marker([<?=$dataSanggar->lat ?>, <?=$dataSanggar->lng ?>]);
            mymap.addLayer(marker);
        });
    </script>

    

@endpush
