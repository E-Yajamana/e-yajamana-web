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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Data Upacara</a></li>
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
                                    <h1 class="my-3 text-center">Piodalan Ring Pura</h1>
                                    <p class="text-center">
                                        Piodalan yang utamanya sebagai kelompok upacara Dewa Yadnya ini merupakan upacara yang ditujukan kehadapan
                                        Ida Sang Hyang Widhi Waça dengan segala manifestasinya yang pujawalinya dipimpin oleh seorang pemangku di tempat suci masing-masing.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-primary card-outline tab-content collapsed-card" id="v-pills-tabContent">
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
                                    <li>Ngraga Tirta Suci</li>
                                    <li>Persiapan Pemangku</li>
                                    <li>Matur Pakeling</li>
                                    <li>Ngelukat Banten</li>
                                    <li>Maprayascita</li>
                                    <li>Mablyaka</li>
                                    <li>Ngudang Dewa</li>
                                    <li>Ngelinggihang Dewa/Batara Ring Purwa Daksina</li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-4">
                                <h4 class="text-center mb-3">PUNCAK</h4>
                                <ul>
                                    <li>Ngaturang Ayaban Ring Batara</li>
                                    <li>Ngaturang Banten Suci</li>
                                    <li>Puja Astawa ke Luhur</li>
                                    <li>Ngelukat Caru</li>
                                    <li>Ngayab Caru</li>
                                    <li>Ngaturang Pesucian</li>
                                    <li>Ngayab ke Sowang-Sowang Pelinggih</li>
                                    <li>Matur Sembah</li>
                                    <li>Ngaturang Ayaban ke Surya Saksi</li>
                                </ul>

                            </div>
                            <div class="col-12 col-sm-4">
                                <h4 class="text-center mb-3">AKHIR</h4>
                                <ul>
                                    <li>Ngewaliang Linggih Batara Sami</li>
                                    <li>Ngaturang Pengaksama Ring Batara Sami</li>
                                    <li>Ngeruwak Caru</li>
                                    <li>Ngelukat Banten</li>
                                    <li>Maprayascita</li>
                                    <li>Mablyaka</li>
                                    <li>Ngudang Dewa</li>
                                    <li>Ngelinggihang Dewa/Batara Ring Purwa Daksina</li>
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

@endpush
