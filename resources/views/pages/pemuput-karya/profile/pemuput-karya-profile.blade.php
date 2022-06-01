@extends('layouts.pemuput-karya.pemuput-karya-layout')

@section('tittle', 'My Profile')

@push('css')

<!-- daterange picker -->
<link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">

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
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                                            <p class="text-lg">{{$rangkumanUpacara['jumlahUpacara']}}</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-brightness-alt-high-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Upacara Proses</p>
                                            <p class="text-lg">{{$rangkumanUpacara['jumlahUpacaraProses']}}</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-brightness-alt-low nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Upacara Selesai</p>
                                            <p class="text-lg">{{$rangkumanUpacara['jumlahUpacaraSelesai']}}</p>
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
                                            <p class="text-lg">{{$rangkumanReservasi['jumlahReservasi']}}</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-person-lines-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Disetujui</p>
                                            <p class="text-lg">{{$rangkumanReservasi['jumlahDisetujui']}}</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-person-plus-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Proses</p>
                                            <p class="text-lg">{{$rangkumanReservasi['jumlahProses']}}</p>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="product-img">
                                            <i class="fa-3x fa bi-person-x-fill nav-icon mr-1"></i>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-title mb-0 text-xs">Jumlah Ditolak</p>
                                            <p class="text-lg">{{$rangkumanReservasi['jumlahTolak']}}</p>
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
                            <div class="tab-pane active" id="dataDiri">
                                <div class="ml-2 fs-4">
                                    <label class="fw-bold text-center d-grid text-lg mb-1">Kelola Data Diri</label>
                                    <p>Kelola data diri Anda agar lebih mudah mendapatkan informasimu</p>
                                </div>
                                <div class="dropdown-divider mb-3"></div>
                                <form id="formDataDiri">
                                    <div class="px-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NIK </label>
                                                    <input disabled id="nik" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Enter email" value="{{Auth::user()->Penduduk->nik}}" >
                                                    <div class="text-sm text-danger text-start " id=""></div>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nomor Induk Krama </label>
                                                    <input disabled id="nomor_induk_krama" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Nomor Induk Krama" value="{{Auth::user()->Penduduk->nomor_induk_krama}}" >
                                                    <div class="text-sm text-danger text-start " id="nomor_induk_krama_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Krama </label>
                                                    <input id="nama" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Enter email" value="{{Auth::user()->Penduduk->nama}}" >
                                                    <div class="text-sm text-danger text-start data-diri " id="nama_error"></div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Alias </label>
                                                    <input id="nama_alias" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Nama Alias" value="{{Auth::user()->Penduduk->nama_alias}}" >
                                                    <div class="text-sm text-danger text-start data-diri " id="nama_alias_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Gelar Depan </label>
                                                    <input id="gelar_depan" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Gelar Depan" value="{{Auth::user()->Penduduk->gelar_depan}}" >
                                                    <div class="text-sm text-danger text-start data-diri " id=""></div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Gelar Belakang </label>
                                                    <input id="gelar_belakang" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Gelar Belakang" value="{{Auth::user()->Penduduk->gelar_belakang}}" >
                                                    <div class="text-sm text-danger text-start data-diri " id="gelar_belakang_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Tempat Lahir </label>
                                                    <input id="tempat_lahir" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Enter email"  value="{{Auth::user()->Penduduk->tempat_lahir}}">
                                                    <div class="text-sm text-danger text-start data-diri " id="tempat_lahir_error"></div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label>Tanggal Lahir</label>
                                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                    <input id="tanggal_lahir" name="tanggal_tangkil" id="demo" type='text' class='form-control data-diri float-right' value="{{Auth::user()->Penduduk->tanggal_lahir}}">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <div class="text-sm text-danger text-start data-diri " id="tanggal_lahir_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select id="jenis_kelamin" class="select2bs4 form-control data-diri" style="width: 100%;">
                                                         <option disabled>Pilih Jenis Kelamin</option>
                                                         <option @if (Auth::user()->Penduduk->jenis_kelamin == "laki-laki") selected @endif value="laki-laki">Laki-Laki</option>
                                                         <option @if (Auth::user()->Penduduk->jenis_kelamin == "perempuan") selected @endif value="perempuan">Perempuan</option>
                                                    </select>
                                                    <div class="text-sm text-danger text-start data-diri " id="jenis_kelamin_error"></div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Golongan Darah</label>
                                                    <select id="golongan_darah" class="select2bs4 form-control data-diri" style="width: 100%;">
                                                         <option disabled>Pilih Jenis Golongan Darah</option>
                                                         <option @if (Auth::user()->Penduduk->golongan_darah == "A") selected @endif value="A">A</option>
                                                         <option @if (Auth::user()->Penduduk->golongan_darah == "AB") selected @endif value="AB">AB</option>
                                                         <option @if (Auth::user()->Penduduk->golongan_darah == "B") selected @endif value="B">B</option>
                                                         <option @if (Auth::user()->Penduduk->golongan_darah == "O") selected @endif value="O">O</option>
                                                    </select>
                                                    <div class="text-sm text-danger text-start data-diri " id="golongan_darah_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Agama</label>
                                                    <select id="agama" class="select2bs4 form-control data-diri" style="width: 100%;">
                                                         <option disabled>Pilih Agama</option>
                                                         <option @if (Auth::user()->Penduduk->agama == "hindu") selected @endif value="hindu">Hindu</option>
                                                         <option @if (Auth::user()->Penduduk->agama == "buddha") selected @endif value="buddha">Buddha</option>
                                                         <option @if (Auth::user()->Penduduk->agama == "islam") selected @endif value="islam">Islam</option>
                                                         <option @if (Auth::user()->Penduduk->agama == "katolik") selected @endif value="katolik">Katolik</option>
                                                         <option @if (Auth::user()->Penduduk->agama == "khonghucu") selected @endif value="khonghucu">Khonghucu</option>
                                                         <option @if (Auth::user()->Penduduk->agama == "protestan") selected @endif value="protestan">Protestan</option>
                                                    </select>
                                                    <div class="text-sm text-danger text-start data-diri " id="agama_error"></div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Status Perkawinan</label>
                                                    <select id="status_perkawinan" class="select2bs4 form-control data-diri" style="width: 100%;">
                                                         <option disabled>Pilih Status Perkawinan</option>
                                                         <option @if (Auth::user()->Penduduk->status_perkawinan == "belum kawin") selected @endif value="belum kawin">Belum Kawin</option>
                                                         <option @if (Auth::user()->Penduduk->status_perkawinan == "kawin") selected @endif value="kawin">Kawin</option>
                                                         <option @if (Auth::user()->Penduduk->status_perkawinan == "cerai hidup") selected @endif value="cerai hidup">Cerai Hidup</option>
                                                         <option @if (Auth::user()->Penduduk->status_perkawinan == "cerai mati") selected @endif value="cerai mati">Cerai Mati</option>
                                                    </select>
                                                    <div class="text-sm text-danger text-start data-diri " id="status_perkawinan_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Pendidikan</label>
                                                    <select id="pendidikan" name="id_tahapan_upacara" class="select2bs4 form-control data-diri" style="width: 100%;">
                                                         <option disabled>Pilih Jenjang Pendidikan</option>
                                                         <option @if (Auth::user()->Penduduk->pendidikan_id == 1) selected @endif value="1">Tidak/Belum Bekerja</option>
                                                         <option @if (Auth::user()->Penduduk->pendidikan_id == 2) selected @endif value="2">Belum Tamat SD/Sederajat</option>
                                                         <option @if (Auth::user()->Penduduk->pendidikan_id == 3) selected @endif value="3">Tamat SD/Sederajat</option>
                                                         <option @if (Auth::user()->Penduduk->pendidikan_id == 4) selected @endif value="4">SLTP/Sederajat</option>
                                                         <option @if (Auth::user()->Penduduk->pendidikan_id == 5) selected @endif value="5">SLTA/Sederajat</option>
                                                         <option @if (Auth::user()->Penduduk->pendidikan_id == 6) selected @endif value="6">Diploma 1</option>
                                                         <option @if (Auth::user()->Penduduk->pendidikan_id == 7) selected @endif value="7">Diploma 2</option>
                                                         <option @if (Auth::user()->Penduduk->pendidikan_id == 8) selected @endif value="8">Diploma 3</option>
                                                         <option @if (Auth::user()->Penduduk->pendidikan_id == 9) selected @endif value="9">Strata 1</option>
                                                         <option @if (Auth::user()->Penduduk->pendidikan_id == 10) selected @endif value="10">Strata 2</option>
                                                         <option @if (Auth::user()->Penduduk->pendidikan_id == 11) selected @endif value="11">Strata 3</option>
                                                    </select>
                                                    <div class="text-sm text-danger text-start data-diri " id="id_tahapan_upacara_error"></div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Pekerjaan</label>
                                                    <select id="profesi" name="id_tahapan_upacara" class="select2bs4 form-control data-diri" style="width: 100%;">
                                                         <option disabled>Pilih Jenis Pekerjaan</option>
                                                         <option @if (Auth::user()->Penduduk->profesi_id == 1) selected @endif value="1">Tidak/Belum Bekerja</option>
                                                         <option @if (Auth::user()->Penduduk->profesi_id == 2) selected @endif value="2">Pegawai Negeri Sipil</option>
                                                         <option @if (Auth::user()->Penduduk->profesi_id == 3) selected @endif value="3">Wiraswasta</option>
                                                         <option @if (Auth::user()->Penduduk->profesi_id == 4) selected @endif value="4">Petani</option>
                                                         <option @if (Auth::user()->Penduduk->profesi_id == 5) selected @endif value="5">Mengurus Rumah Tangga</option>
                                                         <option @if (Auth::user()->Penduduk->profesi_id == 8) selected @endif value="8">Pelajar/Mahasiswa</option>
                                                         <option @if (Auth::user()->Penduduk->profesi_id == 10) selected @endif value="10">Pegawai Swasta</option>
                                                    </select>
                                                    <div class="text-sm text-danger text-start data-diri " id="id_tahapan_upacara_error"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-end pr-4">
                                            <button id="btnDataDiri" type="button" class="float-right btn btn-sm btn-outline-primary my-1">Simpan Data Diri</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!---- DATA DIRI TABS ------>

                            <!---- AKUN TABS ------>
                            <div class="tab-pane" id="akun">
                                <div class="ml-2 fs-4">
                                    <label class="fw-bold text-center d-grid text-lg mb-1">Kelola Akun</label>
                                    <p>Kelola akun Anda agar lebih mudah untuk melakukan login</p>
                                </div>
                                <div class="dropdown-divider mb-3"></div>
                                <form id="formAkun" class="form-horizontal">
                                    <div class="px-4">
                                        <div class="form-group row mt-4">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">E-Mail</label>
                                            <div class="col-sm-9 my-auto">
                                                <input id="email" type="email" class="form-control data-diri" id="inputEmail" placeholder="Alamat E-Mail" value="{{Auth::user()->email}}" autocomplete="off">
                                                <div class="text-xs text-danger text-start m-1" id="email_error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputTelp" class="col-sm-3 col-form-label">Nomor Telepon</label>
                                            <div class="col-sm-9 my-auto">
                                                <input id="nomor_telepon" type="text" class="form-control" id="inputTelp" placeholder="Nomor Telepon" value="{{Auth::user()->nomor_telepon}}" autocomplete="off">
                                                <div class="text-xs text-danger text-start m-1" id="nomor_telepon_error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-12 d-grid">
                                                <button id="btnAkun" type="button" class="float-right btn btn-sm btn-outline-primary  my-1">Simpan Data</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!---- AKUN TABS ------>

                            <!---- PEMETAAN TABS ------>
                            <div class="tab-pane" id="pemetaan">
                                <div class="ml-2 fs-4">
                                    <label class="fw-bold text-center d-grid text-lg mb-1">Kelola Akun</label>
                                    <p>Kelola akun Anda agar lebih mudah untuk melakukan login</p>
                                </div>
                                <div class="dropdown-divider mb-3"></div>
                                <div class="px-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Provinsi </label>
                                                <select id="provinsi" class="form-control select2bs4 @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                                    <option value="0" disabled selected>Pilih Provinsi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Kabupaten/Kota </label>
                                                <select  name="kabupaten" id="kabupaten" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;" value="{{old('kabupaten')}}">
                                                    <option value="0" disabled selected>Pilih Kabupaten</option>
                                                </select>
                                                <p class="m-1 text-xs">(Pilih Provinsi terlebih dahulu)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Kecamatan </label>
                                                <select id="kecamatan" class="form-control select2bs4 @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                                    <option value="0" disabled selected>Pilih Kecamatan</option>
                                                </select>
                                                <p class="m-1 text-xs">(Pilih Kabupaten terlebih dahulu)</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Desa Dinas</label>
                                            <select id="desa_dinas" name="id_desa" class="form-control select2bs4 @error('id_desa') is-invalid @enderror" style="width: 100%;">
                                                <option value="0" disabled selected>Pilih Desa Dinas</option>
                                            </select>
                                            <p class="m-1 text-sm">(Pilih Kecamatan terlebih dahulu)</p>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea name="alamat_upacaraku" class="form-control " rows="3" placeholder="Masukan Alamat Lengkap">{{Auth::user()->Penduduk->alamat}}</textarea>
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
                                            @if (count($dataNotifikasi['new']) != 0)
                                                @foreach ($dataNotifikasi['new'] as $data)
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
                                                            <span class="text-xs text-primary my-4"><i class="fas fa-info-circle"></i> Informasi | {{date('d F Y | H:m',strtotime($data->created_at))}}</span>
                                                            <p class="text-md mb-0 text-bold">{{$data->parseDataToArray()->title}}</p>
                                                            <p class="text-xs mb-1">{{$data->parseDataToArray()->body}}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
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
                                            @endif
                                        </div>
                                        <div class="tab-pane" id="notifikasiRiwayat">
                                           <!---- IF NOT IN NOTIFICATION IN SISTEM ------>
                                           @if (count($dataNotifikasi['history']) != 0)
                                                @foreach ($dataNotifikasi['new'] as $data)
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
                                                            <span class="text-xs text-primary my-4"><i class="fas fa-info-circle"></i> Informasi | {{date('d F Y | H:m',strtotime($data->created_at))}}</span>
                                                            <p class="text-md mb-0 text-bold">{{$data->parseDataToArray()->title}}</p>
                                                            <p class="text-xs mb-1">{{$data->parseDataToArray()->body}}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
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
                                            @endif
                                            <!---- IF NOT IN NOTIFICATION IN SISTEM ------>
                                        </div>
                                    </div>

                                <div class="dropdown-divider mt-2"></div>
                            </div>
                            <!---- NOTIFIKASI TABS ------>

                            <!---- UBAH PASSWORD TABS ------>
                            <div class="tab-pane " id="ubahPassword">
                                <div class="ml-2 fs-4">
                                    <label class="fw-bold text-center d-grid text-lg mb-1">Atur Password</label>
                                    <p>Untuk keamanan akun Anda, mohon untuk tidak menyebarkan password Anda ke orang lain</p>
                                </div>
                                <div class="dropdown-divider mb-4"></div>
                                <div class="px-4" id="formUbahPassword">
                                    <form id="formUbahPassword">
                                        <div class="form-group row">
                                            <label for="inputTelp" class="col-sm-3 col-form-label">Password Lama <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password_lama" autocomplete="off" class="form-control" id="password_lama" placeholder="Password Lama" autocomplete="off">
                                                <div class="text-xs text-danger text-start m-1" id="password_error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputTelp" class="col-sm-3 col-form-label">Password Baru <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" autocomplete="off" class="form-control" id="password" placeholder="Password Baru" autocomplete="off">
                                                <div class="text-xs text-danger text-start m-1" id="password_lama_error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputTelp" class="col-sm-3 col-form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="off" class="form-control"   placeholder="Konfirmasi Password" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 text-end">
                                                <button id="btnPassword" type="button" class="float-right btn btn-sm btn-outline-primary my-1">Simpan Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
    <!-- select -->
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#side-pengaturan-akun').addClass('menu-is-opening menu-open');
            $('#side-profile').addClass('active');
        });

        $('#tanggal_lahir').daterangepicker({
            "singleDatePicker": true,
            "maxDate": moment(Date ()).format('DD MMMM YYYY'),
            locale: {
                format: 'DD MMMM YYYY',
            },
        });

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

