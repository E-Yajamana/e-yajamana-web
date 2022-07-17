@extends('layouts.krama.krama-layout')
@section('tittle','Daftar Pemuput')

@push('css')

@endpush


@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Pemuput</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('krama.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Pemuput</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class=" container-fluid">
        <div class="row">
            {{-- <div class="col-12 p-0">
                <div class="card">
                    <div class="col-12" id="accordion">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                            <div class="card-header pl-1">
                                <div class="col-6 mx-0">
                                    <h3 class="card-title text-dark">Filter Pemuput Karya</h3>
                                </div>
                                <div class="card-tools">
                                    <button title="Filter Data" class="btn btn btn-tool">
                                        <a data-toggle="collapse" href="#collapseOne">
                                            FILTER
                                            <i class="fas fa-filter"></i>
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-12 col-sm-6 pl-0">
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="row">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class=" col-12 p-0">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($pemuputs as $pemuput)
                                <div class="col-12 col-sm-2" data-category="1" data-sort="white sample">
                                    <div class="card p-2 shadow cursor" style="height: 375px " role="button">
                                        <img src="{{route('image.profile.user',$pemuput->id)}}" style="height:200px; object-fit:cover;" class=" shadow-sm" alt="white sample"/>
                                        <div class="text-center text-dark p-1 fs-4">
                                            {{-- <label class="m-0 text-dark"></label> --}}
                                            <p class="text-center text-dark m-0 font-weight-bold text-md" style="height: 48px">{{$pemuput->PemuputKarya->nama_pemuput}}</p>
                                            <span  class="bg-secondary btn-sm text-xs m-1" style="border-radius: 5px; width:100px;" >{{Str::ucfirst("PEMUPUT KARYA")}}</span>
                                            <div class="row justify-content-center text-dark text-xs">
                                                <p class="text-center text-dark m-1 text-xs">{{$pemuput->PemuputKarya->GriyaRumah->BanjarDinas->DesaDinas->Kecamatan->Kabupaten->name}}</p>
                                            </div>
                                            <div class="row justify-content-center text-dark text-xs">
                                                <i class='fas fa-star @if ($pemuput->PemuputKarya->rating == 0) text-secondary  @else text-warning @endif' style="margin-top: 2px"></i> @if ($pemuput->PemuputKarya->rating == null) 0 @else {{$pemuput->PemuputKarya->rating}}  @endif  |<p class="text-center text-dark m-0 "> Muput Upacara : {{$pemuput->reservasi_count}} </p>
                                            </div>
                                        </div>
                                        <div class="btn-group btn-group-sm m-1">
                                            <button @if (in_array($pemuput->PemuputKarya->id, $favPemuput)) onclick='removeFavorit({{$pemuput->PemuputKarya->id}},"id_pemuput_karya",this)'  @else  onclick="addFavorit({{$pemuput->PemuputKarya->id}},'id_pemuput_karya',this)" @endif  title="Favorit" class="btn btn-secondary bg-white"><i class="fas fa-heart @if (in_array($pemuput->PemuputKarya->id, $favPemuput)) text-danger @endif "></i></button>
                                            <a title="Detail" href="{{route('krama.daftar-pemuput.detail-pemuput',$pemuput->PemuputKarya->id)}}" class="btn btn-secondary bg-white"><i class="fas fa-eye"></i></a>
                                            <a @if (count(Auth::user()->Upacaraku->whereNotIn('status',['batal','selesai'])) != 0)  href="{{route('krama.daftar-pemuput.reservasi.create',['pemuput_karya',$pemuput->id])}}" @else  onclick="alertReservasi()" @endif title="Reservasi" class="btn btn-secondary bg-white"><i class="fas fa-calendar-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($sanggars as $sanggar)
                                <div class="col-12 col-sm-2" data-category="1" data-sort="white sample">
                                    <div class="card p-2 shadow cursor" style="height: 375px " role="button">
                                        <img src="{{route('image.profile.sanggar',$sanggar->id)}}" style="height:200px; object-fit:cover;" class=" shadow-sm" alt="white sample"/>
                                        <div class="text-center text-dark p-1 fs-4">
                                            {{-- <label class="m-0 text-dark"></label> --}}
                                            <p class="text-center text-dark m-0 font-weight-bold text-md" style="height: 48px">{{$sanggar->nama_sanggar}}</p>
                                            <span  class="bg-secondary btn-sm text-xs m-1" style="border-radius: 5px; width:100px;" >{{Str::ucfirst("SANGGAR")}}</span>
                                            <div class="row justify-content-center text-dark text-xs">
                                                <p class="text-center text-dark m-1 text-xs">{{$sanggar->BanjarDinas->DesaDinas->Kecamatan->Kabupaten->name}}</p>
                                            </div>
                                            <div class="row justify-content-center text-dark text-xs">
                                                <i class='fas fa-star @if ($sanggar->rating == 0) text-secondary  @else text-warning @endif' style="margin-top: 2px"></i> @if ($sanggar->rating == null) 0 @else {{$sanggar->rating}}  @endif  |<p class="text-center text-dark m-0 "> Muput Upacara : {{$sanggar->reservasi_count}} </p>
                                            </div>
                                        </div>
                                        <div class="btn-group btn-group-sm m-1">
                                            <button @if (in_array($sanggar->id, $favSanggar)) onclick='removeFavorit({{$sanggar->id}},"id_sanggar",this)'  @else  onclick="addFavorit({{$sanggar->id}},'id_sanggar',this)" @endif title="Favorit" class="btn btn-secondary bg-white"><i class="fas fa-heart @if (in_array($sanggar->id, $favSanggar)) text-danger @endif "></i></button>
                                            <a title="Detail" href="{{route('krama.daftar-pemuput.detail-sanggar',$sanggar->id)}}" class="btn btn-secondary bg-white"><i class="fas fa-eye"></i></a>
                                            <a @if (count(Auth::user()->Upacaraku->whereNotIn('status',['batal','selesai'])) != 0)  href="{{route('krama.daftar-pemuput.reservasi.create',['sanggar',$sanggar->id])}}" @else  onclick="alertReservasi()" @endif title="Reservasi" href="" class="btn btn-secondary bg-white"><i class="fas fa-calendar-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $('#side-daftar-pemuput').addClass('menu-open');

        function alertReservasi()
        {
            Swal.fire({
                icon: 'warning',
                title: 'Gagal menambahkan reservasi...',
                text: 'untuk menambahkan reservasi, anda diminta untuk membuat sebauh upacara terlebih dahulu.. !!',
                footer: '<a href="{{route('krama.manajemen-upacara.upacaraku.create')}}">Buat upacara?</a>'
            })
        }

    </script>
@endpush

@push('js')
    <script>
        function addFavorit(id,tipe,button)
        {
            $(button).find("i").addClass("text-danger")
            $(button).attr("onclick","removeFavorit("+id+",'"+tipe+"',this)");
            $.ajax({
                url: "{{ route('ajax.set-favorit')}}",
                type:'POST',
                data: {
                    id:id,
                    tipe:tipe,
                    "_token":"{{ csrf_token() }}"
                },
                success:function(response){
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                },
                error: function(response, error){
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                }
            });
        }

        function removeFavorit(id,tipe,button)
        {
            $(button).find("i").removeClass("text-danger");
            $(button).attr("onclick","addFavorit("+id+",'"+tipe+"',this)");

            $.ajax({
                url: "{{ route('ajax.set-favorit')}}",
                type:'POST',
                data: {
                    id:id,
                    tipe:tipe,
                    "_token":"{{ csrf_token() }}"
                },
                success:function(response){
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                },
                error: function(response, error){
                    Toast.fire({
                        icon: response.icon,
                        title: response.title
                    })
                }
            });
        }
    </script>
@endpush

