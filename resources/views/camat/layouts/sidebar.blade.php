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
                    <a href="{{ route('camat.dashboard') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Laporan</label>
                </li>
                <li class="nav-item">
                    <a href="{{ route('camat.laporan.pegawai') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Pegawai Aktif</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('camat.laporan.pensiun') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Pegawai Pensiun</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('camat.laporan.pangkat') }}" class="nav-link">
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