<!-- AJAX PEMROSEAN  -->
@push('js')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // AJAX UPDATE PASSWORD USER
        $("#btnPassword").click(function(){
            let passwordOld = $('#password_lama').val();
            let newPassword = $('#password').val();
            let newPasswordConfirmation = $('#password_confirmation').val();

            $.ajax({
                url: "{{ route('profile.password.update')}}",
                type:'PUT',
                data: {
                    password_lama : passwordOld,
                    password : newPassword,
                    password_confirmation: newPasswordConfirmation,
                    "_method":"PUT",
                    "_token":"{{ csrf_token() }}"
                },
                beforeSend:function(){
                    $(document).find('div.invalid-feedback').text('');
                },
                success:function(response){
                    console.log(response)
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    });
                    $.each(response.field, function(prefix,val){
                        console.log(val);
                        $('#'+val).text('');
                        $('#'+val).val('');
                        $('#'+val).removeClass('is-invalid')
                    });
                },
                error: function(response, error){
                    $('#password_lama').val('');
                    $('#password').val('');
                    $('#password_confirmation').val('');

                    Swal.fire({
                        icon: response.responseJSON.icon,
                        title: response.responseJSON.title,
                        text: response.responseJSON.message
                    });
                    $.each(response.responseJSON.data, function(prefix, val){
                        $('#'+prefix+'_error').text(val[0]);
                        $('#'+prefix).addClass('is-invalid')
                    });
                }
            });

        });
        // AJAX UPDATE PASSWORD USER

        // AJAX UPDATE AKUN
        $("#btnAkun").click(function(){
            let email = $("#email").val()
            let nomor_telepon = $("#nomor_telepon").val()

            $.ajax({
                url: "{{ route('profile.akun.update')}}",
                type:'PUT',
                data: {
                    email : email,
                    nomor_telepon : nomor_telepon,
                    "_method":"PUT",
                    "_token":"{{ csrf_token() }}"
                },
                success:function(response){
                    console.log(response)
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    });
                    $.each(response.field, function(prefix,val){
                        console.log(val);
                        $('#'+val+'_error').text('');
                        $('#'+val).removeClass('is-invalid')
                    });
                },
                error: function(response, error){
                    console.log(response)

                    Swal.fire({
                        icon: response.responseJSON.icon,
                        title: response.responseJSON.title,
                        text: response.responseJSON.message
                    });
                    $.each(response.responseJSON.data, function(prefix, val){
                        $('#'+prefix+'_error').text(val[0]);
                        $('#'+prefix).addClass('is-invalid')
                    });
                }
            });

        });
        // AJAX UPDATE AKUN

        // DATA DIRI AJAX UPDATE
        $("#btnDataDiri").click(function(){
            var nik = $("#nik").val();
            var nama = $("#nama").val();
            var nama_alias = $("#nama_alias").val();
            var gelar_depan = $("#gelar_depan").val();
            var gelar_belakang = $("#gelar_belakang").val();
            var tempat_lahir = $("#tempat_lahir").val();
            var tanggal_lahir = $("#tanggal_lahir").val();
            var jenis_kelamin = $("#jenis_kelamin").val();
            var golongan_darah = $("#golongan_darah").val();
            var agama = $("#agama").val();
            var status_perkawinan = $("#status_perkawinan").val();
            var pendidikan = $("#pendidikan").val();
            var profesi = $("#profesi").val();

            console.log(jenis_kelamin)

            $.ajax({
                url: "{{ route('profile.data-diri.update')}}",
                type:'PUT',
                data: {
                    profesi_id : profesi ,
                    pendidikan_id : pendidikan,
                    agama : agama,
                    nama : nama,
                    nama_alias :  nama_alias,
                    gelar_depan : gelar_depan,
                    gelar_belakang : gelar_belakang ,
                    tempat_lahir : tempat_lahir ,
                    tanggal_lahir : tanggal_lahir ,
                    jenis_kelamin : jenis_kelamin,
                    golongan_darah : golongan_darah,
                    status_perkawinan : status_perkawinan ,
                    "_method":"PUT",
                    "_token":"{{ csrf_token() }}"
                },
                success:function(response){
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    });
                    $(".data-diri").removeClass("is-invalid");
                    $("div.data-diri").text('');
                },
                error: function(response, error){
                    console.log(response)
                    $.each(response.responseJSON.data, function(prefix, val){
                        $('#'+prefix+'_error').text(val[0]);
                        $('#'+prefix).addClass('is-invalid')
                    });
                    Swal.fire({
                        icon: response.responseJSON.icon,
                        title: response.responseJSON.title,
                        text: response.responseJSON.message
                    });
                }
            });
        });
        // DATA DIRI AJAX UPDATE

    </script>
@endpush



