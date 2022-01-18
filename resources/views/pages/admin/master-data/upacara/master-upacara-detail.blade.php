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
                            <div class="col-12 col-sm-6">
                                <img src="{{asset('base-template/dist/img/upacara.jpg')}}" class="img-fluid pad img-thumbnail"  alt="Responsive image">
                            </div>
                            <div class="col-12 col-sm-6 d-flex align-items-center">
                                <div>
                                    <h1 class="my-3 text-center">{{$dataUpacara->nama_upacara}}</h1>
                                    <p class="text-center">
                                        {{$dataUpacara->deskripsi_upacara}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                    <div class="card-header my-auto">
                        <h3 class="card-title my-auto">Rentetan Upacara</h3>
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
                                <div class="col-12 col-sm-4">
                                    <h4 class="text-center mb-3">AWAL</h4>
                                    <ul>
                                        @foreach ($dataUpacara->TahapanUpacara->where('status_tahapan','awal') as $data)
                                            <li>{{$data->nama_tahapan}}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <h4 class="text-center mb-3">PUNCAK</h4>
                                    <ul>
                                        {{-- <li class="none">Tidak Terdapat Data Tahpapan pada Rentetan Upacara ini</li> --}}

                                        @foreach ($dataUpacara->TahapanUpacara->where('status_tahapan','puncak') as $data)
                                            @if ($data == null)
                                                <li class="none">Tidak Terdapat Data Tahpapan pada Rentetan Upacara ini</li>
                                            @endif
                                            <li>{{$data->nama_tahapan}}</li>
                                        @endforeach
                                    </ul>

                                </div>
                                <div class="col-12 col-sm-4">
                                    <h4 class="text-center mb-3">AKHIR</h4>
                                    <ul>
                                        @foreach ($dataUpacara->TahapanUpacara->where('status_tahapan','akhir') as $data)
                                            <li>{{$data->nama_tahapan}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-upacara').addClass('active');
        });
    </script>

@endpush
