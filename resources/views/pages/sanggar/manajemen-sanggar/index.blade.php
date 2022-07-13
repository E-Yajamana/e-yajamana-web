@extends('layouts.sanggar.sanggar-layout')
@section('tittle','Manajemen Sanggar')

@push('css')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manajemen Sanggar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('sanggar.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manajemen Sanggar</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pemetaan Maps E-Yajamana</h4>
                    <button type="button" style="" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="gmaps" style="height: 500px"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary">Simpan Pemetaan Lokasi</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card tab-content" id="v-pills-tabContent">
            <div class="card-header my-auto">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{route('image.profile.sanggar',$dataSanggar->id)}}" alt="User profile picture">
                    <div class="">
                        <button class="p-1 text-muted text-center mb-0 mt-1 text-xs btn btn-link" onclick="changeProfile()">Ubah Foto Profile</button>
                    </div>
                </div>
            </div>
            <form action="{{route('manajemen-sanggar.update')}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="file" id="image_profile" name="image_profile" hidden >
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Pemilik Sanggar</label>
                                <input disabled type="text" class="form-control @error('nama_sanggar') is-invalid @enderror" name="nama_sanggar" placeholder="Masukan Nama Sanggar" value="{{Auth::user()->Penduduk->nama}}" >
                            </div>
                            @error('nama_sanggar')
                                <div class="invalid-feedback text-start">
                                    {{$errors->first('nama_sanggar') }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Mendaftar pada tanggal</label>
                                <input type="text" class="form-control" name="" placeholder="Enter email" value="{{date('d F Y',strtotime($dataSanggar->created_at))}}" disabled>
                            </div>

                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Nama Sanggar</label>
                                <input type="text" class="form-control @error('nama_sanggar') is-invalid @enderror" name="nama_sanggar" placeholder="Masukan Nama Sanggar" value="{{$dataSanggar->nama_sanggar}}">
                            </div>
                            @error('nama_sanggar')
                                <div class="invalid-feedback text-start">
                                    {{$errors->first('nama_sanggar') }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-0">
                                <label>SK tanda usaha</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="sk_tanda_usaha" class="custom-file-input @error('file') is-invalid @enderror"  id="customFile">
                                        <label class="custom-file-label " for="customFile"> Ganti SK Tanda Usaha</label>
                                    </div>
                                </div>
                            </div>
                            <a class="p-0 text-xs btn btn-link" data-toggle="modal" data-target="#skSulinggih">Lihat SK tanda usaha</a>
                            <div class="modal fade" id="skSulinggih" tabindex="-1" role="dialog" aria-labelledby="skSulinggih" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div id="skSulinggih" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#skSulinggih" data-slide-to="0"  class="active"></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="{{route('image.sk-sanggar',$dataSanggar->id)}}" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Service Sanggar</label>
                                <div class="select2-primary">
                                    <select class="select2" multiple="multiple" name="service[]" data-placeholder="Pilih Service Sanggar" data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            @foreach ($dataSanggar->Service as $serviceSanggar)
                                                <option value="{{$serviceSanggar->id}}" selected>{{$serviceSanggar->nama_service}}</option>
                                            @endforeach
                                            @foreach ($services as $service)
                                                <option value="{{$service->id}}">{{$service->nama_service}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header p-0"></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                                <select name="kabupaten" id="kabupaten" class="form-control select2bs4 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;" value="{{old('kabupaten')}}">
                                    <option value="0" disabled selected>Pilih Kabupaten</option>
                                    @foreach ($dataKabupaten->where('provinsi_id',51) as $data)
                                        <option  value="{{$data->id}}" @if ($dataSanggar->BanjarDinas->DesaDinas->Kecamatan->Kabupaten->id == $data->id) selected @endif >{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @error('kabupaten')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('kabupaten') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Kecamatan <span class="text-danger">*</span></label>
                                <select id="kecamatan" class="form-control select2bs4 @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                    <option value="0" disabled>Pilih Kecamatan</option>
                                    <option value="0" selected>{{$dataSanggar->BanjarDinas->DesaDinas->Kecamatan->name}}</option>
                                </select>
                                <p class="m-1 text-xs">(Pilih Kabupaten terlebih dahulu)</p>
                                @error('kecamatan')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('kecamatan') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Desa Dinas<span class="text-danger">*</span></label>
                                <select id="desa_dinas" name="id_desa" class="form-control select2bs4 @error('id_desa') is-invalid @enderror" style="width: 100%;">
                                    <option value="0" disabled>Pilih Desa Dinas</option>
                                    <option value="0" selected>{{$dataSanggar->BanjarDinas->DesaDinas->name}}</option>
                                </select>
                                <p class="m-1 text-xs">(Pilih Kecamatan terlebih dahulu)</p>
                                @error('id_desa')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('id_desa') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Banjar Dinas <span class="text-danger">*</span></label>
                                <select id="id_banjar_dinas" name="id_banjar_dinas" class="form-control select2bs4 @error('id_banjar_dinas') is-invalid @enderror" style="width: 100%;">
                                    <option value="0" disabled >Pilih Banjar Dinas</option>
                                    <option value="{{$dataSanggar->BanjarDinas->id}}" selected>{{$dataSanggar->BanjarDinas->nama_banjar_dinas}}</option>
                                </select>
                                <p class="m-1 text-xs">(Pilih Desa Dinas terlebih dahulu)</p>
                                @error('id_banjar_dinas')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('id_banjar_dinas') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <div class="form-group">
                                <label>Alamat Lengkap Sanggar</label>
                                <textarea name="alamat_sanggar" class="form-control  @error('alamat_sanggar') is-invalid @enderror" rows="3" placeholder="Masukan Alamat Sanggar">{{ $dataSanggar->alamat_sanggar}}</textarea>
                                @error('alamat_sanggar')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('alamat_sanggar') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <div class="form-group">
                                <label>Pemetaan Lokasi Sanggar</label>
                                <div class="input-group mb-3">
                                    <input name="lat" id="lat" type="text" aria-label="First name" class="form-control mr-1 @error('lat') is-invalid @enderror" placeholder="Lat" readonly="readonly" value="{{$dataSanggar->lat}}">
                                    @error('lat')
                                        <div class="invalid-feedback text-start">
                                            {{ $errors->first('lat') }}
                                        </div>
                                    @enderror
                                    <input name="lng" id="lng" type="text" aria-label="Last name" class="form-control ml1" placeholder="Lang  @error('lng') is-invalid @enderror" readonly="readonly" value="{{$dataSanggar->lng}}">
                                    @error('lng')
                                        <div class="invalid-feedback text-start">
                                            {{ $errors->first('lng') }}
                                        </div>
                                    @enderror
                                    <button type="button" class="btn btn-default ml-2" data-toggle="modal" id="modalMap" data-target="#modal-xl">
                                        <i class="fas fa-map-marked"></i>
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end ">
                            <button type="submit" class=" mx-1 btn btn-primary">Simpan Data</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card tab-content p-1 m-2" id="v-pills-tabContent">
            <div class="card-header my-auto">
                <label class="mb-0">Data Anggota Sanggar</label>
                <div class="card-tools">
                    <button data-dismiss="modal" class="btn btn-primary" data-toggle="modal" data-target="#addAnggota"><i class="fas fa-plus"></i> Tambah anggota</button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <table class='table-responsive-sm table' id="example2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Nama Anggota</th>
                                    <th>Nomor Telepon</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataSanggar->User as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->email}}</td>
                                        <td>{{$data->Penduduk->nama}}</td>
                                        <td>{{$data->nomor_telepon}}</td>
                                        <td>{{$data->Penduduk->alamat}}</td>
                                        <td class="text-center">
                                            <a title="Keluarkan Anggota" onclick="hapusAnggota({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <form id="hapus-{{$data->id}}" class="d-none" action="{{route('manajemen-sanggar.delete')}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" class="d-none" name="id_user" value="{{$data->id}}">
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addAnggota" tabindex="-1" role="dialog" aria-labelledby="addAnggota" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-md" id="addAnggotaLabel">Tambah Anggota Sanggar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('manajemen-sanggar.store')}}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label>Data Krama </label>
                            <select name="id_user" id="id_user" class="form-control select2bs4 id_user @error('id_user') is-invalid @enderror" style="width: 100%;" value="{{old('id_user')}}">
                                <option value="0" selected>Pilih Anggota</option>
                                @foreach ($dataKrama as $data)
                                    <option value="{{$data->id}}" >{{$data->Penduduk->nik}} | {{$data->Penduduk->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Tambah Anggota</button>
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
    <!-- Ajax Get Data Wilayah -->
    <script src="{{asset('base-template/dist/js/pages/ajax-get-wilayah.js')}}"></script>

    <script type="text/javascript">
        $('#mySelect2').select2('data');

        $(document).ready(function(){
            $('#side-manajemen-sanggar').addClass('menu-open');
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

    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            //--------------START Deklarasi awal seperti icon pembuatan map-------------//
            var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 10);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Maps E-Yajamana',
                maxZoom: 18,
                minZoom: 9,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
            }).addTo(mymap);


            document.getElementById("modalMap").onclick = function () {
                document.getElementById('modal-xl').style.display = 'block';
                setTimeout(function() {
                    mymap.invalidateSize();
                }, 100);
            }

            var curLocation = [$("#lat").val(), $("#lng").val()];

            if (curLocation[0] == 0 && curLocation[1] == 0) {
                curLocation = [-8.4517916, 115.1970086];
            }

            var marker = new L.marker(curLocation, {
                draggable: 'true'
            });

            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                marker.setLatLng(position, {
                draggable: 'true'
                }).bindPopup(position).update();
                $("#lat").val(position.lat);
                $("#lng").val(position.lng).keyup();
            });

            $("#Latitude, #Longitude").change(function() {
                var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
                marker.setLatLng(position, {
                draggable: 'true'
                }).bindPopup(position).update();
                mymap.panTo(position);
            });

            mymap.addLayer(marker);
        });

    </script>

@endpush

@push('js')
    <script>
        function hapusAnggota(id)
        {
            Swal.fire({
                title: 'Keluarkan Anggota',
                text : 'Apakah anda yakin akan mengeluarkan anggota Sanggar tersebut?',
                icon:'question',
                showDenyButton: true,
                showCancelButton: false,
                denyButtonText: `Tidak`,
                confirmButtonText: `iya`,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#hapus-"+id).submit();
                }
            })
        }

        function changeProfile()
        {
            console.log('testinug')
            $("#image_profile").click();
        }

    </script>
@endpush


