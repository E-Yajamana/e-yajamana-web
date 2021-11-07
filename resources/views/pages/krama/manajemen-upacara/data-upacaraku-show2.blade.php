@extends('layouts.krama.krama-layout')
@section('tittle','Data Upacaraku')

@push('css')

@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Data Upacaraku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Upacaraku</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline tab-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title">List Data Upacaraku</h3>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary float-right" type="button"  data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</button>

                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group float-md-left">
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                          <option data-select2-id="30">Alaska</option>
                                          <option data-select2-id="31">California</option>
                                          <option data-select2-id="32">Delaware</option>
                                          <option data-select2-id="33">Tennessee</option>
                                          <option data-select2-id="34">Texas</option>
                                          <option data-select2-id="35">Washington</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-9 ">
                                    <div class="form-group float-lg-right">
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                          <option data-select2-id="30">Alaska</option>
                                          <option data-select2-id="31">California</option>
                                          <option data-select2-id="32">Delaware</option>
                                          <option data-select2-id="33">Tennessee</option>
                                          <option data-select2-id="34">Texas</option>
                                          <option data-select2-id="35">Washington</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-12">
                    <div class="card  card-outline tab-content">
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover ">
                                    <div class="row">
                                        <div class="card card-primary">
                                            asdasd
                                        </div>

                                    </div>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card  card-outline tab-content">
                                        <div class="card-body">
                                            asdadsads
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.card -->
                </div>


                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->



@endsection

@push('js')

@endpush
