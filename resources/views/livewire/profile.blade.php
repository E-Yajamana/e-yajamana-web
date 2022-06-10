<div class="col-md-8">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header border-bottom-0 p-2">
            <ul class="nav nav-tabs">
                @if (Request::segment(1) === 'krama' || Request::segment(1) === 'pemuput-karya')
                    <li class="nav-item"><a class="nav-link text-dark @if (!Session::has('notify')) active @endif" href="#dataDiri" data-toggle="tab">Data Diri</a></li>
                    @if (Request::segment(1) === 'pemuput-karya')
                        <li class="nav-item"><a class="nav-link text-dark" href="#dataSulinggih" data-toggle="tab">Data @if (Auth::user()->PemuputKarya->tipe === 'sulinggih')Sulinggih @else Pemangku @endif </a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link  text-dark" href="#akun" data-toggle="tab">Akun</a></li>
                    @if (Request::segment(1) === 'krama')
                        <li class="nav-item"><a class="nav-link text-dark" id="pemetaanTabs" href="#pemetaan" data-toggle="tab">Pemetaan Lokasi</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link @if (Session::has('notify')) {{session()->get('notify')}} @endif text-dark" href="#notifikasi" data-toggle="tab">Notifikasi</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#ubahPassword" data-toggle="tab">Ubah Password</a></li>
                @endif
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">

                <!---- DATA DIRI TABS ------>
                <div class="tab-pane @if (!Session::has('notify')) active @endif" id="dataDiri">
                    <div class="ml-2 fs-4">
                        <label class="fw-bold text-center d-grid text-lg mb-1">Kelola Data Diri </label>
                        <p>Kelola data diri Anda agar lebih mudah mendapatkan informasimu</p>
                    </div>
                    <div class="dropdown-divider mb-3"></div>
                    <form id="formDataDiri">
                        <div class="px-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NIK </label>
                                        <input disabled id="nik" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Enter email" value="{{Auth::user()->Penduduk->nik}}" >
                                        <div class="text-sm text-danger text-start " id=""></div>
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor Induk Krama </label>
                                        <input disabled id="nomor_induk_krama" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Nomor Induk Krama" value="{{Auth::user()->Penduduk->nomor_induk_krama}}" >
                                        <div class="text-sm text-danger text-start " id="nomor_induk_krama_error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Krama </label>
                                        <input id="nama" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Enter email" value="{{Auth::user()->Penduduk->nama}}" >
                                        <div class="text-sm text-danger text-start data-diri " id="nama_error"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Alias </label>
                                        <input id="nama_alias" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Nama Alias" value="{{Auth::user()->Penduduk->nama_alias}}" >
                                        <div class="text-sm text-danger text-start data-diri " id="nama_alias_error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Gelar Depan </label>
                                        <input id="gelar_depan" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Gelar Depan" value="{{Auth::user()->Penduduk->gelar_depan}}" >
                                        <div class="text-sm text-danger text-start data-diri " id=""></div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Gelar Belakang </label>
                                        <input id="gelar_belakang" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Gelar Belakang" value="{{Auth::user()->Penduduk->gelar_belakang}}" >
                                        <div class="text-sm text-danger text-start data-diri " id="gelar_belakang_error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tempat Lahir </label>
                                        <input id="tempat_lahir" type="text" class="form-control data-diri" id="exampleInputEmail1" placeholder="Enter email"  value="{{Auth::user()->Penduduk->tempat_lahir}}">
                                        <div class="text-sm text-danger text-start data-diri " id="tempat_lahir_error"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
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
                                <div class="col-12 col-sm-6">
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
                                <div class="col-12 col-sm-6">
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
                                <div class="col-12 col-sm-6">
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
                                <div class="col-12 col-sm-6">
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
                                <div class="col-12 col-sm-6">
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
                                <div class="col-12 col-sm-6">
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

                <!---- PEMUPUT DATA ------>
                @if (Request::segment(1) === 'pemuput-karya')
                <div class="tab-pane" id="dataSulinggih">
                    <div class="ml-2 fs-4">
                        <label class="fw-bold text-center d-grid text-lg mb-1">Kelola Data Sulinggih</label>
                        <p>Kelola data pemuput karya Anda agar krama lebih mudah mendapatkan informasimu</p>
                    </div>
                    <form wire:submit.prevent="updateDataSulinggih" enctype="multipart/form-data">
                    <div class="dropdown-divider mb-3"></div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Sulinggih </label>
                                    <input wire:model="nama_sulinggih" type="text" class="form-control data-diri" id="nama_sulinggih" placeholder="Masukan Nama Sulinggih" value="{{Auth::user()->PemuputKarya->nama_pemuput}}" >
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama @if (Auth::user()->Penduduk->jenis_kelamin == 'laki-laki')Istri @else Suami @endif</label>
                                    <input disabled  type="text" class="form-control data-diri" id="nama_pasangan" placeholder="Nomor Istri" value="@isset(Auth::user()->PemuputKarya->Pasangan) {{Auth::user()->PemuputKarya->Pasangan->nama_pemuput}} @else Pasangan belum terdaftar disistem @endisset">
                                </div>
                            </div>
                            <div class="col-12 @if (Auth::user()->PemuputKarya->tipe === 'sulinggih') col-sm-6 @endif">
                                <div class="form-group">
                                    <label>SK Sulinggih <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('file') is-invalid @enderror" wire:model="photo" id="customFile">
                                            <label class="custom-file-label " for="customFile"> Ganti SK Kesulinggihan</label>
                                        </div>
                                    </div>
                                    <a class="p-0 text-xs btn btn-link" data-toggle="modal" data-target="#skSulinggih">Lihat SK Sulinggih</a>
                                    <div class="modal fade" id="skSulinggih" tabindex="-1" role="dialog" aria-labelledby="skSulinggih" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div id="skSulinggih" class="carousel slide" data-ride="carousel">
                                                    <ol class="carousel-indicators">
                                                        <li data-target="#skSulinggih" data-slide-to="0"  class="active"></li>
                                                    </ol>
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <img class="d-block w-100" src="{{route('image.sk-pemuput',Auth::user()->PemuputKarya->AtributPemuput->id)}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->PemuputKarya->tipe === 'sulinggih')
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Nabe Sulinggih</label>
                                        <select class="select2bs4 form-control data-diri" style="width: 100%;">
                                            <option selected disabled>Pilih Nabe Sulinggih</option>
                                            @foreach ($nabe as $dataNabe)
                                                <option @if (Auth::user()->PemuputKarya->AtributPemuput->id_nabe === $dataNabe->id) selected @endif value="{{$dataNabe->id}}">{{$dataNabe->nama_pemuput}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!---- DATA GRIYA ATAU PURI ------>
                        {{-- <div class="dropdown-divider mb-3"></div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Griya </label>
                                    <select wire:model="id_griya" class="select2bs4 form-control data-diri" style="width: 100%;">
                                        <option selected value="2">Pilih Griya</option>
                                        @foreach ($griya as $dataGriya)
                                            <option @if (Auth::user()->PemuputKarya->AtributPemuput->id_nabe === $dataNabe->id) selected @endif value="{{$dataNabe->id}}">{{$dataGriya->nama_griya_rumah}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat Lengkap Griya </label>
                                    <input  type="text" class="form-control data-diri" id="nama_sulinggih" placeholder="Masukan Nama Sulinggih" value="{{Auth::user()->PemuputKarya->nama_pemuput}}" >
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Sulinggih </label>
                                    <input  type="text" class="form-control data-diri" id="nama_sulinggih" placeholder="Masukan Nama Sulinggih" value="{{Auth::user()->PemuputKarya->nama_pemuput}}" >
                                </div>
                            </div>
                        </div>--}}
                        <div class="form-group row">
                            <div class="col-sm-12 text-end pr-4">
                                <button type="submit" class="float-right btn btn-sm btn-outline-primary my-1">Simpan Data</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
                <!---- PEMUPUT DATA ------>

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

                @if (Request::segment(1) === 'krama')
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
                @endif

                <!---- NOTIFIKASI TABS ------>
                <div class="tab-pane @if (Session::has('notify')) {{session()->get('notify')}} @endif" id="notifikasi">
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
                                <div  @if (!$undReadNotif->isEmpty() && $undReadNotif->count() > 2 )  class="direct-chat-messages p-2" style="height: 340px"  @endif >
                                    @forelse ($undReadNotif as $data)
                                        <div class="card mt-3">
                                            <div class="card-header" aria-expanded="false">
                                                <div class="card-tools mr-0">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-tool float-right px-0" data-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v float-lg-right mt-2"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <a wire:click="bacaNotif('{{$data['id']}}')" class="dropdown-item text-dark">Baca Notifikasi</a></li>
                                                            {{-- <li class="dropdown-divider"></li> --}}
                                                            <a wire:click="deleteNotif('{{$data['id']}}')" class="text-dark dropdown-item">Hapus Notifikasi</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <span class="text-xs text-primary my-4"><i class="fas fa-info-circle"></i> Informasi | {{date('d F Y | H:m',strtotime($data['created_at']))}}</span>
                                                <p class="text-md mb-0 text-bold">{{$data['data']['title']}}</p>
                                                <p class="text-xs mb-1 col-12 col-md-6 pl-0">{{$data['data']['body']}}</p>
                                            </div>
                                        </div>
                                    @empty
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
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane" id="notifikasiRiwayat">
                                <div  @if (!$readNotif->isEmpty() && $readNotif->count() > 2 )  class="direct-chat-messages p-2" style="height: 340px"  @endif >
                                    @forelse ($readNotif as $data)
                                        <div class="card mt-3">
                                            <div class="card-header" aria-expanded="false">
                                                <div class="card-tools mr-0">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-tool float-right px-0" data-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v float-lg-right mt-2"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            {{-- <a href="#" class="dropdown-item text-dark">Baca Notifikasi</a></li> --}}
                                                            {{-- <li class="dropdown-divider"></li> --}}
                                                            <a wire:click="deleteNotif('{{$data['id']}}')" class="text-dark dropdown-item">Hapus Notifikasi</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <span class="text-xs text-primary my-4"><i class="fas fa-info-circle"></i> Informasi | {{date('d F Y | H:m',strtotime($data['created_at']))}}</span>
                                                <p class="text-md mb-0 text-bold">{{$data['data']['title']}}</p>
                                                <p class="text-xs mb-1 col-12 col-md-6 pl-0">{{$data['data']['body']}}</p>
                                            </div>
                                        </div>
                                    @empty
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
                                    @endforelse
                                </div>
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

@push('js')
<script>
    window.addEventListener('swal:modal', event => {
        Toast.fire({
            icon: event.detail.icon,
            title: event.detail.title
        });
    });
</script>
@endpush
