@extends('layouts.krama.krama-layout')

@section('tittle', 'My Profile')

@push('css')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>

@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Profile</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="#">E-Yajamana</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger text-center" role="alert">
                    <span>Terdapat kesalahan dalam penginputan data. Periksa kembali input data sebelumnya!</span>
                </div>
            @endif
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ asset('base-template/dist/img/logo-01.png') }}" alt="Profile Admin" width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center">{{Auth::user()->Penduduk->nama}}</h3>
                        <p class="text-muted text-center">{{Auth::user()->email}}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="fw-bold">Status</b>
                                <a class="float-right text-decoration-none link-dark">Krama Bali</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Jenis Kelamin</b>
                                <a class="float-right text-decoration-none link-dark">{{Auth::user()->Penduduk->jenis_kelamin}}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Terdaftar Sejak</b>
                                <a class="float-right text-decoration-none link-dark">{{date('d F Y',strtotime(Auth::user()->created_at))}}</a>
                            </li>
                        </ul>
                        <form action="{{route('auth.logout')}}">
                            <button type="submit" class="btn btn-outline-danger btn-block">
                                <b>Logout</b>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- UPCARA RANGKUMAN -->
                <div class="card  collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Rangkuman Upacara</h3>
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
                            <div class="col-12">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-brightness-high-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Upacara</p>
                                            <p class="text-lg">3</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-brightness-alt-high-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Upacara Proses</p>
                                            <p class="text-lg">3</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-brightness-alt-low nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Upacara Selesai</p>
                                            <p class="text-lg">3</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- UPCARA RANGKUMAN -->

                <!-- RESERVASI RANGKUMAN -->
                <div class="card collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Rangkuman Reservasi </h3>
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
                            <div class="col-12">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-people-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Reservasi</p>
                                            <p class="text-lg">3</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-person-lines-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Disetujui</p>
                                            <p class="text-lg">3</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-person-plus-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Proses</p>
                                            <p class="text-lg">3</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-person-x-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Ditolak</p>
                                            <p class="text-lg">3</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- RESERVASI RANGKUMAN -->
            </div>

            <div class="col-md-8">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header border-bottom-0 p-2">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active text-dark" href="#dataDiri" data-toggle="tab">Data Diri</a></li>
                            <li class="nav-item"><a class="nav-link text-dark" href="#akun" data-toggle="tab">Akun</a></li>
                            <li class="nav-item"><a class="nav-link text-dark" id="pemetaanTabs" href="#pemetaan" data-toggle="tab">Pemetaan Lokasi</a></li>
                            <li class="nav-item"><a class="nav-link text-dark" href="#notifikasi" data-toggle="tab">Notifikasi</a></li>
                            <li class="nav-item"><a class="nav-link text-dark" href="#ubahPassword" data-toggle="tab">Ubah Password</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <!---- DATA DIRI TABS ------>
                            <div class="tab-pane" id="dataDiri">
                                <div class="ml-2 fs-4">
                                    <label class="fw-bold text-center d-grid text-lg mb-1">Kelola Data Diri</label>
                                    <p>Kelola data diri Anda agar lebih mudah mendapatkan informasimu</p>
                                </div>
                                <div class="dropdown-divider mb-3"></div>
                                <div class="px-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">NIK <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{Auth::user()->Penduduk->nik}}" >
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nomor Induk Krama <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{Auth::user()->Penduduk->nomor_induk_krama}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Krama <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{Auth::user()->Penduduk->nama}}" >
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Alias <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{Auth::user()->Penduduk->nama_alias}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Gelar Depan </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{Auth::user()->Penduduk->gelar_depan}}" >
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Gelar Belakang </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{Auth::user()->Penduduk->gelar_belakang}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tempat Lahir <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"  value="{{Auth::user()->Penduduk->tempat_lahir}}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tanggal Lahir <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"  value="{{date('d F Y',strtotime(Auth::user()->Penduduk->tanggal_lahir))}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jenis Kelamin <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pendidikan"  value="{{Auth::user()->Penduduk->jenis_kelamin}}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Golongan Darah <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pendidikan"  value="{{Auth::user()->Penduduk->golongan_darah}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Agama <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pendidikan"  value="{{Auth::user()->Penduduk->agama}}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Status <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pendidikan"  value="{{Auth::user()->Penduduk->status_perkawinan}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Pendidikan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pendidikan"  value="{{Auth::user()->Penduduk->Pendidikan->jenjang_pendidikan}}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Pekerjaan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{Auth::user()->Penduduk->Profesi->profesi}}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-end pr-4">
                                        <button id="test" type="submit" class="float-right btn btn-sm btn-outline-primary my-1">Simpan Data Diri</button>
                                    </div>
                                </div>
                            </div>
                            <!---- DATA DIRI TABS ------>

                            <!---- AKUN TABS ------>
                            <div class="tab-pane" id="akun">
                                <div class="ml-2 fs-4">
                                    <label class="fw-bold text-center d-grid text-lg mb-1">Kelola Akun</label>
                                    <p>Kelola akun Anda agar lebih mudah untuk melakukan login</p>
                                </div>
                                <div class="dropdown-divider mb-3"></div>
                                <form action="#" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="px-4">
                                        <div class="form-group row mt-4">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">E-Mail <span class="text-danger">*</span></label>
                                            <div class="col-sm-9 my-auto">
                                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Alamat E-Mail" value="{{Auth::user()->email}}" autocomplete="off">
                                                @error('email')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputTelp" class="col-sm-3 col-form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                            <div class="col-sm-9 my-auto">
                                                <input name="no_tlpn" type="text" class="form-control @error('no_tlpn') is-invalid @enderror" id="inputTelp" placeholder="Nomor Telepon" value="{{Auth::user()->nomor_telepon}}" autocomplete="off">
                                                @error('no_tlpn')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2">
                                            <div class="col-sm-12 d-grid">
                                                <button type="submit" class="float-right btn btn-sm btn-outline-primary  my-1">Simpan Data</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!---- AKUN TABS ------>

                            <!---- PEMETAAN TABS ------>
                            <div class="tab-pane active" id="pemetaan">
                                <div class="ml-2 fs-4">
                                    <label class="fw-bold text-center d-grid text-lg mb-1">Kelola Akun</label>
                                    <p>Kelola akun Anda agar lebih mudah untuk melakukan login</p>
                                </div>
                                <div class="dropdown-divider mb-3"></div>
                                <div class="px-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                                                <select  name="kabupaten" id="kabupaten" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;" value="{{old('kabupaten')}}">
                                                    <option value="0" disabled selected>Pilih Kabupaten</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Kecamatan <span class="text-danger">*</span></label>
                                                <select id="kecamatan" class="form-control select2bs4 @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                                </select>
                                                <p class="m-1 text-xs">(Pilih Kabupaten terlebih dahulu)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Desa Dinas<span class="text-danger">*</span></label>
                                            <select id="desa_dinas" name="id_desa" class="form-control select2bs4 @error('id_desa') is-invalid @enderror" style="width: 100%;">
                                                <option value="0" disabled selected>Pilih Desa Dinas</option>
                                            </select>
                                            <p class="m-1 text-sm">(Pilih Kecamatan terlebih dahulu)</p>
                                            @error('id_desa')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('id_desa') }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label>Banjar Dinas <span class="text-danger">*</span></label>
                                            <select id="id_banjar_dinas" name="id_banjar_dinas" class="form-control select2bs4 @error('id_banjar_dinas') is-invalid @enderror" style="width: 100%;">
                                                <option value="0" disabled selected>Pilih Banjar Dinas</option>
                                            </select>
                                            <p class="m-1 text-sm">(Pilih Desa Dinas terlebih dahulu)</p>
                                            @error('id_banjar_dinas')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('id_banjar_dinas') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Alamat Upacara</label>
                                                <textarea name="alamat_upacaraku" class="form-control  @error('alamat_upacaraku') is-invalid @enderror" rows="3" placeholder="Masukan Alamat Lengkap Griya"></textarea>
                                                @error('alamat_upacaraku')
                                                    <div class="invalid-feedback text-start">
                                                        {{$errors->first('alamat_upacaraku') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div id="gmaps" class="card shadow" style="height: 500px"></div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input name="lat" id="lat" type="text" aria-label="First name" class="form-control mr-1 @error('lat') is-invalid @enderror" placeholder="Lat" value="{{old('lat')}}" readonly="readonly">
                                        </div>
                                        <div class="col">
                                            <input name="lng" id="lng" type="text" aria-label="Last name" class="form-control ml" placeholder="Lang  @error('lng') is-invalid @enderror" value="{{old('lat')}}" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider mt-2"></div>
                                <div class="form-group row mt-3">
                                    <div class="col-sm-12 d-grid">
                                        <button type="submit" class="float-right btn btn-sm btn-outline-primary  my-1">Simpan Pemetaan Lokasi</button>
                                    </div>
                                </div>
                            </div>
                            <!---- PEMETAAN TABS ------>

                            <!---- NOTIFIKASI TABS ------>
                            <div class="tab-pane" id="notifikasi">
                                <div class="ml-2 fs-4">
                                    <label class="fw-bold text-center d-grid text-lg mb-1">Notifikasi</label>
                                    <p class="mb-0">Kelola notifikasi yang masuk ke akun Anda...</p>
                                </div>
                                <div class="dropdown-divider mt-2 mb-3"></div>

                                    <ul class="nav nav-tabs text-md ">
                                        <li class="nav-item"><a class="nav-link active text-dark text-bold" href="#notifikasiBaru" data-toggle="tab">BARU </a></li>
                                        <li class="nav-item"><a class="nav-link text-dark text-bold" href="#notifikasiRiwayat" data-toggle="tab">RIWAYAT</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="notifikasiBaru">
                                            <!---- NOT NULL NOTIFICATION ------>
                                            <div class="card mt-3">
                                                <div class="card-header" aria-expanded="false">
                                                    <div class="card-tools mr-0">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-tool float-right px-0" data-toggle="dropdown">
                                                                <i class="fas fa-ellipsis-v float-lg-right mt-2"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <a href="#" class="dropdown-item text-dark">Baca Notifikasi</a></li>
                                                                {{-- <li class="dropdown-divider"></li> --}}
                                                                <a href="#" class="text-dark dropdown-item">Delete Notifikasi</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-primary my-4"><i class="fas fa-info-circle"></i> Informasi | 17:20</span>
                                                    <p class="text-md mb-0 text-bold">Permohonan Reservasi dibuat</p>
                                                    <p class="text-xs mb-1">Permohonan reservasi kepada Made Rismawan telah berhasil dilakukan, dimohon untuk menunggku konfirmasi dari pihak pemuput karya</p>
                                                </div>
                                            </div>
                                            <!---- NOT NULL NOTIFICATION ------>
                                        </div>
                                        <div class="tab-pane" id="notifikasiRiwayat">
                                           <!---- IF NOT IN NOTIFICATION IN SISTEM ------>
                                            <div class="h-100 d-flex justify-content-center align-items-center mt-4">
                                                <div class="media">
                                                    <div class="media-body text-center mb-2 mt-2">
                                                        <i class="fa-4x far fa-bell text-secondary"></i>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <p class="text-md text-center">Belum tedapat notifikasi..</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!---- IF NOT IN NOTIFICATION IN SISTEM ------>
                                        </div>
                                    </div>

                                <div class="dropdown-divider mt-2"></div>
                            </div>
                            <!---- NOTIFIKASI TABS ------>

                            <!---- UBAH PASSWORD TABS ------>
                            <div class="tab-pane" id="ubahPassword">
                                {{-- <div class="border border-bottom border-primary my-4"></div> --}}
                                <form action="#" class="form-horizontal" method="POST">
                                    @csrf
                                    <div class="ml-2 fs-4">
                                        <label class="fw-bold text-center d-grid text-lg mb-1">Atur Password</label>
                                        <p>Untuk keamanan akun Anda, mohon untuk tidak menyebarkan password Anda ke orang lain</p>
                                    </div>
                                    <div class="dropdown-divider mb-4"></div>
                                    <div class="px-4">
                                        <div class="form-group row">
                                            <label for="inputTelp" class="col-sm-3 col-form-label">Password Lama <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password_lama" autocomplete="off" class="form-control @error('password_lama') is-invalid @enderror"  id="inputTelp" placeholder="Password Lama" autocomplete="off">
                                                @error('password_lama')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputTelp" class="col-sm-3 col-form-label">Password Baru <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror"   id="inputTelp" placeholder="Password Baru" autocomplete="off">
                                                @error('password')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputTelp" class="col-sm-3 col-form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" id="inputTelp" placeholder="Konfirmasi Password" autocomplete="off">
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 text-end">
                                                <button id="test" type="submit" class="float-right btn btn-sm btn-outline-primary my-1">Simpan Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!---- UBAH PASSWORD TABS ------>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

<script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{url('base-template/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $('#side-pengaturan-akun').addClass('menu-is-opening menu-open');
        $('#side-profile').addClass('active');
    });
    // Custom Input Date
    $(function () {
        bsCustomFileInput.init();
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>

<!-- Maps Pemetaan  -->
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        //--------------START Deklarasi awal seperti icon pembuatan map-------------//
        var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 9);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Maps E-Yajamana',
            maxZoom: 18,
            minZoom: 9,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
        }).addTo(mymap);

        document.getElementById("pemetaanTabs").onclick = function () {
            // document.getElementById('modal-xl').style.display = 'block';
            setTimeout(function() {
                mymap.invalidateSize();
            }, 100);c1
        }
        var curLocation = [0, 0];
        if (curLocation[0] == 0 && curLocation[1] == 0) {
            curLocation = [-8.4517916, 115.1970086];
        }
        var marker = new L.marker(curLocation, {
            draggable: 'true'
        });
        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
            draggable: 'true'
            }).bindPopup(position).update();
            $("#lat").val(position.lat);
            $("#lng").val(position.lng).keyup();
            $("#view_lat").val(position.lat);
            $("#view_lng").val(position.lng);
        });
        $("#Latitude, #Longitude").change(function() {
            var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
            marker.setLatLng(position, {
            draggable: 'true'
            }).bindPopup(position).update();
            mymap.panTo(position);
        });
        mymap.addLayer(marker);
    })
</script>
<!-- Maps Pemetaan  -->

@endpush


