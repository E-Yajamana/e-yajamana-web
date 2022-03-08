@extends('layouts.admin.admin-layout')
@section('tittle','Detail Upacara')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

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
                                <ul id="awal">
                                    @foreach ($dataUpacara->TahapanUpacara->where('status_tahapan','awal') as $data)
                                        <li>
                                            <a class="text-dark" href="{{route('admin.master-data.upacara.tahapan.detail',$data->id)}}">{{$data->nama_tahapan}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-12 col-sm-4">
                                <h4 class="text-center mb-3">PUNCAK</h4>
                                <ul id="puncak">
                                    @foreach ($dataUpacara->TahapanUpacara->where('status_tahapan','puncak') as $data)
                                        <li>
                                            <a class="text-dark" href="{{route('admin.master-data.upacara.tahapan.detail',$data->id)}}">{{$data->nama_tahapan}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-12 col-sm-4">
                                <h4 class="text-center mb-3">AKHIR</h4>
                                <ul id="akhir">
                                    @foreach ($dataUpacara->TahapanUpacara->where('status_tahapan','akhir') as $data)
                                        <li>
                                            <a class="text-dark" href="{{route('admin.master-data.upacara.tahapan.detail',$data->id)}}">{{$data->nama_tahapan}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <a href="{{route('admin.master-data.upacara.index')}}" class="btn btn-secondary">Kembali</a>
                                <a class="btn btn-danger float-right ml-2">Hapus DataUpacara</a>
                                <a href="{{route('admin.master-data.upacara.edit',$dataUpacara->id)}}" class="btn btn-info float-right mr-2">Edit Data Upacara<a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.admin.master-data.upacara.master-modal-tahapan-upacara-create')

@endsection

@push('js')
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-upacara').addClass('active');

        });

        $(function () {
            bsCustomFileInput.init();
        });

        $('#mySelect2').select2('data');

        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#submitData').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.master-data.upacara.tahapan.store') }}",
                type:'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $(document).find('div.invalid-feedback').text('');
                },
                success:function(response){
                    console.log(response)
                    console.log(response.data.id)
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                    $('#submitData')[0].reset();
                    $("#exampleModal").modal('hide');
                    $('#'+response.data.status_tahapan).append("<li><a class='text-dark' href='{{route('admin.master-data.upacara.tahapan.detail')}}/"+response.data.id+"'>"+response.data.nama_tahapan+"</a></li>");
                },
                error: function(response, error){
                    $.each(response.responseJSON.error, function(prefix, val){
                        $('#'+prefix+'_error').text(val[0]);
                    });
                }
            });

        })
    </script>

@endpush
