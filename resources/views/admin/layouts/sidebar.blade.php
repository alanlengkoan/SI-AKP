<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ (session()->get('foto') === null) ? '//placehold.co/150' : asset_upload('picture/'.session()->get('foto')) }}" alt="User-Profile-Image">
                    <div class="user-details">
                        {{ session()->get('nama') }}
                    </div>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Dashboard</label>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Master</label>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.agama.agama') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Agama</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.jabatan.jabatan') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Jabatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pangkat.pangkat') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Pangkat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pendidikan.pendidikan') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Pendidikan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.gapok.gapok') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Gaji Pokok</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.cuti.index') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Cuti</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pegawai.pegawai') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Pegawai</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.users') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Users</span>
                    </a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Pustaka</label>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pegawai.pangkat.pangkat') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Kenaikan Pangkat</span>
                    </a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Laporan</label>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.laporan.pegawai') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Pegawai Aktif</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.laporan.pensiun') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Pegawai Pensiun</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.laporan.pangkat') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Riwayat Pangkat</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>