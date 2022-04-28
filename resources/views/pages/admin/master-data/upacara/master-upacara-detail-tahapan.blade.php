@extends('layouts.admin.admin-layout')
@section('tittle','Detail Upacara')

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Detail Tahapan Upacara</h1>
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
                        <h3 class="card-title my-auto">Informasi Tahapan Upacara</h3>
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
                                <img src="{{route('image.tahapan-upacara',$dataTahapan->id)}}" style="height: 400px; width:100%" class=" d-flex img-fluid pad img-thumbnail"  alt="Responsive image">
                            </div>
                            <div class="col-12 col-sm-6 justify-content-center align-items-center d-flex">
                                <div class=" text-center px-lg-4">
                                    <h1 class="my-3 text-center">{{$dataTahapan->nama_tahapan}}</h1>
                                    <p class="text-center">
                                        {{$dataTahapan->deskripsi_tahapan}}
                                        <div class="row d-flex justify-content-center">
                                            <div class="bg-secondary btn-sm center-block " style="border-radius: 5px; width:70px; ">{{$dataTahapan->status_tahapan}}</div>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-12 my-2">
                            <a href="{{route('admin.master-data.upacara.detail',$dataTahapan->id_upacara)}}" class="btn btn-secondary">Kembali</a>
                            <a onclick="deleteData({{$dataTahapan->id}})" class="btn btn-danger float-right ml-2">Hapus Tahapan Upacara</a>
                            <button onclick="editTahapan({{$dataTahapan->id}},'{{$dataTahapan->nama_tahapan}}','{{$dataTahapan->deskripsi_tahapan}}','{{$dataTahapan->status_tahapan}}','{{$dataTahapan->image}}')" class="btn btn-info float-right mr-2">Edit Data Tahapan<a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form hidden id="{{"delete-".$dataTahapan->id}}" class="d-none" action="{{route('admin.master-data.upacara.tahapan.delete')}}" method="post">
        @csrf
        @method('DELETE')
        <input type="hidden" class="d-none" name="id" value="{{$dataTahapan->id}}">
    </form>

    <div class="modal fade" id="myModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Tahapan Upacara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formUpdateTahapan"  action="{{route('admin.master-data.upacara.tahapan.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input id="id_tahapan" name="id" value="" type="hidden" class="d-none">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Tahpan Upacara<span class="text-danger">*</span></label>
                            <input id="nama_tahapan" type="text" name="nama_tahapan" class="form-control @error('nama_tahapan') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Griya" value="{{old('nama_tahapan')}}">
                            @error('nama_tahapan')
                                <div class="invalid-feedback text-start">
                                    {{ $errors->first('nama_tahapan') }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Status Tahapan Upacara <span class="text-danger">*</span></label>
                            <select id="status" name="status" class="form-control  @error('status') is-invalid @enderror" style="width: 100%;">
                                <option disabled selected>Pilih Status Tahapan</option>
                                <option value="awal" >Awal</option>
                                <option value="puncak" >Puncak</option>
                                <option value="akhir" >Akhir</option>
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
                                    <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="customFile" >
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
                            <label>Deskripsi Tahapan Upacara<span class="text-danger">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control  @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Masukan Alamat Lengkap Griya" value="{{ old('deskripsi') }}" ></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback text-start">
                                    {{$errors->first('deskripsi') }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Ubah Tahapan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        function deleteData(index){
            Swal.fire({
                title: 'Peringatan',
                text : 'Apakah anda yakin akan menghapus Data Tahapan Upacara tersebut?',
                icon:'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Hapus`,
                denyButtonText: `Batal`,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-'+index).submit();
                    } else if (result.isDenied) {

                    }
                })
            }

        function editTahapan(id,nama,desc,status,image){
            $("#id_tahapan").val(id);
            $("#nama_tahapan").val(nama);
            $("#status").val(status);
            $("#deskripsi").val(desc);
            $("#myModal").modal();
        }
    </script>


    <script>
        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-upacara').addClass('active');
        });
    </script>

     <!-- Bootstrabase-template-->
     <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

@endpush
