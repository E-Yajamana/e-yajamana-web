@extends('layouts.admin.admin-layout')
@section('tittle','Tambah Data Upacara')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">


@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Master Data Upacara</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Upacara</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{route('admin.master-data.upacara.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                        <div class="card-header my-auto">
                            <h3 class="card-title my-auto">Form Tambah Data Upacara</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Upacara <span class="text-danger">*</span></label>
                                <input type="text" name="nama_upacara" class="form-control @error('nama_upacara') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Upacara">
                                @error('nama_upacara')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('nama_upacara') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Katagori Upacara <span class="text-danger">*</span></label>
                                <select name="katagori" class="form-control select2bs4  @error('katagori') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                    <option disabled selected>Pilih Katagori Upacara</option>
                                    <option value="Dewa Yadnya" >Dewa Yadnya</option>
                                    <option value="Pitra Yadnya" >Pitra Yadnya</option>
                                    <option value="Manusa Yadnya" >Manusa Yadnya</option>
                                    <option value="Rsi Yadnya" >Rsi Yadnya</option>
                                    <option value="Bhuta Yadnya" >Bhuta Yadnya</option>
                                </select>
                                @error('katagori')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('katagori') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Foto Kegiatan Upacara</label>
                                <div class="input-group mb-2">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('foto_upacara') is-invalid @enderror" name="foto_upacara" id="customFile">
                                        <label class="custom-file-label " for="customFile">Foto Kegiatan Upacara</label>
                                    </div>
                                </div>
                                @error('foto_upacara')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('foto_upacara') }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Deskripsi Upacara <span class="text-danger">*</span></label>
                                <textarea name="deskripsi_upacara" class="form-control  @error('deskripsi_upacara') is-invalid @enderror" rows="3" placeholder="Masukan Deskripsi Upacara" value="{{ old('deskripsi_upacara') }}" ></textarea>
                                @error('deskripsi_upacara')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('deskripsi_upacara') }}
                                    </div>
                                @enderror
                            </div>
                            <div id="button-remove" class="row justify-content-end mr-1">
                                <button id="buatTahapan" type="button" class="btn mx-1 btn-primary">Buat Tahapan Upacara</button>
                                <button type="submit" class=" mx-1 btn btn-primary">Simpan Upacara</button>
                            </div>

                            <div id="tahapan-upacara" class="d-none">
                                <div class="card-header p-0 mt-4 mb-2">
                                    <h3 class="card-title my-auto">Form Tambah Tahapana Upacara</h3>
                                </div>
                                <div class="card-body p-2">
                                    <table class="table" >
                                        <thead>
                                            <th>Nama Tahapan</th>
                                            <th>Deskripsi Tahapan</th>
                                            <th>Status Tahapan</th>
                                            <th>Foto Tahapan</th>
                                            <th>Tindakan</th>
                                        </thead>
                                        <tbody id="multiForm">
                                            {{-- @if (Session::has('dataTahapan'))
                                                <h3 class="card-title my-auto"></h3>
                                            @endif --}}
                                            {{-- {{dd(old('dataTahapan[0][nama_tahapan]'))}} --}}
                                        </tbody>
                                    </table>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <button type="button" class="ml-2 btn btn-secondary">Kembali</button>
                                        </div>
                                        <div class="row col-6 justify-content-end">
                                            <button type="button" id="addRemoveIp" class=" mx-1 btn btn-info">Tambah Tahapan</button>
                                            <button type="submit" class=" mx-1 btn btn-primary">Simpan Upacara</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('js')
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>


    <script type="text/javascript">
        $('#mySelect2').select2('data');

        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-upacara').addClass('active');
        });

        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $(function () {
            bsCustomFileInput.init();
        });

    </script>

    <script>
        $(document).ready(function(){
            $("#buatTahapan").click(function(){
                $("#tahapan-upacara").removeClass("d-none");
                $("#button-remove").addClass("d-none");
                $("#multiForm").append('<tr><td><input type="text" name="dataTahapan[0][nama_tahapan]" class="form-control " placeholder="Masukan Nama Tahapan"/></td><td><input type="text" name="dataTahapan[0][desc_tahapan]" placeholder="Masukan Deskripsi Tahapan" class="form-control"/></td><td><select name="dataTahapan[0][status]" class="form-control select2bs4" style="width: 100%;" ><option disabled value="" selected>Pilih Status Tahapan</option> <option value="awal">Awal</option> <option value="puncak">Puncak</option><option value="akhir">Akhir</option></select></td><td><div class="custom-file"> <input type="file" class="custom-file-input" name="dataTahapan[0][foto_tahapan]" id="customFile"><label class="custom-file-label " for="customFile">Foto Upacara</label></div></td><td><button type="button" class="remove-item btn btn-danger ">Hapus</button></td></tr>');
            });
        });
    </script>

    <script>
        var i = 0;
        $("#addRemoveIp").click(function () {
            ++i;
            $("#multiForm").append('<tr><td><input  type="text" name="dataTahapan['+i+'][nama_tahapan]" class="form-control" placeholder="Masukan Nama Tahapan"/></td><td><input  type="text" name="dataTahapan['+i+'][desc_tahapan]" placeholder="Masukan Deskripsi Tahapan" class="form-control"/></td><td><select  name="dataTahapan['+i+'][status]" class="form-control select2bs4" style="width: 100%;" ><option disabled selected>Pilih Status Tahapan</option> <option value="awal">Awal</option> <option value="puncak">Puncak</option><option value="akhir">Akhir</option></select></td><td><div class="custom-file"> <input  type="file" class="custom-file-input" name="dataTahapan['+i+'][foto_tahapan]" id="customFile"><label class="custom-file-label " for="customFile">Foto Upacara</label></div></td><td><button type="button" class="remove-item btn btn-danger ">Hapus</button></td></tr>');
        });
        $(document).on('click', '.remove-item', function () {
            $(this).parents('tr').remove();
        });

    </script>

@endpush
