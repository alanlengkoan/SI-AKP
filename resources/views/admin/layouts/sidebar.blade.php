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
                    <a href="{{ route('admin.operator') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Operator</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pangkat') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Pangkat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.jabatan') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Jabatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.potongan') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Potongan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.tunjangan') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Tunjangan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.ttd') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Tanda Tangan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.asal_surat_keputusan') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Asal Surat Keputusan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.jenis_anggota') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Jenis Anggota Keluarga</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.jenis_gaji') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Jenis Gaji</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.jenis_skpp') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Jenis SKPP</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.berkas_skpp') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Berkas SKPP</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pegawai') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Pegawai</span>
                    </a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Pustaka</label>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.jenis_berkas_skpp') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Jenis Berkas SKPP</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.potongan_tunjangan') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Potongan Tunjangan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.ampra_gaji') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Buat SKPP</span>
                    </a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Laporan</label>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.laporan.skpp') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Laporan SKPP</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>