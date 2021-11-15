@extends('layouts.krama.krama-layout')
@section('tittle','Reservasi')

@push('css')
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">


@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reservasi Pemuput Karya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Upacaraku</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info container-fluid">
                        <h5><i class="fas fa-info"></i> Catatan:</h5>
                        Anda dapat melakukan reservasi pada beberapa tahapan yang tersedia pada suatu upacara.
                    </div>

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Pencarian Reservasi</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                    <div class="step" data-target="#logins-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Pencarian</span>
                                        </button>
                                    </div>

                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Pilih Tahapan</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#next-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="next-part"
                                        id="next-part-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Rangkuman</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>



        </div>
    </section>


@endsection

@push('js')
    <!-- BS-Stepper -->
    <script src="{{asset('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>


    <script type="text/javascript">

        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

    </script>

@endpush
