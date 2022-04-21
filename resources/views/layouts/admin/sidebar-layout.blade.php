<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-2">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-decoration-none mt-1">
        <img src="{{asset('base-template/dist/img/logo-01.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light fw-bold">E-Yajamana</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li  class="user-panel nav-item">
                    <a href="#" class="nav-link mb-2">
                        <img src="{{asset('base-template/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2 mr-2 mb-1" alt="User Image">
                        <p>
                            Admin E-Yajamana
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a  href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
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

                <li class="nav-header font-weight-bold" >DASHBOARD</li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header font-weight-bold">MANAJEMEN AKUN</li>
                <li id="side-data-akun" class="nav-item">
                    <a href="{{route('admin.manajemen-akun.data-akun.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Akun User
                        </p>
                    </a>
                </li>

                <li id="side-pengaturan-akun" class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Pengaturan Akun
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-konfirmasi-sulinggih" href="{{route('admin.manajemen-akun.verifikasi.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Konfirmasi Akun</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header font-weight-bold">MASTER DATA</li>
                <li id="side-master-data" class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-kabupaten" href="{{route('admin.master-data.kabupaten.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kabupaten</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a id="side-kecamatan" href="{{route('admin.master-data.kecamatan.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kecamatan</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a id="side-desa" href="{{route('admin.master-data.desa.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Desa Dinas</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a id="side-desa-adat" href="{{route('admin.master-data.desa-adat.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Banjar Dinas</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a id="side-griya" href="{{route('admin.master-data.griya.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Lokasi Griya</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a id="side-upacara" href="{{route('admin.master-data.upacara.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Upacara</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
