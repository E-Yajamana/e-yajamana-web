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
                    <h1>Tambah Master Data Upacara Agama Hindu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.master-data.upacara.index')}}">Data Upacara</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{route('admin.master-data.upacara.store')}}" enctype="multipart/form-data" id="formMasterUpacara">
                    @csrf
                    <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                        <div class="card-header my-auto">
                            <h3 class="card-title my-auto">Form Tambah Upacara Agama Hindu</h3>
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
                                <label>Kategori Upacara <span class="text-danger">*</span></label>
                                <select name="katagori" class=" select2bs4  @error('katagori') is-invalid @enderror" style="width: 100%;" aria-placeholder="">
                                    <option disabled selected>Pilih Kategori Upacara</option>
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
                                <button id="buatTahapan" type="button" class="btn mx-1 btn-primary">Tambah Tahapan Upacara</button>
                                <button type="submit" class=" mx-1 btn btn-primary">Simpan Upacara</button>
                            </div>

                            <div id="tahapan-upacara" class="d-none">
                                <div class="card-header p-0 mt-4 mb-2">
                                    <h3 class="card-title my-auto">Form Tambah Tahapan Upacara</h3>
                                </div>
                                <div class="card-body p-2">
                                    <table class="table" >
                                        <thead>
                                            <th>Nama Tahapan <span class="text-danger">*</span></th>
                                            <th>Deskripsi Tahapan <span class="text-danger">*</span></th>
                                            <th>Status Tahapan <span class="text-danger">*</span></th>
                                            <th>Foto Tahapan</th>
                                            <th>Tindakan</th>
                                        </thead>
                                        <tbody id="multiForm">
                                        </tbody>
                                    </table>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <a href="{{route('admin.master-data.upacara.index')}}" type="button" class="ml-2 btn btn-secondary">Kembali</a>
                                        </div>
                                        <div class="row col-6 justify-content-end">
                                            <button type="button" id="addRemoveIp" class=" mx-1 btn btn-info">Tambah Tahapan</button>
                                            <button type="submit" class=" mx-1 btn btn-primary">Simpan Data</button>
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

    <script>
        $(document).ready(function(){
            $("#buatTahapan").click(function(){
                $("#tahapan-upacara").removeClass("d-none");
                $("#button-remove").addClass("d-none");
                $("#multiForm").append("<tr><td><input type='text' name='dataTahapan[0][nama_tahapan]' class='form-control ' placeholder='Masukan Nama Tahapan'/></td><td><input type='text' name='dataTahapan[0][desc_tahapan]' placeholder='Masukan Deskripsi Tahapan' class='form-control'/></td><td><select name='dataTahapan[0][status]' class='form-control select2bs4' style='width: 100%;' ><option disabled value='' selected>Pilih Status Tahapan</option> <option value='awal'>Awal</option> <option value='puncak'>Puncak</option><option value='akhir'>Akhir</option></select></td><td><div class='custom-file'> <input type='file' class='custom-file-input ' name='dataTahapan[0][foto_tahapan]' id='customFile-0'><label class='custom-file-label ' for='customFile'>Foto Upacara</label></div></td><td><button type='button' class='remove-item btn btn-danger '>Hapus</button></td></tr>");

                $(".form-control").each(function () {
                    $(this).rules('add', {
                        required: true
                    });
                });

                $('#customFile-0').on('change',function(){
                    //get the file name
                    var fileName = $(this).val();
                    console.log(fileName)
                    //replace the "Choose a file" label
                    $(this).next('.custom-file-label').html(fileName);
                })

            });

            var i = 0;
            $("#addRemoveIp").click(function () {
                ++i;
                $("#multiForm").append('<tr><td><input  type="text" name="dataTahapan['+i+'][nama_tahapan]" class="form-control" placeholder="Masukan Nama Tahapan"/></td><td><input  type="text" name="dataTahapan['+i+'][desc_tahapan]" placeholder="Masukan Deskripsi Tahapan" class="form-control"/></td><td><select  name="dataTahapan['+i+'][status]" class="form-control select2bs4" style="width: 100%;" ><option disabled selected>Pilih Status Tahapan</option> <option value="awal">Awal</option> <option value="puncak">Puncak</option><option value="akhir">Akhir</option></select></td><td><div class="custom-file"> <input id="customFile-'+i+'" type="file" class="custom-file-input " name="dataTahapan['+i+'][foto_tahapan]" id="customFile"><label class="custom-file-label " for="customFile">Foto Upacara</label></div></td><td><button type="button" class="remove-item btn btn-danger ">Hapus</button></td></tr>');

                $(".form-control").each(function () {
                    $(this).rules('add', {
                        required: true
                    });
                });

                $('#customFile-'+i).on('change',function(){
                    //get the file name
                    var fileName = $(this).val();
                    console.log(fileName)
                    //replace the "Choose a file" label
                    $(this).next('.custom-file-label').html(fileName);
                })
            });

            $(document).on('click', '.remove-item', function () {
                $(this).parents('tr').remove();
            });
        });
    </script>

    <script>
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    $("#formMasterUpacara")[0].submit();
                }
            });
            $('#formMasterUpacara').validate({
                rules: {
                'dataTahapan[][desc_tahapan]': {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
                terms: {
                    required: true
                },
                },
                messages: {
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

@endpush

@push('js')
    <!-- jquery-validation -->
    <script src="{{asset('base-template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-upacara').addClass('active');
        });

        $('#mySelect2').select2('data');

        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
