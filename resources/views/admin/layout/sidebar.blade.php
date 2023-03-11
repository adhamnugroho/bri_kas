<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('template-admin/dist/img/bri-logo.jpg') }}" alt="BRIKAS Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BRIKAS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('template-admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->username }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ $menu == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-landmark"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link {{ $menu == 'data_pengguna' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Pengguna

                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('kasMasuk') }}" class="nav-link {{ $menu == 'kas_masuk' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Kas Masuk

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kasKeluar') }}" class="nav-link {{ $menu == 'kas_keluar' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Kas Keluar
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ $menu == 'laporan_rekapitulasi' ? 'menu-open' : '' }}">
                    <a href="" class="nav-link {{ $menu == 'laporan_rekapitulasi' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Laporan Rekapitulasi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('laporanKasMasuk') }}"
                                class="nav-link {{ $sub_menu == 'laporan_kas_masuk' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle "></i>
                                <p>Laporan Kas Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporanKasKeluar') }}"
                                class="nav-link {{ $sub_menu == 'laporan_kas_keluar' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle "></i>
                                <p>Laporan Kas Keluar</p>
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
