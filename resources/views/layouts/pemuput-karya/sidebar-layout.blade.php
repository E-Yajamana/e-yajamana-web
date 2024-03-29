<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-2">
    <!-- Brand Logo -->
    <a href="{{route('pemuput-karya.dashboard')}}" class="brand-link text-decoration-none mt-1">
        <img src="{{asset('base-template/dist/img/logo-01.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light fw-bold">E-Yajamana</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li id="side-pengaturan-akun" class="user-panel nav-item ">
                    <a id="side-pengaturan-akun" href="#" class="nav-link mb-2">
                        <img src="{{asset('base-template/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2 mr-2 mb-1" alt="User Image">
                        <p>
                            Pemuput Karya
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
                            <a id="side-profile" href="{{route('pemuput-karya.profile')}}" class="nav-link">
                                <i  class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a  href="{{route('auth.logout')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
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

                <li class="nav-header font-weight-bold pl-2">DASHBOARD</li>
                <li class="nav-item" id="side-dashboard">
                    <a href="{{route('pemuput-karya.dashboard')}}" class="nav-link p-2">
                        <i class="mr-1 nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header font-weight-bold pl-2">MENU UTAMA</li>
{{--
                <li id="" class="nav-item">
                    <a href="{{route('pemuput-karya.calender')}}" class="nav-link p-2" id="muput-calendar">
                        <i class="fa fa-calendar-alt nav-icon"></i>
                        <p>Jadwal Muput</p>
                    </a>
                </li> --}}


                <li id="side-manajemen-muput-upacara" class="nav-item">
                    <a href="#" class="nav-link p-2">
                        <i class="fa bi-brightness-alt-high nav-icon"></i>
                        <p>Muput Upacara </p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-manajemen-muput-upacara-konfirmasi-tangkil" href="{{route('pemuput-karya.muput-upacara.konfirmasi-tangkil.index')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon"></i>
                                <p>Konfirmasi Tangkil @yield('countTangkil')</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a id="side-manajemen-muput-upacara-konfirmasi-muput-upacara" href="{{route('pemuput-karya.muput-upacara.konfirmasi-muput.index')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Konfirmasi Muput  </p>
                            </a>
                            {{-- <span class="badge badge-primary right">2</span> --}}
                        </li>
                    </ul>
                </li>

                <li id="side-manajemen-reservasi" class="nav-item">
                    <a href="#" class="nav-link p-2">
                        <i class="fa fa-book-open nav-icon mr-1"></i>
                        <p>
                            Manajemen Reservasi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-manajemen-reservasi-index" href="{{route('pemuput-karya.manajemen-reservasi.index')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Reservasi Masuk @yield('count-reservasi-masuk')</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a id="side-manajemen-reservasi-riwayat" href="{{route('pemuput-karya.manajemen-reservasi.riwayat.index')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Riwayat Reservasi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header font-weight-bold pl-2" >LAPORAN</li>
                <li class="nav-item" id="side-report">
                    <a href="{{route('pemuput-karya.report')}}" class="nav-link p-2">
                        <i class="nav-icon mr-1 fas fa-book"></i>
                        <p>Laporan Transaksi</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

@include('layouts.modal-switch-account')

