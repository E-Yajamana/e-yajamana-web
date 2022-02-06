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
                            Krama Bali
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-konfirmasi-sulinggih" href="#" class="nav-link">
                                <i class="far fa-circle nav-icon mr-1"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a id="side-konfirmasi-sulinggih" href="{{route('auth.logout')}}" class="nav-link">
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
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link p-2">
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
                            <a id="side-kabupaten" href="{{route('krama.manajemen-upacara.upacaraku.index')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon mr-1"></i>
                            <p>Data Upacaraku</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-tambah-upacara" href="{{route('krama.manajemen-upacara.upacaraku.create')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon mr-1"></i>
                            <p>Tambah Upacaraku</p>
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
                            <a id="side-tambah-reservasi" href="#" class="nav-link p-2">
                            <i class="far fa-circle nav-icon mr-1"></i>
                            <p>Tambah Reservasi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link p-2">
                        <i class="far bi-geo-alt-fill nav-icon mr-1"></i>
                        <p>Lokasi Pemuput Karya</p>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
