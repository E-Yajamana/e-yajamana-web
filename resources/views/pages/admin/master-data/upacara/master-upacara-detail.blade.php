@extends('layouts.admin.admin-layout')
@section('tittle','Detail Upacara')

@push('css')

@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Detail Upacara</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">E-Yajamana</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.master-data.upacara.index')}}">Data Upacara</a></li>
                    <li class="breadcrumb-item active">Data Detail Upacara</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                    <div class="card-header my-auto">
                        <h3 class="card-title my-auto">Deskripsi Upacara</h3>
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
                            <div class="col-12 col-sm-6" style="width: ">
                                <img src="{{route('get-image.upacara',$dataUpacara->id)}}" style="height: 400px; width:100%" class=" d-flex img-fluid pad img-thumbnail"  alt="Responsive image">
                            </div>
                            <div class="col-12 col-sm-6 justify-content-center align-items-center d-flex">
                                <div class=" text-center ">
                                    <h1 class="my-3 text-center">{{$dataUpacara->nama_upacara}}</h1>
                                    <p class="text-center">
                                        {{$dataUpacara->deskripsi_upacara}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-outline tab-content" id="v-pills-tabContent">
                    <div class="card-header my-auto">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="card-title my-auto">Rentetan Upacara</h3>
                            </div>
                            <div class="col-6">
                                <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row px-lg-4">
                            <div class="col-12 col-sm-4">
                                <h4 class="text-center mb-3">AWAL</h4>
                                <ul>
                                    @foreach ($dataUpacara->TahapanUpacara as $data)
                                        <li>
                                            <a class="text-dark" href="{{route('admin.master-data.upacara.tahapan.detail',$data->id)}}">{{$data->nama_tahapan}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-12 col-sm-4">
                                <h4 class="text-center mb-3">PUNCAK</h4>
                                <ul>
                                    @foreach ($dataUpacara->TahapanUpacara->where('status_tahapan','puncak') as $data)
                                        <li>
                                            <a class="text-dark" href="{{route('admin.master-data.upacara.tahapan.detail',$data->id)}}">{{$data->nama_tahapan}}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                            <div class="col-12 col-sm-4">
                                <h4 class="text-center mb-3">AKHIR</h4>
                                <ul>
                                    @foreach ($dataUpacara->TahapanUpacara->where('status_tahapan','akhir') as $data)
                                        <li>
                                            <a class="text-dark" href="{{route('admin.master-data.upacara.tahapan.detail',$data->id)}}">{{$data->nama_tahapan}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-12 mb-4">
                <a href="{{route('admin.master-data.upacara.index')}}" class="btn btn-secondary">Kembali</a>
                <a class="btn btn-danger float-right ml-2">Hapus DataUpacara</a>
                <a href="{{route('admin.master-data.upacara.edit',$dataUpacara->id)}}" class="btn btn-info float-right mr-2">Edit Data Upacara<a>
            </div>
        </div>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Tahapan Upacara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.master-data.upacara.tahapan.store')}}" enctype="multipart/form-data">
                        @csrf
                        <input class="d-none" type="hidden" name="id_upacara" value="{{$dataUpacara->id}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Tahapan Upacara <span class="text-danger">*</span></label>
                            <input id="nama_tahapan" type="text" name="nama_tahapan" class="form-control @error('nama_tahapan') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Tahapan" value="{{old('nama_tahapan')}}">
                            @error('nama_tahapan')
                                <div class="invalid-feedback text-start">
                                    {{ $errors->first('nama_tahapan') }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Status Upacara <span class="text-danger">*</span></label>
                            <select id="status" name="status" class="form-control  @error('status') is-invalid @enderror" style="width: 100%;">
                                <option disabled selected>Pilih Status Tahapan</option>
                                @php
                                    $status = old('status')
                                @endphp
                                <option @if ($status == 'awal') selected @endif  value="awal" >Awal</option>
                                <option @if ($status == 'puncak') selected @endif value="puncak" >Puncak</option>
                                <option @if ($status == 'akhir') selected @endif value="akhir" >Akhir</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback text-start">
                                    {{$errors->first('status') }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Foto Tahapan Upacara</label>
                            <div class="input-group mb-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="customFile" value="{{old('file')}}" >
                                    <label class="custom-file-label " for="customFile">Masukan Foto Tahapan</label>
                                </div>
                            </div>
                            @error('file')
                                <div class="invalid-feedback text-start">
                                    {{ $errors->first('file') }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Tahapan <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control  @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Masukan Deskripsi Tahapan" value="{{ old('deskripsi') }}" >{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback text-start">
                                    {{$errors->first('deskripsi') }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Buat Tahapan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-upacara').addClass('active');

        });

        $(function () {
            bsCustomFileInput.init();
        });

    </script>

@endpush
