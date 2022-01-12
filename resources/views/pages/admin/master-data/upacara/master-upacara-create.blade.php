@extends('layouts.admin.admin-layout')
@section('tittle','Data Upacara')

@push('css')
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}
    <!-- Select2 -->
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
                <form method="POST" action="{{route('admin.master-data.upacara.store')}}">
                    @csrf
                    <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                        <div class="card-header my-auto">
                            <h3 class="card-title my-auto">Form Tambah Data Upacara</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Upacara <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" >
                            </div>
                            <div class="form-group">
                                <label>Katagori Upacara <span class="text-danger">*</span></label>
                                <select name="peminjam" class="form-control select2bs4  @error('peminjam') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                    <option disabled selected>Pilih Katagori Upacara</option>
                                    <option>Dewa Yadnya</option>
                                    <option>Pitra Yadnya</option>
                                </select>
                                @error('peminjam')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('peminjam') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Foto Kegiatan Upacara</label>
                                <div class="input-group mb-2">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="customFile">
                                        <label class="custom-file-label " for="customFile">Foto Upacara</label>
                                    </div>
                                    @error('file')
                                        <div class="invalid-feedback text-start">
                                            {{ $errors->first('file') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Upacara <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control  @error('email') is-invalid @enderror" rows="3" placeholder="Masukan Alamat Lengkap" value="{{ old('alamat') }}" ></textarea>
                                @error('alamat')
                                <div class="invalid-feedback text-start">
                                    {{$errors->first('alamat') }}
                                </div>
                                @enderror
                            </div>
                            <div id="button-remove" class="row justify-content-end mr-1">
                                <button type="button" class="btn mx-1 btn-primary" onclick="view()">Buat Tahapan Upacara</button>
                                <button type="submit" class=" mx-1 btn btn-primary">Simpan Upacara</button>
                            </div>

                            <div id="tahapan-upacara" class="d-none">
                                <div class="card-header p-0 mt-4 mb-2">
                                    <h3 class="card-title my-auto">Form Tambah Tahapana Upacara</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table" id="multiForm">
                                        <thead>
                                            <th>Nama Tahapan</th>
                                            <th>Deskripsi Tahapan</th>
                                            <th>Status Tahapan</th>
                                            <th>Gambar Tahapan</th>
                                            <th>Tindakan</th>
                                        </thead>
                                        <tr>
                                            <td>
                                                <input type="text" name="nama_tahapan[]" class="form-control" placeholder="Masukan Tahapan"/>
                                            </td>
                                            <td>
                                                <input type="text" name="desc_tahapan[]" placeholder="Masukan" class="form-control"/>
                                            </td>
                                            <td>
                                                <select name="status[]" class="form-control select2bs4  @error('peminjam') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                                    <option disabled selected>Pilih Status Tahapan</option>
                                                    <option value="awal">Awal</option>
                                                    <option value="puncak">Puncak</option>
                                                    <option value="akhir">Akhir</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="image[]" id="customFile">
                                                    <label class="custom-file-label " for="customFile">Foto Upacara</label>
                                                </div>                                            </td>
                                            <td>
                                                <input type="button" name="add" value="Tambah" id="addRemoveIp" class="btn btn-outline-dark">
                                            </td>
                                        </tr>

                                    </table>
                                    <div class="row justify-content-end mr-2 mt-4">
                                        <button type="button" class=" mx-1 btn btn-info">Kembali</button>
                                        <button type="submit" class=" mx-1 btn btn-primary">Buat Upacara</button>
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

    <script>
        $(document).ready(function(){
            $("#button-remove").click(function(){
                $("#tahapan-upacara").removeClass("d-none");
                $("#button-remove").addClass("d-none");
            });
        });
    </script>


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
        var i = 0;
        $("#addRemoveIp").click(function () {
            ++i;
            $("#multiForm").append('<tr><td><input type="text" name="nama_tahapan[]" class="form-control" placeholder="Masukan Tahapan"/></td><td><input type="text" name="desc_tahapan[]" placeholder="Masukan" class="form-control"/></td><td><select name="status[]" class="form-control select2bs4" style="width: 100%;" aria-placeholder="Pilihlah Program Studi"><option disabled selected>Pilih Status Tahapan</option> <option value="awal">Awal</option> <option value="puncak">Puncak</option><option value="akhir">Akhir</option></select></td><td><div class="custom-file"> <input type="file" class="custom-file-input" name="image[]" id="customFile"><label class="custom-file-label " for="customFile">Foto Upacara</label></div></td><td><button type="button" class="remove-item btn btn-danger ">Hapus</button></td></tr>');
        });

        $(document).on('click', '.remove-item', function () {
            $(this).parents('tr').remove();
        });

    </script>


@endpush
