<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-2">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-decoration-none mt-1">
        <img src="{{asset('base-template/dist/img/logo-01.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light fw-bold">E-Yajamana</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li id="side-pengaturan-akun" class="user-panel nav-item">
                    <a href="#" class="nav-link mb-2">
                        <img src="{{asset('base-template/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2 mr-2 mb-1" alt="User Image">
                        <p>
                            {{Auth::user()->Penduduk->nama_alias}}
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-switch" onclick="switchAccount()" class="nav-link">
                                <i class="far fa-circle nav-icon mr-1"></i>
                                <p>Switch Account</p>
                            </a>
                        </li>

                        <li class="nav-item ml-3">
                            <a id="side-profile" href="{{route('krama.profile')}}" class="nav-link">
                                <i class="far fa-circle nav-icon mr-1"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                        <li class="nav-item ml-3">
                            <a href="{{route('auth.logout')}}" class="nav-link">
                                <i class="far fa-circle nav-icon mr-1"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>

                 <!-- SidebarSearch Form -->
                 <div class="form-inline m-0 mt-3">
                    <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                    </div>
                </div>

                <li class="nav-header font-weight-bold pl-2" >DASHBOARD</li>
                <li class="nav-item" id="side-dashboard">
                    <a href="{{route('krama.dashboard')}}" class="nav-link p-2">
                        <i class="nav-icon mr-1 fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header font-weight-bold pl-2">MENU UTAMA</li>
                <li id="side-upacara" class="nav-item">
                    <a href="#" class="nav-link p-2">
                        <i class="fa bi-brightness-high-fill nav-icon mr-1"></i>
                        <p>
                            Manajemen Upacara
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-data-upacara" href="{{route('krama.manajemen-upacara.upacaraku.index')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon mr-1"></i>
                            <p>Data Upacara</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-tambah-upacara" href="{{route('krama.manajemen-upacara.upacaraku.create')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon mr-1"></i>
                            <p>Tambah Upacara</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li id="side-reservasi" class="nav-item">
                    <a href="#" class="nav-link p-2">
                        <i class="fas fa-calendar-alt nav-icon mr-1"></i>
                        <p >
                            Manajemen Reservasi
                            <i class="fas fa-angle-left right ml-lg-4"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-data-reservasi" href="{{route('krama.manajemen-reservasi.index')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon mr-1"></i>
                            <p>Data Reservasi</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a type="button" onclick="addReservasi()" id="side-tambah-reservasi" class="nav-link p-2">
                                <i class="far fa-circle nav-icon mr-1"></i>
                            <p>Tambah Reservasi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link p-2">
                        <i class="far bi-geo-alt-fill nav-icon mr-1"></i>
                        <p>Lokasi Pemuput</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>
<input id="countReservasi" type="hidden" value='{{count(Auth::user()->Upacaraku)}}'>

@if (count(Auth::user()->Upacaraku) != 0)
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pilih Upacara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="body">
                <div class="form-group">
                    <div class="form-group">
                        <label>Pilih Upacara yang akan direservasi <span class="text-danger">*</span></label>
                        <select id="jenis_upacara" name="id_upacara" class="form-control select2bs4" style="width: 100%;">
                            <option value="0" disabled selected>Pilih Upacara</option>
                            @foreach (Auth::user()->Upacaraku as $data)
                                <option value="{{$data->id}}">{{$data->nama_upacara}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button onclick="createReservasi()" type="button" class="btn btn-primary">Reservasi</button>
            </div>
            </div>
        </div>
    </div>
@endif

{{-- <div class="modal fade" id="switchAccount" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="card-body box-profile align-content-center">
                    <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                    </div>
                    <h3 class="text-center bold mb-0 mt-3">Ganti Akun</h3>
                    <div class="d-flex align-items-center justify-content-center">
                        <p style="width: 65%" class="text-center mb-1 mt-1 ">Anda dapat mengganti role akun yang anda miliki:</p>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="dataSulinggih">
                @foreach (Auth::user()->Role as $data)
                    <div class="card shadow collapsed-card mt-3">
                        <div class="card-header">
                            <div class="user-block">
                                <img class="img-circle"
                                @if ($data->nama_role == 'krama')  src="{{asset("base-template/dist/img/marker/griya.png")}}"
                                @elseif ($data->nama_role == 'pemuput_karya')  src="{{asset("base-template/dist/img/marker/pemuput.png")}}"
                                @elseif ($data->nama_role == 'sanggar')  src="{{asset("base-template/dist/img/marker/sanggar.png")}}"
                                @endif
                                alt="User Image">
                                <span class="username"><a class="stretched-link  ml-2 p-0 btn btn-link"
                                    @if ($data->nama_role == 'krama') href="{{route('krama.dashboard')}}" >Krama</a></span>
                                    @elseif ($data->nama_role == 'pemuput_karya') href="{{route('pemuput-karya.dashboard')}}" >Pemuput Karya </a></span>
                                    @elseif ($data->nama_role == 'sanggar') href="{{route('sanggar.dashboard')}}" >Sanggar </a></span>
                                    @endif
                                <span class="description">
                                    <div class="ml-2">
                                        @if ($data->nama_role == 'krama') {{Auth::user()->Penduduk->nama}}
                                        @elseif ($data->nama_role == 'pemuput_karya') {{Auth::user()->PemuputKarya->nama_pemuput}}
                                        @elseif ($data->nama_role == 'sanggar') {{Auth::user()->Penduduk->nama}}
                                        @endif
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div> --}}



@push('js')
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>

    <script>
        function addReservasi(){
            let countReservasi = $('#countReservasi').val();
            if(countReservasi != 0){
                $('#exampleModalCenter').modal();
            }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Gagal menambahkan reservasi...',
                    text: 'untuk menambahkan reservasi, anda diminta untuk membuat sebauh upacara terlebih dahulu.. !!',
                    footer: '<a href="{{route('krama.manajemen-upacara.upacaraku.create')}}">Buat upacara?</a>'
                })
            }
        }

        function createReservasi(){
            var data = $("#jenis_upacara").val();
            location.href = "{{route('krama.manajemen-reservasi.create')}}/"+data;
        }

        function switchAccount(){
            $('#switchAccount').modal()
        }


    </script>
@endpush
