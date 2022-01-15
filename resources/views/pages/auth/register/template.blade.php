@extends('pages.auth.layout.master')
@section('tittle','Register Krama')

@section('content')
    <div class="container justify-content-center pt-4">
        <div class="card card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('base-template/dist/img/logo-01.png') }}" alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h4 fw-bold mb-1">E-Yajamana</a>
                <p class="mt-1 fs-5 mb-1">Form Pendaftaran Akun Krama Bali </p>
                <p class="text-center mb-2">Silahkan lengkapi data di bawah ini</p>

            </div>
            <div class="card-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row px-lg-4">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama" autocomplete="off" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan Nama lengkap">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('nama')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>E-Mail <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="email" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan E-Mail">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nomor HP <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="number" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan Nomor HP">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone-alt"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Masukan Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Masukan Kembali Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Provinsi <span class="text-danger">*</span></label>
                                <select id="kabupaten" name="kabupaten" class="form-control select2 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;">
                                    <option value="#" disabled selected>Pilih Kabupaten</option>
                                    {{-- @foreach ($kabupaten as $k)
                                        <option value="{{$k->id}}">{{ucfirst($k->nama_kabupaten)}}</option>
                                    @endforeach --}}
                                </select>
                                @error('kabupaten')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                                <select id="kabupaten" name="kabupaten" class="form-control select2 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;">
                                    <option value="#" disabled selected>Pilih Kabupaten</option>
                                    {{-- @foreach ($kabupaten as $k)
                                        <option value="{{$k->id}}">{{ucfirst($k->nama_kabupaten)}}</option>
                                    @endforeach --}}
                                </select>
                                @error('kabupaten')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kecamatan <span class="text-danger">*</span></label>
                                <select id="kecamatan" name="kecamatan" class="form-control select2 kecamatan @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                </select>
                                @error('kecamatan')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Desa/Kelurahan <span class="text-danger">*</span></label>
                                <select id="desa" name="desa" class="form-control select2 @error('desa') is-invalid @enderror" style="width: 100%;">
                                </select>
                                @error('desa')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label>Banjar <span class="text-danger">*</span></label>
                                <select id="banjar" name="banjar" class="form-control select2 @error('banjar') is-invalid @enderror" style="width: 100%;">
                                </select>
                                @error('banjar')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label>Alamat Lengkap <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="email" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan Alamat Lengkap">
                                    @error('email')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end mt-1 p-lg-4">
                        <div class="col-5 col-sm-8">
                            <p> Sudah memiliki akun? Klik
                                <a href="#" class="text-decoration-none link-primary">di sini</a>
                            </p>
                        </div>
                        <div class="col-7 col-sm-4">
                            <button type="submit" class="btn btn-primary btn-block">Daftarkan Akun</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="text-center my-4">
                <a href="" class="nav-link link-dark">E-Yajamana 2021 | All Right Reserved &copy </a>
            </div>
        </div>
    </div>

@endsection
