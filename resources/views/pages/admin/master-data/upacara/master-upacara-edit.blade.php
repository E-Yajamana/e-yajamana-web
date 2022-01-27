@extends('layouts.admin.admin-layout')
@section('tittle','Edit Data Upacara')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">


@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Data Upacara</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">E-Yajamana</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.master-data.upacara.index')}}">Data Upacara</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.master-data.upacara.detail',$dataUpacara->id)}}">{{$dataUpacara->nama_upacara}}</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form id="simpanData" action="{{route('admin.master-data.upacara.update')}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card tab-content" id="v-pills-tabContent">
                        <div class="card-header my-auto">
                            <h3 class="card-title my-auto">Form Edit Data Upacara</h3>
                        </div>
                        <div class="card-body p-4">
                            <input class="d-none" type="hidden" name="id" value="{{$dataUpacara->id}}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Upacara <span class="text-danger">*</span></label>
                                <input type="text" name="nama_upacara" class="form-control @error('nama_upacara') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Griya" value="{{$dataUpacara->nama_upacara}}">
                                @error('nama_upacara')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('nama_upacara') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kategori Upacara <span class="text-danger">*</span></label>
                                <select id="kategori_upacara" name="kategori_upacara" class="form-control select2bs4 kategori_upacara @error('kategori_upacara') is-invalid @enderror" style="width: 100%;">
                                    <option disabled selected>Pilih Katagori Upacara</option>
                                    <option @if ($dataUpacara->kategori_upacara == 'Dewa Yadnya') selected @endif value="Dewa Yadnya" >Dewa Yadnya</option>
                                    <option @if ($dataUpacara->kategori_upacara == 'Pitra Yadnya') selected @endif value="Pitra Yadnya" >Pitra Yadnya</option>
                                    <option @if ($dataUpacara->kategori_upacara == 'Manusa Yadnya') selected @endif value="Manusa Yadnya" >Manusa Yadnya</option>
                                    <option @if ($dataUpacara->kategori_upacara == 'Rsi Yadnya') selected @endif value="Rsi Yadnya" >Rsi Yadnya</option>
                                    <option @if ($dataUpacara->kategori_upacara == 'Bhuta Yadnya') selected @endif value="Bhuta Yadnya" >Bhuta Yadnya</option>
                                </select>
                                @error('kategori_upacara')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('kategori_upacara') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Foto Kegiatan Upacara</label>
                                <div class="input-group mb-2">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('foto_upacara') is-invalid @enderror" name="foto_upacara" id="customFile" value="{{$dataUpacara->image}}">
                                        <label class="custom-file-label " for="customFile">{{$dataUpacara->image}}</label>
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
                                <textarea name="deskripsi_upacara" class="form-control  @error('deskripsi_upacara') is-invalid @enderror" rows="3" placeholder="Masukan Deskripsi Upacara" value="{{ old('deskripsi_upacara') }}" >{{$dataUpacara->deskripsi_upacara}}</textarea>
                                @error('deskripsi_upacara')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('deskripsi_upacara') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card">
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
                        <table id="example2" class="table table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tahapan</th>
                                    <th>Deskripsi Tahapan</th>
                                    <th>Status Tahapan</th>
                                    <th>Foto Tahapan</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataUpacara->TahapanUpacara as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->nama_tahapan}}</td>
                                        <td style="width: 25%;">{{$data->deskripsi_tahapan}}</td>
                                        <td>{{$data->status_tahapan}}</td>
                                        <td style="width: 20%;height: 10%" ><img style="width: 100%;height: 150px" src="{{route('get-image.tahapan-upacara',$data->id)}}" class="img-fluid pad img-thumbnail"  alt="Responsive image"></td>
                                        <td>
                                            <a href="{{route('admin.master-data.upacara.tahapan.detail',$data->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <button type="button" onclick="editTahapan({{$data->id}},'{{$data->nama_tahapan}}','{{$data->deskripsi_tahapan}}','{{$data->status_tahapan}}','{{$data->image}}')" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            <a onclick="deleteData({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                        <form hidden id="{{"delete-".$data->id}}" class="d-none" action="{{route('admin.master-data.upacara.tahapan.delete')}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" class="d-none" name="id" value="{{$data->id}}">
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <a href="{{route('admin.master-data.upacara.detail',$dataUpacara->id)}}" class="btn btn-secondary">Kembali</a>
                        <button onclick="simpanData()" class="btn btn-primary float-right ml-2">Simpan Data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Tahapan Upacara</h5>
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

    <script type="text/javascript">
        function simpanData(){
            $("#simpanData").submit();
        }

        function editTahapan(id,nama,desc,status,image){
            $("#id_tahapan").val(id);
            $("#nama_tahapan").val(nama);
            $("#status").val(status);
            $("#deskripsi").val(desc);
            $("#myModal").modal();
        }

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

    </script>

    <!-- Data Table Atribut -->
    <script>
        $(function () {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari data....",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                }
            });
        });
    </script>
@endpush

@push('js')
    <!-- Fungsi Boostrap & Library  -->
    <script type="text/javascript">
        $('#side-master-data').addClass('menu-open');
        $('#side-upacara').addClass('active');


        $(function () {
            bsCustomFileInput.init();
        });

    </script>
    <!-- Fungsi Boostrap & Library  -->

    <!-- Bootstrabase-template-->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTablbase-template Plugins -->
    <script src="{{asset('base-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endpush
